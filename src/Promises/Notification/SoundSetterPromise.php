<?php

namespace Hallewood\APNS\Promises\Notification;

interface SoundSetterPromise {

	/**
	 * Sets the sound file name
	 * @method name
	 * @param  string $name The name of the sound file
	 * @return self         The implementers instance for further setter chaining
	 */
	public function name(string $name);

	/**
	 * Sets the critical state of the notification
	 * @method isCritical
	 * @param  boolean    $isCritical Whether the notification is critical
	 * @return self                   The implementers instance for further setter chaining
	 */
	public function isCritical(bool $isCritical = true);

	/**
	 * Sets the volume of the notification if its set to critical
	 * @method volume
	 * @param  float  $volume The volume in percent (between 0 and 1)
	 * @return self           The implementers instance for further setter chaining
	 */
	public function volume(float $volume = 1.0);
}
