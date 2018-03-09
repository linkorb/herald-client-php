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

// get the client with explicit parameters
$herald = new HeraldClient(
    '[herald api username]',
    '[herald api password]',
    '[herald server uri]',
    '[herald transport, e.g. smtp]'),
    '[herald account]',
    '[herald library]',
);

// get the client by DSN

$herald = HeraldClient::fromDsn('https://username:password@herald.dev/myAccount/myLibrary/myTransport');


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
## CLI usage

You can use the `bin/herald-client` CLI application to run commands against your herald server.

The application needs a couple of configuration directives to work:

* username + password: The account you use to connect. Either a user account, or an API key+secret pair
* apiurl: the base url of herald, (i.e. https://herald.dev) with postfix `/api/v2`
* account + library: This is the library identifier you use to create your templates, layouts and transports

You can pass this data in 3 ways:

### Individual options:

For example:

    ./bin/herald-client --username=x --password=y --apiurl=https://herald.dev/api/v2 --account=test --library=test template:exists welcome

### A single DSN

For example:

    ./bin/herald-client --dsn=https://x:y@herald.dev/test/test/mandrill

### By environment variables

You can define the environment variable `HERALD_DSN` with a valid URL, this way you don't
need to pass any options to the CLI application

### By .env

The Herald CLI application loads `.env` before running any commands, allowing you to create a `.env` file 
like this:

```ini
HERALD_DSN=https://x:y@herald.dev/test/test/mandrill
```

This way you also don't need to pass any options for each command

### Example commands

    # get list of all contact lists
    bin/herald-client list:list

    # get list of contacts in contact list #1
    bin/herald-client list:contacts 1

    # get list of segments for list #1
    bin/herald-client list:segments 1

    # get available list_fields for list #1
    bin/herald-client list:fields 1

    # delete contact #42
    #bin/herald-client contact:delete 42

    # get properties of contact #6
    bin/herald-client contact:properties 6

    # add new contact with address 'new.contact@example.com' to list #1
    bin/herald-client contact:add 1 new.contact@example.com

    # add new property to contact #36 for list field id #4
    bin/herald-client property:add 36 4 "some value"

    # send message based on template #7 to all contacts in list #1
    bin/herald-client list:send 1 7

    # send message based on template #1 to contacts in list #1 that meet the conditions for segment #6
    bin/herald-client list:send 1 7 6

