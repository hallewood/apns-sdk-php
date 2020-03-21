<?php

namespace Hallewood\APNS\Promises\Notification;

interface AlertSetterPromise {
	/**
	 * Sets the notification title
	 * @method title
	 * @param  string $title The title of the notification
	 * @return self          The implementers instance for further setter chaining
	 */
	public function title(string $title);

	/**
	 * Sets the notification subtitle
	 * @method subtitle
	 * @param  string   $subtitle The subtitle of the notification
	 * @return self               The implementers instance for further setter chaining
	 */
	public function subtitle(string $subtitle);

	/**
	 * Sets the notification body
	 * @method body
	 * @param  string $body The body of the notification
	 * @return self         The implementers instance for further setter chaining
	 */
	public function body(string $body);

	/**
	 * Sets the launch image name
	 * @method launchImage
	 * @param  string      $launchImage The name of the launch image
	 * @return self                     The implementers instance for further setter chaining
	 */
	public function launchImage(string $launchImage);

	/**
	 * Sets the localized title of the notification
	 * @method localizedTitle
	 * @param  string         $key       The key of the localized string
	 * @param  array          $arguments The array of arguments to inject at runtime
	 * @return self                      The implementers instance for further setter chaining
	 */
	public function localizedTitle(string $key, array $arguments = []);

	/**
	 * Sets the localized subtitle of the notification
	 * @method localizedSubtitle
	 * @param  string            $key       The key of the localized string
	 * @param  array             $arguments The array of arguments to inject at runtime
	 * @return self                         The implementers instance for further setter chaining
	 */
	public function localizedSubtitle(string $key, array $arguments = []);

	/**
	 * Sets the localized body of the notification
	 * @method localizedBody
	 * @param  string        $key       The key of the localized string
	 * @param  array         $arguments The array of arguments to inject at runtime
	 * @return self                     The implementers instance for further setter chaining
	 */
	public function localizedBody(string $key, array $arguments = []);
}
