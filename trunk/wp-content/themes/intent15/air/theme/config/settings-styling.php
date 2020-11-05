<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: 
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'styling-advanced',
		'title'	=> 'Advanced Styling'
	),
	array(
		'id'	=> 'styling-color',
		'title'	=> 'Theme Color',
	),
	array(
		'id'	=> 'styling-header',
		'title'	=> 'Header'
	),
	array(
		'id'	=> 'styling-subheader',
		'title'	=> 'Subheader'
	),
	array(
		'id'	=> 'styling-body',
		'title'	=> 'Body'
	),
	array(
		'id'	=> 'styling-footer',
		'title'	=> 'Footer'
	),
	array(
		'id'	=> 'styling-misc',
		'title'	=> 'Miscellaneous'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Advanced Styling
/*-------------------------------------------------------*/

// Enable advanced styling
$fields[] = array(
	'id'		=> 'advanced-css',
	'label'		=> 'Enable to use',
	'section'	=> 'styling-advanced',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'advanced-css' => '<strong>Enable styling options</strong> <small>(style-advanced.css)</small>'
	)
);

/* Theme Color
/*-------------------------------------------------------*/

// Color 1
$fields[] = array(
	'id'			=> 'styling-color-1',
	'label'			=> 'Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> '00a8e8'
);

/* Header
/*-------------------------------------------------------*/

// Header Text Color
$fields[] = array(
	'id'			=> 'styling-header-text-color',
	'label'			=> 'Text Color',
	'section'		=> 'styling-header',
	'type'			=> 'colorpicker',
	'placeholder'	=> ''
);

// Header BG Color
$fields[] = array(
	'id'			=> 'styling-header-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-header',
	'type'			=> 'colorpicker',
	'placeholder'	=> 'ffffff'
);

// Header BG Image
$fields[] = array(
	'id'		=> 'styling-header-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-header',
	'type'		=> 'image'
);

// Header BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-header-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-header',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Subheader
/*-------------------------------------------------------*/

// Subheader BG Color
$fields[] = array(
	'id'			=> 'styling-subheader-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-subheader',
	'type'			=> 'colorpicker',
	'placeholder'	=> '333333'
);

// Subheader BG Image
$fields[] = array(
	'id'		=> 'styling-subheader-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-subheader',
	'type'		=> 'image'
);

// Subheader BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-subheader-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-subheader',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Body
/*-------------------------------------------------------*/

// Body BG Color
$fields[] = array(
	'id'			=> 'styling-body-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-body',
	'type'			=> 'colorpicker',
	'placeholder'	=> 'fcfcfc'
);

// Body BG Image
$fields[] = array(
	'id'		=> 'styling-body-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-body',
	'type'		=> 'image'
);

// Body BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-body-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-body',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Footer
/*-------------------------------------------------------*/

// Footer BG Color
$fields[] = array(
	'id'			=> 'styling-footer-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-footer',
	'type'			=> 'colorpicker',
	'placeholder'	=> '222222'
);

// Footer BG Image
$fields[] = array(
	'id'		=> 'styling-footer-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-footer',
	'type'		=> 'image'
);

// Footer BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-footer-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-footer',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);

/* Misc
/*-------------------------------------------------------*/

// Shadows 1
$fields[] = array(
	'id'		=> 'styling-misc-shadows-1',
	'label'		=> 'Subheader & Footer Shadows',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-shadows-1'=> 'Disable'
	)
);
$fields[] = array(
	'id'		=> 'styling-misc-shadows-2',
	'label'		=> 'Header & Subfooter Shadows',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-shadows-2'=> 'Disable'
	)
);

// Misc Vertical Images (Gallery)
$fields[] = array(
	'id'		=> 'styling-misc-vertical-image',
	'label'		=> 'Gallery Image Height',
	'section'	=> 'styling-misc',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'styling-misc-vertical-image' => 'Limit vertical image height in galleries to 700px'
	)
);