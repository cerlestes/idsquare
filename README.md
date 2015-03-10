idsquare
========

idsquare is a small and easy-to-use library that creates identicons (unique images used for identification) from simple squares with beautiful colors.

![Example 1](http://i.imgur.com/qWvLBb0.png) 
![Example 2](http://i.imgur.com/pLomZq2.png) 
![Example 3](http://i.imgur.com/VLg0cT0.png) 
![Example 4](http://i.imgur.com/BJKUgPE.png) 
![Example 5](http://i.imgur.com/9bzvIwb.png)



How to use?
-----------

All you have to do in order to generate your own identicons using idsquare is just one little function call:

```php
<?php

require('idsquare.php');

\Cerlestes\IdSquare\output( "my-email-address@tld.com" );
```

This is a shortcut-function for the underlying IdSquare class:

```php
<?php

require('idsquare.php');

$idsquare = new \Cerlestes\IdSquare\IdSquare( "my-email-address@tld.com" );
$idsquare->generateAndOutput();
```



Requirements
------------

idsquare requires PHP 5.x or newer with an installed GDLib.



License
-------

idsquare is released under the [MIT license](http://www.opensource.org/licenses/MIT).