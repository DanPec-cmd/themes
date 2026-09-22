<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package panonian
 */

get_header();
?>

    <main id="primary" class="site-main post-single-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>
                
                <!-- POST HERO HEADER -->
                <header class="post-hero">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-hero-bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>');"></div>
                    <?php endif; ?>
                    <div class="post-hero-overlay"></div>

                    <div class="post-hero-container">
                        <div class="post-meta-top">
                            <span class="post-category"><?php the_category( ' ' ); ?></span>
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </div>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <div class="post-author">
                            <?php esc_html_e( 'BY', 'panonian' ); ?> <?php the_author(); ?>
                        </div>
                    </div>
                </header>

                <!-- POST CONTENT -->
                <div class="post-content-container">
                    <div class="post-entry-content">
                        <?php
                        the_content();

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'panonian' ),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div>

                    <!-- POST TAGS -->
                    <?php if ( has_tag() ) : ?>
                        <div class="post-tags">
                            <?php the_tags( '<span class="tags-title">' . esc_html__( 'TAGS:', 'panonian' ) . '</span> ', ' ' ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- POST NAVIGATION -->
                <div class="post-nav-container">
                    <?php
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( '← PREVIOUS ARTICLE', 'panonian' ) . '</span><span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'NEXT ARTICLE →', 'panonian' ) . '</span><span class="nav-title">%title</span>',
                        )
                    );
                    ?>
                </div>

                <!-- COMMENTS SECTION -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    ?>
                    <div class="post-comments-container">
                        <?php comments_template(); ?>
                    </div>
                    <?php
                endif;
                ?>

            </article>

        <?php endwhile; ?>

    </main><!-- #main -->

<?php
get_footer();