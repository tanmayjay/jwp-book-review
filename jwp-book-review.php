<?php

/**
 * Plugin Name:       JWP Book Review
 * Plugin URI:        https://github.com/tanmayjay/wordpress/tree/master/6-Custom-Post_types/jwp-book-review-1.0.1
 * Description:       A plugin to a custom post type and handles all the functionality related to that.
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tanmay Kirtania
 * Author URI:        https://linkedin.com/in/tanmay-kirtania
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jwp-book-review
 * 
 * 
 * Copyright (c) 2020 Tanmay Kirtania (jktanmay@gmail.com). All rights reserved.
 * 
 * This program is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see the License URI.
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class JWP_Book_Review {
    
    /**
     * Static class object
     *
     * @var object
     */
    private static $instance;

    const version   = '1.1.0';
    const domain    = 'jwp-book-review';
    const post_type = 'book';
    const taxonomy  = 'genre';

    /**
     * Private class constructor
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Private class cloner
     */
    private function __clone() {}

    /**
     * Initializes a singleton instance
     * 
     * @return \JWP_Book_Review
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Defines the required constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'JWP_BR_VERSION', self::version );
        define( 'JWP_BR_FILE', __FILE__ );
        define( 'JWP_BR_PATH', __DIR__ );
        define( 'JWP_BR_URL', plugins_url( '', JWP_BR_FILE ) );
        define( 'JWP_BR_ASSETS', JWP_BR_URL . '/assets' );
        define( 'JWP_BR_DOMAIN', self::domain );
        define( 'JWP_BR_POST_TYPE', self::post_type );
        define( 'JWP_BR_TAXONOMY', self::taxonomy );
    }

    /**
     * Updates info on plugin activation
     *
     * @return void
     */
    public function activate() {
        $activator = new JWP\JBR\Activator();
        $activator->run();
    }

    /**
     * Initializes the plugin
     *
     * @return void
     */
    public function init_plugin() {
        load_plugin_textdomain( JWP_BR_DOMAIN, false, dirname( plugin_basename( __file__ ) ) . '/assets/languages' );
        new JWP\JBR\Custom();
        new JWP\JBR\Frontend();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \JWP_Book_Review
 */
function jwp_book_review() {
    return JWP_Book_Review::get_instance();
}

//kick off the plugin
jwp_book_review();