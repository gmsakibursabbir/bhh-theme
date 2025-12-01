<?php
/**
 * Template Name: Business Mobile
 *
 * @package Business_Hubs_Theme
 */

get_header(); ?>

<main>
  <!-- hero -->
  <section class="w-full relative -mt-[60px] lg:-mt-[80px] z-10 ">

    <!-- Splide Container -->
    <div id="hero-main-slider" class="splide" aria-label="Hero Slider" data-config='<?php echo esc_attr(json_encode([
      "type" => "fade",      // Fade is often better for full-screen hero sliders
      "rewind" => true,
      "autoplay" => true,
      "interval" => 8000,
      "speed" => 1000,
      "arrows" => false,
      "pagination" => true,
      "pauseOnHover" => false,
    ])); ?>'>

      <div class="splide__track">
        <ul class="splide__list">

          <!-- SLIDE 1 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex flex-row items-center overflow-hidden herobg-one ">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 pt-[111px] md:pt-0">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 1 (hero_titles_1) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_titles_1') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>
                <ul class="flex flex-row items-center gap-[10px] lg:gap-5 py-[20px] lg:py-[28px]">
                  <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/Vodafone.svg')); ?>" alt="Vodafore"
                      class="w-[38px] h-[38px] lg:w-[80px] lg:h-[80px]"></li>
                  <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/o2.svg')); ?>" alt="o2"
                      class="w-[38px] h-[38px] lg:w-[80px] lg:h-[80px]"></li>
                  <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/three.svg')); ?>" alt="three"
                      class="w-[38px] h-[38px] lg:w-[80px] lg:h-[80px]"></li>
                  <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/ee.svg')); ?>" alt="ee"
                      class="w-[38px] h-[38px] lg:w-[80px] lg:h-[80px]"></li>
                </ul>
                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 1  (hero_peras_1) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_peras_1') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="<?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 1 (hero_link_1) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_1') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-1.png')); ?>" alt="hero image"
                  class="w-full h-full object-cover">
              </div>
            </div>

          </li>
          <!-- SLIDE 2 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex items-center overflow-hidden herobg-two">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 ">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 2 (hero_title_2) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_2') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>

                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px] mt-[20px] lg:mt-[28px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 2 (hero_pera_2) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_pera_2') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="<?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 2 (hero_link_2) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_2') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-2.png')); ?>" alt="hero image"
                  class="w-full h-full  object-cover">
              </div>
            </div>

          </li>
          <!-- SLIDE 3 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex items-center overflow-hidden herobg-three">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 pt-[111px] md:pt-0">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 3 (hero_title_3) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_3') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>

                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px] mt-[20px] lg:mt-[28px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 3 (hero_title_3_copy) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_3_copy') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="
                <?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 3 (hero_link_3) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_3') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-3.png')); ?>" alt="hero image"
                  class="w-full h-full  object-cover">
              </div>
            </div>
          </li>
          <!-- SLIDE 4 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex items-center overflow-hidden herobg-four">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 pt-[111px] md:pt-0">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 4 (hero_title_4) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_4') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>

                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px] mt-[20px] lg:mt-[28px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 4 (hero_pera_4) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_pera_4') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="<?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 4 (hero_link_4) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_4') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-4.png')); ?>" alt="hero image"
                  class="w-full h-full  object-cover">
              </div>
            </div>

          </li>
          <!-- SLIDE 5 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex items-center overflow-hidden herobg-five">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 pt-[111px] md:pt-0">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 5 (hero_title_5) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_5') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>

                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px] mt-[20px] lg:mt-[28px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 5 (hero_pera_5) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_pera_5') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="<?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 5 (hero_link_5) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_5') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-5.png')); ?>" alt="hero image"
                  class="w-full h-full object-cover">
              </div>
            </div>

          </li>
          <!-- SLIDE 6 -->
          <li
            class="splide__slide relative w-full min-h-[570px] lg:min-h-[872px] lg:h-screen flex items-center overflow-hidden herobg-six">


            <!-- CONTENT CONTAINER (Left Side) -->
            <div
              class="lg:max-w-[1444px] w-full mx-auto px-0 lg:px-[25px] relative z-10 h-full flex flex-col justify-end md:justify-center gap-[30px]">
              <div class="w-full lg:w-1/2 text-white px-[25px] md:px-0 pt-[111px] md:pt-0">
                <h1
                  class="text-[30px] lg:text-[36px] xl:text-[44px] font-bold leading-[36px] lg:leading-[58px] lg:max-w-[491px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Title 6 (hero_title_6) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_title_6') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h1>

                <p
                  class="text-white text-[18px] lg:text-[24px] xl:text-[32px] font-normal lg:font-bold max-w-[252px] md:max-w-[466px] leading-[24px] lg:leading-[46px] mt-[20px] lg:mt-[28px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Hero Pera 6 (hero_pera_6) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'hero_pera_6') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </p>
                <a href="<?php
                // Get settings
                $settings = get_option('bh_theme_settings');
                $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                // --- Field: Hero Link 6 (hero_link_6) ---
                $val = '';
                foreach ($fields as $f) {
                  if ($f['name'] === 'hero_link_6') {
                    $val = $f['value'];
                    break;
                  }
                }
                if ($val) {
                  echo esc_url($val);
                }
                ?>"
                  class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-6 lg:gap-[46px] min-h-[42px] lg:min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white mt-[30px] lg:mt-[52px] shadow-xl"><span>See
                    what you could save</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14"
                    fill="none" viewBox="0 0 12 14" class="max-w-[7px] lg:max-w-[10px]">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
                  </svg>
                </a>
              </div>
              <div class="w-full lg:w-1/2 md:hidden block min-h-[312px]">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/media/hero-md-6.png')); ?>" alt="hero image"
                  class="w-full h-full object-cover">
              </div>
            </div>

          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- product showcase -->
  <section id="get-started">
    <div class=" pt-10 pb-11 lg:pt-[75px] lg:pb-[120px]">
      <!-- top -->
      <div class="w-full lg:max-w-[1155px] mx-auto px-5 lg:px-0">
        <h2
          class="lg:max-w-[1040px] text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-tight pb-[40px] lg:pb-[0px]">

          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Business Mobiles (business_mobiles) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'business_mobiles') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h2>

        <!-- infinite loop top -->
        <div id="showcase-slider" class="splide splide-showcase infiniteloopsme block lg:hidden" data-config='<?php echo esc_attr(json_encode([
          "type" => "loop",
          "perPage" => 6,
          "gap" => "2rem",
          "drag" => "free", // Makes manual dragging smooth and free-flowing
          "arrows" => false,
          "pagination" => false,
          "cover" => false,
          "fade" => false,
          "autoScroll" => [
            "speed" => 1,
            "pauseOnHover" => true, // Optional: Pause when user hovers
          ],
          "breakpoints" => [
            1024 => [
              "perPage" => 4,
              "gap" => "1rem",
            ],
            640 => [
              "perPage" => 4,
              "gap" => "0.5rem",
              "arrows" => false,
            ],
          ],
        ])); ?>'>
          <div class="splide__track">
            <ul class="splide__list">
              <!-- 
             FIXES APPLIED:
             1. Changed h-[60px] to h-[500px] (60px is too small for a hero slider).
             2. Changed object-contain to object-cover (looks better for hero banners).
          -->
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-01.webp')); ?>"
                  alt="show-case image 1" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-02.webp')); ?>"
                  alt="show-case image 2" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-03.webp')); ?>"
                  alt="show-case image 3" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-04.webp')); ?>"
                  alt="show-case image 4" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-05.webp')); ?>"
                  alt="show-case image 5" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-06.webp')); ?>"
                  alt="show-case image 6" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- steps -->

      <div class="">
        <div id="multi-step-quote-form"></div>
      </div>

      <!-- bottom -->
      <div class="w-full lg:max-w-[1155px] mx-auto px-5 lg:px-0 hidden lg:block">
        <h3
          class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-tight mb-[120px]">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Business Title (business_title) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'business_title') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>

        </h3>
        <div id="showcase-slider-bottom" class="splide splide-showcase infiniteloopsme" data-config='<?php echo esc_attr(json_encode([
          "type" => "loop",
          "perPage" => 6,
          "gap" => "2rem",
          "drag" => "free", // Makes manual dragging smooth and free-flowing
          "arrows" => false,
          "pagination" => false,
          "cover" => false,
          "fade" => false,
          "autoScroll" => [
            "speed" => 1,
            "pauseOnHover" => true, // Optional: Pause when user hovers
          ],
          "breakpoints" => [
            1024 => [
              "perPage" => 4,
              "gap" => "1rem",
            ],
            640 => [
              "perPage" => 4,
              "gap" => "0.5rem",
              "arrows" => false,
            ],
          ],
        ])); ?>'>
          <div class="splide__track">
            <ul class="splide__list">
              <!-- 
             FIXES APPLIED:
             1. Changed h-[60px] to h-[500px] (60px is too small for a hero slider).
             2. Changed object-contain to object-cover (looks better for hero banners).
          -->
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-01.webp')); ?>"
                  alt="show-case image 1" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-02.webp')); ?>"
                  alt="show-case image 2" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-03.webp')); ?>"
                  alt="show-case image 3" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-04.webp')); ?>"
                  alt="show-case image 4" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-05.webp')); ?>"
                  alt="show-case image 5" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
              <li class="splide__slide">
                <img src="<?php echo esc_url(get_theme_file_uri('/assets/media/sc-06.webp')); ?>"
                  alt="show-case image 6" class="w-full h-[58px] object-contain" loading="lazy" />
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- bottom 2 -->
      <div class="w-full lg:max-w-[1155px] mx-auto px-5 lg:px-0 block lg:hidden">
        <h3
          class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-tight mb-[34px] max-w-[378px]">
          Choose from the leading networks</h3>

        <ul class="flex flex-row justify-center gap-[20px]">
          <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/Vodafone.svg')); ?>" alt="vodafone"
              class="min-w-[37px] min-h-[37px] "></li>
          <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/o2.svg')); ?>" alt="o2"
              class="min-w-[37px] min-h-[37px] "></li>
          <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/three.svg')); ?>" alt="three"
              class="min-w-[37px] min-h-[37px] "></li>
          <li><img src="<?php echo esc_url(get_theme_file_uri('assets/media/ee.svg')); ?>" alt="ee"
              class="min-w-[37px] min-h-[37px] "></li>
        </ul>
      </div>
    </div>
  </section>
  <!-- support  -->
  <section class="ylg-gradient pt-[64px] pb-[59px] lg:pt-[76px] lg:pb-[63px]">
    <div
      class="w-full lg:max-w-[1444px] px-[25px] mx-auto flex flex-col lg:flex-row justify-between items-center gap-[50px] lg:gap-[68px]">
      <div class="w-full lg:w-1/2">
        <img src="<?php
        // Get settings
        $settings = get_option('bh_theme_settings');
        $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

        // --- Field: Mobile Support Image (mobile_support_image) ---
        $val = '';
        foreach ($fields as $f) {
          if ($f['name'] === 'mobile_support_image') {
            $val = $f['value'];
            break;
          }
        }
        if ($val) {
          echo esc_url($val);
        }
        ?>" alt="about image" class="w-full h-full" />
      </div>
      <div class="w-full lg:w-1/2 text-center lg:text-left">
        <h2
          class="text-[28px] lg:text-[34px] xl:text-[40px] font-extrabold text-white leading-tight pb-[30px] lg:pb-[22px]">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile support services (mobile_support_services) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_support_services') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h2>
        <div class="max-w-[674px]">
          <p class="text-base text-white font-extrabold ">
            <?php
            // Get settings
            $settings = get_option('bh_theme_settings');
            $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

            // --- Field: Mobile Support Pera 1 (mobile_support_pera_1) ---
            $val = '';
            foreach ($fields as $f) {
              if ($f['name'] === 'mobile_support_pera_1') {
                $val = $f['value'];
                break;
              }
            }
            if ($val) {
              echo wp_kses_post($val);
            }
            ?>
          </p>
          <p class="text-base text-white font-semibold pt-4 pb-2">
            <?php
            // Get settings
            $settings = get_option('bh_theme_settings');
            $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

            // --- Field: Mobile Support Pera 2 (mobile_support_pera_2) ---
            $val = '';
            foreach ($fields as $f) {
              if ($f['name'] === 'mobile_support_pera_2') {
                $val = $f['value'];
                break;
              }
            }
            if ($val) {
              echo wp_kses_post($val);
            }
            ?>
          </p>
          <p class="text-base text-white font-semibold ">
            <?php
            // Get settings
            $settings = get_option('bh_theme_settings');
            $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

            // --- Field: Mobile Support Pera 3 (mobile_support_pera_3) ---
            $val = '';
            foreach ($fields as $f) {
              if ($f['name'] === 'mobile_support_pera_3') {
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

        <div class="mt-[28px] lg:mt-[38px]">
          <a href="
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile Support Link (mobile_support_link) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_support_link') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo esc_url($val);
          }
          ?>"
            class="bg-accent text-dark text-sm lg:text-base font-extrabold leading-none inline-flex flex-row justify-center items-center gap-5 lg:gap-[10px] min-h-[50px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white shadow-xl"><span>See
              how we can help</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" fill="none" viewBox="0 0 12 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
            </svg>
          </a>
        </div>

      </div>
    </div>
  </section>
  <!-- mobile -->
  <section class="pt-[44px] pb-[70px] lg:pt-[72px] lg:pb-[90px]">
    <div class="w-full lg:max-w-[1444px] px-[25px] mx-auto">
      <div class="mb-[34px] lg:mb-[66px]">
        <h4 class="text-sm lg:text-lg xl:text-xl text-yellow font-extrabold text-center">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile Section Mini (mobile_mini) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_mini') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h4>
        <h2
          class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-none py-4">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile Section Title (mobile_section_title) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_section_title') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h2>
        <p class="text-base text-dark mx-auto text-center font-semibold max-w-[291px] lg:max-w-full">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile Section Pera (mobile_section_pera) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_section_pera') {
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

      <div class="flex flex-col lg:flex-row justify-between items-center gap-[50px]">
        <div class="w-full lg:w-[45%] order-2 lg:order-1">
          <ul class="flex flex-col gap-[40px] lg:gap-[38px] mb-[53px] lg:mb-[70px]">
            <li class="flex flex-row items-start gap-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.png')); ?>" alt="check"
                class="w-[36px] h-[36px]">

              <div class="space-y-[10px]">
                <h3 class="text-xl font-semibold ">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 1 Title (mobile_list_1_title) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_1_title') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h3>
                <p class="text-lg text-dark max-w-[542px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 1 Pera (mobile_list_1_pera) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_1_pera') {
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

            </li>
            <li class="flex flex-row items-start gap-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.png')); ?>" alt="check"
                class="w-[36px] h-[36px]">

              <div class="space-y-[10px]">
                <h3 class="text-xl font-semibold ">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 2 Title (mobile_list_2_title) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_2_title') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h3>
                <p class="text-lg text-dark max-w-[542px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 2 Pera (mobile_list_2_pera) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_2_pera') {
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

            </li>
            <li class="flex flex-row items-start gap-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.png')); ?>" alt="check"
                class="w-[36px] h-[36px]">

              <div class="space-y-[10px]">
                <h3 class="text-xl font-semibold ">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 3 Title (mobile_list_3_title) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_3_title') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h3>
                <p class="text-lg text-dark max-w-[542px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 3 Pera (mobile_list_3_pera) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_3_pera') {
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

            </li>
            <li class="flex flex-row items-start gap-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.png')); ?>" alt="check"
                class="w-[36px] h-[36px]">

              <div class="space-y-[10px]">
                <h3 class="text-xl font-semibold ">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 4 Title (mobile_list_4_title) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_4_title') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h3>
                <p class="text-lg text-dark max-w-[542px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 4 Pera (mobile_list_4_pera) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_4_pera') {
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

            </li>
            <li class="flex flex-row items-start gap-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.png')); ?>" alt="check"
                class="w-[36px] h-[36px]">

              <div class="space-y-[10px]">
                <h3 class="text-xl font-semibold ">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 5 Title (mobile_list_5_title) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_5_title') {
                      $val = $f['value'];
                      break;
                    }
                  }
                  if ($val) {
                    echo wp_kses_post($val);
                  }
                  ?>
                </h3>
                <p class="text-lg text-dark max-w-[542px]">
                  <?php
                  // Get settings
                  $settings = get_option('bh_theme_settings');
                  $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

                  // --- Field: Mobile list 5 Pera (mobile_list_5_pera) ---
                  $val = '';
                  foreach ($fields as $f) {
                    if ($f['name'] === 'mobile_list_5_pera') {
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

            </li>
          </ul>
          <div class="flex justify-center lg:justify-start">
            <a href="
            <?php
            // Get settings
            $settings = get_option('bh_theme_settings');
            $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

            // --- Field: Mobile list Link (mobile_list_5_pera_copy) ---
            $val = '';
            foreach ($fields as $f) {
              if ($f['name'] === 'mobile_list_5_pera_copy') {
                $val = $f['value'];
                break;
              }
            }
            if ($val) {
              echo esc_url($val);
            }
            ?>"
              class="bg-accent text-dark text-base font-extrabold leading-none inline-flex flex-row justify-between items-center gap-[46px] min-h-[60px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-dark hover:text-white cursor-pointer self-center"><span>Start
                saving today</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" fill="none"
                viewBox="0 0 12 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="m1 1 8.534 4.655a1 1 0 0 1 .068 1.714L1 13" />
              </svg>
            </a>
          </div>
        </div>
        <div class="w-full lg:w-[55%]  order-1 lg:order-2">
          <img src="<?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Mobile Section Mini Image (mobile_section_mini_image) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'mobile_section_mini_image') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo esc_url($val);
          }
          ?>" alt="work demo image" class="w-full h-full">
        </div>
      </div>
    </div>
  </section>
  <!-- blog -->
  <section class="pt-[53px] pb-[50px] lg:pt-10 lg:pb-[70px] bg-light-gray" id="resources">
    <div class="w-full lg:max-w-[1200px] mx-auto px-[25px]">
      <div class="mb-[30px] lg:mb-[86px]">
        <h4 class="text-sm lg:text-lg xl:text-xl text-yellow font-extrabold text-center">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: RESOURCES (resources) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'resources') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h4>
        <h2
          class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-none pt-[15px] pb-[18px] lg:pt-[22px] lg:pb-[24px]">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Blog Titles (blog_titles) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'blog_titles') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h2>
        <p class="text-base text-dark mx-auto text-center font-semibold max-w-[777px]">From the latest mobile network
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: Blog Peras (blog_titles_copy) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'blog_titles_copy') {
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

      <!-- 
         BLOG SLIDER (Built from Zero)
         - ID: blog-carousel
         - Type: Loop (Infinite standard slide)
         - Autoplay: True
         - Interval: 3000ms
         - Columns: 3 (Desktop), 2 (Tablet), 1 (Mobile)
         - Arrow Navigation: True
         - Pagination: False
      -->
      <div id="blog-carousel" class="splide blog-carousel" data-config='<?php echo esc_attr(json_encode([
        "type" => "loop",      // Fade is often better for full-screen hero sliders
        "rewind" => true,
        "autoplay" => true,
        "speed" => 1000,
        "arrows" => true,
        "pagination" => false,
        "pauseOnHover" => false,
        "breakpoints" => [
          1024 => [
            "perPage" => 1,
            "gap" => "1.5rem",
          ],
          640 => [
            "perPage" => 1,
            "gap" => "1rem",
          ]
        ]
      ])); ?>'>

        <div class="splide__track py-4">
          <ul class="splide__list">

            <?php
            // 1. Define Query Arguments
            $blog_query = new WP_Query(array(
              'post_type' => 'post',
              'posts_per_page' => 6, // Number of slides
            ));

            // 2. Start Loop
            if ($blog_query->have_posts()):
              while ($blog_query->have_posts()):
                $blog_query->the_post();

                // Helper for Read Time
                $word_count = str_word_count(strip_tags(get_the_content()));
                $read_time = ceil($word_count / 200); // 200 words per minute
            
                // Helper for Image
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                // Fallback image if no featured image exists
                if (!$img_url) {
                  $img_url = get_theme_file_uri('/assets/media/sc-04.png');
                }
                ?>

                <li class="splide__slide p-4">
                  <div
                    class="bg-white rounded-[20px] lg:rounded-[30px] shadow-xl overflow-hidden flex flex-col lg:flex-row max-h-[714px] lg:min-h-[465px]">

                    <!-- Left: Featured Image -->
                    <div class="w-full lg:w-[45%] min-h-[250px] lg:min-h-full relative">
                      <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>"
                        class="absolute inset-0 w-full h-full object-cover" />
                    </div>

                    <!-- Right: Content -->
                    <div class="w-full lg:w-[55%] p-6 lg:px-[50px] lg:py-10 flex flex-col justify-center text-left">

                      <!-- Post Title -->
                      <h3 class="text-dark text-lg lg:text-[22px] font-extrabold leading-snug">
                        <a href="<?php the_permalink(); ?>" class="hover:text-[#205B17] transition-colors">
                          <?php the_title(); ?>
                        </a>
                      </h3>

                      <!-- Meta: Date & Read Time -->
                      <div
                        class="flex items-center text-[#FFDC46] font-bold text-sm lg:text-base mt-2 mb-5 lg:mt-[18px] lg:mb-12 uppercase tracking-wide">
                        <span><?php echo get_the_date('F j, Y'); ?></span>
                        <span class="mx-2">•</span>
                        <span><?php echo $read_time; ?> Min Read</span>
                      </div>

                      <!-- Excerpt -->
                      <div class="text-dark text-base font-semibold mb-5 lg:mb-[50px] leading-[26px] line-clamp-3">
                        <?php the_excerpt(); ?>
                      </div>

                      <!-- Read More Link -->
                      <div>
                        <a href="<?php the_permalink(); ?>"
                          class="inline-flex items-center bg-[#FFDC46] text-dark font-extrabold py-3 px-8  rounded-full hover:bg-yellow-300 transition-colors">
                          Read more
                          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                          </svg>
                        </a>
                      </div>

                    </div>
                  </div>
                </li>

                <?php
              endwhile;
              wp_reset_postdata(); // Important: Reset global post data
            else:
              ?>
              <!-- Fallback if no posts found -->
              <li class="splide__slide">
                <div class="p-12 text-center">No posts found.</div>
              </li>
            <?php endif; ?>

          </ul>
        </div>

        <!-- Custom Navigation Arrows -->
        <div class="splide__arrows flex justify-center gap-5 mt-7 lg:mt-[55px]">
          <button class="splide__arrow splide__arrow--prev !static">
            <img src="<?php echo esc_url(get_theme_file_uri('assets/media/arrow-left.svg')); ?>" alt="previous arrow"
              class="min-w-[42px] min-h-[42px]" />
          </button>
          <button class="splide__arrow splide__arrow--next !static ">
            <img src="<?php echo esc_url(get_theme_file_uri('assets/media/arrow-right.svg')); ?>" alt="next arrow"
              class="min-w-[42px] min-h-[42px]" />
          </button>
        </div>

      </div>
    </div>
  </section>

  <!-- newsletter -->
  <section class="pt-[64px] pb-[32px] lg:pt-[67px] lg:pb-[85px]" id="newsletter">
    <div class="w-full lg:max-w-[1378px] lg:px-0 px-[25px] mx-auto">
      <div class="mb-[24px] lg:mb-[40px]">
        <h4 class="text-sm lg:text-lg xl:text-xl text-yellow font-extrabold text-center">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: NEWSLETTERs (newsletters) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'newsletters') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h4>
        <h3
          class="text-[28px] lg:text-[34px] xl:text-[45px] font-extrabold text-secondary mx-auto text-center leading-none pt-[10px] pb-[20px]">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: NEWSLETTERs titles (newsletters_titles) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'newsletters_titles') {
              $val = $f['value'];
              break;
            }
          }
          if ($val) {
            echo wp_kses_post($val);
          }
          ?>
        </h3>
        <p class="text-base text-dark mx-auto text-center font-semibold max-w-[263px] lg:max-w-[777px]">
          <?php
          // Get settings
          $settings = get_option('bh_theme_settings');
          $fields = isset($settings['business-mobile']) ? $settings['business-mobile'] : [];

          // --- Field: NEWSLETTERs Peras (newsletters_peras) ---
          $val = '';
          foreach ($fields as $f) {
            if ($f['name'] === 'newsletters_peras') {
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
      <p class="text-sm lg:text-base text-dark font-semibold mt-[18px] max-w-[350px] lg:max-w-full">By signing up you
        are agreeing to receive emails
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

<?php get_footer(); ?>