<?php

if ( !defined( 'MEDIAWIKI' ) ) exit;

/* The photo URL of {{#image:arg1|arg2}} is $wgImagePrefix[arg1]arg2$wgImageSuffix[arg1] */
$wgImagePrefix = array();
$wgImageSuffix = array();

/**
 * Add extension information to Special:Version
 */
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Image Plugin',
	'version' => '0.1',
	'author' => '[https://github.com/LitusProject The Litus Project]',
	'description' => 'Inserting images using the <nowiki>{{#image}}</nowiki> function.',
	'url' => 'https://github.com/LitusProject/MediaWikiImageLoader'
);

/* Add our initialization function to the hook */
$wgHooks['ParserFirstCallInit'][] = 'ImageLoaderInit';

/* Install the 'magic word' image */
$wgExtensionMessagesFiles['ImageLoaderMagic'] = dirname( __FILE__ ) . '/ImageLoader.i18n.magic.php';

function ImageLoaderInit( &$parser ) {
	// Create the parser function {{#image:}}
	$parser->setFunctionHook( 'image', 'ImageLoaderParserFunction' );
	
	// return true so that MediaWiki continues
	return true;
}

function ImageLoaderError( $message ) {
	return '<strong class="error">ImageLoader Error: ' . $message . '</strong>';
}

function ImageLoaderParserFunction( &$parser, $class = false, $arg = false ) {
	global $wgImagePrefix, $wgImageSuffix;
	
	$parser->disableCache();

	if ( !$class )
		return ImageLoaderError( 'no image class given.' );
	if ( !$wgImagePrefix[$class] || !$wgImageSuffix[$class] )
		return ImageLoaderError( 'not a valid class argument: ' . $class . ' or the class is not configured properly.' );
	if ( !$arg )
		return ImageLoaderError( 'no image argument given.' );
	
	return $parser->insertStripItem(
		'<img src="' . $wgImagePrefix[$class] . $arg . $wgImageSuffix[$class] . '"></img>',
		$parser->mStripState
	);
}
