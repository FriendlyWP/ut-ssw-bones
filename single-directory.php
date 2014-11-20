<?php
/*
This displays an individual within the Directory.
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					    	<!-- CUSTOM BREADCRUMBS -->
					    	<?php $siteURL = get_bloginfo('url'); ?>
					    	<p id="breadcrumbs">
					    		<span xmlns:v="http://rdf.data-vocabulary.org/#">
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>">Home</a></span> &raquo;
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>/faculty-and-staff/">Faculty &amp; Staff</a></span> &raquo;
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>/faculty-and-staff/directory/">Directory</a></span> &raquo;
									<span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title" rel="v:url"><?php the_title(); ?></span></span>
								</span>
					    	</p><!-- #breadcrumbs -->
						
						    <header class="article-header">
							
							    <h1 class="page-title"><?php the_title(); ?></h1>
						
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix">
							
							   <div class="facInfo ninecol first clearfix">
	      					<?php 
	      					// ESTABLISH FUNCTION EXISTS
	      					if ( function_exists('get_custom_field_value') ) {

						      // IMAGE
						      if (get_custom_field_value('faculty_folderloc', false)) {
						        $path = get_custom_field_value('faculty_folderloc', false);
						        $current_site_url = get_bloginfo('url');
						        $title = get_the_title();
						                    
						        // TEST IF CUSTOM FIELD VALUE NOT EMPTY
						        if (get_custom_field_value('faculty_jpg', false)) {
						            $imgName = get_custom_field_value('faculty_jpg', false);
						            $imgPath = 'http://www.utexas.edu/ssw/dl/media/heads150x150/' . $imgName;

						            echo '<img class="facImg alignright" src="'. $imgPath . '" alt="' . $title . '" title="' . $title . '" />';
						        } 
						      }
						        
						      // TITLE 
						        if (get_custom_field_value('faculty_title', false)) {
						            echo '<h2 class="facTitle">';
						            get_custom_field_value('faculty_title', true);
						            echo '</h2>';
						            }
						      
						      ?>
						      <div class="clear"></div>
						      <?php
						      // FACULTY BIO
						        if (get_custom_field_value('faculty_bio', false)) {
						            ?>
						            <?php 
						            // Show first/last name if available, otherwise title
						            /* echo '<h3>About';
						            if ( get_custom_field_value('faculty_first', false) && get_custom_field_value('faculty_last', false) ) { 
						            	echo get_custom_field_value('faculty_first', false) . ' ' . get_custom_field_value('faculty_last', false);
						            } else {
						            	the_title();
						            }
						            echo '</h3>'; */ ?>
						            <?php $bio = get_custom_field_value('faculty_bio', false); 
						            echo apply_filters( 'the_content', html_entity_decode( $bio ) );
						            ?>
						            <?php
						            
						        }
						      
						      // CURRICULUM VITAE (CV)
						        if (get_custom_field_value('faculty_cv', false)) {
						            ?>
						            <p><a href="http://www.utexas.edu/ssw/dl/faculty/<?php echo $path; ?>/<?php get_custom_field_value('faculty_cv', true); ?>" target="_blank">Curriculum Vitae</a> (PDF)</p>
						            <?php
						            
						        }
						      
						      // PROFESSIONAL INTERESTS
						        if (get_custom_field_value('faculty_interests', false)) {
						        	$interests = get_custom_field_value('faculty_interests', false);
						            echo '<h3>Professional Interests</h3>';
						            //echo '<p>';
						            echo apply_filters( 'the_content', html_entity_decode( $interests ) );
						            //echo '</p>';
						        }
						      
						      // EDUCATION
						        // IF FIRST 'SCHOOL' VALUE IS NOT EMPTY, SHOW HEADING AND OPEN UNORDERED LIST
						        if (get_custom_field_value('faculty_school1', false)) {
						            echo '<h3>Education</h3>';
						            echo '<ul class="fac-edu">';
						            echo '<li>';
						            get_custom_field_value('faculty_school1', true);
						            echo '</li>';
						        }
						        if (get_custom_field_value('faculty_school2', false)) {
						            echo '<li>';
						            get_custom_field_value('faculty_school2', true);
						            echo '</li>';
						        }
						        if (get_custom_field_value('faculty_school3', false)) {
						            echo '<li>';
						            get_custom_field_value('faculty_school3', true);
						            echo '</li>';
						        }
						        // CLOSE UNORDERED LIST AFTER ALL VALUES HAVE DISPLAYED
						        if (get_custom_field_value('faculty_school1', false)) {
						            echo '</ul>';
						        }
						      
						      

						     // TEACHING HISTORY
						        if (get_custom_field_value('faculty_teaching', false)) {
						            ?>
						            <p><a href="http://www.utexas.edu/ssw/eteaching/<?php get_custom_field_value('faculty_teaching', true); ?>">Teaching History</a></p>
						            <?php
						            
						        }
						      
						      // FACULTY RESEARCH

						        // Find connected pages
								$connected = new WP_Query( array(
								  'connected_type' => 'directory_to_projects',
								  'connected_items' => get_queried_object(),
								  'nopaging' => true,
								  //'meta_key'   => 'project_end_date',
								  //'orderby'    => 'meta_value_num',
								  //'order'      => 'DESC',
								) );

								//$obj = get_queried_object();
								//var_dump($connected);

								// Display connected posts
								if ( $connected->have_posts() ) { ?>

									<h3>Faculty Research</h3>
									<ul>
									<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
										<li><?php //echo get_custom_field_value('project_end_date', false); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php if ( get_custom_field_value('project_end_date', false) ) { 
                                    $date = date("Y", strtotime(get_custom_field_value('project_end_date', false)) );
                                    echo '&nbsp;(' . $date . ')'; 
		                                } elseif (get_custom_field_value('research_end_date', false)) {
		                                    echo '&nbsp;(' . get_custom_field_value('research_end_date', false) . ')';
		                            } ?></li>
									<?php endwhile; 

									wp_reset_postdata();

									// INCLUDE ADDITIONAL RESEARCH CONTENT
									if ( get_custom_field_value('additional_research', false) ) {
										$additional_research = get_custom_field_value('additional_research', false);
											// remove open/close ul tags from this content
								        $additional_research = preg_replace('/<ul>/','', $additional_research);
								        $additional_research = preg_replace('/<\/ul>/','', $additional_research);
								      	echo apply_filters( 'the_content', html_entity_decode( $additional_research ) );  
									}
							        ?>
								</ul>

									<?php 
									
								} elseif (get_custom_field_value('faculty_research', false)) {
						        	$faculty_research = get_custom_field_value('faculty_research', false);
						            ?>
						             <h3>Faculty Research</h3>
						            <?php echo apply_filters( 'the_content', html_entity_decode( $faculty_research ) ); ?>
						           <?php						    
						        }


						      
						      // FACULTY PUBLICATIONS
						        if (get_custom_field_value('faculty_publications', false)) {
						        	$faculty_publications = get_custom_field_value('faculty_publications', false);
						            ?>
						            <h3>Faculty Publications</h3>
						            <?php echo apply_filters( 'the_content', html_entity_decode( $faculty_publications ) ); ?>
						            <?php
						            
						        }
						    } // If function exists
					        ?>  
					  </div><!-- close .facInfo -->
					  
					  <div class="facAddr threecol last clearfix">
					  		<h3>Contact</h3>
					    	<?php 
					        // ADDRESS
					        // SHOW ADDR.TXT
					        if ( function_exists('get_custom_field_value') ) {
					            // FACULTY BUILDING
					            if (get_custom_field_value('faculty_building', false)) {
					                $facBldg = get_custom_field_value('faculty_building', false);
					                echo '<h4>' . $facBldg . '</h4>';
					            }
					            // ROOM NUMBER
					            if (get_custom_field_value('faculty_office', false)) {
					                $facOffice = get_custom_field_value('faculty_office', false);
					                echo '<span class="facLabel">Room:</span>' . $facOffice . '<br />';
					            }
					            // PHONE
					            if (get_custom_field_value('faculty_phone', false)) {
					                echo '<span class="facLabel">Phone:</span>';
					                get_custom_field_value('faculty_phone', true);
					                echo '<br />';
					            }
					            //FAX
					            if (get_custom_field_value('faculty_fax', false)) {
					                echo '<span class="facLabel">Fax:</span>';
					                get_custom_field_value('faculty_fax', true);
					                echo '<br />';
					            } 
					            // EMAIL ADDRESS
					            if (get_custom_field_value('faculty_email', false)) {
					                $facEmail = get_custom_field_value('faculty_email', false);
					                echo '<span class="facLabel">Email:</span>';
					                echo '<a href="mailto:'. $facEmail .'">' . $facEmail . '</a>';
					            }
					            ?>
					            
					            <?php
					        }
					        //MAILING ADDRESS
					            if (get_custom_field_value('faculty_mailcode', false)) {
					                $facMailcode = get_custom_field_value('faculty_mailcode', false);
					            }
					        ?>
					        <br /><br />
					        <h4>Mailing Address</h4>
					        The University of Texas<br />
					        School of Social Work<br />
					        1925 San Jacinto Blvd <?php echo $facMailcode; ?><br />
					        Austin, TX 78712-0358
					        <?php
					            echo '</div><!-- close .facAddr -->'; ?>
					
						    </section> <!-- end article section -->
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>			
					
					    <?php else : ?>
					
        					<article id="post-not-found" class="hentry clearfix">
        						<header class="article-header">
        							<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
        						</header>
        						<section class="entry-content">
        							<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
        						<footer class="article-footer">
        						    <p><?php _e("This is the error message in the single-custom_type.php template.", "bonestheme"); ?></p>
        						</footer>
        					</article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
    
				    <?php //get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>