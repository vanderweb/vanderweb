<?php
load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );

////////////////////////////////////////////////////////////////////
// Page Settings
////////////////////////////////////////////////////////////////////
add_action("admin_init", "vanderweb_checkbox_init");
function vanderweb_checkbox_init(){  
	add_meta_box("vanderwebmetacontentcheckbox", __( "Settings", "vanderweb" ), "vanderwebmetacontentcheckbox", "page", "side", "low");
}
function vanderwebmetacontentcheckbox(){
	global $post;  
	$custom = get_post_custom($post->ID);
	// Custom Page Class
	$pagecustomclass_id = $custom["pagecustomclass"][0];
	$pagecustomclass_id_value = get_post_meta($post->ID, 'pagecustomclass', true); ?>
	<label><?php echo __('Page Class, seperate with spaces','vanderweb'); ?></label><br />
	<input type="text" name="pagecustomclass" value="<?php echo $pagecustomclass_id_value; ?>" />
    <br /><br />
	<?php
	// Hide Page Titel
	$toggletitle_id = $custom["vanderweb_toggle_title"][0];
	$toggletitle_id_value = get_post_meta($post->ID, 'vanderweb_toggle_title', true);
	if($toggletitle_id_value == "yes") $toggletitle_id_checked = 'checked="checked"'; ?>
	<input type="checkbox" name="vanderweb_toggle_title" value="yes" <?php echo $toggletitle_id_checked; ?> />
	<label><?php echo __('Hide Title Header','vanderweb'); ?></label>
	<br /><br />
	<?php  
	// Hide Content Section Checkbox
	$hidecontentsection_id = $custom["hidecontentsection"][0];
	$hidecontentsection_id_value = get_post_meta($post->ID, 'hidecontentsection', true);
	if($hidecontentsection_id_value == "yes") $hidecontentsection_id_checked = 'checked="checked"'; ?>
	<input type="checkbox" name="hidecontentsection" value="yes" <?php echo $hidecontentsection_id_checked; ?> />
    <label><?php echo __('Hide Content Section','vanderweb'); ?></label>
    <br /><br />
	<?php
}
// Save Meta Details
add_action('save_post', 'save_vanderwebcontentoptions');
function save_vanderwebcontentoptions(){
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	    return $post->ID;
	}
	update_post_meta($post->ID, "vanderweb_toggle_title", $_POST["vanderweb_toggle_title"]);
	update_post_meta($post->ID, "pagecustomclass", $_POST["pagecustomclass"]);
	update_post_meta($post->ID, "hidecontentsection", $_POST["hidecontentsection"]);
}

// Delete Meta Details
add_action('delete_post', 'delete_vanderwebcontentoptions');
function delete_vanderwebcontentoptions(){
	global $post;
	delete_post_meta($post->ID, "vanderweb_toggle_title");
	delete_post_meta($post->ID, "pagecustomclass");
	delete_post_meta($post->ID, "hidecontentsection");
	return $post->ID;
}

////////////////////////////////////////////////////////////////////
// Category Settings
////////////////////////////////////////////////////////////////////
add_action( 'category_edit_form_fields', 'vanderweb_edit_featured_category_field' ); 
function vanderweb_edit_featured_category_field( $term ){
    $term_id = $term->term_id;
    $term_meta = get_option( "taxonomy_$term_id" );         
?>
    <tr class="form-field">
        <th scope="row">
            <label for="term_meta[vanderweblayout]"><?php echo __('Select Category Layout','vanderweb'); ?></label>
            <td>
            	<select name="term_meta[vanderweblayout]" id="term_meta[vanderweblayout]">
                	<option value="1" <?=($term_meta['vanderweblayout'] == 1) ? 'selected': ''?>>Blog Layout</option>
                	<option value="2" <?=($term_meta['vanderweblayout'] == 2) ? 'selected': ''?>>Box Layout</option>
            	</select>               
            </td>
        </th>
    </tr>
<?php
} 
// Save the field  
function vanderweb_save_tax_meta( $term_id ){ 
	if ( isset( $_POST['term_meta'] ) ) { 
		$term_meta = array();
		// Be careful with the intval here. If it's text you could use sanitize_text_field()
		$term_meta['vanderweblayout'] = isset ( $_POST['term_meta']['vanderweblayout'] ) ? intval( $_POST['term_meta']['vanderweblayout'] ) : '';
		// Save the option array.
		update_option( "taxonomy_$term_id", $term_meta );
    } 
} // save_tax_meta
add_action( 'edited_category', 'vanderweb_save_tax_meta', 10, 2 ); 