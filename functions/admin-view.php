<?php

/* ------------------------------ ADMIN PAGE - CONTENT ------------------------------ */

// check user capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}
?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    
</div>