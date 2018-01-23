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
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'andrewrminion' ) ); ?>"><?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'andrewrminion' ), 'WordPress' );
            ?></a>
            <span class="sep"> | </span>
            <span class="font-credits">Fonts: <a href="https://www.exljbris.com/delicious.html" target="_blank" rel="noreferrer">Delicious by exljbris</a> and <a href="https://fonts.google.com/specimen/Source+Code+Pro" target="_blank" rel="noreferrer">Source Code Pro by Paul D. Hunt</a></span>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
