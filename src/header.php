<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php $wl_theme_options = weblizar_get_options(); ?>
	<?php if($wl_theme_options['upload_image_favicon']!=''){ ?>
	<link rel="shortcut icon" href="<?php  echo esc_url($wl_theme_options['upload_image_favicon']); ?>" /> 
	<?php } ?>	
	<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
<div>
<header id="header">
	<!-- Top header bar -->
	<div id="topHeader">
		<div class="wrapper">
			<div class="top_nav">
				<div class="container">					
					<div class="right"><?php $guardian_image=get_header_image();
					if(! empty($guardian_image)){ ?><img src="<?php echo get_header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="image" /><?php } ?>	
						<ul> <?php if($wl_theme_options['contact_email']!=''){ ?>           	
							<li><a href="mailto:<?php echo esc_url($wl_theme_options['contact_email']); ?>"><i class="fa fa-envelope"></i> <?php echo esc_attr($wl_theme_options['contact_email']); ?></a></li> <?php } ?>
							<?php if($wl_theme_options['contact_phone_no']!=''){ ?> 
							<li><i class="fa fa-phone"></i> + <?php echo esc_attr($wl_theme_options['contact_phone_no']); ?></li>
							<?php } ?>
							<?php if($wl_theme_options['header_section_social_media_enbled'] =='on'){ 
								if($wl_theme_options['facebook_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['facebook_link']); ?>"><i class="fa fa-facebook"></i></a></li>
								<?php }  if($wl_theme_options['twitter_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['twitter_link']); ?>"><i class="fa fa-twitter"></i></a></li>
								<?php }  if($wl_theme_options['google_plus']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['google_plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
								<?php }  if($wl_theme_options['linkedin_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['linkedin_link']); ?>"><i class="fa fa-linkedin"></i></a></li>
								<?php }  if($wl_theme_options['flicker_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['flicker_link']); ?>"><i class="fa fa-flickr"></i></a></li>
								<?php }  if($wl_theme_options['youtube_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['youtube_link']); ?>"><i class="fa fa-youtube"></i></a></li>
								<?php }  if($wl_theme_options['rss_link']!=''){  ?>
								<li><a href="<?php echo esc_url($wl_theme_options['rss_link']); ?>"><i class="fa fa-rss"></i></a></li>
								<?php } 
							}	?>
							</ul>					
					</div><!-- end right social links -->			
				</div>
			</div>            
		</div>    
	</div><!-- end top navigation -->
	<div id="trueHeader">    
		<div class="wrapper">    
			<div class="container">    
				<!-- Logo -->
				<div class="logo">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="logo" >
						<?php if($wl_theme_options['upload_image_logo']!='') 
						{ ?>
						<img src="<?php echo esc_url($wl_theme_options['upload_image_logo']); ?>" style="height:<?php if($wl_theme_options['height']!='') { echo $wl_theme_options['height']; }  else { "50"; } ?>px; width:<?php if($wl_theme_options['width']!='') { echo $wl_theme_options['width']; }  else { "180"; } ?>px;" />
						<?php } else { echo get_bloginfo('name'); } ?>						
					</a>
				</div>
				<!-- Menu -->
				<div class="menu_main">				
					<div class="navbar yamm navbar">
					<div class="container">
							<div class="navbar-header">
								<div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1"  ><span><?php __('Menu',gr_td); ?></span>
									<button type="button" ><i class="fa fa-bars"></i></button>
								</div>
							</div>
							<!-- /Navigation  menus -->
						<div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">  
						<?php
								wp_nav_menu( array(  
										'theme_location' => 'primary',
										'container'  => '',
										'menu_class' => 'nav navbar-nav',
										'fallback_cb' => 'weblizar_fallback_page_menu',
										'walker' => new weblizar_nav_walker()
										)
									);	
								?>	
						</div>		
					 </div>
					 </div>			 
				</div><!-- end menu -->				
			</div>			
		</div>    
	</div>    
</header>
<div class="clearfix"></div>
