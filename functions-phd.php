<?php 
/********** FACULTY AND STAFF DIRECTORY *************/
// This function displays the directory in a table. 
// It's used in tmpl-directory.php and tmpl-faculty-directory.php

// To display just one faculty type, feed the function with the relevant custom field value and the title you would like to display at the top of the table.

// For example, show_directory('fac1', 'Professors') will display Professors only.

// To display the full directory without a title, leave blank: show_directory();

// To display the "Professional Interests" field, add 'true' to the end, for example
// show_directory('fac1', 'Professors', true);

function show_directory($fac_type = 'stu', $title = '', $interests = 'show') {
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
    if ( false === ( $dir_query = get_transient( 'dir_query' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
         $dir_query = new WP_Query( $args );
         set_transient( 'dir_query', $dir_query, YEAR_IN_SECONDS );
    }
    
    if ( $fac_type !== '' ) { ?>
    <a name="<?php echo $fac_type; ?>"></a>
    <?php } ?>
    <table id="facultyDirTable" class="dirTable">
    <?php if ( $title !== '' ) { ?>
        <thead>
            <tr>
                <th colspan="2" class="tableHead"><?php echo $title; ?><a class="jumpUp" href="#top">Back to top</a></th>
            </tr>
        </thead>
    <?php  }
    p2p_type( 'directory_to_projects' )->each_connected( $dir_query );
    if ($dir_query->have_posts()) {
        while ($dir_query->have_posts()) : $dir_query->the_post();

        global $post;

        //if ( $post->connected->have_posts() ) : while ($post->connected->have_posts()) : $post->connected->the_post(); 

    // GET THE CURRENT FACULTY TYPE FROM THE CUSTOM FIELD
    $current_type = get_custom_field_value('faculty_directory', false);

    // SHOW EITHER THE SPECIFIED TYPE, OR IF NOTHING SPECIFIED, EVERYTHING
    // remove the || $fac_type === '' if you'd prefer the function, when left blank, to show only people without a designation
    if ($current_type === $fac_type || $fac_type === '' ) {
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
                echo '<a href="' . $facLink . '" title="' . $facName . '" class="facDetails">Details</a>';

            // School
                if (get_custom_field_value('faculty_school1', false)) {
                    echo '<span class="facTitle">';
                        get_custom_field_value('faculty_school1', true);
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
            </tr>
            <?php
    }

    endwhile; 
} // endif

    wp_reset_query();

    ?>
    </table>
    <?php

} // END TABLE DISPLAY FUNCTION

?>