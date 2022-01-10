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

<div class="wrap">
    <div class="wrap__col">
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
            <?php 
            break;
            default:?>
                <h2><?=__('General settings','klen_admin');?></h2>
            <?php
            break;
            endswitch; ?>
        </div>
        <hr>
        
    </div>
    <div class="wrap__col">
        <div class="klen_shortcode">
            <?=do_shortcode('[ecomail-newsletter]');?>
        </div>
    </div>
</div>