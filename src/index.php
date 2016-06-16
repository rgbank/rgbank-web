<?php
get_header(); 
get_template_part('weblizar','breadcrumbs'); ?>
<div class="container">
	<div class="content_left">
	<?php if ( have_posts()): 
	while ( have_posts() ): the_post(); 
		get_template_part('loop');
	endwhile;
	endif;?>
	<?php weblizar_navigation() ; ?><!-- /# end pagination -->
	</div><!-- end content left side -->
<?php get_sidebar(); ?>
</div><!-- end content area -->
<?php get_footer(); ?>