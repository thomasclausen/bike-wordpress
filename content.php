
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<?php if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'post-image' );
					endif; ?>
					<h1><?php the_title(); ?></h1>
					<div class="post-meta clearfix">
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
						<div class="author">
							<?php _e( 'Skrevet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
							<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
						</div>
					</div>
					<?php the_content(); ?>
					<?php $args = array( 'before' => '<nav class="pagination page-links clearfix">', 'after' => '</nav>', 'link_before' => '', 'link_after' => '', 'next_or_number' => 'next_and_number', 'previouspagelink' => __( '&laquo; Forrige', 'bike' ), 'nextpagelink' => __( 'N&aelig;ste &raquo;', 'bike' ) );
					wp_link_pages( $args ); ?>
				<?php else : ?>
					<?php if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'post-thumbnail' );
					endif; ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Direkte link til "', 'bike' ), 'after' => '"' ) ); ?>"><?php the_title(); ?></a></h2>
					<div class="content">
						<div class="post-meta clearfix">
							<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
							<div class="author">
								<?php _e( 'Skrevet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
								<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
							</div>
						</div>
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>
			</article>
