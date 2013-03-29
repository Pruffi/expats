<?php class AboutMeWidget extends WP_Widget
{
    function AboutMeWidget()
    {
    		$widget_ops = array( 'description' => 'Displays about us info' );
		$control_ops = array( 'width' => 250);
		parent::WP_Widget( false, $name='About Us Widget', $widget_ops, $control_ops );
    }

    /* Displays the Widget in the front-end */
    function widget( $args, $instance )
    {
  
		extract($args);
                $query = new WP_Query('post_type=about_us&posts_per_page=1&orderby=ID&order=DESC');
                if ($query->have_posts())
                {
                    $query->the_post();
                    $title = apply_filters( 'widget_title', get_the_title());
                    echo $before_widget;
                
                    if ( $title )
                    {
                        echo $before_title . $title . $after_title;
                    }
                
                ?>
                    
		<div class="clearfix">
                <?php
                    
                        $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                        $thumb = $thumbnail["thumb"];
                        
                        //$page = get_page_by_title(__('About'));
                        //$pageUri = get_permalink($page->ID);
                        
                ?>
                        <div style="clear: both;"></div>
                        <div>
                            <?php if($thumb != '') { ?>
                            <div class="thumbnail-div">
                                <!--<a href="<?php echo $pageUri ?>" title="<?php printf(esc_attr__('Permanent Link to %s','PureType'), get_the_title()) ?>">-->
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
                                <!--</a>-->
                            </div>
                            <?php }  ?>
                            <div>
                            <?php truncate_post(220) ?>
                            </div>
                        </div>
                </div> <!-- end about me section -->
                <?php 
                    echo $after_widget;
                } ?>
	<?php
    }

	/*Saves the settings. */
    function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		
		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
    function form( $instance ){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'count'=>10 ) );
	}

}// end AboutMeWidget class

function AboutMeWidgetInit() {
	register_widget('AboutMeWidget');
}

add_action('widgets_init', 'AboutMeWidgetInit'); ?>