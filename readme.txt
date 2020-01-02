=== FeatherLite ===
Contributors: GetFeatherLite
Tags: two-columns, right-sidebar, custom-colors, custom-menu, featured-images, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, blog, news
Requires at least: 1.0.0
Tested up to: 1.1.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
FeatherLite, A ClassicPress Theme, Copyright 2019 GetFeatherLite
FeatherLite is distributed under the terms of the GNU GPL

== Description ==

FeatherLite is a fully responsive, clean and fresh ClassicPress theme ideal for business sites as well as standard blog/news sites.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)

== Changelog ==

Dec. 02, 2020, dev time < 2hrs

= 1.0.3 =

* NEW: Security - added esc_html() function to get_the_title() in comments.php
* NEW: Feature - added support for the Quick Summary plugin and hooked to featherlite_entry_title_after action on singular template.
* NEW: Feature - added support for the Classic Menu Labels plugin

Dec. 27, 2019, dev time > 2hrs

= 1.0.2 =
* New: Added a fullwidth widget area to the main header
* Tweak: Added `title="toggle"` to both Primary and Secondary menu toggle buttons.
* New: Added an additional action hook below the post title to allow for additional content.
* Tweak: Footer credits to reflect ClassicPress with a link as the CMS in use
* New: Added filter to Primary navigation menu to allow for aligment on the menu class to be filtered by child themes and/or plugins
* New: Added support for Quad Menu (Mega menu plugin).
* Fix: Fixed bug where mobile menu was not working in a child theme.
* New: Added support for the Components Page Builder plugin
* New: Added language files

= 1.0.1 =
* Minor non breaking changes.
* Fixed: Navigation menu too far left on widescreens
* Fixed: Lack of padding to content area on medium screens

= Version 1.0.0 =
* Initial Release