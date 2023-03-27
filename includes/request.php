<?php

/**
 * Class for main settings of the plugin
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
		add_action('klen_update_subscribers_count', array($this, 'update_subscribers_count'));
		add_action('wp', function () {
			if (!wp_next_scheduled('klen_update_subscribers_count')) {
				wp_schedule_event(time(), 'daily', 'klen_update_subscribers_count');
			}
		});
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

		register_rest_route('klen-ecomail/v1', '/subscribers-count', array(
			'methods' => 'GET',
			'callback' => array($this, 'update_subscribers_count')
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
			return new WP_Error('error', __('API key and list ID are not set.', 'klen'), array('status' => 400));
		}

		// Get the email and name parameters from the request
		$params = $request->get_params();
		$email = sanitize_email($params['email']);

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
			return new WP_Error('error', __('Error while subscribing to Ecomail.', 'klen'), array('status' => 400));
		}

		// Return the response from the API
		return $response;
	}

	/**
	 * Get subscriber count for that list_id
	 *
	 * @return void
	 */
	public function update_subscribers_count()
	{
		$api_key = get_option('klen_api_key');
		$list_id = get_option('klen_list_id');

		if (!$api_key || !$list_id) {
			return;
		}

		$url = 'https://api2.ecomailapp.cz/lists/' . $list_id . '/subscribers';

		$args = array(
			'headers' => array(
				'Content-Type' => 'application/json',
				'key' => $api_key
			),
			'timeout' => 10
		);

		$response = wp_remote_get($url, $args);

		if (is_wp_error($response)) {
			return;
		}

		$result = json_decode(wp_remote_retrieve_body($response), true);

		if (!empty($result['total'])) {
			update_option('klen_subscribers_count', $result['total']);
		}
	}

}

new KLEN_Ecomail_Requst();