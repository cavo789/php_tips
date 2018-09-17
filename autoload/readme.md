# PHP Tricks - Autoload

> Don't require_once your classes anymore

Based on the work of SHAMIL CHOUDHURY, [Autoloading classes in PHP 7](https://shamil.xyz/autoloading-classes-php-7/)

## Table of Contents

- [Install](#install)
- [Usage](#usage)
- [License](#license)

## Install

1. Get a copy of the [autoloader.php](autoloader.php) file and save it in your PHP project root folder.
2. Edit the `autoloader.php` file and change the line `namespace MyApp;` with your own namespace.
3. Save the file.

## Usage

In the loading phase of your application, add the two lines in your code:

```php
require_once 'autoloader.php';
$autoload = new ClassLoader();
```

See the file[test.php](test.php) for an example.

From now, you don't need to require your own classes; the autoload feature will do it for you :tropical_drink:

## License

[MIT](LICENSE)
