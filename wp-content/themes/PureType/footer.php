<div id="footer">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
    <?php endif; ?>
    <div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
<div style="clear: both; margin-bottom: 20px; margin-top: 20px; float: left; font-size: 10px; width: 636px;" class="bluefooter">
    &copy; Pruffi LLC
</div>

<?php get_template_part('includes/scripts'); ?>
<?php wp_footer(); ?>
