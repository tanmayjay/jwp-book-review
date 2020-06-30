<?php

namespace JWP\JBR\Custom;

/**
 * Custom taxonomy handler class
 */
class Taxonomy {

    /**
     * Initializes the class
     *
     * @return void
     */
    public function init() {
        add_action( 'init', [ $this, 'add' ] );
    }

    /**
     * Adds custom taxonomy
     *
     * @return void
     */
    public function add() {
        
        $labels = array(
            'name'              => _x( 'Genres', 'Taxonomy general name', JWP_BR_DOMAIN ),
            'singular_name'     => _x( 'Genre', 'Taxonomy singular_name', JWP_BR_DOMAIN ),
            'search_items'      => __( 'Search Genres', JWP_BR_DOMAIN ),
            'all_items'         => __( 'All Genres', JWP_BR_DOMAIN ),
            'parent_item'       => __( 'Parent Genre', JWP_BR_DOMAIN ),
            'parent_item_colon' => __( 'Parent Genre: ', JWP_BR_DOMAIN ),
            'edit_item'         => __( 'Edit Genre', JWP_BR_DOMAIN ), 
            'update_item'       => __( 'Update Genre', JWP_BR_DOMAIN ),
            'add_new_item'      => __( 'Add New Genre', JWP_BR_DOMAIN ),
            'new_item_name'     => __( 'New Genre', JWP_BR_DOMAIN ),
            'menu_name'         => __( 'Genre', JWP_BR_DOMAIN ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => JWP_BR_TAXONOMY ],
        );
            
        register_taxonomy( JWP_BR_TAXONOMY, JWP_BR_POST_TYPE, $args );
    }
}