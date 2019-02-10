<?php
/*
 * Plugin Name: Custom Functions
 * Plugin URI: https://github.com/adrillon/website-wordpress
 * Description: Special features of my website
 * Version: 1.0
 * Author: Alain DRILLON
 * Author URI: https://drillon-ala.in
 * License: GPL2
 */

$customFunctionsDir = dirname(__FILE__) . '/custom-functions';
if (is_dir($customFunctionsDir)) {
    foreach (scandir($customFunctionsDir) as $file) {
        if (in_array($file, ['.', '..'])) continue;

        require_once($customFunctionsDir . '/' . $file);
    }
}
