
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<div class="post-meta clearfix">
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>
						<div class="author">
							<?php _e( 'Skrevet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
							<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
						</div>
					</div>
					<?php the_content(); ?>
				<?php else : ?>
					<div class="content">
						<div class="post-meta clearfix">
							<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
							<div class="author">
								<?php _e( 'Skrevet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
								<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
							</div>
						</div>
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			</article>
