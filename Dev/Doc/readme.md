The Dev plugin provides a code that can help with the development of Infinitas based code. These include things such as shells for finding code that does not have tests, and behaviors for generating more information on what queries are being run.

### Shells

The shells provide access to information about the code base, such as generating reports on what has not been tested.

#### Todo Shell

	[E]verything
	[M]issing Tests
	[S]tandards
	[C]yclomatic complexity
	[T]odo's

Missing tests display a list of files that do not have test cases written. When run, the shell will scan the entire project to get a list of all the `php` files along with the corresponding `test` files. You will then be presented with a list of files where tests are not available

> This will report tests as missing if the files are not named according to the correct conventions. Eg: given a model at `/Users/Model/User.php` the corresponding test would be `/Users/Test/Case/Model/User.php`. Please see [this](/infinitas\_docs/Dev/developer-testing) for more information on testing.

An example of the output might look something like the following, showing the class and location of the offending file:

	-- SomePlugin ---
	Controller
		SomePluginController        	APP/Plugin/SomePlugin/Controller/SomePluginController.php
	Lib
		SomePluginLib               	APP/Plugin/SomePlugin/Lib/SomePlugin.php
	Model
		SomePluginModel                 APP/Plugin/SomePlugin/Model/SomePluginModel.php
	Shell
		SomePluginTask1                 APP/Plugin/SomePlugin/Console/Command/Task/SomePluginTask1.php
		SomePluginTask2                 APP/Plugin/SomePlugin/Console/Command/Task/SomePluginTask2.php
		SomePluginTask3                 APP/Plugin/SomePlugin/Console/Command/Task/SomePluginTask3.php

	-- AnotherPlugin --
	..

#### Standards

This option will run throug the entire code base checking that the code format is correct. Infinitas plugins and core code should be developed using the same coding style as is found in the [CakePHP](http://book.cakephp.org/2.0/en/contributing/cakephp-coding-conventions.html) framework.

> Some existing code still needs to be updated to be exactly the same as the CakePHP coding standards.

#### Cyclomatic complexity

This option will check the [cyclomatic complexity](http://en.wikipedia.org/wiki/Cyclomatic_complexity) of the code base and report back any files that have a very high complexity. This can help identify issues in the code base and make things generally easier to maintain and contribute to.

#### Todo

This option will run through the code base looking for documentation that includes the `@todo` tag. This is similar to what some IDE's provide but makes the data available in the shell

### Relations

This shell is used for generating relational diagrams of the various models within the codebase. It is generated using the relations defined in a model and used for generating relational images for the API documentation.