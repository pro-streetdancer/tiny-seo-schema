<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'schemaDocs',
		'type' => 'SchemaDocs',
		'url'  => 'https://schema.org/Thing',
		'show' => true,
	],
	[
		'id'       => 'name',
		'label'    => __( 'Name', 'slim-seo-schema' ),
		'tooltip'  => __( 'The name of the item', 'slim-seo-schema' ),
		'required' => true,
	],
	[
		'id'      => 'alternateName',
		'label'   => __( 'Alternate name', 'slim-seo-schema' ),
		'tooltip' => __( 'An alias for the item', 'slim-seo-schema' ),
	],
	[
		'id'      => 'description',
		'label'   => __( 'Description', 'slim-seo-schema' ),
		'tooltip' => __( 'A description of the item', 'slim-seo-schema' ),
	],
	[
		'id'      => 'identifier',
		'label'   => __( 'Identifier', 'slim-seo-schema' ),
		'tooltip' => __( 'The identifier property represents any kind of identifier for any kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'image',
		'label'   => __( 'Image', 'slim-seo-schema' ),
		'tooltip' => __( 'An image of the item', 'slim-seo-schema' ),
	],
	Helper::get_property( 'mainEntityOfPage', [
		'show' => false,
	] ),
	[
		'id'      => 'sameAs',
		'label'   => __( 'Same as', 'slim-seo-schema' ),
		'tooltip' => __( 'URL of a reference Web page that unambiguously indicates the item\'s identity. E.g. the URL of the item\'s Wikipedia page, Wikidata entry, or official website.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'url',
		'label'   => __( 'URL', 'slim-seo-schema' ),
		'tooltip' => __( 'URL of the item', 'slim-seo-schema' ),
	],
];
