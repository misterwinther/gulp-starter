				<!-- footer start -->
				<footer id="footer" class="band" role="contentinfo">

					<section id="footer-content">
						
					  	<div class="container">
							
							<div class="row">
								
								<div class="col-xs-12">
									
									<h3>
										Get in touch
									</h3>

									<div class="row">
										
										<div class="col-xs-6 col-sm-3 col-md-2">
											<h4>Venma</h4>
											<ul class="list-unstyled">
												<li>Soeren Nymarksvej 6</li>
												<li>8270 Hoejbjerg,</li>
												<li>Denmark</li>
											</ul>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-2">
											<h4>Talk to us</h4>
											<ul class="list-unstyled">
												<li>+49 040 555 call-me</li>
												<li>Project Memba Skype</li>
												<li>info@venma.dk</li>
											</ul>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-2">
											<h4>Ipsam, quos?</h4>
											<ul class="list-unstyled">
												<li>Lorem ipsum dolor.</li>
												<li>Error, architecto, vero.</li>
												<li>Quas, porro, obcaecati!</li>
											</ul>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-push-3">
											<figure class="novicell">
												<a href="http://www.novicell.dk"></a>
											</figure>
										</div>

									</div>

								</div>
								
							</div>

					    </div>

					</section>

				</footer>
				<!-- footer end -->

			</main>
			<!-- Content end -->
			
			<div id="off-canvas-overlay"></div>
			
		</div>
		<!-- page end -->
		
		<!-- off-canvas start -->
			
		<aside id="off-canvas-panel">
			
			<!-- #off-canvas-menu -->
	    	<nav id="off-canvas-menu" role="navigation">
	    		<span>Navigation</span>
	    		<?php wp_nav_menu( array(
    				'theme_location' 	=> 	'secondary',
    				'menu' 				=>	'Off Canvas Nav',
    				'container'			=> 	false,
    				'echo'				=>	true,
    				'items_wrap'      	=> '<ul>%3$s</ul>'
    			) ); ?>
	    	</nav>
	    	<!-- #off-canvas-menu -->
			
		</aside>

		<!-- off-canvas end -->
		
		<?php echo get_option('google'); ?>
		
		<?php wp_footer(); ?>
	</body>

</html>