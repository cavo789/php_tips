![Banner](images/banner.jpg)

# PHP Tricks

> Collection of PHP tips and tricks

* [Coding tips](#coding-tips)
  * [Assert](#assert)
  * [Avoid option arrays in constructors](#avoid-option-arrays-in-constructors)
  * [Never use public properties](#never-use-public-properties)
  * [Throw exceptions not false](#throw-exceptions-not-false)
* [Tools](#tools)
  * [Code Quality](#code-quality)
    * [PHAN](#phan)
    * [PHP Copy/Paste Detector](#php-copypaste-detector)
    * [PHP-CS-Fixer](#php-cs-fixer)
    * [PHPStan](#phpstan)
    * [PHP Mess Detector](#php-mess-detector)
  * [Others](#others)
* [Links](#links)
* [License](#license)

## Coding tips

### Assert

[https://github.com/webmozart/assert](https://github.com/webmozart/assert)

Stop to create your own exceptions and code like:

```php
public function __construct($id)
{
    if ($id !== (int) î$id) {
        throw new InvalidArgumentException(
            sprintf('The ID must be an integer. Got: %s',$id)
        );
    }
    
    if ((int) $id < 1) {
        throw new InvalidArgumentException(
            sprintf('The ID must be a positive integer. Got: %s',$id)
        );
    }
}
```

Use `webmozart/assert` to make sure assertion in a cleaner and faster way:

```php
public function __construct($id)
{
    Assert::integer($id, 'The employee ID must be an integer. Got: %s');
    Assert::greaterThan($id, 0, 'The employee ID must be a positive integer. Got: %s');
}
```

[Read more](http://bestpractices.thecodingmachine.com/php/defensive_programming.html#use-an-assertion-library)

**Important: all assertions in the `Assert` class throw an `\InvalidArgumentException` if they fail.**

* [List of existing assertions](https://github.com/webmozart/assert#type-assertions)

### Avoid option arrays in constructors

Using an array in a constructor makes impossible to know what the constructor really needs. Which keys in the array should be provided? The programmer who'll use the constructor can't know this without reading the documentation or the source code.

Instead of using an array, prefer to use an object like a `Configuration` class.

[Read more](http://bestpractices.thecodingmachine.com/php/design_beautiful_classes_and_methods.html#avoid-option-arrays-in-constructors)

### Never use public properties

A public property is accessible outside the class and can, f.i., be unset. A programmer can modify the property and thus break the class.

[Read more](http://bestpractices.thecodingmachine.com/php/design_beautiful_classes_and_methods.html#never-use-public-properties)

### Throw exceptions not false

When writing a function, you should throw exceptions for error management instead of returning a boolean. 

```php
function writeDateInFile(): void {
    $result = file_put_contents("date", date("Y-m-d"));
    if (false === $result) {
        throw new FileWriteException("There was a problem writing file 'date'");
    }
}
```

[Read more](http://bestpractices.thecodingmachine.com/php/error_handling.html#using-exceptions)

* [PHP Safe, PHP functions, rewritten to throw exceptions instead of returning false](https://github.com/thecodingmachine/safe)
* [phpstan-safe-rule](https://github.com/thecodingmachine/phpstan-safe-rule)

## Tools

### Code Quality

#### PHAN

A static analyzer based on PHP 7+ and the php-ast extension.

> [https://github.com/phan/phan](https://github.com/phan/phan)

#### PHP Copy/Paste Detector

Copy/Paste Detector (CPD) for PHP code.

> [https://github.com/sebastianbergmann/phpcpd](https://github.com/sebastianbergmann/phpcpd)

#### PHP-CS-Fixer

PHP-CS-Fixer, a tool to automatically fix PHP coding standards issues

> [https://github.com/FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

#### PHPStan

A PHP Static Analysis Tool.

> [https://github.com/phpstan/phpstan](https://github.com/phpstan/phpstan)

Additional rules:

* [PHPStan Strict rules](https://github.com/thecodingmachine/phpstan-strict-rules/)

#### PHP Mess Detector

> [https://github.com/phpmd/phpmd](https://github.com/phpmd/phpmd)

A library that scans code for bugs, sub-optimal code, unused parameters and more.

### Others

* [Visual Studio Code](https://code.visualstudio.com/)
* [PHP_CodeSniffer tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards](https://github.com/squizlabs/PHP_CodeSniffer)
* [Composer](https://github.com/composer/composer)
* [PhpUnit](https://github.com/sebastianbergmann/phpunit)
* [Monolog](https://github.com/Seldaek/monolog)
* [Xdebug](https://xdebug.org/)

## Links

* [TheCodingMachine - Best practices](http://bestpractices.thecodingmachine.com/)
* [PHP Framework Interop Group](https://www.php-fig.org/)
* [PHP The Right Way](https://phptherightway.com/)

## License

[MIT](LICENSE)
