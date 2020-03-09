<?php
////////////////////////////////////////////////////////////////////
// Hooks in Head
////////////////////////////////////////////////////////////////////
function vanderweb_favicon() {
?>
<link rel="icon" href="<?php echo get_site_icon_url(); ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>" type="image/x-icon" />
<?php
}
add_action( 'vanderweb_meta_header' , 'vanderweb_favicon', 5 );

////////////////////////////////////////////////////////////////////
// Hooks in Header
////////////////////////////////////////////////////////////////////
function vanderweb_topbar() {
    if(is_active_sidebar( 'topbarwidget' )):
    ?>
    <div id="vanderweb-topbar">
        <div class="topbar-container container">
            <div class="topbar-row row justify-content-end">
            <?php
                dynamic_sidebar( 'topbarwidget' );
            ?>
            </div>
        </div>
    </div>
    <?php
    endif;
}
add_action( 'vanderweb_header' , 'vanderweb_topbar', 5 );

function vanderweb_toplogo() {
    if(get_option('vanderweb_headertoogle') == 'logotop'):
    ?>
    <header id="vanderweb-toplogo" class="d-none d-md-block">
        <?php do_action ( 'vanderweb_toplogo_top' ); ?>
        <div class="toplogo-container container">
            <div class="toplogo-row row">
                <?php do_action ( 'vanderweb_toplogo_col_before' ); ?>
                <div class="toplogo-col align-self-center col-auto mr-auto">
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="vanderweb-header-logo-img" src="<?php echo get_header_image(); ?>" alt="logo">
                    </a>
                </div>
                <?php
                if(is_active_sidebar( 'headerwidget' )):
                dynamic_sidebar( 'headerwidget' );
                endif;
                do_action ( 'vanderweb_toplogo_col_after' );
                ?>
            </div>
        </div>
        <?php do_action ( 'vanderweb_toplogo_bottom' ); ?>
    </header>
    <?php
    endif;
}
add_action( 'vanderweb_header' , 'vanderweb_toplogo', 10 );

function vanderweb_mainmenu() {
    ?>
    <nav class="vanderweb-header-nav navbar sticky-top navbar-expand-md">
        <?php do_action ( 'vanderweb_header_top' ); ?>
        <div class="vanderweb-header-container container">
            <div class="vanderweb-header-row row">
                <?php
                do_action ( 'vanderweb_header_before' );
                if(get_option('vanderweb_headertoogle') == 'logomain'):
                ?>
                <div class="vanderweb-header-logo col-auto">
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="vanderweb-header-logo-img" src="<?php echo get_header_image(); ?>" alt="logo">
                    </a>
                </div>
                <?php
                endif;
                ?>
                <div class="vanderweb-header-phone col d-block d-md-none align-self-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only"><?php _e('Toggle navigation','vanderweb'); ?></span>
                    </button>
                </div>
                <div class="vanderweb-header-menu col-12 col-md align-self-center">
                    
                <?php
                do_action ( 'vanderweb_header_menu_before' );

                wp_nav_menu( array(
                    'theme_location'    => 'main_menu',
                    'depth'             => 3,
                    'container'         => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'navbarNavDropdown',
                    'menu_class'      => 'navbar-nav mt-2 mt-sm-0 ml-auto',
                    'fallback_cb'     => 'wp_page_menu',
                    'walker'          => new WP_Bootstrap_Navwalker()
                    )
                );
                do_action ( 'vanderweb_header_menu_after' );
                ?>
                </div>
                <?php
                if(is_active_sidebar( 'headerwidget' )):
                dynamic_sidebar( 'headerwidget' );
                endif;
                do_action ( 'vanderweb_header_after' );
                ?>
            </div>
        </div>
        <?php do_action ( 'vanderweb_header_bottom' ); ?>
    </nav>
    <?php
}
add_action( 'vanderweb_header' , 'vanderweb_mainmenu', 15 );

////////////////////////////////////////////////////////////////////
// Hooks above Content
////////////////////////////////////////////////////////////////////
function vanderweb_hero_section() {
	if (is_active_sidebar( 'herosection' )) {
    ?>
	<section id="vanderweb-hero-section">
		<div class="container hero-section-container">
			<div class="row hero-section-row section-row">
				<?php dynamic_sidebar( 'herosection' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_before_contentsection' , 'vanderweb_hero_section', 15 );

function vanderweb_slider() {
	if (is_active_sidebar( 'slider' ) ) {
	?>
	<section id="vanderweb-slider">
		<div class="container slider-container">
			<?php dynamic_sidebar( 'slider' ); ?>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_before_contentsection' , 'vanderweb_slider', 20 );

function vanderweb_section_above_1() {
	if (is_active_sidebar( 'section-above-1' )) {
    ?>
	<section id="vanderweb-section-above-1">
		<div class="container section-above-1-container">
			<div class="row section-above-1-row section-row">
				<?php dynamic_sidebar( 'section-above-1' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_before_contentsection' , 'vanderweb_section_above_1', 30 );
function vanderweb_section_above_2() {
	if (is_active_sidebar( 'section-above-2' )) {
    ?>
	<section id="vanderweb-section-above-2">
		<div class="container section-above-2-container">
			<div class="row section-above-2-row section-row">
				<?php dynamic_sidebar( 'section-above-2' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_before_contentsection' , 'vanderweb_section_above_2', 35 );
function vanderweb_section_above_3() {
	if (is_active_sidebar( 'section-above-3' )) {
    ?>
	<section id="vanderweb-section-above-3">
		<div class="container section-above-3-container">
			<div class="row section-above-3-row section-row">
				<?php dynamic_sidebar( 'section-above-3' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_before_contentsection' , 'vanderweb_section_above_3', 40 );

function vanderweb_content_wrap_top() {
    global $post;
    $contentclass = '';
    if (get_post_meta($post->ID, 'hidecontentsection', true )){
        $contentclass = 'd-none';
    }
    ?>
    <main id="vanderweb-content" class="<?php echo $contentclass; ?>">
        <div class="container content-container">
            <div class="row content-row">
                <?php do_action ( 'vanderweb_left_sidebar' ); ?>
                <div class="col-12 col-md vanderweb-main">
                <?php
                do_action ( 'vanderweb_above_loop' );
}
add_action('vanderweb_content_wrap_top', 'vanderweb_content_wrap_top', 10);