<?php
/**
 * Template Name: Cookie Policy
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
                class="mb-12 p-6 lg:p-8 rounded-2xl bg-gradient-to-br from-accent/10 to-yellow/10 border-2 border-accent/20">
                <h2 class="text-2xl font-extrabold text-dark mb-4">Table of Contents</h2>
                <nav class="space-y-2">
                    <a href="#what-are-cookies"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">1. What Are
                        Cookies?</a>
                    <a href="#how-we-use"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">2. How We
                        Use Cookies</a>
                    <a href="#types-of-cookies"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">3. Types of
                        Cookies We Use</a>
                    <a href="#third-party-cookies"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">4.
                        Third-Party Cookies</a>
                    <a href="#managing-cookies"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">5. Managing
                        Cookies</a>
                    <a href="#contact"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">6. Contact
                        Us</a>
                </nav>
            </div>

            <!-- Main Content -->
            <article
                class="prose prose-lg prose-headings:font-extrabold prose-headings:text-secondary prose-p:text-dark prose-a:text-accent prose-a:no-underline hover:prose-a:underline max-w-none">

                <?php the_content(); ?>

                <!-- Default Content if none exists -->
                <?php if (!get_the_content()): ?>

                    <section id="what-are-cookies" class="mb-12">
                        <h2>1. What Are Cookies?</h2>
                        <p>Cookies are small text files that are placed on your computer or mobile device when you visit a
                            website. They are widely used to make websites work more efficiently and provide information to
                            website owners.</p>
                        <p>Cookies help us:</p>
                        <ul>
                            <li>Remember your preferences and settings</li>
                            <li>Understand how you use our website</li>
                            <li>Improve your browsing experience</li>
                            <li>Provide personalized content and features</li>
                        </ul>
                    </section>

                    <section id="how-we-use" class="mb-12">
                        <h2>2. How We Use Cookies</h2>
                        <p>We use cookies for various purposes, including:</p>
                        <ul>
                            <li><strong>Essential Operations:</strong> To enable core website functionality</li>
                            <li><strong>Performance & Analytics:</strong> To understand how visitors interact with our website
                            </li>
                            <li><strong>Functionality:</strong> To remember your preferences and provide enhanced features</li>
                            <li><strong>Marketing:</strong> To deliver relevant advertisements and track campaign effectiveness
                            </li>
                            <li><strong>Security:</strong> To protect against fraudulent activity and ensure secure access</li>
                        </ul>
                    </section>

                    <section id="types-of-cookies" class="mb-12">
                        <h2>3. Types of Cookies We Use</h2>

                        <h3 class="text-xl font-extrabold text-dark mt-8 mb-4">Strictly Necessary Cookies</h3>
                        <p>These cookies are essential for the website to function properly. They enable basic functions like
                            page navigation and access to secure areas. The website cannot function properly without these
                            cookies.</p>
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full border-2 border-gray-200 rounded-xl overflow-hidden">
                                <thead class="bg-primary/10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Cookie Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Purpose</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">session_id</td>
                                        <td class="px-6 py-4 text-sm text-dark">Maintains your session</td>
                                        <td class="px-6 py-4 text-sm text-dark">Session</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">csrf_token</td>
                                        <td class="px-6 py-4 text-sm text-dark">Security protection</td>
                                        <td class="px-6 py-4 text-sm text-dark">Session</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="text-xl font-extrabold text-dark mt-8 mb-4">Performance & Analytics Cookies</h3>
                        <p>These cookies help us understand how visitors interact with our website by collecting and reporting
                            information anonymously.</p>
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full border-2 border-gray-200 rounded-xl overflow-hidden">
                                <thead class="bg-secondary/10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Cookie Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Purpose</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">_ga</td>
                                        <td class="px-6 py-4 text-sm text-dark">Google Analytics - distinguishes users</td>
                                        <td class="px-6 py-4 text-sm text-dark">2 years</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">_gid</td>
                                        <td class="px-6 py-4 text-sm text-dark">Google Analytics - distinguishes users</td>
                                        <td class="px-6 py-4 text-sm text-dark">24 hours</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="text-xl font-extrabold text-dark mt-8 mb-4">Functionality Cookies</h3>
                        <p>These cookies enable enhanced functionality and personalization, such as remembering your
                            preferences.</p>
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full border-2 border-gray-200 rounded-xl overflow-hidden">
                                <thead class="bg-accent/10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Cookie Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Purpose</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">user_preferences</td>
                                        <td class="px-6 py-4 text-sm text-dark">Stores your preferences</td>
                                        <td class="px-6 py-4 text-sm text-dark">1 year</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">language</td>
                                        <td class="px-6 py-4 text-sm text-dark">Remembers language choice</td>
                                        <td class="px-6 py-4 text-sm text-dark">1 year</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="text-xl font-extrabold text-dark mt-8 mb-4">Marketing Cookies</h3>
                        <p>These cookies track your browsing habits to deliver advertisements that are relevant to you and your
                            interests.</p>
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full border-2 border-gray-200 rounded-xl overflow-hidden">
                                <thead class="bg-green/10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Cookie Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Purpose</th>
                                        <th class="px-6 py-3 text-left text-sm font-extrabold text-dark">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">_fbp</td>
                                        <td class="px-6 py-4 text-sm text-dark">Facebook tracking pixel</td>
                                        <td class="px-6 py-4 text-sm text-dark">3 months</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-dark">ads_preferences</td>
                                        <td class="px-6 py-4 text-sm text-dark">Ad personalization</td>
                                        <td class="px-6 py-4 text-sm text-dark">1 year</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section id="third-party-cookies" class="mb-12">
                        <h2>4. Third-Party Cookies</h2>
                        <p>In addition to our own cookies, we use various third-party cookies to report usage statistics and
                            deliver advertisements. These include:</p>
                        <ul>
                            <li><strong>Google Analytics:</strong> For website analytics and performance tracking</li>
                            <li><strong>Facebook Pixel:</strong> For social media integration and advertising</li>
                            <li><strong>LinkedIn Insights:</strong> For B2B marketing and analytics</li>
                            <li><strong>Hotjar:</strong> For user behavior analysis and heatmaps</li>
                        </ul>
                        <p>These third-party services have their own privacy policies and cookie policies. We recommend
                            reviewing their policies for more information.</p>
                    </section>

                    <section id="managing-cookies" class="mb-12">
                        <h2>5. Managing Cookies</h2>
                        <p>You have the right to decide whether to accept or reject cookies. You can exercise your cookie
                            preferences through:</p>

                        <h3 class="text-xl font-extrabold text-dark mt-6 mb-4">Browser Settings</h3>
                        <p>Most web browsers automatically accept cookies, but you can modify your browser settings to decline
                            cookies if you prefer:</p>
                        <ul>
                            <li><strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data</li>
                            <li><strong>Firefox:</strong> Options → Privacy & Security → Cookies and Site Data</li>
                            <li><strong>Safari:</strong> Preferences → Privacy → Cookies and website data</li>
                            <li><strong>Edge:</strong> Settings → Cookies and site permissions</li>
                        </ul>

                        <h3 class="text-xl font-extrabold text-dark mt-6 mb-4">Opt-Out Tools</h3>
                        <p>You can opt out of specific tracking services:</p>
                        <ul>
                            <li><strong>Google Analytics:</strong> <a href="https://tools.google.com/dlpage/gaoptout"
                                    target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a></li>
                            <li><strong>Facebook:</strong> <a href="https://www.facebook.com/help/568137493302217"
                                    target="_blank" rel="noopener">Facebook Ad Preferences</a></li>
                            <li><strong>Network Advertising:</strong> <a href="http://optout.networkadvertising.org/"
                                    target="_blank" rel="noopener">NAI Opt-Out Tool</a></li>
                        </ul>

                        <div class="p-6 bg-yellow/10 border-l-4 border-yellow rounded-r-xl mt-6">
                            <p class="text-sm text-dark">
                                <strong>Note:</strong> If you choose to disable cookies, some features of our website may not
                                function properly.
                                Strictly necessary cookies cannot be disabled as they are essential for the website to work.
                            </p>
                        </div>
                    </section>

                    <section id="contact" class="mb-12">
                        <h2>6. Contact Us</h2>
                        <p>If you have questions about our use of cookies or this Cookie Policy, please contact us:</p>
                        <div class="p-6 bg-light-gray rounded-xl mt-4">
                            <p class="mb-2"><strong>Email:</strong>
                                <?php
                                // Get settings
                                $settings = get_option('bh_theme_settings');
                                $fields = isset($settings['34']) ? $settings['34'] : [];

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
                                $fields = isset($settings['34']) ? $settings['34'] : [];

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
                                $fields = isset($settings['34']) ? $settings['34'] : [];

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
            <div class="mt-12 p-6 bg-primary/10 border-l-4 border-primary rounded-r-xl">
                <p class="text-sm text-dark">
                    <strong>Policy Updates:</strong> This Cookie Policy was last updated on
                    <strong><?php echo get_the_modified_date('F j, Y'); ?></strong>.
                    We may update this policy to reflect changes in our cookie practices. Please check back periodically for
                    updates.
                </p>
            </div>

        </div>

    <?php endwhile; ?>

</main>

<?php get_footer();
