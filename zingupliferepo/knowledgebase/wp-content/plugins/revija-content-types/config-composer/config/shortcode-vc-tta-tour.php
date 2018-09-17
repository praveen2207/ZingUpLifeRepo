<?php

vc_map( array(
	'name' => esc_html__( 'Tour', 'js_composer' ),
	'base' => 'vc_tta_tour',
	'icon' => 'icon-wpb-ui-tab-content-vertical',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'vc_tta_section'
	),
	'category' => esc_html__( 'Content', 'js_composer' ),
	'description' => esc_html__( 'Vertical tabbed content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'top_gap',
			'value' => array(
				esc_html__( 'None', 'js_composer' ) => '',
				esc_html__( '1px', 'js_composer' ) => '1',
				esc_html__( '2px', 'js_composer' ) => '2',
				esc_html__( '3px', 'js_composer' ) => '3',
				esc_html__( '4px', 'js_composer' ) => '4',
				esc_html__( '5px', 'js_composer' ) => '5',
				esc_html__( '10px', 'js_composer' ) => '10',
				esc_html__( '15px', 'js_composer' ) => '15',
				esc_html__( '20px', 'js_composer' ) => '20',
				esc_html__( '25px', 'js_composer' ) => '25',
				esc_html__( '30px', 'js_composer' ) => '30',
				esc_html__( '35px', 'js_composer' ) => '35',
				esc_html__( '50px', 'js_composer' ) => '50',
			),
			'heading' => esc_html__( 'Top', 'js_composer' ),
			'description' => esc_html__( 'Select tabs top margin.', 'js_composer' ),
			'std' => ''
		),
		array(
			'type' => 'hidden',
			'param_name' => 'no_fill_content_area',
			'heading' => esc_html__( 'Do not fill content area?', 'js_composer' ),
			'description' => esc_html__( 'Do not fill content area with color.', 'js_composer' ),
		),
		array(
			'type' => 'hidden',
			'param_name' => 'spacing',
			'value' => array(
				esc_html__( 'None', 'js_composer' ) => '',
				esc_html__( '1px', 'js_composer' ) => '1',
				esc_html__( '2px', 'js_composer' ) => '2',
				esc_html__( '3px', 'js_composer' ) => '3',
				esc_html__( '4px', 'js_composer' ) => '4',
				esc_html__( '5px', 'js_composer' ) => '5',
				esc_html__( '10px', 'js_composer' ) => '10',
				esc_html__( '15px', 'js_composer' ) => '15',
				esc_html__( '20px', 'js_composer' ) => '20',
				esc_html__( '25px', 'js_composer' ) => '25',
				esc_html__( '30px', 'js_composer' ) => '30',
				esc_html__( '35px', 'js_composer' ) => '35',
			),
			'heading' => esc_html__( 'Spacing', 'js_composer' ),
			'description' => esc_html__( 'Select tour spacing.', 'js_composer' ),
			'std' => '1'
		),
		array(
			'type' => 'hidden',
			'param_name' => 'gap',
			'value' => array(
				esc_html__( 'None', 'js_composer' ) => '',
				esc_html__( '1px', 'js_composer' ) => '1',
				esc_html__( '2px', 'js_composer' ) => '2',
				esc_html__( '3px', 'js_composer' ) => '3',
				esc_html__( '4px', 'js_composer' ) => '4',
				esc_html__( '5px', 'js_composer' ) => '5',
				esc_html__( '10px', 'js_composer' ) => '10',
				esc_html__( '15px', 'js_composer' ) => '15',
				esc_html__( '20px', 'js_composer' ) => '20',
				esc_html__( '25px', 'js_composer' ) => '25',
				esc_html__( '30px', 'js_composer' ) => '30',
				esc_html__( '35px', 'js_composer' ) => '35',
			),
			'heading' => esc_html__( 'Gap', 'js_composer' ),
			'description' => esc_html__( 'Select tour gap.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'tab_position',
			'value' => array(
				esc_html__( 'Left', 'js_composer' ) => 'left',
				esc_html__( 'Right', 'js_composer' ) => 'right'
			),
			'heading' => esc_html__( 'Position', 'js_composer' ),
			'description' => esc_html__( 'Select tour navigation position.', 'js_composer' ),
			'std' => 'left'
		),
		array(
			'type' => 'hidden',
			'param_name' => 'alignment',
			'value' => array(
				esc_html__( 'Left', 'js_composer' ) => 'left',
				esc_html__( 'Right', 'js_composer' ) => 'right',
				esc_html__( 'Center', 'js_composer' ) => 'center',
			),
			'heading' => esc_html__( 'Alignment', 'js_composer' ),
			'description' => esc_html__( 'Select tour section title alignment.', 'js_composer' ),
			'std' => 'left'
		),
		array(
			'type' => 'hidden',
			'param_name' => 'controls_size',
			'value' => array(
				esc_html__( 'Auto', 'js_composer' ) => '',
				esc_html__( 'Extra large', 'js_composer' ) => 'xl',
				esc_html__( 'Large', 'js_composer' ) => 'lg',
				esc_html__( 'Medium', 'js_composer' ) => 'md',
				esc_html__( 'Small', 'js_composer' ) => 'sm',
				esc_html__( 'Extra small', 'js_composer' ) => 'xs',
			),
			'std' => '',
			'heading' => esc_html__( 'Navigation width', 'js_composer' ),
			'description' => esc_html__( 'Select tour navigation width.', 'js_composer' ),
		),
		array(
			'type' => 'hidden',
			'param_name' => 'autoplay',
			'value' => array(
				esc_html__( 'None', 'js_composer' ) => 'none',
				esc_html__( '1', 'js_composer' ) => '1',
				esc_html__( '2', 'js_composer' ) => '2',
				esc_html__( '3', 'js_composer' ) => '3',
				esc_html__( '4', 'js_composer' ) => '4',
				esc_html__( '5', 'js_composer' ) => '5',
				esc_html__( '10', 'js_composer' ) => '10',
				esc_html__( '20', 'js_composer' ) => '20',
				esc_html__( '30', 'js_composer' ) => '30',
				esc_html__( '40', 'js_composer' ) => '40',
				esc_html__( '50', 'js_composer' ) => '50',
				esc_html__( '60', 'js_composer' ) => '60',
			),
			'std' => 'none',
			'heading' => esc_html__( 'Autoplay', 'js_composer' ),
			'description' => esc_html__( 'Select auto rotate for tour in seconds (Note: disabled by default).', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => esc_html__( 'Active section', 'js_composer' ),
			'value' => 1,
			'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
		),
	),
	'js_view' => 'VcBackendTtaTourView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-left vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
		                   . '<ul class="vc_tta-tabs-list">'
		                   . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}"><a href="javascript:;" data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}" data-vc-tabs>{{ section_title }}</a></li>'
		                   . '</ul>
		</div>
		<div class="vc_tta-panels {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'js_composer' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'js_composer' ), 2 ) . '"][/vc_tta_section]
	',
) );