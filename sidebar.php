	<section id="sidebar" class="clearfix">
		<?php if ( is_page() ) : ?>
			<?php if ( ! $post->post_parent ) :
				// will display the subpages of this top level page
				$children = wp_list_pages( 'child_of=' . $post->ID . '&sort_column=menu_order&title_li=&echo=0' );
			else :
				// will display the subpages of the top level page
				if ( $post->ancestors ) :
					// now you can get the the top ID of this page
					// wp is putting the ids DESC, thats why the top level ID is the last one
					$ancestors = end( $post->ancestors );
					$children = wp_list_pages( 'child_of=' . $ancestors . '&sort_column=menu_order&title_li=&echo=0' );
					// you will always get the whole subpages list
				endif;
			endif;
			if ( $children ) : ?>
				<nav class="submenu">
					<ul class="clearfix">
						<?php echo $children; ?>
					</ul>
				</nav>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-left' ) && !is_page_template( 'page-full-width.php' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-left' ); ?>
			<?php endif; ?>
		<?php elseif ( is_attachment() ) : ?>
			<div class="attachment-meta">
				<?php $imagemeta = wp_get_attachment_metadata();
				// list values in array
				/*$aperture        = $imagemeta['image_meta']['aperture'];
				$credit            = $imagemeta['image_meta']['credit'];
				$camera            = $imagemeta['image_meta']['camera'];
				$caption           = $imagemeta['image_meta']['caption'];
				$created_timestamp = $imagemeta['image_meta']['created_timestamp'];
				$copyright         = $imagemeta['image_meta']['copyright'];
				$focal_length      = $imagemeta['image_meta']['focal_length'];
				$iso               = $imagemeta['image_meta']['iso'];
				$shutter_speed     = $imagemeta['image_meta']['shutter_speed'];
				$title             = $imagemeta['image_meta']['title']; */
				if ( $imagemeta['width'] && $imagemeta['height'] ) {
					echo '<div class="image-size"><strong>' . __( 'Fuld st&oslash;rrelse:', 'bike' ) . '</strong> ' . $imagemeta['width'] . ' x ' . $imagemeta['height'] . ' ' . __( 'pixels', 'bike' ) . '</div>';
				}
				if ($imagemeta['image_meta']['camera']) {
					echo '<div class="camera"><strong>' . __( 'Kamera:', 'bike' ) . '</strong> ' . $imagemeta['image_meta']['camera'] . '</div>';
				}
				if ($imagemeta['image_meta']['aperture']) {
					echo '<div class="aperature"><strong>' . __( 'Bl&aelig;nde:', 'bike' ) . '</strong> F' . $imagemeta['image_meta']['aperture'] . '</div>';
				}
				if ($imagemeta['image_meta']['created_timestamp']) {
					function time_stamp( $session_time ) { 
						$time_difference = time() - $session_time ; 
						$seconds = $time_difference; 
						$minutes = round($time_difference / 60 );
						$hours = round($time_difference / 3600 ); 
						$days = round($time_difference / 86400 ); 
						$weeks = round($time_difference / 604800 ); 
						$months = round($time_difference / 2419200 ); 
						$years = round($time_difference / 29030400 ); 
						
						if ( $seconds <= 60 ) { // Seconds
							if ( $seconds == 1 ) { return __( '1 sekund siden', 'bike' ); } else { return sprintf( __( '%s sekunder siden', 'bike' ), $seconds); }
						} elseif ( $minutes <= 60 ) { //Minutes
							if ( $minutes == 1 ) { return __( '1 minut siden', 'bike' ); } else { return sprintf( __( '%s minutter siden', 'bike' ), $minutes); }
						} elseif ( $hours <= 24 ) { //Hours
							if ( $hours == 1 ) { return __( '1 time siden', 'bike' ); } else { return sprintf( __( '%s timer siden', 'bike' ), $hours); }
						} else if($days <= 7) { //Days
							if ( $days == 1 ) { return __( '1 dag siden', 'bike' ); } else { return sprintf( __( '%s dage siden', 'bike' ), $days); }
						} else if($weeks <= 4) { //Weeks
							if( $weeks == 1 ) { return __( '1 uge siden', 'bike' ); } else { return sprintf( __( '%s uger siden', 'bike' ), $weeks); }
						} elseif ( $months <= 12 ) { //Months
							if ( $months == 1 ) { return __( '1 m&aring;ned siden', 'bike' ); } else { return sprintf( __( '%s m&aring;neder siden', 'bike' ), $months); }
						} else { //Years
							if ( $years == 1 ) { return __( '1 &aring;r siden', 'bike' ); } else { return sprintf( __( '%s &aring;r siden', 'bike' ), $years); }
						}
					} 
					echo '<div class="image-date"><strong>' . __( 'Billedet er taget:', 'bike' ) . '</strong> ' . time_stamp( $imagemeta['image_meta']['created_timestamp'] ) . ' (' . date( 'H:i:s - d/m/y', $imagemeta['image_meta']['created_timestamp'] ) . ')</div>';
				}
				if ($imagemeta['image_meta']['focal_length']) {
					echo '<div class="focal-length"><strong>' . __( 'Br&aelig;ndvidde:', 'bike' ) . '</strong> ' . $imagemeta['image_meta']['focal_length'] . ' mm</div>';
				}
				if ($imagemeta['image_meta']['iso']) {
					echo '<div class="iso"><strong>' . __( 'ISO:', 'bike' ) . '</strong> ' . $imagemeta['image_meta']['iso'] . '</div>';
				}
				if ($imagemeta['image_meta']['shutter_speed']) {
					echo '<div class="shutter-speed"><strong>' . __( 'Lukkehastighed:', 'bike' ) . '</strong> ';

					// shutter speed handler
					if ( ( 1 / $imagemeta['image_meta']['shutter_speed'] ) > 1 ) {
						echo "1/";
						if ( number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 1 ) ==  number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 0 ) ) {
							echo number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 0, '.', '' ) . ' sek.</div>';
						} else {
							echo number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 1, '.', '' ) . ' sek.</div>';
						}
					} else {
						echo $imagemeta['image_meta']['shutter_speed'] . ' sek.</div>';
					}
				}
				if ( $imagemeta['image_meta']['credit'] ) {
					echo '<div class="credit"><strong>' . __( 'Fotograf:', 'bike' ) . '</strong> ' . $imagemeta['image_meta']['credit'] . '</div>';
				}
				if ( $imagemeta['image_meta']['copyright'] ) {
					echo '<div class="copyright"><strong>' . __( 'Copyright:', 'bike' ) . '</strong> ' . $imagemeta['image_meta']['copyright'] . '</div>';
				} ?>
				<div class="comments"><a href="#comments"><?php comments_number( __( 'Ingen kommentarer', 'bike' ), __( '1 kommentar', 'bike' ), __( '% kommentarer', 'bike' ) );?></a></div>
				<?php edit_post_link( __( 'Rediger billede', 'bike' ), '<div class="edit-link">', '</div>' ); ?>
			</div>
			<?php echo '<a href="' . get_permalink( $post->post_parent ) . '">' . __( '&laquo; Tilbage til "', 'bike' ) . get_the_title( $post->post_parent ) . '"</a>'; ?>
		<?php else : ?>
			<?php if ( get_post_format() ) :
				$post_meta_class = ' ' . get_post_format();
			endif;
			if ( has_post_thumbnail() ) :
				$post_meta_class .= ' image';
			endif; ?>
			<div class="post-meta<?php echo $post_meta_class; ?> clearfix">
				<?php if ( has_post_format( 'aside' ) ) :
					$bike_post_format_title = __( 'Vis alle sidebem&aelig;rkninger', 'bike' );
					$bike_post_format = __( 'Sidebem&aelig;rkning', 'bike' );
				elseif ( has_post_format( 'gallery' ) ) :
					$bike_post_format_title = __( 'Vis alle gallerier', 'bike' );
					$bike_post_format = __( 'Galleri', 'bike' );
				elseif ( has_post_format( 'link' ) ) :
					$bike_post_format_title = __( 'Vis alle links', 'bike' );
					$bike_post_format = __( 'Link', 'bike' );
				elseif ( has_post_format( 'image' ) ) :
					$bike_post_format_title = __( 'Vis alle billeder', 'bike' );
					$bike_post_format = __( 'Billede', 'bike' );
				elseif ( has_post_format( 'quote' ) ) :
					$bike_post_format_title = __( 'Vis alle citater', 'bike' );
					$bike_post_format = __( 'Citat', 'bike' );
				elseif ( has_post_format( 'status' ) ) :
					$bike_post_format_title = __( 'Vis alle statusopdateringer', 'bike' );
					$bike_post_format = __( 'Statusopdatering', 'bike' );
				elseif ( has_post_format( 'video' ) ) :
					$bike_post_format_title = __( 'Vis alle videoer', 'bike' );
					$bike_post_format = __( 'Video', 'bike' );
				else :
					$bike_post_format = __( 'Indl&aelig;g', 'bike' );
				endif; ?>
				<?php if ( get_post_format() ) : ?>
					<div class="format"><?php _e( 'Type:', 'bike' ); ?> <?php printf( '<a href="%s" title="%s">%s</a>', esc_url( get_post_format_link( get_post_format() ) ), esc_attr( $bike_post_format_title ), $bike_post_format ); ?></div>
				<?php else : ?>
					<div class="format"><?php _e( 'Type:', 'bike' ); ?> <?php echo $bike_post_format; ?></div>
				<?php endif; ?>
				<div class="comments"><a href="#comments"><?php comments_number( __( 'Ingen kommentarer', 'bike' ), __( '1 kommentar', 'bike' ), __( '% kommentarer', 'bike' ) );?></a></div>
				<div class="categories"><?php _e( 'Kategorier:', 'bike' ); ?> <?php the_category( ', ' ); ?></div>
				<div class="tags"><?php _e( 'Emner:', 'bike' ); ?> <?php the_tags( '', ', ' ); ?></div>
				<?php edit_post_link( __( 'Rediger nyhed', 'bike' ), '<div class="edit-link">', '</div>' ); ?>
			</div>
		<?php endif; ?>
	</section>