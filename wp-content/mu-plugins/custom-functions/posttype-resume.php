<?php
/*
 * Post type dedicated to resumes
 */

add_action('init', 'posttype_resumes_init');
function posttype_resumes_init() {
    register_post_type('resumes', [
        'labels' => [
            'name' => __('Resumes', 'resume'),
            'singular_name' => __('Resume', 'resume'),
        ],
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-document',
        'supports' => array('title'),
    ]);
    add_filter('rest_prepare_resumes', 'add_link_to_translations', 10, 3);
}

add_action('cmb2_init', 'posttype_resumes_cmb2');
function posttype_resumes_cmb2() {
    $prefix = 'resume_';

    $cmbResumeBox = new_cmb2_box([
        'id' => 'resume',
        'title' => __('Resume', 'resume'),
        'object_types' => [ 'resumes' ],
        'show_names' => true,
        'show_in_rest' => WP_REST_Server::READABLE,
    ]);

    // Basic information
    $cmbInfoBox = $cmbResumeBox->add_field([
        'id' => $prefix . 'info',
        'type' => 'group',
        'title' => __('Basic information', 'resume'),
        'repeatable' => false,
        'options' => [
            'group_title' => __('Basic information', 'resume'),
        ]
    ]);

    $cmbResumeBox->add_group_field($cmbInfoBox, [
        'id' => 'website',
        'name' => __('Website', 'resume'),
        'type' => 'text_url',
    ]);

    $cmbResumeBox->add_group_field($cmbInfoBox, [
        'id' => 'github',
        'name' => __('GitHub username', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbInfoBox, [
        'id' => 'birthdate',
        'name' => __('Birth date', 'resume'),
        'type' => 'text_date',
        'attributes' => [
            'data-datepicker' => json_encode([
                'yearRange' => '-50:+0'
            ]),
        ],
    ]);

    $cmbResumeBox->add_group_field($cmbInfoBox, [
        'id' => 'drivers_license',
        'name' => __('Driver\'s license', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbInfoBox, [
        'id' => 'location',
        'name' => __('Location', 'resume'),
        'type' => 'text',
    ]);

    // Education & diplomas
    $cmbResumeBox->add_field([
        'id' => 'title_diplomas',
        'type' => 'title',
        'name' => __('Diplomas', 'resume'),
    ]);

    $cmbDiplomasGroup = $cmbResumeBox->add_field([
        'id' => 'diplomas',
        'type' => 'group',
        'title' => __('Education', 'resume'),
        'repeatable' => true,
        'options' => [
            'group_title' => 'Diploma {#}',
            'sortable' => true,
        ],
    ]);

    $cmbResumeBox->add_group_field($cmbDiplomasGroup, [
        'id' => 'title',
        'name' => __('Title', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbDiplomasGroup, [
        'id' => 'location',
        'name' => __('Location', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbDiplomasGroup, [
        'id' => 'start_year',
        'name' => __('Start year', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbDiplomasGroup, [
        'id' => 'end_year',
        'name' => __('End year', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbDiplomasGroup, [
        'id' => 'document',
        'name' => __('Document', 'resume'),
        'type' => 'file',
        'options' => [
            'url' => false,
        ],
        'query_args' => [
            'type' => 'application/pdf',
        ]
    ]);

    // Certifications
    $cmbResumeBox->add_field([
        'id' => 'title_certifications',
        'type' => 'title',
        'name' => __('Certifications', 'resume'),
    ]);

    $cmbCertsGroup = $cmbResumeBox->add_field([
        'id' => 'certifications',
        'type' => 'group',
        'title' => __('Certifications', 'resume'),
        'repeatable' => true,
        'options' => [
            'group_title' => 'Certification {#}',
            'sortable' => true,
        ],
    ]);

    $cmbResumeBox->add_group_field($cmbCertsGroup, [
        'id' => 'name',
        'name' => __('Name', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbCertsGroup, [
        'id' => 'year',
        'name' => __('Year', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbCertsGroup, [
        'id' => 'end_year',
        'name' => __('End year', 'resume'),
        'type' => 'text',
    ]);

    $cmbResumeBox->add_group_field($cmbCertsGroup, [
        'id' => 'document',
        'name' => __('Document', 'resume'),
        'type' => 'file',
        'options' => [
            'url' => false,
        ],
        'query_args' => [
            'type' => 'application/pdf',
        ]
    ]);

    // Career
    $cmbResumeBox->add_field([
        'id' => 'title_career',
        'type' => 'title',
        'name' => __('Career', 'resume'),
    ]);

    $cmbJobsGroup = $cmbResumeBox->add_field([
        'id' => 'jobs',
        'type' => 'group',
        'title' => __('Career', 'resume'),
        'repeatable' => true,
        'options' => [
            'group_title' => 'Job {#}',
            'sortable' => true,
        ],
    ]);

    $cmbResumeBox->add_group_field($cmbJobsGroup, [
        'id' => 'title',
        'name' => __('Job title', 'resume'),
        'type' => 'text'
    ]);

    $cmbResumeBox->add_group_field($cmbJobsGroup, [
        'id' => 'company',
        'name' => __('Company', 'resume'),
        'type' => 'text'
    ]);

    $cmbResumeBox->add_group_field($cmbJobsGroup, [
        'id' => 'company_website',
        'name' => __('Company website', 'resume'),
        'type' => 'text_url'
    ]);

    $cmbResumeBox->add_group_field($cmbJobsGroup, [
        'id' => 'date_range',
        'name' => __('Date range', 'resume'),
        'type' => 'text'
    ]);

    $cmbResumeBox->add_group_field($cmbJobsGroup, [
        'id' => 'description',
        'name' => __('Description', 'resume'),
        'type' => 'textarea'
    ]);

    // Skills
    $cmbResumeBox->add_field([
        'id' => 'title_skills',
        'type' => 'title',
        'name' => __('Skills', 'resume'),
    ]);

    $cmbSkillsGroup = $cmbResumeBox->add_field([
        'id' => 'skills',
        'type' => 'group',
        'title' => __('Skills', 'resume'),
        'repeatable' => true,
        'options' => [
            'group_title' => 'Category {#}',
            'sortable' => true,
        ],
    ]);

    $cmbResumeBox->add_group_field($cmbSkillsGroup, [
        'id' => 'title',
        'name' => __('Title', 'resume'),
        'type' => 'text'
    ]);

    $cmbResumeBox->add_group_field($cmbSkillsGroup, [
        'id' => 'description',
        'name' => __('Description', 'resume'),
        'type' => 'textarea'
    ]);
}
