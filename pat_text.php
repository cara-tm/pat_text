<?php
/**
 * A replacement to the <txp:text item="" /> tag for multilanguage strings support
 *
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_text
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 0.2.4
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
 * @param  $items     string  Comma separated list of translations
 * @param  $lang      string  Country code (ISO2)
 * @param  $exclusive boolean Overwrites the current language and sniffs ?lang= to get a new one
 * @return $atts      string  The corresponding string from the item list
 *
 */
function pat_text($atts, $thing = null)
{
	global $variable;

	// The active ISO2 code language from TXP prefs
	$current = substr(get_pref('language', TEXTPATTERN_DEFAULT_LANG, true), 0, 2);

	extract(lAtts(array(
		'items'     => $current.' Nothing to display.',
		'lang'      => false,
	), $atts));

	// Display errors
	strlen($lang) > 5 ? trigger_error(gTxt('invalid_attribute_value', array('{name}' => 'lang')), E_USER_WARNING) : '';
	assert_string($items);

	// Got variable value if exists
	if (empty($lang) && $variable['visitor_lang'])
		$lang = $variable['visitor_lang'];

	// Or from a query parameter
	if (gps('lang'))
		$lang = gps('lang');


	// Keeps only the 2 first characters
	$lang = substr($lang, 0, 2);

	// $items list convertion into an array
	$list = array_unique(array_map('ltrim', explode('|', $items)));

	// Temporary array declaration
	$temp = array();

	// Converts the $items list into an array with locale => translation as values
	foreach($list as $data) {
		$temp[substr($data, 0, 2)] = substr($data, 2);
	}

	// A $lang value (ISO2 code) is found into the array ($temp)
	if (!empty($temp[$lang])) {
		$out = $temp[$lang];
	// Only ISO2 codes into the $items list are found: choose $lang value
	} elseif (empty($temp[$lang]) and isset($temp[$lang])) {
		$out = $lang;
	// No locale supported: use first translation into the $items list
	} elseif (!isset($temp[$lang])) {
		$out = substr($list[0], 3);
	// No translations, first ISO2 code into the corresponding $items list from $temp as a fallback 
	} else {
		$out = array_shift(array_keys($temp));
	}

	return ltrim($out);
	
}
