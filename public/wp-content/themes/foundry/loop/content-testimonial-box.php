<div class="feature boxed">
    <?php the_content(); ?>
    <div class="spread-children">
    	<?php 
    		the_post_thumbnail('full', array('class' => 'image-xs')); 
    		if( get_post_meta($post->ID, '_ebor_the_job_title', 1) ) {
        		the_title('<span>', ' - '. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>');
        	} else {
        		the_title('<span>', '</span>');
        	}    		
    	?>
    </div>
</div>