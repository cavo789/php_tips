# Avoid option arrays in constructors

Using an array in a constructor makes impossible to know what the constructor really needs. Which keys in the array should be provided? The programmer who'll use the constructor can't know this without reading the documentation or the source code.

Instead of using an array, prefer to use an object like a `Configuration` class.

[Read more](http://bestpractices.thecodingmachine.com/php/design_beautiful_classes_and_methods.html#avoid-option-arrays-in-constructors)
