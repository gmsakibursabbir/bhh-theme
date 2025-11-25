document.addEventListener("DOMContentLoaded", function () {
  // ------------------------------------------------------
  // 1. Header Scroll Logic
  // ------------------------------------------------------
  const header = document.getElementById("main-header");
  const logo = header ? header.querySelector("img") : null; // Target the logo image

  if (header) {
    // Default State: Transparent, 80px tall
    const defaultClasses = ["bg-transparent"];

    // Scrolled State: Dark BG, Shadow
    // Mobile: h-[60px]
    // Desktop: lg:h-[80px] (Keeps it taller on large screens)
    const scrollClasses = ["bg-[#1a1a1a]", "shadow-md"];

    function handleScroll() {
      if (window.scrollY > 50) {
        // Scrolled Down
        header.classList.remove(...defaultClasses);
        header.classList.add(...scrollClasses);

        // Scale logo down by 10%
        if (logo) {
          logo.classList.add(
            "scale-95",
            "transition-transform",
            "duration-300"
          );
        }
      } else {
        // Back at Top
        header.classList.remove(...scrollClasses);
        header.classList.add(...defaultClasses);

        // Reset logo size
        if (logo) {
          logo.classList.remove("scale-95");
        }
      }
    }
    window.addEventListener("scroll", handleScroll);

    // Check initial scroll position on load
    handleScroll();
  }

  // ------------------------------------------------------
  // 2. Mobile Menu Logic
  // ------------------------------------------------------
  const openBtn = document.getElementById("mobile-menu-open");
  const closeBtn = document.getElementById("mobile-menu-close");
  const menuOverlay = document.getElementById("mobile-menu-overlay");
  const menuPanel = document.getElementById("mobile-menu-panel");
  const mobileLinks = document.querySelectorAll(".mobile-nav-link");

  function openMenu() {
    if (!menuOverlay || !menuPanel) return;

    // 1. Unhide the wrapper
    menuOverlay.classList.remove("hidden");

    // 2. Small delay to allow DOM to render, then animate opacity and slide
    setTimeout(() => {
      menuOverlay.classList.remove("opacity-0");
      menuPanel.classList.remove("translate-x-full");
    }, 10);

    // Prevent background scrolling
    document.body.style.overflow = "hidden";
  }

  function closeMenu() {
    if (!menuOverlay || !menuPanel) return;

    // 1. Animate out
    menuOverlay.classList.add("opacity-0");
    menuPanel.classList.add("translate-x-full");

    // 2. Wait for animation to finish, then hide
    setTimeout(() => {
      menuOverlay.classList.add("hidden");
      // Re-enable scrolling
      document.body.style.overflow = "";
    }, 300);
  }

  // Event Listeners
  if (openBtn) openBtn.addEventListener("click", openMenu);
  if (closeBtn) closeBtn.addEventListener("click", closeMenu);

  // Close when clicking the dark background (overlay)
  if (menuOverlay) {
    menuOverlay.addEventListener("click", function (e) {
      if (e.target === menuOverlay) {
        closeMenu();
      }
    });
  }

  // Close when clicking any link inside the menu
  mobileLinks.forEach((link) => {
    link.addEventListener("click", closeMenu);
  });
  // ------------------------------------------------------
  // 3. Search Bar Logic
  // ------------------------------------------------------
  const searchOpenBtn = document.getElementById("mobile-search-open");
  const searchBar = document.getElementById("mobile-search-bar");

  if (searchOpenBtn && searchBar) {
    searchOpenBtn.addEventListener("click", function (e) {
      e.preventDefault();
      searchBar.classList.toggle("hidden");

      // Focus input if opening
      if (!searchBar.classList.contains("hidden")) {
        const input = searchBar.querySelector("input");
        if (input) input.focus();
      }
    });
  }
  // ------------------------------------------------------
  // 4. Splide Slider Logic
  // ------------------------------------------------------
  const sliders = document.querySelectorAll(".splide");

  if (sliders.length > 0 && typeof Splide !== "undefined") {
    sliders.forEach((slider) => {
      // Get config from data attribute if it exists
      let config = {};
      const configData = slider.getAttribute("data-config");

      if (configData) {
        try {
          config = JSON.parse(configData);
        } catch (e) {
          console.error("Error parsing Splide config:", e);
        }
      }

      // Initialize Splide
      if (window.splide && window.splide.Extensions) {
        new Splide(slider, config).mount(window.splide.Extensions);
      } else {
        new Splide(slider, config).mount();
      }
    });
  }
});
