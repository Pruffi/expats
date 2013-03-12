<?php get_header(); ?>

<div id="container">
<div id="left-div">
    <div id="left-inside">
		<?php if (get_option('basic_integration_single_top') <> '' && get_option('basic_integrate_singletop_enable') == 'on') echo(get_option('basic_integration_single_top')); ?>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <!--Begin Post-->
        <div class="home-post-wrap">
            <p class="vac_name"><?php the_title(); ?>
            <span class="city"><?php echo pruffi_city(); ?></span></p>
            <p class="vac_place"><?php echo pruffi_vac_place(); ?></p>
			<?php get_template_part('includes/postinfo'); ?>			
            <div style="clear: both;"></div>
			<?php if (get_option('basic_thumbnails') == 'on') { get_template_part('includes/thumbnail'); } ?>
            
            <div class="vacancy">
                <div class="vacancy_info">
                    <div class="salary">
                        <p class="salary_p salary_pay ie-text-shadow-1d">
                            <span class="text"><?php esc_html_e('Salary','Basic') ?></span>
                            <span class="sum">
                                <?php echo pruffi_salary(); ?>
                            </span>
                        </p>
                        <p class="salary_p salary_rec">
                            <span class="text"><?php esc_html_e('Reward','Basic') ?></span>
                            <span class="sum">
                                <?php echo pruffi_reward(); ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="about">
                    <?php the_content(); ?>
                    <div class="buttons">
                        <a class="rec_btn recommendVacancy" href="http://apps.facebook.com/pruffi_friends/vacancy/<?php echo pruffi_id(); ?>" data-type="friend">
                            <span class="inner ie-text-shadow-1d"><?php esc_html_e('Recommend friends','Basic') ?></span>
                        </a>
                        <a class="reply_btn recommendVacancy" href="http://apps.facebook.com/pruffi_friends/vacancy/<?php echo pruffi_id(); ?>" data-type="self">
                            <span class="inner ie-text-shadow-1d"><?php esc_html_e('Recommend yourself','Basic') ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<?php if (get_option('basic_integration_single_bottom') <> '' && get_option('basic_integrate_singlebottom_enable') == 'on') echo(get_option('basic_integration_single_bottom')); ?>
        <?php if (get_option('basic_foursixeight') == 'on') { ?>
			<?php get_template_part('includes/468x60'); ?>
        <?php } ?>
        <div style="clear: both;"></div>
         <?php if (get_option('basic_show_postcomments') == 'on') { ?>
			<?php comments_template('', true); ?>
		<?php }; ?>
        <?php endwhile; ?>
        <?php else : ?>
        <!--If no results are found-->
        <h1><?php esc_html_e('No Results Found','Basic') ?></h1>
        <p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','Basic') ?></p>
        <!--End if no results are found-->
        <?php endif; ?>
    </div>
</div>
<!--Begin Sidebar-->
<?php get_sidebar(); ?>
<!--End Sidebar-->
<!--Begin Footer-->
<?php get_footer(); ?>
<!--End Footer-->
</body>
</html>
