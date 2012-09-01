<?php

if ( !defined( 'MEDIAWIKI' ) ) die( 'This file is meant to be used by mediawiki.' );

class ImageLoader {

	public static function init( Parser &$parser ) {
		// add the parser hook
		$parser->setFunctionHook( 'image', 'ImageLoader::parserFunction' );
		
		// return true so that MW can continue
		return true;
	}
	
	private static function error( $message, $arg = false ) {
		return '<strong class="error">'
			. wfMessage( 'error-prefix' )->plain() 
			. ( !$arg ? wfMessage( $message )->plain() : wfMessage( $message, $arg )->plain() )
			. '</strong><br />';
	}
	
	public static function parserFunction( &$parser, $class = false, $arg = false ) {
		global $wgImagePrefix, $wgImageSuffix;

//		$parser->disableCache();

		if ( !$class )
			return self::error( 'no-class' );
		// first check the class, otherwise if someone uses {{#image:class{{!}}argument}},
		// they get a no-argument error instead of the invalid-image-class error, which is confusing.
		// (the class is in this case class|argument, which is obviously not what we want)
		if ( !$wgImagePrefix[$class] || !$wgImageSuffix[$class] )
			return self::error( 'invalid-class', $class );
		if ( !$arg )
			return self::error( 'no-argument' );
	
		return $parser->insertStripItem(
			'<img src="' . $wgImagePrefix[$class] . $arg . $wgImageSuffix[$class] . '"></img>',
			$parser->mStripState
		);
	}

}