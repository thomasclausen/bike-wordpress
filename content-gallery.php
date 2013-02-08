
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<?php if ( is_single() ) : ?>
					<?php the_post_thumbnail( 'post-image' ); ?>
					<h1><?php the_title(); ?></h1>
					<div class="post-meta clearfix">
						<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_date(); ?></time>
						<div class="author">
							Uploadet af: <?php the_author_posts_link(); ?>
							<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
						</div>
					</div>
					<?php the_content(); ?>
				<?php else : ?>
					<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'post-thumbnail' );
						echo '<div class="image gallery"><a href="' . get_permalink() . '">' . $image_img_tag . '</a></div>';
					endif; ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Direkte link til "', 'after' => '"' ) ); ?>"><?php the_title(); ?></a></h2>
					<div class="content">
						<div class="post-meta clearfix">
							<time class="date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
							<div class="author">
								Uploadet af: <?php the_author_posts_link(); ?>
								<div class="gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48', '', get_the_author() ); ?></div>
							</div>
						</div>
						<?php if ( $images ) : ?>
							<p><em><?php printf( _n( 'Dette galleri indeholder <a %1$s>%2$s billede</a>.', 'Dette galleri indeholder <a %1$s>%2$s billeder</a>.', $total_images, 'bik' ), 'href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Direkte link til "%s"', 'bike' ), the_title_attribute( 'echo=0' ) ) ) . '"', number_format_i18n( $total_images ) ); ?></em></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</article>
