<?php
/**
 * AndrewRMinion Design 2018 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AndrewRMinion_Design_2018
 */

define( 'ARMD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

if ( ! function_exists( 'andrewrminion_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function andrewrminion_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on AndrewRMinion Design 2018, use a find and replace
         * to change 'andrewrminion' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'andrewrminion', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'andrewrminion' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'andrewrminion_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'andrewrminion_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function andrewrminion_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'andrewrminion_content_width', 640 );
}
add_action( 'after_setup_theme', 'andrewrminion_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function andrewrminion_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'andrewrminion' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'andrewrminion' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'andrewrminion_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function andrewrminion_scripts() {
    wp_enqueue_style( 'andrewrminion-style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), ARMD_THEME_VERSION );

    wp_enqueue_script( 'andrewrminion-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), ARMD_THEME_VERSION, true );

    wp_enqueue_script( 'andrewrminion-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), ARMD_THEME_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    $webfonts = "
    WebFont.load({
        custom: {
            families: ['Delicious:n4,i4,n7,i7,n8', 'Delicious Small Caps'],
            urls: ['" . get_stylesheet_directory_uri() . "/assets/fonts/stylesheet.css']
        },
        google: {
          families: ['Source Code Pro:400,700']
        },
    });";

    wp_enqueue_script( 'webfont-loader', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js' );
    wp_add_inline_script( 'webfont-loader', $webfonts );
}
add_action( 'wp_enqueue_scripts', 'andrewrminion_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Allow SVG file uploads
 * @param  array $mime_types array of allowed mime types
 * @return array modified array
 */
function armd_mime_types( $mime_types ) {
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter( 'upload_mimes', 'armd_mime_types' );

/**
 * Set ACF local JSON save directory
 * @param  string $path ACF local JSON save directory
 * @return string ACF local JSON save directory
 */
function armd_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'armd_acf_json_save_point' );

/**
 * Set ACF local JSON open directory
 * @param  array $path ACF local JSON open directory
 * @return array ACF local JSON open directory
 */
function armd_acf_json_load_point( $path ) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter( 'acf/settings/load_json', 'armd_acf_json_load_point' );

/**
 * Add custom thumbnail size
 */
function armd_image_sizes() {
    add_image_size( 'portfolio-banner', 1200, 630, true );
    add_image_size( 'portfolio-banner-med', 1800, 945, true );
    add_image_size( 'portfolio-banner-large', 2400, 1260, true );
}
add_action( 'after_setup_theme', 'armd_image_sizes' );

/**
 * Register Portfolio CPT and Project Types taxonomy
 */
function armd_custom_post_type() {
    $labels = array(
        'name'                => 'Portfolio',
        'singular_name'       => 'Portfolio',
        'menu_name'           => 'Portfolio',
        'archives'            => 'Portfolio',
        'parent_item_colon'   => 'Parent Portfolio Piece:',
        'all_items'           => 'All Portfolio Pieces',
        'view_item'           => 'View Portfolio Piece',
        'add_new_item'        => 'Add New Portfolio Piece',
        'add_new'             => 'New Portfolio Piece',
        'edit_item'           => 'Edit Portfolio Piece',
        'update_item'         => 'Update Portfolio Piece',
        'search_items'        => 'Search Portfolio Pieces',
        'not_found'           => 'No portfolio pieces found',
        'not_found_in_trash'  => 'No portfolio pieces found in Trash',
    );

    $rewrite = array(
        'slug'                => 'work',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );

    $args = array(
        'label'               => 'portfolio_piece',
        'description'         => 'Portfolio',
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes', ),
        'taxonomies'          => array( 'project_types' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-portfolio',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );

    register_post_type( 'portfolio_piece', $args );

    $tax_labels = array(
        'name'                       => 'Project Types',
        'singular_name'              => 'Project Type',
        'menu_name'                  => 'Project Type',
        'all_items'                  => 'Project Types',
        'parent_item'                => 'Project Type',
        'parent_item_colon'          => 'Project Type:',
        'new_item_name'              => 'New Project Type',
        'add_new_item'               => 'Add New Project Type',
        'edit_item'                  => 'Edit Project Type',
        'update_item'                => 'Update Project Type',
        'separate_items_with_commas' => 'Separate project types with commas',
        'search_items'               => 'Search project types',
        'add_or_remove_items'        => 'Add or remove project types',
        'choose_from_most_used'      => 'Choose from the most used project types',
    );

    $tax_args = array(
        'labels'                     => $tax_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    register_taxonomy( 'project_types', 'portfolio_piece', $args );
}
add_action( 'init', 'armd_custom_post_type', 0 );

/**
 * Remove “Archives:” from archive title
 * @param  string $title default archive title
 * @return string modified archive title
 */
function armd_archive_title( $title ) {
    return str_replace( 'Archives: ', '', $title );
}
add_filter( 'get_the_archive_title', 'armd_archive_title' );

/**
 * Add custom favicons
 */
function armd_favicons() { ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=1516937130">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=1516937130">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=1516937130">
    <link rel="manifest" href="/manifest.json?v=1516937130">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=1516937130" color="#67b346">
    <link rel="shortcut icon" href="/favicon.ico?v=1516937130">
    <meta name="theme-color" content="#e9e8ea">
<?php
}
add_action( 'wp_head', 'armd_favicons' );
