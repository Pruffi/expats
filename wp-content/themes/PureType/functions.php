<?php 
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname;
		$themename = "PureType";
		$shortname = "puretype";
	
		require_once(TEMPLATEPATH . '/epanel/custom_functions.php'); 

		require_once(TEMPLATEPATH . '/includes/functions/comments.php'); 

		require_once(TEMPLATEPATH . '/includes/functions/sidebars.php'); 

		load_theme_textdomain('PureType',get_template_directory().'/lang');

		require_once(TEMPLATEPATH . '/epanel/options_puretype.php');

		require_once(TEMPLATEPATH . '/epanel/core_functions.php'); 

		require_once(TEMPLATEPATH . '/epanel/post_thumbnails_puretype.php');
		
		include(TEMPLATEPATH . '/includes/widgets.php');
		
		add_action( 'pre_get_posts', 'et_home_posts_query' );
		
		add_action( 'et_epanel_changing_options', 'et_delete_featured_ids_cache' );
		add_action( 'delete_post', 'et_delete_featured_ids_cache' );	
		add_action( 'save_post', 'et_delete_featured_ids_cache' );
	}
}

add_action('wp_head','et_portfoliopt_additional_styles',100);
function et_portfoliopt_additional_styles(){ ?>
	<style type="text/css">
		#et_pt_portfolio_gallery { margin-left: -15px; }
		.et_pt_portfolio_item { margin-left: 21px; }
		.et_portfolio_small { margin-left: -40px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 32px !important; }
		.et_portfolio_large { margin-left: -8px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 6px !important; }
	</style>
<?php }

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

/**
 * Gets featured posts IDs from transient, if the transient doesn't exist - runs the query and stores IDs
 */
function et_get_featured_posts_ids(){
	if ( false === ( $et_featured_post_ids = get_transient( 'et_featured_post_ids' ) ) ) {
		$featured_query = new WP_Query( apply_filters( 'et_featured_post_args', array(
			'posts_per_page'	=> (int) et_get_option( 'puretype_homepage_featured' ),
			'cat'				=> get_catId( et_get_option( 'puretype_feat_cat' ) )
		) ) );

		if ( $featured_query->have_posts() ) {
			while ( $featured_query->have_posts() ) {
				$featured_query->the_post();
				
				$et_featured_post_ids[] = get_the_ID();
			}

			set_transient( 'et_featured_post_ids', $et_featured_post_ids );
		}
		
		wp_reset_postdata();
	}
	
	return $et_featured_post_ids;
}

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;
		
	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', et_get_option( 'puretype_homepage_posts', '6' ) );
        $query->set( 'posts_per_page', et_get_option( 'puretype_homepage_posts', '6' ) );
	
	/* Exclude categories set in ePanel */
        $cat = get_cat_ID(__("All vacancies",'PureType'));
        $subCats = get_categories('child_of=' . $cat );
        foreach($subCats as $subCat)
        {
            $include_categories[] = $subCat->cat_ID;
        }
        
	$exclude_categories = et_get_option( 'puretype_exlcats_recent', false );
        
        foreach($include_categories as $key => $val)
        {
            if (in_array($val, $exclude_categories))
            {
                unset($include_categories[$key]);
            }
        }
        
	if ( $exclude_categories ) $query->set( 'category__not_in', $exclude_categories );
        if ( $include_categories ) $query->set( 'category__in', $include_categories );
	
	/* Exclude slider posts, if the slider is activated, pages are not featured and posts duplication is disabled in ePanel  */
	if ( 'on' == et_get_option( 'puretype_featured', 'on' ) )
		$query->set( 'post__not_in', et_get_featured_posts_ids() );
}

/**
 * Deletes featured posts IDs transient, when the user saves, resets ePanel settings, creates or moves posts to trash in WP-Admin
 */
function et_delete_featured_ids_cache(){
	if ( false !== get_transient( 'et_featured_post_ids' ) ) delete_transient( 'et_featured_post_ids' );
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php } 
} ?>