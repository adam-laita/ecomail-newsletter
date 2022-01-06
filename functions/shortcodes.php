<?php

	/* ------------------------------ SHORTCODES ------------------------------ */

	// Adds shortcode with form for Ecomail subscribers.
	add_shortcode( 'ecomail-newsletter', 'klen_form' );

	function klen_form() {
		wp_enqueue_style( 'klen_form' );
		wp_enqueue_script( 'klen_form' );

		ob_start();

		?>
			<div class="klen klen_left klen_transparent <?php // klen_left klen_center klen_right klen_transparent klen_background ?>">
				<div class="klen__wrapper">
					<div class="klen__text">
						<h3>Newsletter</h3>

						<p>Připojte se mezi <strong>XXX</strong> přihlášených odběratelů.</p>

						<p>Zapsat se můžete zde:</p>
					</div>

					<form class="klen__form" id="klen_email_subscribe" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="POST" _lpchecked="1">
						<input type="hidden" name="action" value="add_subscriber_email">

						<div class="klen__form-field klen__form-field_email klen__form-field_required">
							<label for="klen_email">Zadejte váš e-mail</label>

							<input id="klen_email" type="email" name="email" placeholder="jan@novak.cz" required>
						</div>
						
						<div class="klen__form-field klen__form-field_submit">
							<button type="submit">Přihlásit se</button>
						</div>
					</form>

					<div class="klen__alerts">
						<div class="klen__alert klen__alert_success">
							<p>Byly jste úspěšně zapsáni do newsletteru.</p>
						</div>

						<div class="klen__alert klen__alert_error">
							<p>Newsletter dosáhl maximální kapacitu a není možné se již zapsat.</p>
						</div>

						<div class="klen__alert klen__alert_warning">
							<p>Již jste zapsáni v newsletteru.</p>
						</div>
					</div>
				</div>
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