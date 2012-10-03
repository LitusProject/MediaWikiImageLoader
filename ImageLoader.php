<?php

if ( !defined( 'MEDIAWIKI' ) ) die( 'This file is meant to be used in mediawiki.' );

/* The photo URL of {{#image:arg1|arg2}} is $wgImagePrefix[arg1]arg2$wgImageSuffix[arg1] */
$wgImagePrefix = array();
$wgImageSuffix = array();

/**
 * Add extension information to Special:Version
 */
$wgExtensionCredits['parserhook'][] = array(
    'path' => __FILE__,
    'name' => 'ImageLoader',
    'version' => '0.1',
    'author' => '[https://github.com/LitusProject The Litus Project]',
    'descriptionmsg' => 'description-message',
    'url' => 'https://github.com/LitusProject/MediaWikiImageLoader'
);

/* Add our class to the autoloader */
$wgAutoloadClasses['ImageLoader'] = dirname( __FILE__ ) . '/ImageLoader.body.php';

/* Add our initialization function to the hook */
$wgHooks['ParserFirstCallInit'][] = 'wfImageLoaderInit';

/* Install the 'magic word' image */
$wgExtensionMessagesFiles['ImageLoaderMagic'] = dirname( __FILE__ ) . '/ImageLoader.i18n.magic.php';

/* Install our i18n */
$wgExtensionMessagesFiles['ImageLoader'] = dirname( __FILE__ ) . '/ImageLoader.i18n.php';

/* Initialisation function */
function wfImageLoaderInit( Parser &$parser ) {
    // add the parser hook
    $parser->setFunctionHook( 'image', 'ImageLoader::parserFunction' );
        
    // return true so that MW can continue
    return true;
}
