<?php

namespace JWP\JBR;

/**
 * Custom classes handler class
 */
class Custom {
    
    /**
     * Class cinstructor
     */
    function __construct() {
        $custom_post_type = new Custom\Post_Type();
        $custom_post_type->init();
    }
}