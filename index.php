<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white pt-[60px] lg:pt-[80px]">
    <div class="container mx-auto px-[25px] py-12 lg:py-20">

        <?php if (have_posts()): ?>

            <header class="mb-12 text-center">
                <h1 class="text-3xl lg:text-5xl font-extrabold text-secondary mb-4">
                    <?php single_post_title(); ?>
                </h1>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                /* Start the Loop */
                while (have_posts()):
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300'); ?>>

                        <?php if (has_post_thumbnail()): ?>
                            <div class="h-48 overflow-hidden">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-110')); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <header class="mb-4">
                                <div class="text-sm text-accent font-bold mb-2 uppercase tracking-wider">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <h2 class="text-xl font-bold text-secondary leading-tight mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-accent transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            </header>

                            <div class="text-dark mb-4 line-clamp-3">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>"
                                class="inline-flex items-center text-secondary font-bold hover:text-accent transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <div class="mt-12 flex justify-center">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('Previous', 'business-hubs-theme'),
                    'next_text' => __('Next', 'business-hubs-theme'),
                    'class' => 'flex gap-2',
                ));
                ?>
            </div>

        <?php else: ?>

            <section class="no-results not-found text-center">
                <h2 class="text-2xl font-bold text-secondary mb-4">
                    <?php esc_html_e('Nothing Found', 'business-hubs-theme'); ?></h2>
                <p class="text-dark">
                    <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'business-hubs-theme'); ?>
                </p>
            </section>

        <?php endif; ?>

    </div>
</main>

<?php
get_footer();
