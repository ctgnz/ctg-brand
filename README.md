# ctg-brand

Master copy of the CTG Games visual identity: palette, logo marks, and the CSS
that applies them. Consumed by the other `ctgnz` projects as a git submodule so
there is one place to change a color.

## Palette

| Role | Name | Hex | Notes |
|---|---|---|---|
| Primary / actionable | Navy | `#1E3475` | Buttons, active nav, link text, focus rings. From the eagle mark. |
| Brand surface | Pale blue | `#CFE2FF` | Navbar and other tinted backgrounds. |
| Accent | Gold | `#C6AD5C` | Highlights. From the eagle mark. |
| Accent, shade | Gold shade | `#AD9548` | Gold hover / active state. |
| Secondary / contrast | Gray | `#6C757D` | Footers, muted surfaces. |

Two derived tints, both taken at the same lightening ratios Bootstrap uses for
its own primary: `#8E9ABA` (50% white, focus borders) and `#BCC2D6` (70% white,
active range thumb).

## Contents

- `css/brand.css` — the palette as CSS custom properties, plus Bootstrap 5.3
  overrides, for the apps on the subdomains.
- `wordpress/` — a Twenty Twenty-Five child theme carrying the same palette to
  the WordPress site at ctg.co.nz, and matching the apps' header and footer so
  that clicking through from the company site to an app reads as moving between
  sections rather than between sites. See `wordpress/README.md`.
- `logo/logo_*.png` — the **eagle mark**, at 16/32/48/64/128/256px. Used for
  favicons and in-app navbars across the ctgnz projects.
- `logo/ctg-logo-wordmark.svg` — the **CTG Games wordmark** (`ctg` over
  `games`, bordered), for the company WordPress site. Vector master, with the
  lettering stored as outlines so it needs no font installed. `@240`, `@480`
  and `@960` PNGs are exported from it for contexts that can't take SVG.
- `logo/ctg-logo-wordmark-transparent.svg` — the same wordmark with no white
  fill, for placing on a coloured background such as the pale blue header bar.
  `@480` and `@960` PNGs alongside it.
- `logo/ctg-logo-small.svg` — the **compact square mark** (`ctg` only, 1:1),
  for favicons, avatars and anywhere the full wordmark would be illegible.
  `@64`, `@128` and `@256` PNGs alongside it.
- `logo/ctg-logo-small.png` (32px) and `logo/ctg-logo-large-border.png`
  (120×60) — the original 2015 rasters, kept for reference. They were the only
  copies that survived, which is why both vectors above were rebuilt from them.

The two marks are distinct and not interchangeable: the eagle identifies the
applications, the wordmark identifies the company. All wordmark files use the
brand navy `#1E3475`, recolored from the original `#004586` so a page can carry
the wordmark and the palette without showing two different blues.

### How the wordmark was rebuilt

No source file for the wordmark survived, so the vector was reconstructed from
the 120×60 raster. The layout was measured off that bitmap — 3px border, both
words left-aligned at x=31, `games` at exactly half the x-height of `ctg` and
tracked to match its width — and the typeface identified as **Verdana Bold** by
scoring candidates on both letterform overlap and natural proportions (its
`ctg` aspect ratio is within 1% of the original, where other candidates were
9-17% off). The rebuild matches the original at 0.90 IoU.

The lettering is stored as outlines, so nothing depends on Verdana being
installed. If a clean-room asset under an open font licence is ever wanted,
DejaVu Sans Bold is the closest freely licensed substitute.

## Using it in a Bootstrap project

Load `brand.css` *after* `bootstrap.css` so the overrides win:

```html
<link href="/css/bootstrap.css" rel="stylesheet">
<link href="/css/brand.css" rel="stylesheet">
```

Then use stock Bootstrap classes — `.btn-primary`, `.nav-pills`,
`.bg-primary-subtle` — and they come out in brand colors. Gold has no Bootstrap
slot of its own, so it ships as `.btn-gold`, `.text-gold`, `.bg-gold` and
`.border-gold`.

### Why the per-component overrides exist

Bootstrap 5.3 only wires a handful of newer utility classes
(`.text-bg-primary`, `.bg`/`.border`/`.text-primary-subtle`, `.alert-primary`)
to the `--bs-primary*` custom properties. Most component variants —
`.btn-primary`, `.btn-outline-primary`, `.nav-pills` active state, and the
form-check / switch / range checked and focus colors — have Bootstrap's blue
baked in as literal hex at Sass compile time. Overriding the root tokens alone
silently does nothing for those, so `brand.css` overrides each one directly.

If a project starts using a Bootstrap component not covered here (pagination,
dropdowns, list groups, progress bars), check whether it hardcodes the blue and
add the override to `brand.css` rather than patching it locally.

## Licensing

Two different things live in this repo and they are licensed differently:

| Path | Terms |
|---|---|
| `css/` | Apache License 2.0 — see `LICENSE.md` |
| `logo/` | All rights reserved. Trademarks of CTG Games Limited, **not** covered by the Apache grant. |

Apache 2.0 grants no trademark rights (Section 6), and the copyright grant
is not intended to cover the logo files either. `NOTICE` sets out what use
of the marks is and isn't permitted; under Apache 2.0 §4(d) anyone
redistributing this work has to reproduce that file.

## Adding it to a project

```sh
git submodule add https://github.com/ctgnz/ctg-brand.git brand
git commit -m "Add ctg-brand submodule"
```

To pick up later changes:

```sh
git submodule update --remote brand
```

Cloning a project that uses it:

```sh
git clone --recurse-submodules <project-url>
```
