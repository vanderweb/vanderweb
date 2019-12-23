<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>
 <!--
	##########################################
	## Vander Web							##
	## https://vander-web.com				##
	##########################################
-->
<?php
// action hook for any content placed before the header, including the widget area
do_action ( 'vanderweb_before_header' );
global $post;
if(is_category() || is_archive()){
	$vanderweb_content_type = 'category';
}elseif(is_page()){
	$vanderweb_content_type = 'page';
}elseif(is_single($post)){
	$vanderweb_content_type = 'post';
}else{
	$vanderweb_content_type = 'custom';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
<head>
    <?php do_action ( 'vanderweb_top_header' ); ?>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (!is_plugin_active('wordpress-seo/wp-seo.php')) { ?>
	<meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
	<?php } ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php do_action ( 'vanderweb_meta_header' ); ?>
    <?php wp_head(); ?>
    <?php do_action ( 'vanderweb_bottom_header' ); ?>
    <?php do_action ( 'vanderweb_scripts_header' ); ?>
</head>
<body class="vanderweb-content-type-<?php echo $vanderweb_content_type; ?>">
<?php do_action ( 'vanderweb_scripts_bodytop' ); ?>
<div class="vanderweb-wrapper">
	<?php do_action ( 'vanderweb_header' ); ?>
	
	<?php do_action ( 'vanderweb_body_top' ); ?>
	<?php do_action ( 'vanderweb_before_contentsection' ); ?>
	<?php do_action ( 'vanderweb_before_contentsection_custom' ); ?>
	<?php do_action ( 'vanderweb_site_top' ); ?>
	
	<!-- start content container -->
	<?php do_action ( 'vanderweb_content_wrap_top' ); ?>