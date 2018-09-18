<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="subsubsub_section">

    <br class="clear" />

    <div class="section">

        <?php woocommerce_admin_fields($this->get_options()); ?>

		<hr />

        <ul id="woof_options" class="woof_options">

            <?php
            $taxonomies_tmp = $this->get_taxonomies();
            $taxonomies = array();

			$price = (object) array(
				'labels' => (object) array(
						'name' => esc_html__('Price', 'revija')
					)
			);
			$taxonomies_tmp['price'] = $price;

            if (!empty($this->settings['tax'])) {
                foreach ($this->settings['tax'] as $key => $value) {
                   $taxonomies[$key] = $taxonomies_tmp[$key];
                }
            }

           foreach ($taxonomies_tmp as $key => $value) {
                if (!in_array(@$taxonomies[$key], $taxonomies_tmp)) {
                    $taxonomies[$key] = $taxonomies_tmp[$key];
                }
            }

			if (!empty($taxonomies_tmp)) {

				foreach ($taxonomies as $key => $tax): ?>

					<li data-key="<?php echo esc_attr($key) ?>">

						<a href="#" class="help_tip" data-tip="<?php esc_html_e("drag and drop", "revija"); ?>"><img style="width: 22px; vertical-align: middle;" src="<?php echo WOOF_LINK ?>img/move.png" alt="<?php esc_html_e("move", "revija"); ?>" /></a>&nbsp;

						<?php if ($key !== 'price'): ?>
							<select class="woof_select_type" data-attribute="<?php echo esc_attr($key) ?>" data-id="[tax_type][<?php echo esc_attr($key) ?>]" name="woof_settings[tax_type][<?php echo esc_attr($key) ?>]">
								<?php foreach ($this->html_types as $type => $type_text) : ?>
									<option value="<?php echo esc_attr($type) ?>" <?php if (isset($woof_settings['tax_type'][$key])) echo selected($woof_settings['tax_type'][$key], $type) ?>><?php echo esc_attr($type_text) ?></option>
								<?php endforeach; ?>
							</select>
						<?php else: ?>
							<input type="hidden" value="price" data-attribute="<?php echo esc_attr($key) ?>" data-id="[tax_type][<?php echo esc_attr($key) ?>]" name="woof_settings[tax_type][<?php echo esc_attr($key) ?>]"/>
						<?php endif; ?>

						<?php if ($key !== 'price'): ?>
							<img class="help_tip" data-tip="<?php esc_html_e('View of the taxonomies terms on the front', 'revija') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;
						<?php else: ?>
							<img class="help_tip" data-tip="<?php esc_html_e('View price filter on the front', 'revija') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;
						<?php endif; ?>

						<?php if ($key !== 'price'): ?>
							<select class="woof_select_query_type" data-attribute="<?php echo esc_attr($key) ?>" data-id="[query_type][<?php echo esc_attr($key) ?>]" name="woof_settings[query_type][<?php echo esc_attr($key) ?>]">
								<?php foreach ($this->query_types as $type => $type_text) : ?>
									<option value="<?php echo esc_attr($type) ?>" <?php if (isset($woof_settings['query_type'][$key])) echo selected($woof_settings['query_type'][$key], $type) ?>><?php echo esc_attr($type_text) ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif; ?>

						<?php if ($key !== 'price'): ?>
							<img class="help_tip" data-tip="<?php esc_html_e('Query type', 'revija') ?>" src="<?php echo WP_PLUGIN_URL ?>/woocommerce/assets/images/help.png" height="16" width="16" />&nbsp;
						<?php endif; ?>

						<input id="woof_settings[tax][<?php echo esc_attr($key) ?>]" <?php echo(@in_array($key, @array_keys($this->settings['tax'])) ? 'checked="checked"' : '') ?> type="checkbox" name="woof_settings[tax][<?php echo esc_attr($key) ?>]" value="1" />
						<label for="woof_settings[tax][<?php echo esc_attr($key) ?>]"><?php echo esc_html($tax->labels->name) ?></label>

						<div class="woof_placeholder" <?php if (@in_array($key, @array_keys($this->settings['tax']))): ?>style="display: block"<?php endif; ?>>
							<?php
							if ($woof_settings['tax_type'][$key] == 'color') {
								REVIJA_WOOF::attributes_table(
									$woof_settings['tax_type'][$key],
									$key,
									$woof_settings['colors'][$key]
								);
							}
							?>
						</div><!--/ .woof_placeholder-->

						<span class="spinner" style="display: none;"></span>

					</li>

				<?php endforeach; ?>

			<?php } ?>

        </ul><!--/ #woof_options-->

    </div><!--/ .section-->

</div><!--/ .subsubsub_section-->

