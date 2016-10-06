<?php        
/*	*Theme Name	: Guardian
	*Theme Core Functions and Codes
*/
	define('gr_td' , 'weblizar');
	define('WL_TEMPLATE_DIR_URI', get_template_directory_uri());
	require( get_template_directory() . '/core/menu/default_menu_walker.php' ); // for Default Menus
	require( get_template_directory(). '/core/menu/weblizar_nav_walker.php' ); // for Custom Menus	
	require( get_template_directory() . '/core/comment-function.php' );	
	require(dirname(__FILE__).'/customizer.php');	
	//Sane Defaults
	function weblizar_default_settings()
{	$ImageUrl = get_template_directory_uri() ."/images/slide-1.jpg";
	$ImageUrl2 = get_template_directory_uri() ."/images/slide-2.jpg";
	$ImageUrl3 = get_template_directory_uri() ."/images/slide-3.jpg";
	return $theme_options=array(
			//Logo and Fevicon header			
			'upload_image_logo'=>'',
			'height'=>'50',
			'width'=>'180',
			'text_title'=>'off',
			'upload_image_favicon'=>'',
			'custom_css'=>'',
			'_frontpage' => 'on',
			'blog_title' =>__('Our Latest Blog','weblizar'),
			
			'slide_image' => $ImageUrl,
			'slide_title' => __('Responsive Theme','weblizar'),
			'slide_desc' => __('Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar'),
			'slide_btn_text' => __('Read More','weblizar'),
			'slide_btn_link' => '#',
			
			'slide_image_1' => $ImageUrl2,
			'slide_title_1' => __('Custom Layout','weblizar'),
			'slide_desc_1' => __('Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar'),
			'slide_btn_text_1' => __('Read More','weblizar'),
			'slide_btn_link_1' => '#',
			
			'slide_image_2' => $ImageUrl3,
			'slide_title_2' => __('Touch Slider','weblizar'),
			'slide_desc_2' => __('Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Quisque rutrum pellentesque imperdiet','weblizar'),
			'slide_btn_text_2' => __('Read More','weblizar'),
			'slide_btn_link_2' => '#',
			
			//Service
			'home_service_title'=>__('Multi purpose Our service','weblizar'),
			'home_service_description'=>__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','weblizar'),
			
			'service_1_title'=>__("Idea",'weblizar'),
			'service_1_icons'=>"fa fa-google",
			'service_1_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar'),
			'service_1_link'=>"#",
			
			'service_2_title'=>__("Records",'weblizar'),
			'service_2_icons'=>"fa fa-database",
			'service_2_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar'),
			'service_2_link'=>"#",
			
			'service_3_title'=>__("WordPress",'weblizar'),
			'service_3_icons'=>"fa fa-wordpress",
			'service_3_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar'),
			'service_3_link'=>"#",
			
			'service_4_title'=>__("Responsive",'weblizar'),
			'service_4_icons'=>"fa fa-laptop",
			'service_4_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.",'weblizar'),
			'service_4_link'=>"#",
			
			
			//call out
			'call_out_text' =>__('Yepp! This is just a design for your awesome website and i am sure you gona love','weblizar'),			
			'call_out_link'=>'#',
			'call_out_button_text'=>__('Purchase Now!','weblizar'),
			'call_out_button_target'=>'on',
			
			
			//Social media links
			'contact_email'=>__('guardian@gmail.com','weblizar'),
			'contact_phone_no'=>__('1 4488 8000 4500','weblizar'),
			'header_section_social_media_enbled'=>'on',
			'footer_section_social_media_enbled'=>'on',
			
			'twitter_link' => "https://twitter.com/",
			'facebook_link' => "https://facebook.com",
			'linkedin_link' => "http://linkedin.com/",
			'google_plus' => "https://plus.google.com/",
			'flicker_link' => "https://www.flickr.com/",
			'youtube_link' => "https://www.youtube.com/",
			'rss_link' => "https://www.rss.com/",
			
			
			//footer customization 
			'footer_customizations' => __('Copyright @ 2015 Guardian.','weblizar'),
			'developed_by_text' => __(' Developed By','weblizar'),
			'developed_by_weblizar_text' => __('Weblizar','weblizar'),
			'developed_by_link' => 'http://weblizar.com/',
			
			'terms_of_use_text' =>__('Terms of Use','weblizar'),
			'terms_of_use_link' =>'#',
			
			'Privacy_policy_text' =>__('Privacy Policy','weblizar'),
			'Privacy_policy_link' =>'#',
		);
		return apply_filters( 'guardian_options', $wl_theme_options );
}
	function weblizar_get_options() {
    // Options API
    return wp_parse_args( 
        get_option( 'guardian_options', array() ), 
        weblizar_default_settings() 
    );    
	}
		
	/*After Theme Setup*/
	add_action( 'after_setup_theme', 'weblizar_setup' ); 	
	function weblizar_setup()
	{	
		global $content_width;
		//content width
		if ( ! isset( $content_width ) ) $content_width = 630; //px
	
		// Load text domain for translation-ready
		load_theme_textdomain( 'weblizar', get_template_directory() . '/core/lang' );	
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' ); //supports featured image
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'weblizar' ) );
		// theme support 	
		add_theme_support( 'automatic-feed-links'); 
		$args = array('default-color' => 'fff',);
		add_theme_support( 'custom-background', $args);
		$args_h = array(		
		'uploads'       => true,
		'header-text'  => false,
		);
		add_theme_support( 'custom-header', $args_h );
		add_editor_style( 'custom-editor-style.css' );
		require_once('guardian-default-settings.php');
			
		
	/*==================
	* Crop image for blog
	* ==================*/	
		//About-Us Post Thumb
		add_image_size('about_post_thumb',1140, 380,true);
		//Blogs thumbs
		add_image_size('home_post_thumb',360,180,true);	
		add_image_size('wl_page_thumb',730,350,true);
		add_image_size('wl_pageff_thumb',1170,350,true);
		add_image_size('small_thumbs',1170,520,true); //2-Column
		add_image_size('recent_blog_img',64,64,true);
	
	}
	// Read more tag to formatting in blog page 
	function weblizar_content_more($more)
	{  global $post;							
	   return '<a href="'.get_permalink().'">'.__('read more...','weblizar');'</a>';
	}   
	add_filter( 'the_content_more_link', 'weblizar_content_more' );
	
	
	// Replaces the excerpt "more" text by a link
	function weblizar_new_excerpt_more($more) {
       global $post;
	return '';
	}
	add_filter('excerpt_more', 'weblizar_new_excerpt_more');
	
	/*
	* Weblizar widget area
	*/
	add_action( 'widgets_init', 'weblizar_widgets_init');
	
	function weblizar_widgets_init() {
	//register_widget('wl_flickr_widget');
	/*sidebar*/
	register_sidebar( array(
			'name' => __( 'Sidebar', 'weblizar' ),
			'id' => 'sidebar-primary',
			'description' => __( 'The primary widget area', 'weblizar' ),
			'before_widget' => '<div class="sidebar_widget">',
			'after_widget' => '</div><div class="clearfix margin_top3"></div>',
			'before_title' => '<div class="sidebar_title"><h4>',
			'after_title' => '</h4></div>'
		) );
	/** footer widget area **/
	register_sidebar( array(
			'name' => __( 'Footer Widget Area', 'weblizar' ),
			'id' => 'footer-widget-area',
			'description' => __( 'footer widget area', 'weblizar' ),
			'before_widget' => '<div class="one_fourth animate fadeInUp" data-anim-type="fadeInUp"><div class="qlinks">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="lmb">',
			'after_title' => '</h4>',
		) );             
	}
	
	/*==================
	* Guardian theme css and js
	* ==================*/
	function weblizar_scripts()
	{	
		// Google fonts 	
		wp_enqueue_style('OpenSans', '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic');
		wp_enqueue_style('Raleway', '//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900');		
		wp_enqueue_style('stylesheet', get_template_directory_uri() . '/style.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.css');
		wp_enqueue_style('responsive-leyouts', get_template_directory_uri() . '/css/responsive-leyouts.css');
		wp_enqueue_style('mainmenu-bootstrap', get_template_directory_uri() . '/css/bootstrap.css');		
		wp_enqueue_style('mainmenu-menu', get_template_directory_uri() . '/css/menu.css');
		wp_enqueue_style('mainmenu-sticky', get_template_directory_uri() . '/css/sticky.css');
		wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css');		
		// carousel Slider
		wp_enqueue_style('carousel-style', get_template_directory_uri() . '/css/carousel.css');		
		// Js
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() .'/js/bootstrap.js',array('jquery'));	
		wp_enqueue_script('menu-js', get_template_directory_uri() .'/js/menu.js');	
		if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 	
	}
	add_action('wp_enqueue_scripts', 'weblizar_scripts');
	
	//code for image resize for according to image layout
	add_filter( 'intermediate_image_sizes', 'weblizar_image_presets');
	function weblizar_image_presets($sizes){
		$type = get_post_type($_REQUEST['post_id']);	
		foreach($sizes as $key => $value){
			if($type=='post' && $value != 'home_post_thumb' && $value != 'small_thumbs' && $value != 'recent_blog_img' )
			{ unset($sizes[$key]);  }
			elseif($type=='page' && $value != 'about_post_thumb' && $value != 'wl_page_thumb' && $value != 'wl_pageff_thumb')
			{ unset($sizes[$key]);  }
		}
		return $sizes;	 
	}
	
	/*==================
	* Add Class Gravtar
	* ==================*/
	add_filter('get_avatar','weblizar_gravatar_class');
	function weblizar_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='author_detail_img", $class);
    return $class;
	}
	
	/****--- Navigation for POSTS, Author, Category , Tag , Archive ---***/	
	function weblizar_navigation() { ?>
	<div class='pagination'> <nav id="wblizar_nav"> 
		<span class=""><?php posts_nav_link(' -- ',__('Newer Posts','weblizar'),__('Older Posts','weblizar')); ?></span> 
	</nav></div><?php
	}	
	
	/****--- Navigation for Single ---***/
	function weblizar_navigation_posts(){ ?>	
	<nav id="wblizar_nav">
		<span class="nav-previous"><?php previous_post_link('&laquo; %link'); ?></span>
		<span class="nav-next"><?php next_post_link('%link &raquo;'); ?></span> 
	</nav><?php 
	}
	/* Breadcrumbs  */
	function weblizar_breadcrumbs() {
    $delimiter = '';
    $home = __('Home','weblizar'); // text for the 'Home' link
    $before = ''; // tag before the current crumb
    $after = ''; // tag after the current crumb
    echo '<div class="pagenation">';
    global $post;
    $homeLink = esc_url(home_url());
    echo '<a href="' . $homeLink . '">' . $home . '</a> <i>/</i>' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . __('Archive by category "','weblizar') . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> <i>/</i> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> <i>/</i> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> <i>/</i>' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> <i>/</i> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
		$count_posts = wp_count_posts()->publish;
		if($count_posts != '') {
        echo $before . $post_type->labels->singular_name . $after;
		}
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> <i>/</i> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a> <i>/</i>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for "','weblizar') . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . __('Posts tagged "','weblizar') . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by ','weblizar') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . __('Error 404','weblizar') . $after;
    }
    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        //echo __('Page', 'weblizar') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }
    echo '</div>';
	}
	if (is_admin()) {
	require_once('core/admin/admin.php');
  }
  remove_filter('template_redirect','redirect_canonical');
?>
