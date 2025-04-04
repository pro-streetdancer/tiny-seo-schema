<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/faqpage',
		'show' => true,
	],
	[
		'label'            => __( 'Questions', 'slim-seo-schema' ),
		'id'               => 'mainEntity',
		'type'             => 'Group',
		'required'         => true,
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Question', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'Question',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Question', 'slim-seo-schema' ),
				'type'     => 'Text',
				'required' => true,
				'tooltip'  => __( 'The full text of the question', 'slim-seo-schema' ),
			],
			[
				'id'       => 'acceptedAnswer',
				'label'    => __( 'Answer', 'slim-seo-schema' ),
				'type'     => 'Group',
				'required' => true,
				'tooltip'  => __( 'The answer to the question. There must be one answer per question', 'slim-seo-schema' ),
				'fields'   => [
					[
						'id'       => '@type',
						'std'      => 'Answer',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'       => 'text',
						'type'     => 'Textarea',
						'required' => true,
					],
				],
			],
		],
	],
];
