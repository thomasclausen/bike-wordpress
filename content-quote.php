
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<?php if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'post-images' );
					endif; ?>
					<?php the_content(); ?>
					<h1>&mdash; <?php the_title(); ?></h1>
				<?php else : ?>
					<?php if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'post-thumbnail' );
					endif; ?>
					<div class="content">
						<?php the_content(); ?>
					</div>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Direkte link til "', 'bike' ), 'after' => '"' ) ); ?>">&mdash; <?php the_title(); ?></a></h2>
				<?php endif; ?>
			</article>
