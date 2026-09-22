<?php
/**
 * Template part for displaying page content in page.php (PRO Edition)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package panonian
 */

$panonian_subtitle = get_post_meta( get_the_ID(), 'page_subtitle', true );
$panonian_hero_bg  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_header_image();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'panonian-page-article' ); ?> itemscope itemtype="https://schema.org/WebPage">
    
    <?php if ( ! is_front_page() ) : ?>
        <!-- PRO INNER PAGE HERO HEADER -->
        <header class="page-hero <?php echo $panonian_hero_bg ? 'has-hero-bg' : 'no-hero-bg'; ?>">
            <?php if ( $panonian_hero_bg ) : ?>
                <div class="page-hero-bg" style="background-image: url('<?php echo esc_url( $panonian_hero_bg ); ?>');"></div>
            <?php endif; ?>
            <div class="page-hero-overlay"></div>

            <div class="page-hero-container">
                <!-- Dynamic Breadcrumbs -->
                <nav class="panonian-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb Navigation', 'panonian' ); ?>">
                    <?php
                    if ( function_exists( 'yoast_breadcrumb' ) ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
                    } elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
                        rank_math_the_breadcrumbs();
                    } else {
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'panonian' ) . '</a> <span class="sep">/</span> <span class="current">' . esc_html( get_the_title() ) . '</span>';
                    }
                    ?>
                </nav>

                <?php the_title( '<h1 class="page-title" itemprop="headline">', '</h1>' ); ?>

                <?php if ( ! empty( $panonian_subtitle ) ) : ?>
                    <p class="page-subtitle"><?php echo esc_html( $panonian_subtitle ); ?></p>
                <?php endif; ?>

                <div class="page-meta-bar">
                    <span class="meta-item"><span class="meta-label"><?php esc_html_e( 'LAST UPDATED:', 'panonian' ); ?></span> <?php echo get_the_modified_date(); ?></span>
                </div>
            </div>
        </header>
    <?php endif; ?>

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">
        <div class="entry-content" itemprop="mainContentOfPage">
            <?php
            the_content();

            wp_link_pages(
                array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'panonian' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <?php if ( get_edit_post_link() ) : ?>
            <footer class="entry-footer">
                <?php
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit Page <span class="screen-reader-text">%s</span>', 'panonian' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
                ?>
            </footer><!-- .entry-footer -->
        <?php endif; ?>
    </div><!-- .page-content-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->