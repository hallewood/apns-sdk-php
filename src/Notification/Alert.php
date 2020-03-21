<?php

namespace Hallewood\APNS\Notification;

class Alert implements JsonSerializable {

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
}
