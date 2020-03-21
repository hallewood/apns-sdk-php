<?php

namespace Hallewood\APNS\Notification;

class Sound implements JsonSerializable {

	/**
	 * The name of the sound file to play when the notification is being received.
	 * @var string
	 */
	protected $name;

	/**
	 * Determines whether the notification is critical.
	 * @var bool
	 */
	protected $isCritical;

	/**
	 * The volume in percent that is being used to play the sound if it is marked as critical.
	 * @var float
	 */
	protected $volume;
}
