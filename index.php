<?php $content_width = 460;
$bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type ); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php bike_pagination(); ?>
		<?php else : ?>
			<article class="post clearfix">
				<h2><?php _e( 'Ingen nyheder', 'bike' ); ?></h2>
				<p><?php _e( 'Vi har ingen nyheder at dele med dig endnu...', 'bike' ); ?></p>
			</article>
		<?php endif; ?>
	</section>

<?php get_footer( $bike_post_type ); ?>