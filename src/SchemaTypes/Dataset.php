<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/dataset',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The name of the dataset', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'alternateName',
		'label'   => __( 'Alternate Name', 'slim-seo-schema' ),
		'tooltip' => __( 'Alternative names that have been used to refer to this dataset, such as aliases or abbreviations.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'description', [
		'required' => true,
		'tooltip'  => __( 'A short summary describing a dataset. Must be between 50 and 5000 characters long.', 'slim-seo-schema' ),
	] ),

	Helper::get_property( 'Person', [
		'id'      => 'creator',
		'label'   => __( 'Creator', 'slim-seo-schema' ),
		'tooltip' => __( 'The creator or author of this dataset.', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'citation',
		'label'   => __( 'Citation', 'slim-seo-schema' ),
		'tooltip' => __( 'Identifies academic articles that are recommended by the data provider be cited in addition to the dataset itself. Provide the citation for the dataset itself with other properties, such as name, identifier, creator, and publisher properties.', 'slim-seo-schema' ),
	],

	[
		'id'        => 'distribution',
		'label'     => __( 'Distribution', 'slim-seo-schema' ),
		'tooltip'   => __( 'The description of the location for download of the dataset and the file format for download.', 'slim-seo-schema' ),
		'type'      => 'Group',
		'cloneable' => true,
		'fields'    => [
			[
				'id'       => '@type',
				'std'      => 'DataDownload',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'encodingFormat',
				'label'    => __( 'Encoding Format', 'slim-seo-schema' ),
				'required' => true,
				'std'      => 'XML',
				'type'     => 'DataList',
				'tooltip'  => __( 'The file format of the distribution.', 'slim-seo-schema' ),
				'options'  => [
					'CSV' => 'CSV',
					'XML' => 'XML',
				],
			],
			[
				'id'       => 'contentUrl',
				'tooltip'  => __( 'The file format of the distribution.', 'slim-seo-schema' ),
				'label'    => __( 'Content Url', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	Helper::get_property( 'Person', [
		'id'      => 'funder',
		'label'   => __( 'Funder', 'slim-seo-schema' ),
		'tooltip' => __( 'A person or organization that provides financial support for this dataset.', 'slim-seo-schema' ),
	] ),
	[
		'id'        => 'hasPart',
		'label'     => __( 'Has part', 'slim-seo-schema' ),
		'tooltip'   => __( 'Link to smaller datasets, which the dataset is a collection of these.', 'slim-seo-schema' ),
		'type'      => 'Group',
		'cloneable' => true,
		'fields'    => [
			[
				'id'       => '@type',
				'std'      => 'Url',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'url',
				'label'    => __( 'Url', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'id'      => 'isPartOf',
		'label'   => __( 'Is part of', 'slim-seo-schema' ),
		'tooltip' => __( 'Link to another dataset, which the dataset is part of that.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'identifier',
		'label'   => __( 'Identifier', 'slim-seo-schema' ),
		'tooltip' => __( 'An identifier, such as a DOI or a Compact Identifier.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'isAccessibleForFree',
		'label'   => __( 'Is accessible for free?', 'slim-seo-schema' ),
		'tooltip' => __( 'Whether the dataset is accessible without payment.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'true',
		'options' => [
			'true'  => __( 'Yes', 'slim-seo-schema' ),
			'false' => __( 'No', 'slim-seo-schema' ),
		],
	],
	[
		'id'        => 'includedInDataCatalog',
		'label'     => __( 'Included in data catalog', 'slim-seo-schema' ),
		'tooltip'   => __( 'The catalog to which the dataset belongs.', 'slim-seo-schema' ),
		'type'      => 'Group',
		'cloneable' => true,
		'fields'    => [
			[
				'id'       => '@type',
				'std'      => 'DataCatalog',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],

	[
		'id'      => 'keywords',
		'label'   => __( 'Keywords', 'slim-seo-schema' ),
		'tooltip' => __( 'Keywords summarizing the dataset.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'license',
		'label'   => __( 'License', 'slim-seo-schema' ),
		'tooltip' => __( 'Link to the license under which the dataset is distributed.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'measurementTechnique',
		'label'   => __( 'Measurement technique', 'slim-seo-schema' ),
		'tooltip' => __( 'The technique, technology, or methodology used in the dataset.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'sameAs',
		'label'   => __( 'Same as', 'slim-seo-schema' ),
		'tooltip' => __( 'The URL of a reference web page that unambiguously indicates the dataset\'s identity.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'spatialCoverage',
		'label'   => __( 'Spatial coverage', 'slim-seo-schema' ),
		'tooltip' => __( 'Named locations that describes the spatial aspect of the dataset. Only include this property if the dataset has a spatial dimension. For exp. Tahoe City, CA', 'slim-seo-schema' ),
	],
	[
		'id'      => 'temporalCoverage',
		'label'   => __( 'Temporal coverage', 'slim-seo-schema' ),
		'tooltip' => __( 'The data in the dataset covers a specific time interval. Only include this property if the dataset has a temporal dimension.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'variableMeasured',
		'label'   => __( 'Variable measured', 'slim-seo-schema' ),
		'tooltip' => __( 'The variable that this dataset measures. For exp. temperature or pressure.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'version',
		'label'   => __( 'Version', 'slim-seo-schema' ),
		'tooltip' => __( 'The version number for the dataset.', 'slim-seo-schema' ),
	],
	Helper::get_property( 'url', [
		'tooltip' => __( 'Location of a page describing the dataset.', 'slim-seo-schema' ),
		'std'     => '{{ post.url }}',
	] ),
];
