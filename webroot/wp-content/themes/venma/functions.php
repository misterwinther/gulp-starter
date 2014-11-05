<?php
	//==================//
	//= Footer Scripts =//
	//==================//
	function load_footer_scripts() {
		wp_enqueue_script('master', ( get_template_directory_uri() . '/_/js/master.min.js' ), false, true);
	}
	add_action( 'wp_footer', 'load_footer_scripts' );

	//================//
	//= Clean up the =//
	//================//
	function removeHeadLinks() {
	   	remove_action('wp_head', 'rsd_link');
	   	remove_action('wp_head', 'wlwmanifest_link');
	}
   	add_action('init', 'removeHeadLinks');

   	//==============//
	// Custom Menu =//
	//==============//
	register_nav_menu( 'primary', 'Site Nav' );
	register_nav_menu( 'secondary', 'Off Canvas Nav' );

	//==========//
	// Widgets =//
	//==========//
	if ( function_exists('register_sidebar' )) {
		register_sidebar( array(
			'name'          => 'Sidebar Right',
			'id'            => 'sidebar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar Left',
			'id'            => 'sidebar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	//======================//
	// Edit this post link =//
	//======================//
	function edit_this_post() {
		edit_post_link(('{Rediger side}'), '<p>', '</p>');
	}

	// Breadcrumbs navXT
	//--------------//
	function get_breadcrumbs() {
		print '<div class="breadcrumbs">';
		print 'Du er her: ';
		    if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }
		print '</div>';
	}

	// Navigation - update coming from twentythirteen
	//--------------//
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	//--------------//
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}
	// Add Theme supoort for Thumbnails
	//--------------//
	add_theme_support( 'post-thumbnails' );

	// Add Theme supoort for SVG's
	//--------------//
	function cc_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');

	// Enable shortcodes & PHP in wp
	//--------------//
	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');

	add_filter( 'the_content', 'wpautop');
	add_filter( 'the_content', 'shortcode_unautop'  );


	// Callback function to insert 'styleselect' into the $buttons array
	//--------------//
	function mce_stylesheet_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	// Register our callback to the appropriate filter
	add_filter('mce_buttons_2', 'mce_stylesheet_buttons');


	// Callback function to filter the MCE settings
	//--------------//
	function mce_before_init_insert_formats( $init_array ) {
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings
			array(
				'title' => 'Lead',
				'inline' => 'span',
				'classes' => 'lead',
				'wrapper' => true,

			),

		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );

		return $init_array;

	}
	// Attach callback to 'tiny_mce_before_init'
	add_filter( 'tiny_mce_before_init', 'mce_before_init_insert_formats' );	


	// Add Site Settings page in WP-admin
	//--------------//
	add_action('admin_menu', 'add_global_custom_variables');

	function add_global_custom_variables()
	{
	    add_options_page('Site Settings', 'Site Settings',
	'manage_options', 'functions','global_custom_variables');
	}

	function global_custom_variables()
	{
	?>
	    <div class="wrap">
	        <h2>Site Settings</h2>
	        <form method="post" action="options.php">
	            <?php wp_nonce_field('update-options') ?>
	            <hr />

	            <h3>Google Analytics</h3>
	            <p><strong>GA code snippet:</strong><br />
					<textarea rows="15" cols="80" name="google"><?php echo get_option('google'); ?></textarea>
	            </p>
				<br />

				<hr />
				
	            <h3>Contact Info</h3>
	            <p><strong>Address etc:</strong><br />
					<textarea rows="15" cols="80" name="contact-info"><?php echo get_option('contact-info'); ?></textarea>
	            </p>
				<br />

				<hr />
				<!-- <h3>Youtube Video</h3>
	            <p><strong>Video Id:</strong><br />
					<input type="text" name="videoId" size="45" value="<?php //echo get_option('videoId'); ?>" />
	            </p>
				<br /> -->

				<hr />
	            <!-- <h3>Company</h3>
	            <p><strong>Company name:</strong><br />
	                <input type="text" name="company" size="45" value="<?php //echo get_option('company'); ?>" />
	            </p>
	            <p><strong>Address:</strong><br />
	                <input type="text" name="address" size="64" value="<?php //echo get_option('address'); ?>" />
	            </p>
	            <br /><hr />
	            <h3>Contact information</h3>
	            <p><strong>Phone:</strong><br />
	                <input type="text" name="phone" size="45" value="<?php //echo get_option('phone'); ?>" />
	            </p>
	            <p><strong>Email:</strong><br />
	                <input type="text" name="email" size="45" value="<?php //echo get_option('email'); ?>" />
	            </p> -->

	            <p><input type="submit" name="Submit" value="Gem indstillinger" class="button button-primary" /></p>
	            <input type="hidden" name="action" value="update" />
	            <input type="hidden" name="page_options" value="google, contact-info" />
	        </form>
	    </div>
	<?php
	} 
	 
	// Page Navigation
	//--------------//
	function page_navi($before = '', $after = '') {
		global $wpdb, $wp_query;
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) { return; }
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 7;
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
			
		echo $before.'<ul class="pagination pagination-sm">'."";
		if ($paged > 1) {
			$first_page_text = "«";
			echo '<li class="prev"><a href="'.get_pagenum_link().'" title="Første">'.$first_page_text.'</a></li>';
		}
			
		$prevposts = get_previous_posts_link('← Forrige');
		if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
		else { echo '<li class="disabled"><a href="#">← Forrige</a></li>'; }
		
		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="active"><a href="#">'.$i.'</a></li>';
			} else {
				echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}
		echo '<li class="">';
		next_posts_link('Næste →');
		echo '</li>';
		if ($end_page < $max_page) {
			$last_page_text = "»";
			echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Sidste">'.$last_page_text.'</a></li>';
		}
		echo '</ul>'.$after."";
	}

	// Page Navigation "side"
	//--------------//
	if ( ! function_exists( 't5_page_to_seite' ) )
	{
	    register_activation_hook(   __FILE__ , 't5_flush_rewrite_on_init' );
	    register_deactivation_hook( __FILE__ , 't5_flush_rewrite_on_init' );
	    add_action( 'init', 't5_page_to_seite' );

	    function t5_page_to_seite()
	    {
	        $GLOBALS['wp_rewrite']->pagination_base = 'side';
	    }

	    function t5_flush_rewrite_on_init()
	    {
	        add_action( 'init', 'flush_rewrite_rules', 11 );
	    }
	}

?>