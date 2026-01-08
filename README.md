# ChartsCss MediaWiki Extension

This extension is a **proof-of-concept** for using the https://chartscss.org/ project in MediaWiki. There may be a critical mismatch for using ChartsCSS in MediaWiki in that the CSS is based (in part) on the <tbody> tag which is not allowed in MediaWiki wikitext. See the [TODO.md](TODO.md) for status

This extension packages the compiled **Charts.css** stylesheet from https://chartscss.org as a ResourceLoader module and provides a `<chartscss>...</chartscss>` tag that automatically loads it on pages that use the tag.

Prototype example showing axis label problems:

<img width="734" height="746" alt="image" src="https://github.com/user-attachments/assets/1a5c0a36-f748-4599-b818-b1efca5aa1fb" />


## Goals

A goal of this extension is to actually **package convenience templates** (perhaps one template for each chart type) to make it easier for authors to use the styles without having to learn much code if anything. The templates are included in the source tree in the `wiki-templates` directory. Current templates use `#if` from [Extension:ParserFunctions](https://www.mediawiki.org/wiki/Extension:ParserFunctions), so that is a soft dependency.

The templates themselves need to be fully built with TemplateXML for form defintion and example usage. Example usage may need Help namespace content - in which case those pages would be bundled in any package.

Aside from listing the contents of templates in the source a goal would be to package the templates into a [Page Exchange](https://www.mediawiki.org/wiki/Extension:Page_Exchange) package.

We may create a SpecialPage where there is an **interactive chart builder** like https://chartscss.org/examples/chart-builder/.

## Alternatives

You could just simply load the CSS in [MediaWiki:Common.css](https://www.mediawiki.org/wiki/MediaWiki:Common.css) instead of installing this extension. See https://www.mediawiki.org/wiki/Manual:CSS  The advantage of creating (and using) an extension is that the added CSS only gets loaded for pages that use it via the <chartscss> tag instead of loading it on every page load.

**[Extension:CSS](https://www.mediawiki.org/wiki/Extension:CSS)** allows you to store CSS on any page on your wiki. This would be another way of including the Charts CSS into your wiki.

A **Gadget** could be created to accomplish much of the goals of this extension. Since gadgets can contain javascript, a gadget solution could even achieve the goal of an interative 'chart builder'.

We could potentially use [TemplateStyles](https://en.wikipedia.org/wiki/Wikipedia:TemplateStyles) with Styles for each template and a template for each chart type but it's not clear if such an approach would offer any advantage. It certainly would be more confusing and cumbersome.

We could explore the possibility of creating an extension around the **[Charts.js](https://www.chartjs.org/)** library which is more popular and also more feature-rich than Charts.css It would be a bigger effort of course, but at the same time it's disappointing to see that MediaWiki is not one of the [current "integrations"](https://github.com/chartjs/awesome) that exist.

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
  <tr>
    <th scope="col">Year</th>
    <th scope="col">Income</th>
  </tr>
  <tr><th scope="row">2016</th><td style="--size: calc(40 / 100);">$40K</td></tr>
  <tr><th scope="row">2017</th><td style="--size: calc(60 / 100);">$60K</td></tr>
  <tr><th scope="row">2018</th><td style="--size: calc(75 / 100);">$75K</td></tr>
  <tr><th scope="row">2019</th><td style="--size: calc(90 / 100);">$90K</td></tr>
  <tr><th scope="row">2020</th><td style="--size: calc(100 / 100);">$100K</td></tr>
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
- MediaWiki does not support table sectioning/column elements like `<col>`, `<colgroup>`, `<thead>`, `<tbody>`, and `<tfoot>`. The examples and bundled templates avoid relying on those elements. -ref. https://www.mediawiki.org/wiki/Help:Tables

## License

GPL-2.0-or-later (see `LICENSE`).
