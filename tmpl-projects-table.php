<?php
/*
Template Name: Projects Table
*/
require_once('functions-projects.php'); // if you remove this, the template will break
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

                <script type="text/javascript" language="javascript">
                jQuery(document).ready(function($) {
                    // TABLESORTER
                    $('#projectTable').tablesorter({ 
                        // pass the headers argument and assing a object 
                        //debug: true,
                        sortList: [[3,1],[2,0],[0,1],[0,0]],
                        textExtraction : 'complex',
                        headers: { 
                            0: { 
                            // set the column to sort as text 
                                sorter: 'text',
                            },
                            // assign the secound column (we start counting zero) 
                            1: { 
                                // disable it by setting the property sorter to false 
                                sorter: false,
                            }, 
                            // assign the third column (we start counting zero) 
                            2: { 
                                // disable it by setting the property sorter to false 
                                sorter: 'text',
                            },
                            3: {
                                  sorter:'digit',
                            },
                        },
                    });
                            
                   
                });

                </script>
            
                <header class="article-header">
                
                    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
            
                </header> <!-- end article header -->
        
<section class="entry-content clearfix" itemprop="articleBody">
    <script type="javascript">// call the tablesorter plugin, the magic happens in the markup
     
</script>
<?php 
// CHECK QUERYSTRING TO SEE IF WE'RE ON A CATEGORY PAGE
//$currentCat = htmlspecialchars($_GET["rc"]);
$currentCat = htmlspecialchars($_GET["rc"]);
if ( $currentCat ) {
    $currentCatName = get_term_by('slug', $currentCat, 'project_categories');
    $currentCatName = $currentCatName->name;
}

// DISPLAY THE PAGE CONTENT
   the_content();

// INSERT HIDDEN OVERLAY DIV FOR PRE-LOADER POPUP
?>
    <div id="overlay">
    Sorting,<br />one moment please...
    </div>

    <table id="projectTable" class="tablesorter" width="98%">
        <thead>
            <tr>
                <th width="45%">Project Title</th>
                <th width="25%">Researcher</th>
                <th width="20%">Category</th>
                <th width="8%">End Date</th>
            </tr>
        </thead>

        <?php 

        // FIND THIS FUNCTION IN functions-projects.php
        display_projects_table( $currentCat ); 

        ?>
    
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Researcher</th>
                <th>Category</th>
                <th>End Date</th>
            </tr>
        </tfoot>
    </table>
    <a class="jumpUp" href="#top">Back to top</a>
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