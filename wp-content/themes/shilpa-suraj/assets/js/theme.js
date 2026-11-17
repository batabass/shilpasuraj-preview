document.addEventListener('DOMContentLoaded', function () {
  var desktop = window.matchMedia('(min-width: 981px)');
  function syncViewport() {
    document.body.classList.toggle('is-desktop', desktop.matches);
    document.body.classList.toggle('is-mobile', !desktop.matches);
    if (desktop.matches) {
      var open = document.querySelector('.mobile_nav.opened');
      if (open) {
        open.classList.remove('opened');
        open.classList.add('closed');
      }
    }
  }
  syncViewport();
  if (desktop.addEventListener) {
    desktop.addEventListener('change', syncViewport);
  }

  var nav = document.getElementById('top-menu');
  var mobileWrap = document.querySelector('.mobile_nav');
  if (nav && mobileWrap && !document.getElementById('mobile_menu')) {
    var clone = nav.cloneNode(true);
    clone.id = 'mobile_menu';
    clone.className = 'et_mobile_menu';
    mobileWrap.appendChild(clone);
  }

  var toggle = document.querySelector('.mobile_nav');
  if (!toggle) return;
  toggle.addEventListener('click', function (e) {
    if (e.target.closest('#mobile_menu a')) return;
    e.preventDefault();
    var opening = !toggle.classList.contains('opened');
    toggle.classList.toggle('opened', opening);
    toggle.classList.toggle('closed', !opening);
    document.body.classList.toggle('ss-mobile-open', opening);
    document.body.style.overflow = opening ? 'hidden' : '';
  });
});
