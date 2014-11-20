<?php
/*
Template Name: Directory Page
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="ninecol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					    	<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>
						
						    <header class="article-header">
							
							    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix" itemprop="articleBody">
						    	<p><a href="http://www.utexas.edu/ssw/zincludes/phonelist.pdf">PDF version for printing</a></p>

						    	<?php



						    		$args = array(
						    				'post_status' => 'publish',
						    				'post_type' => 'directory',
						    				'meta_key' => 'faculty_last',
						    				'orderby' => 'meta_value',
						    				'order' => 'asc',
						    				'posts_per_page' => -1,
						    			);
						    		$dir_query = new WP_Query($args);



						    		if ($dir_query->have_posts()) :

						    			$previous_type = 's23vsJFlzsdfmKMm';

						    			foreach ( $dir_query as $d_query ) {

						    				$current_type = get_custom_field_value('faculty_directory', false);
						    				if( $current_type != $previous_type ) {
						    					// IF THIS IS NOT THE FIRST ONE, A DIV IS OPEN AND WE NEED TO CLOSE IT
								                if( $previous_type != 's23vsJFlzsdfmKMm') {
								                    echo '</table><!-- howdy -->';
								                }
						    					echo '<h3>' . $current_type . '</h3>';
						    					echo '<table>';

						    					while ($dir_query->have_posts()) : $dir_query->the_post();

									    			if ( get_custom_field_value('faculty_directory', false) === $current_type ) {
									    					echo get_the_title();
									    				} 
									    			

							    				endwhile; 

							    				$previous_type = $current_type;
						    				}

						    			}

						    			

						    		endif;

						    		
						    		//rewind_posts();

						    	?>

						    	<!-- PROFESSORS -->
						    	<h3>Professors</h3>
						    	<table id="facultyDirTable" class="tablesorter">
						            <thead>
						                <tr>
						                    <th width="10%"></th>
						                    <th></th>
						                </tr>
						            </thead>

						        <?php show_directory('fac3'); ?>
						    	<?php // if ($dir_query->have_posts()) : while ($dir_query->have_posts()) : $dir_query->the_post(); ?>

						    		<?php 
						    			$profs = get_custom_field_value('faculty_directory', false);
						    			
						    			if ( $profs === 'fac3' ) {

						    				?>

						    				<tr>
                								<td>

                							<?php 

						    				// SET VARIABLES SO WE'RE NOT REPEATING LOOKUPS
						    					$facName = get_the_title();
						    					$facLink = get_permalink();

						    				// IMAGE
				                            	// If an image has been uploaded via WordPress, show it.
							    				if (get_custom_field_value('faculty_picture', false)) {
					                                $imgID = get_custom_field_value('faculty_picture', false);
					                                $imgSrc = wp_get_attachment_image_src( $imgID );
					                                $imgPath = $imgSrc[0];
					                                echo '<a href="'. $facLink .'"><img src="'. $imgPath . '" alt="' . $facName . '" title="' . $facName . '" /></a>';
					                            // Else, show the image on the server specified in the faculty_jpg field.
					                            } elseif (get_custom_field_value('faculty_jpg', false)) {
					                            	$imgName = get_custom_field_value('faculty_jpg', false);
					                                $imgPath = 'http://www.utexas.edu/ssw/dl/media/heads150x150/' . $imgName;
					                                echo '<a href="'. $facLink .'"><img src="'. $imgPath . '" alt="' . $facName . '" title="' . $facName . '" /></a>';
					                            }

					                        ?>
					                        	</td>
					                        	<td>
					                        <?php

					                        // NAME
						    					echo '<a href="' . $facLink . '" title="' . $facName . '">' . $facName . '</a>';
						    					echo '<br />';

					                        // TITLE
					                            if (get_custom_field_value('faculty_title', false)) {
				                            		get_custom_field_value('faculty_title', true);
				                            		echo '<br />';
				                            	}

				                            // EMAIL
				                            	if (get_custom_field_value('faculty_email', false)) {
						                            $facEmail = get_custom_field_value('faculty_email', false);
						                            echo '<a href="mailto:'. $facEmail .'" target="_blank">' . $facEmail . '</a>';
						                        }
						                    ?>
						                    	</td>
						                    </tr>

						                    <?php

				                          }	// FAC1 (PROFESSORS)

						            ?>
						        

						    	<?php endwhile; endif; 
						    		wp_reset_query(); 
						    	?>
						    	</table>

						    	<!-- ASSOCIATE PROFESSORS -->
						    	<h3>Associate Professors</h3>
						    	<?php if ($dir_query->have_posts()) : while ($dir_query->have_posts()) : $dir_query->the_post(); ?>

						    		<?php 
						    			$profs = get_custom_field_value('faculty_directory', false);
						    			if ( $profs === 'fac2' ) {
						    				echo get_the_title();
						    			}
						            ?>

						    	<?php endwhile; endif; 
						    	wp_reset_query(); 
						    	?>

						    	<!-- ASSISTANT PROFESSORS -->
						    	<h3>Assistant Professors</h3>
						    	<?php if ($dir_query->have_posts()) : while ($dir_query->have_posts()) : $dir_query->the_post(); ?>

						    		<?php 
						    			$profs = get_custom_field_value('faculty_directory', false);
						    			if ( $profs === 'fac3' ) {
						    				echo get_the_title();
						    			}
						            ?>

						    	<?php endwhile; endif; 
						    	wp_reset_query(); 
						    	?>

							</section> <!-- end article section -->
					
					    </article> <!-- end article -->
					
					    <?php //endwhile; else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
    					    	</footer>
    					    </article>
					
					    <?php //endif; ?>
			
    				</div> <!-- end #main -->
    
				    <?php get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>