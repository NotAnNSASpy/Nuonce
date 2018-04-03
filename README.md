# Nuonce
Nuonce tries to simplify the handling with Nonces in PHP OOP. 
## Install

```
composer require Darkflameninja/Nuonce
```

Or just add

```
"require Darkflameninja/Nuonce": "1.0"
```
to your `composer.json` file and run a composer update.

## Usage:
### Define your action & nonce
```php
$yourobj = new Nuonce($action, $nonce); // if your input == ''(in both cases),it's predefined as action = nonce_action & nonce = _wpnonce
```
### Create an URL
```php
$url = $yourobj->url($url, $name);
```

### Create a nonce field
```php
$yourobj->field($name);
```

You also can set the referer as first parameter

```php
$referer = 'http://mysite.com/something';
$yourobj->field($referer);
```

Skip the referer by setting it false. 
```php
$yourobj->field($referer, false);
```


### Create a nonce

```php
$nonce = $yourobj->create();
```

### Check an URL for a valid nonce
```php
$retval = $yourobj->AdminReferer($queryArg);
```

### Check an AJAX URL for a valid nonce
```php
$queryArg = '_myNonce';
$retval = $yourobj->AjaxReferer($queryArg);
```

If the third parameter is set to false, the script won't die, if the nonce is invalid

```php
$retval = $yourobj->AjaxReferer($queryArg, false);
```

### Verify a nonce
```php
$retval = $yourobj->verify();
```
