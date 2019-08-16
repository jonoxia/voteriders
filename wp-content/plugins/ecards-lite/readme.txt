=== eCards Lite ===
Contributors: butterflymedia
Tags: akismet, ecard, electronic card, flash card, greeting card, paypal, postcard
Requires at least: 4.8
Tested up to: 5.1.1
Requires PHP: 5.6
Stable tag: 4.1.6
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==
eCards is a WordPress plugin used to send electronic cards to friends. It can be implemented in a page, a post or the sidebar.

There are two ways you can use this plugin:

1. Add the shortcode `[ecard]` to a post or a page;
2. Call the function from a template file: `<?php if(function_exists('display_ecardMe')) echo display_ecardMe(); ?>`;
3. Use the shortcode `[ecard_counter]` to display the number of eCards sent;
4. Call the function from a template file: `<?php if(function_exists('display_ecardCounter')) echo display_ecardCounter(); ?>`.

== Installation ==

1. Upload the `ecards-lite` folder to your `/wp-content/plugins/` directory
2. Activate the plugin via the Plugins menu in WordPress
3. Create and publish a new page/post and add this shortcode: `[ecard]`
4. A new eCards menu will appear in WordPress Settings with options and general help

== Screenshots ==

1. eCards Settings
2. eCards Email Settings
3. eCards Restrictions and Payment
4. eCards Labels
5. eCards Dashboard/Help/Usage

== Changelog ==

= 4.1.6 =
* UPDATE: Updated PHP requirements
* UPDATE: Updated WordPress compatibility

= 4.1.5 =
* UPDATE: Updated WordPress compatibility

= 4.1.4 =
* UPDATE: Updated WordPress compatibility
* UPDATE: Removed theme selector

= 4.1.3 =
* FIX: Fixed incorrect function

= 4.1.2 =
* FIX: Fixed email sending

= 4.1.1 =
* FIX: Fixed wrong filename

= 4.1 =
* FIX: Fixed license information
* FIX: Fixed SMTP plugin link
* UPDATE: Synchronized plugin with paid one
* UPDATE: Removed references to obsolete theme

= 4.0.5 =
* FIX: Fixed large image size being hardcoded to thumbnail
* FIX: Code formatting fixes for PSR compliance

= 4.0.4 =
* UPDATE: Grouped several developer-only settings
* FIX: Fixed checkboxes not being unchecked

= 4.0.2 =
* FIX: Added stripslashes() to message content
* UPDATE: Added success message to labels list

= 4.0.1 =
* UPDATE: All emails now include the selected eCard as an image attachments
* UPDATE: Removed orphaned code from the paid version

= 4.0.0 =
* FIX: Removed deprecated phrase from the Diagnostics tab
* FIX: Added HTML content type fix and grouped debugging options together
* FIX: Fixed formatting and line breaks for eCard content
* UPDATE: Synchronized with the paid version

= 3.8.1 =
* FIX: Performance fixes

= 3.8.0 =
* FEATURE: New onboarding tab
* UPDATE: More third-party recommendations
* UPDATE: More contextual help
* GENERAL: Code cleanup
* GENERAL: Version synchronisation (with PRO version)

= 3.7.2 =
* UI: Added labels for form fields and moved them above
* UI: Admin style fixes

= 3.7.1 =
* FIX: Fixed conflict with old, undeleted file

= 3.7.0 =
* UPDATE: Removed included languages and moved to WordPress.org translations

= 3.6.2 =
* FIX: Removed empty attachments field from wp_mail()
* FIX: Fixed content restriction logic
* UPDATE: Updated compatibility
* UPDATE: Updated readme.txt URLs
* UPDATE: Better i18n handling
* UPDATE: Better security (directory scanning)

= 3.6.1 =
* FIX: Fixed subject line escaping quotes
* FIX: Fixed image size not being applied to the <a> element
* FIX: Fixed individual image not being sent
* FIX: Added option autoloading for better performance
* FIX: Fixed a "headers already sent" error
* FIX: Removed EOLs for PHP files in order to fix some rare server behaviour
* FEATURE: Added shortcodes to email subject
* UPDATE: Updated wording for eCards UI theme
* UPDATE: Checked latest WordPress compatibility
* UPDATE: Added utf8mb4 database table conversion

= 3.2.1 =
* FIX: Fixed encoding issue

= 3.2.0 =
* FEATURE: Added dedicated email address
* FEATURE: Added Reply-To header for emails

= 3.1.0 =
* FIX: Fixed include() syntax
* FIX: Removed unused global variable
* FIX: Renamed main plugin file for WordPress actions compatibility
* IMPROVEMENT: Reduced number of requests by moving function calls to plugins_loaded
* IMPROVEMENT: Removed unused options deletion

= 3.0.4 =
* FEATURE: Updated WordPress compatibility

= 3.0.3 =
* FEATURE: Added WordPress plugin repository assets and screenshots

= 3.0.2 =
* SECURITY: Sanitized all options

= 3.0.1 =
* IMPROVEMENT: Removed radio button if there is only one image

= 3.0.0 =
* NEW: First public release
* FIX: Removed link from the labels tab
* FIX: Added missing update notice
* FIX: Fixed missing image size from PayPal shortcode
* FEATURE: Added PRO/LITE version
