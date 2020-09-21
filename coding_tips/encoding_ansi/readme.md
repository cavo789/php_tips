# Convert ANSI to UTF-8

One of the worst situations to deal with with PHP is the management of accents. When allowing a user to upload a file to the site; it must be guaranteed that the format is UTF-8 and not ANSI otherwise accented characters will be broken.

PHP has functions for this but, in many cases, these funtions aren't available since they relies on an extension.

By using a polyfill, we'll be safe i.e. if the function isn't defined by PHP, the polyfill will implement it.

We'll use a Symfony package for this: [https://packagist.org/packages/symfony/polyfill-mbstring](https://packagist.org/packages/symfony/polyfill-mbstring)

The idea is to detect the encoding type of an existing file and, if it isn't possible to get the type, suppose the file is an ANSI one. Then, convert the file and override the existing file so, after the `file_put_contents` action, we're sure the file is UTF-8 and accents are correctly managed.

Sample code below:

```php
<!-- concat-md::include "./files/sample.txt" -->
```
