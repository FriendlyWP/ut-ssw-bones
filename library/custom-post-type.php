<?php
/* 
Functions related to the custom post types being used in this theme.
*/

add_action('init', 'cptui_register_my_taxes_issue');
function cptui_register_my_taxes_issue() {

	// PROJECT CATEGORY TAXONOMY
	$labels = array(
		'name'                       => 'Project Category',
		'singular_name'              => 'Project Category',
		'menu_name'                  => 'Project Categories',
		'all_items'                  => 'All Categories',
		'parent_item'                => 'Parent Project Category',
		'parent_item_colon'          => 'Parent Project Category:',
		'new_item_name'              => 'New Project Category Name',
		'add_new_item'               => 'Add Project Category',
		'edit_item'                  => 'Edit Project Category',
		'update_item'                => 'Update Project Category',
		'separate_items_with_commas' => 'Separate Project Categories with commas',
		'search_items'               => 'Search Project Categories',
		'add_or_remove_items'        => 'Add or remove Project Categories',
		'choose_from_most_used'      => 'Choose from the most used items',
		'not_found'                  => 'Not Found',
	);
	$rewrite = array(
		'slug'                       => 'project-category',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'project_categories', 'projects', $args );

	// PROJECT SPONSOR TAXONOMY
	$labels = array(
		'name'                       => 'Project Sponsor',
		'singular_name'              => 'Project Sponsor',
		'menu_name'                  => 'Project Sponsors',
		'all_items'                  => 'All Sponsors',
		'parent_item'                => 'Parent Project Sponsor',
		'parent_item_colon'          => 'Parent Project Sponsor:',
		'new_item_name'              => 'New Project Sponsor Name',
		'add_new_item'               => 'Add Project Sponsor',
		'edit_item'                  => 'Edit Project Sponsor',
		'update_item'                => 'Update Project Sponsor',
		'separate_items_with_commas' => 'Separate Project Sponsors with commas',
		'search_items'               => 'Search Project Sponsors',
		'add_or_remove_items'        => 'Add or remove Project Sponsors',
		'choose_from_most_used'      => 'Choose from the most used items',
		'not_found'                  => 'Not Found',
	);
	$rewrite = array(
		'slug'                       => 'project-sponsor',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'project_sponsors', 'projects', $args );
}

// Hook into the 'init' action
add_action( 'init', 'cpts', 0 );
// Register Custom Post Type
function cpts() {

	// FEATURED ARTICLES CPT
	$labels = array(
		'name'                => 'Featured Articles',
		'singular_name'       => 'Featured Article',
		'menu_name'           => 'Featured Articles',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Featured Articles',
		'view_item'           => 'View Featured Article',
		'add_new_item'        => 'Add New Featured Article',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Featured Article',
		'update_item'         => 'Update Featured Article',
		'search_items'        => 'Search Featured Articles',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'featured',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'Featured Articles',
		'description'         => '',
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions','editor','custom-fields','comments','thumbnail','author','page-attributes', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-star-empty',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'featured', $args );

	// PROJECTS CPT
	$labels = array(
		'name'                => 'Projects',
		'singular_name'       => 'Project',
		'menu_name'           => 'Projects',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Projects',
		'view_item'           => 'View Project',
		'add_new_item'        => 'Add New Project',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Project',
		'update_item'         => 'Update Project',
		'search_items'        => 'Search Projects',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'projects',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'Projects',
		'description'         => '',
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions','editor','author','custom-fields'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-clipboard',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'projects', $args );

	// DIRECTORY CPT
	$labels = array(
		'name'                => 'Directory',
		'singular_name'       => 'Directory Member',
		'menu_name'           => 'Directory',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Directory',
		'view_item'           => 'View Directory Member',
		'add_new_item'        => 'Add New Directory Member',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Directory Member',
		'update_item'         => 'Update Directory Member',
		'search_items'        => 'Search Directory',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'faculty-and-staff/directory',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'Directory',
		'description'         => '',
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions','thumbnail','author','page-attributes'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'directory', $args );
}

// POSTS TO POSTS - RESEARCH PROJECTS TO DIRECTORY
add_action( 'wp_loaded', 'my_connection_types' );
function my_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'directory_to_projects',
		'from' => 'directory',
		'to' => 'projects',
		'sortable' => 'any',
		'admin_column' => 'any',
		'from_labels' => array(
		    'column_title' => 'Connected Research Project(s)',
		  ),
		  'to_labels' => array(
		    'column_title' => 'Connected Directory Member(s)',
		  ),
		'admin_dropdown' => 'any'
	) );
}

// FILTER/SORT BY CUSTOM FIELD IN ADMIN DIRECTORY LIST PAGE
// see for explanation: http://wp.tutsplus.com/tutorials/plugins/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives/
	
	// register function
	add_filter( 'manage_edit-directory_columns', 'my_columns' );
	function my_columns( $columns ) {
	    $columns['directory_faculty_last'] = 'Last Name';
	    $columns['directory_faculty_directory'] = 'Faculty Type';
	    unset( $columns['comments'] );
	    return $columns;
	}

	// populate columns
	add_action( 'manage_posts_custom_column', 'populate_columns' );
	function populate_columns( $column ) {
	    if ( 'directory_faculty_last' == $column ) {
	        $faculty_last = esc_html( get_post_meta( get_the_ID(), 'faculty_last', true ) );
	        echo $faculty_last;
	    }
	    elseif ( 'directory_faculty_directory' == $column ) {
	        $faculty_directory = get_post_meta( get_the_ID(), 'faculty_directory', true );
	        if ($faculty_directory) {
	        	if ( $faculty_directory == 'fac1' ) {
	        		$faculty_directory = 'Professor';
	        	} elseif ($faculty_directory == 'fac2' ) {
	        		$faculty_directory = 'Assistant Professor';
	        	} elseif ($faculty_directory == 'fac3' ) {
	        		$faculty_directory = 'Assistant Professor';
	        	} elseif ($faculty_directory == 'res' ) {
	        		$faculty_directory = 'Research Scientists';
	        	} elseif ($faculty_directory == 'clin' ) {
	        		$faculty_directory = 'Clinical Faculty';
	        	} elseif ($faculty_directory == 'lec' ) {
	        		$faculty_directory = 'Lecturer';
	        	} elseif ($faculty_directory == 'oth' ) {
	        		$faculty_directory = 'Other';
	        	}
	        }
	        echo $faculty_directory;
	    }
	}

	// register columns as sortable
	add_filter( 'manage_edit-directory_sortable_columns', 'sort_me' );
	function sort_me( $columns ) {
	    $columns['directory_faculty_last'] = 'directory_faculty_last';
	    $columns['directory_faculty_directory'] = 'directory_faculty_directory';
	 
	    return $columns;
	}

	// enable ordering by custom field
	add_filter( 'request', 'column_orderby' );
	function column_orderby ( $vars ) {
	    if ( !is_admin() )
	        return $vars;
	    if ( isset( $vars['orderby'] ) && 'directory_faculty_last' == $vars['orderby'] ) {
	        $vars = array_merge( $vars, array( 'meta_key' => 'faculty_last', 'orderby' => 'meta_value' ) );
	    }
	   elseif ( isset( $vars['orderby'] ) && 'directory_faculty_directory' == $vars['orderby'] ) {
	      $vars = array_merge( $vars, array( 'meta_key' => 'faculty_directory', 'orderby' => 'meta_value' ) );
	   }
	    return $vars;
	}


// ADD FILTER FOR CUSTOM TAXONOMY 'PROJECT CATEGORIES' ON PROJECT PAGE
// for tutorial see: http://pippinsplugins.com/post-list-filters-for-custom-taxonomies-in-manage-posts/

	add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );
	function pippin_add_taxonomy_filters() {
	    global $typenow;
	 
	    // an array of all the taxonomies you want to display. Use the taxonomy name or slug
	    $taxonomies = array('project_categories', 'project_sponsors');
	 
	    // must set this to the post type you want the filter(s) displayed on
	    if( $typenow == 'projects' ){
	 
	        foreach ($taxonomies as $tax_slug) {
	            $tax_obj = get_taxonomy($tax_slug);
	            $tax_name = $tax_obj->labels->name;
	            $terms = get_terms($tax_slug);
	            if(count($terms) > 0) {
	                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
	                echo "<option value=''>Show All $tax_name</option>";
	                foreach ($terms as $term) { 
	                    $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
	                    echo '<option value='. $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
	                }
	                echo "</select>";
	            }
	        }
	    }
	}


?>