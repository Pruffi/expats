<div class="post-info" style="color: black; font-weight: bold;">
<?php
$post = get_post();
$city = get_post_field('city', $post, 'raw' );
$salary = get_post_field('salary', $post, 'raw' );
$employer = get_post_field('employer', $post, 'raw' );

?>
    
    <div style="float:right;"><?php echo $city ?></div>
    <div><?php echo $salary ?></div>
    <!--<div><?php echo $employer ?></div>-->
<!--
<?php if (!is_single() && get_option('puretype_postinfo1') ) { ?>
<?php esc_html_e('Posted','PureType') ?>
 <?php if (in_array('author', get_option('puretype_postinfo1'))) { ?>
 <?php esc_html_e('by','PureType') ?>
 <?php the_author_posts_link(); ?>
<?php }; ?>
<?php if (in_array('date', get_option('puretype_postinfo1'))) { ?>
 <?php esc_html_e('on','PureType') ?>
 <?php the_time(get_option('puretype_date_format')) ?>
<?php }; ?>
<?php if (in_array('categories', get_option('puretype_postinfo1'))) { ?>
 <?php esc_html_e('in','PureType') ?>
 <?php the_category(', ') ?>
<?php }; ?>
<?php } elseif (is_single() && get_option('puretype_postinfo2') ) { ?>
	<?php esc_html_e('Posted','PureType') ?> <?php if (in_array('author', get_option('puretype_postinfo2'))) { ?> <?php esc_html_e('by','PureType') ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('puretype_postinfo2'))) { ?> <?php esc_html_e('on','PureType') ?> <?php the_time(get_option('puretype_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('puretype_postinfo2'))) { ?> <?php esc_html_e('in','PureType') ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('puretype_postinfo2'))) { ?> | <?php comments_popup_link(esc_html__('0 comments','PureType'), esc_html__('1 comment','PureType'), '% '.esc_html__('comments','PureType')); ?><?php }; ?>
<?php }; ?> 
-->
</div>