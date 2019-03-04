<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */

						// Widgets area inside page content
						quickloans_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					quickloans_create_widgets_area('widgets_below_page');

					$quickloans_body_style = quickloans_get_theme_option('body_style');
					if ($quickloans_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$quickloans_footer_style = quickloans_get_theme_option("footer_style");
			if (strpos($quickloans_footer_style, 'footer-custom-')===0) $quickloans_footer_style = 'footer-custom';
			get_template_part( "templates/{$quickloans_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (quickloans_is_on(quickloans_get_theme_option('debug_mode')) && quickloans_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(quickloans_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>