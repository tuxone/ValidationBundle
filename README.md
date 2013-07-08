ValidationBundle
=============

[![Travis](https://api.travis-ci.org/aloffredo/ValidationBundle.png?branch=master)](https://travis-ci.org/aloffredo/ValidationBundle)

This Symfony2 bundle includes bad words validation based on blacklists. The english blacklist provided comes from [here](http://photos.ramseym.com/pictures/blog/badwords_for_facebook_pages.txt).

Installation
------------

Use Composer to install: ``tuxone/validation-bundle``.

In your ``composer.json`` you should have:

``` yaml
    {
        "require": {
            "tuxone/validation-bundle": "dev-master"
        }
    }
```

Configuration
------------

### In config.yml

    tux_one_validation:
        dictionaryPath: /path/to/custom/dictionary.txt

"dictionary.txt" is a custom dictionary that contains a list of bad word.
This configuration is optionally. If setted, the bundle works with your custom bad word list,
otherwise it will work with the default bad word list.


Usage
------------


If **TuxOneValidationBundle** has been added to the project, its validators can be used just like every other Symfony2 validator.

### Using with YAML

	# src/Acme/DemoBundle/Resources/config/validation.yml
	Acme\DemoBundle\Entity\AcmeMessage:
	  properties:
	    text:
	      - TuxOne\ValidationBundle\Validator\Constraints\NotContainsBadWords: ~

### Using with Annotations

	// src/Acme/DemoBundle/Entity/AcmeMessage.php
	use Symfony\Component\Validator\Constraints as Assert;
	use TuxOne\ValidationBundle\Validator\Constraints as TuxOneAssert;

	class AcmeEntity
	{
		// ...

		/**
		 * @Assert\NotBlank
		 * @TuxOneAssert\NotContainsBadWords()
		 */
		protected $text;

		// ...
    }

License
--------

### The MIT License (MIT)

Copyright (c) 2013 Alessandro Loffredo

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
