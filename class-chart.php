<?php

namespace SHRN;

class Chart
{
  public $chart_id;
  //which school is being looked at
  public $shrnid;
  public $chart_type;
  public $mapping = array();
  public $for_json = array();
  public $csv_column = '';


  function __construct($chart_id, $type_override = '')
  {
    $chart_id ? $this->chart_id = $chart_id : $this->chart_id = null;
    $type_override ? $this->chart_type = $type_override : $this->chart_type = null;
  }

  function get_mapping()
  {
    $args = array(
      'post_type' => 'chart-mapping',
      'post__in' => array($this->chart_id),
    );
    $mapping = get_posts($args);
    $meta = get_post_meta($this->chart_id);
    $this->mapping['meta'] = $meta;
    $this->mapping['title'] = $mapping[0]->post_title;
  }

  function prepare_chart()
  {
    $html = '';
    $this->get_mapping();
    $html .= current_user_can('edit_posts') ? '<a style = "float:right" href="' . get_edit_post_link($this->chart_id) . '">Edit chart</a>' : '';
    $data = $this->get_data_by_source_type();


    $this->prepare_for_json($this->mapping['meta']["chart_type"][0], $data);
    $enc = json_encode($this->for_json);
    //note the quotes (double outside and single inside) - try it the other way round and the json_encode is borked.
    $html .= "<div id='dash_chart_" . $this->chart_id . '_' . rand(0, 999) . "' class='chart_container' data-config='" . $enc . "'></div>";
    $html .= '<p class="highcharts-description">' . $this->mapping['meta']['description'][0] . '</p>';
    return $html;
  }

  function prepare_chart_set()
  {
    $html = '';
    $this->get_mapping();
    $html .= current_user_can('edit_posts') ? '<a style = "float:right" href="' . get_edit_post_link($this->chart_id) . '">Edit chart</a>' : '';

    $dataset = $this->map_dataset();
    foreach ($dataset as $type => $config) {
      if (!empty($config)) {


        $this->prepare_for_json($type, $config);
        $enc = json_encode($this->for_json);
        if ($type == array_key_first($dataset)) {
          $html .= '<p class="highcharts-description">' . $this->mapping['meta']['description'][0] . '</p>';
        }
        //note the quotes (double outside and single inside) - try it the other way round and the json_encode is borked.
        $html .= "<div id='dash_chart_" . $this->chart_id . '_' . rand(0, 999) . "' class='chart_container' data-config='" . $enc . "'></div>";
      }
    }

    return $html;
  }

  function prepare_for_json($type, $data)
  {
    unset($this->for_json);
    $this->for_json["chart"] = array("type" => $type);

    switch ($type) {
      case 'column1':
        $this->for_json["title"] = array("text" => $this->mapping["title"] . ' - Genders by Grade (2021)');
        break;
      case 'column2':   
        $this->for_json["title"] = array("text" => $this->mapping["title"] . ' - Genders by Grade (2019)');
        break;     
      case 'column3':
        $this->for_json["title"] = array("text" => $this->mapping["title"] . ' - Genders by Grade (2017)');
        break;
      case 'line':
        $this->for_json["title"] = array("text" => $this->mapping["title"] . ' - Trends over Time');
        break;
      case 'bar':
        $this->for_json["title"] = array("text" => $this->mapping["title"] . ' - Comparison Chart');
        break;
    }

    $this->for_json["credits"] = array("enabled" => false);

    foreach ($data as $type => $value) {
      switch ($type) {
        case "x_axis":
          $this->for_json["xAxis"] = array("categories" => explode(",", $value));
          break;
        case "y_axis":
          $this->for_json["yAxis"] = array("title" => array("text" => $value));
          break;
        case "y_axis_max":
          $this->for_json["yAxis"]["max"] = 100;
          break;
        case "series":
          foreach ($value as $key => $setting) {
            $this->for_json["series"][$key] = array(
              "type" => array_key_exists('type', $setting) ? $setting["type"] : '',
              "name" => $setting["name"],
              "color" => $setting["color"],
              "data" => array_map('intval', explode(",", $setting["data"]))
            );
          }
          break;
      }
    }
  }

  function get_data_by_source_type()
  {

    $source = $this->mapping['meta']["data_source"][0];

    $type = $this->mapping['meta']["chart_type"][0];
    $data_key = $source . '_data_' . $type;
    $data = unserialize($this->mapping['meta'][$data_key][0]);
    return $data;
    // if (($mapping["data_source"][0] === "dummy") && ($mapping["chart_type"][0] === "column")) {
    //     $data = unserialize($mapping["dummy_data_column"][0]);
    //   }
    //   if (($mapping["data_source"][0] === "dummy") && ($mapping["chart_type"][0] === "line")) {
    //     $data = unserialize($mapping["dummy_data_line"][0]);
    //   }
    //   if (($mapping["data_source"][0] === "dummy") && ($mapping["chart_type"][0] === "bar")) {
    //     $data = unserialize($mapping["dummy_data_bar"][0]);
    //   }
  }

  function map_dataset()
  {
    //hardcoding this to use school 102 in 2021 for demo purposes
    $this->shrnid = '102';
    // $year = '2021';
    $map_meta = unserialize($this->mapping['meta']['csv_data'][0]);

    $this->csv_column = $map_meta['column'];
    $ds_2021_id = post_exists($this->shrnid . '_2021', '', '', 'dataset');
    $args = array(
      'post_type' => 'dataset',
      'post__in' => array($ds_2021_id),
    );
    $sch_ds_2021_post = get_posts($args);
    $sch_dataset_2021 = unserialize($sch_ds_2021_post[0]->post_content);
    $sch_dataset_2021_column = $sch_dataset_2021[$this->csv_column];

    $ds_2019_id = post_exists($this->shrnid . '_2019', '', '', 'dataset');
    $args = array(
      'post_type' => 'dataset',
      'post__in' => array($ds_2019_id),
    );
    $sch_ds_2019_post = get_posts($args);
    $sch_dataset_2019 = unserialize($sch_ds_2019_post[0]->post_content);
    $sch_dataset_2019_column = $sch_dataset_2019[$this->csv_column];

    $ds_2017_id = post_exists($this->shrnid . '_2017', '', '', 'dataset');
    $args = array(
      'post_type' => 'dataset',
      'post__in' => array($ds_2017_id),
    );
    $sch_ds_2017_post = get_posts($args);
    $sch_dataset_2017 = unserialize($sch_ds_2017_post[0]->post_content);
    $sch_dataset_2017_column = $sch_dataset_2017[$this->csv_column];



    $all_charts = array(
      'column1' => $this->prepare_column_data($sch_dataset_2021_column, '2021'),
      'column2' => $this->prepare_column_data($sch_dataset_2019_column, '2019'),
      'column3' => $this->prepare_column_data($sch_dataset_2017_column, '2017'),
      'line' => $this->prepare_line_data($this->csv_column),
    );

    return $all_charts;
  }

  function return_percentage($v1, $v2) {
    if ($v1 === 0 && $v2 === 0) {
      $percent = 0;
    }
    else {
      $percent = round($v1 / ($v1 + $v2) * 100);
    }
    return $percent;
  }

  function prepare_column_data($data, $year)
  {
    $ds_id = post_exists('common_'.$year, '', '', 'dataset');
    $args = array(
      'post_type' => 'dataset',
      'post__in' => array($ds_id),
    );
    $common_ds_post = get_posts($args);
    $common_dataset = unserialize($common_ds_post[0]->post_content);

    $cat_string = '';
    $male_array = array();
    $female_array = array();
    $total_array = array();
    $male_avg_array = array();
    $female_avg_array = array();
    foreach ($data['tot_grade_all_responses'] as $grade => $responses) {
      $cat_string .= 'Year ' . $grade;
      $cat_string .= $grade == array_key_last($data['tot_grade_all_responses']) ? '' : ',';

      $v1 = isset($data['1'][$grade]['1']) ? $data['1'][$grade]['1'] : 0;
      $v2 = isset($data['0'][$grade]['1']) ? $data['0'][$grade]['1'] : 0;
      $male_gd_responses = $this->return_percentage($v1, $v2);
      array_push($male_array, $male_gd_responses);

      $v1 = isset($data['1'][$grade]['2']) ? $data['1'][$grade]['2'] : 0;
      $v2 = isset($data['0'][$grade]['2']) ? $data['0'][$grade]['2'] : 0;
      $female_gd_responses = $this->return_percentage($v1, $v2);
      array_push($female_array, $female_gd_responses);

      $v1 = isset($data['1'][$grade]) ? array_sum($data['1'][$grade]) : 0;
      $v2 = isset($data['0'][$grade]) ? array_sum($data['0'][$grade]) : 0;
      $total_gd_responses = $this->return_percentage($v1, $v2);
      array_push($total_array, $total_gd_responses);

      $v1 = isset($common_dataset[$this->csv_column]['1'][$grade]['1']) ? $common_dataset[$this->csv_column]['1'][$grade]['1'] : 0;
      $v2 = isset($common_dataset[$this->csv_column]['0'][$grade]['1']) ? $common_dataset[$this->csv_column]['0'][$grade]['1'] : 0;
      $nat_male_gd_responses = $this->return_percentage($v1, $v2);
      array_push($male_avg_array, $nat_male_gd_responses);

      $v1 = isset($common_dataset[$this->csv_column]['1'][$grade]['2']) ? $common_dataset[$this->csv_column]['1'][$grade]['2'] : 0;
      $v2 = isset($common_dataset[$this->csv_column]['0'][$grade]['2']) ? $common_dataset[$this->csv_column]['0'][$grade]['2'] : 0;
      $nat_female_gd_responses = $this->return_percentage($v1, $v2);
      array_push($female_avg_array, $nat_female_gd_responses);
    }

    $series_array = array(
      '0' => array(
        'type' => 'column',
        'name' => 'Male',
        'color' => '#000066',
        'data' => implode(',', $male_array),
      ),
      '1' => array(
        'type' => 'column',
        'name' => 'Female',
        'color' => '#66CC33',
        'data' => implode(',', $female_array),
      ),
      '2' => array(
        'type' => 'column',
        'name' => 'Total',
        'color' => '#FF9933',
        'data' => implode(',', $total_array),
      ),
      '3' => array(
        'type' => 'spline',
        'name' => 'National Male Average',
        'color' => '#000066',
        'data' => implode(',', $male_avg_array),
      ),
      '4' => array(
        'type' => 'spline',
        'name' => 'National Female Average',
        'color' => '#66CC33',
        'data' => implode(',', $female_avg_array),
      )
    );

    $chart_config = array(
      'x_axis' => $cat_string,
      'y_axis' => 'Percentage',
      'y_axis_max' => 100,
      'series' => $series_array,
    );
    
    return $chart_config;
  }

  function prepare_line_data($column)
  {
    //hardcoded for the moment
    $years = array(
      '2017' => array(),
      '2019' => array(),
      '2021' => array()
    );

    $cat_string = '';
    $male_array = array();
    $female_array = array();
    $total_array = array();
    $series_array = array();

    //get previous years datasets ids
    foreach ($years as $year => $empty) {
      $ds_id = post_exists($this->shrnid . '_' . $year, '', '', 'dataset');
      if ($ds_id === 0) {
        unset($years[$year]);
      } else {
        $args = array(
          'post_type' => 'dataset',
          'post__in' => array($ds_id),
        );
        $sch_ds_post = get_posts($args);
        $sch_dataset = unserialize($sch_ds_post[0]->post_content);
        $sch_col_ds = $sch_dataset[$column];

        $years[$year] = $sch_col_ds;

        $cat_string .= $year;
        $cat_string .= $year == array_key_last($years) ? '' : ',';

        $male_responses = 0;
        $male_other_response = 0;
        $female_responses = 0;
        $female_other_response = 0;
        $total_responses = 0;

        $all_responses = array_sum($sch_col_ds['tot_grade_all_responses']);
        // pre_dump($column);
        // pre_dump($sch_col_ds);

        if (array_key_exists('1', $sch_col_ds)) {

          foreach ($sch_col_ds['1'] as $grade => $genders) {

            foreach ($genders as $gender => $responses) {
              switch ($gender) {
                case '1':
                  $male_responses += $responses;
                  $male_other_response += isset($sch_col_ds['0'][$grade][$gender]) ? $sch_col_ds['0'][$grade][$gender] : 0;
                  $total_responses += $responses;
                  break;
                case '2':
                  $female_responses += $responses;
                  $female_other_response += isset($sch_col_ds['0'][$grade][$gender]) ? $sch_col_ds['0'][$grade][$gender] : 0;
                  $total_responses += $responses;
                  break;
                default:
                  $total_responses += $responses;
                  break;
              }
            }
            // $male_responses += array_key_exists('1', $genders) ? $genders['1'] : 0;
            // $female_responses += array_key_exists('2', $genders) ? $genders['2'] : 0;
          }


          $male_percent = round(($male_responses / ($male_responses + $male_other_response)) * 100);
          $female_percent = round(($female_responses / ($female_responses + $female_other_response)) * 100);
          $total_percent = round(($total_responses / $all_responses) * 100);
        }

        else {
          $male_percent = null;
          $female_percent = null;
          $total_percent = null;
        }


        array_push($male_array, $male_percent);
        array_push($female_array, $female_percent);
        array_push($total_array, $total_percent);
        // all_responses = round(array_sum($sch_col_ds)) * 100;




      }
    }
    $series_array = array(
      '0' => array(
        'type' => 'line',
        'name' => 'School Male Average',
        'color' => '#000066',
        'data' => implode(',', $male_array),
      ),
      '1' => array(
        'type' => 'line',
        'name' => 'School Female Average',
        'color' => '#66CC33',
        'data' => implode(',', $female_array),
      ),
      '2' => array(
        'type' => 'line',
        'name' => 'School Total Average',
        'color' => '#FF9933',
        'data' => implode(',', $total_array),
      ),
    );
    $chart_config = array(
      'x_axis' => $cat_string,
      'y_axis' => 'Percentage',
      'y_axis_max' => 100,
      'series' => $series_array,
    );


    return $chart_config;
  }
}
