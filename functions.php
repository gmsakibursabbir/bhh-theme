<?php

function boilerplate_load_assets()
{
    $script_asset = include(get_theme_file_path('/build/index.asset.php'));
    wp_enqueue_script('ourmainjs', get_theme_file_uri('/build/index.js'), $script_asset['dependencies'], $script_asset['version'], true);
    wp_enqueue_style('ourmaincss', get_theme_file_uri('/build/index.css'));

    // Localize script to expose REST API nonce
    wp_localize_script('ourmainjs', 'wpApiSettings', array(
        'root' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'boilerplate_load_assets');

// Include theme cleanup handler
require_once get_template_directory() . '/inc/theme-cleanup.php';

function boilerplate_add_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'boilerplate_add_support');

// Newsletter form handler
add_action('admin_post_nopriv_bh_newsletter_signup', 'bh_newsletter_signup_handler');
add_action('admin_post_bh_newsletter_signup', 'bh_newsletter_signup_handler');

function bh_newsletter_signup_handler()
{
    $referer = wp_get_referer() ? wp_get_referer() : home_url();

    // Nonce check
    if (!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'bh_newsletter_signup')) {
        error_log('BH Newsletter: nonce invalid or missing.');
        wp_safe_redirect(add_query_arg('newsletter', 'error', $referer));
        exit;
    }

    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $lastname = isset($_POST['lastname']) ? sanitize_text_field($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $note = isset($_POST['note']) ? sanitize_textarea_field($_POST['note']) : '';

    if (empty($email) || !is_email($email)) {
        error_log('BH Newsletter: invalid email provided: ' . maybe_serialize($email));
        wp_safe_redirect(add_query_arg('newsletter', 'invalid_email', $referer));
        exit;
    }

    // Destination
    $to = 'info@thebusinesshub.co.uk'; // change if needed

    // Combine full name for subject
    $fullName = trim($name . ' ' . $lastname);
    $subject = 'Newsletter signup: ' . ($fullName ?: $email);
    $message = '<h2>New newsletter signup</h2>';
    $message .= '<p><strong>First Name:</strong> ' . esc_html($name) . '</p>';
    if ($lastname) {
        $message .= '<p><strong>Last Name:</strong> ' . esc_html($lastname) . '</p>';
    }
    $message .= '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
    if ($note) {
        $message .= '<p><strong>Note:</strong><br>' . nl2br(esc_html($note)) . '</p>';
    }
    $message .= '<p style="font-size:12px;color:#666;"><small>IP: ' . esc_html($_SERVER['REMOTE_ADDR'] ?? '') . ' | Agent: ' . esc_html($_SERVER['HTTP_USER_AGENT'] ?? '') . '</small></p>';

    // From header — use site admin email or fallback to no-reply@your-domain
    $site_domain = preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']);
    $from_email = get_option('admin_email') ? sanitize_email(get_option('admin_email')) : 'no-reply@' . $site_domain;
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . 'No Reply <' . $from_email . '>'
    );

    // Add Reply-To only if submitted email is valid
    if (is_email($email)) {
        $safe_name = $name ? sanitize_text_field($name) : '';
        $reply_to = $safe_name ? $safe_name . ' <' . $email . '>' : $email;
        $headers[] = 'Reply-To: ' . $reply_to;
    }

    // Attempt to send
    $sent = false;
    try {
        $sent = wp_mail($to, $subject, $message, $headers);
    } catch (Exception $e) {
        error_log('BH Newsletter: wp_mail threw exception: ' . $e->getMessage());
        $sent = false;
    }

    // Debug log
    error_log(sprintf(
        "BH Newsletter: sent=%s, to=%s, from=%s, email=%s, name=%s, remote=%s",
        $sent ? 'true' : 'false',
        $to,
        $from_email,
        $email,
        $name,
        $_SERVER['REMOTE_ADDR'] ?? ''
    ));

    $redirect = add_query_arg('newsletter', $sent ? 'success' : 'error', $referer);
    wp_safe_redirect($redirect);
    exit;
}
// temp admin test - add near your other code (remove after testing)
add_action('admin_post_bh_email_test', function () {
    if (!current_user_can('manage_options'))
        wp_die('no');
    $ok = wp_mail(get_option('admin_email'), 'WP Mail Test', 'This is a test email from WP.');
    var_dump($ok); // shows true/false in browser
    exit;
});
// facions
function bh_add_favicons()
{
    $settings = get_option('bh_theme_settings');
    $favicon_url = '';
    if (isset($settings['general']) && is_array($settings['general'])) {
        foreach ($settings['general'] as $field) {
            if ($field['name'] === 'site_favicon') {
                $favicon_url = $field['value'];
                break;
            }
        }
    }

    if ($favicon_url) {
        echo '<link rel="icon" href="' . esc_url($favicon_url) . '" sizes="any">' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_url) . '">' . "\n";
    } else {
        // Fallback to theme assets
        $theme_uri = get_template_directory_uri() . '/assets/icons/';
        ?>
        <link rel="icon" href="<?php echo esc_url($theme_uri . 'favicon.ico'); ?>" sizes="any">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url($theme_uri . 'favicon-32x32.png'); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url($theme_uri . 'favicon-16x16.png'); ?>">
        <link rel="apple-touch-icon" href="<?php echo esc_url($theme_uri . 'apple-touch-icon.png'); ?>">
        <link rel="manifest" href="<?php echo esc_url($theme_uri . 'site.webmanifest'); ?>">
        <?php
    }
}
add_action('wp_head', 'bh_add_favicons');


// Splide.js integration
function bh_enqueue_splide_assets()
{
    // Splide CSS/JS from CDN (or copy locally)
    wp_enqueue_style('splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css', array(), '4.1.3');
    wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js', array(), '4.1.3', true);

    // Add AutoScroll Extension
    wp_enqueue_script('splide-auto-scroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array('splide-js'), '0.5.3', true);

    // Your init script (Added splide-auto-scroll as a dependency)
    wp_enqueue_script('bh-splide-init', get_template_directory_uri() . '/src/scripts/splide-init.js', array('splide-js', 'splide-auto-scroll'), filemtime(get_template_directory() . '/src/scripts/splide-init.js'), true);

    // NEW: Load your main theme script (theme.js)
    wp_enqueue_script('bh-theme-js', get_template_directory_uri() . '/src/scripts/theme.js', array(), filemtime(get_template_directory() . '/src/scripts/theme.js'), true);
}
add_action('wp_enqueue_scripts', 'bh_enqueue_splide_assets');

require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme Settings.
 */
require get_template_directory() . '/inc/theme-settings.php';

// ----------------------------------------------------------------
// QUOTE FORM HANDLER
// ----------------------------------------------------------------
add_action('admin_post_nopriv_bh_quote_form_submission', 'bh_quote_form_handler');
add_action('admin_post_bh_quote_form_submission', 'bh_quote_form_handler');

function bh_quote_form_handler()
{
    // 1. Security Check
    if (!isset($_POST['quote_nonce']) || !wp_verify_nonce($_POST['quote_nonce'], 'bh_quote_nonce')) {
        wp_die('Security check failed');
    }

    // 2. Sanitize Input Data
    $handsets = sanitize_text_field($_POST['handsets_count'] ?? '');
    $contract = sanitize_text_field($_POST['contract_expiry'] ?? '');
    $biz_type = sanitize_text_field($_POST['business_type'] ?? '');
    $biz_name = sanitize_text_field($_POST['business_name'] ?? '');
    $postcode = sanitize_text_field($_POST['postcode'] ?? '');
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['business_email'] ?? '');
    $phone = sanitize_text_field($_POST['contact_number'] ?? '');

    // 3. Prepare Email
    $to = 'info@thebusinesshub.co.uk'; // Or get_option('admin_email');
    $subject = 'New Quote Request from ' . $biz_name;

    $message = "<h2>New Quote Request</h2>";
    $message .= "<p><strong>Business Name:</strong> $biz_name</p>";
    $message .= "<p><strong>Contact Name:</strong> $first_name $last_name</p>";
    $message .= "<p><strong>Email:</strong> $email</p>";
    $message .= "<p><strong>Phone:</strong> $phone</p>";
    $message .= "<p><strong>Postcode:</strong> $postcode</p>";
    $message .= "<hr>";
    $message .= "<h3>Requirements:</h3>";
    $message .= "<p><strong>Handsets Required:</strong> $handsets</p>";
    $message .= "<p><strong>Contract Expiry:</strong> $contract</p>";
    $message .= "<p><strong>Business Type:</strong> $biz_type</p>";

    $headers = array('Content-Type: text/html; charset=UTF-8');

    // 4. Send Email
    wp_mail($to, $subject, $message, $headers);

    // 5. Redirect to Thank You Page
    // Make sure you create a page with slug 'thank-you'
    wp_redirect(home_url('/thank-you'));
    exit;
}

/* -------------------------------------------------------------------------- */
/* 1. QUOTE FORM SHORTCODE
/* -------------------------------------------------------------------------- */
function bh_quote_form_shortcode()
{
    // This div is where the React app will mount
    return '<div id="multi-step-quote-form"></div>';
}
add_shortcode('quote_form', 'bh_quote_form_shortcode');


/* -------------------------------------------------------------------------- */
/* 2. HANDLE QUOTE SUBMISSION (REST API)
/* -------------------------------------------------------------------------- */
add_action('rest_api_init', function () {
    register_rest_route('bh/v1', '/submit-quote', array(
        'methods' => 'POST',
        'callback' => 'bh_handle_quote_submission',
        'permission_callback' => '__return_true', // Allow public access
    ));
});

function bh_handle_quote_submission($request)
{
    $params = $request->get_json_params();

    // 1. Sanitize Data
    $handsets = sanitize_text_field($params['handsets'] ?? '');
    $contract = sanitize_text_field($params['contract'] ?? '');
    $businessType = sanitize_text_field($params['businessType'] ?? '');
    $businessName = sanitize_text_field($params['businessName'] ?? '');
    $postcode = sanitize_text_field($params['postcode'] ?? '');
    $firstName = sanitize_text_field($params['firstName'] ?? '');
    $lastName = sanitize_text_field($params['lastName'] ?? '');
    $email = sanitize_email($params['email'] ?? '');
    $phone = sanitize_text_field($params['phone'] ?? '');

    // 2. Validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }

    // 3. Prepare Email
    $to = 'info@thebusinesshub.co.uk'; // Same as newsletter form
    $subject = "New Quote Request from $firstName $lastName";

    $message = "New Quote Request Details:\n\n";
    $message .= "--- Requirements ---\n";
    $message .= "Handsets/SIMs: $handsets\n";
    $message .= "Contract Expiry: $contract\n";
    $message .= "Business Type: $businessType\n\n";

    $message .= "--- Business Info ---\n";
    $message .= "Business Name: $businessName\n";
    $message .= "Postcode: $postcode\n\n";

    $message .= "--- Contact Info ---\n";
    $message .= "Name: $firstName $lastName\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    // 4. Send Email
    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        // Return success and the URL to redirect to
        return new WP_REST_Response(array(
            'success' => true,
            'redirect_url' => home_url('/thank-you') // Make sure this page exists!
        ), 200);
    } else {
        return new WP_Error('email_failed', 'Failed to send email.', array('status' => 500));
    }
}