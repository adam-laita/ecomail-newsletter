<?php

/**
 * Class for general settings of the plugin
 */
class KLEN_Ecomail_Requst
{

    /**
     *
     */
    public function __construct()
    {
        $this->actions();
    }

    /**
     * Actions and hooks
     *
     * @return void
     */
    public function actions()
    {
        add_action('rest_api_init', array($this, 'register_endpoint'));
    }

    /**
     * Register settings sections
     *
     * @return void
     */
    public function register_endpoint()
    {
        register_rest_route('klen-ecomail/v1', '/subscribe', array(
            'methods' => 'POST',
            'callback' => array($this, 'subscribe_user')
        ));
    }

    /**
     * Subscribe user to a newsletter
     *
     * @return void
     */
    public function subscribe_user($request)
    {
        $api_key = get_option('klen_api_key');
        $list_id = get_option('klen_list_id');

        // Check if the API key and list ID are set
        if (!$api_key || !$list_id) {
            return new WP_Error('error', __('API key and list ID are not set', 'klen_admin'), array('status' => 400));
        }

        // Get the email and name parameters from the request
        $params = $request->get_params();
        $email = $params['email'];

        // Make the API request to subscribe the user
        $url = 'https://api2.ecomailapp.cz/lists/' . $list_id . '/subscribe';

        $data = array(
            'subscriber_data' => array(
                'email' => $email
            ),
            'resubscribe' => true,
        );

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'key' => $api_key
            ),
            'body' => wp_json_encode($data),
        );

        $response = wp_remote_post($url, $args);

        // Check if the request was successful
        if (is_wp_error($response)) {
            return new WP_Error('error', __('Error while subscribing to Ecomail', 'klen_admin'), array('status' => 400));
        }

        // Return the response from the API
        return $response;
    }

}

new KLEN_Ecomail_Requst();