# BS Theme

A basic starter theme for WordPress and ClassicPress.

![WordPress tested on version 5.2.3](https://img.shields.io/badge/WordPress-5.2.3-0073aa.svg?style=flat-square)
![ClassicPress tested on version 1.0.1](https://img.shields.io/badge/ClassicPress-1.0.1-03768e.svg?style=flat-square)
![PHP tested on version 7.3](https://img.shields.io/badge/PHP-tested%207.3-8892bf.svg?style=flat-square)
![ACF Pro Ready](https://img.shields.io/badge/ACF%20Pro-ready-00d3ae.svg?style=flat-square)
![Gutenberg Ready](https://img.shields.io/badge/Gutenberg-ready-00a0d2.svg?style=flat-square)

See [BS Plugin](https://github.com/ControlledChaos/bs-plugin) for a basic WordPress/ClassicPress starter plugin.

![BS Theme Screenshot](https://raw.githubusercontent.com/ControlledChaos/bs-theme/master/screenshot.jpg)

## Nothing Fancy

This theme began life as a copy of the [_s (Underscores)](https://underscores.me/) starter theme. We have added schema attributes and slightly modified the CSS files.

Some sample block editor styles are loaded, some functions are provided to check for Advanced Custom Fields and for ClassicPress.

## Requirements

* This theme was written in a WordPress 5.0+ environment with no concern for backwards compatitbility.
* This theme was written on a local server running PHP 7.2
* The short array syntax ( `[]` rather than `array()` ) requires PHP 5.4+
* Function files are namespaced and must be called accordingly in template parts.

## Extras

* Has a sample theme options page ready to begin developing.
* Has a the info page as an example for getting theme data.

## Renaming, Rebranding, and Defaults

Following is a list of strings to find and replace in all theme files.

1. Plugin name  
   Find `BS_Theme` and replace with your theme name, include underscores between words. This will change the namespace and the package name in file headers.

2. Text domain  
   Find `bs-theme` and replace with the text domain of your theme.

3. Constant prefix  
   Find `BST` and replace with the uppercase prefix of your theme.

4. Author  
   Find `Controlled Chaos Design <greg@ccdzine.com>` and replace with your name and email address or those of your organization.

5. Header image  
   Find the default header image file, `default-header.jpg`, in the `assets/images/` directory and replace with your default image.

6. Activation and deactivation  
   Check the activation and deactivation classes, `includes/class-activate` and `includes/class-deactivate`, for sample methods. Remove or modify the samples as needed.

7. README file  
   Whether or not your theme will be kept in a version control repository, edit the content of the README file in the theme's root directory or delete it if it is not necessary.
