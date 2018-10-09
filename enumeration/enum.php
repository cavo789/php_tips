<?php

/**
 * Enumeration helper
 *
 * @link https://beberlei.de/2009/08/31/enums-in-php.html
 */

declare(strict_types=1);

namespace MyApp;

abstract class Enum
{
	final public function __construct($value)
	{
		$c = new \ReflectionClass($this);
		if (!in_array($value, $c->getConstants())) {
			throw IllegalArgumentException();
		}
		$this->value = $value;
	}

	final public function __toString()
	{
		return $this->value;
	}
}