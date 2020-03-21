<?php

namespace Hallewood\APNS\Notification;

use Hallewood\APNS\Promises\Notification\SoundSetterPromise;
use Hallewood\APNS\Promises\ContainsContent;

class Sound implements SoundSetterPromise, ContainsContent {

	/**
	 * The name of the sound file to play when the notification is being received.
	 * @var string
	 */
	protected $name;

	/**
	 * Determines whether the notification is critical.
	 * @var bool
	 */
	protected $isCritical = false;

	/**
	 * The volume in percent that is being used to play the sound if it is marked as critical.
	 * @var float
	 */
	protected $volume = 1.0;

	/**
	 * Sets the sound file name
	 * @method name
	 * @param  string $name The name of the sound file
	 * @return self         The Sound instance for further setter chaining
	 */
	public function name(string $name) : self {
		$this->name = $name;

		return $this;
	}

	/**
	 * Sets the critical state of the notification
	 * @method isCritical
	 * @param  boolean    $isCritical Whether the notification is critical
	 * @return self                   The Sound instance for further setter chaining
	 */
	public function isCritical(bool $isCritical = true) : self {
		$this->isCritical = $isCritical;

		return $this;
	}

	/**
	 * Sets the volume of the notification if its set to critical
	 * @method volume
	 * @param  float  $volume The volume in percent (between 0 and 1)
	 * @return self           The Sound instance for further setter chaining
	 */
	public function volume(float $volume = 1.0) : self {
		$this->volume = min(1, max(0, $volume));

		return $this;
	}

	/**
	 * Checks whether the sound instance has any content to serialize
	 * @method hasContent
	 * @return bool       true if there is content to serialize
	 */
	public function hasContent() : bool {
		return isset($this->name);
	}

	/**
	 * Returns the Sound payload
	 * @method json
	 * @return array The Sound payload
	 */
	public function jsonSerializable() {
		if ($this->isCritical) {
			return [
				'sound'		=> $this->name,
				'critical'	=> 1,
				'volume'	=> $this->volume
			];
		}

		return $this->name;
	}
}
