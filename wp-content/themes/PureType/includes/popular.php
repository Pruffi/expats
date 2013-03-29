<!--Begin Most Commented Articles-->

<span class="headings"><?php esc_html_e('Vacancy categories','PureType') ?></span>
<div class="home-sidebar-box">
    <ul>
<?php

$orderby      = 'name';
$show_count   = 1;      // 1 for yes, 0 for no
$pad_counts   = 1;      // 1 for yes, 0 for no
$hierarchical = 0;      // 1 for yes, 0 for no
$title        = '';
$empty        = 1;

$cat = get_cat_ID(__("All vacancies",'PureType'));

$args = array(
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'hide_empty'   => $empty,
  'child_of'     => (int) $cat
);

wp_list_categories( $args );
?>
    </ul>
</div>
<?php
global $wp_widget_factory;
?>
<?php
$widget_obj = $wp_widget_factory->widgets["WP_Widget_Tag_Cloud"];
?>
<span class="headings"><?php esc_html_e($widget_obj->name,'PureType') ?></span>
<div class="home-sidebar-box">
    <div class="tagcloud">
        <?php wp_tag_cloud( apply_filters('widget_tag_cloud_args', array('taxonomy' => $widget_obj->_get_current_taxonomy()) ) ); ?>
    </div>
</div>
<!--
<?php
$widget_obj = $wp_widget_factory->widgets["WP_Widget_Archives"];
?>

<span class="headings"><?php esc_html_e($widget_obj->name,'PureType') ?></span>
<div class="home-sidebar-box">
<?php
$c = '1';

?>
    <ul>
    <?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c))); ?>
    </ul>
</div>
-->
<?php
//var_dump($wp_registered_widgets);
//"archives-1"
//"categories-1"
//"tag_cloud-1"
/*
$result = the_terms( $post->ID, 'people', 'People: ', ', ', ' ' );;
foreach ($result as $post) {
#setup_postdata($post);
$postid = $post->ID;
$title = $post->post_title;
$commentcount = $post->comment_count;
if ($commentcount != 0) { ?>
<li><a href="<?php echo esc_url(get_permalink($postid)); ?>" title="<?php echo esc_attr($title); ?>">
<?php echo esc_html($title); ?> (<?php echo esc_html($commentcount); ?>)</a> </li>
<?php } } */?>
<!--End Most Commented Articles-->

