# Twig Plugin for Kirby CMS

A simple plugin to use the [Twig](http://twig.sensiolabs.org/) template engine with [Kirby](http://getkirby.com/).

:warning: This plugin is in beta and currently only works with Kirby 1.

## Installation

Use [Composer](https://getcomposer.org/) to install this plugin into the site plugins directory. 

To use this plugin in a project, define the repository and require it.

```json
{
	"repositories": [
		{
			"type": "vcs",
			"url": "https://github.com/matthewspencer/kirby-twig-plugin"
		}
	],
	"require": {
		"matthewspencer/kirby-twig-plugin": "dev-master",
		"composer/installers": "~1.0"
	},
	"extra": {
		"installer-paths": {
			"site/plugins/{$name}/": ["type:kirby-plugin"]
		}
	},
	"minimum-stability": "dev"
}
```

## Configuration 

Set `root.vendor`, `root.twig`, and `twig.file.extension` in config.php.

```php
c::set('root.vendor', c::get('root') . '/vendor');
c::set('root.twig', c::get('root.site') . '/twig');
c::set('twig.file.extension', 'twig');
```

## Usage

The template files in the Kirby templates directory handle passing the data to the appropriate Twig template. The following is an example of the default.php template.

```php
// use twig template name based on php template name
$template = $page->template() . '.' . c::get('twig.file.extension');

// pass an array of data to the twig template
echo $twig->render(
	$template, 
	array(
		'site' => $site,
		'page' => array(
			'title' => $page->title,
			'template' => $page->template(),
			'text' => kirbytext($page->text()),
		),
	)
);
```

The above PHP passes data to a default.twig in the twig directory that was set in the config.

```twig
{% extends "base.twig" %}

{% block content %}

<section class="content">
	<article>
		<h1>{{ page.title }}</h1>
		{{ page.text }}
	</article>
</section>

{% endblock %}
```
