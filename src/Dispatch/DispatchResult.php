<?php

namespace Hallewood\APNS\Dispatch;

use Hallewood\APNS\Notification;
use Hallewood\APNS\ApplicationBundle;

class DispatchResult {

	/**
	 * The notification that was dispatched
	 * @var Notification
	 */
	protected $notification;

	/**
	 * The device token for the notification
	 * @var string
	 */
	protected $deviceToken;

	/**
	 * The application bundle used to dispatch the notification
	 * @var ApplicationBundle
	 */
	protected $applicationBundle;

	/**
	 * The result of the curl execution
	 * @var mixed
	 */
	protected $result;

	/**
	 * The info of the curl
	 * @var mixed
	 */
	protected $info;

	/**
	 * Constructs the dispatch result
	 * @method __construct
	 * @param  Notification      $notification      The notification
	 * @param  string            $deviceToken       The device token
	 * @param  ApplicationBundle $applicationBundle The application bundle
	 */
	public function __construct(Notification $notification, string $deviceToken, ApplicationBundle $applicationBundle) {
		$this->notification			= $notification;
		$this->deviceToken			= $deviceToken;
		$this->applicationBundle	= $applicationBundle;
	}

	/**
	 * Sets the request result
	 * @method setResult
	 * @param  mixed    $result The result
	 */
	public function setResult($result) : void {
		$this->result = $result;
	}

	/**
	 * Sets the request info
	 * @method setInfo
	 * @param  mixed  $info The info
	 */
	public function setInfo($info) : void {
		$this->info = $info;
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
	 * Gets the device token
	 * @method getDeviceToken
	 * @return string         The device token
	 */
	public function getDeviceToken() : string {
		return $this->deviceToken;
	}

	/**
	 * Gets the application bundle
	 * @method getApplicationBundle
	 * @return ApplicationBundle    The application bundle
	 */
	public function getApplicationBundle() : ApplicationBundle {
		return $this->applicationBundle;
	}

	/**
	 * Gets the result
	 * @method getResult
	 * @return mixed    The result
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * Gets the info
	 * @method getInfo
	 * @return mixed  The info
	 */
	public function getInfo() {
		return $this->info;
	}
}
