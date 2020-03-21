<?php

namespace Hallewood\APNS\Promises;

interface ContainsContent {

	/**
	 * Checks whether the instance currently has content
	 * @method hasContent
	 * @return bool       true if content is available, false otherwise
	 */
	public function hasContent() : bool;
}
