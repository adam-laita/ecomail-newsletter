<?php

	/* ------------------------------ SHORTCODES ------------------------------ */

	// Adds shortcode with form for Ecomail subscribers.
	add_shortcode( 'ecomail-newsletter', 'klen_form' );

	function klen_form() {
		//wp_enqueue_style( 'klen_form' );

		ob_start();

		?>
			<div class="klen">
				<div class="klen__text">
					Připojte se mezi <strong>XXX</strong> přihlášených odběratelů.
				</div>

				<form class="klen__form" id="klen_email_subscribe" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="POST" _lpchecked="1">
					<input type="hidden" name="action" value="add_subscriber_email">

					<div class="klen__form-field klen__form-field_email">
						<label for="klen_email">Zadejte váš e-mail</label>

						<input id="klen_email" type="email" name="email" placeholder="jan@novak.cz" required>
					</div>
					
					<div class="klen__form-field klen__form-field_submit">
						<button type="submit" class="klen__btn klen__btn-submit">Přihlásit se</button>
					</div>
				</form>
			</div>
		<?php
		
		return ob_get_clean();
	}

	// Adds shortcode with form for Ecomail subscribers.
	add_shortcode( 'ecomail-subscribers', 'klen_subscribers' );

	function klen_subscribers() {
		ob_start();

		?>
			<span class="klen-subscribers">XXX</span>
		<?php
		
		return ob_get_clean();
	}