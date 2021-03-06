
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<?php $image_attributes = wp_get_attachment_image_src( $post->ID, 'full' );
					echo '<div class="image"><a href="' . $image_attributes[0] . '">' . wp_get_attachment_image( $post->ID, 'post-image' ) . '</a></div>'; ?>
					<h1><?php the_title(); ?></h1>
					<div class="post-meta clearfix">
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>
						<div class="author">
							<?php _e( 'Uploadet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
							<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
						</div>
					</div>
					<?php the_content(); ?>
					<nav class="pagination image-links clearfix">
						<ul>
							<li class="prev"><?php previous_image_link( false, __( '&laquo; Forrige billede', 'bike' ) ); ?></li>
							<li class="next"><?php next_image_link( false, __( 'N&aelig;ste billede &raquo;', 'bike' ) ); ?></li>
						</ul>
					</nav>
				<?php else : ?>
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => __( 'Direkte link til "', 'bike' ), 'after' => '"' ) ); ?>"><?php the_title(); ?></a></h2>
					<div class="content">
						<div class="post-meta clearfix">
							<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
							<div class="author">
								<?php _e( 'Uploadet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
								<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
							</div>
						</div>
					</div>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</article>