<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
<title><?php wp_title( '', true, 'right' ); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="top" class="clearfix">
		<hgroup<?php if ( get_bloginfo( 'description' ) ) : echo ' class="description" '; endif; ?>>
			<div id="logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></div>
			<h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( get_bloginfo( 'description' ) ) : ?>
				<p class="description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
		</hgroup>
	</header>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'clearfix', 'fallback_cb' => 'fallback_mainmenu', 'before' => '<span class="seperator"></span>', 'items_wrap' => '<span class="nav-before"></span><ul class="%2$s">%3$s</ul><span class="nav-after"></span>' ) ); ?>
	<div id="main" class="clearfix">
		<div class="header-spacer"></div>
