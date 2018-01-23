<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AndrewRMinion_Design_2018
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'andrewrminion' ) ); ?>" rel="noreferrer">Powered by WordPress</a>
            <span class="sep"> | </span>
            <span class="font-credits">Fonts: <a href="https://www.exljbris.com/delicious.html" target="_blank" rel="noreferrer">Delicious</a> by exljbris and <a href="https://fonts.google.com/specimen/Source+Code+Pro" target="_blank" rel="noreferrer">Source Code Pro</a> by Paul D. Hunt</span>
            <span class="sep"> | </span>
            &copy;<a href="<?php echo home_url(); ?>">AndrewRMinion Design</a>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
