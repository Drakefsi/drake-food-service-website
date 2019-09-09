<div class="col-sm-4 text-center">
    <div class="feature boxed cast-shadow-light">
    	<?php
    		the_post_thumbnail('full', array('class' => 'image-small inline-block mb24')); 
    		the_content();
    		if( get_post_meta($post->ID, '_ebor_the_job_title', 1) ) {
        		the_title('<span><strong>', '</strong> - '. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
        	} else {
        		the_title('<span><strong>', '</strong></span>');
        	}    		
    	?>
    </div>
</div>