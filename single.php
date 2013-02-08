<?php if ( has_post_format( 'video' ) ) :
	$content_width = 620;
else :
	$content_width = 300;
endif;
$bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type ); ?>

<?php get_sidebar( $bike_post_type ); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
			<?php bike_pagination(); ?>
		<?php endif; ?>
	</section>

<?php get_footer( $bike_post_type ); ?>