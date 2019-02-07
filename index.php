<?php
/**
 * This is a copy of WordPress' default index.php with the following changes:
 *  - ABSPATH is defined here instead of wp-config.php
 *  - WP_CONTENT_DIR is defined here instead of wp-config.php
 *  - wp-blog-header.php is located in the wordpress/ directory
 *
 * Defining some constants here allows for them not being added to wp-config.php,
 * thus making it so we don't have to either add them by default (and add the sample
 * config file to version control) or add instructions to add them in the README.
 */
define('WP_USE_THEMES', true);
define('ABSPATH', dirname(__FILE__) . '/wordpress/');
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
require( dirname( __FILE__ ) . '/wordpress/wp-blog-header.php' );
