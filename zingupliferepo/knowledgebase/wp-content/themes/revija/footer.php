	<?php
		$mad_post_id = mad_post_id();
		$mad_sidebar_position = REVIJA_HELPER::template_layout_class('sidebar_position');
	?>

		<?php if ($mad_sidebar_position != 'no_sidebar'): ?>

			</main><!--/ #main-->

			<?php if (mad_custom_get_option('position_sidebar_mobile') == 'bottom'): ?>

				<?php get_sidebar(); ?>

			<?php endif; ?>

				</div><!--/ .row-->
			</div><!--/ .container-->

		<?php else: ?>

					</div><!--/ .col-sm-12-->
				</div><!--/ .row-->
			</div><!--/ .container-->

		<?php endif; ?>

	</div><!--/ .page_content_offset -->


	<!-- - - - - - - - - - - -/ Page Content - - - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

	<footer id="footer" class="footer">

		<?php
		/**
		 * footer_in_top_part hook
		 *
		 * @hooked footer_in_top_part_widgets - 10
		 */

		do_action('footer_in_top_part');
		?>

		<div class="footer_bottom_part">
			<div class="container clearfix">
				<div class="row ">

					<?php
						/**
						 * footer_in_bottom_part hook
						 *
						 * @hooked footer_in_bottom_part - 10
						 */

						do_action('footer_in_bottom_part');
					?>

				</div><!--/ .row-->
			</div><!--/ .container-->
		</div><!--/ .footer_bottom_part -->

	</footer><!--/ #footer-->

	<!-- - - - - - - - - - - - - -/ Footer - - - - - - - - - - - - - - - - -->

</div>

<?php wp_footer(); ?>

</body>
</html>