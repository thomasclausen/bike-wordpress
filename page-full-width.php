<?php
/*
Template Name: Fuld bredde (kalender)
*/
?>

<?php $bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type ); ?>

<?php get_sidebar( $bike_post_type ); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', $bike_post_type ); ?>
			<?php endwhile; ?>
			<?php bike_pagination(); ?>
		<?php endif; ?>
	</section>

<?php get_footer( $bike_post_type ); ?>