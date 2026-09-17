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
  overrides. Non-Bootstrap consumers (e.g. the WordPress site) can take just
  the `:root` block and ignore the rest.
- `logo/logo_*.png` — the **eagle mark**, at 16/32/48/64/128/256px. Used for
  favicons and in-app navbars across the ctgnz projects.
- `logo/ctg-logo-small.png` (32px) and `logo/ctg-logo-large-border.png`
  (120×60) — the **CTG Games wordmark**, for the company WordPress site.

The two marks are distinct and not interchangeable: the eagle identifies the
applications, the wordmark identifies the company. Both wordmark files were
recolored from their original `#004586` to the brand navy `#1E3475` so a page
can carry the wordmark and the palette without showing two different blues.

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
