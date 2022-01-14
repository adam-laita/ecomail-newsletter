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

		<?php settings_errors(); ?>

		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam erat volutpat. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus.</p>

		<nav class="nav-tab-wrapper" id="tabs">
			<a href="?page=klen_admin_page" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?=__('General settings','klen_admin');?></a>

			<a href="?page=klen_admin_page&tab=content" class="nav-tab <?php if($tab==='content'):?>nav-tab-active<?php endif; ?>"><?=__('Content','klen_admin');?></a>

			<a href="?page=klen_admin_page&tab=design" class="nav-tab <?php if($tab==='design'):?>nav-tab-active<?php endif; ?>"><?=__('Design','klen_admin');?></a>
		</nav>

		<div class="tab-content">
		<?php switch($tab) :
			//Content tab
			case 'content':?>
				<h2><?=__('Content','klen_admin');?></h2>
				
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
			<?php 
			break;
			default:?>
				<h2><?=__('General settings','klen_admin');?></h2>

				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="klen_api_key"><?=__('API key','klen_admin');?></label></th>

							<td><input name="klen_api_key" type="text" id="klen_api_key" placeholder="XXX" class="regular-text"></td>
						</tr>

						<tr>
							<th scope="row"><label for="klen_list_ID"><?=__('Your list ID','klen_admin');?></label></th>
							<td><input name="klen_list_ID" type="number" id="klen_list_ID" placeholder="1" class="regular-number"></td>
						</tr>

						<tr>
							<th scope="row">
								<?=__('Testing mode','klen_admin');?>
							</th>

							<td>
								<fieldset>
									<legend class="screen-reader-text">
										<span>checkbox</span>
									</legend>

									<label for="checkbox_id">
										<input name="checkbox_id" type="checkbox" id="checkbox_id" value="1">
										<?=__('Active','klen_admin');?>
									</label>
								</fieldset>
							</td>
						</tr>
					</tbody>
				</table>
			<?php
			break;
			endswitch; ?>
		</div>

		<hr>

		<div class="klen-admin__shortcode">
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