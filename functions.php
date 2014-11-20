<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - all functions related to custom post types
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// default thumb size
    set_post_thumbnail_size(225, 0);
    add_image_size( 'home-feature', '450px', '315px', true ); 

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
} // don't remove this bracket!

/************* REMOVE MENU ITEMS (COMMENTS AND LINKS) *********************/

// FOR THIS SITE, REMOVE COMMENT AND LINK MENUS
add_action( 'admin_menu', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
    remove_menu_page('link-manager.php');
    remove_menu_page('edit-comments.php');  
}


/************** ADD FILE TYPES TO MEDIA LIBRARY FILTERS ****************/
add_filter( 'post_mime_types', 'custom_mime_types' );
function custom_mime_types( $post_mime_types ) {
        $post_mime_types['application/msword'] = array( __( 'Word Docs' ), __( 'Manage Word Docs' ), _n_noop( 'Word Docs <span class="count">(%s)</span>', 'Word Docs <span class="count">(%s)</span>' ) );
        $post_mime_types['application/vnd.ms-excel'] = array( __( 'Excel Files' ), __( 'Manage Excel Files' ), _n_noop( 'Excel Files <span class="count">(%s)</span>', 'Excel Files <span class="count">(%s)</span>' ) );
        $post_mime_types['application/vnd.ms-powerpoint'] = array( __( 'PowerPoint Files' ), __( 'Manage PowerPoint Files' ), _n_noop( 'PowerPoint Files <span class="count">(%s)</span>', 'PowerPoint Files <span class="count">(%s)</span>' ) );
        $post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDFs <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
        $post_mime_types['application/zip'] = array( __( 'ZIPs' ), __( 'Manage ZIPs' ), _n_noop( 'ZIP <span class="count">(%s)</span>', 'ZIPs <span class="count">(%s)</span>' ) );
        
        return $post_mime_types;
}

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/*********** SHORTCODES ****************/

// Enable shortcodes in all widgets 
add_filter('widget_text', 'do_shortcode');

// INCLUDE EXTERNAL FILE: use thus: [show_file file="http://www.mysite.com/somefile.html"]
add_shortcode( 'show_file', 'show_file_func' );
function show_file_func( $atts ) {
  extract( shortcode_atts( array(
    'file' => ''
  ), $atts ) );
  if ($file!='')
    return @file_get_contents($file);
}

// Use shortcode [hidden] text [/hidden] to hide text
add_shortcode('hidden', 'my_hidden_text');
function my_hidden_text($atts, $content = null) {
    ob_start();
    echo '<!-- ' . $content . '-->';
    return ob_get_clean();
}

// Use shortcode [hidden] text [/hidden] to hide text
add_shortcode('year', 'current_year');
function current_year($atts, $content = null) {
    ob_start();
    echo date(Y);
    return ob_get_clean();
}

// Use shortcode [column] text [/column] to put text in columns
// Use shortcode [end_columns] to end columns
function columnmatic_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'class' => '',
      'width' => '',
      'height' => '',
      'padding' => '',
      'padding_top' => '',
      'padding_right' => '',
      'padding_bottom' => '',
      'padding_left' => '',
      'margin' => '',
      'margin_top' => '',
      'margin_right' => '',
      'margin_bottom' => '',
      'margin_left' => '',
      'border' => '',
      'border_top' => '',
      'border_right' => '',
      'border_bottom' => '',
      'border_left' => '',
      'background' => '',
      'color' => '',
      'float' => 'left',
      'display' => 'inline'
      // ...etc
      ), $atts ) );
   
   remove_filter('the_content', 'wpautop');

   $str =  '<div ';
   
   if($class){
      $str .=  'class="'.$class.'" ';
   }
   
   $str .= 'style="';
   if($width){
      $str .= 'width: '.$width.'; ';
   }
   if($height){
      $str .= 'height: '.$height.'; ';
   }
   if($padding){
      $str .= 'padding: '.$padding.'; ';
   }
   if($padding_top){
      $str .= 'padding-top: '.$padding_top.'; ';
   }
   if($padding_right){
      $str .= 'padding-right: '.$padding_right.'; ';
   }
   if($padding_bottom){
      $str .= 'padding-bottom: '.$padding_bottom.'; ';
   }
   if($padding_left){
      $str .= 'padding-left: '.$padding_left.'; ';
   }
   if($margin){
      $str .= 'margin: '.$margin.'; ';
   }
   if($margin_top){
      $str .= 'margin-top: '.$margin_top.'; ';
   }
   if($margin_right){
      $str .= 'margin-right: '.$margin_right.'; ';
   }
   if($margin_bottom){
      $str .= 'margin-bottom: '.$margin_bottom.'; ';
   }
   if($margin_left){
      $str .= 'margin-left: '.$margin_left.'; ';
   }
   if($border){
      $str .= 'border: '.$border.'; ';
   }
   if($border_top){
      $str .= 'border-top: '.$border_top.'; ';
   }
   if($border_right){
      $str .= 'border-right: '.$border_right.'; ';
   }
   if($border_bottom){
      $str .= 'border-bottom: '.$border_bottom.'; ';
   }
   if($border_left){
      $str .= 'border-left: '.$border_left.'; ';
   }
   if($background){
      $str .= 'background: '.$background.'; ';
   }
   if($color){
      $str .= 'color: '.$color.'; ';
   }
   if($float){
      $str .= 'float: '.$float.'; ';
   }
   if($display){
      $str .= 'display: '.$display.'; ';
   }
   $str .= '">' . do_shortcode($content) . '</div>';
   return $str;
}

function end_columnmatic_shortcode(){
   return "<div style='clear: both;'></div>";
   
}
//fix the wonky spacing issue with wpautop and shortcodes
//see: http://wordpress.org/support/topic/getting-shortcodes-with-content-to-play-nice-with-wpautop
add_filter( 'the_content', 'wpautop',20 );
add_shortcode('column', 'columnmatic_shortcode');
add_shortcode('end_columns', 'end_columnmatic_shortcode');

/*********** ADDITIONAL FUNCTIONS ****************/

// HOME FEATURE TRANSIENT DELETE
// Add the function to the save_post hook so it runs when posts are published
add_action( 'save_post', 'mm_delete_transients' );
function mm_delete_transients() {
  $post = get_post($post_id);
  if ($post->post_type == 'featured') {
      delete_transient( 'features' ); 
  } elseif ($post->post_type == 'directory') {
      delete_transient( 'dir_query' );
  }
}

// CHANGE NAME OF OPTIONS PAGE (SEE http://www.advancedcustomfields.com/resources/filters/acfoptions_pagesettings/)
add_filter('acf/options_page/settings', 'my_acf_options_page_settings');
function my_acf_options_page_settings( $settings ) {
  $settings['title'] = 'Footer';
  return $settings;
}
 
if(function_exists("register_options_page")) {
    //register_options_page('Header');
    register_options_page('Footer');
}


// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
    if ( substr ( $widget_title, 0, 1 ) == '!' )
        return;
    else 
        return ( $widget_title );
}

// LIMIT WORDS IN EXCERPTS
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// VIDEO
// remove dimensions from oEmbed videos
add_filter( 'embed_oembed_html', 'tdd_oembed_filter', 10, 4 ) ; 
function tdd_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<figure class="video-container">'.$html.'</figure>';
    return $return;
}

// GET FEATURED IMAGE OR FIRST ATTACHMENT OR VIDEO
function vp_get_thumb_url($text, $size, $feature = false){
    global $post;
    $imageurl="";
    //echo get_queried_object_id();
    //echo $post->ID;
    //$post_id = get_queried_object();
    // Check to see which image is set as "Featured Image"
    //$featuredimg = get_post_thumbnail_id($post->ID);
    $featuredimg = get_post_thumbnail_id($post_id);
    
    // Get source for featured image
    $img_src = wp_get_attachment_image_src($featuredimg, $size);
    // Set $imageurl to Featured Image
    $imageurl=$img_src[0];
    
    if ($feature == false) {
    
        // If there is no "Featured Image" set, move on and get the first image attached to the post
        if (!$imageurl) {
            // Extract the thumbnail from the first attached imaged
            $allimages =&get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
            
            foreach ($allimages as $img){
                $img_src = wp_get_attachment_image_src($img->ID, $size);
                break;
            }
            // Set $imageurl to first attached image
            $imageurl=$img_src[0];
        }
        
        // If there is no image attached to the post, look for anything that looks like an image and get that
        if (!$imageurl) {
            preg_match('/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i' , $text, $matches);
            $imageurl=$matches[1];
        }
        
        // If there's no image attached or inserted in the post, look for a YouTube video
        if (!$imageurl){
            // look for traditional youtube.com url from address bar
            preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
            $youtubeurl = $matches2[0];
            $videokey = $matches2[3];
        if (!$youtubeurl) {
            // look for youtu.be 'embed' url
            preg_match("/([a-zA-Z0-9\-\_]+\.|)youtu\.be\/([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
            $youtubeurl = $matches2[0];
            $videokey = $matches2[2];
        }
        if ($youtubeurl)
            // Get the thumbnail YouTube automatically generates
            // '0' is the biggest version, use 1 2 or 3 for smaller versions
            $imageurl = "http://i.ytimg.com/vi/{$videokey}/0.jpg";
        }
        
    }
    
    // Spit out the image path
    return $imageurl;
}

// FILTER WORDPRESS SEO BY YOAST
    // remove WP-SEO columns from edit-list pages in admin
    add_filter( 'wpseo_use_page_analysis', '__return_false' );
    // put WP-SEO panel at bottom of edit screens (low priority)
    add_filter('wpseo_metabox_prio' , 'my_wpseo_metabox_prio' );
    function my_wpseo_metabox_prio() {
        return 'low' ;                                
    }


// EASY CALL TO GET CUSTOM FIELD VALUES; set 'true' to echo value, 'false' to return
function get_custom_field_value($szKey, $bPrint = false) {
    global $post;
    $szValue = get_post_meta($post->ID, $szKey, true);
    if ( $bPrint == false ) return $szValue; else echo $szValue;
}

function current_page_url() {
    $pageURL = 'http';
    if( isset($_SERVER["HTTPS"]) ) {
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

// ENCODE ALL EMAILS
// see http://wordpress.org/extend/plugins/email-address-encoder/ (version 1.0.3)

/**
 * Register filters to encode exposed email addresses in
 * posts, pages, excerpts, comments and widgets.
 */
foreach (array('the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt') as $filter) {
  add_filter($filter, 'eae_encode_emails', 1000);
}

/**
 * Searches for plain email addresses in given $string and
 * encodes them (by default) with the help of eae_encode_str().
 * 
 * Regular expression is based on based on John Gruber's Markdown.
 * http://daringfireball.net/projects/markdown/
 * 
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_emails($string) {

  // abort if $string doesn't contain a @-sign
  if (apply_filters('eae_at_sign_check', true)) {
    if (strpos($string, '@') === false) return $string;
  }

  // override encoding function with the 'eae_method' filter
  $method = apply_filters('eae_method', 'eae_encode_str');

  // override regex pattern with the 'eae_regexp' filter
  $regexp = apply_filters(
    'eae_regexp',
    '{
      (?:mailto:)?
      (?:
        [-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
      |
        ".*?"
      )
      \@
      (?:
        [-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
      |
        \[[\d.a-fA-F:]+\]
      )
    }xi'
  );

  return preg_replace_callback(
    $regexp,
    create_function(
            '$matches',
            'return '.$method.'($matches[0]);'
        ),
    $string
  );

}

/**
 * Encodes each character of the given string as either a decimal
 * or hexadecimal entity, in the hopes of foiling most email address
 * harvesting bots.
 *
 * Based on Michel Fortin's PHP Markdown:
 *   http://michelf.com/projects/php-markdown/
 * Which is based on John Gruber's original Markdown:
 *   http://daringfireball.net/projects/markdown/
 * Whose code is based on a filter by Matthew Wickline, posted to
 * the BBEdit-Talk with some optimizations by Milian Wolff.
 *
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_str($string) {

  $chars = str_split($string);
  $seed = mt_rand(0, (int) abs(crc32($string) / strlen($string)));

  foreach ($chars as $key => $char) {

    $ord = ord($char);

    if ($ord < 128) { // ignore non-ascii chars

      $r = ($seed * (1 + $key)) % 100; // pseudo "random function"

      if ($r > 60 && $char != '@') ; // plain character (not encoded), if not @-sign
      else if ($r < 45) $chars[$key] = '&#x'.dechex($ord).';'; // hexadecimal
      else $chars[$key] = '&#'.$ord.';'; // decimal (ascii)

    }

  }

  return implode('', $chars);

}

remove_action('tribe_events_single_event_after_the_meta', 'tribe_single_related_events');

?>