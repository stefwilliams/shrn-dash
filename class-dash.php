<?php

namespace SHRN;

class Dash
{
  public $dash = array();


  //html output
  public $html = '';

  //html for level_1, to be appended after level_0 has been built
  public $level_1 = '';

  public $mappings = array();
  public $for_json = array();


  function __construct()
  {
    $this->get_dash();
    $this->enqueue_css();
    $this->enqueue_js();
    $this->prepare_html();
  }

  function get_dash()
  {
    $dash = get_option('shrn-dash');
    if (!empty($dash)) {
      $this->dash = $dash['level_0'];
    }
  }

  function enqueue_js()
  {
    wp_enqueue_script('highcharts');
    wp_enqueue_script('highcharts-export');
    wp_enqueue_script('highcharts-exportdata');
    wp_enqueue_script('highcharts-a11y');
    wp_enqueue_script('shrn-highcharts');
    wp_enqueue_script('shrn-dash');
    wp_enqueue_script('loading-overlay');
  }

  function enqueue_css()
  {
    wp_enqueue_style('highcharts');
    wp_enqueue_style('shrn-dash');
  }

  function prepare_html()
  {
    $html = '<div id="shrn_dash" class="dash">';
    $html .= '<ul class="h-tab_tab-head">';
    foreach ($this->dash as $key => $level_0) {
      $thistab = 'htab' . $key;
      $html .= '<li rel="' . $thistab . '" ';
      $html .= $key == 0 ? 'class="active" ' : '';
      $html .= '>';
      $html .= $level_0['level_0_label'];
      $html .= '</li>';

      if (array_key_exists('level_1', $level_0) && (!empty($level_0['level_1']))) {
        $this->prepare_level_1($level_0['level_1'], $thistab);
      }
    }
    $html .= '</ul>';
    //this section is hidden to start with and made visible once loaded
    $html .= '<div class="h-tab_container" style="visibility:hidden;">';

    //level_1 and content in here
    $html .= $this->level_1;

    $html .= '</div>'; //h-tab_container
    $html .= '</div>'; //dash
    $this->html = $html;
    // return $html;
  }

  function prepare_level_1($l1_array, $parent_tab)
  {
    $container_html = '';

    $l1_html = '<div id="' . $parent_tab . '" class="h-tab_content">';
    $l1_html .= '<div class="v-tab">';
    $l1_html .= '<ul class="v-tab_tab-head">';
    foreach ($l1_array as $key => $level_1) {
      $thistab = 'vtab_' . $parent_tab . '_' . $key;
      $l1_html .= '<li rel="' . $thistab . '" ';
      $l1_html .= $key == 0 ? 'class="active" ' : '';
      $l1_html .= '>';
      $l1_html .= '<div class="scroller">' . $level_1['level_1_label'] . '&nbsp;&nbsp;</div>'; //nbsps added to make sure scroller.scroll class gets applied in edge cases
      $l1_html .= '</li>';
      
      if (array_key_exists('chart_grp', $level_1) && (!empty($level_1['chart_grp']))) {
        $container_html .= $this->prepare_container($level_1['chart_grp'], $thistab);
        // $this->prepare_level_1($level_0['level_1'], $thistab);
      }
    }
    $l1_html .= '</ul>'; //v-tab_tab-head

    $l1_html .= $container_html;

    $l1_html .= '</div>'; //v-tab
    $l1_html .= '</div>'; //h-tab_content

    $this->level_1 .= $l1_html;
  }

  function prepare_container($input_array, $parent)
  {

    $container_html = '<div class="v-tab_container">';
    $container_html .= '<div class="v-tab_content" id="' . $parent . '">';
    
    foreach ($input_array as $key => $chart) {
      if (!array_key_exists('chart', $chart) && !array_key_exists('chart_group', $chart)) {
        $container_html .= '<figure class="highcharts-figure">';
        $container_html .= '<p>No chart available.</p>';
        $container_html .= '</figure>';
      } else {
        switch ($chart['type']) {
          case 'single':
            $container_html .= '<figure class="highcharts-figure">';
            $container_html .= $this->prepare_chart($chart['chart']);
            $container_html .= '</figure>';
            break;
          case 'group':
            $container_html .= '<figure class="highcharts-figure">';
            $container_html .= $this->prepare_chart_group($chart['chart_group'], $chart['primary_label']);
            $container_html .= '</figure>';
            break;
          case 'csv_set':
            $container_html .= $this->prepare_csv_set($chart['chart']);
        }
      }
    }

    $container_html .= '</div>'; //v-tab_content
    $container_html .= '</div>'; //v-tab_container
    return $container_html;
  }

  function prepare_csv_set($chart_id){
    $chart = new Chart($chart_id);
    return $chart->prepare_chart_set();
  }

  function prepare_chart($chart_id)
  {
    $chart = new Chart($chart_id);
    return $chart->prepare_chart();
  }


  function prepare_chart_group($group, $primary_label)
  {
    $html = '';
    foreach ($group as $key => $selection) {
      if (!array_key_exists('group_chart', $selection)) {
        $html .= '<div class="radio_select radio' . $key . '">';
        $html .= 'No group chart available';
        $html .= '</div>';
      } else {
        $html .= '<div class="radio_select radio' . $key . '">';
        $chart = new Chart($selection['group_chart']);
        $html .= $chart->prepare_chart();
        $html .= '</div>';
      }
    }
    $html .= '<div class="radio_select_buttons">';
    $html .= $primary_label . ' VS';
    foreach ($group as $key => $selection) {
      $html .= '<input type="radio" name="' . sanitize_title($primary_label) . '" class="chart_switch" value="radio' . $key . '"';
      $html .= $key == 0 ? ' checked="checked"' : '';
      $html .= '/>';
      $html .= '<label for="radio' . $key . '">' . $selection['radio_label'] . '</label>';
    }



    // $chart = new Chart($chart_id);
    // $chart_html = $chart->prepare_chart();
    return $html;
  }

  function get_html()
  {
    return $this->html;
  }


}
