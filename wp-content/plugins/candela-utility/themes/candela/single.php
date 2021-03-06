<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php get_header(); ?>
<?php if (get_option('blog_public') == '1' || (get_option('blog_public') == '0' && current_user_can_for_blog($blog_id, 'read'))): ?>

				<?php edit_post_link( __( 'Edit', 'pressbooks' ), '<span class="edit-link">', '</span>' ); ?>
			<h2 class="entry-title"><?php
				if ( $chapter_number = pb_get_chapter_number( $post->post_name ) ) echo "<span>$chapter_number</span>  ";
				the_title();
				?></h2>
					<?php pb_get_links(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>

					<div class="entry-content">
					  <?php if ($subtitle = get_post_meta($post->ID, 'pb_subtitle', true)): ?>
					    <h2 class="chapter_subtitle"><?php echo $subtitle; ?></h2>
				    <?php endif;?>
				    <?php if ($chap_author = get_post_meta($post->ID, 'pb_section_author', true)): ?>
				       <h2 class="chapter_author"><?php echo $chap_author; ?></h2>
			      <?php endif; ?>


						<?php
						the_content();
						if ( get_post_type( $post->ID ) === 'part' ) {
							echo get_post_meta( $post->ID, 'pb_part_content', true );
						} ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php if ( $citation = CandelaCitation::renderCitation( $post->ID ) ): ?>
					<div class="post-citations sidebar">
						<h3 id="citation-header-<?php print $post->ID; ?>" class="collapsed"><?php _e('Citations'); ?></h3>
						<div id="citation-list-<?php print $post->ID; ?>" style="display:none;">
							<?php print $citation ?>
						</div>
						<script>
							jQuery( document ).ready( function( $ ) {
								$( "#citation-header-<?php print $post->ID;?>" ).click(function() {
									$( "#citation-list-<?php print $post->ID;?>").slideToggle();
									$( "#citation-header-<?php print $post->ID;?>").toggleClass('expanded collapsed');
								});
							});
						</script>
					</div>
				<?php endif; ?>

				</div><!-- #content -->

				<?php get_template_part( 'content', 'social-footer' ); ?>

				<?php comments_template( '', true ); ?>
<?php else: ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;?>
