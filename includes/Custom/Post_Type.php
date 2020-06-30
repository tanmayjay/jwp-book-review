<?php

namespace JWP\JBR\Custom;

/**
 * Custom post type handler class
 */
class Post_Type {

    /**
     * Initializes the class
     *
     * @return void
     */
    public function init() {
        add_action( 'init', [ $this, 'add' ] );
        
        $post_updated_messages = new Updated_Messages();
        $post_taxonomy         = new Taxonomy();
        
        $post_updated_messages->init();
        $post_taxonomy->init();

        if ( is_user_logged_in() ) {
            if ( current_user_can( 'edit_posts' ) ) {
                $post_meta_box = new Auth\Meta_Box();
                $post_meta_box->create();
            }
        }
    }
    
    /**
     * Adds a custom post type
     *
     * @return void
     */
    public function add() {

        $labels = array(
            'name'                  => _x( 'Books', 'General name of post type', JWP_BR_DOMAIN ),
            'singular_name'         => _x( 'Book', 'Singular name of post type', JWP_BR_DOMAIN ),
            'menu_name'             => _x( 'Books', 'Admin Menu text', JWP_BR_DOMAIN ),
            'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', JWP_BR_DOMAIN ),
            'add_new'               => __( 'Add New', JWP_BR_DOMAIN ),
            'add_new_item'          => __( 'Add New Book', JWP_BR_DOMAIN ),
            'new_item'              => __( 'New Book', JWP_BR_DOMAIN ),
            'edit_item'             => __( 'Edit Book', JWP_BR_DOMAIN ),
            'view_item'             => __( 'View Book', JWP_BR_DOMAIN ),
            'all_items'             => __( 'All Books', JWP_BR_DOMAIN ),
            'search_items'          => __( 'Search Books', JWP_BR_DOMAIN ),
            'parent_item_colon'     => __( 'Parent Books: ', JWP_BR_DOMAIN ),
            'not_found'             => __( 'No books found.', JWP_BR_DOMAIN ),
            'not_found_in_trash'    => __( 'No books found in Trash.', JWP_BR_DOMAIN ),
            'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type.', JWP_BR_DOMAIN ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type.', JWP_BR_DOMAIN ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type.', JWP_BR_DOMAIN ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type.', JWP_BR_DOMAIN ),
            'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus.', JWP_BR_DOMAIN ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post).', JWP_BR_DOMAIN ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post).', JWP_BR_DOMAIN ),
            'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen.', JWP_BR_DOMAIN ),
            'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', JWP_BR_DOMAIN ),
            'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen.', JWP_BR_DOMAIN ),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Holds our books and book specific data', JWP_BR_DOMAIN ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => JWP_BR_POST_TYPE ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-book-alt',
            'supports'           => array( 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats' ),
        );

        register_post_type( JWP_BR_POST_TYPE, $args ); 
    }
}