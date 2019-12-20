<?php
////////////////////////////////////////////////////////////////////
// Hooks below Content
////////////////////////////////////////////////////////////////////
function vanderweb_content_wrap_bottom() {
				do_action ( 'vanderweb_below_loop' );
				?>
				</div>				
				<?php
				do_action ( 'vanderweb_right_sidebar' );
				?>
			</div>	
		</div>
	</main>
	<?php
}
add_action('vanderweb_content_wrap_bottom', 'vanderweb_content_wrap_bottom');

function vanderweb_section_below_1() {
	if (is_active_sidebar( 'section-below-1' )) {
    ?>
	<section id="vanderweb-section-below-1">
		<div class="container section-below-1-container">
			<div class="row section-below-1-row section-row">
				<?php dynamic_sidebar( 'section-below-1' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_after_contentsection' , 'vanderweb_section_below_1', 5 );
function vanderweb_section_below_2() {
	if (is_active_sidebar( 'section-below-2' )) {
    ?>
	<section id="vanderweb-section-below-2">
		<div class="container section-below-2-container">
			<div class="row section-below-2-row section-row">
				<?php dynamic_sidebar( 'section-below-2' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_after_contentsection' , 'vanderweb_section_below_2', 10 );
function vanderweb_section_below_3() {
	if (is_active_sidebar( 'section-below-3' )) {
    ?>
	<section id="vanderweb-section-below-3">
		<div class="container section-below-3-container">
			<div class="row section-below-3-row section-row">
				<?php dynamic_sidebar( 'section-below-3' ); ?>
			</div>
		</div>
	</section>
	<?php }
}
add_action( 'vanderweb_after_contentsection' , 'vanderweb_section_below_3', 15 );

////////////////////////////////////////////////////////////////////
// Footer Section(Hook located in footer.php)
////////////////////////////////////////////////////////////////////
function vanderweb_footerboxes() {
    if (is_active_sidebar( 'footerboxes' )) {
	?>
	<div id="vanderweb-footerboxes">
		<div class="container footerboxes-container">
			<div class="row footerboxes-row section-row">
				<?php dynamic_sidebar( 'footerboxes' ); ?>
			</div>
		</div>
	</div>
	<?php }
}
add_action( 'vanderweb_footer' , 'vanderweb_footerboxes', 5 );
function vanderweb_footercopyright() {
    if (is_active_sidebar( 'footercopyright' )) {
	?>
	<div id="vanderweb-footercopyright">
		<div class="container footercopyright-container">
			<div class="row footercopyright-row section-row">
				<?php dynamic_sidebar( 'footercopyright' ); ?>
			</div>
		</div>
	</div>
	<?php }
}
add_action( 'vanderweb_footer' , 'vanderweb_footercopyright', 15 );
function vanderweb_tothetop() {
    if(get_option('vanderweb_tothetop') == 'yes'):
	?>
    	 <a href="#" id="vanderweb-tothetopbtn">Top</a>
    	 <script>
			jQuery(document).ready(function(){
			    var offset = 100;
			    var speed = 250;
			    var duration = 500;
				   jQuery(window).scroll(function(){
			            if (jQuery(this).scrollTop() < offset) {
						     jQuery('#vanderweb-tothetopbtn') .fadeOut(duration);
			            } else {
						     jQuery('#vanderweb-tothetopbtn') .fadeIn(duration);
			            }
			        });
				jQuery('#vanderweb-tothetopbtn').on('click', function(){
					jQuery('html, body').animate({scrollTop:0}, speed);
					return false;
					});
			});
		</script>
    <?php
	endif;
}
add_action( 'vanderweb_footer' , 'vanderweb_tothetop', 20 );