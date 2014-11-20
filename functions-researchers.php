<?php 
/********** FACULTY AND STAFF DIRECTORY *************/
// This function displays the directory in a table. 
// It's used in tmpl-directory.php and tmpl-faculty-directory.php

// To display just one faculty type, feed the function with the relevant custom field value and the title you would like to display at the top of the table.

// For example, show_directory('fac1', 'Professors') will display Professors only.

// To display the full directory without a title, leave blank: show_directory();

// To display the "Professional Interests" field, add 'true' to the end, for example
// show_directory('fac1', 'Professors', true);

function show_directory($fac_type = '', $title = '', $interests = 'hide', $research_projects = 'hide') {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'directory',
            'meta_key' => 'faculty_last',
            'orderby' => 'meta_value',
            'order' => 'asc',
            'posts_per_page' => -1,
            'nopaging' => true,
            'suppress_filters' => false,
        );

    // Get any existing copy of our transient data
    // this transient is cleared in library/bones.php
    //if ( false === ( $researcher_query = get_transient( 'researcher_query' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
         $researcher_query = new WP_Query( $args );
      //   set_transient( 'researcher_query', $researcher_query, YEAR_IN_SECONDS );
    //}

    ?>
    <table id="facultyDirTable" class="dirTable resTable">
        <thead>
            <tr>
                <th colspan="2" class="tableHead">Researchers</th>
                <th>Projects<a class="jumpUp" href="#top">Back to top</a></th>
            </tr>
        </thead>
    <?php  
    p2p_type( 'directory_to_projects' )->each_connected( $researcher_query );
    
    if ($researcher_query->have_posts()) {

        while ($researcher_query->have_posts()) : $researcher_query->the_post();

        global $post;

        // IF THE DIRECTORY ITEM HAS A CONNECTION IN THE 'FROM' DIRECTION, AND THE CONNECTION TYPE IS DIRECTORY_TO_PROJECTS, DISPLAY IT
        if ( ( $post->connected && $post->connected[0]->p2p_from && ( $post->connected[0]->p2p_type == 'directory_to_projects' ) ) || ( get_custom_field_value('faculty_research', false) )  ) {
        

    // GET THE CURRENT FACULTY TYPE FROM THE CUSTOM FIELD
    //$current_type = get_custom_field_value('faculty_directory', false);

    // SHOW EITHER THE SPECIFIED TYPE, OR IF NOTHING SPECIFIED, EVERYTHING
    // remove the || $fac_type === '' if you'd prefer the function, when left blank, to show only people without a designation
    //if ($current_type === $fac_type || $fac_type === '' ) {
        ?>
        <tr>
            <td class="dirImg">
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
                <td class="dirInfo">
            <?php

            // NAME
                echo '<a href="' . $facLink . '" title="' . $facName . '" class="facName">' . $facName . '</a>';

            // DETAILS LINK
               // echo '<a href="' . $facLink . '" title="' . $facName . '" class="facDetails">Details</a>';

            // TITLE
                if (get_custom_field_value('faculty_title', false)) {
                    echo '<span class="facTitle">';
                        get_custom_field_value('faculty_title', true);
                    echo '</span>';
                }

            // ROOM NUMBER
                if (get_custom_field_value('faculty_office', false)) {
                    echo '<span class="facItem"><strong>Room #:</strong> ';
                        get_custom_field_value('faculty_office', true);
                    echo '</span>';
                }

            // PHONE
                if (get_custom_field_value('faculty_phone', false)) {
                    echo '<span class="facItem"><strong>Phone:</strong> ';
                        get_custom_field_value('faculty_phone', true);
                    echo '</span>';
                }

            // EMAIL
                if (get_custom_field_value('faculty_email', false)) {
                    $facEmail = get_custom_field_value('faculty_email', false);
                    if (function_exists('eae_encode_emails') ) {
                        $facEmail = eae_encode_emails($facEmail);
                    }
                    echo '<span class="facItem facEnd"><strong>Email: </strong><a href="mailto:'. $facEmail .'" target="_blank">' . $facEmail . '</a></span>';
                }
            // INTERESTS
                if ($interests === 'show') { 
                    if (get_custom_field_value('faculty_interests', false)) {
                        $facInterests = strip_tags(get_custom_field_value('faculty_interests', false));
                        echo '<br /><span class="facItem facEnd facInt"><strong>Interests:</strong> ' . $facInterests . '</span>';
                    }
                } 

                         
            ?>
                </td>
                <td cass="projectList">
                    <?php
                    // RESEARCH PROJECTS
                    if ( $post->connected ) { 
                        
                        echo '<ul>';
                        foreach ( $post->connected as $post ) : setup_postdata( $post );
                            ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php if ( get_custom_field_value('project_end_date', false) ) { 
                                    $date = date("Y", strtotime(get_custom_field_value('project_end_date', false)) );
                                    echo '&nbsp;(' . $date . ')'; 
                                } elseif (get_custom_field_value('research_end_date', false)) {
                                    echo '&nbsp;(' . get_custom_field_value('research_end_date', false) . ')';
                            } ?></li>

                            <?php
                        endforeach;
                        wp_reset_postdata();
                        
                    } elseif ( get_custom_field_value('faculty_research', false) ) {
                        $faculty_research = get_custom_field_value('faculty_research', false);
                        echo apply_filters( 'the_content', html_entity_decode( $faculty_research ) );
                    }

                    // SET VARIABLE FOR ADDITIONAL RESEARCH CONTENT
                    if ( get_custom_field_value('additional_research', false) ) {
                        $additional_research = get_custom_field_value('additional_research', false);
                            // remove open/close ul tags from this content
                        $additional_research = preg_replace('/<ul>/','', $additional_research);
                        $additional_research = preg_replace('/<\/ul>/','', $additional_research);
                        echo apply_filters( 'the_content', html_entity_decode( $additional_research ) ); 
                    }
                    echo '</ul>';



                    ?>
                </td>
            </tr>
            <?php
            //}
        } // END CONDITIONAL

    endwhile; 
    } // endif

    wp_reset_postdata();

    ?>
    </table>
    <?php

} // END TABLE DISPLAY FUNCTION

?>