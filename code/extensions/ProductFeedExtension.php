<?php

class ProductFeedExtension extends DataExtension
{
    private static $db = [
        'RemoveFromProductFeed' => 'Boolean',
        'GoogleCondition'       => 'Enum(array("new","refurbished","used"),"new")',
        'Brand'                 => 'Varchar',
        'EAN'                   => 'Varchar'
    ];

    private static $has_one = [
        'GoogleProductCategory'      => 'ProductFeedCategory',
        'PricerunnerProductCategory' => 'ProductFeedCategory',

    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.ProductFeeds', [
            CheckboxField::create('RemoveFromProductFeed'),
            TextField::create('Brand'),
            TextField::create('EAN'),
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