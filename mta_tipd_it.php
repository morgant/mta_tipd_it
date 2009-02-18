<?php

// This is a PLUGIN TEMPLATE.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Uncomment and edit this line to override:
$plugin['name'] = 'mta_tipd_it';

$plugin['version'] = '0.1';
$plugin['author'] = 'Morgan Aldridge';
$plugin['author_uri'] = 'http://www.makkintosshu.com/';
$plugin['description'] = 'Implements embedding of Tipd.com\'s "Tip It" button.';

// Plugin types:
// 0 = regular plugin; loaded on the public web side only
// 1 = admin plugin; loaded on both the public and admin side
// 2 = library; loaded only when include_plugin() or require_plugin() is called
$plugin['type'] = 0; 


@include_once('zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

This plug-in implements a single tag (@mta_tipd_it@) which will embed a JavaScript "Tip It" button in your article.

h3. Syntax

The @mta_tipd_it@ tag has the following syntactic structure:

p. @<txp:mta_tipd_it />@

h3. Attributes

The @mta_tipd_it@ tag will accept the following attributes (note: attributes are *case sensitive*):

p. *<code>url="string"</code>*

When passed a url string, the URL of the article submitted to tipd.com will be set to said string. When this attribute is not present (default), the current article's permlink URL will be used.

*<code>button="string"</code>*

When passed a string, the type of the "Tip It" button will be set to that named. An empty or unrecognized string will result in the big "Tip It" button with Tip'd count. Acceptable values: @big@, @small@, or @text@.

h3. Examples

p. @<txp:mta_tipd_it />@

p. @<txp:mta_tipd_it size="small" />@

h3. Change Log

v0.1.1 Updated to include JavaScript from tools.tipd.com instead of tipd.com.

v0.1 Initial release.


# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---


function mta_tipd_it($atts)
{
	global $thisarticle;
	$tipd_js = '';
	
	extract(lAtts(array(
		'url' => permlinkurl($thisarticle),
		'size' => 'big'
	),$atts));
	
	$tipd_js .= '<script type="text/javascript" src="http://tools.tipd.com/evbs.js"></script>'."\n";
	$tipd_js .= '<script type="text/javascript">'."\n";
	$tipd_js .= "\tevb_url = '$url';\n";
	$tipd_js .= "\tevb_$size(evb_url);\n";
	$tipd_js .= "</script>\n";
		
	return $tipd_js;
}

# --- END PLUGIN CODE ---

?>