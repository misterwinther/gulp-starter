<!doctype html>
<html class="no-js" lang="da_DK">
	<head>

		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/master.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="msapplication-tap-highlight" content="no" />
		<meta name="format-detection" content="telephone=no" />
		<!--[if lte IE 8]>
			<script src="<?php echo get_template_directory_uri(); ?>/_/js/html5shiv.min.js"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/_/js/respond.min.js"></script>
		<![endif]-->
		
		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
		<meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">
		<link rel="profile" href="http://gmpg.org/xfn/11" />

	</head>

	<body id="site" <?php body_class(); ?>>
		
		<!-- page start -->
		<div id="page">
			
			    <header id="site-header" class="navbar-fixed-top" role="navigation">
					
					<div class="container">
							
						<div class="row">
							
							<div class="col-xs-12">

								<section id="nav-main">
							    	
							    	<!-- #logo -->
							    	<figure class="logo">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" alt="Home" title="Home"></a>
									</figure>
							    	<!-- /#logo -->

							    	<button class="toggle-menu" type="button">
										<span class="burger">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</span>
									</button>

							    	<!-- #site-nav -->
							    	<nav id="site-nav" role="navigation">
			    			    		<?php wp_nav_menu( array(
			    		    				'theme_location' 	=> 	'primary',
			    		    				'menu' 				=>	'Site Nav',
			    		    				'container'			=> 	false,
			    		    				'echo'				=>	true,
			    		    				'items_wrap'      	=> '<ul>%3$s</ul>'
			    		    			) ); ?>
							    	</nav>
							    	<!-- #site-nav -->
							    	
							    </section>

							</div>
							
						</div>

					</div>

			    </header><!-- site-header end -->

			    <!-- Content start -->
			    <main id="content">