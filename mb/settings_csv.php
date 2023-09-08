<?php
add_filter( 'mb_settings_pages', 'shrn_register_csv_setting' );

function shrn_register_csv_setting( $settings_pages ) {
	$settings_pages[] = [
        'menu_title' => __( 'CSV upload', 'shrn' ),
        'id'         => 'csv-upload',
        'position'   => 25,
        'parent'     => 'shrn-dash',
        'capability' => 'edit_posts',
        'style'      => 'no-boxes',
        'columns'    => 1,
        'icon_url'   => 'dashicons-admin-generic',
    ];

	return $settings_pages;
}