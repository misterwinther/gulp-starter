<?php get_header(); ?>
	
	<!-- Content header fat hero start -->
	<section id="content-hero" class="content-hero">
		
		<div class="hero-slider-wrapper">
			<ul class="hero-slider"> 
			
				<li class="hero-slider-item" style="background: url('<?php echo get_template_directory_uri(); ?>/_/img/venma_crowd.jpeg') no-repeat;">
					<div class="text-center hero-title-wrapper">
						<div class="hero-title">
							<h1>Event Management</h1>
							<p>
								Managing volunteers and organizations
								<br class="hidden-xs">
								at large events has never been easier
							</p>
						</div>
					</div>
				</li>
				
			</ul>
		</div>
		
	</section>
	<!-- Content header fat hero end -->

	<!-- #features start -->
	<section id="features" class="band">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					
					<hgroup class="section-header">
						<h1>
							Features
						</h1>
						<h2>
							Key features in event management <br class="hidden-xs">It doesn't have to be complex to be awesome.
						</h2>
					</hgroup>
					
					<?php 
					// Get all features
					$args = array(
						'post_type' => 'feature',
						'post_per_page' => -1
					);
					$the_query = new WP_Query( $args ); ?>

					<?php if ( $the_query->have_posts() ) : ?>
						<!-- Features -->
						<ul id="features-list" class="large-block-grid-3">
							
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
							<li class="feature">
								<figure>
									<a href="<?php the_permalink(); ?>">
										<?php echo get_the_post_thumbnail(); ?>
									</a>
								</figure>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php the_excerpt(); ?>
							</li>

						<?php endwhile; ?>

						</ul>
						<!-- Features end -->
						
						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>
	<!-- #features end -->

	<!-- #key-numbers start -->
	<section id="key-numbers" class="band">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-4">
					<div class="key-number">
						<div class="row">
							<div class="col-xs-3"><i class="icon-cloud"></i></div>
							<div class="col-xs-9">
								<h2>+26</h2>
								<h3>Events assisted</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="key-number">
						<div class="row">
							<div class="col-xs-3"><i class="icon-gauge-1"></i></div>
							<div class="col-xs-9">
								<h2>20.000</h2>
								<h3>Volunteers coordinated</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="key-number">
						<div class="row">
							<div class="col-xs-3"><i class="icon-globe"></i></div>
							<div class="col-xs-9">
								<h2>65.000</h2>
								<h3>Guests serviced by volunteers</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- #key-numbers end -->

	<!-- #call-to-action start -->
	<section id="call-to-action" class="band">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="text-center">
						<span>Want to <strong>find out more</strong>? Just contact us </span> 
						<a href="#" class="btn btn-venma btn-lg">Contact us now</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- #call-to-action end -->
	
	<!-- #references start -->
	<section id="references" class="band">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<hgroup class="section-header">
						<h1>
							References
						</h1>
						<h2>
							Key features in event management <br class="hidden-xs">It doesn't have to be complex to be awesome.
						</h2>
					</hgroup>
					
					<?php 
					// Get all features
					$args = array(
						'post_type' => 'references',
						'post_per_page' => -1
					);
					$the_query = new WP_Query( $args ); ?>

					<?php if ( $the_query->have_posts() ) : ?>
						<!-- References -->
						<ul id="reference-list" class="small-block-grid-2 large-block-grid-4">
							
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
							<li class="reference">
								<a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail(); ?>
								</a>
							</li>

						<?php endwhile; ?>

							<li class="reference">
								<a href="http://novicell.dk/">
									<img src="<?php echo get_template_directory_uri(); ?>/_/img/dit_logo.svg" alt="">
								</a>
							</li>

						</ul>
						<!-- references end -->
						
						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>


				</div>
			</div>
		</div>
	</section>
	<!-- #references end -->

<?php get_footer(); ?>