# Nuonce
Nuonce tries to simplify the handling with Nonces in PHP OOP. 
## Install

```
composer require Darkflameninja/Nuonce
```

Or just add

```
"require Darkflameninja/Nuonce": "0.0.1"
```
to your `composer.json` file and run a composer update.

## Usage:
### Define your action & nonce
```php
$obj = new Nuonce($action $nonce)
```
### Create an URL
```php
$url = Nuonce::url($url);
```

### Create a nonce field
```php
Nuonce::field();
```

You also can set the referer as first parameter

```php
$referer = 'http://mysite.com/something';
Nuonce::field($referer);
```

Skip the referer by setting it false. 
```php
Nuonce::field($referer, false);
```


### Create a nonce

```php
$nonce = Nuonce::create();
```

### Check an URL for a valid nonce
```php
$retval = Nuonce::checkAdminReferer();
```

### Check an AJAX URL for a valid nonce
```php
$queryArg = '_myNonce';
$retval = Nuonce::check_ajax_referer($queryArg);
```

If the third parameter is set to false, the script won't die, if the nonce is invalid

```php
$retval = Nuonce::check_ajax_referer($action, $queryArg, false);
```

### Verify a nonce
```php
$retval = Nuonce::verify();
```
