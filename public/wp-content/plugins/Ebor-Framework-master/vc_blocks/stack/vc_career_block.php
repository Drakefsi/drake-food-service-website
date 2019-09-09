<?php 

/**
 * The Shortcode
 */
function ebor_career_shortcode( $atts ) {
	global $wp_query, $post;
	
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '4',
				'filter' => 'all',
				'layout' => 'carousel-1',
				'custom_css_class' => '',
				'offset' => '0'
			), $atts 
		) 
	);
	
	if( 0 == $pppage || isset($wp_query->doing_career_shortcode) ){
		return false;	
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'career',
		'posts_per_page' => $pppage,
		'offset'         => $offset
	);
	
	//Hide current post ID from the loop if we're in a singular view
	if( is_single() && isset($post->ID) ){
		$query_args['post__not_in']	= array($post->ID);
	}
	
	if(!( $filter == 'all' )) {
		
		//Check for WPML
		if( has_filter('wpml_object_id') ){
			global $sitepress;
			
			//WPML recommended, remove filter, then add back after
			remove_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
			
			$filterClass    = get_term_by('slug', $filter, 'career_category');
			$ID             = (int) apply_filters('wpml_object_id', (int) $filterClass->term_id, 'career_category', true);
			$translatedSlug = get_term_by('id', $ID, 'career_category');
			$filter         = $translatedSlug->slug;
			
			//Adding filter back
			add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
		}
			
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'career_category',
				'field' => 'slug',
				'terms' => $filter
			)
		);	
		
	}
	
	$old_query = $wp_query;
	$old_post = $post;
	$wp_query = new WP_Query( $query_args );
	$wp_query->{"doing_career_shortcode"} = 'true';
	
	ob_start();
	
	echo '<div class="'. $custom_css_class .'">';
	get_template_part('loop/loop-career');
	echo '</div>';
	
	$output = ob_get_contents();
	ob_end_clean();
	
	wp_reset_postdata();
	$wp_query = $old_query;
	$post = $old_post;
	
	return $output;
}
add_shortcode( 'stack_career', 'ebor_career_shortcode' );

/**
 * The VC Functions
 */
function ebor_career_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Career Feeds", 'stackwordpresstheme'),
			"base" => "stack_career",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'description' => 'Show career posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'stackwordpresstheme'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Offset Posts?", 'stackwordpresstheme'),
					"param_name" => "offset",
					"value" => '0',
					"description" => '<code>DEVELOPERS ONLY</code> - Offset posts shown, 0 for newest posts, 5 starts at fifth most recent etc.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_career_shortcode_vc');
