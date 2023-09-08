<?php
add_action( 'init', 'shrn_register_chart_cpt' );
function shrn_register_chart_cpt() {
	$labels = [
		'name'                     => esc_html__( 'Chart Mappings', 'shrn' ),
		'singular_name'            => esc_html__( 'Chart Mapping', 'shrn' ),
		'add_new'                  => esc_html__( 'Add New', 'shrn' ),
		'add_new_item'             => esc_html__( 'Add New Chart Mapping', 'shrn' ),
		'edit_item'                => esc_html__( 'Edit Chart Mapping', 'shrn' ),
		'new_item'                 => esc_html__( 'New Chart Mapping', 'shrn' ),
		'view_item'                => esc_html__( 'View Chart Mapping', 'shrn' ),
		'view_items'               => esc_html__( 'View Chart Mappings', 'shrn' ),
		'search_items'             => esc_html__( 'Search Chart Mappings', 'shrn' ),
		'not_found'                => esc_html__( 'No chart mappings found.', 'shrn' ),
		'not_found_in_trash'       => esc_html__( 'No chart mappings found in Trash.', 'shrn' ),
		'parent_item_colon'        => esc_html__( 'Parent Chart Mapping:', 'shrn' ),
		'all_items'                => esc_html__( 'Chart Mappings', 'shrn' ),
		'archives'                 => esc_html__( 'Chart Mapping Archives', 'shrn' ),
		'attributes'               => esc_html__( 'Chart Mapping Attributes', 'shrn' ),
		'insert_into_item'         => esc_html__( 'Insert into chart mapping', 'shrn' ),
		'uploaded_to_this_item'    => esc_html__( 'Uploaded to this chart mapping', 'shrn' ),
		'featured_image'           => esc_html__( 'Featured image', 'shrn' ),
		'set_featured_image'       => esc_html__( 'Set featured image', 'shrn' ),
		'remove_featured_image'    => esc_html__( 'Remove featured image', 'shrn' ),
		'use_featured_image'       => esc_html__( 'Use as featured image', 'shrn' ),
		'menu_name'                => esc_html__( 'Chart Mappings', 'shrn' ),
		'filter_items_list'        => esc_html__( 'Filter chart mappings list', 'shrn' ),
		'filter_by_date'           => esc_html__( '', 'shrn' ),
		'items_list_navigation'    => esc_html__( 'Chart Mappings list navigation', 'shrn' ),
		'items_list'               => esc_html__( 'Chart Mappings list', 'shrn' ),
		'item_published'           => esc_html__( 'Chart Mapping published.', 'shrn' ),
		'item_published_privately' => esc_html__( 'Chart Mapping published privately.', 'shrn' ),
		'item_reverted_to_draft'   => esc_html__( 'Chart Mapping reverted to draft.', 'shrn' ),
		'item_scheduled'           => esc_html__( 'Chart Mapping scheduled.', 'shrn' ),
		'item_updated'             => esc_html__( 'Chart Mapping updated.', 'shrn' ),
		'text_domain'              => esc_html__( 'shrn', 'shrn' ),
	];
	$args = [
		'label'               => esc_html__( 'Chart Mappings', 'shrn' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'hierarchical'        => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => false,
		'query_var'           => false,
		'can_export'          => true,
		'delete_with_user'    => false,
		'has_archive'         => false,
		'rest_base'           => '',
		'show_in_menu'        => 'shrn-dash',
		'menu_icon'           => 'dashicons-chart-bar',
		'capability_type'     => 'post',
		'supports'            => ['title'],
		'taxonomies'          => [],
		'rewrite'             => [
			'with_front' => false,
		],
	];

	register_post_type( 'chart-mapping', $args );
}