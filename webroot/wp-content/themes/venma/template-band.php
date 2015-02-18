<?php
/*
Template Name: Band
*/
get_header(); 

	// check for rows (parent repeater)
	if( have_rows('band') ): ?>

	    <?php 

	    // loop through rows (parent repeater)
	    while( have_rows('band') ): the_row(); ?>
	        
	    <section class="band" style="background-color: <?php the_sub_field('color'); ?>; color: <?php the_sub_field('text_color'); ?>;">
	        <div class="container">

	            <?php 
	            // check for rows (sub repeater 'type1')
	            //============ //
	            if( have_rows('type1') ): ?>

	                <div class="row">    
	                <?php // loop through rows (sub repeater)
	                while( have_rows('type1') ): the_row(); ?>
	                        <img src="<?php the_sub_field('image'); ?>">
	                        <div class="col-sm-6 col-sm-push-3">
	                            <?php the_sub_field('wysiwyg'); ?>
	                        </div>
	                <?php endwhile; ?>
	                </div>

	            <?php endif; 
	            // check for rows (sub repeater 'type1')
	            //============ //
	            ?>


	            <?php 
	            // check for rows (sub repeater 'type2')
	            //============ //
	            if( have_rows('type2') ): 

	                // loop through rows (sub repeater)
	                while( have_rows('type2') ): the_row(); ?>
	                    
	                    <div class="row">
	                        <div class="col-md-8 col-sm-9 center-block text-center inner-bottom-xs">
	                            <header>
	                                <h1><?php the_sub_field('header'); ?></h1>
	                                <?php the_sub_field('sub'); ?>
	                            </header>
	                        </div>
	                    </div>
	                    
	                    <?php 
	                    // check for rows (sub repeater 'blocks')
	                    //============ //
	                    if( have_rows('blocks') ): ?>

	                        <div class="row inner-top-xs">
	                        <?php // loop through rows (sub repeater)
	                        while( have_rows('blocks') ): the_row(); ?>

	                            <div class="col-md-1">
	                                <div class="icon pull-right">
	                                    <i class="<?php the_sub_field('icon'); ?> icn"></i>
	                                </div><!-- /.icon -->
	                            </div><!-- /.col -->
	                            
	                            <div class="col-md-3 inner-bottom-xs">
	                                <h2><?php the_sub_field('header'); ?></h2>
	                                <p class="text-small"><?php the_sub_field('text'); ?></p>
	                            </div><!-- /.col -->

	                        <?php endwhile; ?>

	                        </div>

	                    <?php endif; 
	                    // check for rows (sub repeater 'blocks')
	                    //============ //
	                    ?>
	                
	                <?php endwhile; ?>

	            <?php endif; 
	            // check for rows (sub repeater 'type2')
	            //============ //
	            ?>
	            
	            
	            <?php 
	            // check for rows (sub repeater 'type3')
	            //============ //
	            if( have_rows('type3') ): 

	                // loop through rows (sub repeater)
	                while( have_rows('type3') ): the_row(); ?>

	                <div class="container inner-xs">
	                    <div class="row">
	                        <div class="col-xs-12">
	                            <div class="tabs tabs-services tabs-circle-top tab-container">
	                                
	                                <?php 
	                                    // Holding the entire output of li's and content
	                                    $tabList = "";
	                                    $tabContent = "";
	                                    $tabNumber = 1;

	                                // check for rows (sub repeater 'tab')
	                                //============ //
	                                if( have_rows('tab') ): 

	                                    // loop through rows (sub repeater)
	                                    while( have_rows('tab') ): the_row(); 
	                                        $icon = get_sub_field('icon');
	                                        $label = get_sub_field('label');

	                                        $wysiwyg = "";


	                                        $contentCounter = count(get_sub_field('content'));
	                                        
	                                        //If content has more wysiwyg's
	                                        $colSize = "";
	                                        switch($contentCounter){
	                                            case 2:
	                                                $colSize = "col-md-6 col-sm-6";
	                                                break;
	                                            case 3:
	                                                $colSize = "col-md-4 col-sm-4";
	                                                break;
	                                            default:
	                                                $colSize = "col-md-8 col-sm-9 center-block text-center";
	                                                break;
	                                        };

	                                        // check for rows (sub repeater 'content')
	                                        //============ //
	                                        if( have_rows('content') ): 

	                                            // loop through rows (sub repeater)
	                                            while( have_rows('content') ): the_row(); 
	                                            
	                                            $wysiwyg .= '<div class="'. $colSize . '">' . get_sub_field('wysiwyg') .'</div>';


	                                            endwhile; 

	                                        endif; 
	                                        // check for rows (sub repeater 'content')
	                                        //============ //

	                                        
	                                        // building the actual content string
	                                        $tabList .= '<li class="tab"><a href="#tab-' . $tabNumber . '"><div><i class="' . $icon . '"></i></div>' . $label . '</a></li>';
	                                        $tabContent .= '<div class="tab-content" id="tab-' . $tabNumber . '"> <div class="row">'. $wysiwyg .'</div><!-- /.row --> </div>';
	                                        
	                                        $tabNumber ++;

	                                    endwhile; ?>
	                                <?php print $counter; ?>

	                                <ul class="etabs text-center">
	                    
	                                    <?php print $tabList; ?>
	                                    
	                                </ul>

	                                <div class="panel-container" style="">
	                                    
	                                    <?php print $tabContent; ?>

	                                </div>

	                                <?php endif; 
	                                // check for rows (sub repeater 'tab')
	                                //============ //
	                                ?>

	                            </div>
	                        </div>
	                    </div>
	                </div>
	                
	                <?php endwhile; ?>

	            <?php endif; 
	            // check for rows (sub repeater 'type3')
	            //============ //
	            ?>


	            </div>
	    </section>  

	    <?php endwhile; // while( has_sub_field('band') ): ?>
	    
	    </div>
	<?php endif; // if( get_field('band') ): ?>

<?php get_footer(); ?>