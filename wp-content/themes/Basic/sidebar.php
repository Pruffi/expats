<div id="sidebar">

    <div id="header"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"> <?php $logo = (get_option('basic_logo') <> '') ? get_option('basic_logo') : get_bloginfo('template_directory').'/images/logo-'.get_option('basic_color_scheme').'.gif';?>
	<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="logo"/></a> </div>
	  
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>
    <?php endif; ?>
</div>
</div>
