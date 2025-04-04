<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	Helper::get_property( 'name', [
		'required' => true,
		'std'      => '{{ post.title }}',
		'tooltip'  => __( 'The name of the service.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'aggregateRating', [
		'tooltip' => __( 'The overall rating, based on a collection of reviews or ratings, of the item.', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'areaServed',
		'label'   => __( 'Area served', 'slim-seo-schema' ),
		'tooltip' => __( 'The geographic area where a service is provided.', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'label'   => __( 'Audience', 'slim-seo-schema' ),
		'id'      => 'audience',
		'tooltip' => __( 'An intended audience, i.e. a group for whom something was created.', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'id'      => 'alternateName',
		'label'   => __( 'Alternate Name', 'slim-seo-schema' ),
		'tooltip' => __( 'An alias for the service.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'availableChannel',
		'label'   => __( 'Available channel', 'slim-seo-schema' ),
		'tooltip' => __( 'A means of accessing the service ( e.g. a phone bank, a web site, a location, etc. )', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'ServiceChannel',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'show'    => true,
				'tooltip' => __( 'The name of the item.', 'slim-seo-schema' ),
			] ),
			Helper::get_property( 'description', [
				'tooltip' => __( 'A description of the item.', 'slim-seo-schema' ),
			] ),
			[
				'label'   => __( 'Available language', 'slim-seo-schema' ),
				'id'      => 'availableLanguage',
				'tooltip' => __( 'A language someone may use with or at the item. Use language codes from the IETF BCP 47 standard.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'      => 'award',
		'label'   => __( 'Award', 'slim-seo-schema' ),
		'tooltip' => __( 'An award won by or for this service.', 'slim-seo-schema' ),
	],
	[
		'label'            => __( 'Brand', 'slim-seo-schema' ),
		'id'               => 'brand',
		'tooltip'          => __( 'The brand(s) associated with the service.', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Brand', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'Brand',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'std'      => '{{ site.title }}',
				'required' => true,
			],
			[
				'label'   => __( 'Logo', 'slim-seo-schema' ),
				'id'      => 'logo',
				'tooltip' => __( 'Link to logo associated with the brand.', 'slim-seo-schema' ),
				'type'    => 'Image',
				'show'    => true,
			],
			Helper::get_property( 'url', [
				'show'    => true,
				'tooltip' => __( 'The URL of the brand.', 'slim-seo-schema' ),
			] ),
		],
	],
	[
		'id'          => 'broker',
		'label'       => __( 'Broker', 'slim-seo-schema' ),
		'tooltip'     => __( 'An entity that arranges for an exchange between a buyer and a seller', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person or an Organization schema and link to this property via a dynamic variable', 'slim-seo-schema' ),
	],
	[
		'label'   => __( 'Category', 'slim-seo-schema' ),
		'id'      => 'category',
		'tooltip' => __( 'A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.', 'slim-seo-schema' ),
		'show'    => true,
	],
	Helper::get_property( 'description', [
		'tooltip' => __( 'A description of the service.', 'slim-seo-schema' ),
	] ),
	[
		'label'   => __( 'Disambiguating description', 'slim-seo-schema' ),
		'id'      => 'disambiguatingDescription',
		'tooltip' => __( 'A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'hasOfferCatalog',
		'label'   => __( 'Has offer catalog', 'slim-seo-schema' ),
		'tooltip' => __( 'Indicates an OfferCatalog listing for this Organization, Person, or Service.', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'OfferCatalog',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'show'    => true,
				'tooltip' => __( 'The name of the item.', 'slim-seo-schema' ),
			] ),
			Helper::get_property( 'description', [
				'tooltip' => __( 'A description of the item.', 'slim-seo-schema' ),
			] ),
			[
				'label'    => __( 'Item list element', 'slim-seo-schema' ),
				'id'       => ' itemListElement',
				'required' => true,
			],
			[
				'label'    => __( 'Item list order', 'slim-seo-schema' ),
				'id'       => 'itemListOrder',
				'tooltip'  => __( 'Type of ordering (e.g. Ascending, Descending, Unordered).', 'slim-seo-schema' ),
				'required' => true,
			],
			[
				'label'   => __( 'Number of items', 'slim-seo-schema' ),
				'id'      => 'numberOfItems',
				'tooltip' => __( 'The number of items in an item list. Note that some descriptions might not fully describe all items in a list (e.g., multi-page pagination); in such cases, the number of items would be for the entire list.', 'slim-seo-schema' ),
				'show'    => true,
			],
		],
	],
	Helper::get_property( 'OpeningHoursSpecification', [
		'id'               => 'hoursAvailable',
		'label'            => __( 'Hours available', 'slim-seo-schema' ),
		'tooltip'          => __( 'The hours during which this service or contact is available.', 'slim-seo-schema' ),
		'cloneItemHeading' => __( 'Hours available', 'slim-seo-schema' ),
		'show'             => true,
	] ),
	[
		'label'            => __( 'Is related to', 'slim-seo-schema' ),
		'id'               => 'isRelatedTo',
		'tooltip'          => __( 'A pointer to another, somehow related product or service (or multiple ones).', 'slim-seo-schema' ),
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Product', 'slim-seo-schema' ),
		'description'      => __( 'Please create a Product or Service schema and link to this property via a dynamic variable', 'slim-seo-schema' ),
	],
	[
		'id'      => 'identifier',
		'label'   => __( 'Identifier', 'slim-seo-schema' ),
		'tooltip' => __( 'The external or other ID that unambiguously identifies this edition. Such as ISBNs, GTIN codes, UUIDs etc. Multiple identifiers are allowed.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'image', [
		'tooltip' => __( 'An image of the service.', 'slim-seo-schema' ),
		'show'    => true,
	] ),
	[
		'label'   => __( 'Logo', 'slim-seo-schema' ),
		'id'      => 'logo',
		'tooltip' => __( 'Link to logo associated with the service.', 'slim-seo-schema' ),
	],
	[
		'id'               => 'offers',
		'label'            => __( 'Offers', 'slim-seo-schema' ),
		'tooltip'          => __( 'An offer to provide this item — for exp, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event.', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Offer', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'Offer',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'      => 'category',
				'label'   => __( 'Category', 'slim-seo-schema' ),
				'type'    => 'DataList',
				'tooltip' => __( 'The category of the costs that are related to the program.', 'slim-seo-schema' ),
				'show'    => true,
				'options' => [
					'Total Cost'              => __( 'Total Cost', 'slim-seo-schema' ),
					'Tuition'                 => __( 'Tuition', 'slim-seo-schema' ),
					'In-state'                => __( 'In-state', 'slim-seo-schema' ),
					'Out-of-state'            => __( 'Out-of-state', 'slim-seo-schema' ),
					'In-district'             => __( 'In-district', 'slim-seo-schema' ),
					'Out-of-district'         => __( 'Out-of-district', 'slim-seo-schema' ),
					'CostPerCredit'           => __( 'CostPerCredit', 'slim-seo-schema' ),
					'CostPerTerm'             => __( 'CostPerTerm', 'slim-seo-schema' ),
					'Program Fees'            => __( 'Program Fees', 'slim-seo-schema' ),
					'Books and Supplies Fees' => __( 'Books and Supplies Fees', 'slim-seo-schema' ),
					'Uniform Fees'            => __( 'Uniform Fees', 'slim-seo-schema' ),
					'Activities Fees'         => __( 'Activities Fees', 'slim-seo-schema' ),
					'Technology Fees'         => __( 'Technology Fees', 'slim-seo-schema' ),
					'Other Fees'              => __( 'Other Fees', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'priceSpecification',
				'type'     => 'Group',
				'required' => true,
				'fields'   => [
					[
						'id'       => '@type',
						'std'      => 'PriceSpecification',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'       => 'price',
						'label'    => __( 'Price', 'slim-seo-schema' ),
						'tooltip'  => __( 'The price amount for the specified offer.', 'slim-seo-schema' ),
						'required' => true,
					],
					[
						'id'       => 'priceCurrency',
						'label'    => __( 'Price currency', 'slim-seo-schema' ),
						'tooltip'  => __( 'The currency of the price for the specified offer.', 'slim-seo-schema' ),
						'required' => true,
					],
				],
			],
		],
	],
	[
		'label'       => __( 'Provider', 'slim-seo-schema' ),
		'id'          => 'provider',
		'tooltip'     => __( 'The service provider, service operator, or service performer; the goods producer.', 'slim-seo-schema' ),
		'description' => __( 'Please create a Person or an Organization schema and link to this property via a dynamic variable', 'slim-seo-schema' ),
	],
	[
		'label'   => __( 'Provider mobility', 'slim-seo-schema' ),
		'id'      => ' providerMobility',
		'tooltip' => __( 'Indicates the mobility of a provided service (e.g. \'static\', \'dynamic\').', 'slim-seo-schema' ),
	],
	Helper::get_property( 'Review' ),
	[
		'id'      => 'sameAs',
		'label'   => __( 'Same as', 'slim-seo-schema' ),
		'tooltip' => __( 'URL of a reference Web page that unambiguously indicates the service identity. E.g. the URL of the item\'s Wikipedia page, Wikidata entry, or official website.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'serviceOutput',
		'label'   => __( 'Service output', 'slim-seo-schema' ),
		'tooltip' => __( 'The tangible thing generated by the service, e.g. a passport, permit.', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'Thing',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'required' => true,
			],
		],
	],
	[
		'label'   => __( 'Service type', 'slim-seo-schema' ),
		'id'      => 'serviceType',
		'tooltip' => __( 'The type of service being offered, e.g. veterans\' benefits, emergency relief, etc.', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'label'   => __( 'Slogan', 'slim-seo-schema' ),
		'id'      => 'slogan',
		'tooltip' => __( 'A slogan or motto associated with the service.', 'slim-seo-schema' ),
	],
	[
		'label'   => __( 'Terms of service (URL)', 'slim-seo-schema' ),
		'id'      => 'termsOfService',
		'tooltip' => __( 'Human-readable terms of service documentation (URL)', 'slim-seo-schema' ),
		'show'    => true,
	],
	Helper::get_property( 'url', [
		'tooltip' => __( 'URL of the service.', 'slim-seo-schema' ),
		'show'    => true,
		'std'     => '{{ post.url }}',
	] ),
	Helper::get_property( 'mainEntityOfPage' ),
];
