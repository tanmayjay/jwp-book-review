<?php

namespace JWP\JBR;

/**
 * Plugin activator class
 */
class Activator {

    /**
     * Runs the activator
     *
     * @return void
     */
    public function run() {
        $this->add_info();
    }

    /**
     * Adds activation info
     *
     * @return void
     */
    public function add_info() {
        $activated = get_option( 'jwp_br_installed' );

        if ( ! $activated ) {
            update_option( 'jwp_br_installed', time() );
        }

        update_option( 'jwp_br_version', JWP_BR_VERSION );
    }
}