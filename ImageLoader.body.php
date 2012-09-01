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
			. wfMsg( 'error-prefix' ) 
			. ( !$arg ? wfMsg( $message ) : wfMsg( $message, $arg ) )
			. '</strong>';
	}
	
	public static function parserFunction( &$parser, $class = false, $arg = false ) {
		global $wgImagePrefix, $wgImageSuffix;

//		$parser->disableCache();

		if ( !$class )
			return self::error( 'no-image-class' );
		// first check the class, otherwise if someone uses {{#image:class{{!}}argument}},
		// they get a no-argument error instead of the invalid-image-class error, which is confusing.
		// (the class is in this case class|argument, which is obviously not what we want)
		if ( !$wgImagePrefix[$class] || !$wgImageSuffix[$class] )
			return self::error( 'invalid-image-class', $class );
		if ( !$arg )
			return self::error( 'no-argument' );
	
		return $parser->insertStripItem(
			'<img src="' . $wgImagePrefix[$class] . $arg . $wgImageSuffix[$class] . '"></img>',
			$parser->mStripState
		);
	}

}