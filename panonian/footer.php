<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package panonian
 */
?>

    <footer id="colophon" class="site-footer custom-footer">
        <div class="footer-container">
            <div class="footer-grid">
                
                <!-- Column 1: Brand & Contact -->
                <div class="footer-col">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">PANONIAN.</a>
                    <p class="footer-tagline"><?php esc_html_e( '100% Made in Europe.', 'panonian' ); ?></p>
                    <div class="footer-contact">
                        <p>Industrijska ul. 23<br>35400 Nova Gradiška<br>Croatia</p>
                        <p>
                            <a href="mailto:info@panonian.com">info@panonian.com</a><br>
                            <a href="tel:+385917815669">+385 91 781 5669</a>
                        </p>
                    </div>
                </div>

                <!-- Column 2: Legal Info -->
                <div class="footer-col">
                    <h4><?php esc_html_e( 'Legal Info', 'panonian' ); ?></h4>
                    <ul>
                        <!-- Make sure these slugs match your actual legal pages in WordPress -->
                        <li><a href="<?php echo esc_url( home_url( '/shipping-returns-warranty/' ) ); ?>"><?php esc_html_e( 'Shipping, Returns & Warranty', 'panonian' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'panonian' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'panonian' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'panonian' ); ?></a></li>
                    </ul>
                </div>

                <!-- Column 3: Social & Community -->
                <div class="footer-col">
                    <h4><?php esc_html_e( 'Follow the Ride', 'panonian' ); ?></h4>
                    <ul>
                        <li><a href="https://instagram.com/panonian" target="_blank" rel="noopener noreferrer">Instagram (#RidePanonian)</a></li>
                        <li><a href="https://youtube.com/panonian" target="_blank" rel="noopener noreferrer">YouTube</a></li>
                        <li><a href="https://facebook.com/panonian" target="_blank" rel="noopener noreferrer">Facebook</a></li>
                    </ul>
                </div>

            </div><!-- .footer-grid -->

            <div class="footer-bottom">
                <!-- Dynamically grabs the current year so it's always up to date -->
                <p>&copy; <?php echo date( 'Y' ); ?> Panonian Engineering d.o.o. <?php esc_html_e( 'All rights reserved.', 'panonian' ); ?></p>
            </div>
        </div><!-- .footer-container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>