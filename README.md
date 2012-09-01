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

## License
```
Copyright 2012 The Litus Project and other contributors
<https://github.com/LitusProject>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```
