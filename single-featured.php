<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
								<header class="article-header">
							
									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
							
									<?php
				                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
				                if ( function_exists('vp_get_thumb_url')) {
				                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
				                    $thumb=vp_get_thumb_url($post->post_content, 'home-feature', true); 
				                    $full=vp_get_thumb_url($post->post_content, 'full', true); 
				                }
				                ?>
						
								</header> <!-- end article header -->
					
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php if (is_preview() && $thumb!='') { ?>
				                            <a href="<?php echo $full; ?>" title="<?php the_title(); ?>" rel="lightbox"><img class="aligncenter" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /></a>
				                            <p style="text-align:center;"><strong>The above image appears only in "Preview" mode.</strong></p>
				                        <?php } ?>

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