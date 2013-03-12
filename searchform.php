	<article class="searchform clearfix">
		<form method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ); ?>">
			<fieldset class="clearfix">
				<label for="s"><?php _e( 'S&oslash;g', 'bike' ); ?></label>
				<input type="search" name="s" id="s" placeholder="<?php esc_attr_e( __( 'S&oslash;g', 'bike' ) ); ?>" value="<?php the_search_query(); ?>" />
			</fieldset>
			<fieldset class="button clearfix">
				<input type="submit" class="button" value="<?php esc_attr_e( __( 'S&oslash;g', 'bike' ) ); ?>" />
			</fieldset>
		</form>
	</article>