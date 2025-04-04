<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'       => '@id',
		'type'     => 'Hidden',
		'std'      => '{{ site.url }}#{{ id }}',
		'required' => true,
	],
	[
		'id'       => 'target',
		'type'     => 'Hidden',
		'required' => true,
		'std'      => esc_url( home_url( '/' ) ) . '?s={search_term_string}',
	],
	[
		'id'       => 'query-input',
		'type'     => 'Hidden',
		'required' => true,
		'std'      => 'required name=search_term_string',
	],
];
