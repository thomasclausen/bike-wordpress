
		<div class="footer-spacer"></div>
	</div>
	
	<footer>
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<div class="widget-container clearfix">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		<?php endif; ?>
		<!-- AND NOW THE END IS NEAR! -->
	</footer>
	
	<?php wp_footer(); ?>

	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-XXXXXXX-X']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
</body>

</html>