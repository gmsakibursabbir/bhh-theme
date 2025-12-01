<?php
/**
 * Template Name: Privacy Policy
 * 
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="bg-white">

    <?php while (have_posts()):
        the_post(); ?>

        <!-- Hero Section -->
        <section class="ty-gradient h-[260px] lg:h-[400px] -mt-[60px] lg:-mt-[80px] z-10">
            <div class="max-w-[1444px] mx-auto px-[25px] lg:px-0 w-full h-full flex flex-col items-center justify-center">
                <div class="text-center">
                    <h1
                        class="text-3xl lg:text-5xl xl:text-6xl font-extrabold text-white mx-auto leading-tight pt-[40px] lg:pt-[56px]">
                        <?php the_title(); ?>
                    </h1>
                    <div
                        class="flex items-center justify-center gap-4 text-sm lg:text-base font-bold text-white uppercase tracking-wider mt-4">
                        <span>Last Updated: <?php echo get_the_modified_date(); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="max-w-[900px] mx-auto px-[25px] py-12 lg:py-20">

            <!-- Table of Contents -->
            <div
                class="mb-12 p-6 lg:p-8 rounded-2xl bg-gradient-to-br from-green/5 to-secondary/10 border-2 border-green/20">
                <h2 class="text-2xl font-extrabold text-dark mb-4">Table of Contents</h2>
                <nav class="space-y-2">
                    <a href="#information-collection"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">1.
                        Information We Collect</a>
                    <a href="#how-we-use"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">2. How We
                        Use Your Information</a>
                    <a href="#information-sharing"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">3.
                        Information Sharing</a>
                    <a href="#data-security"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">4. Data
                        Security</a>
                    <a href="#your-rights"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">5. Your
                        Rights</a>
                    <a href="#cookies"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">6. Cookies
                        & Tracking</a>
                    <a href="#contact"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">7. Contact
                        Us</a>
                </nav>
            </div>

            <!-- Main Content -->
            <article
                class="prose prose-lg prose-headings:font-extrabold prose-headings:text-secondary prose-p:text-dark prose-a:text-accent prose-a:no-underline hover:prose-a:underline max-w-none">

                <?php the_content(); ?>

                <!-- Default Content if none exists -->
                <?php if (!get_the_content()): ?>

                    <section id="information-collection" class="mb-12">
                        <h2>1. Information We Collect</h2>
                        <p>We collect information that you provide directly to us, including:</p>
                        <ul>
                            <li><strong>Personal Information:</strong> Name, email address, phone number, and other contact
                                details</li>
                            <li><strong>Business Information:</strong> Company name, industry, and business requirements</li>
                            <li><strong>Usage Data:</strong> Information about how you interact with our website</li>
                            <li><strong>Technical Data:</strong> IP address, browser type, device information, and cookies</li>
                        </ul>
                    </section>

                    <section id="how-we-use" class="mb-12">
                        <h2>2. How We Use Your Information</h2>
                        <p>We use the information we collect to:</p>
                        <ul>
                            <li>Provide, maintain, and improve our services</li>
                            <li>Process your requests and respond to inquiries</li>
                            <li>Send you updates, newsletters, and marketing communications (with your consent)</li>
                            <li>Analyze usage patterns and optimize user experience</li>
                            <li>Protect against fraud and unauthorized activity</li>
                            <li>Comply with legal obligations</li>
                        </ul>
                    </section>

                    <section id="information-sharing" class="mb-12">
                        <h2>3. Information Sharing</h2>
                        <p>We do not sell your personal information. We may share your information with:</p>
                        <ul>
                            <li><strong>Service Providers:</strong> Third-party vendors who help us operate our business</li>
                            <li><strong>Business Partners:</strong> When you authorize us to share information</li>
                            <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
                            <li><strong>Business Transfers:</strong> In connection with mergers or acquisitions</li>
                        </ul>
                    </section>

                    <section id="data-security" class="mb-12">
                        <h2>4. Data Security</h2>
                        <p>We implement appropriate technical and organizational measures to protect your personal information
                            against unauthorized access, alteration, disclosure, or destruction. However, no method of
                            transmission over the internet is 100% secure.</p>
                    </section>

                    <section id="your-rights" class="mb-12">
                        <h2>5. Your Rights</h2>
                        <p>You have the right to:</p>
                        <ul>
                            <li><strong>Access:</strong> Request a copy of your personal information</li>
                            <li><strong>Correction:</strong> Request corrections to inaccurate information</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                            <li><strong>Objection:</strong> Object to processing of your information</li>
                            <li><strong>Portability:</strong> Request transfer of your data</li>
                            <li><strong>Withdraw Consent:</strong> Withdraw consent for marketing communications</li>
                        </ul>
                    </section>

                    <section id="cookies" class="mb-12">
                        <h2>6. Cookies & Tracking Technologies</h2>
                        <p>We use cookies and similar tracking technologies to:</p>
                        <ul>
                            <li>Remember your preferences and settings</li>
                            <li>Understand how you use our website</li>
                            <li>Improve website performance and user experience</li>
                            <li>Provide personalized content and advertisements</li>
                        </ul>
                        <p>You can control cookies through your browser settings.</p>
                    </section>

                    <section id="contact" class="mb-12">
                        <h2>7. Contact Us</h2>
                        <p>If you have questions about this Privacy Policy or our data practices, please contact us:</p>
                        <div class="p-6 bg-light-gray rounded-xl mt-4">
                            <p class="mb-2"><strong>Email:</strong>
                                <?php
                                // Get settings
                                $settings = get_option('bh_theme_settings');
                                $fields = isset($settings['28']) ? $settings['28'] : [];

                                // --- Field: Email (email) ---
                                $val = '';
                                foreach ($fields as $f) {
                                    if ($f['name'] === 'email') {
                                        $val = $f['value'];
                                        break;
                                    }
                                }
                                if ($val) {
                                    echo wp_kses_post($val);
                                }
                                ?>
                            </p>
                            <p class="mb-2"><strong>Phone:</strong>
                                <?php
                                // Get settings
                                $settings = get_option('bh_theme_settings');
                                $fields = isset($settings['28']) ? $settings['28'] : [];

                                // --- Field: Phone (phone) ---
                                $val = '';
                                foreach ($fields as $f) {
                                    if ($f['name'] === 'phone') {
                                        $val = $f['value'];
                                        break;
                                    }
                                }
                                if ($val) {
                                    echo wp_kses_post($val);
                                }
                                ?>
                            </p>
                            <p><strong>Address:</strong>
                                <?php
                                // Get settings
                                $settings = get_option('bh_theme_settings');
                                $fields = isset($settings['28']) ? $settings['28'] : [];

                                // --- Field: Address (address) ---
                                $val = '';
                                foreach ($fields as $f) {
                                    if ($f['name'] === 'address') {
                                        $val = $f['value'];
                                        break;
                                    }
                                }
                                if ($val) {
                                    echo wp_kses_post($val);
                                }
                                ?>
                            </p>
                        </div>
                    </section>

                <?php endif; ?>

            </article>

            <!-- Last Updated Notice -->
            <div class="mt-12 p-6 bg-accent/10 border-l-4 border-accent rounded-r-xl">
                <p class="text-sm text-dark">
                    <strong>Note:</strong> This Privacy Policy was last updated on
                    <strong><?php echo get_the_modified_date('F j, Y'); ?></strong>.
                    We may update this policy from time to time. Please review it periodically.
                </p>
            </div>

        </div>

    <?php endwhile; ?>

</main>

<?php get_footer();
