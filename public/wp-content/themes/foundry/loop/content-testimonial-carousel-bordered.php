<li>
    <div class="col-md-8 col-md-offset-2">
        <div class="feature bordered text-center">
            <h3><?php echo strip_tags(get_the_content()); ?></h3>
            <?php 
            	if( get_post_meta($post->ID, '_ebor_the_job_title', 1) ) {
            		the_title('<h6 class="uppercase">', ' - '. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</h6>');
            	} else {
            		the_title('<h6 class="uppercase">', '</h6>');
            	}
            ?>
        </div>
    </div>
</li>