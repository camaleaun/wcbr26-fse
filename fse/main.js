/* Menu offcanvas (drawer lateral) — acessível, sem dependências */
(function () {
  "use strict";
  var toggle = document.querySelector(".nav-toggle");
  var drawer = document.getElementById("mobile-drawer");
  var backdrop = document.querySelector(".drawer-backdrop");
  if (!toggle || !drawer || !backdrop) return;

  var lastFocus = null;

  function setOpen(open) {
    toggle.setAttribute("aria-expanded", String(open));
    backdrop.hidden = false;
    if (open) {
      drawer.removeAttribute("inert");
      void drawer.offsetWidth; // força reflow antes do slide
    } else {
      drawer.setAttribute("inert", "");
    }
    drawer.classList.toggle("is-open", open);
    backdrop.classList.toggle("is-open", open);
    document.body.classList.toggle("no-scroll", open);
    toggle.querySelector(".sr-only").textContent = open ? "Fechar menu" : "Abrir menu";

    if (open) {
      lastFocus = document.activeElement;
      var first = drawer.querySelector(".drawer__close");
      if (first) first.focus();
    } else if (lastFocus) {
      lastFocus.focus();
    }
  }

  toggle.addEventListener("click", function () {
    setOpen(toggle.getAttribute("aria-expanded") !== "true");
  });

  document.querySelectorAll("[data-drawer-close]").forEach(function (el) {
    el.addEventListener("click", function () { setOpen(false); });
  });
  drawer.addEventListener("click", function (e) {
    if (e.target.closest("a")) setOpen(false);
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && toggle.getAttribute("aria-expanded") === "true") setOpen(false);
  });

  drawer.addEventListener("keydown", function (e) {
    if (e.key !== "Tab") return;
    var focusables = drawer.querySelectorAll('a[href], button:not([disabled])');
    if (!focusables.length) return;
    var first = focusables[0], last = focusables[focusables.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  });

  var mq = window.matchMedia("(min-width: 900px)");
  (mq.addEventListener ? mq.addEventListener.bind(mq, "change") : mq.addListener.bind(mq))(function () {
    if (mq.matches) setOpen(false);
  });
})();

/* Acordeon dos formatos — colapsável no mobile, sempre aberto no desktop */
(function () {
  var heads = document.querySelectorAll(".format-head");
  if (!heads.length) return;
  var mq = window.matchMedia("(min-width: 640px)");

  function sync() {
    if (mq.matches) {
      heads.forEach(function (h) { h.setAttribute("aria-expanded", "true"); });
    } else {
      heads.forEach(function (h) { h.setAttribute("aria-expanded", "false"); });
    }
  }

  heads.forEach(function (h) {
    h.addEventListener("click", function () {
      if (mq.matches) return;
      var open = h.getAttribute("aria-expanded") === "true";
      h.setAttribute("aria-expanded", String(!open));
    });
  });

  (mq.addEventListener ? mq.addEventListener.bind(mq, "change") : mq.addListener.bind(mq))(sync);
  sync();
})();

/* Submenus do drawer (Evento, Chamadas) */
(function () {
  var toggles = document.querySelectorAll(".drawer__toggle");
  if (!toggles.length) return;
  toggles.forEach(function (t) {
    t.addEventListener("click", function () {
      var open = t.getAttribute("aria-expanded") === "true";
      t.setAttribute("aria-expanded", String(!open));
    });
  });
})();
