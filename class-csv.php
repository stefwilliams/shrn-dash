<?php
namespace SHRN;

Class CSV {
public $expected_headers = array();
public $category_headers = array();
public $primary_headers = array();
public $current_row = 0;
public $gender_options = array();
public $ignored_rows = array();

public $headers = array();
public $school_datasets = array();
public $common_datasets = array();

public $file;
public $html = '';

public $dataset_structure = array(
    'spyear' => array(
        'shrnid' => array(
            '$category' => array(
                '$cat_response' => array(
                    'grade' => array(
                        'male' => 0,
                        'female' => 0,
                        'neither' => 0,
                        'no_answer' => 0
                    ),
                ),
            ),
        ),
    ),
);

    function __construct(){
        $option = get_option('csv-upload');
        // var_dump($option);
        $option ? $fpath = get_attached_file($option['csv'][0]) : $fpath = false;
        $this->set_expected_headers();
        $this->set_gender_options();
        if($fpath){
            $this->process_csv($fpath);
        }
        // $this->sort_datasets($this->school_datasets);
        $this->prepare_html();

    }

    function set_expected_headers(){
        $this->set_category_headers();
        $this->primary_headers = array('shrnid', 'gender', 'grade', 'spyear');
        $this->expected_headers = array_merge($this->primary_headers, $this->category_headers);
        
    }

    function set_category_headers(){
        $args = array(
            'post_type' => 'chart-mapping',
            'numberposts' => -1,
            'meta_key' => 'data_source',
            'meta_value' => 'csv'
        );
        $mappings = get_posts($args);
        foreach($mappings as $mapping){
            $data_map = get_post_meta($mapping->ID, 'csv_data');
            $column = $data_map[0]['column'];
            $this->category_headers[] = $column;
        }

        // $meta = get_post_meta($this->chart_id);
        // $this->mapping['meta'] = $meta;
        // $this->mapping['title'] = $mapping[0]->post_title;

        // = array('bbul', 'supp', 'sleepbin');
    }

    function sort_datasets(&$incoming) {
        ksort($incoming);
        foreach($incoming as &$tosort) {
            if (is_array($tosort)){
                $this->sort_datasets($tosort);
            }
        }
        return $incoming;
    }

    function set_gender_options(){
        $this->gender_options = array(
            '1' => 'Male',
            '2' => 'Female',
            '3' => 'Neither word describes me',
            '98' => 'I do not want to answer',
        );
    }

    function process_csv($fpath){
        $handle = fopen($fpath, "r") or die("Couldn't get file");
        if ($handle) {
            $line = 1;
            while (!feof($handle)){
            $this->current_row = $line;
                $row = fgets($handle);
                if($line === 1){
                    $this->headers = array_map('trim', explode(',', $row));
                }
                else {
                    $this->process_row($row);
                }
                $line ++;
            }
            fclose($handle);
        }
        $this->save_datasets();
     }

     function save_datasets(){
        foreach ($this->school_datasets as $year => $sch_datasets) {
            foreach($sch_datasets as $shrnid => $data){

                $data = $this->sort_datasets($data);

                $title = $shrnid.'_'.$year;

                $post_exists = post_exists($title, '', '', 'dataset');

                $ds_post = array(
                    'ID' => $post_exists,
                    'post_title' => $title,
                    'post_content' => serialize($data),
                    'post_type' => 'dataset',
                    'post_status' => 'publish'
                );

                $ret = wp_insert_post($ds_post, true);
            }
        }
        foreach ($this->common_datasets as $year => $data) {
            $data = $this->sort_datasets($data);
            $title = 'common_'.$year;

            $post_exists = post_exists($title, '', '', 'dataset');

                $ds_post = array(
                    'ID' => $post_exists,
                    'post_title' => $title,
                    'post_content' => serialize($data),
                    'post_type' => 'dataset',
                    'post_status' => 'publish'
                );

                $ret = wp_insert_post($ds_post, true);


        }
     }

     function process_row($line, $debug_record = null){
        $current = array_map('trim', explode(',', $line));
        $combined = array();
        set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
        {
            throw new \ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
        }, E_WARNING);
        try {
          // any code that may have a warning
          if (count($current) === count($this->headers)) {
              $combined = array_combine($this->headers, $current);
          }
        } catch (\Exception $e) {
            print "There is a problem with this row: ".$line;
        } finally {
            // print "this part is always executed n";
        }

        if (!empty($combined) && $this->is_valid_line($combined)) {
            $this->prepare_to_insert($combined);
        }
        // $combined = array_combine($this->headers, $current);
        if ($debug_record === $this->current_row) {
        }
     }

     function is_valid_line($entry){
        $valid = false;
        //as long as one of these entries is there, continue as valid
        foreach($this->category_headers as $reqd) {
            if(array_key_exists($reqd, $entry) && ($entry[$reqd] !== "")){
                $valid = true;
            }
        }
        //if any of these entries are empty, entry is invalid
        foreach($this->primary_headers as $reqd){
            if(array_key_exists($reqd, $entry) && ($entry[$reqd] === "")){
                $valid = false;
            }
        }
        if($valid === false) {
            $this->ignored_rows[] = $this->current_row;
        }
        return $valid;
     }



     function prepare_to_insert($row_array){
        foreach ($this->category_headers as $cat) {
            if (array_key_exists($cat, $row_array) && ($row_array[$cat] !== '')){
                $this->add_to_datasets($row_array, $cat);
            }
        }
        
     }

     function add_to_datasets($arr, $cat) {

        //total number of responses in ALL schools, category and grade - all category responses and genders
        isset($this->common_datasets[$arr['spyear']][$cat]['tot_grade_all_responses'][$arr['grade']]) ?
        $this->common_datasets[$arr['spyear']][$cat]['tot_grade_all_responses'][$arr['grade']]++ :
        $this->common_datasets[$arr['spyear']][$cat]['tot_grade_all_responses'][$arr['grade']]=1;   

        //total number of responses in ALL schools, category, category response, grade and gender
        isset($this->common_datasets[$arr['spyear']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]) ?
        $this->common_datasets[$arr['spyear']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]++ :
        $this->common_datasets[$arr['spyear']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]=1;     

        //total number of responses in school, category and grade - all category responses and all genders
        isset($this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat]['tot_grade_all_responses'][$arr['grade']]) ?
        $this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat]['tot_grade_all_responses'][$arr['grade']]++ :
        $this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat]['tot_grade_all_responses'][$arr['grade']]=1;             

        //total number of responses in school, category, category response, grade and gender
        isset($this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]) ?
        $this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]++ :
        $this->school_datasets[$arr['spyear']][$arr['shrnid']][$cat][$arr[$cat]][$arr['grade']][$arr['gender']]=1;

        $this->add_to_comparison_matrix($arr, $cat);
     }

     function add_to_comparison_matrix($arr, $cat) {
        //if there is no matrix for this category answer, create a new empty array
        if (!isset($this->school_datasets[$arr['spyear']][$arr['shrnid']]['comparison'][$cat][$arr[$cat]])){
            $this->school_datasets[$arr['spyear']][$arr['shrnid']]['comparison'][$cat][$arr[$cat]] = array();
        }
        // add responses for all other categories under this response for category
        foreach ($this->category_headers as $cat_head) {
            if(($cat_head !== $cat) && ($arr[$cat_head] !== '')) {
                // // var_dump($arr);
                isset($this->school_datasets[$arr['spyear']][$arr['shrnid']]['comparison'][$cat][$arr[$cat]][$cat_head][$arr[$cat_head]]) ?
                $this->school_datasets[$arr['spyear']][$arr['shrnid']]['comparison'][$cat][$arr[$cat]][$cat_head][$arr[$cat_head]] ++ :
                $this->school_datasets[$arr['spyear']][$arr['shrnid']]['comparison'][$cat][$arr[$cat]][$cat_head][$arr[$cat_head]] = 1;
                
            }
        }
     }

    function prepare_html(){
        if (!empty($this->school_datasets)){
            $this->html = '<p>File uploaded and processed. Found: </p>';
            $this->html .= '<p>'.count($this->school_datasets).' years of school data...</p>';
            $this->html .= '<p>'.count($this->common_datasets).' years of national data...</p>';

            // </p>';
            foreach($this->school_datasets as $year => $school){
                $this->html .= '<h4>'.$year.'</h4>';
                $this->html .= '<p>'.count($school).' schools.</p>';
                // foreach ($school as $id => $column){
                //     $this->html .= key($column).', ';
                // }
            }
        }
        else {
            $this->html = '<p>Expected column names are:</p>';
            $this->html .= '<h4>Primary Columns</h4><ul>';
            foreach($this->primary_headers as $primary){
                $this->html .= '<li>'.$primary.'</li>';
            }
            $this->html .= '</ul>';
            $this->html .= '<h4>Category Columns</h4><ul>';
            foreach($this->category_headers as $cat){
                $this->html .= '<li>'.$cat.'</li>';
            }
            $this->html .= '</ul>';
        }
    }

}
