<?php
////////////////////////////////////////////////////////////////////
// Above the Loop
////////////////////////////////////////////////////////////////////
function vanderweb_contentabove() {
	if (is_active_sidebar( 'content-above' )) { ?>
	<div id="vanderweb-contentabove">
		<?php dynamic_sidebar( 'content-above' ); ?>
	</div>
	<?php }
}
add_action( 'vanderweb_above_loop' , 'vanderweb_contentabove', 5 );

function vanderweb_pageheader() {
	global $post;
	$pageheaderhide = get_post_meta($post->ID, 'vanderweb_toggle_title', true);
	if ( (is_page() || is_singular('page') ) AND !$pageheaderhide) {
		echo '<div class="page-header-title"><h1 class="page-title">';
		echo the_title();
		echo '</h1></div>';
	}
}
add_action( 'vanderweb_pagecontent_above' , 'vanderweb_pageheader', 10 );
function vanderweb_postheader() {
	if ( is_singular('post')) {
		echo '<div class="post-header-title"><h1 class="post-title">';
		echo the_title();
		echo '</h1></div>';
	}
}
add_action( 'vanderweb_single_postcontent_above' , 'vanderweb_postheader', 5 );

function vanderweb_categoryheader() {
    $category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
    if ( (is_category() || is_archive()) AND !is_search()) {
		echo '<div class="category-header-title"><h1 class="cat-title">';
		echo single_cat_title(); 
		echo '</h1></div>';
	}elseif(is_search()){
        echo '<div class="category-header-title"><h1 class="cat-title">';
		echo ( __('Søge resultater', 'vanderweb' ));
		echo '</h1></div>';
    }
}
add_action( 'vanderweb_above_loop' , 'vanderweb_categoryheader', 15 );

function vanderweb_categorydescription() {
    if ( (is_category() || is_archive())) {
		 echo '<div class="category-header-description">';
		 echo category_description();
		 echo '</div>';
	}; 
}
add_action( 'vanderweb_above_loop' , 'vanderweb_categorydescription', 20 );

////////////////////////////////////////////////////////////////////
// The Loop
////////////////////////////////////////////////////////////////////
function vanderweb_loop_page() {
    global $post;
    if ( is_singular('page') ||  is_singular('post')) :
        if ( have_posts()) : while ( have_posts() ) : the_post();
            ?>
            <article <?php post_class(); ?>>	    	
                <?php
                if (is_singular('page')){
                    do_action ( 'vanderweb_pagecontent_above' );
                }elseif(is_singular('post')){
                    do_action ( 'vanderweb_single_postcontent_above' );
                }
                ?> 
                <div class="vanderweb-content-row row">
                    <?php
                    if (is_singular('post')){
                       do_action ( 'vanderweb_single_postmeta' ); 
                    }
                    ?>
                    <div class="vanderweb-content-col col">
                    <?php
                    do_action ( 'vanderweb_col_top' );
                    if (is_singular('page') ) {
						// split content into array
						$content = split_content();			
						// output first content section in column1
						echo '<div id="page-column1" class="page-column">', array_shift($content), '</div>';			
						// output remaining content sections in column2
						echo '<div id="page-column2" class="page-column">', implode($content), '</div>';
					} else {
						the_content();
					}
                    do_action ( 'vanderweb_col_bottom' );
                    ?>
                    </div>
                </div>
                <?php
                if (is_singular('page')){
                    do_action ( 'vanderweb_pagecontent_below' );
                }elseif(is_singular('post')){
                    do_action ( 'vanderweb_single_postcontent_below' );
                }
                ?>
            </article>  	    
            <?php
            endwhile; // theloop end	
            echo posts_nav_link();
        else:					
            if ( is_404() ) {
                do_action ( 'vanderweb_error_loop' );
            }
        endif; // have_posts end
	elseif(is_singular() AND !is_singular('page') AND  !is_singular('post')):
		do_action ( 'vanderweb_singular_content' );
    endif; // is page or post end
}
add_action( 'vanderweb_the_loop' , 'vanderweb_loop_page', 5 );

function vanderweb_single_postmeta() {
    global $post;
    
    echo '<div class="infosidebar col-12 info-top">';
		// Featured Image
		if ( has_post_thumbnail() ) :
		$postfeaturedimg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false );
		echo "<div class='post-image' style='background-image: url(&#039;".$postfeaturedimg[0]."&#039;); background-size: cover; background-position: center;'>";
		echo '<img class="img-fluid" src="'.get_template_directory_uri().'/images/blank-480x480.png" alt="" />';
		echo '</div>';
		endif;
		// Author
		echo '<div class="vanderwebmetaauthor">';
		the_author();
		echo '</div>';
		// Date
		echo '<div class="vanderwebmetadate">'.the_time().'</div>';
		do_action ( 'vanderweb_single_postmeta_inside' );
    echo '</div>';
}
add_action( 'vanderweb_single_postmeta' , 'vanderweb_single_postmeta' );

function vanderweb_loop_posts() {
	if ( is_category() || is_home() || is_search() || is_tag() ) {
        echo '<div class="vanderweb-category">';
		if(is_search()){echo '<div class="search-results col-12"><ul>';}
        if ( have_posts()) : while ( have_posts() ) : the_post();

        if(is_search()){
            $cats = array();
            foreach (get_the_category($post_id) as $c) {
                $cat = get_category($c);
                array_push($cats, $cat->name);
            }
            if (sizeOf($cats) > 0) {
                $post_categories = ' ('.implode(', ', $cats).')';
            } else {
                $post_categories = '';
            }
            ?>
            <li <?php post_class(); ?>><a class="searchresult-list" href="<?php the_permalink(); ?>">
            <?php echo get_the_title(); ?>
            <?php echo $post_categories; ?>
            </a></li>
            <?php
        }else{
			do_action ( 'vanderweb_postcategory_layout_1' );  
        }
        endwhile; // theloop end	
                echo posts_nav_link();
            else:					
                if ( is_404() ) {
                    do_action ( 'vanderweb_error_loop' );
                }
        endif; // have_posts end
        if(is_search()){echo '</ul>';}
        echo '</div>';
    }elseif(is_archive() AND !is_category() AND !is_home() AND !is_search() AND !is_tag()){
		
		if ( have_posts()) : while ( have_posts() ) : the_post();
		do_action ( 'vanderweb_archive_content' );
		endwhile; // theloop end
		endif; // have_posts end
	}
}
add_action( 'vanderweb_the_loop' , 'vanderweb_loop_posts', 10 );

function vanderweb_postcat_blog() {
    global $post;
    $allClasses = get_post_class();
    foreach ($allClasses as $class) { $catclasss .= ' '.$class; }
	?>	
    <article class="row infosidebar-row<?php echo $catclasss; ?>">                           
        <div class="col-12 col-md-3 infosidebar">
            <?php
            if ( has_post_thumbnail()) :
            $catblogimg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false );
            ?>
            <div class="categorypost-image" style="background-image: url('<?php echo $catblogimg[0]; ?>'); background-size: cover;">
                <p><img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/blank-480x480.png" alt="" /></p>
            </div>
            <?php endif; ?>
			<p class="vanderwebmetaauthor">
			<?php the_author(); ?>
			</p>
            <p class="vanderwebmetadate">
			<?php the_time(); ?>
			</p>
            <?php do_action ( 'vanderweb_blog_infosidebar' ); ?>
        </div>
        <div class="col-12 col-md content-right">
            <h3 class="page-header"><?php the_title() ;?></h3>
            <?php do_action ( 'vanderweb_blog_content_above' ); ?>
            <?php
			if( strpos( $post->post_content, '<!--more-->' )) {
				$content_arr = get_extended ( $post->post_content );
				echo $content_arr['main'].'...';
				echo '<div class="post-readmore"><a class="readmore-link" href="'.get_the_permalink().'">'.__('Læs mere','vanderweb').'</a></div>';
			}else{
				the_content();
			}
			?>
            
            <?php do_action ( 'vanderweb_blog_content_below' ); ?>
            <?php wp_link_pages(); ?>
            <?php  if ( comments_open() ) : ?>
                   <div class="clear"></div>
                  <p class="text-right">
                      <a class="btn btn-success" href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Skriv en kommentar','vanderweb'), __('1 kommentar','vanderweb'), '%' . __(' kommentarer','vanderweb') );?> <span class="glyphicon glyphicon-comment"></span></a>
                  </p>
            <?php endif; ?>
        </div> 
    </article>	
    <?php
}
add_action( 'vanderweb_postcategory_layout_1' , 'vanderweb_postcat_blog' );

function vanderweb_postcat_catalog() {
    global $post;
    $allClasses = get_post_class();
    foreach ($allClasses as $class) { $catclasss .= ' '.$class; }
    
    ?>
    <a class="catalog-box col-12 col-md-4 <?php echo $catclasss; ?>" href="<?php the_permalink(); ?>">
    <div class="catalog-box-inner">  
    <?php do_action ( 'vanderweb_catalog_content_1' ); ?>
    <?php if ( has_post_thumbnail()) : ?>
    <?php
    $catcatalogimg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false );
    ?>
    <div class="categorypost-image" style="background-image: url('<?php echo $catcatalogimg[0]; ?>'); background-size: cover">
        <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/images/blank-480x480.png" alt="" />
        <div class="clear"></div>
    </div>
    <?php endif; ?>  
    <div class="page-header-below-image"><h3 class="page-header"><?php the_title() ;?></h3></div>  
    <?php do_action ( 'vanderweb_catalog_content_2' ); ?>
	<?php do_action ( 'certa_catlayout4_content_2' ); ?>
    <div class="categorypost-content">
        <?php do_action ( 'vanderweb_catalog_content_3' ); ?>
        <?php
		if( strpos( $post->post_content, '<!--more-->' )) {
			$content_arr = get_extended ( $post->post_content );
			echo $content_arr['main'].'...';
			if($acf_cat_catalog_text['acf_cat_catalog_boxlink'] != 1){
				echo '<div class="post-readmore"><a class="readmore-link" href="'.get_the_permalink().'">'.__('Læs mere','vanderweb').'</a></div>';
			}  
		}else{
			the_content();
		}
		?>
    </div>
    <?php do_action ( 'vanderweb_catalog_content_4' ); ?>
    </div>
    </a> 
    <?php
}
//add_action( 'vanderweb_postcategory_layout_1' , 'vanderweb_postcat_catalog' );
////////////////////////////////////////////////////////////////////
// Below the Loop
////////////////////////////////////////////////////////////////////

function vanderweb_singlepost_wplinkspages() {
	global $post;
    
    if(is_single($post)){
        echo '<div class="vanderweb-pagination">';
        echo wp_link_pages();
        echo '</div>';
        if(comments_open()){
            comments_template();
        }
    }   
}
add_action( 'vanderweb_below_loop' , 'vanderweb_singlepost_wplinkspages', 5 );

function vanderweb_contentbelow() {
    if (is_active_sidebar( 'content-below' )) { ?>
	<div id="vanderweb-contentbelow">
		<?php dynamic_sidebar( 'content-below' ); ?>
	</div>
	<?php }
}
add_action( 'vanderweb_below_loop' , 'vanderweb_contentbelow', 10 );

////////////////////////////////////////////////////////////////////
// Sidebars
////////////////////////////////////////////////////////////////////
function vanderweb_leftsidebarwidgets() {
    if ( is_active_sidebar( 'left-sidebar' ) ) {
		$leftsize = get_theme_mod('vanderweb_left_size', 'col-md-3');
		?>
	    <aside class="col-12 order-md-first vanderweb-left <?php echo $leftsize; ?>">
            <?php do_action ( 'vanderweb_leftsidebar_abovewidget' ); ?>
		    <?php dynamic_sidebar( 'left-sidebar' ); ?>
		    <?php do_action ( 'vanderweb_leftsidebar_belowwidget' ); ?>
		</aside>
	<?php };
}
add_action( 'vanderweb_right_sidebar' , 'vanderweb_leftsidebarwidgets', 5 );

function vanderweb_rightsidebarwidgets() {
    if ( is_active_sidebar( 'right-sidebar' ) ) {
		$rightsize = get_theme_mod('vanderweb_right_size', 'col-md-3');
		?>
	    <aside class="col-12 vanderweb-right <?php echo $rightsize; ?>">
			<?php do_action ( 'vanderweb_rightsidebar_abovewidget' ); ?>
		    <?php dynamic_sidebar( 'right-sidebar' ); ?>
		    <?php do_action ( 'vanderweb_rightsidebar_belowwidget' ); ?>
		</aside>
	<?php };
}
add_action( 'vanderweb_right_sidebar' , 'vanderweb_rightsidebarwidgets', 10 );

////////////////////////////////////////////////////////////////////
// Loop error - No results and errors
////////////////////////////////////////////////////////////////////
function vanderweb_loop_error() {
    echo '<h3>';
    if (is_404()) {	
		_e('Siden blev ikke fundet!','vanderweb');
	}elseif(is_search()) {
		_e('Ingen resultater fundet!','vanderweb');	
    }
    echo '</h3>';
}
add_action( 'vanderweb_error_loop' , 'vanderweb_loop_error', 5 );