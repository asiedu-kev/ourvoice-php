Ourvoice's REST API for PHP
===============================
This repository contains the open source PHP client for Ourvoice's REST API.
Documentation can be found at: https://api-docs.getourvoice.com/

Requirements
-----

- [Sign up](https://app.getourvoice.com/auth/register) for a free Ourvoice account
- Create a new access_key in the developers sections
- Ourvoice API client for PHP requires PHP >= 7.4.

Installation
-----

#### Composer installation

- [Download composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
- Run `composer require ourvoice/php`.

#### Manual installation

When you do not use Composer. You can git checkout or download [this repository](https://github.com/shadonet/ourvoice-php) and include the Ourvoice API client manually.


Usage
-----

We have put some self-explanatory examples in the *examples* directory, but here is a quick breakdown on how it works. First, you need to set up a **MessageBird\Client**. Be sure to replace **YOUR_ACCESS_KEY** with something real.

```php

$ourvoice = new \Ourvoice\Client('YOUR_API_KEY');

```

That's easy enough. Now we can query the server for information. Lets use getting your campaigns overview as an example:

```php
// Get your balance
$myCampaigns = $ourvoice->campaigns->getList();
```

Documentation
----
Complete documentation, instructions, and examples are available at:
[https://api-docs.getourvoice.com/](https://api-docs.getourvoice.com/)


License
----
The Ourvoice REST Client for PHP is licensed under [The MIT License](https://opensource.org/license/mit-0/). Copyright (c) 2014, MessageBird
