<?php
ini_set('display_error', 1);
/**
 * Lucid functions and definitions
 *
 * @package Lucid
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'lucid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function lucid_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Lucid, use a find and replace
	 * to change 'lucid' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lucid', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'featured-thumb', 400, 400, true); //300 pixels wide (and unlimited height)
	add_image_size( 'list-post', 80, 80, true ); //300 pixels wide (and unlimited height)


	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lucid' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'lucid_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // lucid_setup
add_action( 'after_setup_theme', 'lucid_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function lucid_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lucid' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'lucid_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function lucid_scripts() {
	wp_enqueue_style( 'prettify-style', "http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.css" );
	wp_enqueue_style( 'lucid-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'lucid-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	// wp_enqueue_script( 'lucid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'lucid-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// wp_enqueue_script( 'jquery-readingtime-js',  get_template_directory_uri() .  "/js/jquery-reading-time/jquery.readingTime.js", array( 'jquery' ), '20120202' );

	wp_enqueue_script( 'prettify-js',  "http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.js", null, '20120202' );

	wp_enqueue_script( 'snap-js',  get_template_directory_uri() .  "/js/snap.min.js", array( 'jquery' ), '20120202' );
	wp_enqueue_script( 'flex-slider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '20120202' );
	wp_enqueue_script( 'site', get_template_directory_uri() . '/js/site.js', array( 'jquery' ), '20120202' );
}
add_action( 'wp_enqueue_scripts', 'lucid_scripts' );


$featured_cat = get_term_by('name', 'featured', 'category');

$featured_cat = $featured_cat->term_id;

function exclude_category_home( $query ) {
    if ( $query->is_home ) {
        $query->set( 'cat', '-2' );
    }
    return $query;
}
 
add_filter( 'pre_get_posts', 'exclude_category_home' );

function am_get_content($length) {
 global $post; 
  // Set up our variable.
  $final_content = '';
 
  // Get's the content the normal way.
  $content = strip_tags($post->post_content);
 
  // If that content is longer than your character count, let's shrink it!
  if (strlen($content) > $length) {
 
    // Create an array of words from the content.
    $content_array = explode(' ',$content);
 
    // Loop through the words, get the character count,
    // and then tell it at which word we should stop.
    foreach($content_array as $key => $word){
 
      // Are we at the length? Set the key and break out of the loop.
      if ($total_length >= $length){
        $word_key = $key;
        break;
 
      // Otherwise, keep looping through.
      } else {
        $chars = strlen($word);
        $total_length = $total_length + $chars;
      }
 
    }
 
    // Now loop through that same array again, this time building
    // the $final_content variable based on at which key we should stop.
    foreach($content_array as $key => $word){
      if ($key <= $word_key){
 
        // Is this the last word in the content? Let's remove any
        // punctuation from it so it looks nice!
        if ($key == $word_key){
          $word = preg_replace('/[^a-zA-Z0-9-\s]/', '', $word);
        }
        $final_content .= $word.' ';
      }
    }
 
    // Throw in a "..." so people know there's more to read.
    $final_content = $final_content . "...";
  }else{
  	  $final_content = $content;
  }
 
  // Return the $final_content variable!
  return $final_content;
}


function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


include_once('inc/WordPress-GitHub-Plugin-Updater/updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'plugin-name', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/themeskult/lucid-theme', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/themeskult/lucid-theme/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/themeskult/lucid-theme', // the github url of your github repo
        'zip_url' => 'https://github.com/themeskult/lucid-theme/zipball/master', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > Github Updates when this example plugin is installed
    );
    new WP_GitHub_Updater($config);
}

