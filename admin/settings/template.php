<?php

//Variables
global $wpdb;

// check user capabilities
if (!current_user_can('manage_options')) {
    return;
}

//Get the active tab from the $_GET param
$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>
<div class="klen-admin">
    <div class="klen-admin__main">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php
        if (!empty($_GET['settings-updated'])) {
            // add settings saved message with the class of "updated"
            add_settings_error('klen_messages', 'klen_message', __('Settings Saved', 'klen'), 'updated');
        }
        ?>
        <nav class="nav-tab-wrapper" id="tabs">
            <a href="?page=klen_admin_page"
               class="nav-tab <?php if ($tab === null): ?>nav-tab-active<?php endif; ?>"><?= __('General settings', 'klen_admin'); ?></a>

            <a href="?page=klen_admin_page&tab=content"
               class="nav-tab <?php if ($tab === 'content'): ?>nav-tab-active<?php endif; ?>"><?= __('Content', 'klen_admin'); ?></a>

            <a href="?page=klen_admin_page&tab=design"
               class="nav-tab <?php if ($tab === 'design'): ?>nav-tab-active<?php endif; ?>"><?= __('Design', 'klen_admin'); ?></a>
        </nav>

        <div class="tab-content">
            <?php switch ($tab) :
                case 'content':
                    echo '<form action="options.php" method="post">';
                    settings_fields('klen_content');
                    do_settings_sections('klen_content');
                    submit_button(__('Save settings', 'klen_admin'));
                    echo '</form>';
                    break;
                case 'design':
                    echo '<form action="options.php" method="post">';
                    settings_fields('klen_design');
                    do_settings_sections('klen_design');
                    submit_button(__('Save settings', 'klen_admin'));
                    echo '</form>';
                    break;
                default:
                    echo '<form action="options.php" method="post">';
                    settings_fields('klen_general');
                    do_settings_sections('klen_general');
                    submit_button(__('Save settings', 'klen_admin'));
                    echo '</form>';
                    break;
            endswitch; ?>
        </div>

        <div class="klen-admin__shortcode">
            <h3><?= __('Preview of:', 'klen_admin'); ?> [ecomail-newsletter]</h3>
            <?= do_shortcode('[ecomail-newsletter]'); ?>
        </div>
    </div>

    <div class="klen-admin__aside">
        <div id="dashboard-widgets" class="metabox-holder">
            <div id="postbox-container-1" class="postbox-container">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="metabox" class="postbox">
                        <h2 class="hndle ui-sortable-handle"><span>Reklama</span></h2>

                        <div class="inside">
                            <div class="main">
                                <p><strong>Dummy metabox</strong></p>

                                <p>
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.
                                    The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
                                    letters, as opposed to using 'Content here,
                                    content here', making it look like readable English.
                                </p>

                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for
                                    'lorem ipsum' will uncover many web sites still in their infancy. Various versions
                                    have evolved over the years, by accident.
                                </p>

                                <p><a class="button button-primary">Donate</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
