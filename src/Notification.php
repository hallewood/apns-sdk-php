<?php

namespace Hallewood\APNS;

use Hallewood\APNS\Dispatch\DispatchUnit;
use Hallewood\APNS\Notification\Aps;
use Hallewood\APNS\Promises\SerializesIntoJson;

class Notification implements SerializesIntoJson {

	/**
	 * The APS dictionary instance
	 * @var Aps
	 */
	protected $aps;

	/**
	 * A dictionary with all user defined keys to append to the payload
	 * @var array
	 */
	protected $userInfo;

	/**
	 * Constructs the notification
	 * @method __construct
	 */
	public function __construct() {
		$this->aps		= new Aps;

		//
		// Initialize the userInfo dictionary as an empty instance
		$this->userInfo	= [];
	}

	/**
	 * Sets the notification title
	 * @method title
	 * @param  string  $title     The title or localized string identifier
	 * @param  boolean $localized If this is true the title parameter is being interpreted as a localized string identifier
	 * @param  array   $arguments The arguments to inject into the localized string at runtime
	 * @return self               The Notification instance for further chaining
	 */
	public function title(string $title, bool $localized = false, array $arguments = []) : self {
		if ($localized) {
			$this->aps->getAlert()->localizedTitle($title, $arguments);
		} else {
			$this->aps->getAlert()->title($title);
		}

		return $this;
	}

	/**
	 * Sets the notification subtitle
	 * @method subtitle
	 * @param  string   $subtitle  The subtitle or the localized string identifier
	 * @param  boolean  $localized If this is true the subtitle parameter is being interpreted as a localized string identifier
	 * @param  array    $arguments The arguments to inject into the localized string at runtime
	 * @return self                The Notification instance for further chaining
	 */
	public function subtitle(string $subtitle, bool $localized = false, array $arguments = []) : self {
		if ($localized) {
			$this->aps->getAlert()->localizedSubtitle($subtitle, $arguments);
		} else {
			$this->aps->getAlert()->subtitle($subtitle);
		}

		return $this;
	}

	/**
	 * Sets the notification body
	 * @method body
	 * @param  string  $body      The body or the localized string identifier
	 * @param  boolean $localized If this is true the body parameter is being interpreted as a localized string identifier
	 * @param  array   $arguments The arguments to inject into the localized string at runtime
	 * @return self               The Notification instance for further chaining
	 */
	public function body(string $body, bool $localized = false, array $arguments = []) : self {
		if ($localized) {
			$this->aps->getAlert()->localizedBody($body, $arguments);
		} else {
			$this->aps->getAlert()->body($body);
		}

		return $this;
	}

	/**
	 * Sets the launch image name
	 * @method launchImage
	 * @param  string      $launchImage The name of the launch image
	 * @return self                     The Notification instance for further chaining
	 */
	public function launchImage(string $launchImage) : self {
		$this->aps->getAlert()->launchImage($launchImage);

		return $this;
	}

	/**
	 * Sets the number for the badge
	 * @method badge
	 * @param  int   $number The number to show in the badge
	 * @return self          The Notification instance for further chaining
	 */
	public function badge(int $number) : self {
		$this->aps->badge($number);

		return $this;
	}

	/**
	 * Set tne sound options for the notification
	 * @method sound
	 * @param  string  $name     The name of the soundfile to play
	 * @param  boolean $critical Whether the notification is critical or not
	 * @param  float   $volume   The volume if the notification is critical
	 * @return self              The Notification instance for further chaining
	 */
	public function sound(string $name, bool $critical = false, float $volume = 1.0) : self {
		$this->aps->getSound()->name($name)->isCritical($critical)->volume($volume);

		return $this;
	}

	/**
	 * Sets the notification thread identifier
	 * @method thread
	 * @param  string $identifier The thread identifier
	 * @return self               The Notification instance for further chaining
	 */
	public function thread(string $identifier) : self {
		$this->aps->threadId = $identifier;

		return $this;
	}

	/**
	 * Sets the notification category
	 * @method category
	 * @param  string   $category The notification category
	 * @return self               The Notification instance for further chaining
	 */
	public function category(string $category) : self {
		$this->aps->category = $category;

		return $this;
	}

	/**
	 * Specifies that the notification only delivers content
	 * @method deliversContent
	 * @param  bool            $available Whether the notification only delivers content or not
	 * @return self                       The Notification instance for further chaining
	 */
	public function deliversContent(bool $available = true) : self {
		$this->aps->isContentAvailable = $available;

		return $this;
	}

	/**
	 * Specifies that the notification should notify the app before delivery.
	 * In this case the application can modify the notification content if the
	 * payload would be too big
	 * @method notifyBeforeDelivery
	 * @param  boolean                 $notify Whether to notify the app or not
	 * @return self                            The notification instance for further chaining
	 */
	public function notifyBeforeDelivery(bool $notify = true) : self {
		$this->aps->isMutableContent = $notify;

		return $this;
	}

	/**
	 * Sets the target content identifier of the notification
	 * @method target
	 * @param  string $identifier The identifier for the target window
	 * @return self               The Notification instance for further chaining
	 */
	public function target(string $identifier) : self {
		$this->aps->targetContentId = $identifier;

		return $this;
	}

	/**
	 * Sets a userInfo entry for a given key
	 * @method data
	 * @param  string $key  The userInfo key
	 * @param  mixed  $data The data to store for the key
	 * @return self         The Notification instance for further chaining
	 */
	public function data(string $key, mixed $data) : self {
		$this->userInfo[$key] = $data;

		return $this;
	}

	/**
	 * Sets a set of userInfo entries
	 * @method dataset
	 * @param  array   $set An assoc-array which will be injected into the userInfo
	 * @return self         The Notification instance for further chaining
	 */
	public function dataset(array $set) : self {
		foreach ($set as $key => $value) {
			$this->userInfo($key, $value);
		}

		return $this;
	}

	/**
	 * Pushes the notification
	 * @method push
	 * @param  mixed $deviceTokenData  String or array of strings of device tokens
	 * @param  function $prepare       A function which is called to prepare the notification
	 * @return DisptachResult          An array of results
	 */
	public function push($deviceTokenData, $prepare = null) : array {
		$dispatcher		= new Dispatcher;
		$sharedBundle	= ApplicationBundle::getShared();

		//
		// If the device token data is not an array but a string
		// then transform it to an array of string
		if (!is_array($deviceTokenData) && is_string($deviceTokenData)) {
			$deviceTokenData = [$deviceTokenData];
		}

		//
		// Iterate through all device tokens and and append the notification to the dispatcher
		foreach ($deviceTokenData as $deviceToken) {
			if (!is_string($deviceToken)) {
				continue;
			}

			$notification	= isset($prepare) ? $prepare($this, $deviceToken) : $this;
			$dispatchUnit	= new DispatchUnit($notification, [$deviceToken], $sharedBundle);

			$dispatcher->addDispatchUnit($dispatchUnit);
		}

		//
		// Dispatch all notifications
		return $dispatcher->push();
	}

	/**
	 * Returns the notification payload
	 * @method json
	 * @return array Return the notification payload
	 */
	public function jsonSerializable() {
		$payload = [];

		foreach ($this->userInfo as $property => $data) {
			$payload[$property] = $data;
		}

		$payload['aps'] = $this->aps->jsonSerializable();

		return $payload;
	}
}
