<?php
load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );
////////////////////////////////////////////////////////////////////
// PhP Code Widget
////////////////////////////////////////////////////////////////////
class PHP_Code_Widget extends WP_Widget {
	function __construct() {
		load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );
		$widget_ops = array('classname' => 'widget_execphp', 'description' => __('Arbitrary text, HTML, or PHP Code', 'vanderweb'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('execphp', __('PHP Code Widget', 'vanderweb'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			ob_start();
			eval('?>'.$text);
			$text = ob_get_contents();
			ob_end_clean();
			?>
			<div class="execphpwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'vanderweb4'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.', 'vanderweb4'); ?></label></p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("PHP_Code_Widget");'));

////////////////////////////////////////////////////////////////////
// Spacer Widget
////////////////////////////////////////////////////////////////////
class spacerwidget extends WP_Widget {
     
	function __construct() {
		load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );
		$widget_ops = array( 'classname' => 'spacer-widget', 'description' => __('A Empty Spacer Module without content', 'vanderweb') );
		$control_ops = array( 'width' => 450, 'height' => 250, 'id_base' => 'spacerwidget' );
		parent::__construct('spacerwidget', __('Spacer Widget', 'vanderweb'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

		echo $before_widget;

		echo $after_widget;
	}
     
    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'vanderweb'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
} //end class
function spacerwidget_load() { register_widget( 'spacerwidget' ); } /* Function that registers our widget. */
add_action( 'widgets_init', 'spacerwidget_load' ); /* Add our function to the widgets_init hook. */

////////////////////////////////////////////////////////////////////
// Shortcode Widget
////////////////////////////////////////////////////////////////////
class vanderwebshortcodewidget extends WP_Widget {
     
	function __construct() {
		load_theme_textdomain( 'vanderweb', get_template_directory() . '/languages' );
		$widget_ops = array( 'classname' => 'vanderweb_shortcode_widget', 'description' => __('Shortcode Wiget', 'vanderweb') );
		$control_ops = array( 'width' => 450, 'height' => 250, 'id_base' => 'vanderwebshortcodewidget' );
		parent::__construct('vanderwebshortcodewidget', __('Shortcode Widget', 'vanderweb'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'vanderweb_shortcode_widget', $instance['text'], $instance );
		echo $before_widget;
		
		echo do_shortcode($text);
		
		echo $after_widget;
	}
     
    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);

		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = strip_tags($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'vanderweb'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Shortcode:', 'vanderweb'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>" /></p>
<?php
	}
} //end class
function vanderwebshortcodewidget_load() { register_widget( 'vanderwebshortcodewidget' ); } /* Function that registers our widget. */
add_action( 'widgets_init', 'vanderwebshortcodewidget_load' ); /* Add our function to the widgets_init hook. */


////////////////////////////////////////////////////////////////////
// Custom ACF Widget
////////////////////////////////////////////////////////////////////
if(!class_exists('VanderwebCustomAcfWidget')) {
  class VanderwebCustomAcfWidget extends WP_Widget {
    /**
    * Sets up the widgets name etc
    */
    public function __construct() {
      $widget_ops = array(
        'classname' => 'vander_custom_acf_widget',
        'description' => 'Custom Widget used with ACF',
      );
      parent::__construct( 'vander_custom_acf_widget', 'Custom ACF Widget', $widget_ops );
    }
    /**
    * Outputs the content of the widget
    *
    * @param array $args
    * @param array $instance
    */
    public function widget( $args, $instance ) {
      // outputs the content of the widget
      if ( ! isset( $args['widget_id'] ) ) {
        $args['widget_id'] = $this->id;
      }
      // widget ID with prefix for use in ACF API functions
      $widget_id = 'widget_' . $args['widget_id'];
      $title = apply_filters('widget_title', $instance['title']);
      echo $args['before_widget'];
      if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      }
      echo '<div class="vander-custom-acf-content">';
      do_action('vander_custom_acf_contenthook', $widget_id);
      echo '</div>';

      echo $args['after_widget'];     
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
    	// outputs the options form on admin
        $defaults = array ( 'title' => __('', 'vander'));
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titel','vander'); ?>:</label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
    </p>
    <?php
    }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
    	// processes widget options to be saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
  }
}
if (class_exists('ACF')) {
  function register_vander_custom_acf_widget(){
    register_widget( 'VanderwebCustomAcfWidget' );
  }
  add_action( 'widgets_init', 'register_vander_custom_acf_widget' );
}

////////////////////////////////////////////////////////////////////
// Code for Action Hook. Custom ACF Widget
////////////////////////////////////////////////////////////////////
function vander_widget_acf($widget_id) {
  // Custom Code here - Start
  
  
  
  // Custom Code here - End
}
//add_action('vander_custom_acf_contenthook', 'vander_widget_acf', 10, 1);