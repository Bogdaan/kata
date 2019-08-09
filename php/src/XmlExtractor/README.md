# Xml extraction

Create function, witch converts php source code class with 
methods (that have comments) to xml document, that contains use-case
diagram.

Source code example:
```php
class Profile 
{
    /**
     * cqrs: query
     * context: public_site
     *
     * api:
     * @see \frontend\controllers\ProfileController::actionName
     *
     * Get string with current unix time
     */
   public function getTime(): string
   {
      return sprintf("Unix time: %d", time());
   }
}
``` 

Expected result:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<mxfile version="11.1.2" type="google" compressed="false">
  <diagram id="Vx9llvMTYfssC2uus64Z" name="use-case diagram">
    <mxGraphModel dx="0" dy="0" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1000" pageHeight="1000" math="0" shadow="0">
      <root>

        <mxCell id="root-id" value="Profile" style="swimlane;" parent="1" vertex="1">
          <mxGeometry x="0" y="0" width="200" height="200" as="geometry"/>
        </mxCell>

        <mxCell value="Get string with current unix time" style="ellipse;whiteSpace=wrap;html=1;" parent="root-id" vertex="1">
          <mxGeometry x="1" y="1" width="200" height="70" as="geometry"/>
        </mxCell>

      </root>
    </mxGraphModel>
  </diagram>
</mxfile>
```

Constraints:
- xml layout represented as `diagram` and `mxGraphModel` nodes
- each method represented `mxCell` node with attributes: `value, parrent, id`
- each `mxCell`  has `mxGeometry` child tag with attributes: `width, height, x, y`
- query methods has attribute `style="ellipse;whiteSpace=wrap;html=1;fillColor=#fff2cc;strokeColor=#d6b656;"`
- command methods has attribute `style="ellipse;whiteSpace=wrap;html=1;fillColor=#dae8fc;strokeColor=#6c8ebf;"`
- request methods has attribute `style="ellipse;whiteSpace=wrap;html=1;fillColor=#f5f5f5;strokeColor=#666666;"`
- each new use-case in diagram have offset (attributes `dx, dy`)
