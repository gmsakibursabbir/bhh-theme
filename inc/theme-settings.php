<?php
/**
 * BH Theme Settings
 *
 * @package BusinessHubsTheme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register the menu page.
 */
function bh_add_theme_settings_page()
{
    add_menu_page(
        'BH Theme Settings',
        'BH Settings',
        'manage_options',
        'bh-theme-settings',
        'bh_render_theme_settings_page',
        'dashicons-admin-generic',
        60
    );
}
add_action('admin_menu', 'bh_add_theme_settings_page');

/**
 * Enqueue scripts and styles.
 */
function bh_theme_settings_scripts($hook)
{
    if ('toplevel_page_bh-theme-settings' !== $hook) {
        return;
    }
    wp_enqueue_media();

    // Enqueue our settings styles
    wp_enqueue_style(
        'bh-theme-settings-style',
        get_template_directory_uri() . '/inc/theme-settings-style.css',
        array(),
        filemtime(get_template_directory() . '/inc/theme-settings-style.css')
    );

    // Enqueue our settings script
    wp_enqueue_script(
        'bh-theme-settings-script',
        get_template_directory_uri() . '/inc/theme-settings-script.js',
        array(),
        filemtime(get_template_directory() . '/inc/theme-settings-script.js'),
        true
    );

    // Pass current settings to JavaScript
    $current_settings = get_option('bh_theme_settings', array());
    wp_localize_script('bh-theme-settings-script', 'bhThemeSettings', $current_settings);
}
add_action('admin_enqueue_scripts', 'bh_theme_settings_scripts');

/**
 * Render the settings page.
 */
function bh_render_theme_settings_page()
{
    // Handle Save
    if (isset($_POST['bh_save_settings']) && check_admin_referer('bh_save_settings_nonce', 'bh_save_settings_nonce_field')) {
        $settings = isset($_POST['bh_settings']) ? json_decode(stripslashes($_POST['bh_settings']), true) : array();
        update_option('bh_theme_settings', $settings);
        echo '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
    }

    // Handle Import
    if (isset($_POST['bh_import_settings']) && check_admin_referer('bh_import_settings_nonce', 'bh_import_settings_nonce_field')) {
        $json_content = '';

        // Check for file upload
        if (isset($_FILES['bh_import_file']) && $_FILES['bh_import_file']['error'] === UPLOAD_ERR_OK) {
            $json_content = file_get_contents($_FILES['bh_import_file']['tmp_name']);
        }
        // Fallback to textarea
        elseif (isset($_POST['bh_import_json']) && !empty($_POST['bh_import_json'])) {
            $json_content = stripslashes($_POST['bh_import_json']);
        }

        if (!empty($json_content)) {
            $imported_settings = json_decode($json_content, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($imported_settings)) {
                update_option('bh_theme_settings', $imported_settings);
                echo '<div class="notice notice-success is-dismissible"><p>Settings imported successfully!</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Invalid JSON format.</p></div>';
            }
        } else {
            echo '<div class="notice notice-warning is-dismissible"><p>Please provide JSON content or upload a file.</p></div>';
        }
    }

    $current_settings = get_option('bh_theme_settings', array());

    // Get only pages with custom templates (cleaner, like ACF)
    $template_pages = array();
    $all_pages = get_pages(array('post_status' => 'publish'));

    foreach ($all_pages as $page) {
        $template = get_post_meta($page->ID, '_wp_page_template', true);
        if ($template && $template !== 'default') {
            // Exclude special templates we already hardcoded
            if (strpos($template, 'business-mobile') !== false || strpos($template, 'front-page') !== false) {
                continue;
            }

            $template_name = str_replace(array('page-', '.php'), '', basename($template));
            $template_pages[] = array(
                'id' => $page->ID,
                'title' => $page->post_title,
                'template' => ucwords(str_replace('-', ' ', $template_name))
            );
        }
    }
    $active_tab = isset($_POST['bh_active_tab']) ? sanitize_text_field($_POST['bh_active_tab']) : 'general';
    $active_page = isset($_POST['bh_active_page']) ? sanitize_text_field($_POST['bh_active_page']) : '';
    ?>
    <div class="wrap bh-wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
        <hr class="wp-header-end">

        <div class="nav-tab-wrapper bh-nav-tab-wrapper">
            <a href="#general" class="nav-tab <?php echo $active_tab === 'general' ? 'nav-tab-active' : ''; ?>"
                data-tab="general">
                <span class="dashicons dashicons-admin-site-alt3"></span> General
            </a>
            <a href="#pages" class="nav-tab <?php echo $active_tab === 'pages' ? 'nav-tab-active' : ''; ?>"
                data-tab="pages">
                <span class="dashicons dashicons-layout"></span> Pages
            </a>
            <a href="#tools" class="nav-tab <?php echo $active_tab === 'tools' ? 'nav-tab-active' : ''; ?>"
                data-tab="tools">
                <span class="dashicons dashicons-admin-tools"></span> Tools
            </a>
        </div>

        <div class="bh-settings-container">
            <div class="bh-main-settings">
                <form method="post" id="bh-settings-form">
                    <?php wp_nonce_field('bh_save_settings_nonce', 'bh_save_settings_nonce_field'); ?>
                    <input type="hidden" name="bh_settings" id="bh_settings_input">
                    <input type="hidden" name="bh_active_tab" id="bh_active_tab"
                        value="<?php echo esc_attr($active_tab); ?>">
                    <input type="hidden" name="bh_active_page" id="bh_active_page"
                        value="<?php echo esc_attr($active_page); ?>">

                    <!-- General Tab -->
                    <div id="tab-general" class="bh-tab-content <?php echo $active_tab === 'general' ? 'active' : ''; ?>">
                        <div class="card bh-card">
                            <div class="bh-card-header">
                                <div>
                                    <h2>General Site Settings</h2>
                                    <p class="description">Site Logo and Favicon settings.</p>
                                </div>
                                <!-- Fixed fields only, no add button -->
                            </div>

                            <div id="bh-general-fields-container" class="bh-fields-area">
                                <!-- General fields will be rendered here via JS -->
                            </div>
                        </div>
                    </div>

                    <!-- Pages Tab -->
                    <div id="tab-pages" class="bh-tab-content <?php echo $active_tab === 'pages' ? 'active' : ''; ?>">
                        <div class="card bh-card">
                            <div class="bh-card-header bh-controls">
                                <div class="bh-control-group">
                                    <label for="bh-page-selector">Select Template:</label>
                                    <div class="bh-select-wrapper">
                                        <select id="bh-page-selector">
                                            <option value="">-- Choose a Template to Edit --</option>

                                            <optgroup label="Special Templates">
                                                <option value="front-page" <?php selected($active_page, 'front-page'); ?>>🏠 Front Page (Home)</option>
                                                <option value="business-mobile" <?php selected($active_page, 'business-mobile'); ?>>📱 Business Mobile Page</option>
                                            </optgroup>

                                            <?php if (!empty($template_pages)): ?>
                                                <optgroup label="Custom Page Templates">
                                                    <?php foreach ($template_pages as $tpl_page): ?>
                                                        <option value="<?php echo esc_attr($tpl_page['id']); ?>" <?php selected($active_page, $tpl_page['id']); ?>>
                                                            <?php echo esc_html($tpl_page['title']); ?>
                                                            (<?php echo esc_html($tpl_page['template']); ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="button button-primary" id="bh-add-field">
                                    <span class="dashicons dashicons-plus-alt2"></span> Add Field
                                </button>
                            </div>

                            <div id="bh-fields-container" class="bh-fields-area">
                                <div class="bh-empty-state">
                                    <span class="dashicons dashicons-arrow-up-alt"></span>
                                    <p>Select a template above to start managing fields.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tools Tab -->
                    <div id="tab-tools" class="bh-tab-content">
                        <div class="card bh-card">
                            <div class="bh-card-header">
                                <h2>Import / Export</h2>
                                <p class="description">Backup your settings or transfer them to another site.</p>
                            </div>
                            <div class="bh-tools-content">
                                <div class="bh-tool-section">
                                    <h3>Export Settings</h3>
                                    <p>Download a JSON file of all your current theme settings.</p>
                                    <button type="button" class="button button-secondary" id="bh-export-btn">
                                        <span class="dashicons dashicons-download"></span> Export JSON
                                    </button>
                                </div>
                                <hr>
                                <div class="bh-tool-section">
                                    <h3>Import Settings</h3>
                                    <p>Paste the JSON content below to import settings.</p>
                                    <!-- Import Form is separate to avoid nesting forms, handled via JS/AJAX ideally but here we use main form submission or separate -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="submit sticky-submit">
                        <button type="submit" name="bh_save_settings" class="button button-primary button-large">
                            <span class="dashicons dashicons-saved"></span> Save Changes
                        </button>
                    </p>
                </form>

                <!-- Import Form (Moved to Tools Tab visually, but structurally separate for logic) -->
                <div id="bh-import-container" style="display:none;">
                    <form method="post" class="bh-import-form" enctype="multipart/form-data">
                        <?php wp_nonce_field('bh_import_settings_nonce', 'bh_import_settings_nonce_field'); ?>

                        <p>
                            <label for="bh_import_file"><strong>Upload JSON File:</strong></label><br>
                            <input type="file" name="bh_import_file" id="bh_import_file" accept=".json">
                        </p>

                        <p><strong>Or paste JSON content:</strong></p>
                        <textarea name="bh_import_json" rows="5" class="large-text code"
                            placeholder='Paste JSON here...'></textarea>
                        <p>
                            <button type="submit" name="bh_import_settings" class="button button-secondary">
                                <span class="dashicons dashicons-upload"></span> Import Settings
                            </button>
                        </p>
                    </form>
                </div>
            </div>

            <div class="bh-code-preview">
                <div class="card">
                    <h2>Generated Code</h2>
                    <p class="description">Copy this PHP code snippet to your theme template file.</p>

                    <div class="bh-code-tabs">
                        <button type="button" class="active" data-view="all">All Fields</button>
                        <button type="button" data-view="single">Selected Field</button>
                    </div>

                    <textarea id="bh-code-output" rows="20" readonly class="large-text code"></textarea>
                    <p>
                        <button type="button" class="button button-small" id="bh-copy-code">
                            <span class="dashicons dashicons-clipboard" style="margin-top: 3px;"></span> Copy Code
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
}
