<div class="post-info" style="color: black; font-weight: bold;">
<?php
$post = get_post();
$city = get_post_field('city', $post, 'raw' );
$salary = get_post_field('salary', $post, 'raw' );
$employer = get_post_field('employer', $post, 'raw' );
$fbId = (int) get_post_field('fb-vacancy-id', $post, 'raw' );

?>
    <!--<div><?php echo $employer ?></div>-->

<?php if (!is_single() ) { ?>
    <div>
        <div style="float:right;"><?php echo $city ?></div>
        <div><?php echo $salary ?></div>
    </div>
<?php } else { ?>
	<div>
        <div style="float:right;"><?php echo $city ?></div>
        <div><?php echo $salary ?></div>
    </div>
    <div>
        <div><a href="http://apps.facebook.com/pruffi_friends/vacancy/<?php echo $fbId ?>"><?php echo __('Recommend','PureType') ?></a></div>
    </div>
<?php }; ?> 

</div>