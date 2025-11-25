<?php
/**
 * Template Name: Contact Page
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white pt-[60px] lg:pt-[80px]">

    <!-- Header Section -->
    <section class="bg-secondary/10 py-12 lg:py-20">
        <div class="container mx-auto px-[25px] text-center">
            <h1 class="text-4xl lg:text-6xl font-extrabold text-secondary mb-6"><?php the_title(); ?></h1>
            <p class="text-lg lg:text-xl text-dark font-semibold max-w-2xl mx-auto">
                We'd love to hear from you. Get in touch with us for any queries.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-12 lg:py-20">
        <div class="container mx-auto px-[25px]">
            <div class="flex flex-col lg:flex-row gap-12">

                <!-- Contact Info -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-light-gray p-8 rounded-2xl">
                        <h3 class="text-2xl font-bold text-secondary mb-6">Contact Information</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-4">
                                <span class="font-bold text-dark">Email:</span>
                                <a href="mailto:info@businesshub.com"
                                    class="text-accent hover:text-dark transition-colors">info@businesshub.com</a>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="font-bold text-dark">Phone:</span>
                                <a href="tel:+441234567890" class="text-accent hover:text-dark transition-colors">+44
                                    123 456 7890</a>
                            </li>
                            <li class="flex items-start gap-4">
                                <span class="font-bold text-dark">Address:</span>
                                <span class="text-dark">123 Business Street, London, UK</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Form / Content -->
                <div class="w-full lg:w-2/3">
                    <div class="prose max-w-none">
                        <?php
                        while (have_posts()):
                            the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>