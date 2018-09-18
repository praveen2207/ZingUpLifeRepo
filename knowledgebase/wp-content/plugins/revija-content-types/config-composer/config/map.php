<?php

//global $revija_config;

/**
 * @since 4.6 new TTA, tabs tours and accordions
 */
include_once "shortcode-vc-tta-tabs.php";
include_once "shortcode-vc-tta-tour.php";
include_once "shortcode-vc-tta-accordion.php";
include_once "shortcode-vc-tta-section.php";



include_once 'shortcode-vc-btn.php';


//////////////custom param///////////////////////////////////////////////////////////////////////
$tag_taxonomies = array();
$taxonomies = get_taxonomies();
if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
	foreach ( $taxonomies as $taxonomy ) {
		$tax = get_taxonomy( $taxonomy );
		if ( ( is_object( $tax ) && ( ! $tax->show_tagcloud || empty( $tax->labels->name ) ) ) || ! is_object( $tax ) ) {
			continue;
		}
		$tag_taxonomies[ $tax->labels->name ] = esc_attr( $taxonomy );
	}
}


function revija_post_category_settings_field($param, $param_value) {
   $dependency = vc_generate_dependencies_attributes($param);
   

				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=category');
				$param_line = '';
				$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value dropdown wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';
                
				foreach($entries as $key => $entry) {
                    $selected = '';
                    if ( $entry->slug == $param_value ) $selected = ' selected="selected"';
                    $sidebar_name = $entry->name;
                    $param_line .= '<option value="'.$entry->slug.'"'.$selected.'>'.$sidebar_name.'</option>';
                }
                $param_line .= '</select>';
        
   
    return $param_line;
}
vc_add_shortcode_param('post_category', 'revija_post_category_settings_field');


$mad_icons_arr = array(
	esc_html__( 'None', 'revija' ) => 'none',
	esc_html__( 'Pencil', 'revija' ) => 'fa-pencil',
	esc_html__( 'Shopping Cart', 'revija' ) => 'fa-shopping-cart',
	esc_html__( 'Info', 'revija' ) => 'fa-info-circle',
	esc_html__( 'Check', 'revija' ) => 'fa-check',
	esc_html__( 'Warning', 'revija' ) => 'fa-warning',
	esc_html__( 'Flash', 'revija' ) => 'fa-flash',
	esc_html__( 'Refresh', 'revija' ) => 'fa-refresh',
	esc_html__( 'Times', 'revija' ) => 'fa-times'
);

$mad_target_arr = array(
	esc_html__( 'Same window', 'revija' ) => '_self',
	esc_html__( 'New window', 'revija' ) => "_blank"
);

$mad_colors_arr = array(
	esc_html__( 'Default', 'revija' ) => 'button_orange',
	esc_html__( 'Grey', 'revija' ) => 'button_grey',
	esc_html__( 'Grey Light', 'revija' ) => 'button_grey_light',
	esc_html__( 'Transparent', 'revija' ) => 'btn-transparent'
);

$mad_size_arr = array(
	esc_html__( 'Large', 'revija' ) => 'large',
	esc_html__( 'Medium', 'revija' ) => 'medium',
	esc_html__( 'Small', 'revija' ) => "small"
);

$mad_list_unordered_styles = array(
	esc_html__( 'Arrow', 'revija' ) => 'default_list_arrow',
	esc_html__( 'Check', 'revija' ) => 'default_list_check',	
	esc_html__( 'Circle', 'revija' ) => 'default_list_disk',
	esc_html__( 'Plus', 'revija' ) => 'default_list_plus',
	esc_html__( 'Minus', 'revija' ) => 'default_list_minus'
);

$mad_list_ordered_styles = array(
	esc_html__( 'Upper roman', 'revija' ) => 'default_list_numb upper-roman',
	esc_html__( 'Decimal', 'revija' ) => 'default_list_numb decimal'
);

$mad_add_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'revija' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__( 'No', 'revija' ) => '',
		esc_html__( 'Top to bottom', 'revija' ) => 'top-to-bottom',
		esc_html__( 'Bottom to top', 'revija' ) => 'bottom-to-top',
		esc_html__( 'Left to right', 'revija' ) => 'left-to-right',
		esc_html__( 'Right to left', 'revija' ) => 'right-to-left',
		esc_html__( 'Appear from center', 'revija' ) => "appear",
		esc_html__( 'Fade', 'revija' ) => "fade"
	),
	'group' => esc_html__( 'Animations', 'revija' ),
	'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'revija' )
);

$mad_short_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'revija' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__( 'No', 'revija' ) => '',
		esc_html__( 'Yes', 'revija' ) => 'yes'
	),
	'group' => esc_html__( 'Animations', 'revija' ),
	'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'revija' )
);

/* Default Shortcodes
/* --------------------------------------------------------------------- */

$post_types = get_post_types( array() );
$post_types_list = array();
if ( is_array( $post_types ) && ! empty( $post_types ) ) {
	foreach ( $post_types as $post_type ) {
		if ( $post_type !== 'revision' && $post_type !== 'nav_menu_item'/* && $post_type !== 'attachment'*/ ) {
			$label = ucfirst( $post_type );
			$post_types_list[] = array( $post_type, $label  );
		}
	}
}

$vc_taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
$taxonomies_list = array();
if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
	foreach ( $vc_taxonomies as $t ) {
		if ( is_object( $t ) ) {
			$taxonomies_list[] = array(
				'label' => $t->name,
				'value' => $t->term_id,
				'group_id' => $t->taxonomy,
				'group' =>
					isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
						? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
						: esc_html__( 'Taxonomies', 'js_composer' )
			);
		}
	}
}
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
	foreach ( $vc_taxonomies_types as $t => $data ) {
		if ( $t !== 'post_format' && is_object( $data ) ) {
			$taxonomies_for_filter[ $data->labels->name ] = $t;
		}
	}
}


$grid_cols_list = array(
	array( 'label' => "1", 'value' => 12 ),
);





$grid_params_custom = array(

	array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a title.', 'js_composer' )
		),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Data source', 'js_composer' ),
		'param_name' => 'post_type',
		'value' => array(
			esc_html__( 'Post', 'js_composer' ) => 'post',
			esc_html__( 'Portfolio', 'js_composer' ) => 'portfolio'
		),
		'std' => 'post',
		'description' => esc_html__( 'Select content type for your grid.', 'js_composer' )
	),
	array(
		'type' => 'autocomplete',
		'heading' => esc_html__( 'Include only', 'js_composer' ),
		'param_name' => 'include',
		'description' => esc_html__( 'Add posts, pages, etc. by title.', 'js_composer' ),
		'settings' => array(
			'multiple' => true,
			'sortable' => true,
			'groups' => true,
		),
		'dependency' => array(
			'element' => 'post_type',
			'value' => array( 'ids' ),
			//'callback' => 'vc_grid_include_dependency_callback',
		),
	),
	array(
		'type' => 'autocomplete',
		'heading' => esc_html__( 'Narrow data source', 'js_composer' ),
		'param_name' => 'taxonomies',
		'settings' => array(
			'multiple' => true,
			// is multiple values allowed? default false
			// 'sortable' => true, // is values are sortable? default false
			'min_length' => 1,
			// min length to start search -> default 2
			// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
			'groups' => true,
			// In UI show results grouped by groups, default false
			'unique_values' => true,
			// In UI show results except selected. NB! You should manually check values in backend, default false
			'display_inline' => true,
			// In UI show results inline view, default false (each value in own line)
			'delay' => 500,
			// delay for search. default 500
			'auto_focus' => true,
			// auto focus input, default true
			'values' => $taxonomies_list,
		),
		'param_holder_class' => 'vc_not-for-custom',
		'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Total items', 'js_composer' ),
		'param_name' => 'max_items',
		'value' => 10, // default value
		'param_holder_class' => 'vc_not-for-custom',
		'description' => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Display Style', 'js_composer' ),
		'param_name' => 'style',
		'value' => array(
			esc_html__( 'Show all', 'js_composer' ) => 'all',
			esc_html__( 'Load more button', 'js_composer' ) => 'load-more',
		),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'custom' ),
		),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
		'description' => esc_html__( 'Select display style for grid.', 'js_composer' ),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Items per page', 'js_composer' ),
		'param_name' => 'items_per_page',
		'description' => esc_html__( 'Number of items to show per page.', 'js_composer' ),
		'value' => '10',
		'dependency' => array(
			'element' => 'style',
			'value' => array( 'lazy', 'load-more', 'pagination' ),
		),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
	),
	array(
		'type' => 'checkbox',
		'heading' => esc_html__( 'Show filter', 'js_composer' ),
		'param_name' => 'show_filter',
		'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
		'description' => esc_html__( 'Append filter to grid.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Grid elements per row', 'js_composer' ),
		'param_name' => 'element_width',
		'value' => $grid_cols_list,
		'std' => '4',
		'edit_field_class' => 'vc_col-sm-6 vc_column',
		'description' => esc_html__( 'Select number of single grid elements per row.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Gap', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
		'std' => '30',
		'description' => esc_html__( 'Select gap between grid elements.', 'js_composer' ),
		'edit_field_class' => 'vc_col-sm-6 vc_column',
	),
	// Data settings
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Order by', 'js_composer' ),
		'param_name' => 'orderby',
		'value' => array(
			esc_html__( 'Date', 'js_composer' ) => 'date',
			esc_html__( 'Order by post ID', 'js_composer' ) => 'ID',
			esc_html__( 'Author', 'js_composer' ) => 'author',
			esc_html__( 'Title', 'js_composer' ) => 'title',
			esc_html__( 'Last modified date', 'js_composer' ) => 'modified',
			esc_html__( 'Post/page parent ID', 'js_composer' ) => 'parent',
			esc_html__( 'Number of comments', 'js_composer' ) => 'comment_count',
			esc_html__( 'Menu order/Page Order', 'js_composer' ) => 'menu_order',
			esc_html__( 'Meta value', 'js_composer' ) => 'meta_value',
			esc_html__( 'Meta value number', 'js_composer' ) => 'meta_value_num',
			// esc_html__('Matches same order you passed in via the 'include' parameter.', 'js_composer') => 'post__in'
			esc_html__( 'Random order', 'js_composer' ) => 'rand',
		),
		'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'js_composer' ),
		'group' => esc_html__( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Sorting', 'js_composer' ),
		'param_name' => 'order',
		'group' => esc_html__( 'Data Settings', 'js_composer' ),
		'value' => array(
			esc_html__( 'Descending', 'js_composer' ) => 'DESC',
			esc_html__( 'Ascending', 'js_composer' ) => 'ASC',
		),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'description' => esc_html__( 'Select sorting order.', 'js_composer' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Meta key', 'js_composer' ),
		'param_name' => 'meta_key',
		'description' => esc_html__( 'Input meta key for grid ordering.', 'js_composer' ),
		'group' => esc_html__( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'orderby',
			'value' => array( 'meta_value', 'meta_value_num' ),
		),
	),
	array(
		'type' => 'textfield',
		'heading' => esc_html__( 'Offset', 'js_composer' ),
		'param_name' => 'offset',
		'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'js_composer' ),
		'group' => esc_html__( 'Data Settings', 'js_composer' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),
	),
	array(
		'type' => 'autocomplete',
		'heading' => esc_html__( 'Exclude', 'js_composer' ),
		'param_name' => 'exclude',
		'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'js_composer' ),
		'group' => esc_html__( 'Data Settings', 'js_composer' ),
		'settings' => array(
			'multiple' => true,
		),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
			'callback' => 'vc_grid_exclude_dependency_callback',
		),
	),
	//Filter tab
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Filter by', 'js_composer' ),
		'param_name' => 'filter_source',
		'value' => $taxonomies_for_filter,
		'group' => esc_html__( 'Filter', 'js_composer' ),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'description' => esc_html__( 'Select filter source.', 'js_composer' ),
	),
	array(
		'type' => 'autocomplete',
		'heading' => esc_html__( 'Exclude from filter list', 'js_composer' ),
		'param_name' => 'exclude_filter',
		'settings' => array(
			'multiple' => true,
			// is multiple values allowed? default false
			// 'sortable' => true, // is values are sortable? default false
			'min_length' => 1,
			// min length to start search -> default 2
			// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
			'groups' => true,
			// In UI show results grouped by groups, default false
			'unique_values' => true,
			// In UI show results except selected. NB! You should manually check values in backend, default false
			'display_inline' => true,
			// In UI show results inline view, default false (each value in own line)
			'delay' => 500,
			// delay for search. default 500
			'auto_focus' => true,
			// auto focus input, default true
			'values' => $taxonomies_list,
		),
		'description' => esc_html__( 'Enter categories, tags won\'t be shown in the filters list', 'js_composer' ),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
			'callback' => 'vcGridFilterExcludeCallBack'
		),
		'group' => esc_html__( 'Filter', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Alignment', 'js_composer' ),
		'param_name' => 'filter_align',
		'value' => array(
			esc_html__( 'Center', 'js_composer' ) => 'center',
			esc_html__( 'Left', 'js_composer' ) => 'left',
			esc_html__( 'Right', 'js_composer' ) => 'right',
		),
		'dependency' => array(
			'element' => 'show_filter',
			'value' => array( 'yes' ),
		),
		'group' => esc_html__( 'Filter', 'js_composer' ),
		'description' => esc_html__( 'Select filter alignment.', 'js_composer' ),
	),
	array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Item Style', 'revija' ),
			'param_name' => 'style_custom',
			'value' => array(
				esc_html__( 'Style 1', 'revija' ) => 'style1',
				esc_html__( 'Style 2', 'revija' ) => 'style2',
				esc_html__( 'Style 3', 'revija' ) => 'style3',
				esc_html__( 'Style 4', 'revija' ) => 'style4'
			),
			'std' => 'style1',
			'description' => esc_html__( 'Choose the default item layout here.', 'revija' ),
			'group' => esc_html__( 'Item Design', 'js_composer' ),
		),
	array(
		'type' => 'vc_grid_id',
		'param_name' => 'grid_id',
	)
);


vc_map( array(
	'name' => esc_html__( 'Home Post with Load More', 'js_composer' ),
	'base' => 'vc_basic_grid',
	'icon' => 'icon-wpb-application-icon-large',
	'category' => esc_html__( 'Content', 'js_composer' ),
	'description' => esc_html__( 'Posts, pages or custom posts in grid', 'js_composer' ),
	'params' => $grid_params_custom
) );

vc_map( array(
	'name' => 'WP ' . esc_html__( 'Recent Comments', 'revija' ),
	'base' => 'vc_wp_recentcomments',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'The most recent comments', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Number of comments', 'js_composer' ),
			'description' => esc_html__( 'Enter number of comments to display.', 'js_composer' ),
			'param_name' => 'number',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_display',
			'value' => array(
				esc_html__( 'Type 1', 'revija' ) => 'type1',
				esc_html__( 'Type 2', 'revija' ) => 'type2'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . esc_html__( 'Tag Cloud', 'revija' ),
	'base' => 'vc_wp_tagcloud',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'Your most used tags in cloud format', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Taxonomy', 'js_composer' ),
			'param_name' => 'taxonomy',
			'value' => $tag_taxonomies,
			'description' => esc_html__( 'Select source for tag cloud.', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Format', 'revija' ),
			'param_name' => 'type_display',
			'value' => array(
				esc_html__( 'List', 'revija' ) => 'list',
				esc_html__( 'Flat', 'revija' ) => 'flat'
			),
			'description' => esc_html__( 'Select Format', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'count',
			'value' => REVIJA_VC_CONFIG::array_number(1, 30, 1, array('All' => '100')),
			'std' => 100,
			'description' => esc_html__( 'How many tags should be displayed', 'revija' ),
			'param_holder_class' => ''
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	)
) );


vc_map( array(
	'name' => 'WP ' . esc_html__( 'Categories', 'revija' ),
	'base' => 'vc_wp_categories',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'A list or dropdown of categories', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Display options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				esc_html__( 'Dropdown', 'js_composer' ) => 'dropdown',
				esc_html__( 'Show post counts', 'js_composer' ) => 'count',
				esc_html__( 'Show hierarchy', 'js_composer' ) => 'hierarchical'
			),
			'description' => esc_html__( 'Select display options for categories.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type display', 'revija' ),
			'param_name' => 'type_display',
			'value' => array(
				esc_html__( 'Round List', 'revija' ) => 'type1',
				esc_html__( 'List', 'revija' ) => 'type2'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'count_num',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 3,
			'description' => esc_html__( 'How many categories should be displayed?', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	)
) );




$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) && ! empty( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
			$custom_menus[ $single_menu->name ] = $single_menu->term_id;
		}
	}
}
vc_map( array(
	'name' => 'WP ' . esc_html__( "Custom Menu","revija" ),
	'base' => 'vc_wp_custommenu',
	'icon' => 'icon-wpb-wp',
	'category' => esc_html__( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => esc_html__( 'Use this widget to add one of your custom menus as a widget', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Menu', 'js_composer' ),
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'js_composer' ) : esc_html__( 'Select menu to display.', 'js_composer' ),
			'admin_label' => true
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Depth', 'revija' ),
			'param_name' => 'depth',
			'value' => REVIJA_VC_CONFIG::array_number(1, 3, 1, array('0' => 'All')),
			'std' => 0,
			'description' => esc_html__( 'How many levels of the hierarchy are to be included. 0 means all. Default 0.', 'revija' )
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		)
	)
) );


/* Widget Meat Our Writers
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Our Writers', 'revija' ),
	'base' => 'vc_mad_our_writers',
	'icon' => 'icon-wpb-mad-team-members',
	'description' => esc_html__( 'Widget Meat Our Writers', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('All' => '100')),
			'std' => 3,
			'description' => esc_html__( 'How many writers should be displayed?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_author',
			'value' => array(
				'Small' => 'type1',
				'Big' => 'type2',
				'List' => 'type3'
			),
			'description' => esc_html__( 'Select type.', 'revija' )
		),
		$mad_add_css_animation
	)
) );




/* Widget Meat Our Writers
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Newsletter(mailchimp)', 'revija' ),
	'base' => 'vc_mad_newsletter',
	'icon' => '',
	'description' => esc_html__( 'Widget Newsletter', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'revija' ),
			'param_name' => 'mailchimp_intro',
			'value'=> esc_html__( 'Sign up to our newsletter and get exclusive deals you will not find anywhere else straight to your inbox!', 'revija' ),
			'description' => esc_html__( 'Enter text.', 'revija' )
		),
		$mad_add_css_animation
	)
) );








/* Video Playlist
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Video Playlist(flexslider)', 'revija' ),
	'base' => 'vc_mad_video_playlist',
	'icon' => 'icon-wpb-film-youtube',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Animated carousel with images', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Video URL', 'revija' ),
			'param_name' => 'custom_links',
			'description' => sprintf( esc_html__( 'Enter url for each slide here. Divide url with linebreaks (Enter).Link to the video. More about supported formats at %s.', 'revija' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' ),
			'value' => ''
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom Title', 'revija' ),
			'param_name' => 'images_title',
			'description' => esc_html__( 'Enter title for each slide here. Divide title with linebreaks (Enter) . ', 'revija' ),
			'value' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_video',
			'value' => array(
				'Vertical Thumbnail' => 'type1',
				'Horizontal Thumbnail' => 'type2',
				'Without Thumbnail' => 'type3'
			),
			'description' => esc_html__( 'Select type video gallery.', 'revija' )
		),
		$mad_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	)
) );






/* Video element
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Video Player', 'revija' ),
	'base' => 'vc_video',
	'icon' => 'icon-wpb-film-youtube',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Embed YouTube/Vimeo player', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Title', 'revija' ),
			'param_name' => 'type_title',
			'value' => array(
				'Small' => 'small',
				'Big' => 'big'
			),
			'description' => esc_html__( 'Select type title.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Video link', 'revija' ),
			'param_name' => 'link',
			'admin_label' => true,
			'description' => sprintf( esc_html__( 'Link to the video. More about supported formats at %s.', 'revija' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		),
		$mad_add_css_animation,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'revija' ),
			'param_name' => 'css',
			// 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' ),
			'group' => esc_html__( 'Design options', 'revija' )
		),
	)
) );



/* Rating
---------------------------------------------------------- */
 
 
 /*
 
if (class_exists('RWP_API')) {
vc_map( array(
	'name' => esc_html__( 'Rating post', 'revija' ),
	'base' => 'vc_mad_rating',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Rating block', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as block title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Text', 'revija' ),
			'param_name' => 'text',
			'description' => esc_html__( 'Enter Text.', 'revija' )
		)
	)
) );
}

*/

/* LATEST TWEETS
---------------------------------------------------------- */
 
if (class_exists('Latest_Tweets_Widget')) {
vc_map( array(
	'name' => esc_html__( 'Latest Tweets', 'revija' ),
	'base' => 'vc_mad_tweets',
	'icon' => 'icon-wpb-tweetme',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Latest Tweets', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tweets Id', 'revija' ),
			'param_name' => 'tweetsid',
			'description' => esc_html__( 'Enter Tweets Id.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'num',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('100' => 'All')),
			'std' => 3,
			'description' => esc_html__( 'How many tweets should be displayed?', 'revija' )
		),
		$mad_add_css_animation
	)
) );
}


/* FACEBOOK
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Facebook like box', 'revija' ),
	'base' => 'vc_mad_facebook_likebox',
	'icon' => 'icon-wpb-balloon-facebook-left',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Facebook like box widget', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Width', 'revija' ),
			'param_name' => 'width',
			'description' => esc_html__( 'Enter Facebook Page width.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Height', 'revija' ),
			'param_name' => 'height',
			'description' => esc_html__( 'Enter Facebook Page height.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Page URL', 'revija' ),
			'param_name' => 'titleurl',
			'description' => esc_html__( 'Enter Facebook Page URL.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'connection',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('100' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed?', 'revija' )
		),
		$mad_add_css_animation
	)
) );

/* Dribbble Slider
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Dribbble Slider', 'revija' ),
	'base' => 'vc_mad_dribbble',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Dribbble Slider', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Player Id', 'revija' ),
			'param_name' => 'playerid',
			'description' => esc_html__( 'Enter Player Id.(dribbble) ', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_slider',
			'value' => array(
				'1 column' => 1,
				'2 column' => 2
			),
			'description' => esc_html__( 'Select type slide.', 'revija' )
		),
		$mad_add_css_animation
	)
) );


/* Instagram Slider
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Instagram Slider', 'revija' ),
	'base' => 'vc_mad_instagram',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Instagram Slider', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Instagram embed iframe', 'revija' ),
			'param_name' => 'link',
			'description' => sprintf( esc_html__( 'Visit %s to create.', 'revija' ), '<a href="www.intagme.com" target="_blank">www.intagme.com</a>' )
		),
		$mad_add_css_animation
	)
) );




/* Flickr Slider
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Flickr Slider', 'revija' ),
	'base' => 'vc_mad_flickr',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Flickr Slider', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Flickr embed iframe', 'revija' ),
			'param_name' => 'link',
			'description' => sprintf( esc_html__( 'Visit %s to create.', 'revija' ), '<a href="http://www.flickr.com" target="_blank">www.flickr.com</a>' )
		),
		$mad_add_css_animation
	)
) );

/* From Forum
---------------------------------------------------------- */
if(function_exists("bp_is_active")) { 
vc_map( array(
	'name' => esc_html__( 'From Forum', 'revija' ),
	'base' => 'vc_mad_from_forum',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'From Forum', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			"type" => "term_categories3",
			"term" => "forum",
			'heading' => esc_html__( 'Select forum', 'revija' ),
			"param_name" => "parent_forum",
			"holder" => "div",
			'description' => esc_html__('Select forum.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed?', 'revija' )
		),
		$mad_add_css_animation
	)
) );
}

/* MEMBER LOGIN
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Member Login', 'revija' ),
	'base' => 'vc_mad_login',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Member Login', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		$mad_add_css_animation
	)
) );



/* Page Title
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Page Title', 'revija' ),
	'base' => 'vc_mad_page_title',
	'icon' => 'icon-wpb-ui-custom_heading',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Page Title', 'revija' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'admin_label' => true,
			'value'=> esc_html__( 'This is custom page title', 'revija' ),
			'description' => esc_html__( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'revija' ),
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'revija' ),
			'param_name' => 'title_style',
			'value' => array(
				'big' => 'big',
				'medium' => 'medium',
				'small' => 'small'
			),
			'description' => esc_html__( 'Select title style.', 'revija' )
		)
	
	)
) );

/* Audio
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Audio', 'revija' ),
	'base' => 'vc_mad_audio',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Audio', 'revija' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Title', 'revija' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Title', 'revija' ),
			'param_name' => 'type_title',
			'value' => array(
				'Small' => 'small',
				'Big' => 'big'
			),
			'description' => esc_html__( 'Select type title.', 'revija' )
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Audio URL', 'revija' ),
			'param_name' => 'url',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Audio Path', 'revija' ),
		)
	)
) );



/* Soundcloud
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Soundcloud', 'revija' ),
	'base' => 'vc_mad_soundcloud',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Soundcloud', 'revija' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Title', 'revija' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Title', 'revija' ),
			'param_name' => 'type_title',
			'value' => array(
				'Small' => 'small',
				'Big' => 'big'
			),
			'description' => esc_html__( 'Select type title.', 'revija' )
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Audio ID', 'revija' ),
			'param_name' => 'url',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Audio ID', 'revija' ),
		)
	)
) );




/* Pagination
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Pagination', 'revija' ),
	'base' => 'vc_mad_pagination',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Pagination', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Title', 'revija' ),
		)
	)
) );

/* Custom Heading element
----------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Custom Heading', 'revija' ),
	'base' => 'vc_custom_heading',
	'icon' => 'icon-wpb-ui-custom_heading',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Add custom heading text with google fonts', 'revija' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'revija' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value'=> esc_html__( 'This is custom heading element with Google Fonts', 'revija' ),
			'description' => esc_html__( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'revija' ),
		),
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value'=>'',
			'settings'=>array(
				'fields'=>array(
					'tag' => 'h2',
//					'text_align',
//					'font_size',
//					'font_weight',
//					'line_height',
//					'color',

					'tag_description' => esc_html__('Select element tag.','revija'),
//					'text_align_description' => esc_html__('Select text alignment.','revija'),
//					'font_size_description' => esc_html__('Enter font size.','revija'),
//					'line_height_description' => esc_html__('Enter line height.','revija'),
//					'color_description' => esc_html__('Select color for your element.','revija'),
				),
			),
		),
//		array(
//			'type' => 'google_fonts',
//			'param_name' => 'google_fonts',
//			'value' => '',
//			'settings' => array(
//				'fields'=>array(
//					'font_family'=> '',
//					'font_style'=> 'regular',
//					'font_family_description' => esc_html__('Select font family.','revija'),
//					'font_style_description' => esc_html__('Select font styling.','revija')
//				)
//			),
//		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text align', 'revija' ),
			'param_name' => 'text_align',
			'value' => array(
				'left' => 'align-left',
				'center' => 'align-center',
				'right' => 'align-right'
			),
			'description' => esc_html__( 'Select text alignment.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Color', 'revija' ),
			'param_name' => 'heading_color',
			'description' => esc_html__( 'Select heading color for your heading.', 'revija' )
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( 'With bottom border', 'revija' ),
			"param_name" => "with_bottom_border",
			"description" => "Adds a bottom border to your heading.",
			"value" => array(
				esc_html__( 'Yes, please', 'revija' ) => 'on'
			)
		),
		$mad_add_css_animation,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'revija' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'revija' )
		)
	),
) );


/* Button
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Custom Button', 'revija' ),
	'base' => 'vc_button',
	'icon' => 'icon-wpb-ui-button',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Eye catching button', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Text on the button', 'revija' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => esc_html__( 'Text on the button', 'revija' ),
			'description' => esc_html__( 'Text on the button.', 'revija' )
		),
		array(
			'type' => 'href',
			'heading' => esc_html__( 'URL (Link)', 'revija' ),
			'param_name' => 'href',
			'description' => esc_html__( 'Button link.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Target', 'revija' ),
			'param_name' => 'target',
			'value' => $mad_target_arr
//			'dependency' => array( 'element'=>'href', 'not_empty'=>true, 'callback' => 'vc_button_param_target_callback' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'revija' ),
			'param_name' => 'color',
			'value' => $mad_colors_arr,
			'description' => esc_html__( 'Button color.', 'revija' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon', 'revija' ),
			'param_name' => 'icon',
			'value' => $mad_icons_arr,
			'description' => esc_html__( 'Button icon.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'revija' ),
			'param_name' => 'size',
			'value' => $mad_size_arr,
			'description' => esc_html__( 'Button size.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Button alignment', 'revija' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'Left', 'revija' ) => 'align-left',
				esc_html__( 'Center', 'revija' ) => 'align-center',
				esc_html__( 'Right', 'revija' ) => "align-right",
				esc_html__( 'None', 'revija' ) => "align-none"
			),
			'description' => esc_html__( 'Select button alignment.', 'revija' )
		),
		$mad_add_css_animation
	),
	'js_view' => 'VcButtonView'
) );


/* Blockquotes box
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blockquotes', 'revija' ),
	'base' => 'vc_mad_blockquotes',
	'icon' => 'icon-wpb-information-white',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Blockquotes', 'revija' ),
	'params' => array(

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title_block',
			'admin_label' => true,
			'value'=> '',
			'description' => esc_html__( 'Title block', 'revija' ),
		),
	
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Author', 'revija' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => ''
		),
		
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Content', 'revija' ),
			'param_name' => 'content',
			'value' => esc_html__( '<p>Content</p>', 'revija' )
		)	
	),
) );



/* Message box
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Message Box', 'revija' ),
	'base' => 'vc_message',
	'icon' => 'icon-wpb-information-white',
	'wrapper_class' => 'alert',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Notification box', 'revija' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Message box type', 'revija' ),
			'param_name' => 'color',
			'value' => array(
				esc_html__( 'Informational', 'revija' ) => 'alert-info',
				esc_html__( 'Warning', 'revija' ) => 'alert-warning',
				esc_html__( 'Success', 'revija' ) => 'alert-success',
				esc_html__( 'Error', 'revija' ) => "alert-danger"
			),
			'description' => esc_html__( 'Select message type.', 'revija' ),
			'param_holder_class' => 'vc_message-type'
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => 'messagebox_text',
			'heading' => esc_html__( 'Message text', 'revija' ),
			'param_name' => 'content',
			'value' => esc_html__( '<p>I am message box. Click edit button to change this text.</p>', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	),
	'js_view' => 'VcMessageView'
) );


/* Separator (Divider)
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Separator', 'revija' ),
	'base' => 'vc_separator',
	'icon' => 'icon-wpb-ui-separator',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'revija' ),
//"controls"	=> 'popup_delete',
	'description' => esc_html__( 'Horizontal separator line', 'revija' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Color', 'revija' ),
			'param_name' => 'color',
			'value' => array_merge( madGetVcShared( 'colors' ), array( esc_html__( 'Custom color', 'revija' ) => 'custom' ) ),
			'std' => 'grey',
			'description' => esc_html__( 'Separator color.', 'revija' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Separator alignment', 'revija' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'Center', 'revija' ) => 'align_center',
				esc_html__( 'Left', 'revija' ) => 'align_left',
				esc_html__( 'Right', 'revija' ) => "align_right"
			),
			'description' => esc_html__( 'Select separator alignment.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Custom Border Color', 'revija' ),
			'param_name' => 'accent_color',
			'description' => esc_html__( 'Select border color for your element.', 'revija' ),
			'dependency' => array(
				'element' => 'color',
				'value' => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'revija' ),
			'param_name' => 'style',
			'value' => madGetVcShared( 'separator styles' ),
			'description' => esc_html__( 'Separator style.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border width', 'revija' ),
			'param_name' => 'border_width',
			'value' => madGetVcShared( 'separator border widths' ),
			'description' => esc_html__( 'Border width in pixels.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Element width', 'revija' ),
			'param_name' => 'el_width',
			'value' => madGetVcShared( 'separator widths' ),
			'description' => esc_html__( 'Separator element width in percents.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	)
) );


/* List Styles
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'List Styles', 'revija' ),
	'base' => 'vc_mad_list_styles',
	'icon' => 'icon-wpb-mad-list-styles',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'List styles', 'revija' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'List Type', 'revija' ),
			'param_name' => 'list_type',
			'value' => array(
				esc_html__( 'Unordered', 'revija' ) => 'unordered',
				esc_html__( 'Ordered', 'revija' ) => 'ordered'
			),
			'description' => esc_html__( 'Choose list type', 'revija' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'List Unordered Styles', 'revija' ),
			'param_name' => 'list_unordered_styles',
			'value' => $mad_list_unordered_styles,
			'description' => esc_html__( 'Choose styles for unordered list', 'revija' ),
			"dependency" => array(
				"element" => "list_type",
				"value" => array("unordered")
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'List Ordered Styles', 'revija' ),
			'param_name' => 'list_ordered_styles',
			'value' => $mad_list_ordered_styles,
			'description' => esc_html__( 'Choose styles for ordered list', 'revija' ),
			"dependency" => array(
				"element" => "list_type",
				"value" => array("ordered")
			)
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'List Items', 'revija' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Input list items values. Divide values with linebreaks (Enter). Example: Development|Design|Marketing', 'revija' ),
			'value' => ''
		),
		$mad_add_css_animation
	)
) );

/* Tables
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Custom Tables', 'revija' ),
	'base' => 'vc_mad_tables1',
	'icon' => 'icon-wpb-mad-tables',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Tables', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Table', 'revija' ),
			'param_name' => 'table_type',
			'value' => array(
				esc_html__( 'Horizontal', 'revija' ) => 'table_type_1',
				esc_html__( 'Vertical', 'revija' ) => 'table_type_1 table_type_2'
			),
			'description' => esc_html__( 'Choose table type', 'revija' ),
			'admin_label' => true
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Table values', 'revija' ),
			'param_name' => 'custom_data',
			'value' => '',
			'description' => esc_html__( 'Enter values for table. Divide text with (||) . ', 'revija' )
		),
		array(
			"type" => "number",
			"heading" => esc_html__("Columns", "revija"),
			"param_name" => "columns",
			'std' => 1,
			"description" => esc_html__( 'Columns', 'revija' )
		),
		array(
			"type" => "number",
			"heading" => esc_html__( 'Rows', 'revija' ),
			"param_name" => "rows",
			'std' => 1,
			"description" => esc_html__( 'Rows', 'revija' )
		),
		array(
			"type" => "hidden",
			"param_name" => "data",
			"class" => "tables-hidden-data",
			"description" => ''
		)
	)
) );



/* Social icons
---------------------------------------------------------- */

vc_map( array(
	"name"		=> esc_html__('Social icons', 'revija'),
	"base"		=> "vc_mad_social_icons",
	"icon"		=> "icon-wpb-vc_icon",
	"is_container" => false,
	"category"  => esc_html__('Content', 'revija'),
	"description" => esc_html__('Styled Social Icons', 'revija'),
	"params" => array(
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'Title', 'revija' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => esc_html__( 'Block title.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Select type', 'revija' ),
			"param_name" => "type",
			"value" => array(
				'With border' => 'type_border',
				'Without border' => 'type_without_border'
				)
			),
			
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL website', 'revija' ),
			"param_name" => "website_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL website.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL facebook', 'revija' ),
			"param_name" => "facebook_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL facebook.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL twitter', 'revija' ),
			"param_name" => "twitter_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL twitter.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL google_plus', 'revija' ),
			"param_name" => "google_plus_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL google_plus.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL rss', 'revija' ),
			"param_name" => "rss_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL rss.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL pinterest', 'revija' ),
			"param_name" => "pinterest_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL pinterest.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL instagram', 'revija' ),
			"param_name" => "instagram_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL instagram.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL linkedin', 'revija' ),
			"param_name" => "linkedin_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL linkedin.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL vimeo', 'revija' ),
			"param_name" => "vimeo_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL vimeo.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL youtube', 'revija' ),
			"param_name" => "youtube_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL youtube.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL flickr', 'revija' ),
			"param_name" => "flickr_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL flickr.', 'revija' ),
			"value" => ''
			),
			array(
			"type" => "textfield",
			"heading" => esc_html__( 'URL envelope', 'revija' ),
			"param_name" => "envelope_link",
			"holder" => "h4",
			"description" => esc_html__( 'Enter URL envelope.', 'revija' ),
			"value" => ''
			),
			
			
		$mad_add_css_animation
	)
));

/* Price Table
---------------------------------------------------------- */

vc_map( array(
	"name"		=> esc_html__('Pricing Table', 'revija'),
	"base"		=> "vc_mad_pricing_box",
	"icon"		=> "icon-wpb-mad-pricing-box",
//	"allowed_container_element" => false,
	"is_container" => false,
	"category"  => esc_html__('Content', 'revija'),
	"description" => esc_html__('Styled pricing tables', 'revija'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Title', 'revija' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => esc_html__( 'Give your plan a title.', 'revija' ),
			"value" => esc_html__( 'Free', 'revija' ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Currency', 'revija' ),
			"param_name" => "currency",
			"holder" => "span",
			"description" => esc_html__( 'Enter currency symbol or text, e.g., $ or USD.', 'revija' ),
			"value" => esc_html__( '$', 'revija' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Price', 'revija' ),
			"param_name" => "price",
			"holder" => "span",
			"description" => esc_html__( 'Set the price for this plan.', 'revija' ),
			"value" => esc_html__( '15', 'revija' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Time', 'revija' ),
			"param_name" => "time",
			"holder" => "span",
			"description" => esc_html__( 'Choose time span for you plan, e.g., per month', 'revija' ),
			"value" => esc_html__( 'per month', 'revija' )
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( 'Features', 'revija' ),
			"param_name" => "features",
			"holder" => "span",
			"description" => esc_html__( 'A short description or list for the plan.', 'revija' ),
			"value" => esc_html__( 'Up to 50 users | Limited team members | Limited disk space | Custom Domain | PayPal Integration | Basecamp Integration', 'revija' )
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( 'Add URL to the whole box (optional)', 'revija' ),
			"param_name" => "link",
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( 'Select style', 'revija' ),
			"param_name" => "box_style",
			"value" => array(
				'Orange' => 'bg_color_orange',
				'Yellow' => 'basic',
				'Green' => 'free',
				'Red' => 'pro',
				'Blue' => 'premium',
				'Custom' => 'custom'
			),
			"description" => esc_html__( 'Choose style for this pricing box.', 'revija' ),
			"group" => esc_html__('Design', 'revija')
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( 'Header Background color', 'revija' ),
			"param_name" => "header_bg_color",
			"value" => "#292f38",
			"description" => esc_html__( 'Set background color for pricing box header.', 'revija' ),
			"group" => esc_html__('Design', 'revija'),
			"dependency" => array(
				'element' => "box_style",
				'value' => array('custom')
			)
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( 'Main Background color', 'revija' ),
			"param_name" => "main_bg_color",
			"value" => "#323a45",
			"description" => esc_html__( 'Set background color for pricing box main.', 'revija' ),
			"group" => esc_html__('Design', 'revija'),
			"dependency" => array(
				'element' => "box_style",
				'value' => array('custom')
			)
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( 'Add hot?', 'revija' ),
			"param_name" => "add_hot",
			"group" => esc_html__('Hot', 'revija'),
			"description" => "Adds a nice hot to your pricing box.",
			"value" => array(
				esc_html__( 'Yes, please', 'revija' ) => 'on'
			)
		),
		$mad_add_css_animation
	)
//	"js_view" => 'VcPricingView'
));


/* Testimonials
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Testimonials', 'revija' ),
	'base' => 'vc_mad_testimonials',
	'icon' => 'icon-wpb-mad-testimonials',
	'description' => esc_html__( 'Testimonials post type', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Testimonial Style', 'revija' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Testimonial List', 'revija' ) => 'tm-list',
				esc_html__( 'Testimonial Slider', 'revija' ) => 'tm-slider'
			),
			'description' => esc_html__( 'Here you can select how to display the testimonials. You can either create a testimonial slider or a testimonial grid with multiple columns', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'revija' ),
			'param_name' => 'items',
			'value' => REVIJA_VC_CONFIG::array_number(1, 10, 1, array('All' => '-1')),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Display show image', 'revija' ),
			'param_name' => 'display_show_image',
			'description' => esc_html__( 'output date', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			"type" => "term_categories",
			"term" => "testimonials_category",
			'heading' => esc_html__( 'Which categories should be used for the testimonials?', 'revija' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show testimonials from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'revija' ),
			'param_name' => 'pagination',
			'value' => array(
				esc_html__( 'No', 'revija' ) => 'no',
				esc_html__( 'Yes', 'revija' ) => 'yes'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('tm-list')
			),
			'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
		),
		$mad_add_css_animation
	)
) );



/* blockquotes_carousel
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blockquotes carousel', 'revija' ),
	'base' => 'vc_mad_blockquotes_carousel',
	'icon' => 'icon-wpb-mad-testimonials',
	'description' => esc_html__( 'Blockquotes post type', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'revija' ),
			'param_name' => 'items',
			'value' => REVIJA_VC_CONFIG::array_number(1, 10, 1, array('All' => '-1')),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "blockquotes_category",
			'heading' => esc_html__( 'Which categories should be used for the testimonials?', 'revija' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show testimonials from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'revija' )
		),
		$mad_add_css_animation
	)
) );



/* Home Blog Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Home Posts', 'revija' ),
	'base' => 'vc_mad_home_posts',
	'icon' => 'icon-wpb-application-icon-large',
	'description' => esc_html__( 'Home Posts', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Blog Style', 'revija' ),
			'param_name' => 'blog_style',
			'value' => array(
				esc_html__( 'Blog Style 1', 'revija' ) => 'blog-style-1',
				esc_html__( 'Blog Style 2', 'revija' ) => 'blog-style-2'
			),
			'description' => esc_html__( 'Choose the default blog layout here.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'revija' ),
			'param_name' => 'pagination',
			'value' => array(
				esc_html__( 'No', 'revija' ) => 'no',
				esc_html__( 'Yes', 'revija' ) => 'yes'
			),
			'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
		)
	)
) );







/* Blog Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blog Posts', 'revija' ),
	'base' => 'vc_mad_blog_posts',
	'icon' => 'icon-wpb-application-icon-large',
	'description' => esc_html__( 'Blog posts', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Advertising', 'revija' ),
			'param_name' => 'advertising',
			'value'=> '',
			'description' => esc_html__( 'Enter text advertising.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Advertising after post', 'revija' ),
			'param_name' => 'advertising_after_post',
			'value' => REVIJA_VC_CONFIG::array_number(1, 100),
			'description' => esc_html__( 'Select number.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Blog Style', 'revija' ),
			'param_name' => 'blog_style',
			'value' => array(
				esc_html__( 'Blog Style 1', 'revija' ) => 'blog-style-1',
				esc_html__( 'Blog Style 2', 'revija' ) => 'blog-style-2',
				esc_html__( 'Blog Style 3', 'revija' ) => 'blog-style-3',
				esc_html__( 'Blog Style 4', 'revija' ) => 'blog-style-4',
				esc_html__( 'Blog Style 5', 'revija' ) => 'blog-style-5',
				esc_html__( 'Blog Style 6', 'revija' ) => 'blog-style-6',
				esc_html__( 'Blog Style 7', 'revija' ) => 'blog-style-7'
			),
			'description' => esc_html__( 'Choose the default blog layout here.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'all')),
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Posts Exerpt Count', 'revija' ),
			'param_name' => 'exerpt_count',
			'value' => '100',
			'description' => esc_html__( 'How many letters should be displayed?', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'First post big?', 'revija' ),
			'param_name' => 'first_big_post',
			'description' => '',
			'dependency' => array(
				'element' => 'blog_style',
				'value' => array('blog-style-2','blog-style-4','blog-style-6')
			),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'revija' ),
			'param_name' => 'pagination',
			'value' => array(
				esc_html__( 'No', 'revija' ) => 'no',
				esc_html__( 'Yes', 'revija' ) => 'yes'
			),
			'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
		)
	)
) );




/* Breaking News
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Breaking News', 'revija' ),
	'base' => 'vc_mad_posts_breaking',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Breaking News', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Only Title', 'revija' ) => 'type1',
				esc_html__( 'Thumbnail', 'revija' ) => 'type2'
			),
			'description' => esc_html__( 'Type styles news', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed?', 'revija' )
		),
		$mad_add_css_animation
	)
) );



/* Numeric Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Numeric Posts from Category', 'revija' ),
	'base' => 'vc_mad_posts_numeric',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Posts from Category', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Meta key', 'revija' ),
			'param_name' => 'meta_key',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array( 'meta_value', 'meta_value_num' ),
			),
			'description' => esc_html__( 'Input meta key for post ordering.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		$mad_add_css_animation
	)
) );








/* Also in Post Category
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Also in Post Label', 'revija' ),
	'base' => 'vc_mad_posts_also',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Blog posts', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'revija' ),
			'param_name' => 'title_color',
			'description' => esc_html__( 'Select heading color for your title.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'URL View All', 'revija' ),
			'param_name' => 'url_view_all',
			'description' => esc_html__( 'Enter URL.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "label",
			'heading' => esc_html__( 'Which labels should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those labels.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Thumbnail', 'revija' ),
			'param_name' => 'show_th',
			'value' => array(
				esc_html__( 'Show', 'revija' ) => 'show',
				esc_html__( 'Hide', 'revija' ) => 'hide'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		),
		$mad_add_css_animation
	)
) );



/* Other News
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Other News', 'revija' ),
	'base' => 'vc_mad_other_news',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Other News', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		$mad_add_css_animation
	)
) );







/* Posts Slider
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Posts Slider', 'revija' ),
	'base' => 'vc_mad_posts_slider',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Home posts slider', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Type 1', 'revija' ) => 'type1',
				esc_html__( 'Type 2', 'revija' ) => 'type2',
				esc_html__( 'Type 3', 'revija' ) => 'type3',
				esc_html__( 'Type 4', 'revija' ) => 'type4',
				esc_html__( 'Type 5', 'revija' ) => 'type5'
			),
			'description' => esc_html__( 'Select Type Slider', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Featured Post ID', 'revija' ),
			'param_name' => 'featured_id',
			'dependency' => array(
					'element' => 'type',
					'value' => array('type2')
				),
			'description' => esc_html__( 'Enter Featured Post ID.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'revija' ),
			'param_name' => 'img_size',
			'description' => esc_html__( 'Enter image size in pixels: 1140*500 (Width * Height). Leave empty to use full size.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Post', 'revija' ),
			'param_name' => 'post_type',
			'value' => array(
				esc_html__( 'Post', 'revija' ) => 'post',
				esc_html__( 'Portfolio', 'revija' ) => 'portfolio'
			),
			'description' => esc_html__( 'Select Type Post', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the posts?', 'revija' ),
			"param_name" => "category",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('post')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			"type" => "term_categories2",
			"term" => "portfolio_categories",
			'heading' => esc_html__( 'Which categories should be used for the portfolio?', 'revija' ),
			"param_name" => "category_portfolio",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('portfolio')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		$mad_add_css_animation
	)
) );









/* Posts Carousel
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Posts Carousel', 'revija' ),
	'base' => 'vc_mad_posts_carousel',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Posts Carousel', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'revija' ),
			'param_name' => 'title_color',
			'description' => esc_html__( 'Select heading color for your title.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'URL View All', 'revija' ),
			'param_name' => 'url_view_all',
			'description' => esc_html__( 'Enter URL.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'revija' ),
			'param_name' => 'img_size',
			'description' => esc_html__( 'Enter image size in pixels: 555*374 (Width * Height).', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Post', 'revija' ),
			'param_name' => 'post_type',
			'value' => array(
				esc_html__( 'Post', 'revija' ) => 'post',
				esc_html__( 'Portfolio', 'revija' ) => 'portfolio'
			),
			'description' => esc_html__( 'Select Type Post', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the posts?', 'revija' ),
			"param_name" => "category",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('post')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			"type" => "term_categories2",
			"term" => "portfolio_categories",
			'heading' => esc_html__( 'Which categories should be used for the portfolio?', 'revija' ),
			"param_name" => "category_portfolio",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('portfolio')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Item', 'revija' ),
			'param_name' => 'carousel_type',
			'value' => array(
				esc_html__( 'Type 1', 'revija' ) => 'type1',
				esc_html__( 'Type 2', 'revija' ) => 'type2',
				esc_html__( 'Type 3', 'revija' ) => 'type3',
				esc_html__( 'Type 4', 'revija' ) => 'type4'
			),
			'description' => esc_html__( 'Select Type Item', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'revija' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '1 Columns', 'revija' ) => '1',
				esc_html__( '3 Columns', 'revija' ) => '3',
				esc_html__( '4 Columns', 'revija' ) => '4',
				esc_html__( '5 Columns', 'revija' ) => '5'
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'revija' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Loop', 'revija' ),
			'param_name' => 'loop',
			'description' => esc_html__( 'Enables loop mode.', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		),
		$mad_add_css_animation
	)
) );





/* Posts Most Read
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Posts Most Read', 'revija' ),
	'base' => 'vc_mad_posts_most_read',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Posts Most Read', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'revija' ),
			'param_name' => 'title_color',
			'description' => esc_html__( 'Select heading color for your title.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'URL View All', 'revija' ),
			'param_name' => 'url_view_all',
			'description' => esc_html__( 'Enter URL.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Big', 'revija' ) => 'type1',
				esc_html__( 'Small', 'revija' ) => 'type2',
				esc_html__( 'List', 'revija' ) => 'type3'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 4,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		
		$mad_add_css_animation
	)
) );



/* Posts Most Liked
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Posts Most Liked', 'revija' ),
	'base' => 'vc_mad_posts_most_liked',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Posts Most Liked', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'revija' ),
			'param_name' => 'title_color',
			'description' => esc_html__( 'Select heading color for your title.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'URL View All', 'revija' ),
			'param_name' => 'url_view_all',
			'description' => esc_html__( 'Enter URL.', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'revija' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Big', 'revija' ) => 'type1',
				esc_html__( 'Small', 'revija' ) => 'type2',
				esc_html__( 'List', 'revija' ) => 'type3'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 4,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		
		$mad_add_css_animation
	)
) );





/* Post Tabs From Category
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Post Tabs From Category', 'revija' ),
	'base' => 'vc_mad_post_tabs',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Blog posts', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'revija' ),
			'param_name' => 'title_color',
			'description' => esc_html__( 'Select heading color for your title.', 'revija' )
		),
		array(
            "type" => "post_category",
            "heading" => esc_html__("Select category", "js_composer"),
            "param_name" => "category",
			"holder" => "div",
            "description" => esc_html__("Select category.", "js_composer")
        ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'posts_per_page',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_post_tabs',
			'value' => array(
				esc_html__( 'Type 1', 'revija' ) => 'type1',
				esc_html__( 'Type 2', 'revija' ) => 'type2',
				esc_html__( 'Type 3', 'revija' ) => 'type3'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		

		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => 'font_size:14',
			'group' => esc_html__( 'Post style', 'revija' ),
			'settings' => array(
				'fields' => array(
					'font_size',
					'color',
					'font_size_description' => __( 'Enter font size for title post.', 'js_composer' ),
					'color_description' => __( 'Select heading color for title post.', 'js_composer' ),
				),
			),
		),
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		$mad_add_css_animation
	)
) );





/* Posts Top Rated
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Posts Top Rated', 'revija' ),
	'base' => 'vc_mad_posts_top_rated',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => esc_html__( 'Posts Top Rated', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title length', 'revija' ),
			'param_name' => 'excerptlength',
			'value' => '15',
			'description' => esc_html__( 'Enter Title length.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Meta key', 'revija' ),
			'param_name' => 'meta_key',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array('meta_value_num')
			),
			'value' => '',
			'description' => esc_html__( 'Enter meta key.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC'
			),
			'description' => esc_html__( 'Designates the ascending or descending order.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Post', 'revija' ),
			'param_name' => 'post_type',
			'value' => array(
				esc_html__( 'Post', 'revija' ) => 'post',
				esc_html__( 'Portfolio', 'revija' ) => 'portfolio'
			),
			'description' => esc_html__( 'Select Type Post', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the posts?', 'revija' ),
			"param_name" => "category",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('post')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			"type" => "term_categories2",
			"term" => "portfolio_categories",
			'heading' => esc_html__( 'Which categories should be used for the portfolio?', 'revija' ),
			"param_name" => "category_portfolio",
			'dependency' => array(
				'element' => 'post_type',
				'value' => array('portfolio')
			),
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type_display',
			'value' => array(
				esc_html__( 'Type1', 'revija' ) => 'type1',
				esc_html__( 'Type2', 'revija' ) => 'type2',
				esc_html__( 'Type3', 'revija' ) => 'type3',
				esc_html__( 'Type4', 'revija' ) => 'type4'
			),
			'description' => esc_html__( 'Select Type', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'revija' ),
			'param_name' => 'num_items',
			'value' => REVIJA_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 4,
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' )
		),
		$mad_add_css_animation
	)
) );










if (class_exists('WooCommerce')) {

	/* Product Grid
	---------------------------------------------------------- */

	vc_map( array(
		'name' => esc_html__( 'Products', 'revija' ),
		'base' => 'vc_mad_products',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => esc_html__( 'WooCommerce', 'revija' ),
		'description' => esc_html__( 'Displayed for product grid', 'revija' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'revija' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Type Title', 'revija' ),
				'param_name' => 'title_type',
				'value' => array(
					esc_html__( 'Big', 'revija' ) => 'big',
					esc_html__( 'Small', 'revija' ) => 'small'
				),
				'description' => esc_html__( 'Select Type Title', 'revija' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Result count', 'revija' ),
				'param_name' => 'filter',
				'value' => array(
					esc_html__( 'No', 'revija' ) => 'no',
					esc_html__( 'Yes', 'revija' ) => 'yes'
				),
				'description' => esc_html__( 'Should the result count be displayed?', 'revija' )
			),
			array(
				"type" => "term_categories",
				"term" => "product_cat",
				'heading' => esc_html__( 'Which categories should be used for the products?', 'revija' ),
				"param_name" => "categories",
				"holder" => "div",
				'description' => esc_html__('The Page will then show products from only those categories.', 'revija')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns', 'revija' ),
				'param_name' => 'columns',
				'value' => array(
					esc_html__( '3 Columns', 'revija' ) => 3,
					esc_html__( '4 Columns', 'revija' ) => 4
				),
				'description' => esc_html__( 'How many columns should be displayed?', 'revija' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Count Items', 'revija' ),
				'param_name' => 'items',
				'value' => REVIJA_VC_CONFIG::array_number(1, 30, 1, array('All' => -1)),
				'std' => 9,
				'description' => esc_html__( 'How many items should be displayed per page?', 'revija' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show', 'revija' ),
				'param_name' => 'show',
				'value' => array(
					esc_html__( 'All Products', 'revija' ) => '',
					esc_html__( 'Featured Products', 'revija' ) => 'featured',
					esc_html__( 'On-sale Products', 'revija' ) => 'onsale',
					esc_html__( 'Best Selling Products', 'revija' ) => 'bestselling',
					esc_html__( 'Top Rated Products', 'revija' ) => 'toprated'
				),
				'description' => '',
				'std' => 'desc'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'revija' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__('Default', 'revija' ) => '',
					esc_html__('Date', 'revija' ) => 'date',
					esc_html__('Price', 'revija' ) => 'price',
					esc_html__('Random', 'revija' ) => 'rand',
					esc_html__('Sales', 'revija' ) => 'sales',
					esc_html__('Sort alphabetically', 'revija' ) => 'title',
					esc_html__('Sort by popularity', 'revija' ) => 'popularity'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'revija' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Sorting Order', 'revija' ),
				'param_name' => 'order',
				'value' => array(
					esc_html__( 'ASC', 'revija' ) => 'asc',
					esc_html__( 'DESC', 'revija' ) => 'desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'revija' ),
				'std' => 'desc'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination', 'revija' ),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__( 'No', 'revija' ) => 'no',
					esc_html__( 'Yes', 'revija' ) => 'yes'
				),
				'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
			),
			$mad_add_css_animation
		)
	) );

	/* VC woocommerce order tracking */
	vc_map( array(
			"name" => esc_html__("Order Tracking", "revija"),
			"base" => "woocommerce_order_tracking",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => esc_html__('WooCommerce', 'revija'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce cart */
	vc_map( array(
			"name" => esc_html__("Cart", "revija"),
			"base" => "woocommerce_cart",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => esc_html__('WooCommerce', 'revija'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce checkout */
	vc_map( array(
			"name" => esc_html__("Checkout", "revija"),
			"base" => "woocommerce_checkout",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => esc_html__('WooCommerce', 'revija'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce my account */
	vc_map( array(
			"name" => esc_html__("My Account", "revija"),
			"base" => "woocommerce_my_account",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => esc_html__('WooCommerce', 'revija'),
			"show_settings_on_create" => false
		)
	);

	if (defined('YITH_WCWL')) {

		/* VC woocommerce my wishlist */
		vc_map( array(
				"name" => esc_html__("Wishlist", "revija"),
				"base" => "vc_mad_yith_wcwl_wishlist",
				"icon" => 'icon-wpb-mad-woocommerce',
				"category" => esc_html__('WooCommerce', 'revija'),
				"params" => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'revija' ),
						'param_name' => 'pagination',
						'value' => array(
							esc_html__( 'No', 'revija' ) => 'no',
							esc_html__( 'Yes', 'revija' ) => 'yes'
						),
						'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Count Items', 'revija' ),
						'param_name' => 'per_page',
						'value' => REVIJA_VC_CONFIG::array_number(1, 51, 1, array('All' => '-1')),
						'std' => -1,
						'dependency' => array(
							'element' => 'pagination',
							'value' => array('yes')
						),
						'description' => esc_html__( 'A number of products on one page', 'revija' ),
					)
				)
			)
		);

	}

}


/* Portfolio
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Portfolio', 'revija' ),
	'base' => 'vc_mad_portfolio',
	'class' => '',
	'icon' => 'icon-wpb-vc_carousel',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Displayed for portfolio items', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'title', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Title', 'revija' ),
			'param_name' => 'type_title',
			'value' => array(
				esc_html__( 'Big', 'revija' ) => 'big',
				esc_html__( 'Medium', 'revija' ) => 'medium',
				esc_html__( 'Small', 'revija' ) => 'small'
			),
			'description' => esc_html__( 'Type Title', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading post', 'revija' ),
			'param_name' => 'size_head',
			'value' => array(
				esc_html__( 'Big', 'revija' ) => 'big',
				esc_html__( 'Small', 'revija' ) => 'small'
			),
			'description' => esc_html__( 'Heading post size', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Layout', 'revija' ),
			'param_name' => 'layout',
			'value' => array(
				esc_html__( 'Grid', 'revija' ) => 'grid',
				esc_html__( 'Gallery', 'revija' ) => 'gallery',
				esc_html__( 'Carousel', 'revija' ) => 'carousel'
			),
			'description' => esc_html__( 'Layout be displayed?', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'revija' ),
			'param_name' => 'image_size',
			'description' => esc_html__( 'Enter image size in pixels: 750*374 (Width * Height).', 'revija' )
		),
		array(
			"type" => "term_categories",
			"term" => "portfolio_categories",
			'heading' => esc_html__( 'Which categories should be used for the portfolio?', 'revija' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show portfolio from only those categories.', 'revija')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'revija' ),
			'param_name' => 'orderby',
			'value' => REVIJA_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved items by parameter', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'revija' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'revija' ) => 'DESC',
				esc_html__( 'ASC', 'revija' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'revija' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '1 Columns', 'revija' ) => 1,
				esc_html__( '2 Columns', 'revija' ) => 2,
				esc_html__( '3 Columns', 'revija' ) => 3,
				esc_html__( '4 Columns', 'revija' ) => 4
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array('grid', 'gallery')
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'revija' ),
			'param_holder_class' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'revija' ),
			'param_name' => 'items',
			'value' => REVIJA_VC_CONFIG::array_number(1, 30, 1, array('All' => '-1')),
			'std' => '-1',
			'description' => esc_html__( 'How many items should be displayed per page?', 'revija' ),
			'param_holder_class' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'revija' ),
			'param_name' => 'pagination',
			'value' => array(
				esc_html__( 'No', 'revija' ) => 'no',
				esc_html__( 'Yes', 'revija' ) => 'yes'
			),
			'description' => esc_html__( 'Should a pagination be displayed?', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Related Items', 'revija' ),
			'param_name' => 'related',
			'description' => esc_html__( 'display only related posts (To display the detailed portfolio page)', 'revija' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array('Carousel')
			),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		$mad_add_css_animation
	)
) );



/* Advertising Image
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Advertising Image', 'revija' ),
	'base' => 'vc_mad_advertising',
	'icon' => 'icon-wpb-images-stack',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Image Advertising', 'revija' ),
	'params' => array(
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'revija' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'revija' ),
			'param_name' => 'img_size',
			'description' => esc_html__( 'Enter image size in pixels: 200*100 (Width * Height). Leave empty to use full size. Divide image size with (^). Example: 730*460^730*800^730*360', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'js_composer' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'revija' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select where to open  custom links.', 'revija' ),
			'value' => $mad_target_arr
		),
		array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Top', 'js_composer' ),
		'param_name' => 'gap',
		'value' => array(
			esc_html__( '0px', 'js_composer' ) => '0',
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
			esc_html__( '40px', 'js_composer' ) => '40',
			esc_html__( '50px', 'js_composer' ) => '50',
		),
		'std' => '0',
		'description' => esc_html__( 'Select top.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	)
));


/* Image Flexslider
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Image Flexslider', 'revija' ),
	'base' => 'vc_mad_images_flexslider',
	'icon' => 'icon-wpb-images-carousel',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Animated carousel with images', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'revija' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library. Your image should be at least 440x345', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click', 'revija' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open lightBox', 'revija' ) => 'link_image',
				esc_html__( 'Do nothing', 'revija' ) => 'link_no',
				esc_html__( 'Open custom link', 'revija' ) => 'custom_link'
			),
			'description' => esc_html__( 'What to do when slide is clicked?', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'revija' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom Title', 'revija' ),
			'param_name' => 'images_title',
			'description' => esc_html__( 'Enter title for each slide here. Divide title with linebreaks (Enter) . ', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'revija' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select where to open  custom links.', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $mad_target_arr
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Slide speed', 'revija' ),
			'param_name' => 'speed',
			'value' => 1000,
			'description' => esc_html__( 'Duration of animation between slides (in ms)', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'revija' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Autoplay timeout', 'revija' ),
			'param_name' => 'autoplaytimeout',
			'description' => esc_html__( 'Autoplay interval timeout', 'revija' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			),
		),
		$mad_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	)
) );


/* Image Carousel
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Image Carousel', 'revija' ),
	'base' => 'vc_mad_images_carousel',
	'icon' => 'icon-wpb-images-carousel',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Animated carousel with images', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'revija' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library. Your image should be at least 440x345', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click', 'revija' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open lightBox', 'revija' ) => 'link_image',
				esc_html__( 'Do nothing', 'revija' ) => 'link_no',
				esc_html__( 'Open custom link', 'revija' ) => 'custom_link'
			),
			'description' => esc_html__( 'What to do when slide is clicked?', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'revija' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'revija' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select where to open  custom links.', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $mad_target_arr
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Slide speed', 'revija' ),
			'param_name' => 'speed',
			'value' => 1000,
			'description' => esc_html__( 'Duration of animation between slides (in ms)', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'revija' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Autoplay timeout', 'revija' ),
			'param_name' => 'autoplaytimeout',
			'description' => esc_html__( 'Autoplay interval timeout', 'revija' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			),
		),
		$mad_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'revija' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'revija' )
		)
	)
) );

/* Gallery/Slideshow
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Image Gallery', 'revija' ),
	'base' => 'vc_mad_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Responsive image gallery', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Gallery type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Image grid', 'revija' ) => 'image_grid',
				esc_html__( 'Masonry', 'revija' ) => 'masonry_grid'
			),
			'description' => esc_html__( 'Select gallery type.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'revija' ),
			'param_name' => 'img_size',
			'dependency' => array(
				'element' => 'type',
				'value' => array('masonry_grid')
			),
			'description' => esc_html__( 'Enter image size in pixels: 200*100 (Width * Height). Leave empty to use full size. Divide image size with (^).', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Gallery Columns', 'revija' ),
			'param_name' => 'columns',
			'value' => array(
				2 => 2,
				3 => 3,
				4 => 4,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => array('image_grid')
			),
			'description' => esc_html__( 'Choose the column count of your Gallery', 'revija' )
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'revija' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'revija' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Display show image title?', 'revija' ),
			'param_name' => 'image_title',
			'description' => '',
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click', 'revija' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open Lightbox', 'revija' ) => 'link_image',
				esc_html__( 'Do nothing', 'revija' ) => 'link_no',
				esc_html__( 'Open custom link', 'revija' ) => 'custom_link'
			),
			'description' => esc_html__( 'Define action for onclick event if needed.', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'revija' ),
			'param_name' => 'custom_links',
			'description' => esc_html__('Enter links for each slide here. Divide links with linebreaks (|) .', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'revija' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select where to open  custom links.', 'revija' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $mad_target_arr
		),
	)
));


/* Google maps element
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Google Maps', 'revija' ),
	'base' => 'vc_mad_gmaps',
	'icon' => 'icon-wpb-map-pin',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Map block', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Map embed iframe', 'revija' ),
			'param_name' => 'link',
			'description' => sprintf( esc_html__( 'Visit %s to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'revija' ), '<a href="https://mapsengine.google.com/" target="_blank">Google maps</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map align', 'revija' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'None', 'revija' ) => '',
				esc_html__( 'Left', 'revija' ) => 'alignleft',
				esc_html__( 'Right', 'revija' ) => 'alignright'
			),
			'description' => esc_html__( 'Choose the alignment of your map here', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map width', 'revija' ),
			'param_name' => 'width',
			'admin_label' => true,
			'description' => esc_html__( 'Enter map width in pixels. Example: 200 or leave it empty to make map responsive.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map height', 'revija' ),
			'param_name' => 'height',
			'admin_label' => true,
			'description' => esc_html__( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'revija' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map type', 'revija' ),
			'param_name' => 'type',
			'value' => array( esc_html__( 'Map', 'revija' ) => 'm', esc_html__( 'Satellite', 'revija' ) => 'k', esc_html__( 'Map + Terrain', 'revija' ) => "p" ),
			'description' => esc_html__( 'Select map type.', 'revija' )
  		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map Zoom', 'revija' ),
			'param_name' => 'zoom',
			'value' => array( esc_html__( '14 - Default', 'revija' ) => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Remove info bubble', 'revija' ),
			'param_name' => 'bubble',
			'description' => esc_html__( 'If selected, information bubble will be hidden.', 'revija' ),
			'value' => array( esc_html__( 'Yes, please', 'revija' ) => true),
		)
	)
) );



/* Dropcap
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Dropcap', 'revija' ),
	'base' => 'vc_mad_dropcap',
	'icon' => 'icon-wpb-mad-dropcap',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Dropcap', 'revija' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'revija' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__('Type 1', 'revija') => 'first_letter_1',
				esc_html__('Type 2', 'revija') => 'first_letter_2'
			),
			'description' => esc_html__('Choose the first letter style.', 'revija')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Letter', 'revija' ),
			'param_name' => 'letter',
			'admin_label' => true,
			'description' => ''
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'revija' ),
			'param_name' => 'content',
			'value' => esc_html__( '<p>Click edit button to change this text.</p>', 'revija' )
		),
	)
));

/* Graph
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Progress Bar', 'revija' ),
	'base' => 'vc_mad_progress_bar',
	'icon' => 'icon-wpb-mad-progress-bar',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Animated progress bar', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'revija' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Graphic values', 'revija' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Input graph values, titles and color here. Divide values with linebreaks (Enter). Example: 90|Development|#e75956', 'revija' ),
			'value' => ''
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Units', 'revija' ),
			'param_name' => 'units',
			'description' => esc_html__( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'revija' )
		)
	)
) );



/* Social Buttons
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Social Buttons', 'revija' ),
	'base' => 'vc_mad_social_buttons',
	'icon' => '',
	'category' => esc_html__( 'Content', 'revija' ),
	'description' => esc_html__( 'Social Buttons', 'revija' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'revija' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'revija' )
		),		
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Mailchimp Text', 'revija' ),
			'param_name' => 'contact_us',
			'description' => esc_html__( 'Enter text.', 'revija' )
		),	
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Rss URL', 'revija' ),
			'param_name' => 'rss_links',
			'description' => esc_html__( 'Enter Rss URL.', 'revija' )
		),	
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Facebook URL', 'revija' ),
			'param_name' => 'facebook_links',
			'description' => esc_html__( 'Enter Facebook URL.', 'revija' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Google Plus URL', 'revija' ),
			'param_name' => 'gplus_links',
			'description' => esc_html__( 'Enter Google Plus URL.', 'revija' )
		),	
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Youtube channel', 'revija' ),
			'param_name' => 'youtube_links',
			'description' => esc_html__( 'Enter Youtube channel.', 'revija' )
		),	
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Twitter URL', 'revija' ),
			'param_name' => 'twitter_links',
			'description' => esc_html__( 'Enter Twitter URL.', 'revija' )
		),	
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Pinterest URL', 'revija' ),
			'param_name' => 'pinterest_links',
			'description' => esc_html__( 'Enter Pinterest URL.', 'revija' )
		),	

		$mad_add_css_animation
	)
) );









/*** Visual Composer Content elements refresh ***/
class MadVcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	/**
	 * @var array
	 */
	private static $colors = array(
		'Blue' => 'blue',
		'Turquoise' => 'turquoise',
		'Pink' => 'pink',
		'Violet' => 'violet',
		'Peacoc' => 'peacoc',
		'Chino' => 'chino',
		'Mulled Wine' => 'mulled_wine',
		'Vista Blue' => 'vista_blue',
		'Black' => 'black',
		'Grey' => 'grey',
		'Orange' => 'orange',
		'Sky' => 'sky',
		'Green' => 'green',
		'Juicy pink' => 'juicy_pink',
		'Sandy brown' => 'sandy_brown',
		'Purple' => 'purple',
		'White' => 'white'
	);

	/**
	 * @var array
	 */
	public static $icons = array(
		'Glass' => 'glass',
		'Music' => 'music',
		'Search' => 'search'
	);

	/**
	 * @var array
	 */
	public static $sizes = array(
		'Mini' => 'xs',
		'Small' => 'sm',
		'Normal' => 'md',
		'Large' => 'lg'
	);

	/**
	 * @var array
	 */
	public static $button_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'3D' => '3d',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $message_box_styles = array(
		'Standard' => 'standard',
		'Solid' => 'solid',
		'Solid icon' => 'solid-icon',
		'Outline' => 'outline',
		'3D' => '3d',
	);

	/**
	 * Toggle styles
	 * @var array
	 */
	public static $toggle_styles = array(
		'Default' => 'default',
		'Simple' => 'simple',
		'Round' => 'round',
		'Round Outline' => 'round_outline',
		'Rounded' => 'rounded',
		'Rounded Outline' => 'rounded_outline',
		'Square' => 'square',
		'Square Outline' => 'square_outline',
		'Arrow' => 'arrow',
		'Text Only' => 'text_only'
	);

	/**
	 * @var array
	 */
	public static $cta_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $txt_align = array(
		'Left' => 'left',
		'Right' => 'right',
		'Center' => 'center',
		'Justify' => 'justify'
	);

	/**
	 * @var array
	 */
	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50',
		'40%' => '40',
		'30%' => '30'
	);

	/**
	 * @var array
	 */
	public static $sep_widths = array(
		'1px' => '',
		'2px' => '2',
		'3px' => '3',
		'4px' => '4',
		'5px' => '5',
		'6px' => '6',
		'7px' => '7',
		'8px' => '8',
		'9px' => '9',
		'10px' => '10'
	);

	/**
	 * @var array
	 */
	public static $sep_styles = array(
		'Border' => '',
		'Dashed' => 'dashed',
		'Dotted' => 'dotted',
		'Double' => 'double'
	);

	/**
	 * @var array
	 */
	public static $box_styles = array(
		'Default' => '',
		'Rounded' => 'vc_box_rounded',
		'Border' => 'vc_box_border',
		'Outline' => 'vc_box_outline',
		'Shadow' => 'vc_box_shadow',
		'Bordered shadow' => 'vc_box_shadow_border',
		'3D Shadow' => 'vc_box_shadow_3d',
		'Circle' => 'vc_box_circle', //new
		'Circle Border' => 'vc_box_border_circle', //new
		'Circle Outline' => 'vc_box_outline_circle', //new
		'Circle Shadow' => 'vc_box_shadow_circle', //new
		'Circle Border Shadow' => 'vc_box_shadow_border_circle' //new
	);

	/**
	 * @return array
	 */
	public static function getColors() {
		return self::$colors;
	}

	/**
	 * @return array
	 */
	public static function getIcons() {
		return self::$icons;
	}

	/**
	 * @return array
	 */
	public static function getSizes() {
		return self::$sizes;
	}

	/**
	 * @return array
	 */
	public static function getButtonStyles() {
		return self::$button_styles;
	}

	/**
	 * @return array
	 */
	public static function getMessageBoxStyles() {
		return self::$message_box_styles;
	}

	/**
	 * @return array
	 */
	public static function getToggleStyles() {
		return self::$toggle_styles;
	}

	/**
	 * @return array
	 */
	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	/**
	 * @return array
	 */
	public static function getTextAlign() {
		return self::$txt_align;
	}

	/**
	 * @return array
	 */
	public static function getBorderWidths() {
		return self::$sep_widths;
	}

	/**
	 * @return array
	 */
	public static function getElementWidths() {
		return self::$el_widths;
	}

	/**
	 * @return array
	 */
	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	/**
	 * @return array
	 */
	public static function getBoxStyles() {
		return self::$box_styles;
	}
}

//VcSharedLibrary::getColors();
/**
 * @param string $asset
 *
 * @return array
 */
function madGetVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return MadVcSharedLibrary::getColors();
			break;

		case 'icons':
			return MadVcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return MadVcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return MadVcSharedLibrary::getButtonStyles();
			break;
		case 'message_box_styles':
			return MadVcSharedLibrary::getMessageBoxStyles();
			break;
		case 'cta styles':
			return MadVcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return MadVcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return MadVcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return MadVcSharedLibrary::getSeparatorStyles();
			break;

		case 'separator border widths':
			return MadVcSharedLibrary::getBorderWidths();
			break;

		case 'single image styles':
			return MadVcSharedLibrary::getBoxStyles();
			break;

		case 'toggle styles':
			return MadVcSharedLibrary::getToggleStyles();
			break;

		default:
			# code...
			break;
	}

	return '';
}


















