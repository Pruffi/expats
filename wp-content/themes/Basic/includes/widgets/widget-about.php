<?php class AboutMeWidget extends WP_Widget
{
    function AboutMeWidget(){
		$widget_ops = array('description' => 'Displays About Me Information');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET About Me Widget',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'About Me' : esc_html( $instance['title'] ));
		$imagePath = empty($instance['imagePath']) ? '' : $instance['imagePath'];
		$aboutText = empty($instance['aboutText']) ? '' : $instance['aboutText'];
		$aboutLink = empty($instance['aboutLink']) ? '' : $instance['aboutLink'];

?>
	
<div id="about">
	<h2><?php echo $title; ?></h2>
	<div id="about-content">
        <div id="about-image-border">
			<img src="<?php echo et_new_thumb_resize( et_multisite_thumbnail($imagePath), 68, 68, '', true ); ?>" id="about-image" alt="about us image" />
		</div>
		<?php echo wp_kses_post($aboutText); ?>
		<?php if ($aboutLink <> '') { ?>
			<a href="<?php echo esc_url($aboutLink); ?>" rel="bookmark" class="readmore"><img src="<?php echo get_template_directory_uri(); ?>/images/readmore-about.gif" alt="read more" style="border: none;" /></a>
		<?php } ?>
	</div>
	<img src="<?php bloginfo('template_directory'); ?>/images/about-bottom-<?php echo esc_attr(get_option('basic_color_scheme')); ?>.gif" alt="about bottom" style="float: left;" />
	<div class="clearfix"></div>
</div> <!-- end about me section -->
<?php
		
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = esc_html($new_instance['title']);
		$instance['imagePath'] = esc_url($new_instance['imagePath']);
		$instance['aboutText'] = $new_instance['aboutText'];
		$instance['aboutLink'] = esc_url($new_instance['aboutLink']);

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'About Me', 'imagePath'=>'', 'aboutText'=>'', 'aboutLink'=>'') );

		$title = $instance['title'];
		$imagePath = $instance['imagePath'];
		$aboutText = $instance['aboutText'];
		$aboutLink = $instance['aboutLink'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" /></p>';
		# Image
		echo '<p><label for="' . $this->get_field_id('imagePath') . '">' . 'Image:' . '</label><textarea cols="20" rows="2" class="widefat" id="' . $this->get_field_id('imagePath') . '" name="' . $this->get_field_name('imagePath') . '" >'. esc_textarea($imagePath) .'</textarea></p>';	
		# About Text
		echo '<p><label for="' . $this->get_field_id('aboutText') . '">' . 'Text:' . '</label><textarea cols="20" rows="5" class="widefat" id="' . $this->get_field_id('aboutText') . '" name="' . $this->get_field_name('aboutText') . '" >'. esc_textarea($aboutText) .'</textarea></p>';
		# About Page Link
		echo '<p><label for="' . $this->get_field_id('aboutLink') . '">' . 'About Page url:' . '</label><textarea cols="20" rows="5" class="widefat" id="' . $this->get_field_id('aboutLink') . '" name="' . $this->get_field_name('aboutLink') . '" >'. esc_textarea($aboutLink) .'</textarea></p>';
	}

}// end AboutMeWidget class

function AboutMeWidgetInit() {
  register_widget('AboutMeWidget');
}

add_action('widgets_init', 'AboutMeWidgetInit');

?>