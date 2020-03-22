<?php

namespace Hallewood\APNS;

use Hallewood\APNS\Dispatch\DispatchUnit;

class Dispatcher {

	/**
	 * An set of dispatch units with an identifier
	 * @var DispatchUnit[]
	 */
	protected $dispatchUnits = [];

	/**
	 * Adds a dispatch unit to the set
	 * @method addDispatchUnit
	 * @param  string          $identifier The identifier of the dispatch unit^
	 * @param  DispatchUnit    $unit       The dispatch unit
	 * @return self                        The NotificationDispatcher instance for further chaining
	 */
	public function addDispatchUnit(DispatchUnit $unit) : self {
		array_push($this->dispatchUnits, $unit);

		return $this;
	}

	public function push() : void {
		foreach ($this->dispatchUnits as $unit) {
			
		}
	}
}
