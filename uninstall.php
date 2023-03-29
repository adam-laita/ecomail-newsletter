<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
exit();
}

// Remove options
delete_option('klen_api_key');
delete_option('klen_list_id');
delete_option('klen_subscribers_count');
delete_option('klen_labels_title');
delete_option('klen_labels_desc');
delete_option('klen_labels_label');
delete_option('klen_labels_placeholder');
delete_option('klen_labels_button');
delete_option('klen_labels_success');
delete_option('klen_labels_error');
delete_option('klen_labels_warning');
delete_option('klen_appearance_style');
