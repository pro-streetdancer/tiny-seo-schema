<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'schemaDocs',
		'type' => 'SchemaDocs',
		'url'  => 'https://schema.org/Person',
		'show' => true,
	],
	[
		'id'       => 'name',
		'label'    => __( 'Name', 'slim-seo-schema' ),
		'required' => true,
		'std'      => '{{ author.display_name }}',
	],
	[
		'id'    => 'url',
		'label' => __( 'URL', 'slim-seo-schema' ),
		'show'  => true,
		'std'   => '{{ author.posts_url }}',
	],
	[
		'id'      => 'additionalName',
		'label'   => __( 'Additional name', 'slim-seo-schema' ),
		'tooltip' => __( 'An additional name for a Person, can be used for a middle name.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'affiliation',
		'label'   => __( 'Affiliation', 'slim-seo-schema' ),
		'tooltip' => __( 'An organization that this person is affiliated with. For example, a school/university, a club, or a team. ', 'slim-seo-schema' ),
		'std'     => '{{ schemas.organization }}',
	],
	[
		'id'      => 'alumniOf',
		'label'   => __( 'Alumni of', 'slim-seo-schema' ),
		'tooltip' => __( 'An organization that the person is an alumni of.', 'slim-seo-schema' ),
		'std'     => '{{ schemas.organization }}',
	],
	[
		'id'      => 'award',
		'label'   => __( 'Award', 'slim-seo-schema' ),
		'tooltip' => __( 'An award won by or for this person.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'givenName',
		'label'   => __( 'Given name', 'slim-seo-schema' ),
		'tooltip' => __( 'Given name. In the U.S., the first name of a Person.', 'slim-seo-schema' ),
		'std'     => '{{ author.first_name }}',
		'show'    => true,
	],
	[
		'id'      => 'familyName',
		'label'   => __( 'Family name', 'slim-seo-schema' ),
		'tooltip' => __( 'Family name. In the U.S., the last name of a Person. ', 'slim-seo-schema' ),
		'std'     => '{{ author.last_name }}',
		'show'    => true,
	],
	Helper::get_property( 'address', [
		'tooltip' => __( 'Physical address of the person', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'birthDate',
		'label'   => __( 'Birth date', 'slim-seo-schema' ),
		'tooltip' => __( 'The date of birth of the person', 'slim-seo-schema' ),
	],
	[
		'id'      => 'birthPlace',
		'label'   => __( 'Birth place', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The place where the person was born.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'Place',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'tooltip'  => __( 'The name of the item.', 'slim-seo-schema' ),
				'required' => true,
			] ),
			Helper::get_property( 'address', [
				'label'    => '',
				'required' => true,
				'tooltip'  => __( 'The physical address where students go to take the program.', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'url',
				'label'   => __( 'URL', 'slim-seo-schema' ),
				'tooltip' => __( 'URL of the item.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'label'            => __( 'Brand', 'slim-seo-schema' ),
		'id'               => 'brand',
		'tooltip'          => __( 'The brand(s) associated with a product or service, or the brand(s) maintained by this person.', 'slim-seo-schema' ),
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
		'id'      => 'callSign',
		'label'   => __( 'Call sign', 'slim-seo-schema' ),
		'tooltip' => __( 'A callsign, as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'children',
		'label'   => __( 'Children', 'slim-seo-schema' ),
		'tooltip' => __( 'A child of the person.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'colleague',
		'label'   => __( 'Colleague', 'slim-seo-schema' ),
		'tooltip' => __( 'A colleague of the person.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'contactPoint',
		'label'   => __( 'Contact point', 'slim-seo-schema' ),
		'tooltip' => __( 'A contact point for a person.', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'ContactPoint',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'contactType',
				'std'      => 'Admissions',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'    => 'email',
				'label' => __( 'Email', 'slim-seo-schema' ),
				'show'  => true,
			],
			[
				'id'    => 'telephone',
				'label' => __( 'Telephone', 'slim-seo-schema' ),
				'show'  => true,
			],
		],
	],
	Helper::get_property( 'description', [
		'tooltip' => __( 'A description of the person.', 'slim-seo-schema' ),
		'std'     => '{{ author.description }}',
	] ),
	[
		'id'      => 'duns',
		'label'   => __( 'Duns', 'slim-seo-schema' ),
		'tooltip' => __( 'The Dun & Bradstreet DUNS number for identifying an organization or business person.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'email',
		'label'   => __( 'Email', 'slim-seo-schema' ),
		'tooltip' => __( 'The email address of the person', 'slim-seo-schema' ),
	],
	[
		'id'      => 'faxNumber',
		'label'   => __( 'Fax number', 'slim-seo-schema' ),
		'tooltip' => __( 'The fax number.', 'slim-seo-schema' ),
	],
	[
		'id'    => 'gender',
		'label' => __( 'Gender', 'slim-seo-schema' ),
	],
	[
		'id'      => 'globalLocationNumber',
		'label'   => __( 'Global location number', 'slim-seo-schema' ),
		'tooltip' => __( 'The Global Location Number (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place.', 'slim-seo-schema' ),
	],
	[
		'id'               => 'hasPOS',
		'label'            => __( 'Has POS', 'slim-seo-schema' ),
		'type'             => 'Group',
		'tooltip'          => __( 'Points-of-Sales operated by the person.', 'slim-seo-schema' ),
		'cloneable'        => true,
		'cloneItemHeading' => __( 'POS', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'Place',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'tooltip'  => __( 'The name of the item.', 'slim-seo-schema' ),
				'required' => true,
			] ),
			Helper::get_property( 'address', [
				'label'    => '',
				'required' => true,
				'tooltip'  => __( 'The physical address where students go to take the program.', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'url',
				'label'   => __( 'URL', 'slim-seo-schema' ),
				'tooltip' => __( 'URL of the item.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'      => 'image',
		'label'   => __( 'Image', 'slim-seo-schema' ),
		'std'     => '{{ author.avatar }}',
		'type'    => 'Image',
		'tooltip' => __( 'URL of an image for the person', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'label'   => __( 'ISIC V4', 'slim-seo-schema' ),
		'id'      => 'isicV4',
		'tooltip' => __( 'The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 code for a particular organization, business person, or place.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'jobTitle',
		'label'   => __( 'Job title', 'slim-seo-schema' ),
		'tooltip' => __( 'The job title of the person (for exp: Financial Manager).', 'slim-seo-schema' ),
	],
	[
		'label'   => __( 'NAICS', 'slim-seo-schema' ),
		'id'      => 'naics',
		'tooltip' => __( 'The North American Industry Classification System (NAICS) code for a particular organization or business person.', 'slim-seo-schema' ),
	],
	[
		'label'   => __( 'Nationality', 'slim-seo-schema' ),
		'id'      => 'nationality',
		'type'    => 'Group',
		'tooltip' => __( 'Nationality of the person.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'   => '@type',
				'std'  => 'Country',
				'type' => 'Hidden',
			],
			[
				'id'      => 'address',
				'label'   => __( 'Address', 'slim-seo-schema' ),
				'tooltip' => __( 'Physical address of the item.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'branchCode',
				'label'   => __( 'Branch code', 'slim-seo-schema' ),
				'tooltip' => __( 'A short textual code (also called "store code") that uniquely identifies a place of business. The code is typically assigned by the parentOrganization and used in structured URLs.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'description',
				'label'   => __( 'Description', 'slim-seo-schema' ),
				'tooltip' => __( 'A description of the country.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'globalLocationNumber',
				'label'   => __( 'Global location number', 'slim-seo-schema' ),
				'tooltip' => __( 'The GLN is a 13-digit number used to identify parties and physical locations.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'hasMap',
				'label'   => __( 'Has Map', 'slim-seo-schema' ),
				'tooltip' => __( 'A URL to a map of the place.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'latitude',
				'label'   => __( 'Latitude', 'slim-seo-schema' ),
				'tooltip' => __( 'The latitude of a location. For example 37.42242 (WGS 84).', 'slim-seo-schema' ),
			],
			[
				'id'      => 'longitude',
				'label'   => __( 'Longitude', 'slim-seo-schema' ),
				'tooltip' => __( 'The longitude of a location. For example -122.08585 (WGS 84).', 'slim-seo-schema' ),
			],
			[
				'id'      => 'logo',
				'label'   => __( 'Logo', 'slim-seo-schema' ),
				'tooltip' => __( 'Link to an associated logo.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'name',
				'label'   => __( 'Name', 'slim-seo-schema' ),
				'tooltip' => __( 'The name of the country.', 'slim-seo-schema' ),
				'show'    => true,
			],
			[
				'id'    => 'telephone',
				'label' => __( 'Telephone number', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'      => 'telephone',
		'label'   => __( 'Telephone', 'slim-seo-schema' ),
		'tooltip' => __( 'The telephone number of the person. Be sure to include the country code and area code in the phone number.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'workLocation',
		'label'   => __( 'Work location', 'slim-seo-schema' ),
		'tooltip' => __( 'A contact location for a person\'s place of work.', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'ContactPoint',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'label' => __( 'Name of the location', 'slim-seo-schema' ),
			] ),
			Helper::get_property( 'description', [
				'label' => __( 'Description of the location', 'slim-seo-schema' ),
			] ),
			[
				'id'       => 'email',
				'label'    => __( 'Email', 'slim-seo-schema' ),
				'tooltip'  => __( 'Email address.', 'slim-seo-schema' ),
				'required' => true,
			],
			[
				'id'      => 'telephone',
				'label'   => __( 'Telephone', 'slim-seo-schema' ),
				'tooltip' => __( 'The telephone number.', 'slim-seo-schema' ),
				'show'    => true,
			],
			[
				'id'      => 'faxNumber',
				'label'   => __( 'Fax number', 'slim-seo-schema' ),
				'tooltip' => __( 'The fax number.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'areaServed',
				'label'   => __( 'Area served', 'slim-seo-schema' ),
				'tooltip' => __( 'The geographic area where a service or offered item is provided', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'        => 'sameAs',
		'label'     => __( 'Same as', 'slim-seo-schema' ),
		'tooltip'   => __( 'URL of a reference Web page that unambiguously indicates the item\'s identity. E.g. the URL of the item\'s Wikipedia page, Wikidata entry, social media profiles or official website.', 'slim-seo-schema' ),
		'show'      => true,
		'cloneable' => true,
	],
];
