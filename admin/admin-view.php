<?php
	/* ------------------------------ ADMIN PAGE - CONTENT ------------------------------ */

	//Variables
	global $wpdb;

	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	//Get the active tab from the $_GET param
	$default_tab = null;
	$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>

<div class="klen-admin">
	<div class="klen-admin__main">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php 
         if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'klen_messages', 'klen_message', __( 'Settings Saved', 'klen' ), 'updated' );
        }
     
        // show error/update messages
        //settings_errors( 'klen_messages' ) ?>

		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam erat volutpat. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus.</p>

        <?php /* 
        Check DB for API key and disable content and design
        */?>
		<nav class="nav-tab-wrapper" id="tabs">
			<a href="?page=klen_admin_page" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?=__('General settings','klen_admin');?></a>

			<a href="?page=klen_admin_page&tab=content" class="nav-tab <?php if($tab==='content'):?>nav-tab-active<?php endif; ?>" ><?=__('Content','klen_admin');?></a>

			<a href="?page=klen_admin_page&tab=design" class="nav-tab <?php if($tab==='design'):?>nav-tab-active<?php endif; ?>"><?=__('Design','klen_admin');?></a>
		</nav>

		<div class="tab-content">
		<?php switch($tab) :
			//Content tab
			case 'content':?>
				<h2><?=__('Content','klen_admin');?></h2>
				<p>Nadpis</p>
                <p>Popisek</p>
                <p>Label</p>
                <p>Placeholder</p>
                <p>Button</p>
                <p>Hláška success</p>
                <p>Hláška warning</p>
                <p>Již jste zapsáni message</p>
			<?php 
			break;
			case 'design':?>
				<h2><?=__('Design','klen_admin');?></h2>

				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="klen_style"><?=__('Choose style','klen_admin');?></label>
							</th>

							<td>
								<select name="klen_style" id="klen_style">
									<option selected="selected" value="default"><?=__('Default','klen_admin');?></option>

									<option value="plain"><?=__('Plain','klen_admin');?></option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
                <p></p>
			<?php 
			break;
			default:?>
                <form action="options.php" method="post">
                    <?php
                    // output security fields for the registered setting "klen"
                    settings_fields( 'klen_general' );
                    // output setting sections and their fields
                    // (sections are registered for "klen", each field is registered to a specific section)
                    do_settings_sections( 'klen_general' );
                    // output save settings button
                    submit_button(__('Save settings','klen_admin'));
                    ?>
                </form>
			<?php
			break;
			endswitch; ?>
		</div>

		<div class="klen-admin__shortcode">
            <h3><?=__('Preview','klen_admin');?></h3>
			<?=do_shortcode('[ecomail-newsletter]');?>
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
									It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
									The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,
									content here', making it look like readable English.
								</p>

								<p>
									Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for
									'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, by accident.
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