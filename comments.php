<?php if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die ( 'Please do not load this page directly. Thanks!' );
endif;
if ( post_password_required() && have_comments() ) :
	_e( 'Denne nyhed er kodeordsbeskyttet. Indtast kodeordet for at se kommentarer.', 'bike' );
	return;
endif; ?>

<div id="comments">	
	<h2><?php comments_number( __( 'Skriv en kommentar', 'bike' ), __( '1 kommentar', 'bike' ), __( '% kommentarer', 'bike' ) );?></h2>
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'bike_comment' ) ); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="pagination comments clearfix">
				<div class="alignleft"><?php previous_comments_link( __( '&larr; &AElig;ldre kommentarer', 'bike' ) ); ?></div>
				<div class="alignright"><?php next_comments_link( __( 'Nyere kommentarer &rarr;', 'bike' ) ); ?></div>
			</nav>
		<?php endif; ?>
	<?php else : ?>
		<?php if ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="notice"><?php _e( 'Det er ikke muligt at kommentere denne nyhed.', 'bike' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( comments_open() ) :
		if ( have_comments() ) :
			comment_form( array( 'comment_notes_before' => '', 'comment_notes_after' => '', 'title_reply' => __( 'Skriv en kommentar', 'bike' ), 'title_reply_to' => __( 'Skriv en kommentar til %s', 'bike' ), 'cancel_reply_link' => __( 'Annuller svar', 'bike' ), 'label_submit' => __( 'Send kommentar', 'bike' ) ) );
		else:
			comment_form( array( 'comment_notes_before' => '', 'comment_notes_after' => '', 'title_reply' => '', 'title_reply_to' => '', 'cancel_reply_link' => __( 'Annuller svar', 'bike' ), 'label_submit' => __( 'Send kommentar', 'bike' ) ) );
		endif;
	endif; ?>
</div>
