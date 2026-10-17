# NAB Portfolio

Custom WordPress theme — website pribadi & portfolio: one-pager plus halaman case study terstruktur (Problem → Approach → Solution → Result). Spesifikasi lengkap: `docs/PRD.md`.

## Struktur

- Classic PHP theme — Node hanya untuk development
- `inc/` — setup & enqueue, CPT + meta boxes, Customizer, template tags
- `template-parts/` — section one-pager + contact (dipakai di footer)
- `src/input.css` → dicompile ke `assets/css/tailwind.css` (minified, committed)

## Development (butuh Node)

	npm install
	npm run build     # minify → assets/css/tailwind.css
	npm run watch
	npm run vendor    # salin anime.js UMD dari node_modules → assets/js/vendor/

Deploy produksi = upload folder tema + aktivasi — tidak butuh Node di server.

## Animasi

Motion memakai **anime.js v4** (di-vendor di `assets/js/vendor/anime.min.js`, di-commit) + IntersectionObserver. State gating ada di `<html class="motion-ready">` (diset pre-paint) dengan fallback `motion-failed` bila JS gagal load atau `prefers-reduced-motion` aktif.

## Pengelolaan konten (WP Admin)

- **Appearance → Customize** — Hero, About, Contact (email, social, resume URL), Analytics (GA4 ID), Branding
- **Case Studies** — CPT publik dengan meta box terstruktur; 3 mockup di-seed otomatis saat aktivasi tema (hapus/ganti kapan saja via WP Admin)
- **Career / Kemampuan** — urut via page attributes (kolom Order)
- **Client Quotes** — section testimonial muncul otomatis saat ada ≥ 1 quote published

## Catatan build

Semua styling diedit via class Tailwind di template + token di `src/input.css` → `npm run build` → commit hasil build bersama perubahan.
