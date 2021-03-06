<?php 

/**
 * The Shortcode
 */
function ebor_testimonial_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'carousel'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_testimonial_shortcode) ){
		return false;	
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type'      => 'testimonial',
		'post_status'    => 'publish',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field'    => 'slug',
				'terms'    => $filter
			)
		);
	}
	
	$old_query = $wp_query;
	$old_post  = $post;
	$wp_query  = new WP_Query( $query_args );
	$wp_query->{"doing_testimonial_shortcode"} = 'true';
	
	ob_start();

	get_template_part('loop/loop-testimonial', $layout);
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post     = $old_post;
	
	return $output;
}
add_shortcode( 'gaze_testimonial', 'ebor_testimonial_shortcode' );

/**
 * The VC Functions
 */
function ebor_testimonial_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Testimonial Feeds", 'gaze' ),
			"base"        => "gaze_testimonial",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'Show testimonial posts with layout options.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Show How Many Posts?", 'gaze' ),
					"param_name" => "pppage",
					"value"      => '4'
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__( "Testimonial Display Type", 'gaze' ),
					"param_name" => "layout",
					"value"      => ebor_get_testimonial_layouts()
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonial_shortcode_vc');
