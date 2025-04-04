<?php
namespace SlimSEOPro\Schema\SchemaTypes;

return [
	[
		'id'   => 'googleDocs',
		'type' => 'GoogleDocs',
		'url'  => 'https://developers.google.com/search/docs/appearance/structured-data/recipe',
		'show' => true,
	],
	Helper::get_property( 'name', [
		'required' => true,
		'tooltip'  => __( 'The name of the dish', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'image', [
		'required' => true,
		'tooltip'  => __( 'Image of the completed dish', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'aggregateRating', [
		'show'    => true,
		'tooltip' => __( 'Annotation for the average review score assigned to the item', 'slim-seo-schema' ),
	]  ),
	Helper::get_property( 'Person', [
		'id'      => 'author',
		'label'   => __( 'Author', 'slim-seo-schema' ),
		'show'    => true,
		'tooltip' => __( 'The name of the person or organization that wrote the recipe', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'description', [
		'show'    => true,
		'tooltip' => __( 'A short summary describing the dish', 'slim-seo-schema' ),
	] ),
	Helper::get_property( 'datePublished', [
		'show'    => true,
		'tooltip' => __( 'The date the recipe was published in ISO 8601 format', 'slim-seo-schema' ),
	] ),
	[
		'id'      => 'cookTime',
		'label'   => __( 'Cooking time (min)', 'slim-seo-schema' ),
		'show'    => true,
		'tooltip' => __( 'The time it takes to actually cook the dish in ISO 8601 format', 'slim-seo-schema' ),
	],
	[
		'id'      => 'prepTime',
		'label'   => __( 'Preparation time (min)', 'slim-seo-schema' ),
		'tooltip' => __( 'The length of time it takes to prepare the dish, in ISO 8601 format', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'id'      => 'totalTime',
		'label'   => __( 'Total Time (min)', 'slim-seo-schema' ),
		'tooltip' => __( 'The total time it takes to prepare the cook the dish, in ISO 8601 format', 'slim-seo-schema' ),
		'show'    => true,
	],
	[
		'id'      => 'keywords',
		'label'   => __( 'Keywords', 'slim-seo-schema' ),
		'tooltip' => __( 'Other terms for your recipe such as the season ("summer"), the holiday ("Halloween")', 'slim-seo-schema' ),
	],
	[
		'id'      => 'recipeCategory',
		'label'   => __( 'Recipe category', 'slim-seo-schema' ),
		'tooltip' => __( 'The type of meal or course your recipe is about. For example: "dinner", "main course", or "dessert, snack"', 'slim-seo-schema' ),
	],
	[
		'id'      => 'recipeCuisine',
		'label'   => __( 'Recipe cuisine', 'slim-seo-schema' ),
		'tooltip' => __( 'The region associated with your recipe. For example, "French", Mediterranean", or "American"', 'slim-seo-schema' ),
	],
	[
		'id'        => 'recipeIngredient',
		'label'     => __( 'Recipe ingredient', 'slim-seo-schema' ),
		'cloneable' => true,
		'tooltip'   => __( 'An ingredient used in the recipe', 'slim-seo-schema' ),
		'show'      => true,
	],
	[
		'id'               => 'recipeInstructions',
		'label'            => __( 'Recipe instructions', 'slim-seo-schema' ),
		'type'             => 'Group',
		'cloneable'        => true,
		'cloneItemHeading' => __( 'Step', 'slim-seo-schema' ),
		'show'             => true,
		'tooltip'          => __( 'The steps to make the dish', 'slim-seo-schema' ),
		'fields'           => [
			[
				'id'       => '@type',
				'std'      => 'HowToStep',
				'type'     => 'Hidden',
				'required' => true,
			],
			[
				'id'       => 'name',
				'label'    => __( 'Name', 'slim-seo-schema' ),
				'required' => true,
			],
			[
				'id'       => 'text',
				'label'    => __( 'Text', 'slim-seo-schema' ),
				'required' => true,
			],
			[
				'id'    => 'url',
				'label' => __( 'URL', 'slim-seo-schema' ),
			],
			[
				'id'    => 'image',
				'label' => __( 'Image', 'slim-seo-schema' ),
			],
		],
	],
	[
		'id'      => 'recipeYield',
		'label'   => __( 'Recipe yield', 'slim-seo-schema' ),
		'tooltip' => __( 'The quantity produced by the recipe. Specify the number of servings produced from this recipe with just a number', 'slim-seo-schema' ),
	],
	[
		'id'      => 'nutrition',
		'type'    => 'Group',
		'label'   => __( 'Calories', 'slim-seo-schema' ),
		'tooltip' => __( 'The number of calories in each serving produced with this recipe', 'slim-seo-schema' ),
		'fields'  => [
			[
				'id'   => '@type',
				'std'  => 'NutritionInformation',
				'type' => 'Hidden',
			],
			[
				'id'       => 'calories',
				'required' => true,
			],
		],
	],
	Helper::get_property( 'VideoObject' ),
];
