<?php

namespace Hallewood\APNS;

use Hallewood\APNS\Notification\Aps;

class Notification {

	protected $aps;

	public function __construct() {
		$this->aps = new Aps;
	}

	/**
	 * Sets the sound file name
	 * @method name
	 * @param  string $name The name of the sound file
	 * @return self         The Sound instance for further setter chaining
	 */
	public function sound(string $name, bool $critical = false, float $volume = 1.0) : self {
		$this->name = $name;

		return $this;
	}
}
