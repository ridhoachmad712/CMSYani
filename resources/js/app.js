import './bootstrap';

// Tandai bahwa JS aktif. Efek reveal hanya berlaku saat class .js ada,
// sehingga tanpa JS konten tetap tampil (aksesibilitas & SEO aman).
document.documentElement.classList.add('js');

// Fade-in ringan saat elemen masuk viewport (tanpa library tambahan).
function initReveal() {
    const items = document.querySelectorAll('.reveal');
    if (! items.length) return;

    // Hormati preferensi pengguna yang mengurangi gerakan.
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    if (! ('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    items.forEach((el) => observer.observe(el));

    // Safety-net: pastikan konten TIDAK PERNAH tersangkut tersembunyi jika
    // observer gagal fire (mis. tab tak ter-render). Reveal off-screen tidak
    // terlihat pengguna, jadi tidak merusak efek animasi.
    const revealAll = () => items.forEach((el) => el.classList.add('is-visible'));
    window.addEventListener('load', () => setTimeout(revealAll, 2000));
}

if (document.readyState !== 'loading') {
    initReveal();
} else {
    document.addEventListener('DOMContentLoaded', initReveal);
}
