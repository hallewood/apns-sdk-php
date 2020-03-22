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
	 * The path to the file where the key is stored
	 * @var string
	 */
	protected $keyPath;

	/**
	 * Constructs the ApplicationBundle instance
	 * @method __construct
	 * @param  string      $identifier The applications bundle identifier
	 * @param  string      $teamId     The developer team identifier
	 * @param  string      $keyId      The APNS key identifier
	 * @param  string      $keyPath    The path to the file where the key is stored
	 */
	public function __construct(string $identifier, string $teamId, string $keyId, string $keyPath) {
		$this->identifier	= $identifier;
		$this->teamId		= $teamId;
		$this->keyId		= $keyId;
		$this->keyPath		= $keyPath;
	}

	/**
	 * Sets the shared application bundle
	 * @method shared
	 * @param  string $identifier The applications bundle identifier
	 * @param  string $teamId     The developer team identifier
	 * @param  string $keyId      The APNS key identifier
	 * @param  string $keyPath    The path to the file where the key is stored
	 */
	public static function shared(string $identifier, string $teamId, string $keyId, string $keyPath) {
		self::$sharedBundle = new self($identifier, $teamId, $keyId, $keyPath);
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

	/**
	 * Gets the bundle identifier
	 * @method getBundleIdentifier
	 * @return string              The bundle identifier
	 */
	public function getBundleIdentifier() : string {
		return $this->identifier;
	}

	/**
	 * Gets the team ID
	 * @method getTeamId
	 * @return string    The team ID
	 */
	public function getTeamId() : string {
		return $this->teamId;
	}

	/**
	 * Gets the key ID
	 * @method getKeyId
	 * @return string   The key ID
	 */
	public function getKeyId() : string {
		return $this->keyId;
	}

	/**
	 * Gets the key file path
	 * @method getKeyPath
	 * @return string     The key file path
	 */
	public function getKeyPath() : string {
		return $this->keyPath;
	}
}
