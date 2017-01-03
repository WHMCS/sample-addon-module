# WHMCS Sample Addon Module #

## Summary ##

An addon module allows you to add additional functionality to WHMCS. It
can provide both client and admin facing user interfaces, as well as
utilise hook functionality within WHMCS.

This sample file demonstrates how an addon module for WHMCS should be
structured and exercises all supported functionality.

For more information, please refer to the online documentation at
https://developers.whmcs.com/addon-modules/

## Recommended Module Content ##

The recommended structure of an addon module is as follows.

```
 addonmodule/
  |- lang/
  |- lib/
  |- templates/
  |  addonmodule.php
  |  hooks.php
  |  logo.png
```

## Minimum Requirements ##

For the latest WHMCS minimum system requirements, please refer to
http://docs.whmcs.com/System_Requirements

We recommend your module follows the same minimum requirements wherever
possible.

## Tests ##

We strongly encourage you to write unit tests for your work. Within this SDK we
provide a sample unit test based upon the widely used PHPUnit.

## Useful Resources
* [Developer Portal](https://developers.whmcs.com/)
* [Hook Documentation](https://developers.whmcs.com/hooks/)
* [API Documentation](https://developers.whmcs.com/api/)

[WHMCS Limited](https://www.whmcs.com)
