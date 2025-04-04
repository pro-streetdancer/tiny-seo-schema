<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return array_merge( [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/video',
		'show' => true,
	],
], Helper::get_property( 'VideoObject' )['fields'] );
