import React from "react";
import ReactDOM from "react-dom/client";
import Lenis from "lenis";
import MultiStepForm from "./scripts/MultiStepForm";

const lenis = new Lenis({
  autoRaf: true,
});

// Optional: Log to verify it's running
console.log("Lenis initialized");

// Handle anchor links for smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const targetId = this.getAttribute("href");
    if (targetId === "#") return;

    // Check if target exists
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      lenis.scrollTo(targetElement);
    }
  });
});

// Handle full URL anchors (e.g. /page/#section) if on same page
document.querySelectorAll('a[href*="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    const url = new URL(href, window.location.origin);

    // If same pathname and has hash
    if (
      url.pathname === window.location.pathname &&
      url.hash &&
      url.hash !== "#"
    ) {
      const targetElement = document.querySelector(url.hash);
      if (targetElement) {
        e.preventDefault();
        lenis.scrollTo(targetElement);
      }
    }
  });
});
// if (document.querySelector("#render-react-example-here")) {
//   const root = ReactDOM.createRoot(
//     document.querySelector("#render-react-example-here")
//   );
//   root.render(<ExampleReactComponent />);
// }
if (document.querySelector("#multi-step-quote-form")) {
  const root = ReactDOM.createRoot(
    document.querySelector("#multi-step-quote-form")
  );
  root.render(<MultiStepForm />);
}
