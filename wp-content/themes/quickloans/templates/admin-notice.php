<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage QUICKLOANS
 * @since QUICKLOANS 1.0.1
 */
?>
<div class="update-nag" id="quickloans_admin_notice">
	<h3 class="quickloans_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'quickloans'), wp_get_theme()->name); ?></h3>
	<?php
	if (!quickloans_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'quickloans')); ?></p><?php
	}
	?><p><?php
		if (quickloans_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'quickloans'); ?></a>
			<?php
		}
		if (function_exists('quickloans_exists_trx_addons') && quickloans_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'quickloans'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'quickloans'); ?></a>
        <a href="#" class="button quickloans_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'quickloans'); ?></a>
	</p>
</div>