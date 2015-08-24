Herald PHP client
==============

Send beautiful messages from your application.

## Installation
```
composer require herald-project/client-php
```

## Example
```php
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message as HeraldMessage;

// get the client
$herald = new HeraldClient(
    '[herald api username]',
    '[herald api password]',
    '[herald server uri]',
    '[herald transport, e.g. smtp]')
);

// check template existance.
if ($herald->templateExists('signup')) {
    // get the message
    $message = new HeraldMessage();
    // use the template
    $message->setTemplate('signup');
    // set to address
    $message->setToAddress($emailAddress, $customerName);
    // populate data
    $message->setData('firstname', 'Hongliang');
    $message->setData('nickname', 'exploder hater');
    // send
    $herald->send($message);
}
```
