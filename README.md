ValidationBundle
=============

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

Usage
------------

Using validation.yml 

``` yaml
Acme\DemoBundle\Entity\Message:
  getters:
    text:
      - TuxOne\ValidationBundle\Validator\Constraints\ContainsBadWords: ~
```
