# WordPress

`ctg-games/` is a child theme of **Twenty Twenty-Five** that applies the CTG
Games palette to https://ctg.co.nz/ and matches the chrome of the apps on the
subdomains, so moving between them reads as one site.

The upload package is built from this directory and is not committed, since it
would only go stale against the source:

```sh
cd wordpress && python -c "import shutil; shutil.make_archive('ctg-games','zip',root_dir='.',base_dir='ctg-games')"
```

It exists as a child theme rather than as Global Styles settings so the
branding is version-controlled, reviewable, and survives a parent theme
update — settings changed through the Site Editor live only in the database.

## Installing

1. **Appearance → Themes → Add New → Upload Theme**, choose `ctg-games.zip`.
2. Activate it. The palette changes immediately; no content is affected.
3. **Appearance → Editor → Styles** will now offer the brand colours by name
   (Navy, Gold, Pale Blue, Grey, Tint) wherever a colour can be picked.

To change a colour later, edit `theme.json` here, re-zip, and re-upload —
don't edit it through the Site Editor, or the two will diverge.

## The palette, and where each colour may be used

| Slot | Colour | Use |
|---|---|---|
| `base` | `#FFFFFF` | Page background |
| `contrast` | `#1E3475` navy | Body text and headings |
| `accent-1` | `#C6AD5C` gold | Decorative fills only — see below |
| `accent-2` | `#CFE2FF` pale blue | Tinted section backgrounds |
| `accent-3` | `#1E3475` navy | Buttons and links |
| `accent-4` | `#6C757D` grey | Secondary and muted text |
| `accent-5` | `#F5F8FC` tint | Very light section backgrounds |
| `accent-6` | 20% currentColor | Borders and rules (inherited from the parent) |

**Gold cannot carry text on white.** Measured against WCAG, gold on white is
2.20:1 and white on gold is 2.20:1 — both fail even the relaxed large-text
threshold of 3:1. Gold is only safe as a decorative fill, or with *navy* text
on it (5.29:1, passes AA). The button hover state in `theme.json` is defined
accordingly: gold background, navy text.

Everything else has plenty of room — navy on white is 11.65:1, navy on pale
blue 8.86:1, grey on white 4.69:1.

## Site logo

Use **`logo/ctg-logo-wordmark-transparent@480.png`**, not the plain one. The
header bar is pale blue, and the white-filled wordmark reads as a sticker
stuck onto it; with a transparent interior the bar shows through the navy
border and the mark reads as an outlined badge.

Upload it under **Appearance → Editor → Styles**, or via the Site Logo block.

Use the **PNG, not the SVG**: WordPress blocks SVG uploads by default because
an SVG can carry script, and lifting that restriction means installing a
sanitising plugin. Not worth the added attack surface and maintenance for a
logo that has PNG exports at 240, 480 and 960px.

## Fonts

Deliberately left alone. Twenty Twenty-Five ships with Manrope, which sits
fine alongside the palette, and the brand has no typeface of its own beyond
the wordmark's lettering. Worth revisiting only if the site starts to feel
generic.
