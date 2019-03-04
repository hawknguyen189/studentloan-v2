<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$quickloans_mult = quickloans_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 102*$quickloans_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
        <div class="author_title_about"><?php echo esc_html__( 'About Author', 'quickloans' ); ?></div>
        <h5 class="author_title" itemprop="name"><?php echo wp_kses_data(get_the_author()); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>
			<?php do_action('quickloans_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
