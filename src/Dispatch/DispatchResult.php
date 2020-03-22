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
	protected $bundle;

	/**
	 * The result of the curl execution
	 * @var [type]
	 */
	protected $result;

	/**
	 * The info of the curl
	 * @var [type]
	 */
	protected $info;

	public function __construct(Notification $notification, string $deviceToken, ApplicationBundle $applicationBundle) {
		$this->notification			= $notification;
		$this->deviceToken			= $deviceToken;
		$this->applicationBundle	= $applicationBundle;
	}

	public function setResult($result) : void {
		$this->result = $result;
	}

	public function setInfo($info) : void {
		$this->info = $info;
	}
}
