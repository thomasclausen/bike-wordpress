<?php $bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type ); ?>

	<section id="content" class="clearfix">
		<?php get_search_form(); ?>
		<?php if ( have_posts() ) : ?>
			<article class="searchlist clearfix">
				<ul class="results">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content-search', get_post_format() ); ?>
					<?php endwhile; ?>
				</ul>
				<?php bike_pagination(); ?>
			</article>
		<?php else : ?>
			<article class="searchlist clearfix">
				<p><em><?php _e( 'Din s&oslash;gning gav intet resultat...', 'bike' ); ?></em></p>
			</article>
		<?php endif; ?>
	</section>

<?php get_footer( $bike_post_type ); ?>