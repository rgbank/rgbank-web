<div class="clearfix"></div>
<div class="footer1">
	<div class="container">			
		<div class="clearfix divider_dashed1"></div>
		<?php
		if ( is_active_sidebar( 'footer-widget-area' ) )
		{ 
			dynamic_sidebar( 'footer-widget-area' );
		} else 
		{  ?>
		<div class="one_third animate" data-anim-type="fadeInUp">
			<div class="siteinfo">			
				<h4 class="lmb"><?php _e('About Guardian',gr_td); ?></h4>				
				<p><?php _e('All the Lorem Ipsum generators on the Internet tend to repeat predefined an chunks as necessary, making this the first true generator on the Internet.
					All the Lorem Ipsum generators on the Internet tend to repeat predefined Lorem Ipsum as their default model text, and a search for web sites.',gr_td); ?></p>
				<br />							
			</div>
		</div><!-- end site info -->	
		<div class="one_third animate" data-anim-type="fadeInUp">
			<div class="qlinks">		
				<h4 class="lmb"><?php _e('Custom Menu',gr_td); ?></h4>			
				<ul>
					<li><a href="#"><?php _e('Home',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Blog',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Service',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Portfolio',gr_td); ?></a></li>
					<li><a href="#"><?php _e('About-us',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Team',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Contact -Us',gr_td); ?></a></li>
				</ul>			
			</div>
		</div><!-- end links -->
		
		<div class="one_third last animate" data-anim-type="fadeInUp">
			<div class="qlinks">		
				<h4 class="lmb"><?php _e('Recent Posts',gr_td); ?></h4>			
				<ul>
					<li><a href="#"><?php _e('Awsome Slidershows',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Features and Typography',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Different &amp; Unique Pages',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Single and Portfolios',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Recent Blogs or News',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Post with Image',gr_td); ?></a></li>
					<li><a href="#"><?php _e('Layered PSD Files',gr_td); ?></a></li>
				</ul>			
			</div>
		</div><!-- end links 	-->	
		
		<?php } ?>		
	</div>
</div><!-- end footer -->

<div class="clearfix"></div>
<div class="copyright_info">
		<div class="container">
			<div class="clearfix divider_dashed10"></div>
			<?php $wl_theme_options = weblizar_get_options(); ?>
			<div class="one_third">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', gr_td ) ); ?>"><?php printf( __( 'Proudly powered by %s', gr_td ), 'WordPress' ); ?></a>
			</div>
			<div class="one_third animate" data-anim-type="fadeInRight">
			
			<?php 
				if($wl_theme_options['footer_customizations']!= '') { echo esc_attr($wl_theme_options['footer_customizations']); } 
				
				if($wl_theme_options['developed_by_text']!='') { echo  "  ". esc_attr($wl_theme_options['developed_by_text']); }
				
				if($wl_theme_options['developed_by_weblizar_text']!='') {	?> 
				|<a rel="nofollow" href="<?php if($wl_theme_options['developed_by_link']!='') { echo  esc_url($wl_theme_options['developed_by_link']); } ?>"><?php echo esc_attr($wl_theme_options['developed_by_weblizar_text']); ?></a>
			<?php } ?>					
			</div>	
			<?php if($wl_theme_options['footer_section_social_media_enbled'] == "on") { ?>
			<div class="one_third last">			
				<ul class="footer_social_links">
				<?php if($wl_theme_options['facebook_link']!= '') { ?>
				<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['facebook_link']); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php  }  if($wl_theme_options['twitter_link']!= '') { ?>
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['twitter_link']); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php  }  if($wl_theme_options['google_plus']!= '') { ?>
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['google_plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php  }  if($wl_theme_options['linkedin_link']!= '') { ?>
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['linkedin_link']); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php  }  if($wl_theme_options['flicker_link']!= '') { ?>					
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['flicker_link']); ?>"><i class="fa fa-flickr"></i></a></li>
				<?php  }  if($wl_theme_options['youtube_link']!= '') { ?>				
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['youtube_link']); ?>"><i class="fa fa-youtube"></i></a></li>
				<?php  }  if($wl_theme_options['rss_link']!= '') { ?>
					<li class="animate" data-anim-type="zoomIn"><a href="<?php echo esc_url($wl_theme_options['rss_link']); ?>"><i class="fa fa-rss"></i></a></li>
				<?php  }  ?>
				</ul>				
									
			</div>	
			<?php } ?>
		</div>
	</div><!-- end copyright info -->
	<a href="#" class="scrollup"><?php _e('Scroll','weblizar');?></a><!-- end scroll to top of the page-->	
</div> <!-- end of header wrapper div -->
<?php wp_footer(); ?>	
	<?php if(isset($wl_theme_options['custom_css'])) { ?> 
	<style type="text/css"><?php echo esc_attr($wl_theme_options['custom_css']); ?></style>
	<?php } ?>
</body>
</html>