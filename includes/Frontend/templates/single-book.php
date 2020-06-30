  
<?php
/**
 * The template for displaying single book
 *
 * @link https://github.com/tanmayjay/wordpress/tree/master/6-Custom-Post_types/jwp-book-review-1.0.1/includes/Frontend/templates
 *
 * @package JWP_Book_Review
 * @subpackage Single Book Template
 * @version 1.0
 */

get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		
		if ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/post/content', get_post_format() );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endif;

		?>
		</main>
	</div>
</div>
<?php
get_footer();