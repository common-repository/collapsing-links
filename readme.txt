=== Collapsing Links ===
Contributors: robfelty
Donate link: http://blog.robfelty.com/plugins/collapsing-links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Tags: links, sidebar, widget
Requires at least: 2.8
Tested up to: 4.3
Stable tag: 0.4

This widget uses Javascript to dynamically expand or collapsable the set of
links for each link category.

== Description ==

This is a very simple plugin that uses Javascript to form a collapsable set of
links in the sidebar for the links (blogroll). Every link corresponding to a
given link category will be expanded.

You can use multiple instances of the widget, each with its own set of options. In this way you could have one set of links for certain categories one place on your page, and another widget with a different set of links somewhere else.

It is based off of the Collapsing Categories and Collapsing Pages plugins.

= What's new? =
* 0.4 (2015.08.12)
    * Compatible with WP 4.3

* 0.3.5 (2010.06.23)
    * Fixed javascript path error

* 0.3.4 (2010.06.18)
    * Fixed html validation when target is blank (thanks http://dropdeaddick.com)

* 0.3.3 (2010.01.28)
    * Switched from scriptaculous to jquery. No longer conflicts with plugins
      which use mootools (e.g. featured content gallery)
    * Restricted settings page to authorized users

== Installation ==

IMPORTANT!
Please deactivate before upgrading, then re-activate the plugin.

Unpackage contents to wp-content/plugins/ so that the files are in a
collapsing-links directory. Activate the plugin in your Wordpress Admin
interface -- Collapsing Links. 

= MANUAL INSTALLATION = 

To use the plugin manually,
change the following here appropriate (most likely sidebar.php):

Change From:

    <ul>
     `<?php get_links_list(); ?>`
    </ul>

To something of the following:
`
    <?php
     if( function_exists('collapsLink') ) {
      collapsLink();
     } else {
      echo "<ul>\n";
      get_links_list();
      echo "</ul>\n";
     }
    ?>
`
You can add parameters to the collapsLink() function as described in the
options section.
 
= WIDGET INSTALLATION = 

simply go the Presentation > Widgets section and drag over the Collapsing Links Widget.

== Frequently Asked Questions ==

None yet.
   
== Screenshots ==

1. a few expanded links with default theme, showing multiple instances of the
widget
2. available options 

== Options ==
Style options can be set via the settings panel. All other options can be set
from the widget panel. If you wish to insert the code into your theme manually
instead of using a widget, you can use the following options. These options
can be given to the `collapsLink()` function either as an array or in query
style, in the same manner as the `wp_list_links` function.
`
  $defaults=array(
    'showLinkCount'=> true ,
    'catSort'=> 'linkName' ,
    'catSortOrder'=> 'ASC' ,
    'linkSort'=> 'linkName' ,
    'linkSortOrder'=> 'ASC' ,
    'inExclude'=> 'exclude' ,
    'inExcludeCats'=> '' ,
    'expand'=> 0 ,
    'customExpand' => '',
    'customCollapse' => '',
    'defaultExpand'=> '',
    'animate' => 0,
    'nofollow' => true,
    'debug' => false
  );
`
* showLinkCount
    *  When true, the number of links in the category will be shown in
       parentheses following the name of the link category
* catSort
    * The order in which link categories should be sorted. Possible values:
        * 'catName' the name of the link category (default)
        * 'catId' the id of the link category
        * 'catSlug' the slug of the link category
        * 'catOrder' custom order specified in the links options
        * 'catCount' the number of links in each category
* linkSort
    * The order in which link linkegories should be sorted. Possible values:
        * 'linkName' the name of the link (default)
        * 'linkId' the id of the link 
        * 'linkUrl' the url of the link 
        * 'linkRating' the rating  assigned to the link
* catSortOrder
    * Whether categories should be sorted in normal or reverse order. Possible
      values:
        * 'ASC' normal order (a-z, 0-9) (default)
        * 'DESC' reverse order (z-a, 9-0)
* linkSortOrder
    * Whether link should be sorted in normal or reverse order. Possible values:
        * 'ASC' normal order (a-z, 0-9) (default)
        * 'DESC' reverse order (z-a, 9-0)
* inExclude
    * Whether to include or exclude certain categories 
        * 'exclude' (default) 
        * 'include'
* inExcludeCats
    * The link categories which should be included or excluded
* expand
    * The symbols to be used to mark expanding and collapsing. Possible values:
        * '0' Triangles (default)
        * '1' + -
        * '2' [+] [-]
        * '3' images (you can upload your own if you wish)
        * '4' custom symbols
* customExpand
    * If you have selected '4' for the expand option, this character will be
      used to mark expandable link categories
* customCollapse
    * If you have selected '4' for the expand option, this character will be
      used to mark collapsible link categories
 
* defaultExpand
    * A comma separated list of link category IDs or Slugs which should be
      expanded by default
* animate
    * When set to true, collapsing and expanding will be animated
* nofollow
    * When set to true (default), rel='nofollow' tags will be added to links
* debug
    * When set to true, extra debugging information will be displayed in the
      underlying code of your page (but not visible from the browser). Use
      this option if you are having problems

= Examples =

`collapsLink('animate=true&nofollow=false&expand=3,inExcludeCats=blogroll,lousy-friends')`
This will produce a list with:
* animation on
* no nofollow tags
* using images to mark collapsing and expanding
* exclude links in the categories blogroll and lousy-friends




== Demo ==

You can see this on my test blog at http://robfelty.com/test


== CAVEAT ==

Currently this plugin relies on Javascript to expand and collapse the links.
If a user's browser doesn't support javascript they won't see the links to the
posts, but the links to the links will still work (which is the default
behavior in wordpress anyways)

The option to show the number of links currently uses the number stored in the
database, which includes both visible and invisible links. If you have
invisible links, this number will be wrong.

== CHANGELOG ==

= 0.4 (2015.08.12) =
* Compatible with WP 4.3

= 0.3.5 (2010.06.23) =
* Fixed javascript path error

= 0.3.4 (2010.06.18) =
* Fixed html validation when target is blank (thanks http://dropdeaddick.com)

= 0.3.3 (2010.01.28) = 
* Switched from scriptaculous to jquery. No longer conflicts with plugins
  which use mootools (e.g. featured content gallery)
* Restricted settings page to authorized users


=  0.3.2 (2009.06.28) =
* Fixed nofollow option
* Fixed problem when using images for symbols

=  0.3.1 (2009.06.22) =
* Fixed problems with page load and cookies

=  0.3.beta (2009.06.10) =
* Added style templates
* Cleaned up code
* using collapsFunctions.js version 1.4

=  0.3.alpha (2009.04.22) =
* Widget is compatible with wordpress 2.8 (not backwards compatible with 2.7
  and previous)
* Can now add parameters to the collapsLink function if you choose not to use
  the widget

=  0.2.6 (2009.04.16) =
* Added option to use custom symbols

=  0.2.5 (2009.02.01) =
* Fixed settings panel

=  0.2.4: (2009.01.07) =
* Added nofollow option
* Added version to javascript
* not loading unnecessary code for admin pages (fixes interference with
  akismet stats page
* fixed debugging option

=  0.2.3: (2009.01.06) =
* Finally fixed disappearing widget problem when trying to add to sidebar
* Added debugging option to show the query used and the output
* Moved style option to options page
* tweaked default style

=  0.2.2: (2009.01.03) =
* Added title attributes so that "click to expand" shows on hover.
* Now the collapse symbol and collapse text are clickable

=  0.2.1: (2009.01.02) =
* Fixed bug with not enqueing javascript file
	* Added feature such that link descriptions are added to the title attribute
	  (will show up on hover) 

=  0.2: (2008.12.08) =
* Can now use as a widget or manually
* consolidated javascript to work with other collapsing plugins
* Uses cookies to keep track of which link categories have been expanded /
  collapsed

=  0.1.4: (2008.10.29) =
* Fixed bug so that multi-word categories are correctly included / excluded


=  0.1.3: (2008.10.29) =
* Now opens links in specified target (blank,top,none)

=  0.1.2: (2008.10.06) =
* Fixed bug with leaving include/exclude categories blank
* Added option to animate expanding and collapsing
* Added option for images instead of text as collapsing symbols

=  0.1.1: =
* Changing default title to 'Blogroll'

=  0.1: =
* Initial Release
