<?php
/**
 * Custom Single Product Template
 * Location: yourtheme/woocommerce/single-product.php
 *
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<!-- Scoped CSS for cleaner HTML and Mobile Responsiveness -->
<style>
	.panonian-single-product-wrapper { background-color: #121212; color: #f5f5f5; padding: 40px 0 80px 0; }
	.panonian-container { max-width: 1300px; margin: 0 auto; padding: 0 20px; }
	.panonian-product-grid { display: flex; flex-wrap: wrap; gap: 60px; align-items: flex-start; }
	
	/* Layout Sizing */
	.panonian-product-gallery { flex: 1 1 50%; min-width: 320px; }
	.panonian-product-summary { flex: 1 1 40%; min-width: 320px; position: sticky; top: 120px; } /* Sticky right column */
	
	/* Typography & Colors */
	.panonian-accent { color: #E65C00; }
	.panonian-title { font-family: 'Oswald', sans-serif; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 700; text-transform: uppercase; line-height: 1.1; margin: 0 0 10px 0; }
	.panonian-price { font-family: 'Oswald', sans-serif; font-size: 2rem; color: #e65c00; font-weight: 700; margin-bottom: 20px; }
	
	/* Images */
	.main-image-wrap { border: 1px solid #282828; background: #0d0d0d; margin-bottom: 15px; overflow: hidden; }
	#panonian-main-img { width: 100%; height: auto; display: block; transition: opacity 0.2s ease-in-out; }
	.gallery-thumbs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 15px; }
	.thumb-item { border: 1px solid #282828; cursor: pointer; transition: border-color 0.2s ease; opacity: 0.7; }
	.thumb-item:hover, .thumb-item.active { border-color: #E65C00; opacity: 1; }
	
	/* Buttons & Boxes */
	.panonian-add-to-cart-box { background: #1a1a1a; padding: 25px; border: 1px solid #282828; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
	.product-perks p { color: #a0a0a0; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0; display: flex; align-items: center; }
	.product-perks p svg { width: 16px; height: 16px; margin-right: 10px; fill: currentColor; }

	/* WooCommerce Overrides */
	.panonian-add-to-cart-box .quantity input { background: #0d0d0d; border: 1px solid #333; color: #fff; padding: 10px; }
	.panonian-add-to-cart-box button.single_add_to_cart_button { background: #E65C00; color: #fff; border: none; font-family: 'Oswald', sans-serif; text-transform: uppercase; font-weight: 700; padding: 15px 30px; transition: background 0.3s ease; }
	.panonian-add-to-cart-box button.single_add_to_cart_button:hover { background: #ff7010; }
	
	@media (max-width: 992px) {
		.panonian-product-summary { position: static; }
		.panonian-product-grid { gap: 40px; }
	}
</style>

<?php while ( have_posts() ) : the_post(); global $product; ?>

	<!-- Breadcrumbs & Notices -->
	<div class="panonian-breadcrumbs-bar" style="background-color: #0a0a0a; padding: 20px 0; border-bottom: 1px solid #1f1f1f;">
		<div class="panonian-container">
			<?php woocommerce_breadcrumb( array(
				'delimiter'   => ' <span style="color:#444;">/</span> ',
				'wrap_before' => '<nav class="panonian-breadcrumbs" style="color: #888; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">',
				'wrap_after'  => '</nav>',
			) ); ?>
		</div>
	</div>
	
	<div class="panonian-container" style="margin-top: 20px;">
		<?php wc_print_notices(); // CRITICAL: Displays "Added to cart" success messages ?>
	</div>

	<!-- Main Single Product Area -->
	<div class="panonian-single-product-wrapper">
		<div class="panonian-container">
			
			<div class="panonian-product-grid">

				<!-- Left Column: Dynamic Product Images & Gallery -->
				<div class="panonian-product-gallery">
					<div class="main-image-wrap">
						<?php
						if ( has_post_thumbnail() ) {
							$image_url = wp_get_attachment_image_url( $product->get_image_id(), 'full' );
							echo '<img id="panonian-main-img" src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
						} else {
							echo wc_placeholder_img( 'full' );
						}
						?>
					</div>

					<?php
					$attachment_ids = $product->get_gallery_image_ids();
					if ( $attachment_ids ) : ?>
						<div class="gallery-thumbs-grid">
							<?php
							// Featured image as first thumb
							if ( has_post_thumbnail() ) {
								echo '<div class="thumb-item active"><img src="' . esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'medium' ) ) . '" data-full="' . esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'full' ) ) . '" style="width: 100%; height: 80px; object-fit: cover; display: block;" /></div>';
							}
							// Gallery images
							foreach ( $attachment_ids as $attachment_id ) {
								$thumb_url = wp_get_attachment_image_url( $attachment_id, 'medium' );
								$full_url  = wp_get_attachment_image_url( $attachment_id, 'full' );
								echo '<div class="thumb-item"><img src="' . esc_url( $thumb_url ) . '" data-full="' . esc_url( $full_url ) . '" style="width: 100%; height: 80px; object-fit: cover; display: block;" /></div>';
							}
							?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Right Column: Product Summary & Purchasing -->
				<div class="panonian-product-summary">

					<div class="product-meta-top" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 15px;">
						<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span style="color: #888; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">', '</span>' ); ?>
						
						<?php if ( $product->get_sku() ) : ?>
							<span style="color: #444;">|</span>
							<span class="sku-badge" style="color: #777; font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
								SKU: <?php echo esc_html( $product->get_sku() ); ?>
							</span>
						<?php endif; ?>
					</div>

					<h1 class="panonian-title"><?php the_title(); ?></h1>
					
					<!-- Product Rating (Shows stars if reviewed) -->
					<div style="margin-bottom: 15px;">
						<?php woocommerce_template_single_rating(); ?>
					</div>

					<div class="panonian-price">
						<?php echo $product->get_price_html(); ?>
						<span style="font-size: 0.85rem; color: #888; font-weight: 400; vertical-align: middle; letter-spacing: 1px;">(VAT INC)</span>
					</div>

					<?php if ( $post->post_excerpt ) : ?>
						<div class="product-short-description" style="color: #ccc; font-size: 1rem; line-height: 1.7; margin-bottom: 30px;">
							<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
						</div>
					<?php endif; ?>

					<!-- Native WooCommerce Add to Cart -->
					<div class="panonian-add-to-cart-box">
						<?php woocommerce_template_single_add_to_cart(); ?>
					</div>

					<!-- Hardware Perks -->
					<div class="product-perks" style="border-top: 1px solid #222; border-bottom: 1px solid #222; padding: 20px 0;">
						<?php 
						// Dynamic Stock Check
						if ( $product->is_in_stock() ) {
							echo '<p style="color: #4caf50;"><span style="color: inherit; font-size: 1.2rem; margin-right: 8px;">✔</span> In Stock — Ready to Dispatch</p>';
						} else {
							echo '<p style="color: #e65c00;"><span style="color: inherit; font-size: 1.2rem; margin-right: 8px;">⚠</span> Out of Stock / Backordered</p>';
						}
						?>
						<p><span class="panonian-accent" style="font-size: 1.2rem; margin-right: 8px;">✈</span> Ships directly from Nova Gradiška, Croatia</p>
						<p style="margin: 0;"><span class="panonian-accent" style="font-size: 1.2rem; margin-right: 8px;">🛡</span> Covered by Panonian 2-Year Crash Guarantee</p>
					</div>

				</div>

			</div>

			<!-- Technical Specifications & Full Description Area -->
			<div class="panonian-tech-specs-box" style="margin-top: 100px; background: #181818; border: 1px solid #282828; padding: 50px;">
				<div style="display: flex; flex-wrap: wrap; gap: 50px;">
					
					<div style="flex: 1 1 55%; min-width: 300px;">
						<h3 style="font-family: 'Oswald', sans-serif; font-size: 1.6rem; text-transform: uppercase; font-weight: 700; margin-bottom: 25px; color: #fff;">
							The Breakdown
						</h3>
						<div class="full-content" style="color: #ccc; line-height: 1.8; font-size: 1.05rem;">
							<?php the_content(); ?>
						</div>
					</div>

					<div style="flex: 1 1 35%; min-width: 280px; border-left: 1px solid #282828; padding-left: 30px;">
						<h3 style="font-family: 'Oswald', sans-serif; font-size: 1.6rem; text-transform: uppercase; font-weight: 700; margin-bottom: 25px; color: #fff;">
							Tech Specs
						</h3>
						<?php if ( $product->has_attributes() ) : ?>
							<table style="width: 100%; border-collapse: collapse;">
								<tbody>
									<?php foreach ( $product->get_attributes() as $attribute ) : ?>
										<tr style="border-bottom: 1px solid #242424;">
											<td style="padding: 12px 0; font-weight: 700; color: #e65c00; text-transform: uppercase; font-size: 0.85rem; width: 40%;">
												<?php echo wc_attribute_label( $attribute->get_name() ); ?>
											</td>
											<td style="padding: 12px 0; color: #ccc; font-size: 0.9rem; text-align: right;">
												<?php
												if ( $attribute->is_taxonomy() ) {
													$terms = wp_get_post_terms( $product->get_id(), $attribute->get_name(), 'all' );
													$c = array();
													foreach ( $terms as $term ) {
														$c[] = $term->name;
													}
													echo esc_html( implode( ', ', $c ) );
												} else {
													echo esc_html( implode( ', ', $attribute->get_options() ) );
												}
												?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php else : ?>
							<p style="color: #888; font-size: 0.95rem; font-style: italic;">Heavy-duty precision engineered components built for extreme adventure riding.</p>
						<?php endif; ?>
					</div>

				</div>
			</div>

			<!-- Dynamic Related Products -->
			<div class="panonian-related-section" style="margin-top: 100px; padding-top: 60px; border-top: 1px solid #1f1f1f;">
				<h2 style="font-family: 'Oswald', sans-serif; font-size: 2rem; text-transform: uppercase; font-weight: 700; text-align: center; margin-bottom: 50px; color: #fff;">
					Complete Your Rig
				</h2>
				<?php woocommerce_output_related_products(); ?>
			</div>

		</div>
	</div>

	<!-- Upgraded Thumbnail Switcher Script (Smooth Fade) -->
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const mainImg = document.getElementById('panonian-main-img');
		const thumbs = document.querySelectorAll('.gallery-thumbs-grid .thumb-item');
		
		thumbs.forEach(thumb => {
			thumb.addEventListener('click', function() {
				const fullUrl = this.querySelector('img').getAttribute('data-full');
				if (fullUrl && mainImg && !this.classList.contains('active')) {
					
					// Fade out
					mainImg.style.opacity = 0;
					
					setTimeout(() => {
						// Swap image and fade in
						mainImg.src = fullUrl;
						mainImg.style.opacity = 1;
					}, 200); // Matches CSS transition duration

					// Update active border state
					thumbs.forEach(t => t.classList.remove('active'));
					this.classList.add('active');
				}
			});
		});
	});
	</script>

<?php endwhile; ?>

<?php get_footer( 'shop' ); ?>