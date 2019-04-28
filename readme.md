HTML Beautify for MODX Revolution
=================================

Configurable MODX plugin that cleans up HTML source code output.

- Beautify your source code with configurable tabs and spaces
- Optionally control your HTML output by forcing valid HTML, unique ID's
- Optionally disable certain elements, manipulate HTML comments, insert
base/absolute URLs

**Utilises hmtLawed by Santosh Patnaik.**

## Installation

Install via MODX package manager and change settings via
`Settings > System Settings`.

## Requirements

- MODX Revolution 2.1.0 or later
- PHP 5.6 - 7.3

## Configuration

There are a number of settings available through the `System > System Settings`
area of the MODX Manager. Set the namespace to `htmlbeautify` to view all
available options.

## Beautify or Compact HTML Examples

Examples settings for `xhtmlbeautify.tidy`

**-1 - Compacts HTML**

```html
<body> <section><h1>Example output</h1> <ul><li>List Item 1</li> <li>List Item 2</li> </ul> <div class="class"><p>Paragraph</p> </div> <div class="wrapper"><nav><ul class="list"><li>List Item 1</li> <li>Item 2</li> </ul> </nav></div> </section>
```

**1t1n - 1 tab indentation, 1 line break**

```html
<body>
	<section>
		<h1>Example output</h1>
		<ul>
			<li>List Item 1</li>
			<li>List Item 2</li>
		</ul>
		<div class="class">
			<p>Paragraph</p>
		</div>
		<div class="wrapper">
			<nav>
				<ul class="list">
					<li>List Item 1</li>
					<li>Item 2</li>
				</ul>
			</nav>
		</div>
	</section>
```

**4s1n - 4 space indentation, 1 line break**

```html
<body>
    <section>
         <h1>Example output</h1>
         <ul>
              <li>List Item 1</li>
              <li>List Item 2</li>
         </ul>
         <div class="class">
              <p>Paragraph</p>
         </div>
         <div class="wrapper">
              <nav>
                   <ul class="list">
                        <li>List Item 1</li>
                        <li>Item 2</li>
                   </ul>
              </nav>
         </div>
    </section>
```

**8s0n - 8 space indentation, no line break**

```html
<body>
<section>
        <h1>Example output</h1>
        <ul>
                 <li>List Item 1</li>
                 <li>List Item 2</li>
        </ul>
        <div class="class">
                 <p>Paragraph</p>
        </div>
        <div class="wrapper">
                 <nav>
                          <ul class="list">
                                   <li>List Item 1</li>
                                   <li>Item 2</li>
                          </ul>
                 </nav>
        </div>
</section>
```

## System Settings

The plugin can be enabled/disabled from the system setting
`xhtmlbeautify.enabled`.

**Setting**|**Key**|**Description**
:-----:|:-----:|:-----:
Enabled|xhtmlbeautify.enabled|Enable/Disable the plugin from taking effect.
Beautify|xhtmlbeautify.tidy|Beautify or compact HTML code<br><br> -1 = compact<br> 0 = no<br> 1 (or string) = beautify
Make URLs Absolute or Relative|xhtmlbeautify.abs\_url|Setting html\_base\_url needs to be set.<br><br> -1 = make relative<br> 0 = no action (default)<br> 1 = make absolute
Mark & Characters|xhtmlbeautify.and\_mark|See [section 3.2](http://www.bioinformatics.org/phplabware/internal\_utilities/htmLawed/htmLawed\_README.htm#s3.2)
Balance Tags|xhtmlbeautify.balance|Balance tags for well-formedness and proper nesting. See [section 3.3.3](http://www.bioinformatics.org/phplabware/internal\_utilities/htmLawed/htmLawed\_README.htm#s3.3.3)<br><br> 0 = disabled<br> 1 = enabled
Base URL Value|xhtmlbeautify.base\_url|Base URL value that needs to be set if html\_abs\_url is not 0
Clean Microsoft Word|xhtmlbeautify.clean\_ms\_char|Replace discouraged characters introduced by Microsoft Word<br><br> 0 = no (default)<br> 1 = yes<br> 2 = yes, but replace special single & double quotes with ordinary ones
HTML Comments|xhtmlbeautify.comment|Handling of HTML comments<br><br> 0 = don't consider comments as markup and proceed as if plain text<br> 1 = remove<br> 2 = allow, but neutralize any <, >, and & inside by converting to named entities<br> 3 = allow (default)
CSS Expressions|xhtmlbeautify.css\_expression|Allow dynamic CSS expression by not removing the expression from CSS property values in style attributes<br><br> 0 = remove<br> 1 = allow
Denied HTML attributes|xhtmlbeautify.deny\_attribute|Denied HTML attributes;<br><br> 0 = none (default)<br> string - dictated by values in string<br> On* (like onfocus) attributes not allowed
Direct List Nesting|xhtmlbeautify.direct\_nest\_list|Allow direct nesting of a list within another without requiring it to be a list item<br><br> 0 = no (default)<br> 1 = yes
Elements|xhtmlbeautify.elements|Allowed HTML elements<br><br> empty = disabled (default)<br> * -center -dir -font -isindex -menu -s -strike -u -  ~ applet, embed, iframe, object, script not allowed -
Hexadecimal Numeric Entities|xhtmlbeautify.hexdec\_entity|Allow hexadecimal numeric entities and do not convert to the more widely accepted decimal ones, or convert decimal to hexadecimal ones<br><br> 0 = no<br> 1 = yes<br> 2 = convert decimal to hexadecimal ones
Keep Bad Tags|xhtmlbeautify.keep\_bad|Neutralize bad tags by converting < and > to entities, or remove them<br><br> 0 = remove<br> 1 = neutralize both tags and element content<br> 2 = remove tags but neutralize element content<br> 3 and 4 - like 1 and 2 but remove if text (pcdata) is invalid in parent element<br> 5 and 6 * -  like 3 and 4 but line-breaks, tabs and spaces are left
Lowercase Attributes|xhtmlbeautify.lc\_std\_val|For XHTML compliance, predefined, standard attribute values, like get for the method attribute of form, must be lowercased<br><br> 0 = no<br> 1 = yes (default)
Strict Tags|xhtmlbeautify.make\_tag\_strict|Transform/remove these non-strict XHTML elements, even if they are allowed by the admin: applet center dir embed font isindex menu s strike u; <br><br> 0 = no<br> 1 =  yes, but leave applet, embed and isindex elements that currently can't be transformed (default)<br> 2 =  yes, removing applet, embed and isindex elements and their contents (nested elements remain)
Deprecated Attributes|xhtmlbeautify.named\_entity|Allow deprecated attributes or transform them<br><br> 0 = allow<br> 1 = transform, but name attributes for a and map are retaine (default)<br> 2 = transform
Universal HTML|xhtmlbeautify.no\_deprecated\_attr|Allow non-universal named HTML entities, or convert to numeric ones<br><br> 0 = convert<br> 1 = allow (default)
Safe|xhtmlbeautify.safe|Magic parameter to make input the most secure against XSS<br><br> 0 = no (default)<br> 1 = will auto-adjust other relevant parameters
Schemes|xhtmlbeautify.schemes|Array of attribute-specific, comma-separated, lower-cased list of schemes (protocols) allowed in attributes accepting URLs (or ! to deny any URL)
Style Pass|xhtmlbeautify.style\_pass|Do not look at style attribute values, letting them through without any alteration<br><br> 0 = no (default)<br> 1 = let through any style value
Unique ID's|xhtmlbeautify.unique\_ids|id attribute value checks to force unique ID<br><br> 0 = no  ^<br> 1 = remove duplicate and/or invalid ones<br> word = remove invalid ones and replace duplicate ones with new and unique ones based on the word; the admin-specified word, like my\_, should begin with a letter (a-z) and can contain letters, digits, ., \_, -, and :.
Valid XHTML|xhtmlbeautify.valid\_xhtml|Magic parameter to make input the most valid XHTML without needing to specify other relevant parameters<br><br> 0 = no (default)<br> 1 = will auto-adjust other relevant parameters (indicated by ~ in this list)
Add xml:lang|xhtmlbeautify.xml:lang|Auto-adding xml:lang attribute<br><br> 0 = no (default)<br> 1 = add if lang attribute is present<br> 2 = add if lang attribute is present, and remove lang
