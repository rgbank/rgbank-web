<?php
function weblizar_customizer( $wp_customize ) {
	wp_enqueue_style('customizr', WL_TEMPLATE_DIR_URI .'/css/customizr.css');
	$ImageUrl1 = get_template_directory_uri() ."/images/slide-1.jpg";
	$ImageUrl2 = get_template_directory_uri() ."/images/slide-2.jpg";
	$ImageUrl3 = get_template_directory_uri() ."/images/slide-3.jpg";
	/* Genral section */
		/* Slider Section */
	$wp_customize->add_panel( 'weblizar_theme_option', array(
    'title' => __( 'Guardian Options','weblizar' ),
    'priority' => 1, // Mixed with top-level-section hierarchy.
	) );
	$wp_customize->add_section(
        'general_sec',
        array(
            'title' => __('Theme General Options','weblizar'),
            'description' => __('Here you can customize Your theme\'s general Settings','weblizar'),
			'panel'=>'weblizar_theme_option',
			'capability'=>'edit_theme_options',
            'priority' => 35,
        )
    );
	$wl_theme_options = weblizar_get_options();
	//var_dump($wl_theme_options['upload_image_logo']); die;
	$wp_customize->add_setting(
		'guardian_options[_frontpage]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['_frontpage'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'weblizar_front_page', array(
		'label'        => __( 'Show Front Page', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[_frontpage]',
	) );
	/* $wp_customize->add_setting(
		'guardian_options[text_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['text_title'],
			'sanitize_callback'=>'weblizar_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( 'weblizar_front_page_text_title', array(
		'label'        => __( 'Show Text Title on Front Page', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[text_title]',
	) ); */
	$wp_customize->add_setting(
		'guardian_options[upload_image_logo]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['upload_image_logo'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
		'guardian_options[height]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['height'],
			'sanitize_callback'=>'weblizar_sanitize_integer',
			'capability'        => 'edit_theme_options'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[width]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['width'],
			'sanitize_callback'=>'weblizar_sanitize_integer',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting(
		'guardian_options[upload_image_favicon]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['upload_image_favicon'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_upload_image_logo', array(
		'label'        => __( 'Website Logo', 'weblizar' ),
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[upload_image_logo]',
	) ) );
	$wp_customize->add_control( 'weblizar_logo_height', array(
		'label'        => __( 'Logo Height', 'weblizar' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[height]',
	) );
	$wp_customize->add_control( 'weblizar_logo_width', array(
		'label'        => __( 'Logo Width', 'weblizar' ),
		'type'=>'number',
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[width]',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_upload_favicon_image', array(
		'label'        => __( 'Custom favicon', 'weblizar' ),
		'section'    => 'general_sec',
		'settings'   => 'guardian_options[upload_image_favicon]',
	) ) );

	/* Slider Section */
	$wp_customize->add_section(
        'slider_sec',
        array(
            'title' => __('Theme Slider Options','weblizar'),
			'panel'=>'weblizar_theme_option',
            'description' => __('Here you can add slider images','weblizar'),
			'capability'=>'edit_theme_options',
            'priority' => 35,
			'active_callback' => 'is_front_page',
        )
    );
	$wp_customize->add_setting(
		'guardian_options[slide_image]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl1,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_image_1]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl2,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_image_2]',
		array(
			'type'    => 'option',
			'default'=>$ImageUrl3,
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw',
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_title]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_title_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_title_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_title_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_desc]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_desc_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_desc_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_desc_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_text]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_text_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_text_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_text_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'weblizar_sanitize_text'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_link]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_link_1]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_1'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_setting(
		'guardian_options[slide_btn_link_2]',
		array(
			'type'    => 'option',
			'default'=>$wl_theme_options['slide_btn_link_2'],
			'capability' => 'edit_theme_options',
			'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_1', array(
		'label'        => __( 'Slider Image One', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_image]'
	) ) );
	$wp_customize->add_control( 'weblizar_slide_title_1', array(
		'label'        => __( 'Slider title one', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_title]'
	) );
	$wp_customize->add_control( 'weblizar_slide_desc_1', array(
		'label'        => __( 'Slider description one', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_desc]'
	) );
	$wp_customize->add_control( 'Slider button one', array(
		'label'        => __( 'Slider Button Text One', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_text]'
	) );
	
	$wp_customize->add_control( 'weblizar_slide_btnlink_1', array(
		'label'        => __( 'Slider Button Link', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_link]'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_2', array(
		'label'        => __( 'Slider Image Two ', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_image_1]'
	) ) );
	
	$wp_customize->add_control( 'weblizar_slide_title_2', array(
		'label'        => __( 'Slider Title Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_title_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_desc_2', array(
		'label'        => __( 'Slider Description Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_desc_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btn_2', array(
		'label'        => __( 'Slider Button Text Two', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_text_1]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btnlink_2', array(
		'label'        => __( 'Slider Link Two', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_link_1]'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'weblizar_slider_image_3', array(
		'label'        => __( 'Slider Image Three', 'weblizar' ),
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_image_2]'
	) ) );
	$wp_customize->add_control( 'weblizar_slide_title_3', array(
		'label'        => __( 'Slider Title Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_title_2]'
	) );
	
	$wp_customize->add_control( 'weblizar_slide_desc_3', array(
		'label'        => __( 'Slider Description Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_desc_2]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btn_3', array(
		'label'        => __( 'Slider Button Text Three', 'weblizar' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_text_2]'
	) );
	$wp_customize->add_control( 'weblizar_slide_btnlink_3', array(
		'label'        => __( 'Slider Button Link Three', 'weblizar' ),
		'type'=>'url',
		'section'    => 'slider_sec',
		'settings'   => 'guardian_options[slide_btn_link_2]'
	) );

	/* Blog Option */
	$wp_customize->add_section('blog_section',array(
	'title'=>__('Home Blog Options','weblizar'),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 37
	));
	$wp_customize->add_setting(
	'guardian_options[blog_title]',
		array(
		'default'=>esc_attr($wl_theme_options['blog_title']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capability'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_blog_title', array(
		'label'        => __( 'Home Blog Title', 'weblizar' ),
		'type'=>'text',
		'section'    => 'blog_section',
		'settings'   => 'guardian_options[blog_title]'
	) );

	/* Service Section */
	$wp_customize->add_section('service_section',array(
	'title'=>__("Service Options","weblizar"),
	'panel'=>'weblizar_theme_option',
	'capability'=>'edit_theme_options',
    'priority' => 35,
	'active_callback' => 'is_front_page',
	));
	$wp_customize->add_setting(
	'guardian_options[home_service_title]',
		array(
		'default'=>esc_attr($wl_theme_options['home_service_title']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->add_setting(
	'guardian_options[home_service_description]',
		array(
		'default'=>esc_attr($wl_theme_options['home_service_description']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
	$wp_customize->add_control( 'weblizar_service_title', array(
		'label'        => __( 'Service Title', 'weblizar' ),
		'type'	=>'text',
		'section'    => 'service_section',
		'settings'   => 'guardian_options[home_service_title]'
	) );
	$wp_customize->add_control( 'weblizar_service_description', array(
		'label'        => __( 'Service Description', 'weblizar' ),
		'type'	=>'textarea',
		'section'    => 'service_section',
		'settings'   => 'guardian_options[home_service_description]'
	) );
	for($i=1;$i<=4;$i++){
	$wp_customize->add_setting(
	'guardian_options[service_'.$i.'_icons]',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_icons']),
		'type'=>'option',
		'capability'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
			)
	);
	$wp_customize->add_setting(
	'guardian_options[service_'.$i.'_title]',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_title']),
		'type'=>'option',
		'capabilit'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
			)
	);
	$wp_customize->add_setting(
	'guardian_options[service_'.$i.'_text]',
		array(
		'default'=>esc_attr($wl_theme_options['service_'.$i.'_text']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capabilit'=>'edit_theme_options',
			)
	);
	$wp_customize->add_setting(
	'guardian_options[service_'.$i.'_link]',
		array(
		'type'    => 'option',
		'default'=>$wl_theme_options['service_'.$i.'_link'],
		'capability' => 'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	}
	for($i=1;$i<=4;$i++){
	$j = array('', ' One', ' Two', ' Three');
	$wp_customize->add_control( new weblizar_Customize_Misc_Control($wp_customize, 'guardian_options1-line', array(
            'section'  => 'service_section',
            'type'     => 'line'
        )
    ));
	$wp_customize->add_control( 'weblizar_service_icon'.$i, array(
		'label'        => __( 'service_'.$i.'_icons', 'weblizar' ),
		'description'=>__('<a href="http://fontawesome.bootstrapcheatsheets.com">FontAwesome Icons</a>','weblizar'),
		'section'  => 'service_section',
		'settings'   => 'guardian_options[service_'.$i.'_icons]'
    ) );
	$wp_customize->add_control( 'weblizar_service_title'.$i, array(
		'label'        => __( 'service_'.$i.'_title', 'weblizar' ),
		'type'=>'text',
		'section'    => 'service_section',
		'settings'   => 'guardian_options[service_'.$i.'_title]'
	) );
	$wp_customize->add_control( 'weblizar_service_description_'.$i, array(
		'label'        => __( 'service_'.$i.'_text', 'weblizar' ),
		'type'=>	'textarea',
		'section'    => 'service_section',
		'settings'   => 'guardian_options[service_'.$i.'_text]'
	) );
	$wp_customize->add_control( 'weblizar_service_link_'.$i, array(
		'label'        => __( 'service_'.$i.'_link', 'weblizar' ),
		'type'=>	'url',
		'section'    => 'service_section',
		'settings'   => 'guardian_options[service_'.$i.'_link]',
	) );
	}

	/* Social options */
	$wp_customize->add_section('social_section',array(
	'title'=>__("Social Options","weblizar"),
	'panel'=>'weblizar_theme_option',
	'capabilit'=>'edit_theme_options',
    'priority' => 41
	));
	$wp_customize->add_setting(
	'guardian_options[header_section_social_media_enbled]',
		array(
		'default'=>esc_attr($wl_theme_options['header_section_social_media_enbled']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_checkbox',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'header_section_social_media_enbled', array(
		'label'        => __( 'Enable Social Media Icons in Header Section', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[header_section_social_media_enbled]'
	) );
	$wp_customize->add_setting(
	'guardian_options[footer_section_social_media_enbled]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_section_social_media_enbled']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_checkbox',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'footer_section_social_media_enbled', array(
		'label'        => __( 'Enable Social Media Icons in Footer', 'weblizar' ),
		'type'=>'checkbox',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[footer_section_social_media_enbled]'
	) );
	$wp_customize->add_setting(
	'guardian_options[facebook_link]',
		array(
		'default'=>esc_attr($wl_theme_options['facebook_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'facebook_link', array(
		'label'        => __( 'Facebook URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[facebook_link]'
	) );
	$wp_customize->add_setting(
	'guardian_options[twitter_link]',
		array(
		'default'=>esc_attr($wl_theme_options['twitter_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'twitter_link', array(
		'label'        =>  __('Twitter URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[twitter_link]'
	) );
	$wp_customize->add_setting(
	'guardian_options[linkedin_link]',
		array(
		'default'=>esc_attr($wl_theme_options['linkedin_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'linkedin_link', array(
		'label'        => __( 'LinkedIn URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[linkedin_link]'
	) );
	$wp_customize->add_setting(
	'guardian_options[google_plus]',
		array(
		'default'=>esc_attr($wl_theme_options['google_plus']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'google_plus', array(
		'label'        => __( 'Goole+ URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[google_plus]'
	) );
	$wp_customize->add_setting(
	'guardian_options[flicker_link]',
		array(
		'default'=>esc_attr($wl_theme_options['flicker_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'flicker_link', array(
		'label'        => __( 'Flicker URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[flicker_link]'
	) );
	$wp_customize->add_setting(
	'guardian_options[rss_link]',
		array(
		'default'=>esc_attr($wl_theme_options['rss_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'rss_link', array(
		'label'        => __( 'RSS URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[rss_link]'
	) );
	$wp_customize->add_setting(
	'guardian_options[youtube_link]',
		array(
		'default'=>esc_attr($wl_theme_options['youtube_link']),
		'type'=>'option',
		'sanitize_callback'=>'esc_url_raw',
		'capabilit'=>'edit_theme_options'
		)
	);
		$wp_customize->add_control( 'youtube_link', array(
		'label'        => __( 'Youtube URL', 'weblizar' ),
		'type'=>'url',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[youtube_link]'
	) );
	
	$wp_customize->add_setting(
	'guardian_options[contact_email]',
		array(
		'default'=>esc_attr($wl_theme_options['contact_email']),
		'type'=>'option',
		'capabilit'=>'edit_theme_options',
		'sanitize_callback'=>'is_email',
		)
	);
		$wp_customize->add_control( 'contact_email', array(
		'label'        => __( 'Email-ID', 'weblizar' ),
		'type'=>'email',
		'section'    => 'social_section',
		'settings'   => 'guardian_options[contact_email]'
	) );
	$wp_customize->add_setting(
	'guardian_options[contact_phone_no]',
		array(
		'default'=>esc_attr($wl_theme_options['contact_phone_no']),
		'type'=>'option',
		'capabilit'=>'edit_theme_options',
		'sanitize_callback'=>'weblizar_sanitize_text',
		)
	);
		$wp_customize->add_control( 'contact_phone_no', array(
		'label'        => __( 'Phone Number', 'weblizar' ),
		'type'=>'text',
		'section'    => 'social_section',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'settings'   => 'guardian_options[contact_phone_no]'
	) );

	/* Footer Options */
	$wp_customize->add_section('footer_section',array(
	'title'=>__("Footer Options","weblizar"),
	'panel'=>'weblizar_theme_option',
	'capabilit'=>'edit_theme_options',
    'priority' => 40
	));
	$wp_customize->add_setting(
	'guardian_options[footer_customizations]',
		array(
		'default'=>esc_attr($wl_theme_options['footer_customizations']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_footer_customizations', array(
		'label'        => __( 'Footer Customization Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'guardian_options[footer_customizations]'
	) );
	
	$wp_customize->add_setting(
	'guardian_options[developed_by_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_text']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_text', array(
		'label'        => __( 'Footer Developed By Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'guardian_options[developed_by_text]'
	) );
	$wp_customize->add_setting(
	'guardian_options[developed_by_weblizar_text]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_weblizar_text']),
		'type'=>'option',
		'sanitize_callback'=>'weblizar_sanitize_text',
		'capabilit'=>'edit_theme_options'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_weblizar_text', array(
		'label'        => __( 'Footer Company Text', 'weblizar' ),
		'type'=>'text',
		'section'    => 'footer_section',
		'settings'   => 'guardian_options[developed_by_weblizar_text]'
	) );
	$wp_customize->add_setting(
	'guardian_options[developed_by_link]',
		array(
		'default'=>esc_attr($wl_theme_options['developed_by_link']),
		'type'=>'option',
		'capabilit'=>'edit_theme_options',
		'sanitize_callback'=>'esc_url_raw'
		)
	);
	$wp_customize->add_control( 'weblizar_developed_by_link', array(
		'label'        => __( 'Footer Customization Link', 'weblizar' ),
		'type'=>'url',
		'section'    => 'footer_section',
		'settings'   => 'guardian_options[developed_by_link]'
	) );
	$wp_customize->add_section( 'guardian_options_more' , array(
				'title'      	=> __( 'Upgrade to Guardian Premium', 'weblizar' ),
				'priority'   	=> 999,
				'panel'=>'weblizar_theme_option',
			) );

			$wp_customize->add_setting( 'guardian_options_more', array(
				'default'    		=> null,
				'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control( new More_guardian_Control( $wp_customize, 'guardian_options_more', array(
				'label'    => __( 'Guardian Premium', 'weblizar' ),
				'section'  => 'guardian_options_more',
				'settings' => 'guardian_options_more',
				'priority' => 1,
			) ) );
}
add_action( 'customize_register', 'weblizar_customizer' );
function weblizar_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function weblizar_sanitize_checkbox( $input ) {
    if ( $input == 'on' ) {
        return 'on';
    } else {
        return '';
    }
}
function weblizar_sanitize_integer( $input ) {
    return (int)($input);
}
/* Custom Control Class */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'weblizar_Customize_Misc_Control' ) ) :
class weblizar_Customize_Misc_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public function render_content() {
        switch ( $this->type ) {
            default:
           
            case 'heading':
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                break;
 
            case 'line' :
                echo '<hr />';
                break;
			
        }
    }
}
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'More_guardian_Control' ) ) :
class More_guardian_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		?>
		<label style="overflow: hidden; zoom: 1;">
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="https://weblizar.com/themes/guardian-premium-theme/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Guardian Premium','weblizar'); ?> </a>
			</div>
			<div class="col-md-4 col-sm-6">
				<img class="enigma_img_responsive " src="<?php echo WL_TEMPLATE_DIR_URI .'/images/GP.png'?>">
			</div>			
			<div class="col-md-3 col-sm-6">
				<h3 style="margin-top:10px;margin-left: 20px;text-decoration:underline;color:#333;"><?php echo _e( 'Guardian Premium - Features','weblizar'); ?></h3>
					<ul style="padding-top:20px">
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Responsive Design','weblizar'); ?> </li>						
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('More than 15+ Templates','weblizar'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('12 types Themes Colors Scheme','weblizar'); ?> </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('6 Types of Portfolio Templates','weblizar'); ?></li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Patterns Background','weblizar'); ?></li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Full Width & Boxed Layout','weblizar'); ?>   </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Touch Slider','weblizar'); ?>   </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Ultimate Portfolio layout with Isotope effect','weblizar'); ?>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Image Background','weblizar'); ?>  </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Rich Short codes','weblizar'); ?>  </li>	
						
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Coming Soon Mode','weblizar'); ?>  </li>
						<li class="upsell-enigma"> <div class="dashicons dashicons-yes"></div> <?php _e('Extreme Gallery Design Layout','weblizar'); ?>  </li>
					
					</ul>
			</div>
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="https://weblizar.com/themes/guardian-premium-theme/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Guardian Premium','weblizar'); ?> </a>
			</div>
			<span class="customize-control-title"><?php _e( 'Enjoying Guardian?', 'weblizar' ); ?></span>
			<p>
				<?php
					printf( __( 'If you Like our Products , Please do Rate us on %sWordPress.org%s?  We\'d really appreciate it!', 'weblizar' ), '<a target="" href="https://wordpress.org/support/view/theme-reviews/guardian?filter=5">', '</a>' );
				?>
			</p>
		</label>
		<?php
	}
}
endif;
?>