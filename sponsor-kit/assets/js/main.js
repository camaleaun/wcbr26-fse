(function () {
  "use strict";

  var slides = Array.prototype.slice.call(document.querySelectorAll(".slide"));
  var total = slides.length;
  if (!total) return;

  var prevBtn = document.querySelector("[data-nav-prev]");
  var nextBtn = document.querySelector("[data-nav-next]");
  var fill = document.querySelector("[data-nav-fill]");
  var countEl = document.querySelector("[data-nav-count]");
  var titleEl = document.querySelector("[data-nav-title]");

  var current = 0;

  function update(index) {
    current = index;
    var slide = slides[index];
    if (fill) fill.style.width = ((index + 1) / total * 100) + "%";
    if (countEl) countEl.textContent = (index + 1) + " / " + total;
    if (titleEl) titleEl.textContent = slide.getAttribute("data-title") || "";
    if (prevBtn) prevBtn.disabled = index === 0;
    if (nextBtn) nextBtn.disabled = index === total - 1;
    slides.forEach(function (s, i) { s.setAttribute("aria-current", i === index ? "true" : "false"); });
  }

  function goTo(index) {
    index = Math.max(0, Math.min(total - 1, index));
    slides[index].scrollIntoView({ behavior: "smooth", block: "start" });
  }

  if (prevBtn) prevBtn.addEventListener("click", function () { goTo(current - 1); });
  if (nextBtn) nextBtn.addEventListener("click", function () { goTo(current + 1); });

  document.addEventListener("keydown", function (e) {
    var tag = (document.activeElement && document.activeElement.tagName) || "";
    if (tag === "INPUT" || tag === "TEXTAREA") return;
    if (e.key === "ArrowRight" || e.key === "PageDown") { e.preventDefault(); goTo(current + 1); }
    if (e.key === "ArrowLeft" || e.key === "PageUp") { e.preventDefault(); goTo(current - 1); }
  });

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var idx = slides.indexOf(entry.target);
        if (idx !== -1) update(idx);
      }
    });
  }, { threshold: 0, rootMargin: "-45% 0px -45% 0px" });
  slides.forEach(function (s) { io.observe(s); });

  update(0);

  // ---------- Tela cheia ----------
  var fsBtn = document.querySelector("[data-fullscreen-btn]");
  var fsEl = document.documentElement;
  function fsElement() {
    return document.fullscreenElement || document.webkitFullscreenElement || null;
  }
  function isFs() { return !!fsElement(); }
  function requestFs(el) {
    var fn = el.requestFullscreen || el.webkitRequestFullscreen;
    if (fn) fn.call(el);
  }
  function exitFs() {
    var fn = document.exitFullscreen || document.webkitExitFullscreen;
    if (fn) fn.call(document);
  }
  function updateFsBtn() {
    if (!fsBtn) return;
    var active = isFs();
    fsBtn.querySelector(".icon-expand").hidden = active;
    fsBtn.querySelector(".icon-collapse").hidden = !active;
    fsBtn.setAttribute("aria-label", active ? "Sair da tela cheia" : "Ver em tela cheia");
    fsBtn.title = active ? "Sair da tela cheia" : "Tela cheia";
  }
  if (fsBtn) {
    fsBtn.addEventListener("click", function () {
      if (isFs()) exitFs(); else requestFs(fsEl);
    });
    document.addEventListener("fullscreenchange", updateFsBtn);
    document.addEventListener("webkitfullscreenchange", updateFsBtn);
    updateFsBtn();
  }
})();
