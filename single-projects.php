<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<!-- CUSTOM BREADCRUMBS -->
					    	<?php $siteURL = get_bloginfo('url'); ?>
					    	<p id="breadcrumbs">
					    		<span xmlns:v="http://rdf.data-vocabulary.org/#">
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>">Home</a></span> &raquo;
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>/cswr/">Center for Social Work Research</a></span> &raquo;
									<span typeof="v:Breadcrumb"><a property="v:title" rel="v:url" href="<?php echo $siteURL; ?>/cswr/projects/project-list/">Projects</a></span> &raquo;
									<span typeof="v:Breadcrumb"><span class="breadcrumb_last" property="v:title" rel="v:url"><?php the_title(); ?></span></span>
								</span>
					    	</p><!-- #breadcrumbs -->
						
								<header class="article-header">
							
									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?>
									<?php if ( get_custom_field_value('project_end_date', false) ) { 
                                    $date = date("Y", strtotime(get_custom_field_value('project_end_date', false)) );
                                    echo '&nbsp;(' . $date . ')'; 
		                                } elseif (get_custom_field_value('research_end_date', false)) {
		                                    echo '&nbsp;(' . get_custom_field_value('research_end_date', false) . ')';
		                            } ?></h1>
						
								</header> <!-- end article header -->
					
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php 
										// Find connected pages
								$connected = new WP_Query( array(
								  'connected_type' => 'directory_to_projects',
								  'connected_items' => get_queried_object(),
								  'connected_direction' => 'to',
								  'nopaging' => true,
								) );

								// Display connected researchers
								if ( $connected->have_posts() ) { 
									echo '<h3>Researcher(s):</h3><ul>';
									
									while ( $connected->have_posts() ) : $connected->the_post();
										echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
									endwhile;
									echo '</ul>';
								}
								wp_reset_postdata();

								// PROJECT SPONSORS
								$current_id = get_the_ID();
			                    if ( get_the_terms($current_id, 'project_sponsors') ) {

			                    	echo '<h3>Project Sponsor(s)</h3><ul>';
			                        
			                        $terms = get_the_terms( $current_id, 'project_sponsors' );
			                        
			                        if ( $terms && ! is_wp_error( $terms ) ) {

			                            $project_cats = array();

			                            foreach ( $terms as $term ) {
			                                $termURL = urlencode($term->name);
			                                $project_sponsors[] = '<li>' . $term->name;
			                            }                 
			                            $term_list = join( "</li>", $project_sponsors );
			                            echo $term_list;
			                        }

			                        echo '</ul>'; 

			                    }

								// PROJECT CATEGORIES
			                    if ( get_the_terms($current_id, 'project_categories') ) {

			                    	echo '<h3>Project Categories</h3><ul>';
			                        
			                        $terms = get_the_terms( $current_id, 'project_categories' );
			                        $listURL = get_bloginfo('url') . '/cswr/projects/project-list/';
			                        
			                        if ( $terms && ! is_wp_error( $terms ) ) {

			                            $project_cats = array();

			                            foreach ( $terms as $term ) {
			                                $termURL = urlencode($term->name);
			                                $project_cats[] = '<li><a href="' . $listURL . '?rc=' . urlencode($term->slug) . '">' . $term->name . '</a>';
			                            }                 
			                            $term_list = join( "</li>", $project_cats );
			                            echo $term_list;
			                        }

			                        echo '</ul>'; 

			                    } 
									?>

									<?php the_content(); ?>
								</section> <!-- end article section -->
						
								<footer class="article-footer">
			
									<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
							
								</footer> <!-- end article footer -->
					
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
					    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
					    		</footer>
							</article>
					
						<?php endif; ?>
			
					</div> <!-- end #main -->
    
					<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>