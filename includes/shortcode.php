<?php

/**
 * Class for the ecomail-newsletter shortcode.
 */
class KLEN_Ecomail_Shortcode
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_shortcode('ecomail-newsletter', array($this, 'shortcode'));
    }

    /**
     * Callback function for the ecomail-newsletter shortcode.
     *
     * @param array $atts Shortcode attributes.
     *
     * @return string Shortcode output.
     */
    public function shortcode()
    {

        // Get the API key and list ID from the options.
        $api_key = get_option('klen_api_key');
        $list_id = get_option('klen_list_id');

        // Check if the API key and list ID are set.
        if (empty($api_key) || empty($list_id)) {
            return __('Ecomail Newsletter plugin is not configured correctly. Please check the API key and list ID settings.', 'klen_admin');
        }

        $style = get_option('klen_design_style');

        if (empty($style) || $style == 'default') {
            //Enqueue styles
            wp_enqueue_style('klen_form');
        }

        //Enqueue scripts
        wp_enqueue_script('klen_form');

        // Get the content from the options.
        $title = get_option('klen_content_title', __('Subscribe to our newsletter', 'klen_admin'));
        $description = get_option('klen_content_desc', '');
        $label = get_option('klen_content_label', __('Your email address', 'klen_admin'));
        $placeholder = get_option('klen_content_placeholder', '');
        $button_text = get_option('klen_content_button', __('Subscribe', 'klen_admin'));
        $success_message = get_option('klen_content_success', __('Thank you for subscribing!', 'klen_admin'));
        $error_message = get_option('klen_content_error', __('There was an error processing your request.', 'klen_admin'));
        $warning_message = get_option('klen_content_warning', 'Something happened, try again.');

        ob_start(); ?>
        <div class="klen klen_left klen_background">
            <div class="klen__wrapper">
                <div class="klen__text">
                    <h3><?= $title; ?></h3>
                    <?php if (!empty($description)) {
                        echo ' <p>' . $description . '</p>';
                    } ?>
                </div>
                <form class="klen__form" id="klen-ecomail-form"
                      method="POST">
                    <div class="klen__form-field klen__form-field_email klen__form-field_required">
                        <label for="klen_email"><?= $label; ?></label>
                        <input id="klen_email" type="email" name="email" placeholder="<?= $placeholder; ?>" required>
                    </div>

                    <div class="klen__form-field klen__form-field_submit">
                        <input type="submit" value="<?= $button_text; ?>">
                    </div>
                </form>

                <div class="klen__alerts">
                    <div class="klen__alert klen__alert_success" id="klen_success">
                        <p><?= $success_message; ?></p>
                    </div>

                    <div class="klen__alert klen__alert_error" id="klen_error">
                        <p><?= $error_message; ?></p>
                    </div>

                    <div class="klen__alert klen__alert_warning" id="klen_warning">
                        <p><?= $warning_message; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php return ob_get_clean();

    }
}

new KLEN_Ecomail_Shortcode();