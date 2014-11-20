<?php
/*
Template Name: Directory Page
*/
require_once('functions-directory.php'); // if you remove this, the template will break
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
					
					    <h1 class="page-title" itemprop="headline"><?php the_title(); ?><a href="http://www.utexas.edu/ssw/zincludes/phonelist.pdf" target="_blank" title="Printable PDF of the School of Social Work Directory" class="printLink"><span aria-hidden="true" data-icon="&#xe000;"></span> Printable PDF</a></h1>
				
				    </header> <!-- end article header -->
			
				    <section class="entry-content clearfix" itemprop="articleBody">

				    	<?php the_content() ?>

				    	<?php if ( function_exists('get_custom_field_value') ) { 
					        		if (get_custom_field_value('addl_contact_info', false)) { ?>
				    	<div class="jumpList">
				    		<ul><strong>Jump to: </strong> 
						    		<li><a href="#addl">Additional Contact Info</a></li>	
						    </ul>
				    	</div>
				    	<?php } 
				    	} ?>

			    	
				        <?php // FOR THE OUTPUT OF THIS FUNCTION SEE FUNCTIONS-DIRECTORY.PHP
				        show_directory('', '', '', 'stu'); ?>

				        <!-- ADDITIONAL CONTACT INFORMATION -->
				        <?php
				        if ( function_exists('get_custom_field_value') ) { 
					        if (get_custom_field_value('addl_contact_info', false)) {
					        	$addl_content = get_custom_field_value('addl_contact_info', false);
							            ?>
							            <a name="addl"></a>
							            <h2>Additional Contact Information<a class="jumpUp" href="#top">Back to top</a></h2>
							            <?php echo apply_filters( 'the_content', html_entity_decode( $addl_content ) ); ?>
							            <?php
							            
							}
						}
				        ?>
				        <!-- end ADDITIONAL CONTACT INFO -->
				    	

					</section> <!-- end article section -->
			
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