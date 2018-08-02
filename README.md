# Disclaimers #
**Contributors:**      inn_nerds  
**Donate link:**       https://labs.inn.org  
**Tags:**  
**Requires at least:** 4.4  
**Tested up to:**      4.9.7  
**Stable tag:**        0.1.1  
**License:**           GPLv2 or later  
**License URI:**       http://www.gnu.org/licenses/gpl-2.0.html  

Display disclaimers for posts or your whole site using a handy widget.

## Description ##

This plugin implements a widget allowing you to display disclaimers. Disclaimers can be set on a site-wide basis or on a per-post basis, with per-post disclaimers overriding site-wide disclaimers.

This plugin derives from work done on the [Largo theme for WordPress](https://largo.inn.org/). We've taken a small portion of Largo's functionality and made it accessible to all WordPress sites.

## Installation ##

We recommend installing this plugin through the WordPress.org plugin repository via the WordPress dashboard. For more information about this process, [see the WordPress Codex article on managing plugins](https://codex.wordpress.org/Managing_Plugins).

### Manual Installation ###

0. Download this plugin from [WordPress.org's plugin repository](https://wordpress.org/plugins/disclaimers/) or [from the Disclaimers GitHub repository releases page](https://github.com/INN/disclaimers/releases/).
1. Unzip the downloaded file and then upload the entire `/disclaimers` directory to your site's `/wp-content/plugins/` directory.
2. Activate Disclaimers through the 'Plugins' menu in the WordPress dashboard, or with [`wp plugin activate disclaimers`](https://developer.wordpress.org/cli/commands/plugin/activate/).

## Frequently Asked Questions

### Is this compatible with Largo?

A future release of [the Largo theme](https://largo.inn.org/) will include compatibility for this plugin. That release will also remove Largo's own built-in disclaimers functionality in favor of this plugin's feature set. Existing per-post and sitewide disclaimers will continue to display, though you may need to replace the widgets on your site.

## Screenshots

For screenshots of this plugin in action, see [the release announcement blog post](https://labs.inn.org/2018/08/02/plugin-release-disclaimers/).


## Changelog ##

### 0.1.1

- Fixes a bug where the sitewide disclaimer would not show in the widget.
- Fixes disclaimer/disclosure wording confusion

### 0.1.0

The first release of this plugin, containing:

* Site-wide standard disclosure settings in the site's **Settings > Disclosures** menu entry
* Per-post disclosure settings
* A widget to display each post's disclosures
