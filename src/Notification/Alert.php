<?php

namespace Hallewood\APNS\Notification;

use Hallewood\APNS\Promises\Notification\AlertSetterPromise;
use Hallewood\APNS\Promises\ContainsContent;

class Alert implements AlertSetterPromise, ContainsContent {

	/**
	 * The title of the notification-alert.
	 * @var string
	 */
	protected $title;

	/**
	 * The subtitle of the notification-alert.
	 * @var string
	 */
	protected $subtitle;

	/**
	 * The notification-alert content.
	 * @var string
	 */
	protected $body;

	/**
	 * The name of the launch image to show instead of the default image
	 * if the notification launches the application.
	 * @var string
	 */
	protected $launchImage;

	/**
	 * The localization key of a string in the applications localization files
	 * to use instead of a static notification title.
	 * @var string
	 */
	protected $localizedTitleKey;

	/**
	 * Array of arguments that are going to be injected into the localized title.
	 * @var string[]
	 */
	protected $localizedTitleArguments;

	/**
	 * The localization key of a string in the applications localization files
	 * to use instead of a static notification subtitle.
	 * @var string
	 */
	protected $localizedSubtitleKey;

	/**
	 * Array of arguments that are going to be injected into the localized subtitle.
	 * @var string[]
	 */
	protected $localizedSubtitleArguments;

	/**
	 * The localization key of a string in the applications localization files
	 * to use instead of a static notification body.
	 * @var string
	 */
	protected $localizedKey;

	/**
	 * Array of arguments that are going to be injected into the localized body.
	 * @var string[]
	 */
	protected $localizedArguments;

	/**
	 * Sets the notification title
	 * @method title
	 * @param  string $title The title of the notification
	 * @return self          The Alert instance for further setter chaining
	 */
	public function title(string $title) : self {

		//
		// Unset the localized key and arguments
		$this->localizedTitleKey		= null;
		$this->localizedTitleArguments	= null;

		//
		// Set the default title string
		$this->title = $title;

		return $this;
	}

	/**
	 * Sets the notification subtitle
	 * @method subtitle
	 * @param  string   $subtitle The subtitle of the notification
	 * @return self               The Alert instance for further setter chaining
	 */
	public function subtitle(string $subtitle) : self {

		//
		// Unset the localized key and arguments
		$this->localizedSubtitleKey			= null;
		$this->localizedSubtitleArguments	= null;

		//
		// Set the default subtitle string
		$this->subtitle = $subtitle;

		return $this;
	}

	/**
	 * Sets the notification body
	 * @method body
	 * @param  string $body The body of the notification
	 * @return self         The Alert instance for further setter chaining
	 */
	public function body(string $body) : self {

		//
		// Unset the localized key and arguments
		$this->localizedKey			= null;
		$this->localizedArguments	= null;

		//
		// Set the default body string
		$this->body = $body;

		return $this;
	}

	/**
	 * Sets the launch image name
	 * @method launchImage
	 * @param  string      $launchImage The name of the launch image
	 * @return self                     The Alert instance for further setter chaining
	 */
	public function launchImage(string $launchImage) : self {
		$this->launchImage = $launchImage;

		return $this;
	}

	/**
	 * Sets the localized title of the notification
	 * @method localizedTitle
	 * @param  string         $key       The key of the localized string
	 * @param  array          $arguments The array of arguments to inject at runtime
	 * @return self                      The Alert instance for further setter chaining
	 */
	public function localizedTitle(string $key, array $arguments = []) : self {

		//
		// Unset the default title string
		$this->title = null;

		//
		// Set the key and arguments string
		$this->localizedTitleKey		= $key;
		$this->localizedTitleArguments	= $arguments;

		return $this;
	}

	/**
	 * Sets the localized subtitle of the notification
	 * @method localizedSubtitle
	 * @param  string            $key       The key of the localized string
	 * @param  array             $arguments The array of arguments to inject at runtime
	 * @return self                         The Alert instance for further setter chaining
	 */
	public function localizedSubtitle(string $key, array $arguments = []) : self {

		//
		// Unset the default subtitle string
		$this->subtitle = null;

		//
		// Set the key and arguments array
		$this->localizedSubtitleKey			= $key;
		$this->localizedSubtitleArguments	= $arguments;

		return $this;
	}

	/**
	 * Sets the localized body of the notification
	 * @method localizedBody
	 * @param  string        $key       The key of the localized string
	 * @param  array         $arguments The array of arguments to inject at runtime
	 * @return self                     The Alert instance for further setter chaining
	 */
	public function localizedBody(string $key, array $arguments = []) : self {

		//
		// Unset the default body string
		$this->body = null;

		//
		// Set the key and arguments array
		$this->localizedKey			= $key;
		$this->localizedArguments	= $arguments;

		return $this;
	}

	/**
	 * Checks whether the alert instance has any content to serialize
	 * @method hasContent
	 * @return bool       true if there is content to serialize
	 */
	public function hasContent() : bool {
		foreach ($this as $key => $value) {
			if (isset($value)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Returns the alert payload
	 * @method json
	 * @return array The alert payload
	 */
	public function jsonSerializable() {
		$serializable = [];

		if (isset($this->title)) {
			$serializable['title'] = $this->title;
		}

		if (isset($this->subtitle)) {
			$serializable['subtitle'] = $this->subtitle;
		}

		if (isset($this->body)) {
			$serializable['body'] = $this->body;
		}

		if (isset($this->launchImage)) {
			$serializable['launch-image'] = $this->launchImage;
		}

		if (isset($this->localizedTitleKey)) {
			$serializable['title-loc-key']	= $this->localizedTitleKey;
			if (isset($this->localizedTitleArguments) && count($this->localizedTitleArguments)) {
				$serializable['title-loc-args']	= $this->localizedTitleArguments;
			}
		}

		if (isset($this->localizedSubtitleKey)) {
			$serializable['subtitle-loc-key']	= $this->localizedSubtitleKey;
			if (isset($this->localizedSubtitleArguments) && count($this->localizedSubtitleArguments)) {
				$serializable['subtitle-loc-args']	= $this->localizedSubtitleArguments;
			}
		}

		if (isset($this->localizedKey)) {
			$serializable['loc-key']	= $this->localizedKey;
			if (isset($this->localizedArguments) && count($this->localizedArguments)) {
				$serializable['loc-args']	= $this->localizedArguments;
			}
		}

		return $serializable;
	}
}
