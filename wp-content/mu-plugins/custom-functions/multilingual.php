<?php
/**
 * Whenever a post (of any type) is queried via the REST API, the ID of the matching post in each language is added to the result.
 */

add_action('init', 'multilingual_wp_init');
function multilingual_wp_init() {
    foreach (get_post_types([
        'public' => true,
    ]) as $postType) {
        add_filter('rest_prepare_' . $postType, 'add_link_to_translations', 10, 3);
    }
}

function add_link_to_translations($response, $post, $request) {
    $mlp_language_api = apply_filters('mlp_language_api', NULL);
    if ($mlp_language_api === NULL) return $response; // do nothing if Multilingual Press is not enabled

    $translations = $mlp_language_api->get_translations([
        'content_id' => $post->ID,
        'include_base' => true,
        'type' => 'post',
    ]);
    $response->data['translations'] = array();
    $original_blog_id = get_current_blog_id();
    foreach ($translations as $t) {
        switch_to_blog($t->get_target_site_id());
        $response->data['translations'][$t->get_language()->get_name('lang')] = [
            'id' => $t->get_target_content_id(),
            'title' => $t->get_target_title(),
            'slug' => get_post_field('post_name', $t->get_target_content_id()),
        ];
    }
    switch_to_blog($original_blog_id);
    return $response;
}


/**
 * Add a custom REST route to get the list of all languages with their URL.
 */

add_action('rest_api_init', function() {
    $mlp_language_api = apply_filters('mlp_language_api', NULL);
    if ($mlp_language_api === NULL) return $response; // do nothing if Multilingual Press is not enabled

    register_rest_route(
        'custom/v1',
        'langs',
        [
            'method' => 'GET',
            'callback' => __NAMESPACE__.'\custom_get_langs',
        ]
    );
});

function custom_get_langs($request) {
    $mlp_language_api = apply_filters('mlp_language_api', NULL);

    $sites = array();
    foreach (get_sites() as $s) {
        $sites[] = [
            'url' => get_home_url($s->blog_id),
            'lang' => mlp_get_blog_language($s->blog_id),
        ];
    }
    return $sites;
}
