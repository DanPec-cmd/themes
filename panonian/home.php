<?php
/**
 * The template for displaying the main Blog/Posts Index page.
 * Location: yourtheme/home.php
 */

get_header(); ?>

<!-- Cover / Hero Section -->
<div class="panonian-blog-hero" style="background-color: #0a0a0a; padding: 10vh 5%; text-align: center; border-bottom: 1px solid #1f1f1f;">
	<p style="color: #e65c00; font-size: 0.9rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 10px;">Dispatch</p>
	<h1 style="font-family: 'Oswald', sans-serif; font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #ffffff; margin: 0 0 15px 0;">Field Notes & News</h1>
	<p style="color: #cccccc; font-size: 1.15rem; margin: 0;">Rally reports, technical deep-dives, and product announcements.</p>
</div>

<!-- Blog Posts Grid Wrapper -->
<div class="panonian-blog-wrapper" style="background-color: #121212; color: #cccccc; padding: 80px 0 100px 0;">
	<div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">

		<?php if ( have_posts() ) : ?>

			<div class="panonian-blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px;">
				<?php while ( have_posts() ) : the_post(); ?>
					
					<article class="panonian-post-card" style="background-color: #1a1a1a; border: 1px solid #282828; display: flex; flex-direction: column; transition: border-color 0.3s ease;">
						
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" style="display: block; background-color: #0d0d0d; border-bottom: 1px solid #282828;">
								<?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 230px; object-fit: cover; display: block;' ) ); ?>
							</a>
						<?php endif; ?>

						<div class="post-card-body" style="padding: 25px; display: flex; flex-direction: column; flex-grow: 1;">
							
							<div class="post-meta" style="display: flex; gap: 10px; align-items: center; margin-bottom: 12px; font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
								<span style="color: #e65c00;">
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo esc_html( $categories[0]->name );
									}
									?>
								</span>
								<span style="color: #444;">•</span>
								<span style="color: #888888;"><?php echo get_the_date(); ?></span>
							</div>

							<h2 style="font-family: 'Oswald', sans-serif; font-size: 1.4rem; font-weight: 700; text-transform: uppercase; line-height: 1.3; margin: 0 0 12px 0;">
								<a href="<?php the_permalink(); ?>" style="color: #ffffff; text-decoration: none;"><?php the_title(); ?></a>
							</h2>

							<div style="font-size: 0.95rem; line-height: 1.6; color: #cccccc; margin-bottom: 25px;">
								<?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
							</div>

							<a href="<?php the_permalink(); ?>" class="read-more-btn" style="margin-top: auto; display: inline-block; background-color: #000000; color: #ffffff; border: 1px solid #383838; padding: 10px 20px; font-family: 'Oswald', sans-serif; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; align-self: flex-start;">
								Read Dispatch →
							</a>

						</div>

					</article>

				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="panonian-blog-pagination" style="margin-top: 60px; text-align: center;">
				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '← Prev',
					'next_text' => 'Next →',
				) );
				?>
			</div>

		<?php else : ?>
			<p style="text-align: center; color: #888;">No dispatches published yet.</p>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>