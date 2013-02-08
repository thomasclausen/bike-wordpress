<?php
/**
 * BIKE functions and definitions
 *
 * @package BIKE
 * @since BIKE 0.1
 * @last_updated BIKE 0.1
 */


if ( ! function_exists( 'bike_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features
	 *
	 * @since BIKE 0.1
	 */
	function bike_setup() {
		/**
		 * Set the content width based on the theme's design and stylesheet
		 *
		 * @since BIKE 0.1
		 */
		if ( ! isset( $content_width ) ) :
			$content_width = 560;
		endif;

		/**
		 * Add custom stylesheet for the editor
		 *
		 * @since BIKE 0.1
		 */
		add_editor_style();

		/**
		 * Add theme options
		 *
		 * @since BIKE 0.1
		 */
		//require( get_stylesheet_directory() . '/theme-options.php' );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 *
		 * @since BIKE 0.1
		 */
		load_theme_textdomain( 'bike', get_stylesheet_directory() . '/languages' );

		/**
		 * Add support for custom post types
		 *
		 * @since BIKE 0.1
		 */
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video' ) );
		//add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

		/**
		 * Add support for custom header
		 *
		 * @since BIKE 0.1
		 */
		$defaults = array(
			'default-image' => get_template_directory_uri() . '/images/header.jpg',
			'random-default' => false,
			'width' => 1600,
			'height' => 142,
			'flex-width' => true,
			'header-text' => false,
			'uploads' => true
		);
		add_theme_support( 'custom-header', $defaults );

		/**
		 * Add support for post thumbnails and set size
		 *
		 * @since BIKE 0.1
		 */
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		set_post_thumbnail_size( 460, 230, true );

		/**
		 * Add support for post image and set size
		 *
		 * @since BIKE 0.1
		 */
		add_image_size( 'post-image', 620, 465, true );
		
		/**
		 * Add support for default posts and comments RSS feed links to head
		 *
		 * @since BIKE 0.1
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for nav menu
		 *
		 * @since BIKE 0.1
		 */
		register_nav_menu( 'primary', __( 'Hovedmenu', 'bike' ) );
	}
endif;
add_action( 'after_setup_theme', 'bike_setup' );

/**
 * Extend user profiles by adding input fields for facebook, twitter etc. and removing unwanted ones
 *
 * @since BIKE 0.1
 */
function bike_user_profile( $contactmethods ) {
	$contactmethods = array(
		'twitter' => __( 'Twitter', 'bike' ),
		'facebook' => __( 'Facebook', 'bike' ),
		'googleplus' => __( 'Google+', 'bike' ),
		'skype' => __( 'Skype', 'bike' )
	);
	
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'bike_user_profile', 10, 1 );

/**
 * Remove unwanted meta tags and scripts from header
 *
 * @since BIKE 0.1
 */
remove_action( 'wp_head', 'wp_generator' ); // WordPress version number
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );

/**
 * Enqueue scripts and styles
 *
 * @since BIKE 0.1
 */
function bike_scripts_styles() {
	wp_register_style( 'reset-html5', get_template_directory_uri() . '/reset-html5.css', false, '1.0' );
	wp_enqueue_style( 'reset-html5' );
	wp_register_style( 'bike-theme', get_template_directory_uri() . '/style.css', false, '0.1' );
	wp_enqueue_style( 'bike-theme' );
	if ( ! is_404() ) :
		wp_deregister_script( 'comment-reply' );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'bike-theme-script', get_template_directory_uri() . '/script.js', array( 'jquery' ), '0.1', true );
		wp_enqueue_script( 'bike-theme-script' );
		//wp_localize_script( 'bike-theme-script', 'bikeAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'bike_update' ) ) );
		wp_register_script( 'masonry-script', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), '2.1.07', true );
		wp_enqueue_script( 'masonry-script' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'bike_scripts_styles' );

/**
 * Insert HTML5 extras
 *
 * @since BIKE 0.1
 */
function bike_html5extras() {
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />' . "\n";
}
add_action( 'wp_head', 'bike_html5extras', 1 );

/**
 * Insert HTML5 shiv
 *
 * @since BIKE 0.1
 */
function bike_html5shiv() {
	echo '<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
}
add_action( 'wp_head', 'bike_html5shiv' );

/**
 * Insert custom pingback
 *
 * @since BIKE 0.1
 */
 // Pingback
function bike_pingback() {
	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
}
add_action( 'wp_head', 'bike_pingback' );

/**
 * Insert favicon and iPhone homescreen icons
 *
 * @since BIKE 0.1
 */
function bike_icons() {
	echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.gif" sizes="16x16" type="image/gif" />' . "\n";
	echo '<link rel="icon" href="' . get_template_directory_uri() . '/favicon.gif" sizes="16x16" type="image/gif" />';
	echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . get_template_directory_uri() . '/images/apple-touch-icon-144x144.png" />' . "\n";
	echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . get_template_directory_uri() . '/images/apple-touch-icon-114x114.png" />' . "\n";
	echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . get_template_directory_uri() . '/images/apple-touch-icon-72x72.png" />' . "\n";
	echo '<link rel="apple-touch-icon-precomposed" href="' . get_template_directory_uri() . '/images/apple-touch-icon-57x57.png" />' . "\n";
}
//add_action( 'wp_head', 'bike_icons', 15 );

/**
 * Insert Open Graph tags
 *
 * @since BIKE 0.1
 */
function bike_opengraph() {
	if ( !class_exists( WPSEO_OpenGraph ) ) :
		echo '<meta property="og:image" content="' . get_template_directory_uri() . '/images/logo-facebook-200x200.jpg" />' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />' . "\n";
		echo '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
	endif;
	echo '<link rel="image_src" href="' . get_template_directory_uri() . '/images/logo-facebook-200x200.jpg" />' . "\n";
}
//add_action( 'wp_head', 'bike_opengraph', 2 );

/**
 * Add support for widgets
 *
 * @since BIKE 0.1
 */
function bike_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'bike' ),
		'id' => 'sidebar-left',
		'description' => __( 'Benyttes til at inds&aelig;tte indhold i venstre side under undermenu.', 'bike' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</aside>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar (forum)', 'bike' ),
		'id' => 'sidebar-forum-left',
		'description' => __( 'Benyttes til at inds&aelig;tte indhold i venstre side under undermenu p&aring; side under forum.', 'bike' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
		'after_widget' => '</aside>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'bike' ),
		'id' => 'sidebar-footer',
		'description' => __( 'Benyttes til at inds&aelig;tte indhold i footer. Kan indeholde 3 widgets', 'bike' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	) );
}
add_action( 'widgets_init', 'bike_widgets_init' );

/**
 * Add even or odd classes to posts
 *
 * @since BIKE 0.1
 */
function bike_post_class ( $classes ) {
	$classes[] = ( $post_class++ % 2 ) ? 'post-even' : 'post-odd';
	return $classes;
}
add_filter( 'post_class' , 'bike_post_class' );

/**
 * Customize the excerpt
 *
 * @since BIKE 0.1
 */
function bike_excerpt_length( $length ) {
	return rand( 60, 70 );
}
add_filter( 'excerpt_length', 'bike_excerpt_length' );
function bike_excerpt_more( $more ) {
	return __( '&hellip; ', 'bike' ) . '<span class="excerpt-link"><a href="'. get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Direkte link til "', 'bike' ), 'after' => '"', 'echo' => 0 ) ) . '" rel="bookmark">' . __( 'L&aelig;s mere', 'bike' ) . '</a></span>';
}
add_filter( 'excerpt_more', 'bike_excerpt_more' );

function bike_custom_excerpt_more( $output ) {
	return $output;
}
add_filter( 'get_the_excerpt', 'bike_custom_excerpt_more' );

/**
 * Add blockquote tag to quote post formats
 *
 * @since BIKE 0.1
 */
function bike_quote_content( $content ) {
	if ( has_post_format( 'quote' ) ) :
		preg_match( '/<blockquote.*?>/', $content, $matches );
		if ( empty( $matches ) ) :
			$content = '<blockquote>' . $content . '</blockquote>';
		endif;
	endif;
	return $content;
}
add_filter( 'the_content', 'bike_quote_content' );

/**
 * Add the infinity character to aside and status post formats
 *
 * @since BIKE 0.1
 */
function bike_infinity_and_beyond( $content ) {
	if ( has_post_format( 'aside' ) && !is_singular() || has_post_format( 'status' ) && !is_singular() ) :
		$content .= ' <span class="' . get_post_format() . '-link"><a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Direkte link til "', 'bike' ), 'after' => '"', 'echo' => 0 ) ) . '" rel="bookmark">&infin;</a></span>';
	endif;
	return $content;
}
add_filter( 'the_content', 'bike_infinity_and_beyond', 9 );

/**
 * Change the permalink on link post formats
 *
 * @since BIKE 0.1
 */
function bike_link_title( $link, $post ) {
	if ( has_post_format( 'link', $post ) && get_post_meta( $post->ID, 'post_format_link_url', true ) ) :
		$link = get_post_meta( $post->ID, 'post_format_link_url', true );
	endif;
	return $link;
}
add_filter( 'post_link', 'bike_link_title', 10, 2 );

/**
 * Custom pagination
 *
 * @since BIKE 0.1
 */
function bike_pagination() {
	global $wp_query;			
	
	$args = array(
		'base' => get_pagenum_link( 1 ) . '%_%',
		'format' => 'page/%#%',
		'total' => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'prev_text' => __( '&laquo; Forrige', 'bike' ),
		'next_text' => __( 'N&aelig;ste &raquo;', 'bike' ),
		'type' => 'list'
	);
	echo '<nav class="pagination post-links clearfix">' . paginate_links( $args ) . '</nav>';
}

/**
 * Customize the wp_link_pages output
 *
 * @since BIKE 0.1
 */
function bike_custom_wp_link_pages( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) :
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage ) :
			if ( $more ) :
				$i = $page - 1;
				if ( $i ) :
					$prev .= _wp_link_page( $i ) . '<span class="prev">' .  $args['link_before'] . $args['previouspagelink'] . '</span>' . $args['link_after'] . '</a>';
				endif;
				$i = $page;
				if ( $i == $page ) :
					$pagelink = '<span class="current">' . $args['link_before'] . $args['pagelink'] . $args['link_after'] . '</span>';
				else :
					$pagelink = $args['link_before'] . $args['pagelink'] . $args['link_after'];
				endif;
				$i = $page + 1;
				if ( $i <= $numpages ) :
					$next .= _wp_link_page( $i ) . '<span class="next">' . $args['link_before'] . $args['nextpagelink'] . '</span>' . $args['link_after'] . '</a></span>';
				endif;
			endif;
		endif;
		$args['before'] = $args['before'] . $prev;
		$args['pagelink'] = $pagelink;
		$args['after'] = $next . $args['after'];    
	endif;

	return $args;
}
add_filter( 'wp_link_pages_args', 'bike_custom_wp_link_pages' );

/**
 * Enable threaded comments
 *
 * @since BIKE 0.1
 */
function bike_comments_reply() {
	if ( !is_admin() ) :
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
			wp_enqueue_script( 'comment-reply' );
		endif;
	endif;
}
add_action( 'comment_form_before', 'bike_comments_reply' );

/**
 * Customize the comment template output
 *
 * @since BIKE 0.1
 */
function bike_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class() ?>>
				<header class="clearfix">
					<div class="author"><?php comment_author_link(); ?></div>
					<div class="date"><?php printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( __( '%1$s d. %2$s - kl. %3$s', 'bike' ), get_comment_date( 'l' ), get_comment_date(), get_comment_time() ) ); ?></div>
				</header>
				<?php comment_text(); ?>

				<?php comment_type(); ?>: <?php comment_author_link(); ?>
			<?php break;
		case 'social-facebook' : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-facebook' ) ?>>
				<header class="clearfix">
					<div class="gravatar"><?php echo get_avatar( $comment, 32 ); ?></div>
					<div class="author"><?php comment_author_link(); ?></div>
					<div class="date"><?php printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( __( '%1$s d. %2$s - kl. %3$s', 'bike' ), get_comment_date( 'l' ), get_comment_date(), get_comment_time() ) ); ?></div>
				</header>
				<?php if ( $comment->comment_approved == '0' ) :
					echo '<p class="comment-awaiting-moderation">' . __( 'Din kommentar afventer godkendelse.', 'bike' ) . '</p>';
				endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Svar <span>&darr;</span>', 'bike' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			<?php break;
		case 'social-facebook-like' : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-facebook comment-facebook-like' ) ?>>
				<header class="clearfix">
					<div class="gravatar"><?php echo get_avatar( $comment, 16 ); ?></div>
					<div class="author"><?php comment_text(); ?></div>
				</header>
			<?php break;
		default : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<header class="clearfix">
					<div class="gravatar"><?php echo get_avatar( $comment, 32 ); ?></div>
					<div class="author"><?php comment_author_link(); ?></div>
					<div class="date"><?php printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( __( '%1$s d. %2$s - kl. %3$s', 'bike' ), get_comment_date( 'l' ), get_comment_date(), get_comment_time() ) ); ?></div>
				</header>
				<?php if ( $comment->comment_approved == '0' ) :
					echo '<p class="comment-awaiting-moderation">' . __( 'Din kommentar afventer godkendelse.', 'bike' ) . '</p>';
				endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Svar <span>&darr;</span>', 'bike' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			<?php break;
	endswitch;
}

/**
 * Customize the comment form
 *
 * @since BIKE 0.1
 */
function bike_comment_form_logged_in( $default ) {
	global $current_user;
	get_currentuserinfo();

	$default = '<div class="comment-form-identity clearfix">';
		$default .= '<div id="comment-form-identity-wordpress" class="comment-form-service">';
			$default .= '<div class="comment-form-avatar"><a href="https://gravatar.com/site/signup/" target="_blank"><img src="http://www.gravatar.com/avatar/' . md5( $current_user->user_email ) . '?s=25&d=mm" alt="' . __( 'Gravatar', 'bike' ) . '" width="25" class="no-grav" /></a></div>';
			$default .= '<div class="comment-form-fields">';
				$default .= '<p>' . sprintf( __( 'Du er logget ind som <a href="%s">%s</a>. <span class="comment-form-log-out">( <a title="Log ud" href="%s">Log ud</a> )</span>', 'bike' ), admin_url( 'profile.php' ), $current_user->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>';
			$default .= '</div>';
		$default .= '</div>';
	$default .= '</div>';

	return $default;
}
add_filter( 'comment_form_logged_in', 'bike_comment_form_logged_in' );
function bike_comment_fields( $fields ) {
	$commenter = wp_get_current_commenter();

	$fields['author'] = '<fieldset class="comment-form-author"><input id="author" name="author" type="text" tabindex="3" placeholder="' . __( 'Navn (p&aring;kr&aelig;vet)', 'bike' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required aria-required="true" /></fieldset>';
	$fields['email'] = '<fieldset class="comment-form-email"><input id="email" name="email" type="email" tabindex="2" placeholder="' . __( 'E-mail (p&aring;kr&aelig;vet - vil ikke v&aelig;re synlig eller blive offentliggjort)', 'bike' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" required aria-required="true" /></fieldset>';
	$field_url = $fields['url'] = '<fieldset class="comment-form-url"><input id="url" name="url" type="text" tabindex="4" placeholder="' . __( 'Hjemmeside', 'bike' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></fieldset>';
	if ( isset( $fields['url'] ) ) :
		unset( $fields['url'] );
	endif;

	arsort( $fields );

	array_push( $fields, $field_url );

	return $fields;
}
add_filter( 'comment_form_default_fields', 'bike_comment_fields' );
function bike_remove_comment_field( $comment_field ) {
	return $comment_field = '';
}
add_filter( 'comment_form_field_comment', 'bike_remove_comment_field' );
function bike_comment_form_top() {
	echo '<fieldset class="comment-form-comment"><textarea id="comment" name="comment" cols="100%" rows="8" tabindex="1" placeholder="' . __( 'Skriv din kommentar her...', 'bike' ) . '" required aria-required="true"></textarea></fieldset>';
}
add_action( 'comment_form_top', 'bike_comment_form_top' );
function bike_comment_form_before_fields() {
	echo '<div class="comment-form-identity clearfix"><div id="comment-form-identity-guest" class="comment-form-service selected"><div class="comment-form-avatar"><a href="https://gravatar.com/site/signup/" target="_blank"><img src="http://www.gravatar.com/avatar/?s=25&amp;forcedefault=y&amp;d=mystery" alt="Gravatar" width="25" class="no-grav"></a></div><div class="comment-form-fields">';
}
add_action( 'comment_form_before_fields', 'bike_comment_form_before_fields' );
function bike_comment_form_after_fields() {
	echo '</div></div></div>';
}
add_action( 'comment_form_after_fields', 'bike_comment_form_after_fields' );

/**
 * Get the page number (for blog and category pages)
 *
 * @since BIKE 0.1
 */
function get_page_number() {
	if ( get_query_var( 'paged' ) ) :
		echo __( ' | Side: ', 'bike' ) . get_query_var( 'paged' );
	endif;
}

/**
 * Customize the title tag
 *
 * @since BIKE 0.1
 */
function bike_custom_title( $title ) {
	if ( is_feed() ) :
		return $title;
	endif;

	global $paged, $page;

	if ( is_author() ) :
		$title = __( 'Nyheder skrevet af: ', 'bike' ) . $title;
	elseif ( is_category() ) :
		$title = __( 'Kategori: ', 'bike' ) . $title;
	elseif ( is_date() ) :
		$title = __( 'Nyheder fra ', 'bike' ) . $title;
	elseif ( is_tag() ) :
		$title = __( 'Emne: ', 'bike' ) . $title;
	elseif ( is_tax() ) :
		$title = __( 'Type: ', 'bike' ) . $title;
	elseif ( is_search() ) :
		$title = __( 'S&oslash;gning: "', 'bike' ) . get_search_query() . '" ';
		if ( $paged >= 2 ) :
			$title .= __( ' - Side: ', 'bike' ) . get_page_number();
		endif;
	elseif ( is_404() ) :
		$title = __( 'Siden blev ikke fundet!', 'bike' );
	endif;

	if ( $paged >= 2 || $page >= 2 ) :
		$title .= __( ' - Side: ', 'bike' ) . $page;
	endif;

	if ( !is_front_page() ) :
		$seperator = ' | ';
	endif;

	return $title . $seperator . get_bloginfo( 'name', 'display' );
}
add_filter( 'wp_title', 'bike_custom_title' );

/**
 * Customize the thumbnail HTML output
 *
 * @since BIKE 0.1
 */
function bike_post_image_html( $html, $post_id, $post_image_id ) {
	if ( is_single() ) :
		$html = '<div class="image"><a href="' . get_permalink( $post_image_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_image_id ) ) . '">' . $html . '</a></div>';
	else:
		$html = '<div class="image"><a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a></div>';
	endif;

	return $html;
}
add_filter( 'post_thumbnail_html', 'bike_post_image_html', 10, 3 );

/**
 * Remove the inline style from the gallery shortcode
 *
 * @since BIKE 0.1
 */
add_filter( 'use_default_gallery_style', '__return_false' );



// Edited to here...


function cleaner_caption( $output, $attr, $content ) {
	if ( is_feed() )
		return $output;

	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	$attr = shortcode_atts( $defaults, $attr );

	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	return $output = '<div' . $attributes .'>' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $attr['caption'] . '</p></div>';
}
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );


// Example 2
function remove_page_from_query_string( $query_string ) { 
	if ( $query_string['name'] == 'page' && isset( $query_string['page'] ) ) :
		unset( $query_string['name'] );
		// 'page' in the query_string looks like '/2', so split it out
		list( $delim, $page_index ) = split( '/', $query_string['page'] );
		$query_string['paged'] = $page_index;
	endif;
	return $query_string;
}
add_filter( 'request', 'remove_page_from_query_string' );

// Example 2
function fix_page_in_category_from_query_string( $query_string ) {
	//Check to see if the 'p' and 'category_name' are set in $query_string 
	if ( isset( $query_string['category_name'] ) && isset( $query_string['p'] ) ) {
		$category_name = $query_string['category_name'];
		$category_len = $category_name; 
		
		//Check to see if the 'category_name' has '/page' on the end of it
		if ( substr( $category_name, $category_len-5, 5 ) == '/page' ) {
		
			//Remove '/page' from the end of 'category_name'
			$query_string['category_name'] = substr( $query_string['category_name'], 0, $category_len-5 );
		
			//Set 'paged' equal to the page you want to go to
			$query_string['paged'] = $query_string['p'];
		
			//Unset 'p' since we don't need it anymore because we set 'paged' instead
			unset( $query_string['p'] );
		}
	}
	return $query_string;
}

add_filter( 'request', 'fix_page_in_category_from_query_string' );
