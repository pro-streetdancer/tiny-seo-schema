<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'type'     => 'Textarea',
		'id'       => 'code',
		'rows'     => 10,
		'label'    => 'JSON-LD code',
		'required' => true,
		'tooltip'  => __( 'Enter a valid JSON-LD code for a schema. You can insert dynamic variables if needed.', 'slim-seo-schema' ),
	],
];
