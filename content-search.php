
			<li id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Direkte link til "', 'after' => '"' ) ); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</li>
