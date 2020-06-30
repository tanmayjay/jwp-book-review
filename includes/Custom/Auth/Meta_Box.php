<?php

namespace JWP\JBR\Custom\Auth;

/**
 * Metabox handler class
 */
class Meta_Box {

    /**
     * Creates the metabox and its functionalities
     *
     * @return void
     */
    public function create() {
        add_action( 'add_meta_boxes', [ self::class, 'add' ] );
        add_action( 'save_post', [ self::class, 'save' ], null, 2 );
    }

    /**
     * Adds the metaboxes for book
     *
     * @return void
     */
    public static function add() {
        
        add_meta_box( 
            'jwp_br_publications_info', 
            __( 'Book Publications Info', JWP_BR_DOMAIN ), 
            [ self::class, 'render' ], 
            JWP_BR_POST_TYPE, 
            'side',
        );
    }

    /**
     * Renders the HTML for book publications
     *
     * @param object $post
     * 
     * @return void
     */
    public static function render( $post ) {

        wp_nonce_field( basename( __FILE__ ), 'book_publications_field' );

        if ( ! metadata_exists( 'post', $post->ID, 'jwp-br-book-publisher' ) ) {
            add_post_meta( $post->ID, 'jwp-br-book-publisher', null, true );
        }

        if ( ! metadata_exists( 'post', $post->ID, 'jwp-br-book-publish-date' ) ) {
            add_post_meta( $post->ID, 'jwp-br-book-publish-date', null, true );
        }

        $publisher    = get_post_meta( $post->ID, 'jwp-br-book-publisher', true );
        $publish_date = get_post_meta( $post->ID, 'jwp-br-book-publish-date', true );

        ?>
        <label for="jwp-br-book-publisher"><?php _e( 'Book Publications', JWP_BR_DOMAIN ); ?></label>
        <input type="text" name="jwp-br-book-publisher" id="jwp-br-book-publisher" class="postbox" value="<?php echo $publisher; ?>">
        <label for="jwp-br-book-publish-date"><?php _e( 'Book Publish Date', JWP_BR_DOMAIN ); ?></label>
        <input type="date" name="jwp-br-book-publish-date" id="jwp-br-book-publish-date" class="postbox" value="<?php echo $publish_date; ?>">
        <?php
    }

    /**
     * Saves input data from the metaboxes
     *
     * @param int $post_id
     * @param object $post
     * 
     * @return void
     */
    public static function save( $post_id, $post ) {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if ( 'revision' === $post->post_type ) {
            return;
        }
        
        if ( array_key_exists( 'jwp-br-book-publisher', $_POST ) ) {
    
            if ( ! wp_verify_nonce( $_POST['book_publications_field'], basename( __FILE__ ) ) ) {
                return;
            }

            update_post_meta( 
                $post_id, 
                'jwp-br-book-publisher', 
                esc_html( $_POST['jwp-br-book-publisher'] )
            );
        }

        if ( array_key_exists( 'jwp-br-book-publish-date', $_POST ) ) {

            if ( ! wp_verify_nonce( $_POST['book_publications_field'], basename( __FILE__ ) ) ) {
                return;
            }
            
            update_post_meta( 
                $post_id, 
                'jwp-br-book-publish-date', 
                $_POST['jwp-br-book-publish-date']
            );
        }
    }
    
}