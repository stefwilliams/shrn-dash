<?php
add_filter( 'rwmb_meta_boxes', 'shrn_fields_chart_mapping' );

function shrn_fields_chart_mapping( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => __( 'Chart Mapping', 'shrn' ),
        'id'         => null,
        'post_types' => ['chart-mapping'],
        // 'style'      => 'seamless',
        'fields' => [
            [
                'name'     => __( 'Description', 'shrn' ),
                'id'       => $prefix . 'description',
                'type'     => 'textarea',
                'required' => true,
            ],
            [
                'name'          => __( 'Data Source', 'shrn' ),
                'id'            => $prefix . 'data_source',
                'type'          => 'radio',
                'options'       => [
                    'dummy' => __( 'Dummy Data', 'shrn' ),
                    'csv'   => __( 'CSV Import', 'shrn' ),
                ],
                'admin_columns' => [
                    'position'   => 'after title',
                    'sort'       => true,
                    'searchable' => true,
                ],
            ],
            [
                'name'          => __( 'Chart Type', 'shrn' ),
                'id'            => $prefix . 'chart_type',
                'type'          => 'radio',
                'options'       => [
                    'column' => __( 'Column', 'shrn' ),
                    'line'   => __( 'Line', 'shrn' ),
                    'bar'    => __( 'Bar', 'shrn' ),
                ],
                'admin_columns' => [
                    'position'   => 'after title',
                    'sort'       => true,
                    'searchable' => true,
                ],
                'visible'       => [
                    'when'     => [['data_source', '=', 'dummy']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'    => __( 'Dummy Data (Column Chart Type)', 'shrn' ),
                'id'      => $prefix . 'dummy_data_column',
                'type'    => 'group',
                'fields'  => [
                    [
                        'name'              => __( 'X-axis', 'shrn' ),
                        'id'                => $prefix . 'x_axis',
                        'type'              => 'text',
                        'label_description' => __( 'Enter a comma delimited list of category names with no spaces, eg, Year 7,Year 8,Year 9', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Label', 'shrn' ),
                        'id'                => $prefix . 'y_axis',
                        'type'              => 'text',
                        'label_description' => __( 'The label describes what the y-axis measures, eg, Percentage', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Max Value', 'shrn' ),
                        'id'                => $prefix . 'y_axis_max',
                        'type'              => 'number',
                        'label_description' => __( 'Force the y axis to scale to this value. Set to 100 for percentage scales so that all graphs scale consistently.', 'shrn' ),
                    ],
                    [
                        'name'              => __( 'Series ', 'shrn' ),
                        'id'                => $prefix . 'series',
                        'type'              => 'group',
                        'label_description' => __( 'Each series will display a column or spline point above each X-axis category name, with the y position provided by the data list below.', 'shrn' ),
                        'collapsible'       => true,
                        'group_title'       => 'Series {#}',
                        'clone'             => true,
                        'sort_clone'        => true,
                        'add_button'        => __( 'Add another series', 'shrn' ),
                        'fields'            => [
                            [
                                'name'     => __( 'Type', 'shrn' ),
                                'id'       => $prefix . 'type',
                                'type'     => 'radio',
                                'options'  => [
                                    'column' => __( 'Column', 'shrn' ),
                                    'spline' => __( 'Spline', 'shrn' ),
                                ],
                                'required' => true,
                            ],
                            [
                                'name'     => __( 'Name', 'shrn' ),
                                'id'       => $prefix . 'name',
                                'type'     => 'text',
                                'required' => true,
                            ],
                            [
                                'name'     => __( 'Color', 'shrn' ),
                                'id'       => $prefix . 'color',
                                'type'     => 'radio',
                                'options'  => [
                                    '#000066' => __( 'Purple', 'shrn' ),
                                    '#66CC33' => __( 'Green', 'shrn' ),
                                    '#FF9933' => __( 'Orange', 'shrn' ),
                                ],
                                'required' => true,
                            ],
                            [
                                'name'              => __( 'Data', 'shrn' ),
                                'id'                => $prefix . 'data',
                                'type'              => 'text',
                                'label_description' => __( 'A comma delimited list of values, with no commas. Make sure there are the same number as there are categories in the X-axis definition', 'shrn' ),
                                'required'          => true,
                            ],
                        ],
                    ],
                ],
                'visible' => [
                    'when'     => [['data_source', '=', 'dummy'], ['chart_type', '=', 'column']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'    => __( 'Dummy Data (Line Chart Type)', 'shrn' ),
                'id'      => $prefix . 'dummy_data_line',
                'type'    => 'group',
                'fields'  => [
                    [
                        'name'              => __( 'X-axis', 'shrn' ),
                        'id'                => $prefix . 'x_axis',
                        'type'              => 'text',
                        'label_description' => __( 'Enter a comma delimited list of category names with no spaces, eg, 2017,2019,2021', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Label', 'shrn' ),
                        'id'                => $prefix . 'y_axis',
                        'type'              => 'text',
                        'label_description' => __( 'The label describes what the y-axis measures, eg, Percentage', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Max Value', 'shrn' ),
                        'id'                => $prefix . 'y_axis_max',
                        'type'              => 'number',
                        'label_description' => __( 'Force the y axis to scale to this value. If appropriate, set to 100 for percentage scales so that all graphs scale consistently.', 'shrn' ),
                    ],
                    [
                        'name'              => __( 'Series ', 'shrn' ),
                        'id'                => $prefix . 'series',
                        'type'              => 'group',
                        'label_description' => __( 'Each series will display a line point above each X-axis category name, with the y position provided by the data list below.', 'shrn' ),
                        'collapsible'       => true,
                        'group_title'       => 'Series {#}',
                        'clone'             => true,
                        'sort_clone'        => true,
                        'add_button'        => __( 'Add another series', 'shrn' ),
                        'fields'            => [
                            [
                                'name'     => __( 'Name', 'shrn' ),
                                'id'       => $prefix . 'name',
                                'type'     => 'text',
                                'required' => true,
                            ],
                            [
                                'name'     => __( 'Color', 'shrn' ),
                                'id'       => $prefix . 'color',
                                'type'     => 'radio',
                                'options'  => [
                                    '#000066' => __( 'Purple', 'shrn' ),
                                    '#66CC33' => __( 'Green', 'shrn' ),
                                    '#FF9933' => __( 'Orange', 'shrn' ),
                                ],
                                'required' => true,
                            ],
                            [
                                'name'              => __( 'Data', 'shrn' ),
                                'id'                => $prefix . 'data',
                                'type'              => 'text',
                                'label_description' => __( 'A comma delimited list of values, with no commas. Make sure there are the same number as there are categories in the X-axis definition', 'shrn' ),
                                'required'          => true,
                            ],
                        ],
                    ],
                ],
                'visible' => [
                    'when'     => [['data_source', '=', 'dummy'], ['chart_type', '=', 'line']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'    => __( 'Dummy Data (Bar Chart Type)', 'shrn' ),
                'id'      => $prefix . 'dummy_data_bar',
                'type'    => 'group',
                'fields'  => [
                    [
                        'name'              => __( 'X-axis', 'shrn' ),
                        'id'                => $prefix . 'x_axis',
                        'type'              => 'text',
                        'label_description' => __( 'On a bar chart, this text actually appears next to the Y axis, but describes what the X axis measures', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Label', 'shrn' ),
                        'id'                => $prefix . 'y_axis',
                        'type'              => 'text',
                        'label_description' => __( 'The label describes what the y-axis measures, eg, Percentage', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Y-axis Max Value', 'shrn' ),
                        'id'                => $prefix . 'y_axis_max',
                        'type'              => 'number',
                        'label_description' => __( 'Force the y axis to scale to this value. If appropriate, set to 100 for percentage scales so that all graphs scale consistently.', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Series', 'shrn' ),
                        'id'                => $prefix . 'series',
                        'type'              => 'group',
                        'label_description' => __( 'Each series will display a bar along the X axis, with the distance along defined by the data value', 'shrn' ),
                        'collapsible'       => true,
                        'group_title'       => 'Series {#}',
                        'clone'             => true,
                        'sort_clone'        => true,
                        'add_button'        => __( 'Add another series', 'shrn' ),
                        'fields'            => [
                            [
                                'name'     => __( 'Name', 'shrn' ),
                                'id'       => $prefix . 'name',
                                'type'     => 'text',
                                'required' => true,
                            ],
                            [
                                'name'     => __( 'Color', 'shrn' ),
                                'id'       => $prefix . 'color',
                                'type'     => 'radio',
                                'options'  => [
                                    '#000066' => __( 'Purple', 'shrn' ),
                                    '#66CC33' => __( 'Green', 'shrn' ),
                                    '#FF9933' => __( 'Orange', 'shrn' ),
                                ],
                                'required' => true,
                            ],
                            [
                                'name'              => __( 'Data', 'shrn' ),
                                'id'                => $prefix . 'data',
                                'type'              => 'number',
                                'label_description' => __( 'A single number to define how far along the X axis the bar should go', 'shrn' ),
                                'required'          => true,
                            ],
                        ],
                    ],
                ],
                'visible' => [
                    'when'     => [['chart_type', '=', 'bar'], ['data_source', '=', 'dummy']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'    => __( 'CSV Data', 'shrn' ),
                'id'      => $prefix . 'csv_data',
                'type'    => 'group',
                'fields'  => [
                    [
                        'name'              => __( 'Category Column', 'shrn' ),
                        'id'                => $prefix . 'column',
                        'type'              => 'text',
                        'label_description' => __( 'Enter the name of the primary column that holds the data for this set of charts', 'shrn' ),
                        'required'          => true,
                    ],
                    [
                        'name'              => __( 'Values and Labels', 'shrn' ),
                        'id'                => $prefix . 'label_map',
                        'type'              => 'group',
                        'label_description' => __( 'Enter the label that relates to each numerical value in the category column of interest, eg, Value = 0, Label = Eats Breakfast.<br /><strong>Note</strong> The first value in the sequence will be the primary value used on those graphs where only one value is used', 'shrn' ),
                        'clone'             => true,
                        'sort_clone'        => true,
                        'save_field'        => false,
                        'fields'            => [
                            [
                                'name'              => __( 'Value', 'shrn' ),
                                'id'                => $prefix . 'value',
                                'type'              => 'number',
                                'label_description' => __( 'Value in column', 'shrn' ),
                                'required'          => true,
                            ],
                            [
                                'name'     => __( 'Label', 'shrn' ),
                                'id'       => $prefix . 'name',
                                'type'     => 'text',
                                'label_description' => __( 'Label for this value', 'shrn' ),
                                'required' => true,
                            ],
                        ],                        
                    ],
                ],
                'visible' => [
                    'when'     => [['data_source', '=', 'csv']],
                    'relation' => 'and',
                ],
            ],
        ],
    ];

    return $meta_boxes;
}