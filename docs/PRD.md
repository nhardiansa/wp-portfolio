# Product Requirements Document — NAB Portfolio

## Informasi Dokumen

| Field | Value |
|---|---|
| **Product** | Tema WordPress custom `nab-portfolio` — website pribadi & portfolio |
| **Status** | Approved v1.0 |
| **Author / Owner** | Nabil Hardiansa |
| **Tanggal dibuat** | 2026-10-17 |
| **Versi** | 1.0 — final, hasil review + keputusan open questions (lihat Decision Log) |
| **Dev environment** | LocalWP (`wordpress/app/public/`), WP ≥ 6.0, PHP ≥ 8.0 |
| **Target produksi** | Shared hosting (tersedia) — tanpa Node di server |

---

## Daftar Isi

1. [Executive Summary](#1-executive-summary)
2. [Problem Statement](#2-problem-statement)
3. [Goals & Objectives](#3-goals--objectives)
4. [User Personas](#4-user-personas)
5. [User Stories & Requirements](#5-user-stories--requirements)
6. [Success Metrics](#6-success-metrics)
7. [Scope](#7-scope)
8. [Technical Considerations](#8-technical-considerations)
9. [Design & UX Requirements](#9-design--ux-requirements)
10. [Timeline & Milestones](#10-timeline--milestones)
11. [Risks & Mitigation](#11-risks--mitigation)
12. [Dependencies & Assumptions](#12-dependencies--assumptions)
13. [Keputusan Final — Decision Log](#13-keputusan-final--decision-log)
14. [Sign-off](#14-sign-off)

---

## 1. Executive Summary

**One-liner:** Website pribadi + portfolio hybrid — satu halaman utama (one-pager) plus halaman case study mendalam per project — yang memposisikan Nabil sebagai **fullstack web developer & problem solver** untuk memenangkan proyek freelance.

**Overview:** Website ini adalah alat utama konversi untuk aktivitas freelance. Klien freelance memutuskan berdasarkan bukti *cara berpikir* dan *hasil*, bukan daftar tech stack — karena itu format showcase intinya adalah **case study naratif terstruktur (Problem → Approach → Solution → Result)**, bukan galeri biasa. Struktur hybrid memberi dua jalur baca: skim cepat lewat one-pager (dipahami < 30 detik) dan jalur mendalam lewat halaman case study untuk calon klien yang sedang mengevaluasi.

**Prinsip meta:** website ini sendiri adalah proof-of-work. Kualitas teknis tema — performa, semantik, aksesibilitas — harus konsisten dengan klaim "problem solver". Kelalaian teknis di website sendiri akan membantah positioning.

**Quick Facts:**

- **Target utama:** klien freelance potensial (owner bisnis / startup / agency)
- **Problem solved:** belum ada ruang membuktikan proses problem-solving di portofolio lama (nab-custom)
- **Key metric:** inquiry klien valid per bulan via email CTA
- **Launch:** per fase (iterative, tanpa deadline keras) — versi web selesai dengan mockup realistis; project nyata diisi belakangan via WP Admin

---

## 2. Problem Statement

### Problem

Tema sebelumnya (`nab-custom`) menampilkan project sebagai galeri one-pager: judul + gambar + link eksternal. Tidak ada halaman detail, tidak ada narasi proses, tidak ada hasil terukur. Positioning "problem solver" hanya bisa menjadi slogan — tidak bisa dibuktikan di dalam website.

### Current State

Calon klien freelance menilai dari bukti cara berpikir dan hasil. Portofolio berbentuk daftar kemampuan tidak memberikan bukti itu, sehingga keputusan hire jatuh ke kompetitor yang menampilkan proses berpikirnya.

### Impact

**User impact:**

- Calon klien tidak punya cukup bukti untuk menghubungi; butuh usaha ekstra (chat/meeting) untuk meyakinkan

**Business impact:**

- Konversi inquiry rendah; positioning tidak terdiferensiasi dari developer lain

### Why Now

Fokus saat ini adalah membangun jalur freelance — website adalah aset konversi pertama yang harus siap sebelum mulai aktif mencari klien.

---

## 3. Goals & Objectives

### Business Goals

1. **Mendongkrak inquiry freelance** — website menjadi sumber klien aktif, bukan kartu nama digital.
2. **Positioning "problem solver" terasa nyata** — dibuktikan lewat format case study terstruktur, bukan slogan di hero.
3. **Mudah dikelola sendiri** — semua konten dikelola via WP Admin (CPT + Customizer); menambah project, testimonial, resume link, analytics ID = tanpa coding, tanpa build ulang.

### User Goals

1. Calon klien memahami positioning & layanan dalam **< 30 detik**.
2. Calon klien bisa membaca bukti (case study) lalu menghubungi dalam sesedikit mungkin langkah.
3. Nabil mempublikasikan case study baru seperti mengisi formulir terstruktur.

### Non-Goals (eksplisit)

- Bilingual / English — future, setelah versi Indonesia tuntas
- Contact form / WhatsApp / booking — kontak = email + social links saja
- Blog, CMS multi-user, e-commerce, dark/light toggle
- Interaksi berat fase-2 (marquee, custom cursor) — future
- Technical SEO penuh — hanya SEO dasar

---

## 4. User Personas

### Persona 1 — Klien Freelance Potensial (primary)

- **Role:** owner bisnis / startup / agency yang butuh developer freelance
- **Tech savviness:** medium
- **Perilaku:** skim 30-60 detik dari hero, lalu buka 1-2 project; putuskan dari bukti proses & hasil
- **Kebutuhan:** bukti cara berpikir, layanan jelas, kontak sekali klik
- **Pain:** kebanyakan portofolio hanya jargon tech; sulit menilai kemampuan nyata
- **Quote:** _"Saya tidak menyewa tech stack. Saya menyewa orang yang bisa memecahkan masalah saya."_

### Persona 2 — Recruiter / Hiring Manager (secondary)

- Untuk jalur full-time di masa depan; kebutuhan mirip (bukti + resume)
- Desain tidak boleh menghalangi arah ini — resume download disiapkan

### Persona 3 — Nabil (owner / editor)

- Mengelola konten 100% via WP Admin: Customizer (hero, about, kontak, sosial, resume, analytics) + CPT terstruktur
- Tidak boleh perlu build ulang untuk konten

---

## 5. User Stories & Requirements

### Epic A — One-Pager Utama

#### A1. Hero positioning (P0)

**User story:** As a pengunjung, I want langsung membaca positioning "fullstack developer & problem solver" + tagline, So that dalam < 5 detik saya tahu siapa dia dan apa nilai jualnya.

**Acceptance Criteria:**

- [ ] Headline memuat posisi + positioning problem solver; terbaca jelas di mobile 320px
- [ ] CTA email terlihat tanpa scroll (above the fold) di desktop
- [ ] Semua teks hero editable via Customizer, dengan fallback mockup

#### A2. Selected Works → case study (P0)

**User story:** As a calon klien, I want melihat daftar project yang masing-masing bisa dibuka sebagai cerita Problem → Result, So that saya bisa menilai kualitas berpikirnya.

**Acceptance Criteria:**

- [ ] Kartu project menampilkan: judul, cover, ringkasan masalah 1 baris, tech stack
- [ ] Klik kartu membuka halaman case study (single `case_study`)
- [ ] Kartu punya hover state dasar yang jelas

#### A3. About / Story (P0)

Bio (konten sudah siap), foto, dan angle "bagaimana saya mendekati masalah". Editable via Customizer + fallback mockup.

#### A4. Experience & Skills (P0)

Timeline pengalaman (`career`) + stack (`stack_item`) — urut via page-attributes. Fallback mockup.

#### A5. Footer kontak email + social (P0)

**User story:** As a calon klien yang sudah yakin, I want tombol email dan link sosial yang jelas, So that saya bisa menghubungi dalam satu klik.

**Acceptance Criteria:**

- [ ] Email CTA di footer + minimal satu anchor CTA di tengah halaman
- [ ] Social links editable via Customizer
- [ ] `mailto:` dengan subject pre-filled profesional

### Epic B — Halaman Case Study (inti positioning)

#### B1. CPT `case_study` terstruktur (P0)

**User story:** As a Nabil, I want mengisi case study melalui field terstruktur (Problem / Approach / Solution / Result), So that setiap case study konsisten berkualitas dan prosesnya seperti mengisi formulir.

**Acceptance Criteria:**

- [ ] CPT `case_study`: public, publicly_queryable, rewrite `case-study`, supports title + thumbnail
- [ ] Section konten (wp_editor di meta box): Problem, Approach, Solution, Result — masing-masing rich text
- [ ] Side meta: Role, Client/Context, Period, Tech Stack, External URL (opsional)
- [ ] Galeri gambar opsional di dalam section (via editor)
- [ ] Admin UI native WP (meta box + nonce), tanpa dependensi plugin

#### B2. Template single case study (P0)

**Acceptance Criteria:**

- [ ] Struktur halaman: hero (judul + meta + cover) → Problem → Approach → Solution → Result → CTA kontak
- [ ] Navigasi prev/next project di akhir halaman
- [ ] Section Result mendorong menampilkan dampak terukur (angka/metrik) bila tersedia
- [ ] Tipografi nyaman baca panjang (max-width konten teks) + responsive

### Epic C — CMS & Editing (P0)

- **C1.** Customizer: Hero, About, Contact (email + social), Resume URL, GA4 Tracking ID, Branding — semua dengan fallback mockup
- **C2.** Aktivasi tema langsung tampil utuh dengan mockup (zero-content state tetap presentable)

### Epic D — Motion inti (P0)

- **D1.** Scroll reveal via IntersectionObserver + CSS transition; **wajib** hormati `prefers-reduced-motion`
- **D2.** Hover states dasar di kartu project, link, tombol
- **D3.** Smooth scroll antar-section + active state nav

### P1 (Should Have)

- Resume download link — Customizer field, link diisi manual (PDF sudah tersedia)
- Section **"How I Work"** ringkas (4 langkah proses) — penguat positioning
- Section **testimonial auto-hide**: render hanya jika ada ≥ 1 post `client_quote` published — hidden sekarang, muncul sendiri saat quote asli ditambahkan
- **Analytics GA4** via Customizer field (gtag di-enqueue hanya jika field terisi) + event: `email_cta_click`, `case_study_open`, `resume_download`

### P2 / Future

- English / bilingual
- Blog
- Marquee, custom cursor, micro-interactions
- Contact form / booking
- Plausible sebagai alternatif analytics

### Functional Requirements

| Req | Description | Priority |
|---|---|---|
| FR-01 | One-pager: hero / about / how-i-work / works / career / stack / contact dengan fallback mockup | P0 |
| FR-02 | CPT `case_study` + meta terstruktur + admin native | P0 |
| FR-03 | Template single case study + prev/next | P0 |
| FR-04 | Customizer: hero, about, contact, social, resume URL, GA4 ID, branding | P0 |
| FR-05 | Scroll reveal (reduced-motion aware) + hover states + smooth anchor | P0 |
| FR-06 | How I Work + testimonial auto-hide | P1 |
| FR-07 | GA4 integration + event tracking | P1 |

### Non-Functional Requirements

| Req | Category | Target |
|---|---|---|
| NFR-01 | Performance | Tailwind compiled & minified, di-commit; tanpa JS framework; Lighthouse Performance ≥ 90 (desktop) |
| NFR-02 | Accessibility | WCAG 2.1 AA; kontras lime ↔ black ≈ 17.8:1 (melampaui AAA); focus-visible lime; semantic HTML; keyboard navigable |
| NFR-03 | Production | Server produksi tidak butuh Node; deploy = upload folder tema + aktivasi |
| NFR-04 | SEO | Title/meta dasar, Open Graph tags, struktur heading semantik |
| NFR-05 | Browser | Evergreen modern (Chrome, Edge, Firefox, Safari) |
| NFR-06 | Motion | Semua animasi hormati `prefers-reduced-motion` |

---

## 6. Success Metrics

### North Star

**Metric:** jumlah **inquiry klien valid per bulan** yang datang melalui website (email CTA).
**Baseline:** 0 (belum live).
**Target:** 1-3 inquiry/bulan dalam 3 bulan setelah live + project nyata masuk.
**Why:** ini satu-satunya metric yang membuktikan website menjalankan fungsinya sebagai aset konversi freelance.

### Secondary Metrics

| Metric | Target | Timeframe |
|---|---|---|
| Pengunjung membuka ≥ 1 case study (activation) | ≥ 30% session | 3 bulan |
| Rata-rata waktu di halaman case study | ≥ 2 menit | 3 bulan |
| Email CTA click-through | ≥ 5% session | 3 bulan |
| Resume download | baseline terpantau | 3 bulan |

### Measurement Framework

Funnel: **Acquisition** (traffic) → **Activation** (buka case study) → **Action** (email CTA). Implementasi via event tracking (FR-07); baseline mulai terukur saat analytics aktif di F4.

---

## 7. Scope

### In Scope (MVP = F0–F4)

- Semua P0 + P1 yang tercantum di section 5
- Tema fully working dengan mockup realistis; siap deploy ke shared hosting
- Konten nyata (project, testimonial, resume link) diisi sendiri via WP Admin setelah web jadi (F5) — tanpa code change

### Out of Scope

- Bilingual / English
- Blog
- Contact form / booking / WhatsApp
- Interaksi fase-2 (marquee, custom cursor)
- Technical SEO penuh
- Manajemen hosting (hosting sudah tersedia; deploy tema masuk scope, administrasi hosting tidak)

### Future Considerations

- English (setelah versi Indonesia tuntas)
- Blog / artikel
- Interaksi lanjutan
- Plausible sebagai alternatif analytics

---

## 8. Technical Considerations

### Arsitektur (pola nab-custom yang sudah teruji, kode fresh)

- Classic PHP theme: `style.css` header + `functions.php` bootstrap `inc/*`
- `inc/`: `setup.php` (supports + enqueue + fonts), `cpt.php` (4 CPT + meta boxes native), `customizer.php` (panel + defaults mockup), `template-tags.php` (helper)
- Build: Tailwind v4 via `@tailwindcss/cli` — `src/input.css` → `assets/css/tailwind.css` (minified, **di-commit**); Node hanya untuk development
- JS: vanilla `assets/js/main.js` — IntersectionObserver reveal, smooth anchor, GA4 event; tanpa framework JS
- Template hierarchy: `front-page.php` (one-pager), `single-case_study.php` (case study), `header.php` / `footer.php` / `index.php` / `page.php` / `404.php`

### CPT & Data Model

| CPT baru | Menggantikan (nab-custom) | Perilaku | Data |
|---|---|---|---|
| `case_study` | `pf_project` | **Public + rewrite `case-study`** — punya halaman sendiri | Meta: role, client, period, stack, external URL; sections: problem, approach, solution, result |
| `career` | `xp_item` | Internal, urut page-attributes | Meta: period, role; content: deskripsi |
| `stack_item` | `skill_item` | Internal, urut page-attributes | Title = nama skill |
| `client_quote` | `testimonial` | Internal; section **auto-hide** (render hanya jika ada post) | Content: quote; meta: nama + role klien |

**Semua slug baru — clean slate.** Konten lama nab-custom semuanya mockup; tidak ada migrasi data.

**Catatan arsitektural:** semua CPT nab-custom memakai `public => false` + `rewrite => false` (galeri tanpa halaman detail). CPT `case_study` sengaja dibuat public + rewrite aktif — ini delta kunci yang meng-enable struktur hybrid.

### Customizer Panel

| Panel | Field |
|---|---|
| Hero | nama, tagline, deskripsi, foto |
| About | story, foto |
| Contact | email, social links (GitHub, LinkedIn, dll.), Resume URL (diisi manual — PDF sudah tersedia) |
| Analytics | GA4 Tracking ID (gtag di-enqueue hanya jika terisi) |
| Branding | copyright footer |

### Keamanan

- Escaping/output standard WP di semua template
- Nonce + capability check untuk save meta box
- Tidak ada data PII pengunjung selain analytics (GA4; tanpa input form)

### Token Desain (src/input.css)

- `--color-lime: #d3fd06`, `--color-ink: #000000` (+ turunan fog/smoke ala nab-custom)
- Font: Staatliches (display), Roboto (body) — Google Fonts
- Utility `clamp()` untuk tipografi display; container max-width 1176px

### Struktur File Target

```text
nab-portfolio/
├── docs/PRD.md
├── style.css
├── functions.php
├── inc/
│   ├── setup.php
│   ├── cpt.php
│   ├── customizer.php
│   └── template-tags.php
├── front-page.php
├── single-case_study.php
├── header.php / footer.php
├── index.php / page.php / 404.php
├── template-parts/ (hero, about, how-i-work, works, career, stack, testimonial, contact)
├── src/input.css
├── package.json
├── assets/
│   ├── css/tailwind.css   (committed)
│   └── js/main.js
└── README.md
```

---

## 9. Design & UX Requirements

### Identitas Visual

- Lime `#D3FD06` sebagai aksen ekspresif (CTA, kata kunci, highlight, hover) di atas kanvas hitam `#000000`
- Vibe: **bold, teknikal, percaya diri** — tipografi besar (clamp), whitespace disiplin, grid tegas
- Prinsip: lime dipakai selektif agar tetap terasa "mahal", bukan ramai

### Interaksi Inti

- Scroll reveal halus (fade/translate kecil, 150-300ms)
- Hover states di kartu project & tombol
- Smooth scroll antar-section + active state nav

### Accessibility

- Kontras lime ↔ black ≈ 17.8:1 dua arah — melampaui AA/AAA untuk teks
- `focus-visible` lime di semua interactive elements
- `prefers-reduced-motion` dihormati semua animasi
- Alt text, heading semantik, navigasi keyboard

### Responsive

- Mobile-first: 320-767 / tablet 768-1023 / desktop ≥ 1024
- Tipografi display pakai `clamp()`

### User Flows Utama

1. Hero → skim section → buka case study → email CTA
2. Langsung ke Works → case study → prev/next → CTA
3. Footer → social / email

---

## 10. Timeline & Milestones

Per fase, tanpa deadline keras (iterative). Checkpoint review di akhir tiap fase sebelum lanjut.

| Fase | Deliverable | Definition of Done |
|---|---|---|
| **F0** | PRD final + scaffold tema | Struktur file lengkap; tema bisa diaktivasi tanpa error |
| **F1** | One-pager lengkap dengan mockup | Semua section P0 tampil; Customizer jalan |
| **F2** | CPT `case_study` + template single | 1 mockup case study penuh terbaca bagus di mobile + desktop |
| **F3** | Motion inti + QA | NFR-01/02/06 terpenuhi; Lighthouse lokal ≥ 90 |
| **F4** | Deploy shared hosting + GA4 + resume URL | Live dengan mockup realistis; North Star baseline mulai terukur |
| **F5** | Konten nyata (self-serve, tanpa coding) | Project nyata, testimonial asli (section muncul otomatis), resume link diisi |
| **F6+** | Future | English, blog, interaksi lanjutan |

---

## 11. Risks & Mitigation

| Risk | Impact | Prob | Mitigation |
|---|---|---|---|
| Beban menulis case study mendalam untuk semua project | High | High | Rilis dengan 2-3 mockup realistis dulu; field terstruktur membuat menulis = isi formulir; project nyata ditambah bertahap |
| Promosi sebelum project nyata masuk | Medium | Medium | Mockup realistis + isi project nyata segera setelah web jadi, sebelum promosi aktif |
| Konflik slug/konten dengan nab-custom yang masih terpasang | Low | Low | Semua slug baru (clean slate); nab-custom dibiarkan terpasang tapi nonaktif sebagai referensi |
| Scope creep interaksi fase-2 masuk MVP | Medium | Medium | Non-Goals tegas; wishlist hanya P2 / F6+ |
| Performa di shared hosting belum teruji | Medium | Medium | Committed CSS tanpa Node; ukur Lighthouse di domain asli saat F4; caching standar hosting |

---

## 12. Dependencies & Assumptions

### Dependencies

- [ ] Google Fonts (Staatliches, Roboto) via CDN
- [ ] GA4 (gratis) — Tracking ID diisi manual saat F4
- [ ] Shared hosting sudah tersedia
- [ ] File resume PDF sudah tersedia (link diisi manual via Customizer)
- [ ] Aset foto pribadi (me.JPG, desk.JPG di folder parent proyek)

### Assumptions

- Bio/tagline final tersedia (konfirmasi owner)
- Environment LocalWP + WP ≥ 6.0 + PHP ≥ 8.0 sudah berjalan
- `nab-custom` tetap terpasang sebagai referensi; tidak ada migrasi data (konten lama = mockup)
- Permalinks di-enable di produksi (pretty URL untuk `/case-study/...`)

---

## 13. Keputusan Final — Decision Log

Hasil review open questions, 2026-10-17:

| # | Pertanyaan | Keputusan | Implikasi |
|---|---|---|---|
| 1 | Slug CPT baru vs warisi slug lama | **Slug baru** — konten lama mockup, struktur case study beda | Clean slate total; tidak ada migrasi data |
| 2 | Hosting produksi | **Shared hosting (tersedia)** | Checklist deploy F4; tanpa Node di server |
| 3 | Analytics | **Ringan, aktif sejak F4** | GA4 via Customizer field; baseline North Star terukur |
| 4 | Project nyata | **Mockup dulu; project nyata diisi setelah web jadi** | F5 self-serve via WP Admin, zero code change |
| 5 | Resume PDF | **Ada; link editable manual** | Customizer field Resume URL |
| 6 | Testimonial | **Hidden dulu** | CPT `client_quote` + section auto-hide (render hanya jika ada post published) |

---

## 14. Sign-off

| Stakeholder | Role | Status | Tanggal |
|---|---|---|---|
| Nabil Hardiansa | Owner | Approved | 2026-10-17 |

---

## Change Log

| Versi | Tanggal | Perubahan |
|---|---|---|
| 0.1 | 2026-10-17 | Draft awal untuk review |
| 1.0 | 2026-10-17 | Final — open questions resolved (Decision Log, section 13) |
