<?php
/*
Template Name: My Custom Page
*/
get_header(); ?>
	
	<!-- Main content start -->
	<section class="main-content">
		<div class="container-fluid">
			<div class="row">
				<aside class="col-sm-2 col-sm-offset-2 clearfix">
	              	<?php
					$memberCategories = get_terms('billede-kategori');
					$filterList = '<li><a class="active" href="#" data-filter="*">Alle</a></li>';
					foreach($memberCategories as $memberCategory){
					  $filterList .= '<li><a class="" href="#" data-filter=".'.$memberCategory->slug.'">'.$memberCategory->name.'</a></li>';
					}
					// print '<pre>'.str_replace('<','&lt;',var_export($isotopeAllCategories,true)).'</pre>';
					?>
		            <ul class="filter list-unstyled pull-left">
		              <?php //print str_replace(array('<li','<a class="'),array('<li class="visible-xs"','<a class="btn btn-large '),$filterList);?>
		              <?php print str_replace(array('<li','<a class=""'),array('<li class=""','<a'),$filterList);?>
		            </ul><!-- /.filter -->
		            <figure class="grid-toggle">
						<a class="active" href="#" data-filter="*"></a>
					</figure>
				</aside>
				<div class="col-sm-6 clearfix">
					<?php 
					// the query
					$args = array(
						'post_type' => 'billede',
						'post_per_page' => -1
					);
					$the_query = new WP_Query( $args ); ?>

					<?php if ( $the_query->have_posts() ) : ?>
						
						<ul class="large-block-grid-6 medium-block-grid-5 small-block-grid-4 isotope">
							
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php
							$terms = wp_get_post_terms( get_post()->ID, 'billede-kategori');
							$isotopeCategories = '';
							foreach ($terms as $term) {
							  $isotopeCategories .= ' ' . $term -> slug;
							}
							?>
							<?php 

							$image = get_field('img');

							if( !empty($image) ): 

								// vars
								$url = $image['url'];

								// thumbnail
								$size = 'thumbnail';
								$thumb = $image['sizes'][ $size ];
								$width = $image['sizes'][ $size . '-width' ];
								$height = $image['sizes'][ $size . '-height' ]; ?>
									
								<li class="image isotope-item<?php print $isotopeCategories; ?>">
									<a href="<?php echo $url; ?>" title="<?php the_title(); ?>">
										<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
									</a>
								</li>

							<?php endif; ?>


						<?php endwhile; ?>

						</ul>
						<?php get_the_category( $id ); ?>
						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
					<?php edit_this_post(); ?>
				</div>


			</div>
		</div>
	</section>
	<!-- Main content end -->

<?php get_footer(); ?>