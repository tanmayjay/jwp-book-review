<?php

namespace JWP\JBR\Frontend;

/**
 * Template handler class
 */
class Template {

    /**
     * Refers the template locations
     *
     * @var string
     */
    public static $template_location = __DIR__ . '/templates';

    /**
     * Class constructor
     */
    function __construct() {
        add_filter( 'template_include', [ $this, 'book_template' ] );
    }
    
    /**
     * Includes the template files
     *
     * @param string $template
     * 
     * @return string
     */
    public function book_template( $template ) {

        if ( is_page( 'book' ) ) {
            $new_template = self::$template_location . '/archive-book.php';
            if ( file_exists( $new_template ) ) {
                return $new_template ;
            }
        }

        if ( is_singular( 'book' ) ) {
            $new_template = self::$template_location . '/single-book.php';
            if ( file_exists( $new_template ) ) {
                return $new_template ;
            }
        }

        return $template;
    }
}