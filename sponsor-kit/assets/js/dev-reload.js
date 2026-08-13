(function () {
  "use strict";
  if (location.hostname !== "localhost" && location.hostname !== "127.0.0.1") return;

  var watched = [location.pathname];
  document.querySelectorAll('link[rel="stylesheet"][href], script[src]').forEach(function (el) {
    var url = el.href || el.src;
    if (url) watched.push(new URL(url).pathname);
  });
  watched = watched.filter(function (v, i, a) { return a.indexOf(v) === i; });

  var baseline = {};

  function stamp(url) {
    return fetch(url, { method: "HEAD", cache: "no-store" }).then(function (res) {
      return res.headers.get("last-modified") || res.headers.get("etag") || res.headers.get("content-length");
    }).catch(function () { return null; });
  }

  function init() {
    Promise.all(watched.map(stamp)).then(function (stamps) {
      watched.forEach(function (url, i) { baseline[url] = stamps[i]; });
      poll();
    });
  }

  function poll() {
    setTimeout(function () {
      Promise.all(watched.map(stamp)).then(function (stamps) {
        var changed = watched.some(function (url, i) {
          return stamps[i] !== null && baseline[url] !== null && stamps[i] !== baseline[url];
        });
        if (changed) {
          location.reload();
        } else {
          poll();
        }
      });
    }, 1000);
  }

  init();
})();
