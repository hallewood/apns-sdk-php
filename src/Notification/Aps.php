<?php

namespace Hallewood\APNS\Notification;

class Aps {

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
	public $threadId;

	/**
	 * A category name that was defined in the app at launch time.
	 * @var string
	 */
	public $category;

	/**
	 * Determines whether the notifiction is silent and used to update data in the background.
	 * @var bool
	 */
	public $isContentAvailable;

	/**
	 * Determines whether the notification is being passed to the application notification service
	 * app extension for handling the received data before displaying it.
	 * @var bool
	 */
	public $isMutableContent;

	/**
	 * An identifier to determine which window should be brought up after interacting with the notification.
	 * @var string
	 */
	public $targetContentId;

	/**
	 * Construct the APS instance
	 * @method __construct
	 */
	public function __construct() {
		$this->alert = new Alert;
		$this->sound = new Sound;
	}

	/**
	 * Sets the number which will be visible in the badge
	 * @method badge
	 * @param  int   $number The number to show
	 * @return self          The Aps instance for further setter chaining
	 */
	public function badge(int $number) : self {
		$this->badge = max(0, $badge);

		return $this;
	}

	/**
	 * Gets the alert instance
	 * @method getAlert
	 * @return Alert    The alert instance
	 */
	public function getAlert() : Alert {
		return $this->alert;
	}

	/**
	 * Gets the sound isntance
	 * @method getSound
	 * @return Sound    The sound instande
	 */
	public function getSound() : Sound {
		return $this->sound;
	}
}
