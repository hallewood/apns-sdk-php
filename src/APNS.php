<?php

namespace Hallewood\APNS;

class APNS {

	protected $notification;

	private function __construct(Notification $notification) {
		$this->notification = $notification;
	}

	public static function push(Notification $notification) : self {
		return new self($notification);
	}

}
