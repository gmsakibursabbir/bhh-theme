<?php
/**
 * The template for displaying search results
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white">

    <!-- Hero Section -->
    <section class="ty-gradient h-[300px] lg:h-[400px] -mt-[60px] lg:-mt-[80px] z-10">
        <div class="max-w-[1444px] mx-auto px-[25px] lg:px-0 w-full h-full flex flex-col items-center justify-center">
            <div class="text-center">
                <h1
                    class="text-3xl lg:text-5xl xl:text-6xl font-extrabold text-white mx-auto leading-tight pt-[40px] lg:pt-[56px]">
                    Search Results
                </h1>

                <!-- Search Query -->
                <p class="text-white/90 text-base lg:text-xl mt-4 max-w-3xl mx-auto">
                    Showing results for: <span class="font-extrabold">"<?php echo get_search_query(); ?>"</span>
                </p>

                <!-- Result Count -->
                <div
                    class="flex items-center justify-center gap-4 text-sm lg:text-base font-bold text-white uppercase tracking-wider mt-4">
                    <span><?php echo $wp_query->found_posts; ?>
                        <?php echo $wp_query->found_posts === 1 ? 'Result' : 'Results'; ?> Found</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Content -->
    <div class="max-w-[1200px] mx-auto px-[25px] py-12 lg:py-20">

        <?php if (have_posts()): ?>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php while (have_posts()):
                    the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
                        <a href="<?php the_permalink(); ?>" class="block">

                            <!-- Featured Image -->
                            <?php if (has_post_thumbnail()): ?>
                                <div class="relative w-full h-[250px] rounded-2xl overflow-hidden mb-5 shadow-md">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>

                                    <!-- Overlay on Hover -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-dark/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div
                                    class="relative w-full h-[250px] rounded-2xl overflow-hidden mb-5 bg-gradient-to-br from-green/10 to-secondary/20 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-green/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <!-- Post Meta -->
                            <div class="flex items-center gap-3 text-xs font-bold text-primary uppercase tracking-wider mb-3">
                                <span><?php echo get_the_date(); ?></span>
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)):
                                    ?>
                                    <span class="w-1 h-1 bg-primary rounded-full"></span>
                                    <span><?php echo esc_html($categories[0]->name); ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Post Title -->
                            <h2
                                class="text-xl lg:text-2xl font-extrabold text-dark leading-tight mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                <?php the_title(); ?>
                            </h2>

                            <!-- Excerpt -->
                            <p class="text-dark/70 leading-relaxed line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>

                            <!-- Read More -->
                            <div
                                class="mt-4 flex items-center gap-2 text-primary font-bold text-sm group-hover:gap-3 transition-all duration-300">
                                <span>Read More</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>

                        </a>
                    </article>

                <?php endwhile; ?>

            </div>

            <!-- Pagination -->
            <?php
            $pagination = paginate_links(array(
                'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg><span>Previous</span>',
                'next_text' => '<span>Next</span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>',
                'type' => 'array',
                'before_page_number' => '<span class="sr-only">Page </span>'
            ));

            if ($pagination):
                ?>
                <nav class="mt-16 pt-8 border-t border-gray-200" role="navigation" aria-label="Pagination">
                    <ul class="flex flex-wrap items-center justify-center gap-2">
                        <?php foreach ($pagination as $page): ?>
                            <li>
                                <?php
                                // Check if it's the current page
                                if (strpos($page, 'current') !== false):
                                    echo str_replace(
                                        '<span',
                                        '<span class="flex items-center justify-center min-w-[44px] h-11 px-4 rounded-xl bg-primary text-white font-bold"',
                                        $page
                                    );
                                else:
                                    echo str_replace(
                                        '<a',
                                        '<a class="flex items-center justify-center gap-2 min-w-[44px] h-11 px-4 rounded-xl border-2 border-gray-200 hover:border-primary text-dark hover:text-primary font-bold transition-all duration-300"',
                                        $page
                                    );
                                endif;
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        <?php else: ?>

            <!-- No Results Found -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-dark mb-4">No Results Found</h2>
                <p class="text-dark/70 mb-8 max-w-md mx-auto">
                    We couldn't find any results for "<span class="font-bold"><?php echo get_search_query(); ?></span>". Try
                    searching with different keywords.
                </p>

                <!-- Search Form -->
                <form role="search" method="get" class="max-w-2xl mx-auto mb-8" action="<?php echo home_url('/'); ?>">
                    <div class="relative">
                        <input type="search" name="s" value="<?php echo get_search_query(); ?>"
                            placeholder="Try another search..."
                            class="w-full px-6 py-4 pr-14 border-2 border-gray-200 rounded-xl focus:border-primary focus:outline-none text-dark font-medium"
                            required />
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary hover:bg-secondary text-white rounded-lg transition-colors duration-300 flex items-center justify-center"
                            aria-label="Search">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <a href="<?php echo home_url('/'); ?>"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-secondary text-white font-bold rounded-xl transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Back to Home
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php get_footer();
