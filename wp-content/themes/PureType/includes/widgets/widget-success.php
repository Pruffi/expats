<?php class SuccessWidget extends WP_Widget
{
    function SuccessWidget(){
		$widget_ops = array( 'description' => 'Displays success stories' );
		$control_ops = array( 'width' => 250);
		parent::WP_Widget( false, $name='Success Story Widget', $widget_ops, $control_ops );
    }

    /* Displays the Widget in the front-end */
    function widget( $args, $instance ){
		extract($args);
		$title = apply_filters( 'widget_title', __('success stories', 'PureType') );
                
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title; ?>
		<div class="clearfix">
                <?php
                    $query = new WP_Query('post_type=success_story&posts_per_page=5&orderby=ID&order=DESC');
                    if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                        $thumb = $thumbnail["thumb"];
                ?>
                        <div style="clear: both;"></div>
                        <div>
                            <h5 class="titles">
                                <a style="float: none" href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','PureType'), get_the_title()) ?>">
                                <?php the_title() ?>
                                </a>
                            </h5>
                            <?php if($thumb != '') { ?>
                            <div class="thumbnail-div">
                                <a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','PureType'), get_the_title()) ?>">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
                                </a>
                            </div>
                            <?php }  ?>
                            <div>
                            <?php truncate_post(220) ?>
                            </div>
                        </div>
                <?php }
                } ?>
		</div> <!-- end about me section -->
	<?php
		echo $after_widget;
	}

	/*Saves the settings. */
    function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['count'] = intval($new_instance['count']);
		
		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
    function form( $instance ){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'count'=>10 ) );

		$count = esc_textarea( $instance['count'] );

		# About Text
		echo '<p><label for="' . $this->get_field_id('count') . '">' . 'Count:' . '</label><input type="text" id="' . $this->get_field_id('count') . '" name="' . $this->get_field_name('count') . '" value="' . $count . '"></p>';
	}

}// end AboutMeWidget class

function SuccessWidgetInit() {
	register_widget('SuccessWidget');
}

add_action('widgets_init', 'SuccessWidgetInit'); ?>