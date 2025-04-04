<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/job-posting',
		'show' => true,
	],
	[
		'id'       => 'title',
		'label'    => __( 'Title', 'slim-seo-schema' ),
		'required' => true,
		'std'      => '{{ post.title }}',
		'tooltip'  => __( 'The title of the job (not the title of the posting).', 'slim-seo-schema' ),
	],
	[
		'id'      => 'baseSalary',
		'label'   => __( 'Base salary', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The actual base salary for the job, as provided by the employer (not an estimate).', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'MonetaryAmount',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'currency',
				'label'    => __( 'Currency', 'slim-seo-schema' ),
				'tooltip'  => __( 'The currency of the base salary.', 'slim-seo-schema' ),
				'std'      => 'USD',
				'required' => true,
			],
			[
				'id'       => 'value',
				'type'     => 'Group',
				'tooltip'  => __( 'The value of the base salary.', 'slim-seo-schema' ),
				'required' => true,
				'fields'   => [
					[
						'id'       => '@type',
						'std'      => 'QuantitativeValue',
						'type'     => 'Hidden',
						'required' => true,
					],
					[
						'id'    => 'value',
						'label' => __( 'Value', 'slim-seo-schema' ),
						'show'  => true,
					],
					[
						'id'    => 'minValue',
						'label' => __( 'Min value', 'slim-seo-schema' ),
					],
					[
						'id'    => 'maxValue',
						'label' => __( 'Max value', 'slim-seo-schema' ),
					],
					[
						'id'      => 'unitText',
						'label'   => __( 'Unit text', 'slim-seo-schema' ),
						'type'    => 'DataList',
						'show'    => true,
						'std'     => 'MONTH',
						'tooltip' => __( 'A string or text indicating the unit of measurement.', 'slim-seo-schema' ),
						'options' => [
							'HOUR'  => __( 'Hour', 'slim-seo-schema' ),
							'DAY'   => __( 'Day', 'slim-seo-schema' ),
							'WEEK'  => __( 'Week', 'slim-seo-schema' ),
							'MONTH' => __( 'Month', 'slim-seo-schema' ),
							'YEAR'  => __( 'Year', 'slim-seo-schema' ),
						],
					],
				],
			],
		],
	],
	[
		'id'       => 'datePosted',
		'label'    => __( 'Date posted', 'slim-seo-schema' ),
		'required' => true,
		'tooltip'  => __( 'The original date that employer posted the job in ISO 8601 format', 'slim-seo-schema' ),
		'type'     => 'Date',
		'std'      => '{{ post.date }}',
	],
	Helper::get_property( 'description', [
		'required' => true,
		'tooltip'  => __( 'The full description of the job in HTML format. The description can\'t be the same as the title.', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'directApply',
		'label'   => __( 'Direct apply?', 'slim-seo-schema' ),
		'tooltip' => __( 'Whether the URL that\'s associated with this job posting enables direct application for the job.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'true',
		'options' => [
			'true'  => __( 'Yes', 'slim-seo-schema' ),
			'false' => __( 'No', 'slim-seo-schema' ),
		],
	],
	[
		'id'      => 'educationRequirements',
		'label'   => __( 'Education requirements', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The educational background needed for the job posting.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'EducationalOccupationalCredential',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'      => 'credentialCategory',
				'type'    => 'DataList',
				'std'     => 'high school',
				'options' => [
					'high school'              => __( 'High school', 'slim-seo-schema' ),
					'associate degree'         => __( 'Associate degree', 'slim-seo-schema' ),
					'bachelor degree'          => __( 'Bachelor degree', 'slim-seo-schema' ),
					'professional certificate' => __( 'Professional certificate', 'slim-seo-schema' ),
					'postgraduate degree'      => __( 'Postgraduate degree', 'slim-seo-schema' ),
				],
			],
		],
	],
	[
		'id'      => 'employmentType',
		'label'   => __( 'Employment type', 'slim-seo-schema' ),
		'tooltip' => __( 'Type of employment.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'FULL_TIME',
		'options' => [
			'FULL_TIME'  => __( 'Full time', 'slim-seo-schema' ),
			'PART_TIME'  => __( 'Part time', 'slim-seo-schema' ),
			'CONTRACTOR' => __( 'Contractor', 'slim-seo-schema' ),
			'TEMPORARY'  => __( 'Temporary', 'slim-seo-schema' ),
			'INTERN'     => __( 'Intern', 'slim-seo-schema' ),
			'VOLUNTEER'  => __( 'Volunteer', 'slim-seo-schema' ),
			'PER_DIEM'   => __( 'Per diem', 'slim-seo-schema' ),
			'OTHER'      => __( 'Other', 'slim-seo-schema' ),
		],
	],
	[
		'id'      => 'experienceRequirements',
		'label'   => __( 'Months of experience', 'slim-seo-schema' ),
		'tooltip' => __( 'The minimum number of months of experience.', 'slim-seo-schema' ),
		'type'    => 'Group',
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'OccupationalExperienceRequirements',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id' => 'monthsOfExperience',
				'show'  => true,
			],
		],
	],
	[
		'id'      => 'experienceInPlaceOfEducation',
		'label'   => __( 'Experience in place of education?', 'slim-seo-schema' ),
		'tooltip' => __( 'If set to yes, this property indicates whether a job posting will accept experience in place of its formal educational qualifications. If set to true, you must include both the experienceRequirements and educationRequirements properties.', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'std'     => 'true',
		'options' => [
			'true'  => __( 'Yes', 'slim-seo-schema' ),
			'false' => __( 'No', 'slim-seo-schema' ),
		],
	],
	[
		'id'       => 'hiringOrganization',
		'label'    => __( 'Hiring organization', 'slim-seo-schema' ),
		'std'      => '{{ schemas.organization }}',
		'required' => true,
		'tooltip'  => __( 'The organization offering the job position. This must be the name of the company (for exp. "Starbucks, Inc"), and not the specific location that is hiring (for exp. "Starbucks on Main Street").', 'slim-seo-schema' ),
	],
	[
		'id'      => 'identifier',
		'label'   => __( 'Identifier', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The hiring organization\'s unique identifier for the job.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'PropertyValue',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'required' => true,
				'tooltip'  => __( 'The name of the hiring organization.', 'slim-seo-schema' ),
			] ),
			[
				'id'    => 'value',
				'label' => __( 'Value', 'slim-seo-schema' ),
				'show'  => true,
			],
		],
	],
	[
		'id'      => 'jobLocation',
		'label'   => __( 'Job location', 'slim-seo-schema' ),
		'type'    => 'Group',
		'show'    => true,
		'tooltip' => __( 'The physical location(s) of the business where the employee will report to work (such as an office or worksite), not the location where the job was posted. Note that the address country property must be specified.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'Place',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'address', [
				'label'            => '',
				'required'         => true,
				'cloneable'        => true,
				'cloneItemHeading' => __( 'Address', 'slim-seo-schema' ),
				'tooltip'          => __( 'The physical address where students go to take the program.', 'slim-seo-schema' ),
			] ),
		],
	],
	[
		'id'      => 'applicantLocationRequirements',
		'label'   => __( 'Applicant location requirements', 'slim-seo-schema' ),
		'type'    => 'Group',
		'tooltip' => __( 'The geographic location(s) in which employees may be located for to be eligible for the Work from home job.', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'       => '@type',
				'std'      => 'AdministrativeArea',
				'type'     => 'Hidden',
				'required' => true,
			],
			Helper::get_property( 'name', [
				'label'    => '',
				'required' => true,
			] ),
		],
	],
	[
		'id'      => 'jobLocationType',
		'label'   => __( 'Job location type', 'slim-seo-schema' ),
		'type'    => 'DataList',
		'tooltip' => __( 'Whether the jobs in which the employee may or must work remotely 100% of the time.', 'slim-seo-schema' ),
		'options' => [
			''            => __( 'Non remote', 'slim-seo-schema' ),
			'TELECOMMUTE' => __( 'Remote', 'slim-seo-schema' ),
		],
	],
	[
		'id'      => 'validThrough',
		'label'   => __( 'Valid through', 'slim-seo-schema' ),
		'tooltip' => __( 'The date when the job posting will expire in ISO 8601 format.', 'slim-seo-schema' ),
		'type'    => 'Date',
	],
];
