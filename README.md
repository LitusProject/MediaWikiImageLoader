MediaWikiImageLoader
====================

An image loader for mediawiki, allowing users to include images with URL's not ending in .jpg or .png. Only allows images of predefined classes, genre $prefix$argument$suffix, with only $argument set by the users.

## Installation
To install, execute in a terminal:
```bash
cd <your mediawiki installation>/extensions
git clone https://github.com/bgotink/MediaWikiImageLoader.git ImageLoader
```

Add to your LocalSettings.php, somewhere at the bottom:
```php
require_once($IP . '/extensions/ImageLoader/ImageLoader.php');
```
__Below that line__, add for every "class" of images you want to load:
```php
$wgImagePrefix['classname'] = 'prefix';
$wgImageSuffix['classname'] = 'suffix';
```

## Usage
Now, you can use the class in MediaWiki:
```
{{#image: classname| argument}}
```
This will add an image with the url 'prefixargumentsuffix'.

## Example
For the [KU Leuven](http://www.kuleuven.be) staff who-is-who:
The following configuration in LocalSettings.php
```php
require_once($IP . '/extensions/ImageLoader/ImageLoader.php');
$wgImagePrefix['prof'] = 'http://www.kuleuven.be/wieiswie/nl/person/0';
$wgImageSuffix['prof'] = '/photo';
```
This allows adding prof. Dutré with his university ID:
```
{{#image: prof | 0016791 }}
```