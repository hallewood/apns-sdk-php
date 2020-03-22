<?php

namespace Hallewood\APNS;

class ApplicationBundle {

	/**
	 * The shared bundle throughout the application
	 * @var ApplicationBundle
	 */
	protected static $sharedBundle;

	/**
	 * The applications bundle identifier
	 * @var string
	 */
	protected $identifier;

	/**
	 * The developer team identifier
	 * @var string
	 */
	protected $teamId;

	/**
	 * The APNS key identifier
	 * @var string
	 */
	protected $keyId;

	/**
	 * Constructs the ApplicationBundle instance
	 * @method __construct
	 * @param  string      $identifier The applications bundle identifier
	 * @param  string      $teamId     The developer team identifier
	 * @param  string      $keyId      The APNS key identifier
	 */
	public function __construct(string $identifier, string $teamId, string $keyId) {
		$this->identifier	= $identifier;
		$this->teamId		= $teamId;
		$this->keyId		= $keyId;
	}

	/**
	 * Sets the shared application bundle
	 * @method shared
	 * @param  string $identifier The applications bundle identifier
	 * @param  string $teamId     The developer team identifier
	 * @param  string $keyId      The APNS key identifier
	 */
	public static function shared(string $identifier, string $teamId, string $keyId) {
		self::$sharedBundle = new self($identifier, $teamId, $keyId);
	}

	/**
	 * Gets the shared application bundle
	 * @method getShared
	 * @return ApplicationBundle The shared application bundle
	 */
	public static function getShared() : ApplicationBundle {
		if (!isset(self::$sharedBundle)) {
			throw new \Exception('No shared application bundle was set.');
		}

		return self::$sharedBundle;
	}
}
