<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white">

    <!-- Hero Section -->
    <section class="ty-gradient h-[400px] lg:h-[500px] -mt-[60px] lg:-mt-[80px] z-10">
        <div class="max-w-[1444px] mx-auto px-[25px] lg:px-0 w-full h-full flex flex-col items-center justify-center">
            <div class="text-center">
                <!-- 404 Number -->
                <div class="text-[120px] lg:text-[200px] font-extrabold text-white/20 leading-none mb-4">
                    404
                </div>

                <!-- Title -->
                <h1
                    class="text-3xl lg:text-5xl xl:text-6xl font-extrabold text-white mx-auto leading-tight -mt-16 lg:-mt-24">
                    Oops! Page Not Found
                </h1>

                <!-- Description -->
                <p class="text-white/90 text-base lg:text-xl mt-4 max-w-2xl mx-auto">
                    The page you're looking for seems to have wandered off. Let's help you find your way back!
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <div class="max-w-[1000px] mx-auto px-[25px] py-12 lg:py-20">

        <!-- Search Section -->
        <div class="text-center mb-16">
            <h2 class="text-2xl lg:text-3xl font-extrabold text-dark mb-4">Try Searching</h2>
            <p class="text-dark/70 mb-8">Maybe we can help you find what you're looking for</p>

            <!-- Search Form -->
            <form role="search" method="get" class="max-w-2xl mx-auto" action="<?php echo home_url('/'); ?>">
                <div class="relative">
                    <input type="search" name="s" placeholder="Search our website..."
                        class="w-full px-6 py-5 pr-16 border-2 border-gray-200 rounded-2xl focus:border-primary focus:outline-none text-dark font-medium text-lg shadow-sm"
                        required />
                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-primary to-secondary hover:from-secondary hover:to-primary text-white rounded-xl transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg hover:scale-105"
                        aria-label="Search">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Quick Links -->
        <div class="border-t border-gray-200 pt-12">
            <h3 class="text-xl lg:text-2xl font-extrabold text-dark text-center mb-8">Popular Pages</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Home Link -->
                <a href="<?php echo home_url('/'); ?>"
                    class="group block p-6 rounded-2xl border-2 border-gray-200 hover:border-primary transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary/10 to-secondary/10 group-hover:from-primary/20 group-hover:to-secondary/20 flex items-center justify-center mb-4 transition-colors duration-300">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h4
                        class="text-lg font-extrabold text-dark group-hover:text-primary transition-colors duration-300 mb-2">
                        Home Page</h4>
                    <p class="text-dark/70 text-sm">Return to our homepage</p>
                </a>

                <!-- Blog Link -->
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"
                    class="group block p-6 rounded-2xl border-2 border-gray-200 hover:border-primary transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-secondary/10 to-accent/10 group-hover:from-secondary/20 group-hover:to-accent/20 flex items-center justify-center mb-4 transition-colors duration-300">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h4
                        class="text-lg font-extrabold text-dark group-hover:text-primary transition-colors duration-300 mb-2">
                        Blog</h4>
                    <p class="text-dark/70 text-sm">Read our latest articles</p>
                </a>

                <!-- Contact Link -->
                <?php
                $contact_page = get_page_by_path('contact');
                $contact_url = $contact_page ? get_permalink($contact_page->ID) : home_url('/contact');
                ?>
                <a href="<?php echo $contact_url; ?>"
                    class="group block p-6 rounded-2xl border-2 border-gray-200 hover:border-primary transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent/10 to-yellow/10 group-hover:from-accent/20 group-hover:to-yellow/20 flex items-center justify-center mb-4 transition-colors duration-300">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4
                        class="text-lg font-extrabold text-dark group-hover:text-primary transition-colors duration-300 mb-2">
                        Contact Us</h4>
                    <p class="text-dark/70 text-sm">Get in touch with our team</p>
                </a>

            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="inline-flex flex-col sm:flex-row items-center gap-4">
                <a href="<?php echo home_url('/'); ?>"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-br from-primary to-secondary hover:from-secondary hover:to-primary text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>

                <button onclick="window.history.back()"
                    class="inline-flex items-center gap-2 px-8 py-4 border-2 border-primary text-primary hover:bg-primary hover:text-white font-bold rounded-xl transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                    </svg>
                    Go Back
                </button>
            </div>
        </div>

    </div>

</main>

<?php get_footer();
