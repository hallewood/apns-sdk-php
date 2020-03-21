<?php

namespace Hallewood\APNS\Notification;

use Hallewood\APNS\Notification\Aps;
use Hallewood\APNS\Notification\Alert;
use Hallewood\APNS\Notification\Sound;

class Notification implements JsonSerializable {

	protected $aps;

	public function __construct() {
		$this->aps			= new Aps;
		$this->aps->alert	= new Alert;
		$this->aps->sound	= new Sound;
	}

}
