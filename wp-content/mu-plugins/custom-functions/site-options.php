<?php

add_action('cmb2_admin_init', 'register_site_options');
function register_site_options() {
    $mainOptions = new_cmb2_box([
        'id' => 'resume_options',
        'title' => __('Site options', 'resume'),
        'object_types' => ['options-page'],
        'option_key' => 'resume_options',
        'admin_menu_hook' => 'network_admin_menu',
    ]);

    $contactLinksBox = $mainOptions->add_field([
        'name' => __('Contact links', 'resume'),
        'id' => 'contact_links',
        'type'=> 'group',
        'repeatable' => true,
        'options' => [
            'sortable' => true,
        ]
    ]);

    $mainOptions->add_group_field($contactLinksBox, [
        'name' => __('Name', 'resume'),
        'id' => 'name',
        'type' => 'text',
    ]);

    $mainOptions->add_group_field($contactLinksBox, [
        'name' => __('URL', 'resume'),
        'id' => 'url',
        'type' => 'text_url',
    ]);

    $mainOptions->add_group_field($contactLinksBox, [
        'name' => __('Slug', 'resume'),
        'id' => 'slug',
        'type' => 'text',
    ]);
}

/**
 * Add a custom REST route to get the site's options
 */

add_action('rest_api_init', function() {
    register_rest_route(
        'wp/v2', // using the default namespace allows for node-wpapi to automatically detect the endpoint
        'options',
        [
            'method' => 'GET',
            'callback' => __NAMESPACE__.'\custom_get_options',
        ]
    );
});

function custom_get_options($request) {
    return get_site_option('resume_options');
}

