/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/lenis/dist/lenis.mjs":
/*!*******************************************!*\
  !*** ./node_modules/lenis/dist/lenis.mjs ***!
  \*******************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Lenis)
/* harmony export */ });
// package.json
var version = "1.3.15";

// packages/core/src/maths.ts
function clamp(min, input, max) {
  return Math.max(min, Math.min(input, max));
}
function lerp(x, y, t) {
  return (1 - t) * x + t * y;
}
function damp(x, y, lambda, deltaTime) {
  return lerp(x, y, 1 - Math.exp(-lambda * deltaTime));
}
function modulo(n, d) {
  return (n % d + d) % d;
}

// packages/core/src/animate.ts
var Animate = class {
  isRunning = false;
  value = 0;
  from = 0;
  to = 0;
  currentTime = 0;
  // These are instanciated in the fromTo method
  lerp;
  duration;
  easing;
  onUpdate;
  /**
   * Advance the animation by the given delta time
   *
   * @param deltaTime - The time in seconds to advance the animation
   */
  advance(deltaTime) {
    if (!this.isRunning) return;
    let completed = false;
    if (this.duration && this.easing) {
      this.currentTime += deltaTime;
      const linearProgress = clamp(0, this.currentTime / this.duration, 1);
      completed = linearProgress >= 1;
      const easedProgress = completed ? 1 : this.easing(linearProgress);
      this.value = this.from + (this.to - this.from) * easedProgress;
    } else if (this.lerp) {
      this.value = damp(this.value, this.to, this.lerp * 60, deltaTime);
      if (Math.round(this.value) === this.to) {
        this.value = this.to;
        completed = true;
      }
    } else {
      this.value = this.to;
      completed = true;
    }
    if (completed) {
      this.stop();
    }
    this.onUpdate?.(this.value, completed);
  }
  /** Stop the animation */
  stop() {
    this.isRunning = false;
  }
  /**
   * Set up the animation from a starting value to an ending value
   * with optional parameters for lerping, duration, easing, and onUpdate callback
   *
   * @param from - The starting value
   * @param to - The ending value
   * @param options - Options for the animation
   */
  fromTo(from, to, { lerp: lerp2, duration, easing, onStart, onUpdate }) {
    this.from = this.value = from;
    this.to = to;
    this.lerp = lerp2;
    this.duration = duration;
    this.easing = easing;
    this.currentTime = 0;
    this.isRunning = true;
    onStart?.();
    this.onUpdate = onUpdate;
  }
};

// packages/core/src/debounce.ts
function debounce(callback, delay) {
  let timer;
  return function(...args) {
    let context = this;
    clearTimeout(timer);
    timer = setTimeout(() => {
      timer = void 0;
      callback.apply(context, args);
    }, delay);
  };
}

// packages/core/src/dimensions.ts
var Dimensions = class {
  constructor(wrapper, content, { autoResize = true, debounce: debounceValue = 250 } = {}) {
    this.wrapper = wrapper;
    this.content = content;
    if (autoResize) {
      this.debouncedResize = debounce(this.resize, debounceValue);
      if (this.wrapper instanceof Window) {
        window.addEventListener("resize", this.debouncedResize, false);
      } else {
        this.wrapperResizeObserver = new ResizeObserver(this.debouncedResize);
        this.wrapperResizeObserver.observe(this.wrapper);
      }
      this.contentResizeObserver = new ResizeObserver(this.debouncedResize);
      this.contentResizeObserver.observe(this.content);
    }
    this.resize();
  }
  width = 0;
  height = 0;
  scrollHeight = 0;
  scrollWidth = 0;
  // These are instanciated in the constructor as they need information from the options
  debouncedResize;
  wrapperResizeObserver;
  contentResizeObserver;
  destroy() {
    this.wrapperResizeObserver?.disconnect();
    this.contentResizeObserver?.disconnect();
    if (this.wrapper === window && this.debouncedResize) {
      window.removeEventListener("resize", this.debouncedResize, false);
    }
  }
  resize = () => {
    this.onWrapperResize();
    this.onContentResize();
  };
  onWrapperResize = () => {
    if (this.wrapper instanceof Window) {
      this.width = window.innerWidth;
      this.height = window.innerHeight;
    } else {
      this.width = this.wrapper.clientWidth;
      this.height = this.wrapper.clientHeight;
    }
  };
  onContentResize = () => {
    if (this.wrapper instanceof Window) {
      this.scrollHeight = this.content.scrollHeight;
      this.scrollWidth = this.content.scrollWidth;
    } else {
      this.scrollHeight = this.wrapper.scrollHeight;
      this.scrollWidth = this.wrapper.scrollWidth;
    }
  };
  get limit() {
    return {
      x: this.scrollWidth - this.width,
      y: this.scrollHeight - this.height
    };
  }
};

// packages/core/src/emitter.ts
var Emitter = class {
  events = {};
  /**
   * Emit an event with the given data
   * @param event Event name
   * @param args Data to pass to the event handlers
   */
  emit(event, ...args) {
    let callbacks = this.events[event] || [];
    for (let i = 0, length = callbacks.length; i < length; i++) {
      callbacks[i]?.(...args);
    }
  }
  /**
   * Add a callback to the event
   * @param event Event name
   * @param cb Callback function
   * @returns Unsubscribe function
   */
  on(event, cb) {
    this.events[event]?.push(cb) || (this.events[event] = [cb]);
    return () => {
      this.events[event] = this.events[event]?.filter((i) => cb !== i);
    };
  }
  /**
   * Remove a callback from the event
   * @param event Event name
   * @param callback Callback function
   */
  off(event, callback) {
    this.events[event] = this.events[event]?.filter((i) => callback !== i);
  }
  /**
   * Remove all event listeners and clean up
   */
  destroy() {
    this.events = {};
  }
};

// packages/core/src/virtual-scroll.ts
var LINE_HEIGHT = 100 / 6;
var listenerOptions = { passive: false };
var VirtualScroll = class {
  constructor(element, options = { wheelMultiplier: 1, touchMultiplier: 1 }) {
    this.element = element;
    this.options = options;
    window.addEventListener("resize", this.onWindowResize, false);
    this.onWindowResize();
    this.element.addEventListener("wheel", this.onWheel, listenerOptions);
    this.element.addEventListener(
      "touchstart",
      this.onTouchStart,
      listenerOptions
    );
    this.element.addEventListener(
      "touchmove",
      this.onTouchMove,
      listenerOptions
    );
    this.element.addEventListener("touchend", this.onTouchEnd, listenerOptions);
  }
  touchStart = {
    x: 0,
    y: 0
  };
  lastDelta = {
    x: 0,
    y: 0
  };
  window = {
    width: 0,
    height: 0
  };
  emitter = new Emitter();
  /**
   * Add an event listener for the given event and callback
   *
   * @param event Event name
   * @param callback Callback function
   */
  on(event, callback) {
    return this.emitter.on(event, callback);
  }
  /** Remove all event listeners and clean up */
  destroy() {
    this.emitter.destroy();
    window.removeEventListener("resize", this.onWindowResize, false);
    this.element.removeEventListener("wheel", this.onWheel, listenerOptions);
    this.element.removeEventListener(
      "touchstart",
      this.onTouchStart,
      listenerOptions
    );
    this.element.removeEventListener(
      "touchmove",
      this.onTouchMove,
      listenerOptions
    );
    this.element.removeEventListener(
      "touchend",
      this.onTouchEnd,
      listenerOptions
    );
  }
  /**
   * Event handler for 'touchstart' event
   *
   * @param event Touch event
   */
  onTouchStart = (event) => {
    const { clientX, clientY } = event.targetTouches ? event.targetTouches[0] : event;
    this.touchStart.x = clientX;
    this.touchStart.y = clientY;
    this.lastDelta = {
      x: 0,
      y: 0
    };
    this.emitter.emit("scroll", {
      deltaX: 0,
      deltaY: 0,
      event
    });
  };
  /** Event handler for 'touchmove' event */
  onTouchMove = (event) => {
    const { clientX, clientY } = event.targetTouches ? event.targetTouches[0] : event;
    const deltaX = -(clientX - this.touchStart.x) * this.options.touchMultiplier;
    const deltaY = -(clientY - this.touchStart.y) * this.options.touchMultiplier;
    this.touchStart.x = clientX;
    this.touchStart.y = clientY;
    this.lastDelta = {
      x: deltaX,
      y: deltaY
    };
    this.emitter.emit("scroll", {
      deltaX,
      deltaY,
      event
    });
  };
  onTouchEnd = (event) => {
    this.emitter.emit("scroll", {
      deltaX: this.lastDelta.x,
      deltaY: this.lastDelta.y,
      event
    });
  };
  /** Event handler for 'wheel' event */
  onWheel = (event) => {
    let { deltaX, deltaY, deltaMode } = event;
    const multiplierX = deltaMode === 1 ? LINE_HEIGHT : deltaMode === 2 ? this.window.width : 1;
    const multiplierY = deltaMode === 1 ? LINE_HEIGHT : deltaMode === 2 ? this.window.height : 1;
    deltaX *= multiplierX;
    deltaY *= multiplierY;
    deltaX *= this.options.wheelMultiplier;
    deltaY *= this.options.wheelMultiplier;
    this.emitter.emit("scroll", { deltaX, deltaY, event });
  };
  onWindowResize = () => {
    this.window = {
      width: window.innerWidth,
      height: window.innerHeight
    };
  };
};

// packages/core/src/lenis.ts
var defaultEasing = (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t));
var Lenis = class {
  _isScrolling = false;
  // true when scroll is animating
  _isStopped = false;
  // true if user should not be able to scroll - enable/disable programmatically
  _isLocked = false;
  // same as isStopped but enabled/disabled when scroll reaches target
  _preventNextNativeScrollEvent = false;
  _resetVelocityTimeout = null;
  __rafID = null;
  /**
   * Whether or not the user is touching the screen
   */
  isTouching;
  /**
   * The time in ms since the lenis instance was created
   */
  time = 0;
  /**
   * User data that will be forwarded through the scroll event
   *
   * @example
   * lenis.scrollTo(100, {
   *   userData: {
   *     foo: 'bar'
   *   }
   * })
   */
  userData = {};
  /**
   * The last velocity of the scroll
   */
  lastVelocity = 0;
  /**
   * The current velocity of the scroll
   */
  velocity = 0;
  /**
   * The direction of the scroll
   */
  direction = 0;
  /**
   * The options passed to the lenis instance
   */
  options;
  /**
   * The target scroll value
   */
  targetScroll;
  /**
   * The animated scroll value
   */
  animatedScroll;
  // These are instanciated here as they don't need information from the options
  animate = new Animate();
  emitter = new Emitter();
  // These are instanciated in the constructor as they need information from the options
  dimensions;
  // This is not private because it's used in the Snap class
  virtualScroll;
  constructor({
    wrapper = window,
    content = document.documentElement,
    eventsTarget = wrapper,
    smoothWheel = true,
    syncTouch = false,
    syncTouchLerp = 0.075,
    touchInertiaExponent = 1.7,
    duration,
    // in seconds
    easing,
    lerp: lerp2 = 0.1,
    infinite = false,
    orientation = "vertical",
    // vertical, horizontal
    gestureOrientation = orientation === "horizontal" ? "both" : "vertical",
    // vertical, horizontal, both
    touchMultiplier = 1,
    wheelMultiplier = 1,
    autoResize = true,
    prevent,
    virtualScroll,
    overscroll = true,
    autoRaf = false,
    anchors = false,
    autoToggle = false,
    // https://caniuse.com/?search=transition-behavior
    allowNestedScroll = false,
    __experimental__naiveDimensions = false
  } = {}) {
    window.lenisVersion = version;
    if (!wrapper || wrapper === document.documentElement) {
      wrapper = window;
    }
    if (typeof duration === "number" && typeof easing !== "function") {
      easing = defaultEasing;
    } else if (typeof easing === "function" && typeof duration !== "number") {
      duration = 1;
    }
    this.options = {
      wrapper,
      content,
      eventsTarget,
      smoothWheel,
      syncTouch,
      syncTouchLerp,
      touchInertiaExponent,
      duration,
      easing,
      lerp: lerp2,
      infinite,
      gestureOrientation,
      orientation,
      touchMultiplier,
      wheelMultiplier,
      autoResize,
      prevent,
      virtualScroll,
      overscroll,
      autoRaf,
      anchors,
      autoToggle,
      allowNestedScroll,
      __experimental__naiveDimensions
    };
    this.dimensions = new Dimensions(wrapper, content, { autoResize });
    this.updateClassName();
    this.targetScroll = this.animatedScroll = this.actualScroll;
    this.options.wrapper.addEventListener("scroll", this.onNativeScroll, false);
    this.options.wrapper.addEventListener("scrollend", this.onScrollEnd, {
      capture: true
    });
    if (this.options.anchors && this.options.wrapper === window) {
      this.options.wrapper.addEventListener(
        "click",
        this.onClick,
        false
      );
    }
    this.options.wrapper.addEventListener(
      "pointerdown",
      this.onPointerDown,
      false
    );
    this.virtualScroll = new VirtualScroll(eventsTarget, {
      touchMultiplier,
      wheelMultiplier
    });
    this.virtualScroll.on("scroll", this.onVirtualScroll);
    if (this.options.autoToggle) {
      this.rootElement.addEventListener("transitionend", this.onTransitionEnd, {
        passive: true
      });
    }
    if (this.options.autoRaf) {
      this.__rafID = requestAnimationFrame(this.raf);
    }
  }
  /**
   * Destroy the lenis instance, remove all event listeners and clean up the class name
   */
  destroy() {
    this.emitter.destroy();
    this.options.wrapper.removeEventListener(
      "scroll",
      this.onNativeScroll,
      false
    );
    this.options.wrapper.removeEventListener("scrollend", this.onScrollEnd, {
      capture: true
    });
    this.options.wrapper.removeEventListener(
      "pointerdown",
      this.onPointerDown,
      false
    );
    if (this.options.anchors && this.options.wrapper === window) {
      this.options.wrapper.removeEventListener(
        "click",
        this.onClick,
        false
      );
    }
    this.virtualScroll.destroy();
    this.dimensions.destroy();
    this.cleanUpClassName();
    if (this.__rafID) {
      cancelAnimationFrame(this.__rafID);
    }
  }
  on(event, callback) {
    return this.emitter.on(event, callback);
  }
  off(event, callback) {
    return this.emitter.off(event, callback);
  }
  onScrollEnd = (e) => {
    if (!(e instanceof CustomEvent)) {
      if (this.isScrolling === "smooth" || this.isScrolling === false) {
        e.stopPropagation();
      }
    }
  };
  dispatchScrollendEvent = () => {
    this.options.wrapper.dispatchEvent(
      new CustomEvent("scrollend", {
        bubbles: this.options.wrapper === window,
        // cancelable: false,
        detail: {
          lenisScrollEnd: true
        }
      })
    );
  };
  onTransitionEnd = (event) => {
    if (event.propertyName.includes("overflow")) {
      const property = this.isHorizontal ? "overflow-x" : "overflow-y";
      const overflow = getComputedStyle(this.rootElement)[property];
      if (["hidden", "clip"].includes(overflow)) {
        this.internalStop();
      } else {
        this.internalStart();
      }
    }
  };
  setScroll(scroll) {
    if (this.isHorizontal) {
      this.options.wrapper.scrollTo({ left: scroll, behavior: "instant" });
    } else {
      this.options.wrapper.scrollTo({ top: scroll, behavior: "instant" });
    }
  }
  onClick = (event) => {
    const path = event.composedPath();
    const anchor = path.find(
      (node) => node instanceof HTMLAnchorElement && node.getAttribute("href")?.includes("#")
    );
    if (anchor) {
      const href = anchor.getAttribute("href");
      if (href) {
        const options = typeof this.options.anchors === "object" && this.options.anchors ? this.options.anchors : void 0;
        const target = `#${href.split("#")[1]}`;
        this.scrollTo(target, options);
      }
    }
  };
  onPointerDown = (event) => {
    if (event.button === 1) {
      this.reset();
    }
  };
  onVirtualScroll = (data) => {
    if (typeof this.options.virtualScroll === "function" && this.options.virtualScroll(data) === false)
      return;
    const { deltaX, deltaY, event } = data;
    this.emitter.emit("virtual-scroll", { deltaX, deltaY, event });
    if (event.ctrlKey) return;
    if (event.lenisStopPropagation) return;
    const isTouch = event.type.includes("touch");
    const isWheel = event.type.includes("wheel");
    this.isTouching = event.type === "touchstart" || event.type === "touchmove";
    const isClickOrTap = deltaX === 0 && deltaY === 0;
    const isTapToStop = this.options.syncTouch && isTouch && event.type === "touchstart" && isClickOrTap && !this.isStopped && !this.isLocked;
    if (isTapToStop) {
      this.reset();
      return;
    }
    const isUnknownGesture = this.options.gestureOrientation === "vertical" && deltaY === 0 || this.options.gestureOrientation === "horizontal" && deltaX === 0;
    if (isClickOrTap || isUnknownGesture) {
      return;
    }
    let composedPath = event.composedPath();
    composedPath = composedPath.slice(0, composedPath.indexOf(this.rootElement));
    const prevent = this.options.prevent;
    if (!!composedPath.find(
      (node) => node instanceof HTMLElement && (typeof prevent === "function" && prevent?.(node) || node.hasAttribute?.("data-lenis-prevent") || isTouch && node.hasAttribute?.("data-lenis-prevent-touch") || isWheel && node.hasAttribute?.("data-lenis-prevent-wheel") || this.options.allowNestedScroll && this.checkNestedScroll(node, { deltaX, deltaY }))
    ))
      return;
    if (this.isStopped || this.isLocked) {
      if (event.cancelable) {
        event.preventDefault();
      }
      return;
    }
    const isSmooth = this.options.syncTouch && isTouch || this.options.smoothWheel && isWheel;
    if (!isSmooth) {
      this.isScrolling = "native";
      this.animate.stop();
      event.lenisStopPropagation = true;
      return;
    }
    let delta = deltaY;
    if (this.options.gestureOrientation === "both") {
      delta = Math.abs(deltaY) > Math.abs(deltaX) ? deltaY : deltaX;
    } else if (this.options.gestureOrientation === "horizontal") {
      delta = deltaX;
    }
    if (!this.options.overscroll || this.options.infinite || this.options.wrapper !== window && this.limit > 0 && (this.animatedScroll > 0 && this.animatedScroll < this.limit || this.animatedScroll === 0 && deltaY > 0 || this.animatedScroll === this.limit && deltaY < 0)) {
      event.lenisStopPropagation = true;
    }
    if (event.cancelable) {
      event.preventDefault();
    }
    const isSyncTouch = isTouch && this.options.syncTouch;
    const isTouchEnd = isTouch && event.type === "touchend";
    const hasTouchInertia = isTouchEnd;
    if (hasTouchInertia) {
      delta = Math.sign(this.velocity) * Math.pow(Math.abs(this.velocity), this.options.touchInertiaExponent);
    }
    this.scrollTo(this.targetScroll + delta, {
      programmatic: false,
      ...isSyncTouch ? {
        lerp: hasTouchInertia ? this.options.syncTouchLerp : 1
        // immediate: !hasTouchInertia,
      } : {
        lerp: this.options.lerp,
        duration: this.options.duration,
        easing: this.options.easing
      }
    });
  };
  /**
   * Force lenis to recalculate the dimensions
   */
  resize() {
    this.dimensions.resize();
    this.animatedScroll = this.targetScroll = this.actualScroll;
    this.emit();
  }
  emit() {
    this.emitter.emit("scroll", this);
  }
  onNativeScroll = () => {
    if (this._resetVelocityTimeout !== null) {
      clearTimeout(this._resetVelocityTimeout);
      this._resetVelocityTimeout = null;
    }
    if (this._preventNextNativeScrollEvent) {
      this._preventNextNativeScrollEvent = false;
      return;
    }
    if (this.isScrolling === false || this.isScrolling === "native") {
      const lastScroll = this.animatedScroll;
      this.animatedScroll = this.targetScroll = this.actualScroll;
      this.lastVelocity = this.velocity;
      this.velocity = this.animatedScroll - lastScroll;
      this.direction = Math.sign(
        this.animatedScroll - lastScroll
      );
      if (!this.isStopped) {
        this.isScrolling = "native";
      }
      this.emit();
      if (this.velocity !== 0) {
        this._resetVelocityTimeout = setTimeout(() => {
          this.lastVelocity = this.velocity;
          this.velocity = 0;
          this.isScrolling = false;
          this.emit();
        }, 400);
      }
    }
  };
  reset() {
    this.isLocked = false;
    this.isScrolling = false;
    this.animatedScroll = this.targetScroll = this.actualScroll;
    this.lastVelocity = this.velocity = 0;
    this.animate.stop();
  }
  /**
   * Start lenis scroll after it has been stopped
   */
  start() {
    if (!this.isStopped) return;
    if (this.options.autoToggle) {
      this.rootElement.style.removeProperty("overflow");
      return;
    }
    this.internalStart();
  }
  internalStart() {
    if (!this.isStopped) return;
    this.reset();
    this.isStopped = false;
    this.emit();
  }
  /**
   * Stop lenis scroll
   */
  stop() {
    if (this.isStopped) return;
    if (this.options.autoToggle) {
      this.rootElement.style.setProperty("overflow", "clip");
      return;
    }
    this.internalStop();
  }
  internalStop() {
    if (this.isStopped) return;
    this.reset();
    this.isStopped = true;
    this.emit();
  }
  /**
   * RequestAnimationFrame for lenis
   *
   * @param time The time in ms from an external clock like `requestAnimationFrame` or Tempus
   */
  raf = (time) => {
    const deltaTime = time - (this.time || time);
    this.time = time;
    this.animate.advance(deltaTime * 1e-3);
    if (this.options.autoRaf) {
      this.__rafID = requestAnimationFrame(this.raf);
    }
  };
  /**
   * Scroll to a target value
   *
   * @param target The target value to scroll to
   * @param options The options for the scroll
   *
   * @example
   * lenis.scrollTo(100, {
   *   offset: 100,
   *   duration: 1,
   *   easing: (t) => 1 - Math.cos((t * Math.PI) / 2),
   *   lerp: 0.1,
   *   onStart: () => {
   *     console.log('onStart')
   *   },
   *   onComplete: () => {
   *     console.log('onComplete')
   *   },
   * })
   */
  scrollTo(target, {
    offset = 0,
    immediate = false,
    lock = false,
    duration = this.options.duration,
    easing = this.options.easing,
    lerp: lerp2 = this.options.lerp,
    onStart,
    onComplete,
    force = false,
    // scroll even if stopped
    programmatic = true,
    // called from outside of the class
    userData
  } = {}) {
    if ((this.isStopped || this.isLocked) && !force) return;
    if (typeof target === "string" && ["top", "left", "start", "#"].includes(target)) {
      target = 0;
    } else if (typeof target === "string" && ["bottom", "right", "end"].includes(target)) {
      target = this.limit;
    } else {
      let node;
      if (typeof target === "string") {
        node = document.querySelector(target);
        if (!node) {
          if (target === "#top") {
            target = 0;
          } else {
            console.warn("Lenis: Target not found", target);
          }
        }
      } else if (target instanceof HTMLElement && target?.nodeType) {
        node = target;
      }
      if (node) {
        if (this.options.wrapper !== window) {
          const wrapperRect = this.rootElement.getBoundingClientRect();
          offset -= this.isHorizontal ? wrapperRect.left : wrapperRect.top;
        }
        const rect = node.getBoundingClientRect();
        target = (this.isHorizontal ? rect.left : rect.top) + this.animatedScroll;
      }
    }
    if (typeof target !== "number") return;
    target += offset;
    target = Math.round(target);
    if (this.options.infinite) {
      if (programmatic) {
        this.targetScroll = this.animatedScroll = this.scroll;
        const distance = target - this.animatedScroll;
        if (distance > this.limit / 2) {
          target = target - this.limit;
        } else if (distance < -this.limit / 2) {
          target = target + this.limit;
        }
      }
    } else {
      target = clamp(0, target, this.limit);
    }
    if (target === this.targetScroll) {
      onStart?.(this);
      onComplete?.(this);
      return;
    }
    this.userData = userData ?? {};
    if (immediate) {
      this.animatedScroll = this.targetScroll = target;
      this.setScroll(this.scroll);
      this.reset();
      this.preventNextNativeScrollEvent();
      this.emit();
      onComplete?.(this);
      this.userData = {};
      requestAnimationFrame(() => {
        this.dispatchScrollendEvent();
      });
      return;
    }
    if (!programmatic) {
      this.targetScroll = target;
    }
    if (typeof duration === "number" && typeof easing !== "function") {
      easing = defaultEasing;
    } else if (typeof easing === "function" && typeof duration !== "number") {
      duration = 1;
    }
    this.animate.fromTo(this.animatedScroll, target, {
      duration,
      easing,
      lerp: lerp2,
      onStart: () => {
        if (lock) this.isLocked = true;
        this.isScrolling = "smooth";
        onStart?.(this);
      },
      onUpdate: (value, completed) => {
        this.isScrolling = "smooth";
        this.lastVelocity = this.velocity;
        this.velocity = value - this.animatedScroll;
        this.direction = Math.sign(this.velocity);
        this.animatedScroll = value;
        this.setScroll(this.scroll);
        if (programmatic) {
          this.targetScroll = value;
        }
        if (!completed) this.emit();
        if (completed) {
          this.reset();
          this.emit();
          onComplete?.(this);
          this.userData = {};
          requestAnimationFrame(() => {
            this.dispatchScrollendEvent();
          });
          this.preventNextNativeScrollEvent();
        }
      }
    });
  }
  preventNextNativeScrollEvent() {
    this._preventNextNativeScrollEvent = true;
    requestAnimationFrame(() => {
      this._preventNextNativeScrollEvent = false;
    });
  }
  checkNestedScroll(node, { deltaX, deltaY }) {
    const time = Date.now();
    const cache = node._lenis ??= {};
    let hasOverflowX, hasOverflowY, isScrollableX, isScrollableY, scrollWidth, scrollHeight, clientWidth, clientHeight;
    const gestureOrientation = this.options.gestureOrientation;
    if (time - (cache.time ?? 0) > 2e3) {
      cache.time = Date.now();
      const computedStyle = window.getComputedStyle(node);
      cache.computedStyle = computedStyle;
      const overflowXString = computedStyle.overflowX;
      const overflowYString = computedStyle.overflowY;
      hasOverflowX = ["auto", "overlay", "scroll"].includes(overflowXString);
      hasOverflowY = ["auto", "overlay", "scroll"].includes(overflowYString);
      cache.hasOverflowX = hasOverflowX;
      cache.hasOverflowY = hasOverflowY;
      if (!hasOverflowX && !hasOverflowY) return false;
      if (gestureOrientation === "vertical" && !hasOverflowY) return false;
      if (gestureOrientation === "horizontal" && !hasOverflowX) return false;
      scrollWidth = node.scrollWidth;
      scrollHeight = node.scrollHeight;
      clientWidth = node.clientWidth;
      clientHeight = node.clientHeight;
      isScrollableX = scrollWidth > clientWidth;
      isScrollableY = scrollHeight > clientHeight;
      cache.isScrollableX = isScrollableX;
      cache.isScrollableY = isScrollableY;
      cache.scrollWidth = scrollWidth;
      cache.scrollHeight = scrollHeight;
      cache.clientWidth = clientWidth;
      cache.clientHeight = clientHeight;
    } else {
      isScrollableX = cache.isScrollableX;
      isScrollableY = cache.isScrollableY;
      hasOverflowX = cache.hasOverflowX;
      hasOverflowY = cache.hasOverflowY;
      scrollWidth = cache.scrollWidth;
      scrollHeight = cache.scrollHeight;
      clientWidth = cache.clientWidth;
      clientHeight = cache.clientHeight;
    }
    if (!hasOverflowX && !hasOverflowY || !isScrollableX && !isScrollableY) {
      return false;
    }
    if (gestureOrientation === "vertical" && (!hasOverflowY || !isScrollableY))
      return false;
    if (gestureOrientation === "horizontal" && (!hasOverflowX || !isScrollableX))
      return false;
    let orientation;
    if (gestureOrientation === "horizontal") {
      orientation = "x";
    } else if (gestureOrientation === "vertical") {
      orientation = "y";
    } else {
      const isScrollingX = deltaX !== 0;
      const isScrollingY = deltaY !== 0;
      if (isScrollingX && hasOverflowX && isScrollableX) {
        orientation = "x";
      }
      if (isScrollingY && hasOverflowY && isScrollableY) {
        orientation = "y";
      }
    }
    if (!orientation) return false;
    let scroll, maxScroll, delta, hasOverflow, isScrollable;
    if (orientation === "x") {
      scroll = node.scrollLeft;
      maxScroll = scrollWidth - clientWidth;
      delta = deltaX;
      hasOverflow = hasOverflowX;
      isScrollable = isScrollableX;
    } else if (orientation === "y") {
      scroll = node.scrollTop;
      maxScroll = scrollHeight - clientHeight;
      delta = deltaY;
      hasOverflow = hasOverflowY;
      isScrollable = isScrollableY;
    } else {
      return false;
    }
    const willScroll = delta > 0 ? scroll < maxScroll : scroll > 0;
    return willScroll && hasOverflow && isScrollable;
  }
  /**
   * The root element on which lenis is instanced
   */
  get rootElement() {
    return this.options.wrapper === window ? document.documentElement : this.options.wrapper;
  }
  /**
   * The limit which is the maximum scroll value
   */
  get limit() {
    if (this.options.__experimental__naiveDimensions) {
      if (this.isHorizontal) {
        return this.rootElement.scrollWidth - this.rootElement.clientWidth;
      } else {
        return this.rootElement.scrollHeight - this.rootElement.clientHeight;
      }
    } else {
      return this.dimensions.limit[this.isHorizontal ? "x" : "y"];
    }
  }
  /**
   * Whether or not the scroll is horizontal
   */
  get isHorizontal() {
    return this.options.orientation === "horizontal";
  }
  /**
   * The actual scroll value
   */
  get actualScroll() {
    const wrapper = this.options.wrapper;
    return this.isHorizontal ? wrapper.scrollX ?? wrapper.scrollLeft : wrapper.scrollY ?? wrapper.scrollTop;
  }
  /**
   * The current scroll value
   */
  get scroll() {
    return this.options.infinite ? modulo(this.animatedScroll, this.limit) : this.animatedScroll;
  }
  /**
   * The progress of the scroll relative to the limit
   */
  get progress() {
    return this.limit === 0 ? 1 : this.scroll / this.limit;
  }
  /**
   * Current scroll state
   */
  get isScrolling() {
    return this._isScrolling;
  }
  set isScrolling(value) {
    if (this._isScrolling !== value) {
      this._isScrolling = value;
      this.updateClassName();
    }
  }
  /**
   * Check if lenis is stopped
   */
  get isStopped() {
    return this._isStopped;
  }
  set isStopped(value) {
    if (this._isStopped !== value) {
      this._isStopped = value;
      this.updateClassName();
    }
  }
  /**
   * Check if lenis is locked
   */
  get isLocked() {
    return this._isLocked;
  }
  set isLocked(value) {
    if (this._isLocked !== value) {
      this._isLocked = value;
      this.updateClassName();
    }
  }
  /**
   * Check if lenis is smooth scrolling
   */
  get isSmooth() {
    return this.isScrolling === "smooth";
  }
  /**
   * The class name applied to the wrapper element
   */
  get className() {
    let className = "lenis";
    if (this.options.autoToggle) className += " lenis-autoToggle";
    if (this.isStopped) className += " lenis-stopped";
    if (this.isLocked) className += " lenis-locked";
    if (this.isScrolling) className += " lenis-scrolling";
    if (this.isScrolling === "smooth") className += " lenis-smooth";
    return className;
  }
  updateClassName() {
    this.cleanUpClassName();
    this.rootElement.className = `${this.rootElement.className} ${this.className}`.trim();
  }
  cleanUpClassName() {
    this.rootElement.className = this.rootElement.className.replace(/lenis(-\w+)?/g, "").trim();
  }
};

//# sourceMappingURL=lenis.mjs.map

/***/ }),

/***/ "./node_modules/react-dom/client.js":
/*!******************************************!*\
  !*** ./node_modules/react-dom/client.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {



var m = __webpack_require__(/*! react-dom */ "react-dom");
if (false) // removed by dead control flow
{} else {
  var i = m.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED;
  exports.createRoot = function(c, o) {
    i.usingClientEntryPoint = true;
    try {
      return m.createRoot(c, o);
    } finally {
      i.usingClientEntryPoint = false;
    }
  };
  exports.hydrateRoot = function(c, h, o) {
    i.usingClientEntryPoint = true;
    try {
      return m.hydrateRoot(c, h, o);
    } finally {
      i.usingClientEntryPoint = false;
    }
  };
}


/***/ }),

/***/ "./src/scripts/MultiStepForm.js":
/*!**************************************!*\
  !*** ./src/scripts/MultiStepForm.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


// --- Icons ---

const IconMobileOne = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "82",
  height: "91",
  fill: "none",
  viewBox: "0 0 82 91",
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M6.2 91c-1.705 0-3.164-.608-4.378-1.823C.607 87.962 0 86.502 0 84.795V6.206C0 4.55.62 3.102 1.86 1.86 3.1.621 4.547 0 6.2 0h45.26c1.705 0 3.165.607 4.38 1.822 1.213 1.215 1.82 2.676 1.82 4.383v15.51c1.24.208 2.273.792 3.1 1.754S62 25.52 62 26.739v7.696c0 1.31-.413 2.448-1.24 3.413-.827.965-1.86 1.55-3.1 1.758v45.19c0 1.706-.607 3.166-1.82 4.38C54.624 90.393 53.164 91 51.46 91H6.2Zm0-6.204h45.26V6.205H6.2v78.59Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M72.31 7c1.567 0 2.91.56 4.026 1.682 1.116 1.122 1.674 2.47 1.674 4.045v14.319c1.14.19 2.09.73 2.85 1.617.76.888 1.14 1.895 1.14 3.02v7.103c0 1.21-.38 2.26-1.14 3.15-.76.891-1.71 1.433-2.85 1.624v41.712c0 1.575-.558 2.924-1.674 4.045C75.219 90.44 73.877 91 72.31 91H30.7c-1.567 0-2.91-.56-4.025-1.683-1.117-1.12-1.675-2.47-1.675-4.044V85h5.7v.272h41.61V12.728H51.442V7H72.31Z"
  })]
});
const IconMobileTwo = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "110",
  height: "95",
  fill: "none",
  viewBox: "0 0 110 95",
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M31 91c-1.704 0-3.164-.608-4.378-1.823-1.214-1.215-1.821-2.675-1.821-4.382V6.206c0-1.655.62-3.103 1.86-4.344C27.9.621 29.347 0 31 0h45.26c1.705 0 3.165.607 4.379 1.822 1.214 1.215 1.82 2.676 1.82 4.383v15.51a5.078 5.078 0 0 1 3.1 1.754c.827.962 1.24 2.052 1.24 3.27v7.696c0 1.31-.413 2.448-1.24 3.413a5.069 5.069 0 0 1-3.1 1.758v45.19c0 1.706-.606 3.166-1.82 4.38C79.425 90.393 77.966 91 76.26 91H31Zm0-6.204h45.26V6.205H31v78.59Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M103.383 10.416c1.548.243 2.787 1.005 3.717 2.285.928 1.281 1.272 2.7 1.028 4.255l-2.216 14.146a4.662 4.662 0 0 1 2.566 2.04c.613.995.833 2.048.659 3.159l-1.1 7.018c-.187 1.195-.725 2.173-1.613 2.936-.889.762-1.911 1.15-3.067 1.162l-6.454 41.21c-.243 1.557-1.003 2.803-2.279 3.738-1.277.936-2.69 1.282-4.238 1.04L55.874 88h21.242v-2.47l14.156 2.216 11.224-71.672-25.38-3.974V6.303l26.267 4.113Zm-73.267 2.499L5.702 17.1l12.253 71.503 12.161-2.085V88h25.265l-36.458 6.247c-1.545.265-2.963-.061-4.252-.978-1.29-.917-2.068-2.151-2.334-3.704L.084 18.063c-.258-1.506.079-2.92 1.009-4.242.93-1.32 2.144-2.11 3.641-2.367l25.382-4.35v5.811Z"
  })]
});
const IconMobileThree = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "163",
  height: "96",
  fill: "none",
  viewBox: "0 0 163 96",
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M107.605 0c1.705 0 3.165.607 4.379 1.821 1.214 1.216 1.822 2.677 1.822 4.383v.007l26.629 8.585c1.491.48 2.597 1.427 3.316 2.837.718 1.41.835 2.864.352 4.363l-.393 1.216 16.406 10.88c1.003.665 1.625 1.594 1.863 2.786.239 1.192.024 2.293-.645 3.302l-6.081 9.169a3.584 3.584 0 0 1 1.138 2.247c.109.891-.075 1.697-.552 2.417l-3.017 4.55c-.513.774-1.203 1.285-2.068 1.533a3.578 3.578 0 0 1-2.515-.172l-17.715 26.713c-.668 1.008-1.598 1.635-2.789 1.88-1.191.244-2.289.032-3.293-.633l-1.302-.865-1.296 4.024c-.484 1.499-1.428 2.61-2.834 3.335-1.407.725-2.857.848-4.349.367L103.045 91H66.411l-8.146 3.726c-1.426.651-2.88.7-4.36.143-1.482-.555-2.55-1.55-3.206-2.981l-2.587-5.657-3.388 3.07c-.893.81-1.947 1.181-3.161 1.118-1.215-.063-2.228-.543-3.04-1.44L1.1 47.663c-.788-.87-1.153-1.925-1.094-3.165.058-1.24.52-2.253 1.386-3.037l18.703-16.94c-.162-.96-.056-1.947.32-2.963.56-1.516 1.531-2.59 2.913-3.223l33.848-15.48c.236-.345.513-.676.83-.994C59.246.621 60.693 0 62.346 0h45.259ZM25.71 23.544l30.173 65.973 1.686-.773c-.949-1.124-1.424-2.44-1.424-3.95V9.624L25.71 23.543Zm88.096-1.828a5.07 5.07 0 0 1 3.099 1.753c.827.962 1.241 2.052 1.241 3.27v7.696c0 1.31-.414 2.447-1.241 3.413a5.07 5.07 0 0 1-3.099 1.758v45.189c0 1.245-.326 2.359-.973 3.343l3.586 1.156 22.259-69.047-24.872-8.018v9.487ZM4.346 44.724l37.423 41.315 4.422-4.007L21.87 28.851 4.346 44.724Zm58 40.07h45.259V6.205h-45.26v78.59Zm77.363-49.17a4.664 4.664 0 0 1 2.217 2.414c.451 1.079.503 2.154.158 3.224l-2.18 6.76c-.371 1.151-1.054 2.034-2.05 2.649-.997.615-2.068.838-3.211.67L124.542 82.67l2.332 1.547 30.81-46.458-15.376-10.198-2.599 8.063Z"
  })
});
const IconMobileFour = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "152",
  height: "115",
  fill: "none",
  viewBox: "0 0 152 115",
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M53.028 110.948c-1.451.894-3.012 1.143-4.684.745-1.67-.397-2.954-1.321-3.85-2.774L3.257 42.017c-.868-1.408-1.1-2.966-.696-4.673.405-1.707 1.31-2.994 2.718-3.862l38.528-23.75c1.452-.894 3.013-1.143 4.684-.746 1.671.398 2.955 1.323 3.85 2.775l8.14 13.205a5.074 5.074 0 0 1 3.558-.135c1.209.386 2.133 1.097 2.772 2.134l4.038 6.55c.687 1.116.932 2.301.735 3.556-.197 1.256-.77 2.297-1.717 3.124L93.58 78.663c.895 1.453 1.145 3.014.749 4.686-.396 1.671-1.32 2.955-2.771 3.85l-38.529 23.749Zm-3.255-5.282L88.3 81.916l-41.238-66.9L8.534 38.764l41.239 66.902Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M79.517 5.103c1.523-.374 2.96-.15 4.312.673 1.35.824 2.214 2.001 2.589 3.531l3.411 13.905c1.153-.086 2.204.212 3.154.893.95.682 1.557 1.569 1.825 2.66l1.693 6.9c.288 1.175.17 2.285-.356 3.331-.526 1.046-1.32 1.798-2.382 2.255l9.937 40.513c.375 1.53.155 2.972-.662 4.327-.817 1.355-1.987 2.22-3.509 2.593L74.39 92.85a9944.25 9944.25 0 0 0 15.09-9.599l8.685-2.13-17.282-70.456-29.929 7.341-3.297-5.088 31.861-7.815ZM35.64 17.635c.834-1.384 1.99-2.258 3.466-2.62l6.342-1.556-10.661 6.714c.07-.864.354-1.71.853-2.538Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M106.396 11.2c1.203.04 2.219.506 3.048 1.395.829.89 1.223 1.94 1.183 3.15l-.365 10.996a3.58 3.58 0 0 1 2.148 1.315c.561.701.827 1.484.798 2.348l-.181 5.455c-.031.928-.349 1.725-.956 2.39a3.575 3.575 0 0 1-2.23 1.174l-1.064 32.035c-.04 1.21-.502 2.231-1.387 3.064-.886.833-1.932 1.23-3.136 1.19l-3.543-.118-1.219-4.444 4.908.163 1.85-55.714-22.19-.737-1.217-4.444 23.553.782ZM85.682 70.69l2.674 4.493-1.878-.062-2.81-4.497 2.014.067ZM73.128 49.64l-.129 3.9-4.162-6.663.139-4.187c1.353 2.262 2.742 4.59 4.152 6.95Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M96.35 11.4c.983-.535 1.979-.653 2.987-.354l27.625 8.2c1.041.31 1.821.947 2.341 1.91.52.966.625 1.97.315 3.016l-2.823 9.506a3.23 3.23 0 0 1 1.574 1.636c.329.74.383 1.482.162 2.228l-1.401 4.717c-.238.803-.697 1.425-1.377 1.867a3.22 3.22 0 0 1-2.211.515l-8.222 27.694c-.311 1.045-.947 1.83-1.908 2.354-.963.525-1.965.633-3.005.324l-5.007-1.487c.223-.073.435-.141.63-.208l.138-3.701 5.368 1.593 14.297-48.16-17.709-5.259.144-3.827c-3.569-.163-9.074-.41-13.713-.611.338-.833.937-1.484 1.795-1.952Zm1.376 55.71c.364 1.74.67 3.23.91 4.408l-1.116-.331-1.053-4.45 1.26.373Zm-15.18-.376c-.922-.332-1.624-.942-2.103-1.832-.437-.81-.581-1.647-.433-2.514l2.536 4.346ZM89.711 29.6c.569 2.635 1.15 5.333 1.732 8.036l-1.034 3.485-1.826-7.72 1.128-3.8Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M119.321 17.424c1-.242 1.913-.11 2.738.397l22.575 13.852c.85.522 1.392 1.273 1.625 2.253a3.52 3.52 0 0 1-.44 2.753l-4.766 7.767a2.97 2.97 0 0 1 1.008 1.828c.116.734-.013 1.407-.387 2.017l-2.365 3.855c-.403.655-.959 1.099-1.667 1.329a2.963 2.963 0 0 1-2.086-.069l-13.888 22.632c-.524.855-1.276 1.4-2.255 1.637-.979.237-1.894.095-2.744-.427l-10.543-6.47.157-4.18.905.555-.097 2.75 5.534 2.355.437-1.5 5.513 3.383 24.153-39.36-16.247-9.97.865-2.956-10.244-2.89c.507-.79 1.247-1.305 2.219-1.54ZM96.214 59.937l-.214.35.331.203c.373 1.762.72 3.41 1.035 4.913L96 64.563l-1.46-8.833.578-.943 1.097 5.15Zm11.916-19.421-.92 1.5.279-7.39.902-1.471-.261 7.36Z"
  })]
});
const IconCalendar = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "103",
  height: "103",
  fill: "none",
  viewBox: "0 0 103 103",
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M87.296 10.27h-10.27V5.135a5.135 5.135 0 1 0-10.27 0v5.135h-30.81V5.135a5.134 5.134 0 1 0-10.27 0v5.135h-10.27A15.405 15.405 0 0 0 0 25.675v61.62a15.405 15.405 0 0 0 15.405 15.406h71.89a15.404 15.404 0 0 0 15.406-15.405v-61.62A15.405 15.405 0 0 0 87.296 10.27Zm5.135 77.026a5.135 5.135 0 0 1-5.135 5.135h-71.89a5.135 5.135 0 0 1-5.136-5.135V51.35h82.16v35.946Zm0-46.216H10.27V25.675a5.135 5.135 0 0 1 5.134-5.135h10.27v5.135a5.135 5.135 0 0 0 10.27 0V20.54h30.81v5.135a5.135 5.135 0 1 0 10.27 0V20.54h10.27a5.135 5.135 0 0 1 5.136 5.135V41.08Z"
  })
});
const IconUser = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "72",
  height: "73",
  fill: "none",
  viewBox: "0 0 72 73",
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("circle", {
    cx: "36",
    cy: "20",
    r: "16",
    stroke: "currentColor",
    "stroke-width": "8"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    stroke: "currentColor",
    "stroke-linecap": "round",
    "stroke-width": "8",
    d: "M4.248 69A27.19 27.19 0 0 1 4 65.333C4 49.133 18.327 36 36 36c17.673 0 32 13.133 32 29.333A27.19 27.19 0 0 1 67.752 69"
  })]
});
const IconHandshake = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "89",
  height: "89",
  fill: "none",
  viewBox: "0 0 89 89",
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M85.568 30.386c5.306-5.306 2.886-11.503 0-14.516L72.834 3.136c-5.349-5.305-11.503-2.886-14.517 0l-7.216 7.258H40.107c-8.065 0-12.734 4.245-15.11 9.126L6.15 38.365v16.978l-3.014 2.97c-5.305 5.349-2.886 11.503 0 14.517L15.87 85.563c2.293 2.292 4.754 3.141 7.089 3.141 3.014 0 5.773-1.486 7.428-3.14l11.46-11.503h15.239c7.216 0 10.866-4.5 12.182-8.914 4.797-1.273 7.428-4.923 8.49-8.489 6.579-1.697 9.04-7.937 9.04-12.308V31.616h-2.504l1.274-1.23ZM78.309 44.35c0 1.91-.806 4.244-4.244 4.244H69.82v4.245c0 1.91-.806 4.244-4.245 4.244h-4.244v4.244c0 1.91-.807 4.245-4.245 4.245H38.367L24.445 79.494c-1.316 1.23-2.08.509-2.547.042L9.206 66.888c-1.23-1.316-.51-2.08-.042-2.547l5.476-5.518V41.846l8.489-8.49v6.75c0 5.135 3.395 12.733 12.734 12.733 9.338 0 12.734-7.598 12.734-12.734h29.712v4.245Zm1.231-19.992-7.216 7.258H40.107v8.49c0 1.91-.806 4.244-4.244 4.244-3.438 0-4.245-2.335-4.245-4.245V27.372c0-1.953.722-8.489 8.49-8.489h14.474l9.678-9.677c1.315-1.231 2.08-.51 2.546-.043l12.692 12.649c1.23 1.316.51 2.08.042 2.546Z"
  })
});
const IconBusiness = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  width: "73",
  height: "89",
  viewBox: "0 0 73 89",
  fill: "none",
  xmlns: "http://www.w3.org/2000/svg",
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    "fill-rule": "evenodd",
    "clip-rule": "evenodd",
    d: "M12.096 8.064C9.86919 8.064 8.06401 9.86919 8.06401 12.096V76.608C8.06401 78.8348 9.86919 80.64 12.096 80.64H60.48C62.7068 80.64 64.512 78.8348 64.512 76.608V12.096C64.512 9.86919 62.7068 8.064 60.48 8.064H12.096ZM0 12.096C0 5.41556 5.41557 0 12.096 0H60.48C67.1605 0 72.576 5.41556 72.576 12.096V76.608C72.576 83.2884 67.1605 88.704 60.48 88.704H12.096C5.41557 88.704 0 83.2884 0 76.608V12.096Z",
    fill: "currentColor"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    "fill-rule": "evenodd",
    "clip-rule": "evenodd",
    d: "M16.1289 20.1599C16.1289 17.9331 17.9341 16.1279 20.1609 16.1279H20.2012C22.4281 16.1279 24.2332 17.9331 24.2332 20.1599C24.2332 22.3867 22.4281 24.1919 20.2012 24.1919H20.1609C17.9341 24.1919 16.1289 22.3867 16.1289 20.1599ZM32.2569 20.1599C32.2569 17.9331 34.0621 16.1279 36.2889 16.1279H36.3292C38.5561 16.1279 40.3612 17.9331 40.3612 20.1599C40.3612 22.3867 38.5561 24.1919 36.3292 24.1919H36.2889C34.0621 24.1919 32.2569 22.3867 32.2569 20.1599ZM48.3849 20.1599C48.3849 17.9331 50.1901 16.1279 52.4169 16.1279H52.4572C54.6841 16.1279 56.4892 17.9331 56.4892 20.1599C56.4892 22.3867 54.6841 24.1919 52.4572 24.1919H52.4169C50.1901 24.1919 48.3849 22.3867 48.3849 20.1599ZM16.1289 36.2879C16.1289 34.0611 17.9341 32.2559 20.1609 32.2559H20.2012C22.4281 32.2559 24.2332 34.0611 24.2332 36.2879C24.2332 38.5147 22.4281 40.3199 20.2012 40.3199H20.1609C17.9341 40.3199 16.1289 38.5147 16.1289 36.2879ZM32.2569 36.2879C32.2569 34.0611 34.0621 32.2559 36.2889 32.2559H36.3292C38.5561 32.2559 40.3612 34.0611 40.3612 36.2879C40.3612 38.5147 38.5561 40.3199 36.3292 40.3199H36.2889C34.0621 40.3199 32.2569 38.5147 32.2569 36.2879ZM48.3849 36.2879C48.3849 34.0611 50.1901 32.2559 52.4169 32.2559H52.4572C54.6841 32.2559 56.4892 34.0611 56.4892 36.2879C56.4892 38.5147 54.6841 40.3199 52.4572 40.3199H52.4169C50.1901 40.3199 48.3849 38.5147 48.3849 36.2879ZM16.1289 52.4159C16.1289 50.1891 17.9341 48.3839 20.1609 48.3839H20.2012C22.4281 48.3839 24.2332 50.1891 24.2332 52.4159C24.2332 54.6427 22.4281 56.4479 20.2012 56.4479H20.1609C17.9341 56.4479 16.1289 54.6427 16.1289 52.4159ZM32.2569 52.4159C32.2569 50.1891 34.0621 48.3839 36.2889 48.3839H36.3292C38.5561 48.3839 40.3612 50.1891 40.3612 52.4159C40.3612 54.6427 38.5561 56.4479 36.3292 56.4479H36.2889C34.0621 56.4479 32.2569 54.6427 32.2569 52.4159ZM48.3849 52.4159C48.3849 50.1891 50.1901 48.3839 52.4169 48.3839H52.4572C54.6841 48.3839 56.4892 50.1891 56.4892 52.4159C56.4892 54.6427 54.6841 56.4479 52.4572 56.4479H52.4169C50.1901 56.4479 48.3849 54.6427 48.3849 52.4159ZM20.1609 68.5439C20.1609 66.3171 21.9661 64.5119 24.1929 64.5119H48.3849C50.6117 64.5119 52.4169 66.3171 52.4169 68.5439V84.6719C52.4169 86.8987 50.6117 88.7039 48.3849 88.7039C46.1581 88.7039 44.3529 86.8987 44.3529 84.6719V72.5759H28.2249V84.6719C28.2249 86.8987 26.4197 88.7039 24.1929 88.7039C21.9661 88.7039 20.1609 86.8987 20.1609 84.6719V68.5439Z",
    fill: "currentColor"
  })]
});
const IconOther = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  width: "55",
  height: "40",
  fill: "none",
  viewBox: "0 0 55 40",
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    fill: "currentColor",
    d: "M3.888 0A3.884 3.884 0 0 0 0 3.888a3.884 3.884 0 0 0 3.888 3.888h46.656a3.884 3.884 0 0 0 3.888-3.888A3.884 3.884 0 0 0 50.544 0H3.888Zm0 15.776A3.884 3.884 0 0 0 0 19.664a3.884 3.884 0 0 0 3.888 3.888h46.656a3.884 3.884 0 0 0 3.888-3.888 3.884 3.884 0 0 0-3.888-3.888H3.888Zm0 15.776A3.884 3.884 0 0 0 0 35.44a3.884 3.884 0 0 0 3.888 3.888h46.656a3.884 3.884 0 0 0 3.888-3.888 3.884 3.884 0 0 0-3.888-3.888H3.888Z"
  })
});
const MultiStepForm = () => {
  const [step, setStep] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(1);
  const [isSubmitting, setIsSubmitting] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [isAnimating, setIsAnimating] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [formData, setFormData] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)({
    handsets: "",
    contract: "",
    businessType: "",
    businessName: "",
    postcode: "",
    firstName: "",
    lastName: "",
    email: "",
    phone: ""
  });
  const totalSteps = 5;
  const handleChange = e => {
    const {
      name,
      value
    } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };
  const handleSelection = (field, value) => {
    setFormData(prev => ({
      ...prev,
      [field]: value
    }));
    if (step >= 1 && step <= 3) {
      setIsAnimating(true);
      setTimeout(() => {
        setStep(prev => Math.min(prev + 1, totalSteps));
        setIsAnimating(false);
      }, 400); // Match the fadeOut animation duration
    }
  };
  const nextStep = () => {
    if (validateStep(step)) {
      setStep(prev => Math.min(prev + 1, totalSteps));
    }
  };
  const prevStep = () => {
    setStep(prev => Math.max(prev - 1, 1));
  };
  const validateStep = currentStep => {
    if (currentStep === 1 && !formData.handsets) {
      alert("Please select an option.");
      return false;
    }
    if (currentStep === 2 && !formData.contract) {
      alert("Please select an option.");
      return false;
    }
    if (currentStep === 3 && !formData.businessType) {
      alert("Please select an option.");
      return false;
    }
    if (currentStep === 4) {
      if (!formData.businessName) {
        alert("Please enter your business name.");
        return false;
      }
      if (!formData.postcode) {
        alert("Please enter your postcode.");
        return false;
      }
    }
    return true;
  };
  const handleSubmit = async e => {
    e.preventDefault();
    if (!formData.firstName || !formData.lastName || !formData.email || !formData.phone) {
      alert("Please fill in all required fields.");
      return;
    }
    setIsSubmitting(true);
    try {
      const nonce = window.wpApiSettings?.nonce || "";
      const res = await fetch("/wp-json/bh/v1/submit-quote", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": nonce
        },
        body: JSON.stringify(formData)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Something went wrong. Please try again.");
        console.error("Submission Error:", data);
      }
    } catch (error) {
      console.error("Network Error:", error);
      alert("An error occurred. Please check your connection and try again.");
    } finally {
      setIsSubmitting(false);
    }
  };
  const SelectionCard = ({
    field,
    value,
    label,
    Icon,
    labelClassName,
    iconClassName
  }) => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    onClick: () => handleSelection(field, value),
    className: `cursor-pointer rounded-[15px] border-2 p-4 lg:p-[30px] flex flex-col items-center text-center transition-all duration-200 min-h-[160px] lg:min-h-[265px] shadow-[0px_4px_19px_-1px_rgba(0,0,0,0.2)] group
        ${formData[field] === value ? "border-[#359327] bg-[#359327] text-white" : "border-[#D9D9D9] bg-white hover:border-[#359327] hover:bg-[#359327] hover:text-white text-[#92D93E]"}`,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "flex-1 flex justify-center items-center w-full",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: `${iconClassName}`,
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Icon, {
          className: "w-full h-full"
        })
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: `font-bold mt-4 ${labelClassName} ${formData[field] === value ? "text-white" : "text-[#359327] group-hover:text-white"}`,
      children: label
    })]
  });
  const ProgressBar = () => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    className: "w-full max-w-[712px] mx-auto mb-8.5",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "text-center text-yellow font-extrabold uppercase text-sm lg:text-xl tracking-wider lg:mb-[27px] mb-[21px] ",
      children: step === 5 ? "AND FINALLY" : step === 4 ? "VERY CLOSE NOW..." : step === 3 ? "YOU'RE NEARLY THERE" : "IT TAKES 1 MINUTE TO COMPLETE"
    }, step), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "h-[18px] bg-[#F4F6F2] rounded-full overflow-hidden",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: "h-full bg-[#92D93E]",
        style: {
          width: `${step / totalSteps * 100}%`,
          transition: "width 0.8s cubic-bezier(0.4, 0, 0.2, 1)"
        }
      })
    })]
  });
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
    className: "bg-[#F7F9F6] flex justify-center items-center w-full 2xl:rounded-[18px] lg:max-w-[1434px] mx-auto min-h-[760px] lg:min-h-[735px] px-[25px] lg:mt-[61px] lg:mb-[90px] mt-[60px] mb-[27px]",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      className: "max-w-[1236px] mx-auto w-full",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(ProgressBar, {}), step === 1 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: isAnimating ? "animate-fade-out" : "animate-fade-in",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          className: "text-[28px] lg:text-[34px] xl:text-[40px] leading-[36px] lg:leading-tight font-extrabold text-[#359327] text-center mb-[17px] lg:mb-5",
          children: "How many handsets or SIMs do you require?"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: "text-center text-dark font-semibold mb-[37px] lg:mb-[68px]",
          children: "Please select below"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-2 md:grid-cols-4 gap-[26px] lg:gap-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "handsets",
            value: "1-2",
            label: "1 - 2",
            Icon: IconMobileOne,
            labelClassName: "text-[24px] lg:text-[40px]",
            iconClassName: "h-[55px] lg:h-[80px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "handsets",
            value: "3-4",
            label: "3 - 4",
            Icon: IconMobileTwo,
            labelClassName: "text-[24px] lg:text-[40px]",
            iconClassName: "h-[55px] lg:h-[80px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "handsets",
            value: "5-9",
            label: "5 - 9",
            Icon: IconMobileThree,
            labelClassName: "text-[24px] lg:text-[40px]",
            iconClassName: "h-[55px] lg:h-[80px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "handsets",
            value: "10+",
            label: "10+",
            Icon: IconMobileFour,
            labelClassName: "text-[24px] lg:text-[40px]",
            iconClassName: "h-[55px] lg:h-[80px]"
          })]
        })]
      }), step === 2 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: isAnimating ? "animate-fade-out" : "animate-fade-in",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          className: "text-[28px] lg:text-[34px] xl:text-[40px] leading-[36px] lg:leading-tight font-extrabold text-[#359327] text-center mb-[17px] lg:mb-5",
          children: "When does your current contract expire?"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: "text-center text-dark font-semibold mb-[37px] lg:mb-[68px]",
          children: "Please select below"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-2 md:grid-cols-4 gap-[26px] lg:gap-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "contract",
            value: "Out of contract",
            label: "Out of contract",
            Icon: IconCalendar,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[35px] w-[35px] lg:h-[64px] lg:w-[64px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "contract",
            value: "Under 3 months",
            label: "Under 3 months",
            Icon: IconCalendar,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[35px] w-[35px] lg:h-[64px] lg:w-[64px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "contract",
            value: "3 months +",
            label: "3 months +",
            Icon: IconCalendar,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[35px] w-[35px] lg:h-[64px] lg:w-[64px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "contract",
            value: "Not sure",
            label: "Not sure",
            Icon: IconCalendar,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[35px] w-[35px] lg:h-[64px] lg:w-[64px]"
          })]
        })]
      }), step === 3 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: isAnimating ? "animate-fade-out" : "animate-fade-in",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          className: "text-[28px] lg:text-[34px] xl:text-[40px] leading-[36px] lg:leading-tight font-extrabold text-[#359327] text-center mb-[17px] lg:mb-5",
          children: "What type of business are you?"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: "text-center text-dark font-semibold mb-[37px] lg:mb-[68px]",
          children: "Please select below"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-2 md:grid-cols-4 gap-[26px] lg:gap-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "businessType",
            value: "Sole trader",
            label: "Sole trader",
            Icon: IconUser,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[40px] w-[40px] lg:h-[70px] lg:w-[70px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "businessType",
            value: "Partnership",
            label: "Partnership",
            Icon: IconHandshake,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[40px] w-[40px] lg:h-[70px] lg:w-[70px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "businessType",
            value: "LTD company",
            label: "LTD company",
            Icon: IconBusiness,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[40px] w-[40px] lg:h-[70px] lg:w-[70px]"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SelectionCard, {
            field: "businessType",
            value: "Other",
            label: "Other",
            Icon: IconOther,
            labelClassName: "text-base lg:text-[22px]",
            iconClassName: "h-[40px] w-[40px] lg:h-[70px] lg:w-[70px]"
          })]
        })]
      }), step === 4 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `${isAnimating ? "animate-fade-out" : "animate-fade-in"} max-w-[947px] mx-auto`,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          className: "text-[28px] lg:text-[34px] xl:text-[40px] leading-[36px] lg:leading-tight font-extrabold text-[#359327] text-center mb-[47px] lg:mb-[73px]",
          children: "Tell us about your business"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "Your business name *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "text",
              name: "businessName",
              value: formData.businessName,
              onChange: handleChange,
              placeholder: "Your business name",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "Enter your postcode *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "text",
              name: "postcode",
              value: formData.postcode,
              onChange: handleChange,
              placeholder: "Postcode (so we can find the best supplier)",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          })]
        })]
      }), step === 5 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `${isAnimating ? "animate-fade-out" : "animate-fade-in"} max-w-[947px] mx-auto`,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          className: "text-[28px] lg:text-[34px] xl:text-[40px] leading-[36px] lg:leading-tight font-extrabold text-[#359327] text-center mb-[47px] lg:mb-[73px]",
          children: "Tell us about you"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "First name *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "text",
              name: "firstName",
              value: formData.firstName,
              onChange: handleChange,
              placeholder: "First name",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "Last name *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "text",
              name: "lastName",
              value: formData.lastName,
              onChange: handleChange,
              placeholder: "Last name",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "Business email *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "email",
              name: "email",
              value: formData.email,
              onChange: handleChange,
              placeholder: "Business email",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
              className: "block text-primary text-base lg:text-xl font-extrabold mb-2 lg:mb-[14px]",
              children: "Contact number *"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
              type: "tel",
              name: "phone",
              value: formData.phone,
              onChange: handleChange,
              placeholder: "Contact number",
              className: "w-full px-4 py-3 rounded-xl border-[2px] border-[#D9D9D9] focus:border-[#359327] focus:ring-2 focus:ring-[#359327] outline-none bg-[#FCFCFC] placeholder:text-[#D9D9D9] font-extrabold text-dark"
            })]
          })]
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: "mt-10 flex justify-center gap-4",
        children: step >= 4 && step < 5 ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("button", {
          onClick: nextStep,
          className: "bg-[#ffdc46] text-[#002115] font-extrabold py-3 px-12 rounded-full hover:bg-[#f0cd35] transition-colors shadow-md cursor-pointer",
          children: "Next"
        }) : step === 5 ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("button", {
          onClick: handleSubmit,
          disabled: isSubmitting,
          className: "bg-[#ffdc46] text-[#002115] font-extrabold py-3 px-12 rounded-full hover:bg-[#f0cd35] transition-colors shadow-md disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer",
          children: isSubmitting ? "Sending..." : "Submit"
        }) : null
      }), step === 1 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
        className: "text-center text-[#92D93E] font-extrabold mt-[6px] lg:mt-[20px] lg:text-xl",
        children: "Get free no obligation quotes in minutes."
      }), step === 2 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
        className: "text-center text-[#92D93E] font-extrabold mt-[6px] lg:mt-[20px] lg:text-xl",
        children: "We compare all major UK networks so you don't have to."
      }), step === 3 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
        className: "text-center text-[#92D93E] font-extrabold mt-[6px] lg:mt-[20px] lg:text-xl",
        children: "We have helped thousands of businesses find the best solution"
      })]
    })
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MultiStepForm);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "react-dom":
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
/***/ ((module) => {

module.exports = window["ReactDOM"];

/***/ }),

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["ReactJSXRuntime"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var lenis__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! lenis */ "./node_modules/lenis/dist/lenis.mjs");
/* harmony import */ var _scripts_MultiStepForm__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/MultiStepForm */ "./src/scripts/MultiStepForm.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__);





const lenis = new lenis__WEBPACK_IMPORTED_MODULE_2__["default"]({
  autoRaf: true
});

// Optional: Log to verify it's running
console.log("Lenis initialized");

// Handle anchor links for smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
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
document.querySelectorAll('a[href*="#"]').forEach(anchor => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    const url = new URL(href, window.location.origin);

    // If same pathname and has hash
    if (url.pathname === window.location.pathname && url.hash && url.hash !== "#") {
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
  const root = react_dom_client__WEBPACK_IMPORTED_MODULE_1__.createRoot(document.querySelector("#multi-step-quote-form"));
  root.render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_scripts_MultiStepForm__WEBPACK_IMPORTED_MODULE_3__["default"], {}));
}
})();

/******/ })()
;
//# sourceMappingURL=index.js.map