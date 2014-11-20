<?php 
/********** FACULTY AND STAFF DIRECTORY *************/
// This function displays the directory in a table. 
// It's used in tmpl-directory.php and tmpl-faculty-directory.php

// To display just one faculty type, feed the function with the relevant custom field value and the title you would like to display at the top of the table.

// For example, show_directory('fac1', 'Professors') will display Professors only.

// To display the full directory without a title, leave blank: show_directory();

// To display the "Professional Interests" field, add 'true' to the end, for example
// show_directory('fac1', 'Professors', true);

function show_directory($fac_type = '', $title = '', $interests = 'hide') {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'directory',
            'meta_key' => 'faculty_last',
            'orderby' => 'meta_value',
            'order' => 'asc',
            'posts_per_page' => -1,
        );
    $dir_query = new WP_Query($args);
    
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

    if ($dir_query->have_posts()) : while ($dir_query->have_posts()) : $dir_query->the_post();

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
                    echo '<span class="facItem facEnd"><strong>Email: </strong><a href="mailto:'. $facEmail .'" target="_blank">' . $facEmail . '</a></span>';
                }
            // INTERESTS
                if ($interests === 'show') { 
                    if (get_custom_field_value('faculty_interests', false)) {
                        $facInterests = strip_tags(get_custom_field_value('faculty_interests', false));
                        echo '<span class="facItem facEnd facInt"><strong>Interests:</strong> ' . $facInterests . '</span>';
                    }
                }

            ?>
                </td>
            </tr>
            <?php
    }

    endwhile; endif;
    wp_reset_query();
    ?>
    </table>
    <?php

} // END TABLE DISPLAY FUNCTION

?>