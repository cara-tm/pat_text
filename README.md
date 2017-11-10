# pat_text

A replacement to the TXP tag `<txp:text item="" />` for multilinguage strings support.

## Usage

Same usage than the native tag:

    <txp:pat_text items="" lang="" />
    
## Attributes

* `items` (string): a pair items list, comma separated, of entries by translations (e.g. `items="en Hello World!, fr Salut les geeks !"`). First 2 letters are the identifer for the corresponding lang (ISO2); each translations are comma separated. Default: none (but shows: "Nothing to display 😢").
* `lang` (string): the 2 letters of the country for the corresponding translation to display (ISO2) in the current context (i.e. page templates or forms).

## Advice

Can be used in conjonction with the *pat_lang_detect* plugin (https://github.com/cara-tm/pat_lang_detect) for automatic process:

    <txp:pat_text items="en Hello World!,fr Salut les Geeks !" lang='&lt;txp:variable name="visitor_lang" />

## History and Changelogs

This plugin created for the "FOTO" theme.
10th Novembre 2017: v 0.1.0
