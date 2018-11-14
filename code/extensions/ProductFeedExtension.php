<?php

class ProductFeedExtension extends DataExtension
{
    private static $db = [
        'RemoveFromProductFeed' => 'Boolean',
        'GoogleCondition'       => 'Enum(array("new","refurbished","used"),"new")',
        'Brand'                 => 'Varchar'
    ];

    private static $has_one = [
        'GoogleProductCategory'      => 'ProductFeedCategory',
        'PricerunnerProductCategory' => 'ProductFeedCategory',

    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.ProductFeeds', [
            CheckboxField::create('RemoveFromShoppingFeed'),
            TextField::create('Brand'),
            ToggleCompositeField::create(
                'GoogleShoppingSettings',
                _t(
                    'GoogleShoppingFeed.GoogleShoppingFeed',
                    'Google Shopping Feed'
                ),
                [
                    DropdownField::create(
                        'GoogleCondition',
                        'Product condition',
                        singleton($this->owner->ClassName)->dbObject('GoogleCondition')->enumValues()
                    ),
                    AutoCompleteField::create(
                        'GoogleProductCategoryID',
                        'Category',
                        '',
                        null,
                        null,
                        'ProductFeedCategory',
                        'Title'
                    )
                ]
            ),
            ToggleCompositeField::create(
                'PriceRunnerSettings',
                _t(
                    'GoogleShoppingFeed.GoogleShoppingFeed',
                    'Pricerunner Shopping Feed'
                ),
                [
                    AutoCompleteField::create(
                        'PricerunnerProductCategoryID',
                        'Category',
                        '',
                        null,
                        null,
                        'ProductFeedCategory',
                        'Title'
                    )
                ]
            )
        ]);
    }
}