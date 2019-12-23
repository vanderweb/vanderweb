<?php

////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////

$themename = "Vander Web";
$developer_uri = "https://vander-web.com";
$shortname = "vanderweb";
$version = '1.0.3';
load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );

////////////////////////////////////////////////////////////////////
// Enqueue Styles and Scripts
////////////////////////////////////////////////////////////////////
function vanderweb_theme_scripts() {
 wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css', array(), null);
 wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css', array(), null);
 //wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css', array(), null);
 wp_enqueue_style( 'parent-style', get_template_directory_uri().'/vanderweb.css', array(), null);
 
 wp_register_script( 'popper_js', '//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), null );
 wp_enqueue_script('popper_js');
 wp_script_add_data( 'popper_js', array( 'integrity', 'crossorigin' ) , array( 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo', 'anonymous' ) );
 
 wp_register_script('Bootstrap4', '//stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js', array('jquery'), null );
 wp_enqueue_script('Bootstrap4');
 wp_script_add_data( 'Bootstrap4', array( 'integrity', 'crossorigin' ) , array( 'sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P', 'anonymous' ) );
 if(get_option('vanderweb_menudropdown') == 'true'):
  wp_enqueue_script( 'vanderweb_nav_js', get_template_directory_uri().  '/js/vanderweb-nav.js', array('jquery') );
 endif;
 wp_enqueue_style( 'fancybox', get_template_directory_uri().'/lib/fancybox/source/jquery.fancybox.css', '', '2.1.6' );
 wp_enqueue_script( 'fancybox_vanderweb', get_template_directory_uri().  '/js/vanderweb-fancybox.js', array('jquery') );
 wp_enqueue_script( 'fancybox_pack_script', get_template_directory_uri().  '/lib/fancybox/source/jquery.fancybox.pack.js', array('jquery'), '2.1.6' );
 wp_dequeue_style( 'wp-block-library' );
}
add_action('wp_enqueue_scripts', 'vanderweb_theme_scripts');

//Editor Style
add_editor_style('css/editor-style.css');

////////////////////////////////////////////////////////////////////
// Hooks
////////////////////////////////////////////////////////////////////
function vanderweb_hooks() {
 require_once(get_template_directory().'/hooks/vanderweb-hooks-bottom.php');
 require_once(get_template_directory().'/hooks/vanderweb-hooks-content.php');
 require_once(get_template_directory().'/hooks/vanderweb-hooks-top.php');
}
add_action( 'after_setup_theme', 'vanderweb_hooks' );

////////////////////////////////////////////////////////////////////
// Files
////////////////////////////////////////////////////////////////////
function vanderweb_files() {
 require_once(get_template_directory().'/lib/customizer.php');
 require_once(get_template_directory().'/lib/galleryslider.php');
 require_once(get_template_directory().'/lib/metaboxes.php');
 require_once(get_template_directory().'/lib/shortcodes.php');
 require_once(get_template_directory().'/lib/widgets.php');
 require_once(get_template_directory().'/lib/wp_bootstrap_navwalker.php');
}
add_action( 'after_setup_theme', 'vanderweb_files' );

////////////////////////////////////////////////////////////////////
// Register Widget areas
////////////////////////////////////////////////////////////////////
function vanderweb_widgets_init() {
 register_sidebar(
  array(
   'name' => __( 'Topbar', 'vanderweb' ),
   'id' => 'topbarwidget',
   'before_widget' => '<div id="%1$s" class="align-self-center col-auto widget-topbar %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<span class="notitle">',
   'after_title' => '</span>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Header', 'vanderweb' ),
   'id' => 'headerwidget',
   'before_widget' => '<div id="%1$s" class="vanderweb-header-widget col-auto align-self-center %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<span class="notitle">',
   'after_title' => '</span>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Hero Section', 'vanderweb' ),
   'id' => 'herosection',
   'before_widget' => '<div id="%1$s" class="col-12 col-md hero-section widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Slider', 'vanderweb' ),
   'id' => 'slider',
   'before_widget' => '<div id="%1$s" class="widget-slider %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<span class="notitle">',
   'after_title' => '</span>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Section Above 1', 'vanderweb' ),
   'id' => 'section-above-1',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-above-1 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Section Above 2', 'vanderweb' ),
   'id' => 'section-above-2',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-above-2 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Section Above 3', 'vanderweb' ),
   'id' => 'section-above-3',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-above-3 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 
 register_sidebar(
  array(
   'name' => __( 'Content Above', 'vanderweb' ),
   'id' => 'content-above',
   'before_widget' => '<div id="%1$s" class="contentabove widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Left Sidebar', 'vanderweb' ),
   'id' => 'left-sidebar',
   'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></aside>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Right Sidebar', 'vanderweb' ),
   'id' => 'right-sidebar',
   'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></aside>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Content Below', 'vanderweb' ),
   'id' => 'content-below',
   'before_widget' => '<div id="%1$s" class="contentbelow widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 
 register_sidebar(
  array(
   'name' => __( 'Section Below 1', 'vanderweb' ),
   'id' => 'section-below-1',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-below-1 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Section Below 2', 'vanderweb' ),
   'id' => 'section-below-2',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-below-2 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Section Below 3', 'vanderweb' ),
   'id' => 'section-below-3',
   'before_widget' => '<div id="%1$s" class="col-12 col-md section-below-3 widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 
 register_sidebar(
  array(
   'name' => __( 'Footer Boxes', 'vanderweb' ),
   'id' => 'footerboxes',
   'before_widget' => '<div id="%1$s" class="col-12 col-md footerboxes widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
 register_sidebar(
  array(
   'name' => __( 'Footer Copyright', 'vanderweb' ),
   'id' => 'footercopyright',
   'before_widget' => '<div id="%1$s" class="col-12 footercopyright widget %2$s"><div class="widget-inner">',
   'after_widget' => '</div></div>',
   'before_title' => '<div class="widget-title"><h3>',
   'after_title' => '</h3></div>',
  )
 );
}
add_action( 'widgets_init', 'vanderweb_widgets_init' );

////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////
function vanderweb_register_nav_menu(){
 register_nav_menus( array(
     'main_menu' => __( 'Main Menu', 'vanderweb' ),
 ) );
}
add_action( 'after_setup_theme', 'vanderweb_register_nav_menu', 0 );

////////////////////////////////////////////////////////////////////
// Functions - Actions and Filters
////////////////////////////////////////////////////////////////////
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function vanderweb_body_class( $classes ) {
 global $post;
 $id = get_current_blog_id();
 $slug = strtolower(str_replace(' ', '-', trim(get_bloginfo('name'))));
 $classes[] .= $slug;
 $classes[] .= 'site-id-'.$id;
 if (get_post_meta($post->ID, 'pagecustomclass', true )) {
  $classes[] = get_post_meta($post->ID, 'pagecustomclass', true );
 }    
 if ( wp_is_mobile() ){
  $classes[] .= 'touchscreen';
 } else{
  $classes[] .= 'no-touchscreen';
 }
 if ( is_user_logged_in() ){
  $classes[] .= 'logged-in';
 } else{
  $classes[] .= 'logged-out';
 }

 return $classes;
}
add_filter( 'body_class','vanderweb_body_class' );

function wp_mail_fix_multiple_send($args){
 global $wp_mail_fix_multiple_send_already_send;
 if (!isset($wp_mail_fix_multiple_send_already_send))
  $wp_mail_fix_multiple_send_already_send = array();
 $key = md5(implode('-',$args));
 if(isset($wp_mail_fix_multiple_send_already_send[$key])){
  $args['to'] = '';
  $args['subject'] = '';
  $args['message'] = '';
 }
 else {
  $wp_mail_fix_multiple_send_already_send[$key] = 1;
 }
 return $args;
}
add_filter('wp_mail','wp_mail_fix_multiple_send', 1,1);

function vanderweb_custom_background_cb() {
 // $background is the saved custom image, or the default image.
 $background = set_url_scheme( get_background_image() );
 // $color is the saved custom color.
 // A default has to be specified in style.css. It will not be printed here.
 $color = get_background_color();
 if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
  $color = false;
 }
 $type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';
 if ( ! $background && ! $color ) {
  if ( is_customize_preview() ) {
   printf( '<style></style>', $type_attr );
  }
  return;
 }
 $style = $color ? "background-color: #$color;" : '';
 if ( $background ) {
  $image = ' background-image: url("' . esc_url_raw( $background ) . '");';
  // Background Position.
  $position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
  $position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
  if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
   $position_x = 'left';
  }
  if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
   $position_y = 'top';
  }
  $position = " background-position: $position_x $position_y;";
  // Background Size.
  $size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
  if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
   $size = 'auto';
  }
  $size = " background-size: $size;";
  // Background Repeat.
  $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
  if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
   $repeat = 'repeat';
  }
  $repeat = " background-repeat: $repeat;";
  // Background Scroll.
  $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
  if ( 'fixed' !== $attachment ) {
   $attachment = 'scroll';
  }
  $attachment = " background-attachment: $attachment;";
  $style .= $image . $position . $size . $repeat . $attachment;
 }
?>
<style>
body { <?php echo trim( $style ); ?> }
</style>
<?php
}
function parent_theme_features() {
 $args = array(
  'flex-width'    => true,
  'width'         => 980,
  'flex-height'   => true,
  'height'        => 200,
 );
 add_theme_support( 'custom-header', $args );
 add_theme_support( 'post-thumbnails' );
 add_theme_support( 'automatic-feed-links' );
 add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'parent_theme_features', 10 );

// Disable the emoji's
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
  $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
  $urls = array_diff( $urls, array( $emoji_svg_url ) );
 }
 return $urls;
}

// Add the filter and function, returning the widget title only if the first character is not "!"
add_filter( 'widget_title', 'vanderweb_remove_widget_title' );
function vanderweb_remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' ) {
		return;
	} else {
		return ( $widget_title );
	}
};
add_filter( 'category_description', 'do_shortcode' );
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

function get_excerpt(){
	$excerptlength = '55';
	
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $excerptlength);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = '<p class="cat-excerpt">'.$excerpt.' ... </p>';
	return $excerpt;
}
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Hex to RGB Converter Function
function vanderweb_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
	$r = hexdec(substr($hex,0,1).substr($hex,0,1));
	$g = hexdec(substr($hex,1,1).substr($hex,1,1));
	$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	
	return $rgb; // returns an array with the rgb values
}

// Page Two-Columns support
function split_content() {
	global $more;
	$more = true;
	$content0 = preg_split('/<span id="more-\\d+"><\\/span>/i', get_the_content('more'));      // first <!--more--> tag gets turned into <span id="more-[number]"></span>
	$content1 = preg_split('/<!--more-->/i', $content0[1]);	// but all the remaining ones are left as <!--more-->
	$content = array_merge(array($content0[0]), $content1);	// so we have this here ugly hack
	
	for($c = 0, $csize = count($content); $c < $csize; $c++) {
		$content[$c] = apply_filters('the_content', $content[$c]);
	}
	return $content;
}

////////////////////////////////////////////////////////////////////
// Font Awsome Filters
////////////////////////////////////////////////////////////////////
function vanderweb_override_fontawesome_version() {
	return '4.7.0';
}
add_filter('ACFFA_override_version', 'vanderweb_override_fontawesome_version');
