(function () {
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Angka statistik naik dari 0 */
  document.querySelectorAll('[data-count]').forEach(function (el) {
    var num = parseFloat((el.getAttribute('data-count') || '0').replace(/[^\d.-]/g, '')) || 0;
    if (reduce || num === 0) return;
    var prefix = el.getAttribute('data-prefix') || '', full = el.textContent, start = null;
    function fmt(n) { return prefix + Math.round(n).toLocaleString('id-ID'); }
    el.textContent = fmt(0);
    function tick(t) {
      if (!start) start = t;
      var p = Math.min((t - start) / 1100, 1);
      el.textContent = fmt(num * (1 - Math.pow(1 - p, 3)));
      if (p < 1) requestAnimationFrame(tick); else el.textContent = full;
    }
    setTimeout(function () { requestAnimationFrame(tick); }, 250);
  });

  /* Penanda menu yang bergeser mengikuti kursor */
  var nav = document.querySelector('nav'), ind = nav && nav.querySelector('.nav-indicator');
  if (ind) {
    var cur = nav.querySelector('a.active');
    document.documentElement.classList.add('nav-js');
    var mv = function (a) {
      if (!a) { ind.style.opacity = '0'; return; }
      ind.style.opacity = '1';
      ind.style.left = a.offsetLeft + 'px'; ind.style.top = a.offsetTop + 'px';
      ind.style.width = a.offsetWidth + 'px'; ind.style.height = a.offsetHeight + 'px';
    };
    mv(cur);
    requestAnimationFrame(function () { requestAnimationFrame(function () { ind.classList.add('ready'); }); });
    nav.querySelectorAll('a').forEach(function (a) { a.addEventListener('mouseenter', function () { mv(a); }); });
    nav.addEventListener('mouseleave', function () { mv(cur); });
    window.addEventListener('resize', function () { mv(cur); });
    window.addEventListener('load', function () { mv(cur); });
  }

  /* Baris tabel muncul bertahap */
  document.querySelectorAll('table tbody').forEach(function (tb) {
    Array.prototype.forEach.call(tb.children, function (tr, i) { tr.style.animationDelay = (Math.min(i, 12) * 35) + 'ms'; });
  });
  /* Pratinjau foto profil */
  document.querySelectorAll('.photo-pick input[type=file]').forEach(function (inp) {
    inp.addEventListener('change', function () {
      var f = inp.files[0], pv = inp.closest('.photo-pick').querySelector('.photo-preview');
      if (!f || !pv) return;
      pv.style.backgroundImage = 'url(' + URL.createObjectURL(f) + ')';
      pv.classList.add('has');
    });
  });
})();

/* Tambah baris barang pada form invoice */
function addItem() {
  var div = document.createElement('div');
  div.className = 'item fields';
  div.innerHTML =
    '<input name="item_name[]" placeholder="Nama barang/jasa" required>' +
    '<input name="qty[]" type="number" step="0.01" min="0.01" value="1" placeholder="Qty">' +
    '<input name="price[]" type="number" min="0" step="0.01" placeholder="Harga satuan" required>' +
    '<button type="button" class="danger" onclick="this.parentElement.remove()">Hapus</button>';
  document.getElementById('items').appendChild(div);
}