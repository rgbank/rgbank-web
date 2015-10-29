<?php
$wl_theme_options = weblizar_get_options();
// General Settings
function weblizar_reset_general_setting()
{	
	$wl_theme_options = get_option('guardian_options');
	
	$wl_theme_options['upload_image_logo']="";
	$wl_theme_options['height']=55;
	$wl_theme_options['width']=150;
	$wl_theme_options['upload_image_favicon']="";
	$wl_theme_options['text_title']="on";			
	$wl_theme_options['custom_css']="";
	$wl_theme_options['blog_title']=__("Our Latest Blog",'weblizar');	
	
	update_option('guardian_options',$wl_theme_options);
}
function weblizar_reset_slider_setting(){

	$ImageUrl = get_template_directory() ."/images/slide-1.jpg";
	$ImageUrl2 = get_template_directory() ."/images/slide-2.jpg";
	$ImageUrl3 = get_template_directory() ."/images/slide-3.jpg";

	$wl_theme_options = get_option('guardian_options');
	
	$wl_theme_options['slide_image']= $ImageUrl;
	$wl_theme_options['slide_title']= __('Responsive Theme','weblizar');
	$wl_theme_options['slide_desc']= __('Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar');
	$wl_theme_options['slide_btn_text']=__('Read More','weblizar');
	$wl_theme_options['slide_btn_link']= '#';
		
	$wl_theme_options['slide_image_1']=$ImageUrl2;
	$wl_theme_options['slide_title_1']= __('Custom Layout','weblizar');
	$wl_theme_options['slide_desc_1']= __('Lorem ipsum dolr sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar');
	$wl_theme_options['slide_btn_text_1']= __('Read More','weblizar');
	$wl_theme_options['slide_btn_link_1']='#';
		
	$wl_theme_options['slide_image_2']= $ImageUrl3;
	$wl_theme_options['slide_title_2']= __('Touch Slider','weblizar');
	$wl_theme_options['slide_desc_2']= __('Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar');
	$wl_theme_options['slide_btn_text_2']= __('Read More','weblizar');
	$wl_theme_options['slide_btn_link_2']= '#';
	
	update_option('guardian_options', $wl_theme_options);
	}

// service
function weblizar_reset_service_setting()
{
	$wl_theme_options = get_option('guardian_options');
	
	$wl_theme_options['home_service_title'] = __('Our Services','weblizar');
	$wl_theme_options['home_service_description'] = __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','weblizar');
	
	$wl_theme_options['service_1_title'] = __("Idea",'weblizar');
	$wl_theme_options['service_1_icons'] = "fa fa-google";
	$wl_theme_options['service_1_text'] = __("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar');
	$wl_theme_options['service_1_link'] = "#";
	
	$wl_theme_options['service_2_title'] = __("Records",'weblizar');
	$wl_theme_options['service_2_icons'] = "fa fa-database";
	$wl_theme_options['service_2_text'] = __("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar');
	$wl_theme_options['service_2_link'] = "#";
	
	$wl_theme_options['service_3_title'] = __("WordPress",'weblizar');
	$wl_theme_options['service_3_icons'] = "fa fa-wordpress";
	$wl_theme_options['service_3_text'] = __("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar');
	$wl_theme_options['service_3_link'] = "#";
	
	$wl_theme_options['service_4_title'] = __("Responsive",'weblizar');
	$wl_theme_options['service_4_icons'] = "fa fa-laptop";
	$wl_theme_options['service_4_text'] = __("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar');
	$wl_theme_options['service_4_link'] = "#";

	update_option('guardian_options', $wl_theme_options);
}



/*
* social Settings
*/
function weblizar_reset_social_setting()
{	
	$wl_theme_options = get_option('guardian_options');
	
	$wl_theme_options['contact_email']=__("example@mail.com",'weblizar');
	$wl_theme_options['contact_phone_no']=__("1 4488 8000 4500",'weblizar');
	
	$wl_theme_options['footer_section_social_media_enbled']="on";
	$wl_theme_options['header_section_social_media_enbled']="on";	
	
	$wl_theme_options['twitter_link']="https://twitter.com/";
	$wl_theme_options['facebook_link']="https://facebook.com/";
	$wl_theme_options['linkedin_link']="https://linkedin.com/";
	$wl_theme_options['google_plus']="https://plus.google.com/";
	$wl_theme_options['youtube_link']="https://youtube.com/";
	$wl_theme_options['rss_link']="https://www.rss.com/";
	$wl_theme_options['flicker_link']="https://www.flickr.com/";
	
	update_option('guardian_options', $wl_theme_options);
}

/*
* footer customizations Settings
*/
function weblizar_reset_footer_customizations_setting()
{	$wl_theme_options = get_option('guardian_options');
	$wl_theme_options['footer_customizations']=__("Copyright @ 2015 Guardian.",'weblizar');
	$wl_theme_options['developed_by_text']=__(" Developed By",'weblizar');
	$wl_theme_options['developed_by_weblizar_text']=__("Weblizar",'weblizar');
	$wl_theme_options['developed_by_link']="http://weblizar.com/";
	
	$wl_theme_options['terms_of_use_text']=__('Terms of Use','weblizar');
	$wl_theme_options['terms_of_use_link']='#';			

	$wl_theme_options['Privacy_policy_text']=__('Privacy Policy','weblizar');
	$wl_theme_options['Privacy_policy_link']='#';
	
	update_option('guardian_options', $wl_theme_options);
}
?>