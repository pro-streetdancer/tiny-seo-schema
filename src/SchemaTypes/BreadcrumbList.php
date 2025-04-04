<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'       => 'name',
		'std'      => __( 'Breadcrumbs', 'slim-seo-schema' ),
		'type'     => 'Hidden',
		'required' => true,
	],
	[
		'id'       => '@type',
		'std'      => 'BreadcrumbList',
		'type'     => 'Hidden',
		'required' => true,
	],
	[
		'id'       => 'itemListElement',
		'type'     => 'Hidden',
		'std'      => '{{ current.breadcrumbs }}',
		'required' => true,
	],
];
