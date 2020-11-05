<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: General
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'general-style',
		'title'	=> 'Style'
	),
	array(
		'id'	=> 'general-custom-css',
		'title'	=> 'Custom Stylesheet',
	),
	array(
		'id'	=> 'general-favicon',
		'title'	=> 'Favicon'
	),
	array(
		'id'	=> 'general-rss-feed',
		'title'	=> 'RSS Feed'
	),
	array(
		'id'	=> 'general-analytics',
		'title'	=> 'Analytics'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Style
/*-------------------------------------------------------*/

// Theme Styles
$fields[] = array(
	'id'		=> 'style',
	'label'		=> 'Name',
	'section'	=> 'general-style',
	'type'		=> 'select',
	'choices'	=> air_get_theme_styles()
);

// Responsive
$fields[] = array(
	'id'		=> 'disable-responsive',
	'label'		=> 'Responsive',
	'section'	=> 'general-style',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-responsive' => 'Disable',
	)
);

/* Custom CSS
/*-------------------------------------------------------*/

// Enable Custom Stylesheet
$fields[] = array(
	'id'		=> 'custom-css',
	'label'		=> 'Enable',
	'section'	=> 'general-custom-css',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'custom-css' => 'Enable custom stylesheet [ <strong>custom.css</strong> ]',
	)
);

/* Favicon
/*-------------------------------------------------------*/

// Favicon
$fields[] = array(
	'id'		=> 'favicon',
	'label'		=> 'Favicon',
	'section'	=> 'general-favicon',
	'type'		=> 'image'
);

/* Feed URL
/*-------------------------------------------------------*/

// Feed URL
$fields[] = array(
	'id'		=> 'feed-url',
	'label'		=> 'Feed URL',
	'section'	=> 'general-rss-feed',
	'type'		=> 'url',
	'class'		=> 'regular-text'
);

/* Analytics
/*-------------------------------------------------------*/

// Analytics Script Location
$fields[] = array(
	'id'		=> 'analytics-location',
	'label'		=> 'Script Location',
	'section'	=> 'general-analytics',
	'type'		=> 'radio',
	'choices'	=> array(
		'header' => 'Header',
		'footer' => 'Footer'
	),
	'vertical'	=> FALSE
);

// Analytics Script
$fields[] = array(
	'id'		=> 'analytics-script',
	'label'		=> 'Analytics Script',
	'section'	=> 'general-analytics',
	'type'		=> 'textarea',
	'rows'		=> '4'
);
