<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AndrewRMinion_Design_2018
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'andrewrminion' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <a href="<?php echo home_url(); ?>" class="custom-logo-link" rel="home" itemprop="url"><img class="custom-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ARMD-logo.svg" alt="AndrewRMinion Design" /></a>
            <?php
            if ( get_field( 'custom_header' ) !== '' && ! is_null( get_field( 'custom_header' ) ) ) {
                $title = get_field( 'custom_header' );
            } else {
                if ( is_singular() ) {
                    $page_title = ucwords( get_the_title() );
                } elseif ( is_archive() || is_tax() ) {
                    $page_title = ucwords( get_the_archive_title() );
                }
                $title = lcfirst( str_replace( ' ', '<wbr>', $page_title ) );
            }
            ?>
            <h1 class="page-title">&lt;<?php echo $title ?>/&gt;</h1>
        </div><!-- .site-branding -->
        <?php
        if ( get_field( 'page_description' ) !== '' && ! is_null( get_field( 'page_description' ) ) ) { ?>
            <div class="page-description"><?php the_field( 'page_description' ); ?></div>
        <?php
        } ?>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'andrewrminion' ); ?></button>
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                ) );
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
