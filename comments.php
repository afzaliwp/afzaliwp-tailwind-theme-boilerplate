<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-8">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <h2 class="comments-title text-2xl font-bold mb-4">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
				/* translators: 1: title. */
					esc_html__( 'One thought on “%1$s”', 'afzaliwp' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf(
				/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on “%2$s”', '%1$s thoughts on “%2$s”', $comment_count, 'comments title', 'afzaliwp' ) ),
					number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
        </h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

        <ol class="comment-list space-y-4">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
        </ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
            <p class="no-comments text-gray-600 italic"><?php esc_html_e( 'Comments are closed.', 'afzaliwp' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form(array(
		'class_submit' => 'btn btn-primary' // You can define your button class if you have a custom class
	));
	?>

</div><!-- #comments -->
