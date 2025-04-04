<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/book',
		'show' => true,
	],
	[
		'label'   => __( 'ID', 'slim-seo-schema' ),
		'id'      => '@id',
		'show'    => true,
		'std'     => '{{ post.url }}',
		'tooltip' => __( 'A globally unique ID for the book in URL format. It must be unique to your organization. The ID must be stable and not change over time.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The title of the book.', 'slim-seo-schema' ),
	] ),
	[
		'id'          => 'author',
		'label'       => __( 'Author', 'slim-seo-schema' ),
		'tooltip'     => __( 'The author(s) of the book.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person schema and link to this property via a dynamic variable.', 'slim-seo-schema' ),
		'std'         => '{{ schemas.person }}',
		'required'    => true,
	],
	Helper::get_property( 'url', [
		'show'    => true,
		'std'     => '{{ post.url }}',
		'tooltip' => __( 'The URL on your website where the book is introduced or described.', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'sameAs',
		'label'   => __( 'Same as', 'slim-seo-schema' ),
		'show'    => true,
		'tooltip' => __( 'The URL of a reference page that identifies the book. For example, a Wikipedia, Wikidata, VIAF, or Library of Congress page for the book.', 'slim-seo-schema' ),
	],
	[
		'id'               => 'workExample',
		'label'            => __( 'Editions', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Edition', 'slim-seo-schema' ),
		'required'         => true,
		'tooltip'          => __( 'The edition(s) of the book. There should be at least one edition.', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'Book',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'label'   => __( '@id', 'slim-seo-schema' ),
				'id'      => '@id',
				'show'    => true,
				'std'     => '{{ post.url }}',
				'tooltip' => __( 'A globally unique ID for the book in URL format. It must be unique to your organization. The ID must be stable and not change over time.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'bookFormat',
				'label'    => __( 'Book format', 'slim-seo-schema' ),
				'type'     => 'DataList',
				'required' => true,
				'std'      => 'https://schema.org/Hardcover',
				'options'  => [
					'https://schema.org/AudiobookFormat' => __( 'Audiobook format', 'slim-seo-schema' ),
					'https://schema.org/EBook'           => __( 'E-book', 'slim-seo-schema' ),
					'https://schema.org/Hardcover'       => __( 'Hard cover', 'slim-seo-schema' ),
					'https://schema.org/Paperback'       => __( 'Paper back', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'inLanguage',
				'required' => true,
				'label'    => __( 'In language', 'slim-seo-schema' ),
				'tooltip'  => __( 'The main language of the content in the edition. Use one of the two-letter codes from the list of ISO 639-1 alpha-2 codes.', 'slim-seo-schema' ),
				'std'      => 'en',
			],
			[
				'id'       => 'isbn',
				'required' => true,
				'label'    => __( 'ISBN', 'slim-seo-schema' ),
				'tooltip'  => __( 'The ISBN-13 of the edition.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'potentialAction',
				'label'    => __( 'Potential action', 'slim-seo-schema' ),
				'type'     => 'Group',
				'required' => true,
				'tooltip'  => __( 'The action to be triggered for users to purchase or download the book.', 'slim-seo-schema' ),
				'fields'   => [
					[
						'id'       => '@type',
						'type'     => 'DataList',
						'required' => true,
						'std'      => 'ReadAction',
						'options'  => [
							'BorrowAction' => __( 'Borrow action', 'slim-seo-schema' ),
							'ReadAction'   => __( 'Read action', 'slim-seo-schema' ),
						],
					],
				],
			],
			[
				'id'          => 'author',
				'label'       => __( 'Author', 'slim-seo-schema' ),
				'tooltip'     => __( 'The author(s) of the edition. Only use this when the author of the edition is different from the book author information.', 'slim-seo-schema' ),
				'description' => __( 'Please create a Person schema and link to this property via a dynamic variable', 'slim-seo-schema' ),
				'std'         => '{{ schemas.person }}',
			],
			[
				'id'      => 'bookEdition',
				'label'   => __( 'Book edition', 'slim-seo-schema' ),
				'tooltip' => __( 'The edition information of the book. For example, 2nd Edition.', 'slim-seo-schema' ),
			],
			[
				'label'   => __( 'Date published', 'slim-seo-schema' ),
				'id'      => 'datePublished',
				'tooltip' => __( 'The date of publication of the edition in YYYY-MM-DD or YYYY format.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'identifier',
				'label'   => __( 'Identifier', 'slim-seo-schema' ),
				'tooltip' => __( 'The external or other ID that unambiguously identifies this edition. Such as ISBNs, GTIN codes, UUIDs etc. Multiple identifiers are allowed.', 'slim-seo-schema' ),
				'type'    => 'Group',
				'fields'  => [
					[
						'id'       => '@type',
						'std'      => 'PropertyValue',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'       => 'propertyID',
						'required' => true,
						'std'      => 'OCLC_NUMBER',
						'label'    => __( 'Type', 'slim-seo-schema' ),
						'tooltip'  => __( 'The type of ID', 'slim-seo-schema' ),
						'type'     => 'DataList',
						'options'  => [
							'OCLC_NUMBER' => 'OCLC_NUMBER',
							'LCCN'        => 'LCCN',
							'JP_E-CODE'   => 'JP_E-CODE',
						],
					],
					[
						'id'       => 'value',
						'label'    => __( 'Value', 'slim-seo-schema' ),
						'tooltip'  => __( 'The ID value. The external ID that unambiguously identifies this edition. Remove all non-numeric prefixes of the external ID.', 'slim-seo-schema' ),
						'required' => true,
					],
				],
			],
			Helper::get_property( 'name', [
				'tooltip' => __( 'The title of the book.', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'sameAs',
				'label'   => __( 'Same as', 'slim-seo-schema' ),
				'show'    => true,
				'tooltip' => __( 'The URL of a reference page that identifies the book. For example, a Wikipedia, Wikidata, VIAF, or Library of Congress page for the book.', 'slim-seo-schema' ),
			],
			Helper::get_property( 'url', [
				'std'     => '{{ post.url }}',
				'tooltip' => __( 'The URL on your website where the book is introduced or described.', 'slim-seo-schema' ),
			] ),
		],
	],
	Helper::get_property( 'Review', [
		'show' => true,
	] ),
];
