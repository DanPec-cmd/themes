<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package panonian
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'panonian' ); ?></a>

	<!-- CUSTOM RUGGED MINIMALISM HEADER -->
	<header id="masthead" class="site-header">
		<div class="header-container">
			<!-- Dynamic Home URL for Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">PANONIAN.</a>
			
			<nav class="main-nav">
				<?php
				// Output the dynamic WordPress menu
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false, // Removes the default <div> wrapper
						'menu_class'     => 'nav-list', // Applies your custom CSS class to the <ul>
						'fallback_cb'    => false,
					) );
				} else {
					// Fallback message if no menu is assigned in the dashboard yet
					echo '<ul class="nav-list"><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">Assign a menu in Appearance > Menus</a></li></ul>';
				}
				?>
			</nav>

			<div class="header-actions">
				<!-- Static placeholder: Use your translation plugin (like WPML/Polylang) switcher here later -->
				<a href="#" class="lang-switch">EN | DE</a>
				
				<!-- Dynamic WooCommerce Login/Account Link -->
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="login-link">
						<?php is_user_logged_in() ? esc_html_e( 'Account', 'panonian' ) : esc_html_e( 'Login', 'panonian' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" class="login-link">Login</a>
				<?php endif; ?>

				<!-- Dynamic WooCommerce Cart Link & Item Count -->
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-link">
						CART (<?php echo WC()->cart->get_cart_contents_count(); ?>)
					</a>
				<?php else : ?>
					<a href="#" class="cart-link">CART (0)</a>
				<?php endif; ?>

				<button class="mobile-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation', 'panonian' ); ?>">☰</button>
			</div>
		</div>
	</header><!-- #masthead -->

	<!-- Mobile Menu Script -->
	<script>
	document.addEventListener("DOMContentLoaded", () => {
		const mobileToggle = document.querySelector(".mobile-toggle");
		const mainNav = document.querySelector(".main-nav");

		if (mobileToggle && mainNav) {
			mobileToggle.addEventListener("click", () => {
				mainNav.classList.toggle("active");
				// Swap icon between hamburger and close
				if (mainNav.classList.contains("active")) {
					mobileToggle.innerHTML = "✕"; 
				} else {
					mobileToggle.innerHTML = "☰";
				}
			});
		}
	});
	</script>