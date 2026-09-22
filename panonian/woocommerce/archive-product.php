<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<!-- Scoped Dark Industrial Store Styles -->
<style>
	.panonian-store-wrapper { background-color: #121212; color: #f5f5f5; padding-bottom: 100px; }
	
	/* Hero Section */
	.panonian-store-hero { background-color: #0a0a0a; padding: 70px 0; border-bottom: 1px solid #1f1f1f; text-align: center; }
	.panonian-store-title { font-family: 'Oswald', sans-serif; font-size: clamp(2.8rem, 6vw, 4.5rem); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #ffffff; margin: 0 0 10px 0; }
	.panonian-store-subtitle { color: #cccccc; font-size: 1.15rem; max-width: 600px; margin: 0 auto; line-height: 1.6; }

	/* Category Grid (Shows only on main shop root) */
	.panonian-category-grid-section { background-color: #161616; padding: 50px 0; border-bottom: 1px solid #222; }
	.panonian-cat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; max-width: 1300px; margin: 0 auto; padding: 0 20px; }
	.panonian-cat-card { position: relative; height: 180px; overflow: hidden; border: 1px solid #282828; text-decoration: none; display: flex; align-items: flex-end; padding: 20px; transition: border-color 0.3s ease, transform 0.3s ease; }
	.panonian-cat-card:hover { border-color: #E65C00; transform: translateY(-3px); }
	.panonian-cat-card img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6); transition: transform 0.5s ease; }
	.panonian-cat-card:hover img { transform: scale(1.08); }
	.panonian-cat-card::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 10%, rgba(0,0,0,0.2) 100%); }
	.panonian-cat-content { position: relative; z-index: 2; width: 100%; }
	.panonian-cat-title { font-family: 'Oswald', sans-serif; font-size: 1.3rem; text-transform: uppercase; color: #fff; margin: 0 0 5px 0; font-weight: 700; }
	.panonian-cat-count { font-size: 0.8rem; color: #E65C00; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

	/* Main Content Area */
	.panonian-main-shop-content { max-width: 1300px; margin: 0 auto; padding: 50px 20px 0 20px; }

	/* WooCommerce Control Overrides (Sorting & Results Count) *//* Added missing bracket/closing tag */
	.woocommerce-result-count { color: #888; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
	.woocommerce-ordering select { background-color: #1a1a1a; color: #e0e0e0; border: 1px solid #333; padding: 10px 15px; font-family: 'Inter', sans-serif; font-size: 0.85rem; text-transform: uppercase; border-radius: 0; cursor: pointer; }
	.woocommerce-ordering select:focus { outline: none; border-color: #E65C00; }

	/* Product Grid Override for Archive */
	.woocommerce ul.products { display: grid !important; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 0; margin: 30px 0 50px 0; list-style: none; }
	.woocommerce ul.products::before, .woocommerce ul.products::after { display: none !important; }
	.woocommerce ul.products li.product { width: 100% !important; margin: 0 !important; float: none !important; background-color: #1a1a1a; border: 1px solid #282828; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: border-color 0.3s ease, transform 0.3s ease; }
	.woocommerce ul.products li.product:hover { border-color: #E65C00; transform: translateY(-3px); }
	.woocommerce ul.products li.product img { width: 100%; height: 250px; object-fit: cover; margin-bottom: 15px; background: #0d0d0d; }
	.woocommerce ul.products li.product .woocommerce-loop-product__title { font-family: 'Oswald', sans-serif !important; font-size: 1.2rem !important; text-transform: uppercase; color: #fff !important; margin: 10px 0 !important; }
	.woocommerce ul.products li.product .price { color: #E65C00 !important; font-family: 'Oswald', sans-serif; font-size: 1.15rem !important; font-weight: 700; margin-bottom: 15px !important; }
	.woocommerce ul.products li.product .button { background-color: #222 !important; color: #fff !important; border-radius: 0 !important; text-transform: uppercase; font-family: 'Oswald', sans-serif !important; font-size: 0.85rem !important; letter-spacing: 1px; padding: 10px 15px !important; transition: background 0.3s ease !important; }
	.woocommerce ul.products li.product .button:hover { background-color: #E65C00 !important; }

	@media (max-width: 992px) {
		.woocommerce ul.products { grid-template-columns: repeat(2, 1fr); }
	}
	@media (max-width: 576px) {
		.woocommerce ul.products { grid-template-columns: 1fr; }
	}
</style>

<div class="panonian-store-wrapper">

	<!-- Shop Hero Header -->
	<div class="panonian-store-hero">
		<div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
			<?php
			if ( function_exists( 'woocommerce_shop_loop_header' ) ) {
				do_action( 'woocommerce_shop_loop_header' );
			} else {
				echo '<p style="color:#e65c00; font-size:0.9rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; margin-bottom:8px;">Heavy-Duty Hardware</p>';
				echo '<h1 class="panonian-store-title">' . ( is_product_taxonomy() ? single_term_title( '', false ) : 'The Armory' ) . '</h1>';
				echo '<p class="panonian-store-subtitle">Precision-engineered protection and luggage systems for adventure motorcycles.</p>';
			}
			?>
		</div>
	</div>

	<!-- Category Quick-Jump Grid (Shows only on main /shop/ archive root) -->
	<?php if ( ! is_product_taxonomy() && ! is_search() ) : ?>
		<div class="panonian-category-grid-section">
			<div class="panonian-cat-grid">
				<?php
				$product_categories = get_terms( array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
					'exclude'    => get_option( 'default_product_cat' ), // Excludes Uncategorized
				) );

				if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
					foreach ( $product_categories as $category ) {
						$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
						$image_url    = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=600&auto=format&fit=crop';
						$term_link    = get_term_link( $category );
						
						echo '<a href="' . esc_url( $term_link ) . '" class="panonian-cat-card">';
						echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
						echo '<div class="panonian-cat-content">';
						echo '<h3 class="panonian-cat-title">' . esc_html( $category->name ) . '</h3>';
						echo '<span class="panonian-cat-count">' . esc_html( $category->count ) . ' Parts Available</span>';
						echo '</div>';
						echo '</a>';
					}
				}
				?>
			</div>
		</div>
	<?php endif; ?>

	<!-- Main Product Archive Section -->
	<div class="panonian-main-shop-content">
		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 */
		do_action( 'woocommerce_before_main_content' );

		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 */
			do_action( 'woocommerce_no_products_found' );
		}

		/**
		 * Hook: woocommerce_after_main_content.
		 */
		do_action( 'woocommerce_after_main_content' );
		?>
	</div>

</div>

<?php
get_footer( 'shop' );