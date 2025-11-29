<?php
/**
 * Template Name: Check Settings
 */

get_header();

if (!current_user_can('manage_options')) {
    echo '<h1>Access Denied</h1>';
    get_footer();
    exit;
}

$settings = get_option('bh_theme_settings');
?>

<div style="padding: 40px; background: #fff; max-width: 1200px; margin: 100px auto;">
    <h1 style="color: #000;">Theme Settings Diagnostic</h1>

    <h2 style="color: #000;">Raw Data Structure:</h2>
    <pre style="background: #f5f5f5; padding: 20px; overflow: auto; color: #000; border: 1px solid #ddd;"><?php
    print_r($settings);
    ?></pre>

    <h2 style="color: #000;">Data Type:</h2>
    <p style="color: #000;"><strong><?php echo gettype($settings); ?></strong></p>

    <?php if (is_array($settings)): ?>
        <h2 style="color: #000;">Available Keys:</h2>
        <ul style="color: #000;">
            <?php foreach (array_keys($settings) as $key): ?>
                <li><strong><?php echo esc_html($key); ?></strong> (<?php echo count($settings[$key]); ?> fields)</li>
            <?php endforeach; ?>
        </ul>

        <h2 style="color: #000;">Sample Field Retrieval (front-page):</h2>
        <?php
        $fields = isset($settings['front-page']) ? $settings['front-page'] : [];
        ?>
        <p style="color: #000;">Found <?php echo count($fields); ?> fields for front-page</p>
        <?php if (!empty($fields)): ?>
            <pre
                style="background: #f5f5f5; padding: 20px; overflow: auto; color: #000; border: 1px solid #ddd;"><?php print_r(array_slice($fields, 0, 3)); ?></pre>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
get_footer();
