<?php
/**
 * Fired when the theme is deleted.
 *
 * @package BusinessHubsTheme
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete the theme settings option.
delete_option('bh_theme_settings');
