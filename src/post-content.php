<?php
if(is_page()):
the_content();
else: ?>
<div class="blog_post">
		<div class="blog_postcontent">
        <?php if(has_post_thumbnail()) :?>
		<div class="image_frame">
		<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail('small_thumbs'); ?>
		</a>
		</div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
		<ul class="post_meta_links">
		<li><?php echo get_the_date(); ?></li>				
                <li class="post_by"><i><?php _e('by:','weblizar'); ?>&nbsp;</i> <?php the_author(); ?></li>
				<?php if(get_the_tag_list() != '' ) { ?>
                <li class="post_categoty"><i><?php _e('in:','weblizar'); ?>&nbsp;</i> <?php the_tags('', ' ', ''); ?></li>
				<?php } ?>
                <li class="post_comments"><i><?php _e('note:','weblizar'); ?>&nbsp;</i><?php comments_number( "<strong>0</strong> ".__('Comments','weblizar'), "<strong>1</strong> ".__('Comment' ,'weblizar'),"<strong>%</strong>".__('Comments','weblizar')); ?></li>
        </ul>
        <div class="clearfix"></div>
        <div class="margin_top1"></div>
		<?php endif; ?>            
		<?php the_content(__('Read more...','weblizar')); 
		$defaults = array(
              'before'           => '<div class="pagination">' . __( 'Pages:','weblizar' ),
              'after'            => '</div>',
	          'link_before'      => '',
	          'link_after'       => '',
	          'next_or_number'   => 'number',
	          'separator'        => ' ',
	          'nextpagelink'     => __( 'Next page'  ,'weblizar'),
	          'previouspagelink' => __( 'Previous page' ,'weblizar'),
	          'pagelink'         => '%',
	          'echo'             => 1
	          );
	          wp_link_pages( $defaults );
			  ?>
		</div>
</div>
<?php endif;?>