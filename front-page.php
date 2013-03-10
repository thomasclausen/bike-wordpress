<?php $bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type . '-front' ); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', $bike_post_type . '-front' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

<?php get_footer( $bike_post_type . '-front' ); ?>