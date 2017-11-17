/**
 * A replacement to the <txp:text item="" /> tag for multilanguage strings support
 *
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_text
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 0.1.3
 * @license: GPLv2
*/


/**
 * This plugin tag registry.
 */
if (class_exists('\Textpattern\Tag\Registry')) {
	Txp::get('\Textpattern\Tag\Registry')
		->register('pat_text');
}


/**
 * Main plugin function to display translations by choosen country code
 *
 * @param  $items string Comma separated list of translations
 * @param  $lang  string Country code (ISO2)
 * @return string The corresponding string from the list
 *
 */
function pat_text($atts, $thing='')
{
	// The active language from TXP prefs
	$current = substr(get_pref('language'), 0, 2);

	extract(lAtts(array(
		'items' => $current.' Nothing to display 😢',
		'lang'  => $current,
	), $atts));

	// Display error
	strlen($lang) > 2 ? trigger_error( gTxt('invalid_attribute_value', array('{name}' => 'lang')), E_USER_WARNING ) : '';

	// Loop into the items list converted as an array
	if (strlen($items) < 264) {
		$list = explode( ',', preg_replace('/\s*,\s*/', ',', $items) );

		foreach ($list as $value) {
			if (substr($value, 0, 2) == $lang) {
				$out = substr($value, 3);
			}
		}
		// Return the matching string or a fallback
		return $out ? $out : substr($list[0], 3);
	}
	else
		return '';
}
