<?php
/**
 * Plugin activation
 *
 * @since      1.0.0
 * @package    OWM_Widget
 * @subpackage Includes
 * @category   Activation
 */

namespace OWM_Widget\Activate;

/**
 * Add plugin row notice
 *
 * @since  1.0.0
 * @return void
 */
function row_notice() {
	add_action( 'after_plugin_row_' . OWMW_BASENAME, __NAMESPACE__ . '\\after_plugin_row', 5, 3 );
}

/**
 * Deactivation notice: after plugin row
 *
 * @since  1.0.0
 * @return string Returns the markup of the plugin row notice.
 */
function after_plugin_row( $plugin_file, $plugin_data, $status ) {

	$colspan = 4;

	// If WP  version< 5.5.
	if ( version_compare( $GLOBALS['wp_version'], '5.5', '<' ) ) {
		$colspan = 3;
	}

	?>
	<style>
		.plugins tr[data-plugin='<?php echo OWMW_BASENAME; ?>'] th,
		.plugins tr[data-plugin='<?php echo OWMW_BASENAME; ?>'] td {
			box-shadow: none;
		}

		<?php if ( isset( $plugin_data['update'] ) && ! empty( $plugin_data['update'] ) ) : ?>

			.plugins tr.owm-widget-plugin-tr td {
				box-shadow: none ! important;
			}

			.plugins tr.owm-widget-plugin-tr .update-message {
				margin-bottom: 0;
			}

		<?php endif; ?>
	</style>

	<tr id="plugin-php-notice" class="plugin-update-tr active owm-widget-plugin-tr">
		<td colspan="<?php echo $colspan; ?>" class="plugin-update colspanchange">
			<div class="update-message notice inline notice-error notice-alt">
				<?php echo sprintf(
					__( '<p>This plugin requires the <a href="%s">OWM Weather plugin</a> to be installed and activated before the weather widget can be used.</p>', 'owm-widget' ),
					esc_url( admin_url( 'plugin-install.php?s=OWM Weather&tab=search&type=term' ) )
				); ?>
			</div>
		</td>
	</tr>
	<?php
}
