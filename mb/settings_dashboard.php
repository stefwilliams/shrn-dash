<?php
add_filter( 'mb_settings_pages', 'shrn_register_dash_setting' );

function shrn_register_dash_setting( $settings_pages ) {
	$settings_pages[] = [
        'menu_title'    => __( 'SHRN Dash', 'shrn' ),
        'id'            => 'shrn-dash',
        'position'      => 2,
        'submenu_title' => 'Layout',
        'capability'    => 'edit_posts',
        'style'         => 'no-boxes',
        'columns'       => 1,
        'icon_url'      => 'dashicons-admin-generic',
    ];

	return $settings_pages;
}