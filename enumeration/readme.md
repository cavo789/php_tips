# PHP Tricks - Enumeration

> Working with constants becomes easier

Description

## Table of Contents

- [Install](#install)
- [Usage](#usage)
- [License](#license)

## Install

1. Get a copy of the [enum.php](enum.php) file and save it in your PHP project root folder.
2. Edit the `enum.php` file and change the line `namespace MyApp;` with your own namespace.
3. Save the file.
4. In your code, create a class that will extends MyApp\Enum, for instance:

```php
class AllowedAction extends MyApp\Enum
{
	// The value (f.i. doAction1) should be the name of a
	// private function in the class.
	// So, for instance, by creating a new constant like "actionDoStuff3",
	// you will set a value to it (f.i. "doSomething") and that value
	// should be the name of a function that you need to create in
	// the class (==> function doSomething())
	const actionDoStuff1 = 'doAction1';
	const actionDoStuff2 = 'doAction2';
}
```

Then, the enumeration can be used as parameter of a function, for instance:

```php
public function doAnAction(AllowedAction $action) : array
{
	// $action is a string that is the name of a function, like f.i.
	// "doAction1" or "doAction2" ==> check that this function
	// is well defined in our present class.
	// If not, throw an error
	if (!is_callable('self::' . $action)) {
		throw new Exception(sprintf("'%s' isn't a valid " .
			'action; please review your code. The action should ' .
			'be defined in the '.__CLASS__.' and the ' .
			'assigned value should be a function of ' . __CLASS__ . ' ' .
			'So, in the current situation, you should have a function ' .
			'%s in ' . __CLASS__, $action, $action . '()'));
	}

	// Run the action
	//		$action is an instance of AllowedAction
	//		so we need to get the value f.i. "doAction1"
	$fctName = $action->value;
	//		$fctName is now a string and we can fire the action
	self::$fctName();

	// ...

}
```

It's then impossible to call `doAnAction()` with something wrong or an empty action. The programmer should call it with one of the existing action. We, then, are sure that the action is valid. `$class->runAction('Tadaaa');` is impossible.

In our `AllowedAction` class we've code thing like:

```php
const actionDoStuff1 = 'doAction1';
```

so define the function:

```php
private function doAction1()
{
	// do action 1
}
```

## Contribute

PRs not accepted.

## License

[MIT](LICENSE)
