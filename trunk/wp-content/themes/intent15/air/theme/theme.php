<?php

// Load common theme actions, functions, and filters
require ( AIR_THEME . '/theme-common.php');

// Custom TinyMCE button
require ( AIR_THEME . '/theme-tinymce.php');

/*---------------------------------------------------------------------------*/
/* Theme :: Setup + Actions
/*---------------------------------------------------------------------------*/

// Add admin actions
add_action( 'air_validate_theme_options', 'wpbandit_advanced_css', 10, 2 );
add_action( 'after_switch_theme', 'wpbandit_upgrade' );

// Add theme actions
add_action( 'after_switch_theme', 'wpbandit_after_switch_theme' );
add_action( 'after_setup_theme', 'wpbandit_setup_theme' );
add_action( 'widgets_init', 'wpbandit_widgets_init' );
add_action( 'wp_enqueue_scripts', 'wpbandit_styles' );
add_action( 'wp_enqueue_scripts', 'wpbandit_fancybox1_stylesheet');
add_action( 'wp_enqueue_scripts', 'wpbandit_scripts' );

// Add custom wpbandit actions
add_action( 'wpb_portfolio_javascript', 'wpb_portfolio_javascript', 10, 3);


/*---------------------------------------------------------------------------*/
/* Theme :: Functions
/*---------------------------------------------------------------------------*/

/**
	Upgrade theme
**/
function wpbandit_upgrade() {
	// Define page templates
	$templates = array(
		'template-menu-left-2.php' => 'page-templates/child-menu-left-2.php',
		'template-menu-left.php' => 'page-templates/child-menu-left.php',
		'template-menu-right-2.php' => 'page-templates/child-menu-right-2.php',
		'template-menu-right.php' => 'page-templates/child-menu-right.php',
		'template-front.php' => 'page-templates/frontpage.php',
		'template-full-width.php' => 'page-templates/full-width.php',
		'template-portfolio.php' => 'page-templates/portfolio.php',
		'template-sidebar-left.php' => 'page-templates/sidebar-left.php',
		'template-sidebar-right.php' => 'page-templates/sidebar-right.php',
		'template-sitemap.php' => 'page-templates/sitemap.php'
	);
	
	// Get all pages (id only)
	$pages = get_all_page_ids();
	
	// Loop through pages
	foreach ($pages as $page_id) {
		// Get page template
		$template = get_post_meta($page_id,'_wp_page_template',true);
		// Check if template needs to be renamed
		if (array_key_exists($template,$templates)) {
			// Update page template
			update_post_meta($page_id,'_wp_page_template',$templates[$template]);
		}
	}
}

/**
	After switch theme
	- Upgrade if necessary when switching to theme
**/
function wpbandit_after_switch_theme() {
	// Check for old options
	$old = get_option('bandit-intent');
	// If old options exist, move to new name
	if ( $old ) {
		// Create backup
		update_option('bandit-intent-backup-14', $old);
		// Move options
		update_option('wpbandit-intent', $old);
		// Delete old option
		delete_option('bandit-intent');
	}
}

/**
	Setup theme
**/
function wpbandit_setup_theme() {
	// Set default options, if necessary
	Air::set_default_options();

	// Create wpbandit_images table
	wpbandit_create_images_table();

	// Load theme shortcodes
	require ( AIR_THEME . '/theme-shortcodes.php' );
}

/**
	Widgets init
	- register additional sidebars and widget areas
**/
function wpbandit_widgets_init() {
	// Footer widgets
	if ( Air::get_option('footer-widgets') ) {
		register_sidebar(array(
			'id'			=> 'widget-footer-1',
			'name'			=> 'Footer Column 1',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-2',
			'name'			=> 'Footer Column 2',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-3',
			'name'			=> 'Footer Column 3',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-4',
			'name'			=> 'Footer Column 4',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
}

/**
	Enqueue stylesheets
**/
function wpbandit_styles() {
	// responsive.css
	if ( !wpb_option('disable-responsive') ) {
		wp_enqueue_style('style-responsive');
	}
	// theme style
	if ( Air::get_option('style') )
		wp_enqueue_style('wpbandit-style',
			get_template_directory_uri().'/styles/'.Air::get_option('style'));
	// style-advanced.css
	if ( Air::get_option('advanced-css') )
		wp_enqueue_style('wpbandit-style-advanced',
			get_template_directory_uri().'/style-advanced.css');
	// custom.css
	if ( Air::get_option('custom-css') )
		wp_enqueue_style('wpbandit-custom');
}

/**
	Enqueue fancyBox1 stylesheet
**/
function wpbandit_fancybox1_stylesheet() {
	if ( 'fancybox1' == Air::get_option('js-fancybox') )
		wp_enqueue_style('fancybox1');
}

/**
	Enqueue scripts
**/
function wpbandit_scripts() {

	// comment-reply.js
	if ( is_singular() )
		wp_enqueue_script('comment-reply');

	// jquery.jplayer.min.js
	if ( !Air::get_option('js-disable-jplayer') )
		wp_enqueue_script('jplayer');

	// jquery.flexslider.min.js
	wp_enqueue_script('flexslider');
	
	// jquery.isotope.min.js
	wp_enqueue_script('isotope');

	// jquery.fancybox-1.3.4.pack.js
	if ( 'fancybox1' == Air::get_option('js-fancybox','fancybox2') ) {
		wp_enqueue_script('fancybox1');
	}
	
	// jquery.fancybox.pack.js
	if ( 'fancybox2' == Air::get_option('js-fancybox','fancybox2') ) {
		wp_enqueue_script('fancybox2');
		wp_enqueue_script('fancybox2-media-helper');
	}
	
	// jquery.mousewheel-3.0.6.pack.js
	wp_enqueue_script('mousewheel');

	// jquery.theme.js
	wp_enqueue_script('theme');

	// Translatable strings
	wp_localize_script('theme', 'objectL10n',
		array(
			'navigate' => __('Navigate to...','intent'),
		)
	);
}

/**
	Write advanced styles to style-advanced.css
**/
function wpbandit_advanced_css($section,$valid) {
	// Are we in styling section ?
	if ( 'styling' != $section ) { return; }
	
	// Advanced stylesheet enabled ?
	if ( '1' != $valid['advanced-css'] ) { return; }

	// Set filename
	$file = get_template_directory().'/style-advanced.css';

	// Cannot write to style-advanced.css
	if ( !is_writable($file) ) {
		// Add error if cannot write to file
		add_settings_error('air-settings-errors','air-updated',
			__('Cannot write to style-advanced.css. Please check permissions'.
			' and try saving settings again.','air'),'error');
		// Do not proceed further
		return;
	}

	// Get options
	$color_1 = $valid['styling-color-1'];
	$header_text_color = $valid['styling-header-text-color'];
	$misc_shadows_1 = $valid['styling-misc-shadows-1'];
	$misc_shadows_2 = $valid['styling-misc-shadows-2'];
	$misc_vertical_image = $valid['styling-misc-vertical-image'];
	
	$header_bg_color = $valid['styling-header-bg-color'];
	$header_bg_image = $valid['styling-header-bg-image'];
	$header_bg_image_repeat = $valid['styling-header-bg-image-repeat'];
	
	$subheader_bg_color = $valid['styling-subheader-bg-color'];
	$subheader_bg_image = $valid['styling-subheader-bg-image'];
	$subheader_bg_image_repeat = $valid['styling-subheader-bg-image-repeat'];
	
	$body_bg_color = $valid['styling-body-bg-color'];
	$body_bg_image = $valid['styling-body-bg-image'];
	$body_bg_image_repeat = $valid['styling-body-bg-image-repeat'];
	
	$footer_bg_color = $valid['styling-footer-bg-color'];
	$footer_bg_image = $valid['styling-footer-bg-image'];
	$footer_bg_image_repeat = $valid['styling-footer-bg-image-repeat'];

	// Build style-advanced.css
	$styles = '/* Note : Do not place custom styles in this stylesheet */'."\n\n";

	// header
	$styles .= '#header { ';
		if ( $header_bg_color ) { $styles .= 'background-color: #'.$header_bg_color.'; background-image: none; '; }
		if ( $header_bg_image ) { $styles .= 'background-image: url('.$header_bg_image.'); '; }
		if ( $header_bg_image_repeat) { $styles .= 'background-repeat: '.$header_bg_image_repeat.'; '; }		
	$styles .= '}'."\n";
	
	// subheader
	$styles .= '#subheader { ';
		if ( $subheader_bg_color ) { $styles .= 'background-color: #'.$subheader_bg_color.'; background-image: none; '; }
		if ( $subheader_bg_image ) { $styles .= 'background-image: url('.$subheader_bg_image.'); '; }
		if ( $subheader_bg_image_repeat) { $styles .= 'background-repeat: '.$subheader_bg_image_repeat.'; '; }		
	$styles .= '}'."\n";
	
	// body
	$styles .= 'body { ';
		if ( $body_bg_color ) {	$styles .= 'background-color: #'.$body_bg_color.'; background-image: none; '; }
		if ( $body_bg_image ) {	$styles .= 'background-image: url('.$body_bg_image.'); '; }
		if ( $body_bg_image_repeat) { $styles .= 'background-repeat: '.$body_bg_image_repeat.'; '; }		
	$styles .= '}'."\n";
	
	// footer
	$styles .= '#footer { ';
		if ( $footer_bg_color ) { $styles .= 'background-color: #'.$footer_bg_color.'; background-image: none; '; }
		if ( $footer_bg_image ) { $styles .= 'background-image: url('.$footer_bg_image.'); '; }
		if ( $footer_bg_image_repeat) { $styles .= 'background-repeat: '.$footer_bg_image_repeat.'; '; }		
	$styles .= '}'."\n";
	
	// header text color
	if ( $header_text_color ) { $styles .= '#logo a, #tagline, #nav li a { color: #'.$header_text_color.'; }'."\n"; }
	// misc box shadows 1
	if ( $misc_shadows_1 ) { $styles .= '#subheader, #footer, #flex-front-3.flexslider { -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }'."\n"; }
	// misc box shadows 2
	if ( $misc_shadows_2 ) { $styles .= '#header, #subfooter { -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }'."\n"; }
	// misc vertical image height (gallery)
	if ( $misc_vertical_image ) { $styles .= '.flexslider .slides img { max-height: 700px; } .single .flexslider .slides > li, .blog .flexslider .slides > li { background-color: #222; }'."\n"; }
	
	// theme color
	if ( $color_1 ) {
		$rgb = wpb_hex2rgb($color_1);
		$styles .= '
a,
label .required,
.comment-awaiting-moderation,
#nav li a:hover, 
#nav li:hover a, 
#nav li.current_page_item a, 
#nav li.current-menu-ancestor a, 
#nav li.current-menu-item a,
ul#breadcrumbs li a:hover,
.entry-title a:hover,
.widget_archive ul li,
.widget_categories ul li,
.widget_links ul li,
.widget_rss ul li a,
.widget_tag_cloud .tagcloud a:hover,
.widget_calendar a,
.portfolio-item:hover a.portfolio-meta .portfolio-title,
.portfolio-item a.portfolio-meta:hover .portfolio-title,
.sitemap a:hover,
#child-menu li li.current_page_item a, #child-menu li li.current-menu-item a ,
#child-menu li li li.current_page_item a, #child-menu li li li.current-menu-item a,
#child-menu-alt li li li.current_page_item a,
#child-menu-alt li li li.current-menu-item a,
#child-menu-alt li li li.current_page_item a:hover,
#child-menu-alt li li li.current-menu-item a:hover,
ul.tabs-nav li a.active { color: #'.$color_1.'; }

.color { color: #'.$color_1.'!important; }

a.item-large:hover span.featured-title,
.entry-comments a.bubble:hover,
.entry-comments a.bubble:hover span,
.entry-format.link p a,
.widget_calendar caption,
ul#portfolio-filter li a:hover,
ul#portfolio-filter li:hover a,
ul#portfolio-filter li.current a,
ul#portfolio-filter li.current-cat a,
ul#portfolio-filter li.current-cat-parent a,
ul#portfolio-filter li ul,
#child-menu-alt li li.current_page_item a, 
#child-menu-alt li li.current-menu-item a,
#child-menu-alt li li.current_page_parent a, 
#child-menu-alt li li.current_page_item a:hover, 
#child-menu-alt li li.current-menu-item a:hover,
#child-menu-alt li li.current_page_parent a:hover,
input[type="submit"],
button[type="submit"],
a.button,
.plan.featured .plan-head,
.toggle .title .icon,
.accordion .title .icon,
.commentlist .reply a:hover,
#footer a#to-top:hover { background-color: #'.$color_1.'; }

::selection { background-color: #'.$color_1.'; }
::-moz-selection { background-color: #'.$color_1.'; }

#nav li.current_page_item a, 
#nav li.current-menu-ancestor a, 
#nav li.current-menu-item a,
.portfolio-item:hover a.portfolio-meta,
.portfolio-item a.portfolio-meta:hover,
.plan.featured { border-color: #'.$color_1.'; }

#nav li a:hover, 
#nav li:hover a,
#nav ul,
ul.tabs-nav li a.active { border-top-color: #'.$color_1.'; }

.wp-pagenavi a { color: #'.$color_1.'!important; border: 1px solid rgba('.$rgb.', 0.3)!important; }
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { background: #'.$color_1.'!important; border: 1px solid #'.$color_1.'!important; }
			'."\n";
		}

	// open file for writing
	$fh = fopen($file, 'w');
	// write styles
	fwrite($fh, $styles);
	// close file
	fclose($fh);

	return TRUE;
}


/*---------------------------------------------------------------------------*/
/* Theme :: Template Functions
/*---------------------------------------------------------------------------*/

/**
	Page Title
**/
function wpb_page_title() {
	global $post;

	$heading = get_post_meta($post->ID,'_heading',TRUE);
	$subheading = get_post_meta($post->ID,'_subheading',TRUE);
	$title = $heading?$heading:the_title();
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Blog Heading
**/
function wpb_blog_heading() {
	global $post;

	$heading = Air::get_option('blog-heading');
	$subheading = Air::get_option('blog-subheading');
	$title = $heading;
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Page Featured Image Caption
**/
function wpb_post_thumbnail_caption() {
	global $post;
	$output = '';

	$thumbnail_id    = get_post_thumbnail_id($post->ID);
	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ($thumbnail_image && isset($thumbnail_image[0])) {
		if($thumbnail_image[0]->post_excerpt) {
			$output .= '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
		}
		if($thumbnail_image[0]->post_content) {
			$output .= '<span class="description"><i>'.$thumbnail_image[0]->post_content.'</i></span>';
		}
	}

	return isset($output)?$output:'';
}

/**
	Archive heading
**/
function wpb_archive_heading() {
	// Author archive page
	if ( is_author() ) {
		if(get_query_var('author_name'))
			$author = get_user_by('login',get_query_var('author_name'));
		else
			$author=get_userdata(get_query_var('author'));
		$heading = __('Author:','intent').' ';
		$heading .= '<span>'.$author->display_name.'</span>';
	}
	// Category archive page
	if ( is_category() ) {
		$heading = __('Category:','intent').' ';
		$heading .= '<span>'.single_cat_title('', false).'</span>';
	}
	// Tag archive page
	if ( is_tag() ) {
		$heading = __('Tagged:','intent').' ';
		$heading .= '<span>'.single_tag_title('', false).'</span>';
	}
	// Daily archive
	if ( is_day() ) {
		$heading = __('Daily Archive:','intent').' ';
		$heading .= '<span>'.get_the_time('F j, Y').'</span>';
	}
	// Monthly archive
	if ( is_month() ) {
		$heading = __('Monthly Archive:','intent').' ';
		$heading .= '<span>'.get_the_time('F Y').'</span>';
	}
	// Yearly archive page
	if ( is_year() ) {
		$heading = __('Yearly Archive:','intent').' ';
		$heading .= '<span>'.get_the_time('Y').'</span>';
	}
	return isset($heading)?$heading:'';
}

/**
	Social Media Links
**/
function wpb_social_media_links($attrs = NULL) {
	// Set attributes
	$attrs = isset($attrs)?air_attrs($attrs):'';

	// Get links
	$links = air_social::get_items();

	// Create links
	if ( $links ) {
		// Start output
		$output = '<ul'.$attrs.'>';

		// Loop through links
		foreach($links as $link) {
			$target = ('1'==$link['new-window'])?' target="_blank"':'';
			$output .= '<li><a href="'.$link['url'].'"'.$target.'><span class="icon"><img src="'.
				$link['icon'].'" alt="'.$link['name'].'" /></span><span class="icon-title"><i class="icon-pike"></i>'.$link['name'].'</span></a></li>';
		}
		$output .= '</ul>';

		// Return links
		return $output;
	}
}

/**
	Are breadcrumbs enabled?
**/
function wpb_breadcrumbs_enabled() {
	// Static front page
	$static = ('page'===get_option('show_on_front'))?TRUE:FALSE;
	// Disabled
	if ( air_breadcrumbs::get_option('breadcrumbs-enable') )
		$status = TRUE;
	// Disabled on front page
	if ( is_front_page() && $static && air_breadcrumbs::get_option('disable-page-front') )
		$status = FALSE;
	// Disabled on home page
	if ( is_home() && air_breadcrumbs::get_option('disable-page-home') )
		$status = FALSE;
	// Disabled on archive pages
	if ( is_archive() && air_breadcrumbs::get_option('disable-page-archives') )
		$status = FALSE;
	// Disabled
	return isset($status)?$status:FALSE;
}

/**
	Breadcrumbs
**/
function wpb_breadcrumbs() {
	return air_breadcrumbs::display();
}

/**
	Portfolio item link
**/
function wpb_portfolio_link($lightbox=FALSE) {
	// Return link, if lightbox is not enabled
	if (is_post_type_archive('portfolio') && !air_portfolio::get_option('archive_enable_lightbox'))
		return wpb_meta('_link', get_permalink());

	if (is_tax('portfolio_category') && !air_portfolio::get_option('taxonomy_enable_lightbox'))
		return wpb_meta('_link', get_permalink());

	if (is_page() && !$lightbox)
		return wpb_meta('_link', get_permalink());

	// Get lightbox type
	$type = wpb_meta('_portfolio_video')?'video':'image';

	// Switch to lightbox type					
	switch ( $type ) {
		case 'image':
			// Get post images
			$post_images = wpb_post_images();
			// Set $img_id to first post image, else set to post thumbnail
			if ( $post_images ) {
				$img_id = $post_images[0]->ID;
			} else {
				$img_id = get_post_thumbnail_id();
			}
			// Get large image
			$img_large = wp_get_attachment_image_src($img_id,'large');
			// Set link to image URL
			$link = $img_large[0];
			// Set link to placeholder if image does not exist
			if ( !$link )
				$link = get_template_directory_uri() . '/img/placeholder.png';
			break;

		case 'video':
			// Get video meta fields
			$video_url = wpb_meta('_portfolio_video_url');
			$video_embed_code = wpb_meta('_portfolio_video_embed_code');
			// Set lightbox link to video div
			$link = '#video-'.get_the_ID();
			// Print video div
			echo wpb_portfolio_video_div($video_url,$video_embed_code);
			break;
	}

	// Return link
	return $link;
}

/**
	Portfolio lightbox video div
**/
function wpb_portfolio_video_div($video_url,$video_embed_code) {
	// Set empty $div, $div_content
	$div = $div_content = '';

	// Check that we have URL or embed code
	if ( !$video_url && !$video_embed_code )
		return $div;

	// Get fancybox version
	$fancybox = Air::get_option('js-fancybox','fancybox2');

	// Set div content
	if ( $video_url ) {
		global $wp_embed;
		$div_content .= $wp_embed->run_shortcode('[embed]'.$video_url.'[/embed]');
	}

	// Video Embed Code
	if ( $video_embed_code && !$video_url ) {
		$div_content .= $video_embed_code;
	}

	// Switch to fancybox version
	switch ( $fancybox ) {

		// Fancybox 1
		case 'fancybox1':
			$div .= '<div style="display:none;"><div id="video-'.get_the_ID().
				'" class="video-container fancybox-video fancybox1">';
			$div .= $div_content.'</div></div>';
			break;

		// Fancybox 2
		case 'fancybox2':
			$div .= '<div id="video-'.get_the_ID().'" class="video-container fancybox-video">';
			$div .= $div_content.'</div>';
			break;

	}

	// Return video div
	return $div;
}

/**
	Portfolio classes ( Archive / Taxonomy Templates )
**/
function wpb_portfolio_classes($classes='') {
	// Portfolio archive classes
	if (is_post_type_archive('portfolio')) {
		// Layout
		$classes = air_portfolio::get_option('archive_layout','grid one-third');
	}

	// Portfolio taxonomy classes
	if (is_tax('portfolio_category')) {
		// Layout
		$classes = air_portfolio::get_option('taxonomy_layout','grid one-third');
	}

	// Category slugs
	$classes .= ' ' . air_portfolio::get_category_slugs(' ');

	// Return classes
	return $classes;
}

/**
	Portfolio classes ( Single Template )
**/
function wpb_portfolio_class($layout='') {
	// Layout
	$classes  = $layout;
	// Category slugs
	$classes .= ' ' . air_portfolio::get_category_slugs(' ');

	// Return classes
	return $classes;
}

/**
	Portfolio javascript
**/
function wpb_portfolio_javascript($disable_categories,$disable_switcher,$lightbox) {
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	<?php if ( !$disable_categories || !$disable_switcher ): // isotope ?>
	
	// Isotope
	jQuery('.isotope').isotope({
		animationEngine : 'best-available',
		itemSelector : '.isotope-item',
		layoutMode : 'fitRows'
	});

	<?php endif; ?>

	// Category Filter
	jQuery('#portfolio-filter.iso').wpbandit('portfolio_category_filter');	
	
	// Size Switcher
	jQuery('#portfolio-size').wpbandit('portfolio_size_switcher');

	<?php if ( $lightbox && ('fancybox2' == Air::get_option('js-fancybox','fancybox2')) ): ?>

	// Portfolio lightbox - fancybox2
	jQuery('a.portfolio-thumbnail').fancybox({
		nextSpeed: 500,
		prevSpeed: 500
	});

	<?php elseif ( $lightbox ): ?>

	var tmp;
	var src;
	
	// Portfolio lightbox - fancybox1
	jQuery('a.portfolio-thumbnail').fancybox({
		nextSpeed: 500,
		prevSpeed: 500,
		onComplete : function()
		{
			tmp = jQuery(this.href);
			if ( tmp.hasClass('fancybox-video') ) {
				src = tmp.find('iframe').attr('src');
			}
		},
		onClosed : function()
		{
			if ( tmp.hasClass('fancybox-video') ) {
				tmp.find('iframe').attr('src',src);
			}
		}
	});

	<?php endif; ?>

});
jQuery(window).load(function() {
	jQuery('.isotope').isotope('reLayout');
});
</script>
<?php
}


/*---------------------------------------------------------------------------*/
/* Theme :: Filters
/*---------------------------------------------------------------------------*/

/**
	Body Class
**/
function wpbandit_body_class($classes) {
	if ( Air::get_option('sidebar-mobile-disable') )
		$classes[] = 'mobile-sidebar-disable';
	return $classes;
}
add_filter('body_class','wpbandit_body_class');
