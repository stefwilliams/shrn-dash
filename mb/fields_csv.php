<?php
add_filter( 'rwmb_meta_boxes', 'shrn_fields_csv' );

function shrn_fields_csv( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'          => __( 'CSV Upload', 'shrn' ),
        'id'             => 'csv-upload',
        'settings_pages' => ['csv-upload'],
        'fields'         => [
            [
                'name'             => __( 'File Upload', 'shrn' ),
                'id'               => $prefix . 'csv',
                'type'             => 'file_upload',
                'mime_type'        => 'csv',
                'max_file_uploads' => 1,
                'force_delete'     => true,
            ],
            [
                'name'       => __( 'CSV Processing', 'shrn' ),
                'type'       => 'custom_html',
                'callback'   => 'shrn_csv_process',
                'save_field' => false,
            ],
        ],
    ];

    return $meta_boxes;
}