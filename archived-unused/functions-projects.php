<?php
function display_projects_table($currentCat = false) { 

	$args = array(
		'post_type' => 'projects',
	    'posts_per_page' => '-1',
	    'orderby' => 'title',
	    'order' => 'asc',
	    'post_status' => 'publish',
	    'suppress_filters' => false,
	    'nopaging' => true,
	);

	// IF PAGE SHOULD SHOW SPECIFIC CATEGORY
	if ( $currentCat ) {
		$args = array(
		    'post_type' => 'projects',
		    'posts_per_page' => '-1',
		    'orderby' => 'title',

		    'order' => 'asc',
		    'project_categories' => $currentCat,
		    'suppress_filters' => false,
		    'nopaging' => true,
		);
	}
	
	//$p_query = new WP_Query($args);

	// Get any existing copy of our transient data
    // this transient is cleared in library/bones.php 
    //if ( false === ( $p_query = get_transient( 'p_query' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
         $p_query = new WP_Query( $args );
        // set_transient( 'p_query', $p_query, YEAR_IN_SECONDS );
    //}

	p2p_type( 'directory_to_projects' )->each_connected( $p_query );
	
	if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post();

		global $post;

	    // LOOK IN IN RESEARCH END DATE FIELD.
	    // originally, if Research End Date field was blank, the project was considered current, so first check if that's blank.
	    $projectEnd = ''; 
	    $projectEnd = get_custom_field_value('research_end_date', false);
	    $date = $projectEnd;

	    $ended = '';
	    // IF THE RESEARCH END DATE FIELD WAS BLANK, CONTINUE ON AND CHECK OUR NEW PROJECT END DATE FIELD.
	    if ( $projectEnd == '' ) {
	    	$ended = 'current';
	    }

	    // IF IT EXISTS AND IS LESS THAN TODAY'S DATE, THE PROJECT REMAINS CURRENT
        if ( get_custom_field_value('project_end_date', false) ) {
            $projectEndDate = get_custom_field_value('project_end_date', false);
            $projectEnd = $projectEndDate;
            $date = date("Y", strtotime($projectEnd) );
            if ( $projectEndDate > date('Ymd') ) {              
                // add a variable to denote the Project is current:
                $ended = 'current';
            } 
        }  

	    // SHOW ONLY CURRENT POSTS ($ended == 'current'), OR
	    // SHOW EVERYTHING ($show_current_only == false) (set in the function call)
	    if ( $ended == 'current' || $show_current_only == false ) { 

	        // TABLE DISPLAY
	        if ( function_exists('get_custom_field_value') ) {  
	            ?>
	            <tr>
	                <td class="projectTitle"> 
	                    <!-- PROJECT TITLE -->
	                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
	                </td>
	                <td>
	                    <?php
	                    // RESEARCHERS
	                    // First check for the new, post-connected way; then choose-from-dropdown way of adding researchers; then original.

	                    if ( $post->connected ) {
		                    foreach ( $post->connected as $post ) : setup_postdata( $post );
		                    	echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a><br />';
		                    endforeach;
		                    //wp_reset_postdata();
		                } elseif ( get_field('project_researchers') ) {
	    					$researchers = get_field('project_researchers');
	                        if($researchers)
	                        {
	                            $i = 0;
	                            $len = count($array);
	                            foreach($researchers as $researcher) {
	                                if ( $i !== 0 ) {
	                                    echo '<br />';
	                                }
	                                $p_researcher = $researcher['project_researcher'];
	                                // WITHOUT TITLES
	                                //$first = get_post_meta($p_researcher->ID, 'faculty_first', true);
	                                //$last = get_post_meta($p_researcher->ID, 'faculty_last', true);
	                                $title = get_the_title($p_researcher->ID);
	                                $link = get_permalink($p_researcher->ID);
	                                //echo '<a class="proj-researcher" title="' . $title . '" href="' . $link . '">' . $first . ' ' . $last . '</a>';
	                                echo '<a class="proj-researcher" title="' . $title . '" href="' . $link . '">' . $title . '</a><br />';

	                                $i++;
	                            }
	                        }
	                    } else {

	                        // USING THE OLD FIELDS                                       
	                        // if Researcher 1 exists...
	                        if (get_custom_field_value('research_pi_1', false)) {
	                            echo '<a href="'. get_bloginfo('url') . '/faculty-and-staff/directory/';
	                            get_custom_field_value('research_pi_home1', true);
	                            echo '">';
	                            get_custom_field_value('research_pi_1', true);
	                            echo '</a>';
	                            }
	                        // if Researcher 2 exists...
	                        if (get_custom_field_value('research_pi_2', false)) {
	                            echo '<br />';
	                            echo '<a href="'. get_bloginfo('url') . '/faculty-and-staff/directory/';
	                            get_custom_field_value('research_pi_home2', true);
	                            echo '">';
	                            get_custom_field_value('research_pi_2', true);
	                            echo '</a>';
	                        }
	                        // if Researcher 3 exists...
	                        if (get_custom_field_value('research_pi_3', false)) {
	                            echo '<br />';
	                            echo '<a href="'. get_bloginfo('url') . '/faculty-and-staff/directory/';
	                            get_custom_field_value('research_pi_home3', true);
	                            echo '">';
	                            get_custom_field_value('research_pi_3', true);
	                            echo '</a>';
	                        }
	                    }
					// END RESEARCHER NAMES
	                   ?>
	                </td>
	                <td>
	                    <?php
	                     // CATEGORY
	                    // Pull from category list.
	                    $current_id = $p_query->post->ID;
	                    //echo 'currentID:' . $current_id;
	                    if ( get_the_terms($current_id, 'project_categories') ) {
	                        
	                        $terms = get_the_terms( $current_id, 'project_categories' );
	                        $listURL = get_bloginfo('url') . '/cswr/projects/project-list/';
	                        
	                        if ( $terms && ! is_wp_error( $terms ) ) {

	                            $project_cats = array();

	                            foreach ( $terms as $term ) {
	                                $termURL = urlencode($term->name);
	                                $project_cats[] = '<a href="' . $listURL . '?rc=' . urlencode($term->slug) . '">' . $term->name . '</a>';
	                            }                 
	                            $term_list = join( "; ", $project_cats );
	                            echo $term_list;
	                        } 

	                    } 
						  
	                    ?>
	                </td>
	                <td>
	                <?php
	                    echo $date;
	                ?>
	                </td>
	            </tr>
	           <?php 
	        
	        }
	    }
	endwhile; 
    else: 
        // do nothing 
    endif;
     
    //Reset Query
    wp_reset_query();
} // end function
?>