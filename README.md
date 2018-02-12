# <txp:pat_text />

A replacement to the TXP tag `<txp:text item="" />` for multilinguage strings support and/or your UI components.

_This plugin is intended to be used for UI elements into your templates without supercharge your database with Textpacks injection but can't support long strings and/or HTML tags in it (326 characters limit, spaces included)_.

Standalone pat_text plugin results. No consuming database access; perfect for UI elements translation; can be used in conjunction with the pat_lang_detect plugin compagnon for automatic language detection; can be overwriting throgout the entire page with a `?lang` query parameter into URLs (e.g. `?lang=en`):

![pat-text plugin results](https://github.com/cara-tm/pat_text/raw/master/screenshot.png "pat-text plugin results").

## Usage

Same usage than the native tag:

    <txp:pat_text exclusive="" items="" lang="" />
    
## Attributes

* `items` (string): a pair items list, comma separated, of entries by translations (e.g. `items="en Hello World!|fr Salut les Geeks !"`). First 2 letters are the identifer for the corresponding language (ISO2 code); each translations are pipe (`|` sign) separated. Default: none (but shows: "Nothing to display.").
* `lang` (string): the country for the corresponding translation to display (the plugin convert it into ISO2) in the current context (i.e. page template or form). Default: the language sets in your TXP preferences.

**Note**: Note: this plugin displays **nothing** if there are no match found; but displays the **first pair** of the `items` list if the `lang` attribute is empty (or blank as a fallback for pat_lang_detect, see below).

## Use of quotes into attribute

See more in this article from the official Textpattern Blog: https://textpattern.com/weblog/318/tag-parser-part-1

## Advice

Can be used in conjonction with the *pat_lang_detect* plugin (https://github.com/cara-tm/pat_lang_detect) for automatic process:

    <txp:pat_lang_detect />
    <txp:pat_text items="en Hello World!,fr Salut les Geeks !" lang='<txp:variable name="visitor_lang" />' />

**Important note**: it seems that the TXP tags parser limits the lenght (but pretty long: 265 characters) of its attributes content. This plugin verifys this limit. Please, for best usage of this plugin, set short strings into the `items` attribute.

## Tips and tricks

An invalid pair (eg. `fr  `) with a country code following by nothing but 2 spaces (no translation strings) allows to display nothing for the current website language (can be usefull in particular cases).

If you want to include commas in your translation strings, use the corresponding HTML entity `&#44;` instead.

Integration with the [*com_connect*](https://forum.textpattern.io/viewtopic.php?id=47913) plugin (combined use of *pat_detect_lang* & *pat_text*):

    <txp:com_connect to="recipient@example.com" label='<txp:pat_text items="en Contact Form,es Formulario de contacto,de Kontakt Formular,fr Formulaire de Contact" lang=''<txp:variable name="visitor_lang" />'' />' copysender="1" browser_validate="0" subject="">

## Case study

For the "FOTO" theme, I needed to create a `default` page template where all UI elements will be available into 4 different languages.
Furthermore, I needed to display a message to inform all foreign visitors that a translated inner page is available into their language.
Here is how this kind of message had been made in the top of the page:

    <txp:pat_lang_detect />
    <txp:variable name="check" value='<txp:pat_text exclusive="1" items=''en en">This website in your language,de de">Diese Website in Ihrer Sprache,es es">Este sitio web en su idioma,fr fr">Ce site dans votre langue,  '' lang=''<txp:variable name="visitor_lang" />'' />' />
    <txp:if_variable name="check"><div class="full langs"><txp:if_variable name="visitor_lang" value='<txp:pat_lang_default />'><txp:else /><p><a href="<txp:site_url /><txp:variable name="check" /></a></p></div></txp:if_variable></txp:if_variable>


## History and Changelogs

This plugin created for the "FOTO" theme.

* 12th February 2018: v 0.2.4.
* 13th January 2018: v 0.2.3.
* 24th December 2017: v 0.2.2 
* 23rd December 2017: v 0.2.1
* 17th December 2017: v 0.2
* 15th December 2017: v 0.1.8
* 9th December 2017: v 0.1.7
* 25th November 2017: v 0.1.6
* 23td November 2017: v 0.1.5 (for better interaction: loads current translation strings based on TXP language if the pat_lang_detect plugin is disabled).
* 21th November 2017: v 0.1.4 (final).
* 18th November 2017: v 0.1.3.
* 16th November 2017: v 0.1.1 & v 0.1.2
* 10th Novembre 2017: v 0.1.0
