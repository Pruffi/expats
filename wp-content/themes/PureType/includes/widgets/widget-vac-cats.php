<?php class VacCatsWidget extends WP_Widget
{
	function __construct(){
		$widget_ops = array( 'description' => __('Display vacancy categories') );
		parent::__construct( false, $name='Vacancy Categories', $widget_ops );
	}

	/* Displays the Widget in the front-end */
	function widget( $args, $instance ){
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Adsense' : esc_html( $instance['title'] ) );
		$adsenseCode = empty( $instance['adsenseCode'] ) ? '' : $instance['adsenseCode'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<div style="overflow: hidden;">
			<?php echo $adsenseCode; ?>
			<div class="clearfix"></div>
		</div> <!-- end adsense -->
	<?php
		echo $after_widget;
	}

	/*Saves the settings. */
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adsenseCode'] = current_user_can('unfiltered_html') ? $new_instance['adsenseCode'] : stripslashes( wp_filter_post_kses( addslashes($new_instance['adsenseCode']) ) );

		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
	function form( $instance ){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'Adsense', 'adsenseCode'=>'' ) );

		$title = esc_attr( $instance['title'] );
		$adsenseCode = esc_textarea( $instance['adsenseCode'] );
		
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Adsense Code
		echo '<p><label for="' . $this->get_field_id('adsenseCode') . '">' . 'Adsense Code:' . '</label><textarea cols="20" rows="12" class="widefat" id="' . $this->get_field_id('adsenseCode') . '" name="' . $this->get_field_name('adsenseCode') . '" >'. $adsenseCode .'</textarea></p>';	
	}

}// end AdsenseWidget class

function VacCatsWidgetInit() {
	register_widget('VacCatsWidget');
}

add_action('widgets_init', 'VacCatsWidgetInit'); ?>