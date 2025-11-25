// splide-init.js
(function () {
  // Default config applied to every slider
  const DEFAULTS = {
    type: "loop",
    perPage: 1,
    gap: "2rem",
    autoplay: false,
    interval: 5000,
    speed: 400,
    arrows: true,
    pagination: true,
    lazyLoad: true, // Splide's lazyLoad (if using plugin)
    breakpoints: {},
  };

  function safeParseJSON(json) {
    if (!json) return null;
    try {
      return JSON.parse(json);
    } catch (e) {
      console.warn("Splide config JSON parse failed:", e);
      return null;
    }
  }

  function mergeConfigs(defaults, custom) {
    // shallow merge; deep merge breakpoints manually
    const merged = Object.assign({}, defaults, custom || {});
    if (defaults.breakpoints || (custom && custom.breakpoints)) {
      merged.breakpoints = Object.assign(
        {},
        defaults.breakpoints || {},
        (custom && custom.breakpoints) || {}
      );
    }
    return merged;
  }

  // create Splide instance and mount; return instance
  function initSplide(el) {
    if (!el || el._splideInitialized) return null; // guard against double init
    const data = el.getAttribute("data-config");
    const parsed = safeParseJSON(data);
    const config = mergeConfigs(DEFAULTS, parsed);

    // Example: special handling if element has data-type for linked thumbs
    const dataType = el.getAttribute("data-type") || "";
    let splideInstance = null;

    if (dataType === "gallery-with-thumbs") {
      // Example expects markup: el = main slider, and a sibling with class .splide-thumbs exists
      const thumbs =
        el.nextElementSibling && el.nextElementSibling.querySelector(".splide")
          ? el.nextElementSibling.querySelector(".splide")
          : null;
      if (thumbs) {
        const main = new Splide(el, config);
        const thumbConfig = mergeConfigs(
          {
            rewind: true,
            fixedWidth: 100,
            fixedHeight: 60,
            isNavigation: true,
            gap: "8px",
            perPage: 4,
          },
          (parsed && parsed.thumbs) || {}
        );
        const thumb = new Splide(thumbs, thumbConfig);

        main.sync(thumb);
        thumb.mount();
        main.mount();
        el._splideInitialized = true;
        thumbs._splideInitialized = true;
        return { main, thumb };
      }
    }

    // Default: simple single instance
    splideInstance = new Splide(el, config);

    // Mount with window.splide.Extensions ONLY for the showcase slider
    // Mount with window.splide.Extensions ONLY for the showcase slider
    if (el.classList.contains("infiniteloopsme")) {
      splideInstance.mount(window.splide.Extensions);
    } else {
      splideInstance.mount();
    }

    el._splideInitialized = true;
    return splideInstance;
  }

  function initAllSplides(root = document) {
    const els = root.querySelectorAll(".splide");
    els.forEach(initSplide);
  }

  // Auto init on DOM ready
  document.addEventListener("DOMContentLoaded", function () {
    initAllSplides();
  });

  // If your site loads sliders dynamically, call initAllSplides(newContainer)
  // or use MutationObserver to detect added nodes:
  const observer = new MutationObserver((mutations) => {
    for (const m of mutations) {
      for (const node of m.addedNodes) {
        if (node.nodeType === 1) {
          if (node.matches && node.matches(".splide")) initSplide(node);
          else if (node.querySelector && node.querySelector(".splide"))
            initAllSplides(node);
        }
      }
    }
  });
  observer.observe(document.body, { childList: true, subtree: true });
})();
