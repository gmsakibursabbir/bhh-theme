<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

$settings = get_option('bh_theme_settings');
echo '<pre>';
print_r($settings);
echo '</pre>';
