# ChartsCss MediaWiki Extension

This extension packages the compiled **Charts.css** stylesheet as a ResourceLoader module and provides a `<chartscss>...</chartscss>` tag that automatically loads it on pages that use the tag.

## Install

1. Copy this folder into your MediaWiki install:

   `extensions/ChartsCss`

2. Ensure the stylesheet exists at:

   `extensions/ChartsCss/modules/ext.chartscss/charts.min.css`

   You can (re)generate it by building Charts.css and copying `dist/charts.min.css` into that location.

3. Enable the extension in `LocalSettings.php`:

```php
wfLoadExtension( 'ChartsCss' );
```

## Use

### Minimal example

```html
<chartscss>
<table class="charts-css column show-primary-axis show-4-secondary-axes data-spacing-4 reverse-data">
  <caption>Front End Developer Salary</caption>
  <thead>
    <tr>
      <th scope="col">Year</th>
      <th scope="col">Income</th>
    </tr>
  </thead>
  <tbody>
    <tr><th scope="row">2016</th><td style="--size: calc(40 / 100);">$40K</td></tr>
    <tr><th scope="row">2017</th><td style="--size: calc(60 / 100);">$60K</td></tr>
    <tr><th scope="row">2018</th><td style="--size: calc(75 / 100);">$75K</td></tr>
    <tr><th scope="row">2019</th><td style="--size: calc(90 / 100);">$90K</td></tr>
    <tr><th scope="row">2020</th><td style="--size: calc(100 / 100);">$100K</td></tr>
  </tbody>
</table>
</chartscss>
```

### Template pattern (recommended for editors)

Copy/paste the templates from:

- [wiki-templates/Template_ChartsCssColumn.wiki](wiki-templates/Template_ChartsCssColumn.wiki) (create `Template:ChartsCss column` on-wiki)
- [wiki-templates/Template_ChartsCssRow.wiki](wiki-templates/Template_ChartsCssRow.wiki) (create `Template:ChartsCss row` on-wiki)
- [wiki-templates/Template_ChartsCssPie.wiki](wiki-templates/Template_ChartsCssPie.wiki) (create `Template:ChartsCss pie` on-wiki)
- [wiki-templates/Template_ChartsCssSlice.wiki](wiki-templates/Template_ChartsCssSlice.wiki) (create `Template:ChartsCss slice` on-wiki)
- [wiki-templates/Template_ChartsCssPieMultiple.wiki](wiki-templates/Template_ChartsCssPieMultiple.wiki) (create `Template:ChartsCss pie multiple` on-wiki)
- [wiki-templates/Template_ChartsCssPieRow.wiki](wiki-templates/Template_ChartsCssPieRow.wiki) (create `Template:ChartsCss pie row` on-wiki)
- [wiki-templates/Template_ChartsCssPieCell.wiki](wiki-templates/Template_ChartsCssPieCell.wiki) (create `Template:ChartsCss pie cell` on-wiki)

Then editors can write:

```text
{{ChartsCss column
 | type=column
 | classes=show-primary-axis show-4-secondary-axes data-spacing-4 reverse-data
 | caption=Front End Developer Salary
 | xHeader=Year
 | yHeader=Income
 | rows=
   {{ChartsCss row | label=2016 | size=calc(40 / 100) | value=$ 40K }}
   {{ChartsCss row | label=2017 | size=calc(60 / 100) | value=$ 60K }}
   {{ChartsCss row | label=2018 | size=calc(75 / 100) | value=$ 75K }}
   {{ChartsCss row | label=2019 | size=calc(90 / 100) | value=$ 90K }}
   {{ChartsCss row | label=2020 | size=calc(100 / 100) | value=$ 100K<br/>👑 }}
}}
```

The key requirement is that each data cell needs CSS custom properties like `--size` (or `--start`/`--end` for pie/radial charts).

## Notes

- Charts.css is **CSS-only**: no JS is required.
- If your wiki configuration strips inline styles, you may need to allow CSS variables in inline styles for the `--size`/`--start`/`--end` attributes to work.

## License

GPL-2.0-or-later (see `LICENSE`).
