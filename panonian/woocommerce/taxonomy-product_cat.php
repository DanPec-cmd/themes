<?php
/**
 * The Template for displaying product categories
 * Location: yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

// Safely retrieve current taxonomy object and background meta
$current_term = get_queried_object();
$term_id      = ( isset( $current_term->term_id ) ) ? $current_term->term_id : 0;
$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
$header_bg    = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2000&auto=format&fit=crop';
?>

<!-- Scoped Dark Industrial Category Styles -->
<style>
	.panonian-cat-wrapper { 
		background-color: #121212; 
		color: #f5f5f5; 
		padding-bottom: 100px; 
		min-height: 85vh; 
	}
	
	/* Dynamic Hero Banner */
	.panonian-cat-hero {
		position: relative;
		background-color: #0a0a0a;
		padding: 90px 20px;
		text-align: center;
		border-bottom: 1px solid #1f1f1f;
		background-image: linear-gradient(to bottom, rgba(10,10,10,0.85), rgba(18,18,18,0.95)), url('<?php echo esc_url( $header_bg ); ?>');
		background-size: cover;
		background-position: center;
	}
	.panonian-cat-eyebrow { 
		color: #e65c00; 
		font-size: 0.9rem; 
		font-weight: 700; 
		letter-spacing: 3px; 
		text-transform: uppercase; 
		margin-bottom: 8px; 
	}
	.panonian-cat-title { 
		font-family: 'Oswald', sans-serif; 
		font-size: clamp(2.8rem, 6vw, 4.5rem); 
		font-weight: 700; 
		text-transform: uppercase; 
		letter-spacing: 1px; 
		color: #ffffff; 
		margin: 0 0 15px 0; 
	}
	.panonian-cat-desc { 
		color: #cccccc; 
		font-size: 1.1rem; 
		max-width: 700px; 
		margin: 0 auto; 
		line-height: 1.6; 
	}

	/* Main Layout Container */
	.panonian-main-shop-content { 
		max-width: 1300px; 
		margin: 0 auto; 
		padding: 50px 20px 0 20px; 
	}

	/* WooCommerce Toolbar Overrides */
	.woocommerce-result-count { 
		color: #888; 
		font-size: 0.85rem; 
		text-transform: uppercase; 
		letter-spacing: 1px; 
		font-weight: 600; 
	}
	.woocommerce-ordering select { 
		background-color: #1a1a1a; 
		color: #e0e0e0; 
		border: 1px solid #333; 
		padding: 10px 15px; 
		font-family: 'Inter', sans-serif; 
		font-size: 0.85rem; 
		text-transform: uppercase; 
		border-radius: 0; 
		cursor: pointer; 
	}
	.woocommerce-ordering select:focus { 
		outline: none; 
		border-color: #E65C00; 
	}

	/* CSS Grid for Product Cards */
	ul.panonian-products-grid { 
		display: grid !important; 
		grid-template-columns: repeat(3, 1fr); 
		gap: 30px; 
		padding: 0; 
		margin: 30px 0 50px 0; 
		list-style: none !important; 
	}
	ul.panonian-products-grid li.panonian-product-card { 
		width: 100% !important; 
		margin: 0 !important; 
		background-color: #1a1a1a; 
		border: 1px solid #282828; 
		padding: 20px; 
		display: flex; 
		flex-direction: column; 
		justify-content: space-between; 
		transition: border-color 0.3s ease, transform 0.3s ease; 
	}
	ul.panonian-products-grid li.panonian-product-card:hover { 
		border-color: #E65C00; 
		transform: translateY(-3px); 
	}

	/* Product Thumbnail Styling */
	.product-thumb-wrap { 
		background: #0d0d0d; 
		border: 1px solid #282828; 
		margin-bottom: 15px; 
		overflow: hidden; 
	}
	.product-thumb-wrap img { 
		width: 100%; 
		height: 260px; 
		object-fit: cover; 
		display: block; 
		transition: transform 0.3s ease; 
	}
	li.panonian-product-card:hover .product-thumb-wrap img { 
		transform: scale(1.04); 
	}

	/* Add to Cart Button Styling */
	.panonian-card-actions .button { 
		background-color: #222 !important; 
		color: #fff !important; 
		border-radius: 0 !important; 
		text-transform: uppercase; 
		font-family: 'Oswald', sans-serif !important; 
		font-size: 0.85rem !important; 
		letter-spacing: 1px; 
		padding: 12px 20px !important; 
		width: 100%;
		text-align: center;
		display: block;
		text-decoration: none;
		transition: background 0.3s ease !important; 
	}
	.panonian-card-actions .button:hover { 
		background-color: #E65C00 !important; 
	}

	/* Pagination Component */
	.panonian-pagination { 
		margin-top: 50px; 
		text-align: center; 
	}
	.panonian-pagination .page-numbers { 
		display: inline-flex; 
		gap: 8px; 
		list-style: none; 
		padding: 0; 
	}
	.panonian-pagination .page-numbers a, 
	.panonian-pagination .page-numbers span { 
		padding: 10px 16px; 
		background: #1a1a1a; 
		border: 1px solid #282828; 
		color: #fff; 
		text-decoration: none; 
		font-family: 'Oswald', sans-serif; 
	}
	.panonian-pagination .page-numbers span.current { 
		background: #E65C00; 
		border-color: #E65C00; 
	}

	@media (max-width: 992px) {
		ul.panonian-products-grid { grid-template-columns: repeat(2, 1fr); }
	}
	@media (max-width: 576px) {
		ul.panonian-products-grid { grid-template-columns: 1fr; }
	}
</style>

<div class="panonian-cat-wrapper">

	<!-- Dynamic Hero Section -->
	<div class="panonian-cat-hero">
		<div style="max-width: 1300px; margin: 0 auto;">
			<p class="panonian-cat-eyebrow">Verified Protection & Hardware</p>
			<h1 class="panonian-cat-title">
				<?php echo esc_html( isset( $current_term->name ) ? $current_term->name : 'Category' ); ?>
			</h1>
			<?php if ( ! empty( $current_term->description ) ) : ?>
				<div class="panonian-cat-desc"><?php echo wp_kses_post( $current_term->description ); ?></div>
			<?php else : ?>
				<p class="panonian-cat-desc">Heavy-duty precision-engineered components built to withstand extreme adventure routing.</p>
			<?php endif; ?>
		</div>
	</div>

	<!-- Main Catalog Loop -->
	<div class="panonian-main-shop-content">
		<?php
		do_action( 'woocommerce_before_main_content' );

		// Handle pagination safely
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		// Force explicit taxonomy query
		$args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 12,
			'paged'          => $paged,
			'tax_query'      => array(
				array(
					'taxonomy'         => 'product_cat',
					'field'            => 'term_id',
					'terms'            => $term_id,
					'include_children' => true,
				),
			),
		);

		$cat_query = new WP_Query( $args );

		if ( $cat_query->have_posts() ) {

			do_action( 'woocommerce_before_shop_loop' );

			echo '<ul class="panonian-products-grid products">';

			while ( $cat_query->have_posts() ) {
				$cat_query->the_post();
				$product = wc_get_product( get_the_ID() );

				if ( ! $product ) {
					continue;
				}
				?>

				<li <?php wc_product_class( 'panonian-product-card', $product ); ?>>
					<a href="<?php the_permalink(); ?>" style="text-decoration: none; display: block; flex-grow: 1;">
						<div class="product-thumb-wrap">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'woocommerce_thumbnail', array( 
									'alt' => esc_attr( get_the_title() ) 
								) );
							} else {
								echo wc_placeholder_img( 'woocommerce_thumbnail' );
							}
							?>
						</div>

						<span style="color: #777; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
							<?php echo $product->get_sku() ? 'SKU: ' . esc_html( $product->get_sku() ) : 'Panonian Hardware'; ?>
						</span>

						<h2 style="font-family: 'Oswald', sans-serif; font-size: 1.25rem; text-transform: uppercase; color: #ffffff; margin: 8px 0 10px 0; line-height: 1.2;">
							<?php the_title(); ?>
						</h2>

						<div style="font-family: 'Oswald', sans-serif; font-size: 1.2rem; color: #E65C00; font-weight: 700; margin-bottom: 20px;">
							<?php echo $product->get_price_html(); ?>
						</div>
					</a>

					<div class="panonian-card-actions" style="margin-top: auto;">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				</li>

				<?php
			}

			echo '</ul>';

			// Render Pagination
			echo '<div class="panonian-pagination">';
			echo paginate_links( array(
				'total'   => $cat_query->max_num_pages,
				'current' => $paged,
				'type'    => 'list',
			) );
			echo '</div>';

			wp_reset_postdata();

			do_action( 'woocommerce_after_shop_loop' );

		} else {
			echo '<div style="text-align: center; padding: 80px 0; color: #888;">';
			echo '<h3 style="font-family: \'Oswald\', sans-serif; text-transform: uppercase; color: #fff; margin-bottom: 10px; font-size: 1.8rem;">No Hardware Found in this Sector</h3>';
			echo '<p>Products are currently being restocked or assigned to this category.</p>';
			echo '</div>';
		}

		do_action( 'woocommerce_after_main_content' );
		?>
	</div>

</div>

<?php
get_footer( 'shop' );