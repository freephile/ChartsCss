# Wiki templates (copy/paste)

These are **wikitext templates** meant to be created on-wiki:

- `Template:ChartsCss column` → paste from `Template_ChartsCssColumn.wiki`
- `Template:ChartsCss row` → paste from `Template_ChartsCssRow.wiki`
- `Template:ChartsCss pie` → paste from `Template_ChartsCssPie.wiki`
- `Template:ChartsCss slice` → paste from `Template_ChartsCssSlice.wiki`
- `Template:ChartsCss pie multiple` → paste from `Template_ChartsCssPieMultiple.wiki`
- `Template:ChartsCss pie row` → paste from `Template_ChartsCssPieRow.wiki`
- `Template:ChartsCss pie cell` → paste from `Template_ChartsCssPieCell.wiki`

They assume the `ChartsCss` extension is installed and enabled, providing the `<chartscss>` tag which auto-loads the ResourceLoader module.

## Important MediaWiki limitation

Many Charts.css examples on chartscss.org show standard HTML table structure like `<thead>`, `<tbody>`, `<tfoot>`, `<colgroup>`, and `<col>`. MediaWiki does not accept those elements in wikitext/HTML table markup, so they may be stripped or ignored. The templates in this directory intentionally avoid these tags and use plain `<tr>`, `<th>`, and `<td>` rows directly under `<table>`.

## Why templates?

Editors can create charts without writing raw HTML table scaffolding; they only provide labels and sizes.

## Security / Sanitization

These templates rely on inline CSS custom properties like `style="--size: …"`. You confirmed your wiki allows this; if that changes, the templates will need adjustment.
