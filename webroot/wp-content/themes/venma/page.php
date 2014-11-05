<?php get_header(); ?>
	
	<!-- Main content start -->
	<section class="main-content">
		<div class="container">
			<div class="row">
				<main id="main" class="col-sm-12" role="main">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article class="post" id="post-<?php the_ID(); ?>">
							
							<div class="entry">

								<?php the_content(); ?>

							</div>

							<?php edit_this_post(); ?>

						</article>

					<?php endwhile; endif; ?>

				</main>
			</div>
		</div>
	</section>
	<!-- Main content end -->

<?php get_footer(); ?>