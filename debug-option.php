<?php
// Load WordPress environment
// We are in wp-content/themes/business-hubs-theme/
// So wp-load.php is in ../../../
require_once(dirname(__FILE__) . '/../../../wp-load.php');

$settings = get_option('bh_theme_settings');
echo "Type: " . gettype($settings) . "\n";
print_r($settings);
