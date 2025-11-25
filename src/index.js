import React from "react";
import ReactDOM from "react-dom/client";
import Lenis from "lenis";
import MultiStepForm from "./scripts/MultiStepForm";

const lenis = new Lenis({
  autoRaf: true,
});

// Optional: Log to verify it's running
console.log("Lenis initialized");
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
