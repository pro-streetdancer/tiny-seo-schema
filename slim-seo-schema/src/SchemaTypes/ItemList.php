<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/movie',
		'show' => true,
	],
	[
		'label'            => __( 'Movie List', 'slim-seo-schema' ),
		'id'               => 'itemListElement',
		'type'             => 'Group',
		'cloneable'        => true,
		'required'         => true,
		'cloneItemHeading' => __( 'Movie', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'ListItem',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'label'    => __( 'Position', 'slim-seo-schema' ),
				'id'       => 'position',
				'required' => true,
			],
			[
				'id'        => 'item',
				'type'      => 'Group',
				'cloneable' => false,
				'required'  => true,
				'fields'    => [
					[
						'id'       => '@type',
						'std'      => 'Movie',
						'type'     => 'Hidden',
						'required' => true,
					],
					Helper::get_property( 'image', [
						'cloneable' => false,
						'required'  => true,
						'tooltip'   => __( 'An image that represents the movie.', 'slim-seo-schema' ),
					] ),
					Helper::get_property( 'name', [
						'required' => true,
						'tooltip'  => __( 'The name of the movie.', 'slim-seo-schema' ),
					] ),
					Helper::get_property( 'aggregateRating' ),
					Helper::get_property( 'dateCreated', [
						'show'    => true,
						'tooltip' => __( 'The date the movie was released in ISO 8601 format.', 'slim-seo-schema' ),
						'std'     => '{{ post.date }}',
					] ),
					Helper::get_property( 'Person', [
						'show'    => true,
						'id'      => 'director',
						'label'   => __( 'Director', 'slim-seo-schema' ),
						'tooltip' => __( 'The director of the movie.', 'slim-seo-schema' ),
					] ),
					Helper::get_property( 'Review' ),
					Helper::get_property( 'url', [
						'tooltip'  => __( 'The link to the movie.', 'slim-seo-schema' ),
						'std'      => '{{ post.url }}',
						'required' => true,
					] ),
				],
			],
		],
	],
];
