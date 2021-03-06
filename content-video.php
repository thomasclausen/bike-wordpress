
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<div class="video">
						<?php $explode_content = explode( '<!--more-->', $post->post_content );
						$content = apply_filters( 'the_content', $explode_content[0] );
						echo $content = str_replace( ']]>', ']]&gt;', $content ); ?>
					</div>
					<h1><?php the_title(); ?></h1>
					<div class="post-meta clearfix">
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>
						<div class="author">
							<?php _e( 'Uploadet af:', 'bike' ); ?> <?php the_author_posts_link(); ?>
							<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
						</div>
					</div>
					<?php the_content( '', true ); ?>
				<?php else : ?>
					<div class="video">
						<?php the_content(); ?>
					</div>
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
				<?php endif; ?>
			</article>
