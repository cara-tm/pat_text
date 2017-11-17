# pat_text

A replacement to the TXP tag `<txp:text item="" />` for multilinguage strings support.

## Usage

Same usage than the native tag:

    <txp:pat_text items="" lang="" />
    
## Attributes

* `items` (string): a pair items list, comma separated, of entries by translations (e.g. `items="en Hello World!, fr Salut les Geeks !"`). First 2 letters are the identifer for the corresponding language (ISO2 code) followed by a space (required) then the translated string (required); each translations are comma separated. Default: none (but shows: "Nothing to display 😢"); lenght limit: 264 characters.
* `lang` (string): the 2 letters of the country for the corresponding translation to display (ISO2) in the current context (i.e. page templates or forms). Default: the language sets in your TXP preferences.

**Note**: Note: this plugin displays **nothing** if there are no match found; but displays the **first pair** of the `items` list if the `lang` attribute is empty (or blank as a fallback for pat_lang_detect, see below).

## Use of quotes into attribute

See more in this article from the official Textpattern Blog: https://textpattern.com/weblog/318/tag-parser-part-1

## Advice

Can be used in conjonction with the *pat_lang_detect* plugin (https://github.com/cara-tm/pat_lang_detect) for automatic process:

    <txp:pat_lang_detect />
    <txp:pat_text items="en Hello World!,fr Salut les Geeks !" lang='<txp:variable name="visitor_lang" />' />

**Important note**: it seems that the TXP tags parser limits the lenght (but pretty long: 265 characters) of its attributes content. This plugin verifys this limit. Please, for best usage of this plugin, set short strings into the `items` attribute.

_Tip and trick_: an invalid pair (eg. `fr ,`) with a country code following by nothing but a space (no translation string) allows to display nothing for the current website language (can be usefull in particular cases).

## History and Changelogs

This plugin created for the "FOTO" theme.

* 16th November 2017: v 0.1.1 & v 0.1.2
* 10th Novembre 2017: v 0.1.0
