<?php
/**
 * @package Languagepartners
 */
/*
 * Plugin Name: SHRN dashboard plugin
 * Plugin URI:https://git.cardiff.ac.uk/dev-team/web-mobile/cu-wordpress/wordpress-plugin-shrn-dash
 * GitLab Plugin URI: https://git.cardiff.ac.uk/dev-team/web-mobile/cu-wordpress/wordpress-plugin-shrn-dash
 * Description: Add graphs and charts for schools to access. This is solely for demo purposes for generating a prototype and is likely unstable at present.
 * Version: 0.0.3 BETA
 * Requires at least: 5.0
 * Requires PHP: 7
 * Author: Cardiff University 
 * Author URI: https://cardiff.ac.uk
 * License: GPLv2 or later
 * Text Domain: shrn
*/
include('shortcode.php');
include('class-chart.php');
include('class-dash.php');
// include('dash-test.php');
include('mb/cpt_chart-mapping.php');
include('mb/cpt_dataset.php');
include('mb/settings_dashboard.php');
include('mb/settings_csv.php');
include('mb/fields_chart-mapping.php');
include('mb/fields_dashboard.php');
include('mb/fields_csv.php');
include('class-csv.php');

add_action( 'wp_enqueue_scripts', 'shrn_enqueue_highcharts' );

add_action( 'wp_head', 'shrn_enqueue_highcharts_css' );

function shrn_enqueue_highcharts(){
    $ver = '1.0';
    wp_register_script( 'highcharts', 'https://code.highcharts.com/highcharts.js', '', $ver, false );
    wp_register_script( 'highcharts-export', 'https://code.highcharts.com/modules/exporting.js', 'highcharts', $ver, false );
    wp_register_script( 'highcharts-exportdata', 'https://code.highcharts.com/modules/export-data.js', 'highcharts', $ver, false );
    wp_register_script( 'highcharts-a11y', 'https://code.highcharts.com/modules/accessibility.js', 'highcharts', $ver, false );
    wp_register_script( 'shrn-highcharts', plugin_dir_url(__FILE__).'js/shrn_highcharts.js', array('highcharts', 'jquery'), $ver, false ); 
    wp_register_script( 'shrn-dash', plugin_dir_url(__FILE__).'js/shrn_dash.js', array('jquery'), $ver, false );     
    wp_register_script( 'loading-overlay', plugin_dir_url(__FILE__).'js/jquery-loading-overlay-2.1.7/src/loadingoverlay.js', array('jquery', 'shrn-dash'), $ver, false );  
}

function shrn_enqueue_highcharts_css(){
    $ver = '1.0';
    wp_register_style('shrn-dash', plugin_dir_url(__FILE__).'css/shrn_highcharts.css', '', $ver, false);
    wp_register_style('highcharts', plugin_dir_url(__FILE__).'css/shrn_dash.css', '', $ver, false);
}


function shrn_csv_process(){
    $csv = new SHRN\CSV();
    return $csv->html;
}

// add_filter('single_template', 'single_chart_mapping', 11);

add_filter( 'template_include', 'single_chart_mapping', 11 );

function single_chart_mapping($input){
    global $post;
    if ($post && ( $post->post_type == 'chart-mapping' && is_singular() && current_user_can('edit_posts'))) {
            return plugin_dir_path(__FILE__). 'single-chart-mapping.php';
    }
    else {
        return $input;
    }
}


function shrn_dash_template( $template )
{
    if( isset( $_GET['dash']) && 'test' == $_GET['dash'] )
        $template = plugin_dir_path( __FILE__ ) . 'dash-test.php';

    return $template;
}

function pre_dump($var, $header = ''){
    $bt = debug_backtrace();

    echo '<pre>';
    if(!empty($header)){
            var_dump($header);
    }
    // var_dump($bt);
    var_dump($var);
    var_dump('FILE: '.$bt[0]['file'].' LINE: '.$bt[0]['line']);
    if(!empty($header)){
            var_dump('END '.$header);
    }
    echo '</pre>';
}