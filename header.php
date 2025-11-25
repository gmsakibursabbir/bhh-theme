<!DOCTYPE html>
<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
?>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
</head>

<body <?php body_class(); ?>>
  <!-- USP BAR / TICKER -->
  <div class="bg-[#DEF6ED] overflow-hidden">
    <div class="lg:max-w-[1444px] mx-auto md:px-[25px] flex items-center  h-[65px] md:h-[80px]">

      <!-- Desktop Static List (Hidden on Mobile) -->
      <ul class="hidden lg:flex flex-row justify-between w-full">
        <li class="flex items-center gap-[14px]">
          <div><img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check image"
              class="w-[36px] h-[36px] rounded"></div>
          <span class="text-[19px] font-extrabold capitalize">UK based award-winning suppliers</span>
        </li>
        <li class="flex items-center gap-[14px]">
          <div><img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check image"
              class="w-[36px] h-[36px] rounded"></div>
          <span class="text-[19px] font-extrabold capitalize">Compare all major UK networks</span>
        </li>
        <li class="flex items-center gap-[14px]">
          <div><img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check image"
              class="w-[36px] h-[36px] rounded"></div>
          <span class="text-[19px] font-extrabold capitalize">No more hassle – we do the hard work for you</span>
        </li>
      </ul>

      <!-- Mobile CSS Ticker (Hidden on Desktop) -->
      <div class="lg:hidden w-full overflow-hidden whitespace-nowrap relative">
        <div class="inline-flex items-center animate-ticker">
          <!-- Set 1 -->
          <div class="flex items-center gap-8 pr-8">
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">UK based award-winning suppliers</span>
            </div>
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">Compare all major UK networks</span>
            </div>
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">No more hassle – we do the hard work for
                you</span>
            </div>
          </div>

          <!-- Set 2 (Duplicate for seamless loop) -->
          <div class="flex items-center gap-8 pr-8">
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">UK based award-winning suppliers</span>
            </div>
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">Compare all major UK networks</span>
            </div>
            <div class="flex items-center gap-[10px] pr-[30px]">
              <img src="<?php echo esc_url(get_theme_file_uri('assets/media/check.svg')); ?>" alt="check"
                class="w-[26px] h-[26px] rounded">
              <span class="text-[14px] font-extrabold capitalize leading-none">No more hassle – we do the hard work for
                you</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- header -->
  <header id="main-header"
    class="z-50 w-full sticky top-0 bg-transparent transition-all duration-300 h-[60px] lg:h-[80px]">
    <div class="lg:max-w-[1444px] mx-auto px-[25px] flex items-center justify-between h-full">

      <!-- Logo -->
      <a href="<?php echo get_home_url(); ?>" class="w-[200px] lg:w-[288px] block relative z-50">
        <img src="<?php echo esc_url(get_theme_file_uri('assets/media/business-hub-logo.svg')); ?>"
          alt="business hub logo" class="w-full h-auto">
      </a>

      <!-- Desktop Navigation -->
      <nav class="ml-auto hidden lg:block">
        <ul class="flex flex-row items-center gap-[38px] text-[17px] font-extrabold text-white">
          <li><a href="<?php echo get_home_url(); ?>/#services"
              class="hover:text-yellow-400 transition-colors">Services</a></li>
          <li><a href="#resources" class="hover:text-yellow-400 transition-colors">Resources</a></li>
          <li><a href="#contact" class="hover:text-yellow-400 transition-colors">Contact us</a></li>
          <li>
            <!-- Button -->
            <a href="#"
              class="bg-[#FFDC46] text-black text-base font-extrabold leading-none inline-flex flex-row justify-center items-center min-h-[53px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-white hover:text-dark">
              Start your quote
            </a>
          </li>
        </ul>
      </nav>

      <!-- Mobile Menu Trigger (Hamburger) -->
      <div class="flex items-center gap-[13px]">
        <button id="mobile-search-open"
          class="ml-auto lg:hidden text-white p-2 focus:outline-none hover:text-[#92D93E]">
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="3" />
            <rect width="2" height="4" x="12" y="13.414" fill="currentColor" rx="1" transform="rotate(-45 12 13.414)" />
          </svg>
        </button>
        <button id="mobile-menu-open" class="ml-auto lg:hidden text-white p-2 focus:outline-none hover:text-[#92D93E]">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="13" fill="none" viewBox="0 0 20 13">
            <rect width="20" height="3" fill="currentColor" rx="1.5" />
            <rect width="20" height="3" y="5" fill="currentColor" rx="1.5" />
            <rect width="20" height="3" y="10" fill="currentColor" rx="1.5" />
          </svg>
        </button>
      </div>
    </div>

    <!-- 
    MOBILE MENU OFF-CANVAS 
    1. Wrapper: Fixed inset-0, z-50, dark background overlay.
    2. Panel: Slide-in div from right.
  -->
    <div id="mobile-menu-overlay"
      class="fixed inset-0 z-[100] bg-black/60 hidden opacity-0 transition-opacity duration-300 lg:hidden">

      <div id="mobile-menu-panel"
        class="absolute top-0 right-0 w-[85%] max-w-[350px] h-full bg-[#1a1a1a] shadow-2xl transform translate-x-full transition-transform duration-300 flex flex-col">

        <!-- Header: Close Button -->
        <div class="flex items-center justify-between py-3 px-6 border-b border-gray-700">
          <span class="text-white font-semibold text-lg">Menu</span>
          <button id="mobile-menu-close" class="text-white hover:text-yellow-400 transition-colors p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Body: Navigation Links -->
        <div class="p-6 overflow-y-auto">
          <ul class="flex flex-col justify-center items-center gap-5 text-[18px] font-semibold text-white">
            <li><a href="<?php echo get_home_url(); ?>"
                class="mobile-nav-link block hover:text-[#92D93E] transition-colors">Home</a></li>
            <li><a href="#" class="mobile-nav-link block hover:text-[#92D93E] transition-colors">Services</a></li>
            <li><a href="#" class="mobile-nav-link block hover:text-[#92D93E] transition-colors">Resources</a></li>
            <li><a href="#" class="mobile-nav-link block hover:text-[#92D93E] transition-colors">Contact us</a></li>
            <li class="pt-4">
              <a href="#"
                class="mobile-nav-link bg-yellow text-black text-base font-extrabold leading-none inline-flex w-full justify-center items-center min-h-[48px] rounded-full px-[34px] transition-all ease-in-out duration-300 hover:bg-white hover:text-black">
                Start your quote
              </a>
            </li>
          </ul>
        </div>

      </div>
    </div>

    <!-- Search Bar (Hidden by default) -->
    <div id="mobile-search-bar"
      class="absolute top-full left-0 w-full bg-[#1a1a1a] p-4 hidden transition-all duration-300 shadow-lg border-t border-gray-700">
      <form role="search" method="get" class="flex items-center gap-2 max-w-[1444px] mx-auto px-[25px]"
        action="<?php echo home_url('/'); ?>">
        <input type="search"
          class="w-full bg-transparent border-b border-gray-500 text-white py-2 focus:outline-none focus:border-[#FFDC46] transition-colors"
          placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="text-white hover:text-[#FFDC46] transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </form>
    </div>

  </header>