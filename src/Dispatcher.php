<?php

namespace Hallewood\APNS;

use Hallewood\APNS\Dispatch\DispatchUnit;
use Hallewood\APNS\Dispatch\DispatchResult;

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

	/**
	 * Pushes all notification currently stored in the dispatcher
	 * @method push
	 * @param  boolean $debug Whether to use the production or the development apns
	 * @return array          An array of results
	 */
	public function push(bool $debug = false) : array {
		$results = [];

		foreach ($this->dispatchUnits as $dispatchUnit) {

			$jws = $this->jws($dispatchUnit);

			foreach ($dispatchUnit->getDeviceTokens() as $deviceToken) {

				$dispatchResult = $this->request(
					$dispatchUnit->getNotification(),
					$deviceToken,
					$dispatchUnit->getApplicationBundle(),
					false
				);

				array_push($results, $dispatchResult);
			}
		}

		return $results;
	}

	/**
	 * Generates a JSON Web Signature used to authenticate the notification to the APNS
	 * @method jwt
	 * @param  DispatchUnit $dispatchUnit The dispatch unit
	 * @return string                     The JWS
	 */
	private function jws(DispatchUnit $dispatchUnit) : string {
		$header = base64_encode(json_encode([
			'alg'	=> 'ES256',
			'kid'	=> $dispatchUnit->getApplicationBundle()->getBundleIdentifier()
		]));

		$claim = base64_encode(json_encode([
			'iss'	=> $dispatchUnit->getApplicationBundle()->getTeamId(),
			'iat'	=> time()
		]));

		$token = $header.'.'.$claim;

		$keyfileContents = file_get_contents($dispatchUnit->getApplicationBundle()->getKeyPath());
		$privateKey = openssl_pkey_get_private('file://'.$dispatchUnit->getApplicationBundle()->getKeyPath());

		$signature;
		openssl_sign($token, $signature, $keyfileContents, 'sha256');
		$sign = base64_encode($signature);

		return $token.'.'.$sign;
	}

	/**
	 * Generates a request for the push notification
	 * @method request
	 * @param  Notification      $notification The notification
	 * @param  string            $deviceToken  The device token
	 * @param  ApplicationBundle $bundle       The application bundle
	 * @param  boolean           $debug        Whether to use a production or development environment
	 * @return DispatchResult                  A result
	 */
	private function request(Notification $notification, string $deviceToken, ApplicationBundle $bundle, bool $debug = false) : DispatchResult {
		$host	= $debug ? 'api.development.push.apple.com' : 'api.push.apple.com';
		$url	= 'https://'.$host.'/3/device/'.$deviceToken;

		$header	= [
			'apns-topic: '.$bundle->getBundleIdentifier(),
			'Authorization: bearer '.$jsw
		];

		$request = curl_init();
		curl_setopt_array($request, array(
			CURLOPT_HTTP_VERSION	=> CURL_HTTP_VERSION_2_0,
			CURLOPT_URL				=> $url,
			CURLOPT_PORT			=> 443,
			CURLOPT_HTTPHEADER		=> $header,
			CURLOPT_POST			=> TRUE,
			CURLOPT_POSTFIELDS		=> json_encode($notification->jsonSerializable()),
			CURLOPT_RETURNTRANSFER	=> TRUE,
			CURLOPT_TIMEOUT			=> 30,
			CURLOPT_SSL_VERIFYPEER	=> FALSE,
			CURLOPT_HEADER			=> 1
		));

		$result = curl_exec($request);

		$dispatchResult = new DispatchResult($notification, $deviceToken, $bundle);
		$dispatchResult->setResult($result);

		if ($result !== false) {
			$info = curl_getinfo($request);
			$dispatchResult->setInfo($info);
		}

		return $dispatchResult
	}
}
