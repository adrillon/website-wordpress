# WordPress Resume

This repository contains the source code for the headless WordPress backend I use for [my resume](https://drillon-ala.in).

## How to install

1. `composer install`
2. `cp wordpress/wp-config-sample.php wp-config.php`
3. Edit `wp-config.php` with your database information and [your secret keys](https://api.wordpress.org/secret-key/1.1/salt/)
4. Still in `wp-config.php`, add `define('WP_CONTENT_URL', 'http://<your-site-url>/wp-content');` at the beginning of the file and replace `<your-site-url>` with the URL that points to this directory
4. Go to the URL that points to this folder and install Wordpress normally
5. Once logged into WordPress' back-office, go to *Settings → General* and remove `/wordpress` at the end of *Site Address (URL)*
