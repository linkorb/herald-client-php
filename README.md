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
## CLI usage
```sh
#!/bin/sh

common_param="\
--username=api_username \
--password=api_password \
--apiurl=http://localhost:8787/api/v2 \
--account=test \
--library=test"

# get list of all contact lists
bin/herald-client list:list ${common_param}

# get list of contacts in contact list #1
bin/herald-client list:contacts ${common_param} --listId=1

# get list of segments for list #1
bin/herald-client list:segments ${common_param} --listId=1

# get available list_fields for list #1
bin/herald-client list:fields ${common_param} --listId=1

# delete contact #42
#bin/herald-client contact:delete ${common_param} --contactId=42

# get properties of contact #6
bin/herald-client contact:properties ${common_param} --contactId=6

# add new contact with address 'new.contact@example.com' to list #1
bin/herald-client contact:add ${common_param} --listId=1 --address=new.contact@example.com

# add new property to contact #36
bin/herald-client property:add ${common_param} --contactId=36 --listFieldId=4 --value="some value"

# send message based on tamplate #1 to all contacts in list #1
bin/herald-client list:send ${common_param} --listId=1 --templateId=1

# send message based on tamplate #1 to contacts in list #1 that meet the conditions for segment #6
bin/herald-client list:send ${common_param} --listId=1 --templateId=1 --segmentId=6

