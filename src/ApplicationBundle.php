<?php

namespace Hallewood\APNS;

class ApplicationBundle {

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

}
