<?php

namespace Hallewood\APNS\Promises;

interface SerializesIntoJson {

	/**
	 * Returns a type that is serializable with json
	 * @method json
	 * @return mixed A serializable object
	 */
	public function jsonSerializable();
}
