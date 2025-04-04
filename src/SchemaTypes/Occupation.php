<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/estimated-salary',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The title of the occupation. Don\'t include job codes, addresses, dates, salaries, or company names and special characters.', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'description', [
		'show'    => true,
		'tooltip' => __( 'The description of the occupation. Must be a complete representation of the job, including job responsibilities, qualifications, skills, working hours, education requirements, and experience requirements.', 'slim-seo-schema' ),
	] ),
	[
		'id'               => 'estimatedSalary',
		'label'            => __( 'Estimated salary', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'required'         => true,
		'cloneItemHeading' => __( 'Salary', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'MonetaryAmountDistribution',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'required' => true,
				'std'      => 'base',
				'tooltip'  => __( 'The type of value. You must specify the base salary. Other types of compensation are optional for exp. "base", "bonus", "commission".', 'slim-seo-schema' ),
			] ),
			[
				'id'      => 'currency',
				'show'    => true,
				'label'   => __( 'Currency', 'slim-seo-schema' ),
				'tooltip' => __( 'The ISO 4217 3-letter currency code.', 'slim-seo-schema' ),
			],
			[
				'id'       => 'duration',
				'label'    => __( 'Duration', 'slim-seo-schema' ),
				'required' => true,
				'std'      => 'P1Y',
				'tooltip'  => __( 'The period of time that it takes to earn the estimated salary in ISO 8601 date format. For example, if the estimated salary is earned over the course of one year, use P1Y for duration.', 'slim-seo-schema' ),
				'type'     => 'Date',
			],
			[
				'id'    => 'maxValue',
				'show'  => true,
				'label' => __( 'Max value', 'slim-seo-schema' ),
			],
			[
				'id'    => 'minValue',
				'show'  => true,
				'label' => __( 'Min value', 'slim-seo-schema' ),
			],
			[
				'id'      => 'median',
				'label'   => __( 'Median', 'slim-seo-schema' ),
				'tooltip' => __( 'The median (or "middle") value.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'percentile10',
				'label'   => __( 'Percentile 10', 'slim-seo-schema' ),
				'tooltip' => __( 'The 10th percentile value.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'percentile25',
				'label'   => __( 'Percentile 25', 'slim-seo-schema' ),
				'tooltip' => __( 'The 25th percentile value.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'percentile75',
				'label'   => __( 'Percentile 75', 'slim-seo-schema' ),
				'tooltip' => __( 'The 75th percentile value.', 'slim-seo-schema' ),
			],
			[
				'id'      => 'percentile90',
				'label'   => __( 'Percentile 90', 'slim-seo-schema' ),
				'tooltip' => __( 'The 90th percentile value.', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'       => 'hiringOrganization',
		'label'    => __( 'Hiring organization', 'slim-seo-schema' ),
		'tooltip'  => __( 'The organization offering a position of this occupation.', 'slim-seo-schema' ),
		'required' => true,
		'std'      => '{{ schemas.organization }}',
	],
	[
		'id'      => 'industry',
		'label'   => __( 'Industry', 'slim-seo-schema' ),
		'tooltip' => __( 'The industry that\'s associated with the job position.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'jobBenefits',
		'label'   => __( 'Job benefits', 'slim-seo-schema' ),
		'tooltip' => __( 'The description of benefits that are associated with the job.F', 'slim-seo-schema' ),
	],
	[
		'id'       => 'occupationLocation',
		'label'    => __( 'Occupation location', 'slim-seo-schema' ),
		'type'     => 'Group',
		'tooltip'  => __( 'The place for which this occupational description applies.', 'slim-seo-schema' ),
		'required' => true,
		'fields'   => [
			[
				'id'       => '@type',
				'label'    => __( 'Type', 'slim-seo-schema' ),
				'required' => true,
				'type'     => 'DataList',
				'std'      => 'Country',
				'tooltip'  => __( 'A string or text indicating the type of the location.', 'slim-seo-schema' ),
				'options'  => [
					'City'    => __( 'City', 'slim-seo-schema' ),
					'State'   => __( 'State', 'slim-seo-schema' ),
					'Country' => __( 'Country', 'slim-seo-schema' ),
				],
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'required' => true,
			],
		],
	],
	[
		'id'      => 'sampleSize',
		'label'   => __( 'Sample size', 'slim-seo-schema' ),
		'tooltip' => __( 'The number of data points contributing to the aggregated salary data.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'yearsExperienceMax',
		'label'   => __( 'Years experience max', 'slim-seo-schema' ),
		'tooltip' => __( 'The maximum years of experience that are acceptable for this occupation.', 'slim-seo-schema' ),
	],
	[
		'id'      => 'yearsExperienceMin',
		'label'   => __( 'Years experience min', 'slim-seo-schema' ),
		'tooltip' => __( 'The minimum number of years of experience required for this occupation.', 'slim-seo-schema' ),
	],
];
