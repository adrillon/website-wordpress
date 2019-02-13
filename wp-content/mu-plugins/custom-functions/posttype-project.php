<?php
/*
 * Post type dedicated to projects
 */

add_action('init', 'posttype_projects_init');
function posttype_projects_init() {
    register_post_type('projects', [
        'labels' => [
            'name' => __('Projects', 'resume'),
            'singular_name' => __('Project', 'resume'),
        ],
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-multisite',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
    ]);
    add_filter('rest_prepare_projects', 'add_link_to_translations', 10, 3);
}

add_action('cmb2_init', 'posttype_projects_cmb2');
function posttype_projects_cmb2() {
    $prefix = 'project_';

    $cmbProjectBox = new_cmb2_box([
        'id' => 'project',
        'title' => __('Project information', 'resume'),
        'object_types' => [ 'projects' ],
        'show_names' => true,
        'show_in_rest' => WP_REST_Server::READABLE,
    ]);

    $cmbLinksBox = $cmbProjectBox->add_field([
        'id' => $prefix . 'links',
        'type' => 'group',
        'title' => __('Links', 'resume'),
        'repeatable' => false,
    ]);

    $cmbProjectBox->add_group_field($cmbLinksBox, [
        'id' => 'homepage',
        'name' => __('Project homepage', 'resume'),
        'type' => 'text_url',
    ]);
}
