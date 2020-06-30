<?php

namespace JWP\JBR\Custom;

class Updated_Messages {

    /**
     * Initializes the class
     *
     * @return void
     */
    public function init() {
        add_filter( 'post_updated_messages', [ $this, 'post_updated_messages' ] );
    }

    /**
     * Adds custom post updated messages
     *
     * @param array|string $messages
     * 
     * @return array|string
     */
    public function post_updated_messages( $messages ) {
        $post = get_post();
        $post_type = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages[ JWP_BR_POST_TYPE ] = array(
            0  => '',
            1  => __( 'Book updated.', JWP_BR_DOMAIN ),
            2  => __( 'Custom field updated.', JWP_BR_DOMAIN ),
            3  => __( 'Custom field deleted.', JWP_BR_DOMAIN ),
            4  => __( 'Book updated.', JWP_BR_DOMAIN ),
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s', JWP_BR_DOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Book published.', JWP_BR_DOMAIN ),
            7  => __( 'Book saved.', JWP_BR_DOMAIN ),
            8  => __( 'Book submitted.', JWP_BR_DOMAIN ),
            9  => sprintf(
                __( 'Book scheduled for: <strong>%1$s</strong>.', JWP_BR_DOMAIN ),
                date_i18n( __( 'M j, Y @ G:i', JWP_BR_DOMAIN ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Book draft updated.', JWP_BR_DOMAIN )
        );
    
        if ( $post_type_object->publicly_queryable && JWP_BR_POST_TYPE == $post_type ) {
            $permalink = get_permalink( $post->ID );
            $view_link = sprintf( 
                ' <a href="%s">%s</a>', 
                esc_url( $permalink ), 
                __( 'View book', JWP_BR_DOMAIN ) 
            );
            
            $messages[ $post_type ][1] .= $view_link;
            $messages[ $post_type ][6] .= $view_link;
            $messages[ $post_type ][9] .= $view_link;
    
            $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
            $preview_link      = sprintf( 
                ' <a target = "_blank" href = "%s">%s</a>', 
                esc_url( $preview_permalink ), 
                __( 'Preview book', JWP_BR_DOMAIN ) 
            );
           
            $messages[ $post_type ][8]  .= $preview_link;
            $messages[ $post_type ][10] .= $preview_link;
        }
    
        return $messages;
    }
}