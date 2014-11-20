<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol first clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix">
						
							<header class="article-header">
							
								<h1><?php _e("404 - Article Not Found", "bonestheme"); ?></h1>
						
							</header> <!-- end article header -->
					
							<section class="entry-content">
							
								<p><?php _e("The article you were looking for was not found, but maybe try looking again!", "bonestheme"); ?></p>
					
							</section> <!-- end article section -->

							<section class="search">
				
							    <div class="searchBox">
				                <form style="margin: 0px; padding: 0px;" id="searchform-page" action="http://www.google.com/u/universityoftexas" method="get">
				                    <label for="q" class="screen-reader-shortcut">Search</label> 
				                    <input type="text" class="text_input" value="Search the School of Social Work" name="q" id="q" onfocus="this.value=''" onblur="javascript:if(this.value.length === 0){this.value='Search the School of Social Work'}" />
				                    <input type="submit" class="button search black square" id="searchsubmit" value="Search" />
				                    <input type="hidden" value="www.utexas.edu/ssw" name="domains" />
				                    <input type="hidden" checked="checked" value="www.utexas.edu/ssw" name="sitesearch" /> 
				                </form>
				
							</section> <!-- end search section -->
						
							<footer class="article-footer">
							
							    <!-- <p><?php _e("This is the 404.php template.", "bonestheme"); ?></p> -->
							
							</footer> <!-- end article footer -->
					
						</article> <!-- end article -->
			
					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
