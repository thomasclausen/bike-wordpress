
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php $args = array( 'before' => '<p>Sider: ', 'after' => '</p>', 'next_or_number' => 'next_and_number', 'previouspagelink' => __( 'Forrige', 'bike' ), 'nextpagelink' => __( 'N&aelig;ste', 'bike' ) );
				wp_link_pages( $args ); ?>
			</article>
