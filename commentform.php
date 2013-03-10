<div id="respond" class="custom">
	<div id="cancel-comment-reply"><?php cancel_comment_reply_link( __( 'Annuller svar', 'bike' ) ); ?></div>
	
	<span id="cancel-comment-reply-link"><a href="#"><?php _e( 'Annuller svar', 'bike' ); ?></a></span>
	<h3><?php comment_form_title( __( 'Skriv en kommentar', 'bike' ), __( 'Skriv en kommentar til %s', 'bike' ) ); ?></h3>
	<form action="<?php echo site_url( '/wp-comments-post.php' ) ?>" method="post" id="commentform">
		<?php comment_id_fields(); ?>
		<fieldset class="comment-form-comment">
			<textarea id="comment" name="comment" cols="100%" rows="8" tabindex="1" placeholder="<?php _e( 'Skriv din kommentar her...', 'bike' ); ?>" required aria-required="true"></textarea>
		</fieldset>
		<div class="comment-form-identity clearfix">
			<?php if ( is_user_logged_in() ) : ?>
				<?php global $current_user;
				get_currentuserinfo(); ?>
				<div id="comment-form-identity-wordpress" class="comment-form-service">
					<div class="comment-form-avatar"><a href="https://gravatar.com/site/signup/" target="_blank"><img src="http://www.gravatar.com/avatar/<?php echo md5( $current_user->user_email ); ?>?s=25&d=mm" alt="<?php _e( 'Gravatar', 'bike' ); ?>" width="25" class="no-grav" /></a></div>
					<div class="comment-form-fields">
						<p><?php _e( 'Du er logget ind som', 'bike' ); ?> <a href="<?php echo admin_url( 'profile.php' ); ?>"><?php echo $current_user->display_name; ?></a>. <span class="comment-form-log-out">(&nbsp;<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e( 'Log&nbsp;ud', 'bike' ); ?>"><?php _e( 'Log&nbsp;ud', 'bike' ); ?></a>&nbsp;)</span></p>
					</div>
				</div>
			<?php else : ?>
				<div id="comment-form-identity-guest" class="comment-form-service selected">
					<div class="comment-form-avatar"><a href="https://gravatar.com/site/signup/" target="_blank"><img src="http://www.gravatar.com/avatar/?s=25&forcedefault=y&d=mystery" alt="<?php _e( 'Gravatar', 'bike' ); ?>" width="25" class="no-grav" /></a></div>
					<div class="comment-form-fields">
						<fieldset class="comment-form-email">
							<input id="email" name="email" type="email" tabindex="2" placeholder="<?php _e( 'E-mail (p&aring;kr&aelig;vet - vil ikke v&aelig;re synlig eller blive offentliggjort)', 'bike' ) ?>" value="<?php echo esc_attr( $comment_author ); ?>" required aria-required="true" />
						</fieldset>
						<fieldset class="comment-form-author">
							<input id="author" name="author" type="text" tabindex="3" placeholder="<?php _e( 'Navn (p&aring;kr&aelig;vet)', 'bike' ); ?>" value="<?php echo esc_attr( $comment_author_email ); ?>" required aria-required="true" />
						</fieldset>
						<fieldset class="comment-form-url">
							<input id="url" name="url" type="text" tabindex="4" placeholder="<?php _e( 'Hjemmeside', 'bike' ); ?>" value="<?php echo esc_attr( $comment_author_url ); ?>" />
						</fieldset> 
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="comment-form-actions clearfix">
			<?php do_action( 'comment_form', $post->ID ); ?>
			<div class="comment-form-allowed-tags">
				<p><?php sprintf( __( 'Disse <abbr title="HyperText Markup Language">HTML</abbr> koder og attributter er tilladte: %s' ), ' <code>' . allowed_tags() . '</code>' ); ?></p>
			</div>
			<fieldset class="comment-form-submit">
				<input name="submit" type="submit" id="submit" tabindex="6" value="<?php _e( 'Send kommentar', 'bike' ); ?>" />
			</fieldset>
			<fieldset class="comment-form-subscribe">
				<input type="checkbox" name="subscribe_comments" id="subscribe_comments" value="subscribe_comments" />
				<label for="subscribe"><?php _e( 'Send mig en e-mail n&aring;r der kommer nye kommentarer', 'bike' ); ?></label>
				<input type="checkbox" name="subscribe_posts" id="subscribe_posts" value="subscribe_posts" />
				<label for="subscribe"><?php _e( 'Send mig en e-mail n&aring;r der kommer nye indl&aelig;g', 'bike' ); ?></label>
			</fieldset>
		</div>
	</form>
</div>