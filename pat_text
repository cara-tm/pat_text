<?php
/**
 * A replacement to the <txp:text item="" /> tag for multilanguage strings support
 *
 * @author:  Patrick LEFEVRE.
 * @link:    https://github.com/cara-tm/pat_text
 * @type:    Public
 * @prefs:   no
 * @order:   5
 * @version: 0.1.0
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

	extract(lAtts(array(
		'items'  => 'en Nothing to display 😢',
		'lang'  => 'en',
	), $atts));

	(empty($lang) || strlen($lang) > 2) ? trigger_error( gTxt('invalid_attribute_value', array('{name}' => 'lang')), E_USER_WARNING ) : '';

	$list = explode( ',', preg_replace('/\s*,\s*/', ',', $items) );
	foreach ($list as $value) {
		if(substr($value, 0, 2) == $lang) {
			$out = substr($value, 3);
		}
	}

	return $out;
}
