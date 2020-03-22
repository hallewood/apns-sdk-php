<?php

namespace Hallewood\APNS\Dispatch;

use Hallewood\APNS\Notification;
use Hallewood\APNS\ApplicationBundle;

class DispatchUnit {

	/**
	 * The notification to dispatch
	 * @var Notification
	 */
	protected $notification;

	/**
	 * The device tokens to send the notification to
	 * @var string[]
	 */
	protected $deviceTokens;

	/**
	 * The application bundle used for the authentication
	 * @var ApplicationBundle
	 */
	protected $applicationBundle;

	/**
	 * Constructs the Dispatch Unit
	 * @method __construct
	 * @param  Notification      $notification      The notification to dispatch
	 * @param  array             $deviceTokens      The device tokens of the receiving devices
	 * @param  ApplicationBundle $applicationBundle The application bundle
	 */
	public function __construct(Notification $notification, array $deviceTokens, ApplicationBundle $applicationBundle) {
		$this->notification			= $notification;
		$this->deviceTokens			= $deviceTokens;
		$this->applicationBundle	= $applicationBundle;
	}

	/**
	 * Gets the notification
	 * @method getNotification
	 * @return Notification    The notification
	 */
	public function getNotification() : Notification {
		return $this->notification;
	}

	/**
	 * Gets the array of device tokens
	 * @method getDeviceTokens
	 * @return array           The array of device tokens
	 */
	public function getDeviceTokens() : array {
		return $this->deviceTokens;
	}

	/**
	 * Gets the application bundle
	 * @method getApplicationBundle
	 * @return ApplicationBundle    The application bundle
	 */
	public function getApplicationBundle() : ApplicationBundle {
		return $this->applicationBundle;
	}
}
