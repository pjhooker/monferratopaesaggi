<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Header
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'header-custom-logo',
		'title'	=> 'Custom Logo'
	),
	array(
		'id'	=> 'header-tagline',
		'title'	=> 'Tagline',
	),
	array(
		'id'	=> 'header-search',
		'title'	=> 'Search Field'
	),
	array(
		'id'	=> 'header-archive-heading',
		'title'	=> 'Archive Heading'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Custom Logo
/*-------------------------------------------------------*/

// Custom Logo URL
$fields[] = array(
	'id'		=> 'custom-logo',
	'label'		=> 'Logo URL',
	'section'	=> 'header-custom-logo',
	'type'		=> 'image'
);

/* Tagline
/*-------------------------------------------------------*/

// Disable Tagline
$fields[] = array(
	'id'		=> 'disable-tagline',
	'label'		=> 'Disable',
	'section'	=> 'header-tagline',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-tagline' => 'Disable tagline (site description)'
	)
);

/* Subheader
/*-------------------------------------------------------*/

// Disable blog subheader
$fields[] = array(
	'id'		=> 'disable-search',
	'label'		=> 'Disable',
	'section'	=> 'header-search',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-search' => 'Disable search field'
	)
);


/* Archive Heading
/*-------------------------------------------------------*/

// Disable archive heading
$fields[] = array(
	'id'		=> 'disable-archive-heading',
	'label'		=> 'Disable',
	'section'	=> 'header-archive-heading',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-archive-heading' => 'Disable archive heading'
	)
);
