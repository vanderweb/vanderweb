<?php

load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );

////////////////////////////////////////////////////////////////////
// Adds Custom Post Type.
////////////////////////////////////////////////////////////////////
function vanderweb_slides_post_types() {
	$labels = array(
		'name'               => __( 'Slider and Gallery', 'vanderweb' ),
		'singular_name'      => __( 'Slider and Gallery', 'vanderweb' ),
		'menu_name'          => __( 'Slider and Gallery', 'vanderweb' ),
		'name_admin_bar'     => __( 'Slider and Gallery', 'vanderweb' ),
		'add_new'            => __( 'Add new', 'vanderweb' ),
		'add_new_item'       => __( 'Add new image', 'vanderweb' ),
		'new_item'           => __( 'New image', 'vanderweb' ),
		'edit_item'          => __( 'Edit image', 'vanderweb' ),
		'view_item'          => __( 'Show', 'vanderweb' ),
		'all_items'          => __( 'Slider and Gallery', 'vanderweb' ),
		'search_items'       => __( 'Search images', 'vanderweb' ),
		'parent_item_colon'  => __( 'Parent images:', 'vanderweb' ),
		'not_found'          => __( 'No images found.', 'vanderweb' ),
		'not_found_in_trash' => __( 'No trashed images found.', 'vanderweb' )
	);

	$args = array( 
		'public'      => false, 
		'labels'      => $labels,
  'has_archive' => false,
		'description' => __( 'Slider and Gallery', 'vanderweb' ),
  'show_ui'	        => true,
  'show_in_admin_bar' => true,
		'menu_position' => 25.2,
		'menu_icon' => 'dashicons-id',
  'taxonomies' => array( 'vanderweb_slides_cats' ),
  'exclude_from_search' => true,
  'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' )
	);
    	register_post_type( 'vanderweb_slides', $args );
}
add_action( 'init', 'vanderweb_slides_post_types' );

////////////////////////////////////////////////////////////////////
// Adds Custom Category.
////////////////////////////////////////////////////////////////////
function create_vanderweb_slides_taxonomy() {
	$labels = array(
		'name'                           => __( 'Slider and Gallery - Categories', 'vanderweb' ),
		'singular_name'                  => __( 'Slider and Gallery - Categories', 'vanderweb' ),
		'search_items'                   => __( 'Search Categories', 'vanderweb' ),
		'all_items'                      => __( 'All Categories', 'vanderweb' ),
		'edit_item'                      => __( 'Edit Category', 'vanderweb' ),
		'update_item'                    => __( 'Update Category', 'vanderweb' ),
		'add_new_item'                   => __( 'Add new Category', 'vanderweb' ),
		'new_item_name'                  => __( 'New Category Name', 'vanderweb' ),
		'menu_name'                      => __( 'Categories', 'vanderweb' ),
		'view_item'                      => __( 'Show Category', 'vanderweb' ),
		'popular_items'                  => __( 'Popular Categories', 'vanderweb' ),
		'separate_items_with_commas'     => __( 'Seperate Categories with commas', 'vanderweb' ),
		'add_or_remove_items'            => __( 'Add or Remove Categories', 'vanderweb' ),
		'choose_from_most_used'          => __( 'Select from the mosu used Categories', 'vanderweb' ),
		'not_found'                      => __( 'No Categories found', 'vanderweb' )
	);
	$args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_admin_column' => true
	);
    register_taxonomy( 'vanderweb_slides_cats', array( 'vanderweb_slides' ), $args );
}
add_action( 'init', 'create_vanderweb_slides_taxonomy', 0 );

////////////////////////////////////////////////////////////////////
// Custom Meta Box and Fields
////////////////////////////////////////////////////////////////////
function vanderweb_slides_add_custom_box(){
	$screens = ['vanderweb_slides'];
	foreach ($screens as $screen) {
		add_meta_box(
			'vanderweb_slides_box_id',           // Unique ID
			__( 'Link', 'vanderweb' ), // Box title
			'vanderweb_slides_box_html',  // Content callback, must be of type callable
			$screen,                   // Post type
			'advanced', // Context: normal, advanced, or side
			'high' // Priority: high, core, default, or low
		);
	}
}
add_action('add_meta_boxes', 'vanderweb_slides_add_custom_box');

function vanderweb_slides_box_html($post){
	$value_link = get_post_meta($post->ID, '_vanderweb_link_meta_key', true);
	$value_linktarget = get_post_meta($post->ID, '_vanderweb_linktarget_meta_key', true);
	?>
	<label for="vanderweb_link_field"><?php echo __( 'Link', 'vanderweb' )?></label><br />
 <input type="text" name="vanderweb_link_field" id="vanderweb_link_field" value="<?php if ( isset ( $value_link ) ) echo $value_link; ?>" />
	<br /><br />
	<label for="vanderweb_linktarget_field"><?php echo __( 'Link Target', 'vanderweb' )?></label><br />
	<select name="vanderweb_linktarget_field" id="vanderweb_linktarget_field" class="postbox">
		<option value="">Samme side</option>
		<option value="_blank" <?php selected($value_linktarget, '_blank'); ?>>Ny side</option>
	</select>
	<?php
}
function vanderweb_slides_save_postdata($post_id){
	
	if (array_key_exists('vanderweb_link_field', $_POST)) {
		update_post_meta( $post_id, '_vanderweb_link_meta_key', sanitize_text_field( $_POST[ 'vanderweb_link_field' ] ) );
	}
	if (array_key_exists('vanderweb_linktarget_field', $_POST)) {
		update_post_meta($post_id, '_vanderweb_linktarget_meta_key', $_POST['vanderweb_linktarget_field']);
	}
}
add_action('save_post', 'vanderweb_slides_save_postdata');

////////////////////////////////////////////////////////////////////
// Subpage
////////////////////////////////////////////////////////////////////
function vanderwebslider_shortcodes_menu() {
	add_submenu_page(
		'edit.php?post_type=vanderweb_slides',
		'Slider and Gallery - Shortcodes',
		'Shortcodes',
		'manage_options',
		'vanderweb-slides-shortcodes',
		'vanderweb_slides_shortcodes'
	);
}
add_action( 'admin_menu', 'vanderwebslider_shortcodes_menu' );

function vanderweb_slides_shortcodes() {
	if ( !current_user_can( 'manage_options' ) )  {
	 wp_die('You do not have sufficient permissions to access this page.');
	}
	//get our global options
	global $developer_uri;
	$terms = get_terms( array( 
		'taxonomy' => 'vanderweb_slides_cats',
	) );
	$slugs = '';
	$galleries = '';
	if( !empty( $terms ) && !is_wp_error( $terms )){
		foreach( $terms as $term ) {
			$sliders .= '[vanderwebslider slug="'.$term->slug.'"]<br />';
			$galleries .= '[vanderwebgallery slug="'.$term->slug.'"]<br />';
		}
	}else{
		$slugs = '[vanderwebslider slug="your-category-slug"]';
		$galleries = '[vanderwebgallery slug="your-category-slug"]';
	}
	
	// html
	echo '<h1>Slider and Gallery - Shortcodes</h1>';
	echo '<hr />';
	echo '<h3>Slider</h3>';
	echo '<p>';
	echo $sliders;
	echo '</p>';
	echo '<p><b>Shortcode attributes:</b></p>';
	echo '<p>class=""</p>';
	echo '<p>count="50"</p>';
	echo '<p>order="ASC" <br />( ASC, DESC )</p>';
	echo '<p>orderby="menu_order" <br />( none, ID, author, title, name, type, date, modified, parent, rand, menu_order )</p>';
	echo '<p>caption="TRUE"</p>';
	echo '<p>captionclass="d-none d-md-block" <br />( left-top, left-center, left-bottom, right-top, right-center, right-bottom, center-top, center-bottom )</p>';
	echo '<p>speed="5000"</p>';
	echo '<p>transition="carousel-fade"</p>';
	echo '<p>bullets="TRUE"</p>';
	echo '<p>arrows="TRUE"</p>';
	echo '<hr />';
	echo '<h3>Gallery</h3>';
	echo '<p>';
	echo $galleries;
	echo '</p>';
	echo '<p><b>Shortcode attributes:</b></p>';
	echo '<p>class=""</p>';
	echo '<p>count="50"</p>';
	echo '<p>order="ASC" <br />( ASC, DESC )</p>';
	echo '<p>orderby="menu_order" <br />( none, ID, author, title, name, type, date, modified, parent, rand, menu_order )</p>';
	echo '<p>caption="FALSE"</p>';
	echo '<p>cols="col-6 col-lg-4"</p>';
	echo '<p>imagessize="480x480" <br />( 320x480, 360x480, 480x320, 480x360, 480x480 )</p>';
	echo '<p>imagesfill="auto"</p>';
	echo '<p>quality="medium" <br />( small, medium, large, full )</p>';
	echo '<p>linkmode="fancybox" <br />( fancybox, url )</p>';
}

////////////////////////////////////////////////////////////////////
// Shortcodes
////////////////////////////////////////////////////////////////////

// [vanderwebslider]
function vanderwebslider_func( $atts ){
 $a = shortcode_atts( array(
  'slug' => '',
  'class' => '',
  'count' => 50,
  'order' => 'ASC', // ASC, DESC
  'orderby' => 'menu_order', // none, ID, author, title, name, type, date, modified, parent, rand, menu_order, 
  'speed' => 5000,
  'transition' => 'carousel-fade',
		'bullets' => 'TRUE',
		'arrows' => 'TRUE',
		'caption' => 'TRUE',
		'captionclass' => 'd-none d-md-block', // left-top, left-center, left-bottom, right-top, right-center, right-bottom, center-top, center-bottom
	), $atts );
 $slug = $a['slug'];
 $class = $a['class'];
 $count = $a['count'];
 $order = $a['order'];
 $orderby = $a['orderby'];
 $speed = $a['speed'];
 $transition = $a['transition'];
	$bullets = $a['bullets'];
	$arrows = $a['arrows'];
	$caption = $a['caption'];
	$captionclass = $a['captionclass'];
 
 $args = array(
  'tax_query' => array(
   array(
    'taxonomy' => 'vanderweb_slides_cats',
    'field' => 'slug',
    'terms' => array( $slug )
   ),
  ),
  'post_type' => 'vanderweb_slides',
  'order' => $order,
  'orderby' => $orderby,
  'posts_per_page' => $count
 );
 
 $slider_loop = new WP_Query($args);
 $sliderhtml = '';
 $i= 0 ;
 $slide_count = $slider_loop->found_posts;
 
 if ( $slider_loop->have_posts() ):
  $sliderhtml .= '<div id="vanderweb-slider-bs4-'.$slug.'" class="carousel '.$transition.' slide vanderweb-slider-bs4 '.$class.' slide-total-'.$slide_count.'" data-ride="carousel" data-interval="'.$speed.'" data-pause="hover">';
		$sliderhtml .= '<div class="vanderweb-slider-bs4-inner carousel-inner">';
  while( $slider_loop->have_posts() ){
   $slider_loop->the_post();
   $title = get_the_title();
			$desc = get_the_content();
			$meta_slider_link = get_post_meta(get_the_ID(), '_vanderweb_link_meta_key', true);
			$meta_slider_linktarget = get_post_meta(get_the_ID(), '_vanderweb_linktarget_meta_key', true);
   $post_image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
 
   if($i == 0) {
    $activeslide = 'active';
   }else{
    $activeslide = '';
   }
   $carousel_indicators .= '<li data-target="#vanderweb-slider-bs4-'.$slug.'" data-slide-to="'.$i.'" class="'.$activeslide.'"></li>';
   // Item - Start
   $sliderhtml .= "<a class='vanderweb-slider-bs4-slide slide-number-".$i." carousel-item ".$activeslide."' href='".$meta_slider_link."' target='".$meta_slider_linktarget."' title='".$title."' style='background-image: url(&#039;".$post_image_src[0]."&#039;);'>";
			if(!empty($desc) AND $caption == 'TRUE'){
				$sliderhtml .= '<div class="vanderweb-slider-bs4-caption '.$captionclass.'">';
					$sliderhtml .= '<div class="vanderweb-slider-bs4-caption-inner">'.$desc.'</div>';
				$sliderhtml .= '</div>';
			}
   $sliderhtml .= '</a>'; // .vanderweb-slider-bs4-slide
   // Item - End
   $i++;
  }
  wp_reset_query();
		wp_reset_postdata();
  $sliderhtml .= '</div>'; // .vanderweb-slider-bs4
		
		// Arrows - Start
		if($slide_count != 1 AND $arrows == 'TRUE'){
		$sliderhtml .= '<a class="carousel-control-prev" href="#kumento-slider-bs4-'.$slug.'" role="button" data-slide="prev">';
			$sliderhtml .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
			$sliderhtml .= '<span class="sr-only">Previous</span>';
		$sliderhtml .= '</a>';
		$sliderhtml .= '<a class="carousel-control-next" href="#kumento-slider-bs4-'.$slug.'" role="button" data-slide="next">';
			$sliderhtml .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
			$sliderhtml .= '<span class="sr-only">Next</span>';
		$sliderhtml .= '</a>';
		}
		// Arrows - End
		
  // Bullets - Start
		if($slide_count != 1 AND $bullets == 'TRUE'){
		$sliderhtml .= '<ol class="carousel-indicators">';
			$sliderhtml .= $carousel_indicators;
		$sliderhtml .= '</ol>';
		}
		// Bullets - End
		
  $sliderhtml .= '</div>'; // .vanderweb-slider-bs4-inner
 endif;
 return $sliderhtml;
}
add_shortcode( 'vanderwebslider', 'vanderwebslider_func' );

// [vanderwebgallery]
function vanderwebgallery_func( $atts ){
 $a = shortcode_atts( array(
  'slug' => '',
  'class' => '',
  'count' => 50,
  'order' => 'ASC', // ASC, DESC
  'orderby' => 'menu_order', // none, ID, author, title, name, type, date, modified, parent, rand, menu_order, 
  'cols' => 'col-6 col-lg-4',
  'imagessize' => '480x480', // 320x480, 360x480, 480x320, 480x360, 480x480
		'imagesfill' => 'auto',
		'quality' => 'medium', // small, medium, large, full
		'caption' => 'FALSE',
		'linkmode' => 'fancybox', // fancybox, url
	), $atts );
 $slug = $a['slug'];
 $class = $a['class'];
 $count = $a['count'];
 $order = $a['order'];
 $orderby = $a['orderby'];
 $cols = $a['cols'];
 $imagessize = $a['imagessize'];
	$imagesfill = $a['imagesfill'];
	$quality = $a['quality'];
	$caption = $a['caption'];
	$linkmode = $a['linkmode'];
 
 $args = array(
  'tax_query' => array(
   array(
    'taxonomy' => 'vanderweb_slides_cats',
    'field' => 'slug',
    'terms' => array( $slug )
   ),
  ),
  'post_type' => 'vanderweb_slides',
  'order' => $order,
  'orderby' => $orderby,
  'posts_per_page' => $count
 );
	
 $gallery_loop = new WP_Query($args);
 $galleryhtml = '';
 
 if ( $gallery_loop->have_posts() ):
		$galleryhtml .= '<div id="vanderweb-gallery-'.$slug.'" class="vanderweb-gallery '.$class.'">';
		$galleryhtml .= '<div class="vanderweb-gallery-row row">';
		
		while( $gallery_loop->have_posts() ){
   $gallery_loop->the_post();
   $title = get_the_title();
			$desc = get_the_content();
			$stripped_desc = strip_tags($desc, '<br>');
			$meta_gallery_link = get_post_meta(get_the_ID(), '_vanderweb_link_meta_key', true);
			$meta_gallery_linktarget = get_post_meta(get_the_ID(), '_vanderweb_linktarget_meta_key', true);
   $post_image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
			$thumb_image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $quality, false );
			if ($linkmode == 'fancybox'){
				$imagelinkhtml = "href='".$post_image_src[0]."' class='vanderweb-gallery-link fancybox' title='".$stripped_desc."'";
			}elseif($linkmode == 'url'){
				$imagelinkhtml = "href='".$meta_gallery_link."' class='vanderweb-gallery-link url' target='".$meta_gallery_linktarget."' title='".$title."'";
			}
   // Item - Start
			$galleryhtml .= '<div class="vanderweb-gallery-col '.$cols.'">';
			$galleryhtml .= "<a ".$imagelinkhtml." rel='gallery-".$slug."' alt='".$title."' style='background-image: url(&#039;".$thumb_image_src[0]."&#039;); background-size: ".$imagesfill.";'>";
			$galleryhtml .= '<img src="'.get_template_directory_uri().'/images/blank-'.$imagessize.'.png" alt="'.$title.'" />';
			$galleryhtml .= '</a>';
			if( ($caption != 'FALSE') AND ($desc != '') ){
				$galleryhtml .= '<div class="vanderweb-gallery-caption">'.$desc.'</div>';
			}
			$galleryhtml .= ' </div>';
   // Item - End
  }
		wp_reset_query();
		wp_reset_postdata();
		$galleryhtml .= '<div class="clear"></div>';
		$galleryhtml .= '</div>';
		$galleryhtml .= '</div>';
 endif;
 return $galleryhtml;
}
add_shortcode( 'vanderwebgallery', 'vanderwebgallery_func' );