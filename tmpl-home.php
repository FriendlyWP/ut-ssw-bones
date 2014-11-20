<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="ninecol first clearfix" role="main">

				    	<script type="text/javascript" language="javascript">
		                    jQuery(document).ready(function($) {
		                    	var n = 1
		                        $('.home-flexslider').flexslider({
		                        	namespace: "mmflex-",
		                          animation: "fade",
		                          slideshowSpeed: 7000,
		                          controlsContainer: ".flex-container",
		                          manualControls: ".flex-control-nav-home li",
		                          pauseOnHover: true,
		                          directionNav: false,
		                          animationLoop: true,
							      after: function(slider) {
								   if (slider.currentSlide == slider.count - 5) { // is first slide
								      n--;
								      if(n==0) {
								        slider.pause();
								      }
								   }
								}
			                    });
			                });
		                </script>
		        	   
		        	   <?php   
		                
		                // Get any existing copy of our transient data
		                if ( false === ( $features = get_transient( 'features' ) ) ) {
		                    // It wasn't there, so regenerate the data and save the transient
		                     $features = new WP_Query( 'post_type=featured&posts_per_page=5&order=DESC&post_status=publish' );
		                     set_transient( 'features', $features, YEAR_IN_SECONDS );
		                }
		               ?>

		               <div class="home-flexslider clearfix">
				            <ul class="slides">
				            <?php while($features->have_posts()) : $features->the_post(); ?>
				                <?php
				                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
				                if ( function_exists('vp_get_thumb_url')) {
				                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
				                    $thumb=vp_get_thumb_url($features->post_content, 'home-feature', true); 
				                }
				                ?>
				                <?php $excerpt = get_the_excerpt(); ?>
				                <li>
				                    <div class="copy">
				                        <div class="text">
				                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				                        <span>
				                        <?php echo string_limit_words($excerpt,30); ?><br /></span><a class="readmorelink" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">Learn more&nbsp;&raquo;</a>
				                        </div><!-- .text -->
				                    </div><!-- .copy -->
				                    <div class="img">
				                        <?php if ($thumb!='') { ?>
				                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /></a>
				                        <?php } ?>
				                    </div><!-- .img -->
				                </li>
				            <?php endwhile;
				            wp_reset_postdata(); ?>
				            </ul><!-- .slider -->
				            <a href="<?php bloginfo('url'); ?>/featured/" class="viewall">View all featured articles</a>
				        </div><!-- .flexslider -->

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
						    <section class="entry-content clearfix home-modules" itemprop="articleBody">
							    <?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
					                <?php $left = get_post_meta($post->ID, 'home_left', true);
					                $right =  get_post_meta($post->ID, 'home_right', true); ?>
					                <div class="module left">
					                    <?php echo apply_filters( 'the_content', html_entity_decode( $left ) ); ?>
					                </div>
					                <div class="module right">
					                	<?php echo apply_filters( 'the_content', html_entity_decode( $right ) ); ?>
					                </div>
					             <?php //endwhile; endif; ?>
							</section> <!-- end article section -->
						
						    <footer class="article-footer">
			
							    <?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
							
						    </footer> <!-- end article footer -->
						    
						    <?php comments_template(); ?>
					
					    </article> <!-- end article -->
					
					    <?php endwhile; else : ?>
					
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
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
				    <?php get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>