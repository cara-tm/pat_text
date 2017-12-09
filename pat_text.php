<?php
/**
 * A replacement to the <txp:text item="" /> tag for multilanguage strings support
 *
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_text
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 0.1.7
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
 * @param  $items string      Comma separated list of translations
 * @param  $lang  string      Country code (ISO2)
 * @param  $exclusive boolean Overwrites the current language and sniffs ?lang= to get a new one
 * @return string             The corresponding string from the list
 *
 */
function pat_text($atts)
{
	global $variable;

	// The active ISO2 code language from TXP prefs
	$current = substr(get_pref('language', TEXTPATTERN_DEFAULT_LANG, true), 0, 2);

	extract(lAtts(array(
		'items'     => $current.' Nothing to display.',
		'lang'      => $current,
		'exclusive' => false,
	), $atts));

	// Display errors
	strlen($lang) > 2 ? trigger_error(gTxt('invalid_attribute_value', array('{name}' => 'lang')), E_USER_WARNING) : '';
	assert_string($items);

	if (empty($lang) && $variable['visitor_lang'])
		$lang = $variable['visitor_lang'];

	// Locale section not exists?
	if (null == _pat_detect_section_name($lang))
		$out = ' ';
	else {
		if (strlen($atts['items']) < 326) {

			// Loop into the items list converted as an array
			$list = do_list($items);
			$out = '';

			foreach ($list as $value) {
				// Same language as TXP default and locale sections exist or exclusive is true: do nothing
				if (true === $exclusive && $current == $lang)
					$out = ' ';
				// Gives the matching string for a language
				elseif (substr($value, 0, 2) == $lang)
					$out = substr($value, 3);
			}
			// Return the matching string or a fallback
			return $out ? $out : substr($list[0], 3);
		}
		else
			return;
	}

}


/**
 * Compares a variable from names stored into the 'section' table
 *
 * @param  $code string ISO2 language code
 * @return $code string ISO2 language code found in DB
 */
function _pat_detect_section_name($code)
{
	global $DB;
	$DB = new DB;

	$rs = safe_field('name', 'txp_section', "name = '".doSlash($code)."'");

	if ($rs)
		$out = $code;
	else
		$out = '';

	return $out;
}
