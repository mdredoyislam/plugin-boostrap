=== Pixoten Addons ===
Contributors: pixoten  
Tags: addons, custom addons, frontend features, admin tools  
Requires at least: 5.8  
Tested up to: 6.5  
Requires PHP: 5.6.20  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Pixoten Addons enhances your WordPress site with powerful admin tools and frontend features using a lightweight and modular structure.

== Description ==

Pixoten Addons is a lightweight plugin designed to extend WordPress functionality both in the frontend and admin areas. Whether you're an admin managing content or a developer looking to build scalable features, this plugin provides a clean architecture and asset management system to make your development seamless.

**Key Features:**

- Clean and modular codebase  
- Loads scripts and styles using a dedicated assets manager  
- Handles AJAX requests in a separate class  
- Separated admin and frontend logic for better performance  
- Built-in activation handler for setting up initial configurations  

Perfect for extending your site’s capabilities without relying on bloated page builders or complex third-party tools.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory or install it directly through the WordPress admin dashboard.  
2. Activate the plugin through the 'Plugins' screen in WordPress.  
3. The plugin will automatically set up required assets and functionality.

== Frequently Asked Questions ==

= Does this plugin add frontend features? =  
Yes, Pixoten Addons includes a frontend class to load and manage any public-facing features you define.

= Is it safe to use on a live site? =  
Absolutely. The plugin uses best practices, and activation tasks are handled cleanly with no risk to existing data.

= Can I extend the plugin functionality? =  
Yes. The plugin uses an object-oriented and modular structure, making it easy for developers to add new features.

== Screenshots ==

1. Admin and frontend logic separated clearly in structure
2. Clean file organization for maintainability

== Changelog ==

= 1.0 =
* Initial release
* Structured OOP-based plugin loader
* Separate classes for Assets, Admin, Frontend, Ajax, and Installer

== Upgrade Notice ==

= 1.0 =
Initial release of Pixoten Addons

== Credits ==

Crafted with care by [Pixoten](https://pixoten.com/)

== License ==

This plugin is licensed under the GPLv2 or later.
