<?php
$user      = wp_get_current_user();
$banner_1x = forminator_plugin_url() . 'assets/images/Feature_highlight.png';
$banner_2x = forminator_plugin_url() . 'assets/images/Feature_highlight@2x.png';
?>

<div class="sui-modal sui-modal-md">

	<div
		role="dialog"
		id="forminator-new-feature"
		class="sui-modal-content"
		aria-live="polite"
		aria-modal="true"
		aria-labelledby="forminator-new-feature__title"
	>

		<div class="sui-box forminator-feature-modal" data-prop="forminator_dismiss_feature_1270" data-nonce="<?php echo esc_attr( wp_create_nonce( 'forminator_dismiss_notification' ) ); ?>">

			<div class="sui-box-header sui-flatten sui-content-center">

				<figure class="sui-box-banner" aria-hidden="true">
					<img
						src="<?php echo esc_url( $banner_1x ); ?>"
						srcset="<?php echo esc_url( $banner_1x ); ?> 1x, <?php echo esc_url( $banner_2x ); ?> 2x"
						alt=""
					/>
				</figure>

				<button class="sui-button-icon sui-button-white sui-button-float--right forminator-dismiss-new-feature" data-type="dismiss" data-modal-close>
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog.', 'forminator' ); ?></span>
				</button>

				<h3 class="sui-box-title sui-lg" style="overflow: initial; white-space: initial; text-overflow: initial;">
                    <?php esc_html_e( 'Help us improve your form building experience', 'forminator' ); ?>
                </h3>

				<p class="sui-description">
					<?php
					printf(
					/* translators: %s: Admin name */
						esc_html__( 'Hey there! %s, We believe Forminator is the ultimate form builder for your WordPress website. However, we understand that there`s always room for improvement. That`s why we need your support in collecting anonymous usage data to enhance the plugin`s capabilities and ensure it`s the most efficient tool for building your forms.', 'forminator' ),
						esc_html( ucfirst( $user->display_name ) )
					);
					?>
				</p>
                <p class="sui-description">
					<?php
					printf(
					/* Translators: 1. Opening <a> tag, 2. closing <a> tag  */
						esc_html__( 'Your data will be completely anonymous and will never be used to identify you, and we promise to use it only to improve Forminator. Learn more about usage tracking %1$shere%2$s.', 'forminator' ),
						'<a href="https://wpmudev.com/docs/privacy/our-plugins/#usage-tracking-fm" target="_blank">',
						'</a>'
					);
					?>
				</p>
				<div class="sui-form-field">

					<label for="forminator-new-feature-toggle" class="sui-toggle fui-highlighted-toggle">
					
						<input type="checkbox" id="forminator-new-feature-toggle" aria-labelledby="forminator-new-feature-toggle-label">
						
						<span class="sui-toggle-slider" aria-hidden="true"></span>
						
						<span id="forminator-new-feature-toggle-label" class="sui-toggle-label">
                            <?php esc_html_e( 'Allow usage data collection', 'forminator' ); ?>
                        </span>
						
						<span class="sui-tag sui-tag-sm sui-tag-grey" style="margin-left: 8px;">
                            <?php esc_html_e( 'Recommended', 'forminator' ); ?>
                        </span>
					
					</label>

				</div>
			</div>

			<div class="sui-box-footer sui-flatten sui-content-center">

				<button class="sui-button forminator-dismiss-new-feature" data-type="save" data-modal-close>
					<?php esc_html_e( 'Save', 'forminator' ); ?>
                </button>

			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
  jQuery('#forminator-new-feature .forminator-dismiss-new-feature').on('click', function (e) {
    e.preventDefault()

    var $notice = jQuery(e.currentTarget).closest('.forminator-feature-modal'),
      ajaxUrl = '<?php echo esc_url( forminator_ajax_url() ); ?>',
      dataType = jQuery(this).data('type'),
      ajaxData = {
        action: 'forminator_dismiss_notification',
        prop: $notice.data('prop'),
        _ajax_nonce: $notice.data('nonce')
      }

    if ( 'save' === dataType ) {
      ajaxData['usage_value'] = jQuery('#forminator-new-feature-toggle').is(':checked')
    }

    jQuery.post(ajaxUrl, ajaxData)
      .always(function () {
        $notice.hide()
      })
  })
</script>
