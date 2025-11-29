<?php
/**
 * Template Name: Thank You Page
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main class="">
    <!-- Thank You hero -->
    <section class="ty-gradient h-[620px] lg:h-[872px]  -mt-[60px] lg:-mt-[80px] z-10">
        <div class="max-w-[1444px] mx-auto px-[25px] lg:px-0 w-full h-full flex flex-col items-center justify-center">
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/thanks-check.svg" alt="Thank You"
                    class="w-[80px] h-[80px] lg:w-[122px] lg:h-[122px]">
                <h3 class="text-base lg:text-xl text-white font-extrabold text-center mt-[20px]">Thank you</h2>
            </div>
            <div class="">
                <h1
                    class="text-[28px] lg:text-[34px] xl:text-[40px] font-extrabold text-white mx-auto text-center leading-tight pt-[20px] pb-[28px] lg:pt-[36px] lg:pb-[50px]">
                    We are working on finding the best deals for you.
                </h1>
                <div class="max-w-[910px] mx-auto space-y-[16px] lg:space-y-[48px] text-center">
                    <p class="text-base text-white mx-auto text-center font-semibold ">
                        Based on the information that you have provided, we are matching your business with the perfect
                        solution from our UK-based award-winning suppliers.
                    </p>
                    <p class="text-base text-white mx-auto text-center font-semibold ">
                        One of our network of suppliers will be in touch soon.
                    </p>
                </div>

            </div>
        </div>
    </section>
    <!-- newsletter -->
    <section class="pt-[64px] pb-[32px] lg:pt-[67px] lg:pb-[85px]" id="newsletter">
        <div class="w-full lg:max-w-[1378px] lg:px-0 px-[25px] mx-auto">
            <div class="mb-[24px] lg:mb-[40px]">
                <h4 class="text-sm lg:text-lg xl:text-xl text-yellow font-extrabold text-center">
                    NEWSLETTER
                </h4>
                <h3
                    class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-none pt-[10px] pb-[20px]">
                    Sign up to our newsletter
                </h3>
                <p class="text-base text-dark mx-auto text-center font-semibold max-w-[263px] lg:max-w-[777px]">
                    Stay updated with the latest news, insights and offers from The Business Hub.
                </p>
            </div>
            <!-- Form Container -->
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST"
                class="flex flex-col lg:flex-row gap-4 lg:gap-5 items-center justify-center w-full">

                <!-- Hidden Fields for WordPress Handler -->
                <input type="hidden" name="action" value="bh_newsletter_signup">
                <?php wp_nonce_field('bh_newsletter_signup', 'newsletter_nonce'); ?>

                <!-- First Name Input -->
                <div class="w-full lg:w-1/4 ">
                    <input type="text" name="name" placeholder="First Name" required
                        class="w-full px-6 py-[14px] rounded-[15px] border-[2px] bg-[#FCFCFC] border-[#D9D9D9] text-dark focus:outline-none focus:border-[#359327] focus:ring-2 focus:ring-[#359327] transition-all placeholder-[#14505E] text-base font-semibold">
                </div>

                <!-- Last Name Input (Optional - stored in Note or combined name if handler doesn't support separate last name) -->
                <!-- Note: Your current handler only checks $_POST['name']. You might want to combine JS or update handler. 
           For now, I'll name it 'lastname' and we can update the handler or let it be handled separately. -->
                <div class="w-full lg:w-1/4 ">
                    <input type="text" name="lastname" placeholder="Last Name"
                        class="w-full px-6 py-[14px] rounded-[15px] border-[2px] bg-[#FCFCFC] border-[#D9D9D9] text-dark focus:outline-none focus:border-[#359327] focus:ring-2 focus:ring-[#359327] transition-all placeholder-[#14505E] text-base font-semibold">

                </div>

                <!-- Email Input -->
                <div class="w-full lg:w-1/4 ">
                    <input type="email" name="email" placeholder="youremail@email.com" required
                        class="w-full px-6 py-[14px] rounded-[15px] border-[2px] bg-[#FCFCFC] border-[#D9D9D9] text-dark focus:outline-none focus:border-[#359327] focus:ring-2 focus:ring-[#359327] transition-all placeholder-[#14505E] text-base font-semibold">
                </div>

                <!-- Submit Button -->
                <div class="w-full lg:w-1/4 ">
                    <button type="submit"
                        class="w-full  bg-[#FFDC46] hover:bg-yellow-400 text-black font-extrabold text-base py-[14px] px-12 rounded-full transition-colors duration-300 shadow-md whitespace-nowrap cursor-pointer">
                        Sign Up
                    </button>
                </div>

            </form>
            <p class="text-sm lg:text-base text-dark font-semibold mt-[18px] max-w-[350px] lg:max-w-full">By signing up
                you are agreeing to receive emails
                from The
                Business Hub, you can unsubscribe at any time.</p>

            <!-- Success/Error Message Handling -->
            <?php if (isset($_GET['newsletter'])): ?>
                <div class="mt-6 text-center">
                    <?php if ($_GET['newsletter'] === 'success'): ?>
                        <p class="text-green-600 font-bold">Thank you for signing up!</p>
                    <?php elseif ($_GET['newsletter'] === 'invalid_email'): ?>
                        <p class="text-red-600 font-bold">Please provide a valid email address.</p>
                    <?php else: ?>
                        <p class="text-red-600 font-bold">Something went wrong. Please try again.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
