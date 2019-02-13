# WordPress Resume

This repository contains the source code for the headless WordPress backend I use for [my resume](https://drillon-ala.in).

## How to install

1. `composer install`
2. `cp wordpress/wp-config-sample.php wp-config.php`
3. Edit `wp-config.php` with your database information and [your secret keys](https://api.wordpress.org/secret-key/1.1/salt/)
4. Still in `wp-config.php`, add `define('WP_PLUGIN_DIR', dirname(__FILE__) . '/wp-content/plugins');`
5. Go to the URL that points to this folder and install Wordpress normally
6. Once logged into WordPress' admin area, go to *Settings → General* and remove `/wordpress` at the end of *Site Address (URL)*
7. Enable all plugins

The site is now up and running. If you want to enable multilingual support, do the following:
1. In `wp-config.php`, add `define('WP_ALLOW_MULTISITE', true);`
2. In WordPress' admin area, go to *Tools → Network Setup* and create a network
3. Follow the instructions to edit `wp-config.php` and `.htaccess`
4. In the network's admin area, enable all plugins
5. Create one site per language and configure Multilingual Press with all desired languages
