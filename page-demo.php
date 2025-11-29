<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white pt-[60px] lg:pt-[80px]">
    <div class="container mx-auto px-[25px] py-12 lg:py-20">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="mb-8 lg:mb-12">
                    <h1 class="text-3xl lg:text-5xl font-extrabold text-secondary mb-4"><?php the_title(); ?></h1>
                </header>

                <div class="prose prose-lg max-w-none text-dark">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'business-hubs-theme'),
                            'after' => '</div>',
                        )
                    );
                    ?>
                </div>
            </article>

            <?php
        endwhile; // End of the loop.
        ?>

    </div>
</main>

<?php
get_footer();
