<?php

//Variables
global $wpdb;

// check user capabilities
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

//Get the active tab from the $_GET param
$default_tab = null;
$tab         = isset( $_GET['tab'] ) ? $_GET['tab'] : $default_tab;
?>
<div class="klen-admin">
    <div class="klen-admin__main">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php
		if ( ! empty( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'klen_messages', 'klen_message', __( 'Settings Saved', 'klen' ), 'updated' );
		}
		?>
        <nav class="nav-tab-wrapper" id="tabs">
            <a href="?page=klen_admin_page"
               class="nav-tab <?php if ( $tab === null ): ?>nav-tab-active<?php endif; ?>"><?= __( 'Main settings', 'klen' ); ?></a>

            <a href="?page=klen_admin_page&tab=labels"
               class="nav-tab <?php if ( $tab === 'labels' ): ?>nav-tab-active<?php endif; ?>"><?= __( 'Labels', 'klen' ); ?></a>

            <a href="?page=klen_admin_page&tab=appearance"
               class="nav-tab <?php if ( $tab === 'appearance' ): ?>nav-tab-active<?php endif; ?>"><?= __( 'Appearance', 'klen' ); ?></a>
        </nav>

        <div class="tab-labels">
			<?php switch ( $tab ) :
				case 'labels':
					echo '<form action="options.php" method="post">';
					settings_fields( 'klen_labels' );
					do_settings_sections( 'klen_labels' );
					submit_button( __( 'Save labels', 'klen' ) );
					echo '</form>';
					break;
				case 'appearance':
					echo '<form action="options.php" method="post">';
					settings_fields( 'klen_appearance' );
					do_settings_sections( 'klen_appearance' );
					submit_button( __( 'Save appearance', 'klen' ) );
					echo '</form>';
					break;
				default:
					echo '<form action="' . esc_url( admin_url( 'options-general.php?page=klen_admin_page' ) ) . '" method="post">';
					settings_fields( 'klen_main' );
					do_settings_sections( 'klen_main' );
					submit_button( __( 'Save settings', 'klen' ) );
					echo '<input type="hidden" name="klen_form_submission" value="1">';
					echo '</form>';
					break;
			endswitch; ?>
        </div>

        <div class="klen-admin__shortcode">
            <h3><?= __( 'Shortcode preview:', 'klen' ); ?> [ecomail-newsletter]</h3>
			<?= do_shortcode( '[ecomail-newsletter]' ); ?>
        </div>
    </div>

    <div class="klen-admin__aside">
        <div class="klen-admin__aside-wrapper">
            <h3><?php _e( 'How to get the API key?', 'klen' ); ?></h3>

            <p><?php _e( 'Just log into the Ecomail administration on <a href="https://www.ecomail.cz/" target="_blank" rel="nofollow noopener noreferrer">Ecomail.cz</a>, click on your account/email in the upper right corner and select <strong>Manage your account</strong>. Then just select <strong>Integration</strong> in the left panel and copy API key.', 'klen' ); ?></p>

            <p><?php _e( 'The <strong>List ID</strong> is always 1 by default. If you want to select a different list, you can find its ID in the URL in the Ecomail administration.', 'klen' ); ?></p>

            <h3><?php _e( 'How to display the form?', 'klen' ); ?></h3>

            <p><?php _e( 'The form is displayed through a shortcode. You can use this piece of code anywhere on the web, especially in text blocks or WYSIWYG editors. You can use two shortcodes:<br><br><strong style="color: rgb(71, 173, 0);">[ecomail-newsletter]</strong><br>Displays the newsletter subscription form and allows you to select the align parameter. The choices are "left", "center" or "right. The resulting code looks like [ecomail-newsletter align="right"].<br><br><strong style="color: rgb(71, 173, 0);">[ecomail-subscribers]</strong><br>Displays the number of subscribed subscribers and you can select the style parameter. You can choose between "bold" or "italic". The resulting code looks like [ecomail-subscribers style="bold"].', 'klen' ); ?></p>

            <h3><?php _e( 'Support', 'klen' ); ?></h3>

            <p><?php _e( 'In case of any problems, please add "New issue" to our <a href="https://github.com/dankoch-cz/ecomail-newsletter/issues" target="_blank" rel="nofollow noopener noreferrer">GitHub repository</a>.', 'klen' ); ?></p>
        </div>
    </div>
</div>
