<?php if( !is_single() ){?>

	</div><!-- #content -->

<?php } ?>
<?php if( !is_front_page() ){?>

  <?php
  if (!isset($_GET['content_only']) && !isset($_GET['hide_sidebar'])) {
    get_sidebar();
  }
  ?>

	</div><!-- #wrap -->
	<div class="push"></div>

	</div><!-- .wrapper for sitting footer at the bottom of the page -->
<?php } ?>

<?php if (!isset($_GET['content_only']) && !isset($_GET['hide_footer'])) { ?>

<div class="footer">
	<div class="inner">
		<?php if (get_option('blog_public') == '1' || is_user_logged_in()): ?>
			<?php if (is_page() || is_home( ) ): ?>

			<table>
				<tr>
					<td><?php _e('Book Name', 'pressbooks'); ?>:</td>
					<td><?php bloginfo('name'); ?></td>
				</tr>
				<?php global $metakeys; ?>
       			 <?php $metadata = pb_get_book_information();?>
				<?php foreach ($metadata as $key => $val): ?>
				<?php if ( isset( $metakeys[$key] ) && ! empty( $val ) ): ?>
				<tr>
					<td><?php _e($metakeys[$key], 'pressbooks'); ?>:</td>
					<td><?php if ( 'pb_publication_date' == $key ) { $val = date_i18n( 'F j, Y', absint( $val ) );  } echo $val; ?></td>
				<?php endif; ?>
				<?php endforeach; ?>
				</tr>
				<?php
				// Copyright
				echo '<tr><td>' . __( 'Copyright', 'pressbooks' ) . ':</td><td>';
				echo ( ! empty( $metadata['pb_copyright_year'] ) ) ? $metadata['pb_copyright_year'] : date( 'Y' );
				if ( ! empty( $metadata['pb_copyright_holder'] ) ) echo ' ' . __( 'by ', 'pressbooks' ) . ' ' . $metadata['pb_copyright_holder'] . '. ';
				echo "</td></tr>\n";
				?>

				</table>
				<?php endif; ?>

				<?php echo pressbooks_copyright_license(); ?>

		<?php endif; ?>
	</div><!-- #inner -->
</div><!-- #footer -->
<?php } ?>

<?php wp_footer(); ?>
<script>
    // get rid of double iframe scrollbars
    var default_height = Math.max(
        document.body.scrollHeight, document.body.offsetHeight,
        document.documentElement.clientHeight, document.documentElement.scrollHeight,
        document.documentElement.offsetHeight);
    parent.postMessage(JSON.stringify({
        subject: 'lti.frameResize',
        height: default_height
    }), '*');
</script>

</body>
</html>
