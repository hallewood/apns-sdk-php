# Apple Push Notification Service (PHP-SDK)

Send a notification
```php
use Hallewood\APNS\ApplicationBundle;
use Hallewood\APNS\Notification;

//
// Define bundle identifier, team id, key id and path to the private key file
ApplicationBundle::shared('com.bundle.identifier', 'ABC7890', 'K1234567', '/path/to/key/file.p8');

(new Notification())
	->title('Hello, world!')
	->body('My very first notification')
	->sound('default', true)
	->push('ec0aebfb4ec465e294c2afaf291cb3e4df5aeee934ed11fbdad7258724336896');
```

Send a notification to multiple devices:
```php
$deviceTokens = ['token-1', 'token-2', 'token-3'];

$notificationForAll = (new Notification())
	->title('Hello, world!')
	->body('My very first notification')
	->sound('default', true);

//
// Prepare notifications for specific device tokens
$notificationForAll->push($deviceTokens, function (Notification $notification, string $deviceToken) {
	if ($deviceToken == 'token-2') {

		//
		// The second device token receives an additional subtitle
		$notification->subtitle('You are the second to receive a notification');
	}

	return $notification;
});
```

Send a notification to multiple apps:
```php
use Hallewood\APNS\ApplicationBundle;
use Hallewood\APNS\Notification;
use Hallewood\APNS\Dispatcher;
use Hallewood\APNS\Dispatch\DispatchUnit;

$firstAppBundle  = new ApplicationBundle('com.developer.first-app', 'ABC7890', 'K1234567', '/path/to/key/file.p8');
$secondAppBundle = new ApplicationBundle('com.developer.second-app', 'ABC7890', 'K1234567', '/path/to/key/file.p8');

$notification = (new Notification())
	->title('Hello, world!')
	->body('This is a notification received by multiple apps')
	->sound('default', true)

$dispatcher = new Dispatcher();
$dispatcher
	->addDispatchUnit(new DispatchUnit($notification, ['token-1', 'token-2', 'token-3'], $firstAppBundle))
	->addDispatchUnit(new DispatchUnit($notification, ['token-4', 'token-5', 'token-6'], $secondAppBundle))
	->push();
```
