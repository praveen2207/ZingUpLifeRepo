<?php
$output = $title = $number = $el_class = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Recent Comments', 'revija' ),
	'number' => 5,
	'type_display' => '',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );


$output = '<div class="vc_wp_recentcomments vc_wp_recentcomments_' . $type_display . ' wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_Recent_Comments';
$args = array();

$mad_widget_args = array(
	'before_widget' => '<div id="vc_wp_recentcomments_widget" class="section widget" >',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-head"><h3 class="section_title">',
	'after_title' => '</h3></div>'
);

 $output .= $mad_widget_args['before_widget'];
        if ( $title ) {
            $output .= $mad_widget_args['before_title'] . $title . $mad_widget_args['after_title'];
        }

ob_start();

 $comments = get_comments( apply_filters( 'widget_comments_args', array(
            'number'      => $number,
            'status'      => 'approve',
            'post_status' => 'publish'
        ) ) );
		
$output .= '<ul id="recentcomments_widget" class="comments_list" >';
        if ( $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );
 
            foreach ( (array) $comments as $comment) {
				
                $output .= '<li class="recentcomments post_text">';
                /* translators: comments widget: 1: comment author, 2: post link */
                $output .= sprintf( _x( '%1$s <span>on</span> %2$s', 'widgets', 'revija' ),
                    '' . get_comment_author_link($comment->comment_ID) . '',
                    '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'
                );
                $output .= '<div class="event_date">'. get_comment_date(get_option('date_format'), $comment->comment_ID) .'</div></li>';
				
            }
        }
$output .= '</ul>';		
//the_widget( $type, $atts, $mad_widget_args );


$output .= ob_get_clean();
$output .= $mad_widget_args['after_widget'];
$output .= '</div>' . $this->endBlockComment( 'vc_wp_recentcomments' ) . "\n";

echo $output;