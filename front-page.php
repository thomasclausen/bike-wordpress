<?php $theme_post_type = get_post_type(); ?>
<?php $theme_post_format = get_post_format(); ?>

<?php get_header( $theme_post_type . '-front' ); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', $theme_post_type . '-front' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

<?php get_footer( $theme_post_type . '-front' ); ?>