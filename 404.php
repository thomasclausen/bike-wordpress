<?php $theme_post_type = get_post_type(); ?>

<?php get_header( $theme_post_type . '-404' ); ?>

<?php get_sidebar( $theme_post_type . '-404' ); ?>

	<section id="content" class="clearfix">
		<article class="page clearfix">
			<h1><?php _e( '&Aring;h nej, det her m&aring; bare ikke ske!', 'nord' ); ?></h1>
			<p><?php _e( 'Det du ledte efter kan vi simpelthen ikke finde, s&aring; m&aring;ske er siden flyttet, m&aring;ske eksisterer den slet ikke eller m&aring;ske har du af bare iver kommet til at skrive adresen forkert!', 'nord' ); ?></p>
			<p><?php _e( 'Men det er ingen grund til at bruge for meget tid p&aring;, for vi har nemlig f&aring;et besked og f&aring;r en evt. fejl rettet hurtigst muligt.', 'nord' ); ?></p>
			<p><?php _e( 'I stedet kan du:', 'nord' ); ?></p>
			<ul>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">forrige side</a>.', 'nord' ), 'javascript:history.go(-1)' ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">forsiden</a>.', 'nord' ), home_url() ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">sv&oslash;mmeskolen</a>.', 'nord' ), get_permalink( 2 ) ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">konkurrenceafdelingen</a>.', 'nord' ), get_permalink( 3 ) ); ?></li>
			</ul>
			<p><?php _e( 'eller benytte s&oslash;gefeltet nedenfor!', 'nord' ); ?></p>
			<?php get_search_form(); ?>
			<script type="text/javascript">document.getElementById('s') && document.getElementById('s').focus();</script>
		</article>
	</section>

<?php get_footer( $theme_post_type . '-404' ); ?>