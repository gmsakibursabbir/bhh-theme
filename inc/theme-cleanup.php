// ============================================
// THEME CLEANUP ON DELETION
// ============================================

/**
* Clean up theme settings when theme is deleted
* This runs when the theme is deleted from Appearance > Themes
*/
add_action('delete_theme', 'bh_theme_cleanup_on_delete');

function bh_theme_cleanup_on_delete($stylesheet) {
// Only run cleanup for this specific theme
if ($stylesheet === 'business-hubs-theme') {
// Delete all theme settings
delete_option('bh_theme_settings');

// Log the cleanup (optional)
error_log('Business Hubs Theme: Settings cleaned up on theme deletion');
}
}