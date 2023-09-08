<?php
add_filter( 'rwmb_meta_boxes', 'shrn_fields_dashboard' );

function shrn_fields_dashboard( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'          => __( 'Dashboard Layout', 'shrn' ),
        'id'             => 'dashboard-layout',
        'settings_pages' => ['shrn-dash'],
        'fields'         => [
            [
                'name'        => __( 'Top Level Item', 'shrn' ),
                'id'          => $prefix . 'level_0',
                'type'        => 'group',
                'collapsible' => true,
                'save_state'  => true,
                'group_title' => 'Top Level {#} - {level_0_label}',
                'clone'       => true,
                'sort_clone'  => true,
                'min_clone'   => 2,
                'add_button'  => __( 'Add another Top Level Item', 'shrn' ),
                'fields'      => [
                    [
                        'name'     => __( 'Label (Top Level)', 'shrn' ),
                        'id'       => $prefix . 'level_0_label',
                        'type'     => 'text',
                        'required' => true,
                        'visible'  => [
                            'when'     => [['level_0', '!=', '\'\'']],
                            'relation' => 'or',
                        ],
                    ],
                    [
                        'name'        => __( 'Second Level Item', 'shrn' ),
                        'id'          => $prefix . 'level_1',
                        'type'        => 'group',
                        'collapsible' => true,
                        'save_state'  => true,
                        'group_title' => 'Second Level {#} - {level_1_label}',
                        'clone'       => true,
                        'sort_clone'  => true,
                        'add_button'  => __( 'Add another Second Level Item', 'shrn' ),
                        'fields'      => [
                            [
                                'name'     => __( 'Label (2nd Level)', 'shrn' ),
                                'id'       => $prefix . 'level_1_label',
                                'type'     => 'text',
                                'required' => true,
                            ],
                            [
                                'name'        => __( 'Chart Select', 'shrn' ),
                                'id'          => $prefix . 'chart_grp',
                                'type'        => 'group',
                                'collapsible' => true,
                                'group_title' => '{type} - {chart} {primary_label}',
                                'clone'       => true,
                                'sort_clone'  => true,
                                'add_button'  => __( 'Add another chart or group', 'shrn' ),
                                'fields'      => [
                                    [
                                        'name'     => __( 'Type', 'shrn' ),
                                        'id'       => $prefix . 'type',
                                        'type'     => 'radio',
                                        'options'  => [
                                            'single' => __( 'Single Dummy Chart', 'shrn' ),
                                            'group'  => __( 'Group of Dummy Charts', 'shrn' ),
                                            'csv_set' => __( 'CSV Chart Set', 'shrn' ),
                                        ],
                                        // 'required' => true,
                                    ],
                                    [
                                        'name'       => __( 'Chart', 'shrn' ),
                                        'id'         => $prefix . 'chart',
                                        'type'       => 'post',
                                        'post_type'  => ['chart-mapping'],
                                        'field_type' => 'select_advanced',
                                        // 'required'   => true,
                                        'visible'    => [
                                            'when'     => [['type', '=', 'single'],['type', '=', 'csv_set']],
                                            'relation' => 'or',
                                        ],
                                    ],
                                    [
                                        'name'              => __( 'Primary Label', 'shrn' ),
                                        'id'                => $prefix . 'primary_label',
                                        'type'              => 'text',
                                        'label_description' => __( 'What links all the graphs in the group', 'shrn' ),
                                        'required'          => true,
                                        'append'            => '<strong>vs</strong>',
                                        'visible'           => [
                                            'when'     => [['type', '=', 'group']],
                                            'relation' => 'and',
                                        ],
                                    ],
                                    [
                                        'name'       => __( 'Chart Group', 'shrn' ),
                                        'id'         => $prefix . 'chart_group',
                                        'type'       => 'group',
                                        'clone'      => true,
                                        'sort_clone' => true,
                                        'min_clone'  => 2,
                                        'max_clone'  => 6,
                                        'add_button' => __( 'Add another chart to group', 'shrn' ),
                                        'fields'     => [
                                            [
                                                'name'              => __( 'Label', 'shrn' ),
                                                'id'                => $prefix . 'radio_label',
                                                'type'              => 'text',
                                                'label_description' => __( 'Label for chart radio button', 'shrn' ),
                                                'required'          => true,
                                            ],
                                            [
                                                'name'       => __( 'Group chart', 'shrn' ),
                                                'id'         => $prefix . 'group_chart',
                                                'type'       => 'post',
                                                'post_type'  => ['chart-mapping'],
                                                'field_type' => 'select_advanced',
                                                'required'   => true,
                                            ],
                                        ],
                                        'visible'    => [
                                            'when'     => [['type', '=', 'group']],
                                            'relation' => 'and',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}