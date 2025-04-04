<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'       => 'contentURL',
		'type'     => 'Image',
		'label'    => __( 'URL', 'slim-seo-schema' ),
		'tooltip'  => __( 'A URL to the actual image', 'slim-seo-schema' ),
		'std'      => '{{ post.thumbnail }}',
		'required' => true,
	],
	[
		'id'      => 'contentSize',
		'label'   => __( 'Size', 'slim-seo-schema' ),
		'tooltip' => __( 'File size in (mega/kilo) bytes', 'slim-seo-schema' ),
	],
	[
		'id'      => 'caption',
		'label'   => __( 'Caption', 'slim-seo-schema' ),
		'tooltip' => __( 'The caption for this object', 'slim-seo-schema' ),
	],
	[
		'id'      => 'thumbnail',
		'label'   => __( 'Thumbnail', 'slim-seo-schema' ),
		'tooltip' => __( 'Thumbnail image for an image or video', 'slim-seo-schema' ),
	],
	[
		'id'      => 'width',
		'label'   => __( 'Width', 'slim-seo-schema' ),
		'tooltip' => __( 'The width of the item', 'slim-seo-schema' ),
	],
	[
		'id'      => 'height',
		'label'   => __( 'Height', 'slim-seo-schema' ),
		'tooltip' => __( 'The height of the item', 'slim-seo-schema' ),
	],
	[
		'id'      => 'about',
		'label'   => __( 'About', 'slim-seo-schema' ),
		'tooltip' => __( 'The subject matter of the content', 'slim-seo-schema' ),
	],
	[
		'id'      => 'license',
		'label'   => __( 'License', 'slim-seo-schema' ),
		'tooltip' => __( 'A URL to a page that describes the license governing an image\'s use.', 'slim-seo-schema' ),
	],
];
