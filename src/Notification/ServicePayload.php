<?php

namespace Hallewood\APNS\Notification;

class ServicePayload {

	/**
	 * A notification-alert object for specifying the notification text.
	 * @var Alert
	 */
	protected $alert;

	/**
	 * The number that shall appear in a badge on the app icon.
	 * @var int
	 */
	protected $badge;

	/**
	 * A notification-sound object for specifying the sound options.
	 * @var Sound
	 */
	protected $sound;

	/**
	 * An app-specific string for grouping related notifications into a thread.
	 * @var string
	 */
	protected $threadId;

	/**
	 * A category name that was defined in the app at launch time.
	 * @var string
	 */
	protected $category;

	/**
	 * Determines whether the notifiction is silent and used to update data in the background.
	 * @var bool
	 */
	protected $isContentAvailable;

	/**
	 * Determines whether the notification is being passed to the application notification service
	 * app extension for handling the received data before displaying it.
	 * @var bool
	 */
	protected $isMutableContent;

	/**
	 * An identifier to determine which window should be brought up after interacting with the notification.
	 * @var string
	 */
	protected $targetContentId;

	public function __construct() {
		$this->alert = new Alert;
		$this->sound = new Sound;
	}
}
