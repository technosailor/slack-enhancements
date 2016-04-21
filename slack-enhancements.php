<?php
namespace Technosailor\Slack_Enhancements;
/**
 * Plugin Name: Slack Enhancements
 * Version: 0.1
 * Description: Slack Enhancements
 * Author: Aaron Brazell
 * License: MIT
 */

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TS_SLACK_ENHANCEMENTS_VERSION', '0.1' );

class Slack_Enhancements {

	/**
	 * Slack_Enhancements constructor.
	 */
	public function __construct() {

		// Modifications for Rock the Slackbot plugin
		if( class_exists( 'Rock_The_Slackbot' ) ) {
			add_filter( 'rock_the_slackbot_outgoing_webhook_payload', array( $this, 'payload' ), 10, 2 );
		}
	}

	/**
	 * For Rock the Slackbot, limit the payload sent and don't include attachemrnts.
	 * This limits the output in slack to a simple output with the title, and link to post.
	 * More informational, less editorial.
	 * 
	 * @param $payload
	 * @param $webhook_url
	 *
	 * @return mixed
	 */
	public function payload( $payload, $webhook_url ) {
		$payload['attachments'][0]['fields'] = [];

		return $payload;
	}
}

new Slack_Enhancements();