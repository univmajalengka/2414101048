// ===== menu =====
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
menuBtn?.addEventListener('click', () => mobileMenu?.classList.toggle('hidden'));
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', () => mobileMenu && mobileMenu.classList.add('hidden'));
});

// ===== pricelist =====
(() => {
  const btns = document.querySelectorAll('.tab-btn');
  const panels = document.querySelectorAll('.tab-panel');
  if (!btns.length) return;

  const setActive = id => {
    panels.forEach(p => p.classList.toggle('hidden', p.id !== id));
    btns.forEach(b => {
      const on = b.getAttribute('data-tab') === id;
      b.classList.toggle('bg-pink-500', on);
      b.classList.toggle('text-white', on);
      b.classList.toggle('shadow', on);
      b.classList.toggle('bg-pink-50', !on);
      b.classList.toggle('text-pink-600', !on);
    });
  };

  btns.forEach((b, idx) => {
    if (!idx) setActive(b.getAttribute('data-tab'));
    b.addEventListener('click', () => setActive(b.getAttribute('data-tab')));
  });
})();
