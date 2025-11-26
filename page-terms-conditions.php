<?php
/**
 * Template Name: Terms & Conditions
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
                        <span>Effective Date: <?php echo get_the_modified_date(); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <div class="max-w-[900px] mx-auto px-[25px] py-12 lg:py-20">

            <!-- Table of Contents -->
            <div
                class="mb-12 p-6 lg:p-8 rounded-2xl bg-gradient-to-br from-secondary/10 to-accent/10 border-2 border-secondary/20">
                <h2 class="text-2xl font-extrabold text-dark mb-4">Table of Contents</h2>
                <nav class="space-y-2">
                    <a href="#acceptance"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">1.
                        Acceptance of Terms</a>
                    <a href="#services"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">2. Services
                        & Use</a>
                    <a href="#user-responsibilities"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">3. User
                        Responsibilities</a>
                    <a href="#intellectual-property"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">4.
                        Intellectual Property</a>
                    <a href="#limitation-liability"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">5.
                        Limitation of Liability</a>
                    <a href="#termination"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">6.
                        Termination</a>
                    <a href="#governing-law"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">7.
                        Governing Law</a>
                    <a href="#contact"
                        class="block text-primary hover:text-secondary font-bold transition-colors duration-300">8. Contact
                        Information</a>
                </nav>
            </div>

            <!-- Main Content -->
            <article
                class="prose prose-lg prose-headings:font-extrabold prose-headings:text-secondary prose-p:text-dark prose-a:text-accent prose-a:no-underline hover:prose-a:underline max-w-none">

                <?php the_content(); ?>

                <!-- Default Content if none exists -->
                <?php if (!get_the_content()): ?>

                    <section id="acceptance" class="mb-12">
                        <h2>1. Acceptance of Terms</h2>
                        <p>By accessing and using this website and our services, you accept and agree to be bound by the terms
                            and conditions of this agreement. If you do not agree to these Terms & Conditions, please do not use
                            our services.</p>
                        <p>We reserve the right to modify these terms at any time. Your continued use of our services following
                            any changes indicates your acceptance of the new terms.</p>
                    </section>

                    <section id="services" class="mb-12">
                        <h2>2. Services & Use</h2>
                        <p>Our services are provided "as is" and "as available." We reserve the right to:</p>
                        <ul>
                            <li>Modify, suspend, or discontinue any aspect of our services at any time</li>
                            <li>Impose limits on certain features or restrict access to parts of our services</li>
                            <li>Update our services without prior notice</li>
                            <li>Refuse service to anyone at our sole discretion</li>
                        </ul>
                    </section>

                    <section id="user-responsibilities" class="mb-12">
                        <h2>3. User Responsibilities</h2>
                        <p>You agree to:</p>
                        <ul>
                            <li>Provide accurate, current, and complete information when using our services</li>
                            <li>Maintain the security of your account credentials</li>
                            <li>Not use our services for any illegal or unauthorized purpose</li>
                            <li>Not interfere with or disrupt the operation of our services</li>
                            <li>Not attempt to gain unauthorized access to any portion of our services</li>
                            <li>Not transmit any viruses, malware, or harmful code</li>
                            <li>Respect the intellectual property rights of others</li>
                        </ul>
                    </section>

                    <section id="intellectual-property" class="mb-12">
                        <h2>4. Intellectual Property</h2>
                        <p>All content on this website, including but not limited to text, graphics, logos, images, software,
                            and design, is the property of our company or our content suppliers and is protected by copyright,
                            trademark, and other intellectual property laws.</p>
                        <p>You may not:</p>
                        <ul>
                            <li>Reproduce, distribute, or create derivative works from our content without permission</li>
                            <li>Use our trademarks, logos, or branding without written authorization</li>
                            <li>Remove or modify any copyright or proprietary notices</li>
                            <li>Use automated systems to access or scrape our content</li>
                        </ul>
                    </section>

                    <section id="limitation-liability" class="mb-12">
                        <h2>5. Limitation of Liability</h2>
                        <p>To the maximum extent permitted by law, we shall not be liable for:</p>
                        <ul>
                            <li>Any indirect, incidental, special, consequential, or punitive damages</li>
                            <li>Loss of profits, revenue, data, or business opportunities</li>
                            <li>Service interruptions or delays</li>
                            <li>Errors or inaccuracies in content</li>
                            <li>Third-party conduct or content</li>
                        </ul>
                        <p>Our total liability shall not exceed the amount you paid us in the past 12 months, or $100, whichever
                            is greater.</p>
                    </section>

                    <section id="termination" class="mb-12">
                        <h2>6. Termination</h2>
                        <p>We reserve the right to terminate or suspend your access to our services immediately, without prior
                            notice or liability, for any reason, including:</p>
                        <ul>
                            <li>Violation of these Terms & Conditions</li>
                            <li>Fraudulent or illegal activity</li>
                            <li>Request by law enforcement or government agencies</li>
                            <li>Extended periods of inactivity</li>
                        </ul>
                        <p>Upon termination, your right to use our services will immediately cease.</p>
                    </section>

                    <section id="governing-law" class="mb-12">
                        <h2>7. Governing Law</h2>
                        <p>These Terms & Conditions shall be governed by and construed in accordance with the laws of [Your
                            State/Country], without regard to its conflict of law provisions.</p>
                        <p>Any disputes arising from these terms shall be resolved through:</p>
                        <ul>
                            <li>Good faith negotiation between the parties</li>
                            <li>Mediation, if negotiation fails</li>
                            <li>Binding arbitration in [Your Location]</li>
                            <li>Courts of [Your Jurisdiction] as a last resort</li>
                        </ul>
                    </section>

                    <section id="contact" class="mb-12">
                        <h2>8. Contact Information</h2>
                        <p>If you have any questions about these Terms & Conditions, please contact us:</p>
                        <div class="p-6 bg-light-gray rounded-xl mt-4">
                            <p class="mb-2"><strong>Email:</strong> info@thebusinesshub.co.uk</p>
                            <p class="mb-2"><strong>Phone:</strong> (123) 456-7890</p>
                            <p><strong>Address:</strong> Your Business Address, City, State, ZIP</p>
                        </div>
                    </section>

                <?php endif; ?>

            </article>

            <!-- Acceptance Notice -->
            <div class="mt-12 p-6 bg-primary/10 border-l-4 border-primary rounded-r-xl">
                <p class="text-sm text-dark">
                    <strong>Important:</strong> By using our services, you acknowledge that you have read, understood, and
                    agree to be bound by these Terms & Conditions.
                    These terms are effective as of <strong><?php echo get_the_modified_date('F j, Y'); ?></strong>.
                </p>
            </div>

        </div>

    <?php endwhile; ?>

</main>

<?php get_footer();
