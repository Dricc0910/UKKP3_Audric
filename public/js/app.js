(function () {
  // Toast hilang otomatis
  var toast = document.querySelector('[data-toast]');
  if (toast) {
    setTimeout(function () { toast.classList.add('is-hide'); }, 3800);
    setTimeout(function () { toast.remove(); }, 4300);
  }

  // Konfirmasi sebelum hapus
  document.addEventListener('submit', function (e) {
    var form = e.target.closest('form[data-confirm]');
    if (form && !window.confirm(form.getAttribute('data-confirm'))) e.preventDefault();
  });

  // Nama file pada kotak upload
  var input = document.getElementById('lampiran');
  if (input) {
    var label = input.closest('.dropzone');
    var nameEl = label.querySelector('[data-file-name]');
    var size = function (b) { return b > 1048576 ? (b / 1048576).toFixed(1) + ' MB' : Math.ceil(b / 1024) + ' KB'; };
    input.addEventListener('change', function () {
      var f = input.files && input.files[0];
      nameEl.textContent = f ? f.name + ' (' + size(f.size) + ')' : '';
    });
    ['dragenter', 'dragover'].forEach(function (ev) {
      label.addEventListener(ev, function () { label.classList.add('is-drag'); });
    });
    ['dragleave', 'drop'].forEach(function (ev) {
      label.addEventListener(ev, function () { label.classList.remove('is-drag'); });
    });
  }
})();