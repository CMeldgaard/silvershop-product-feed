<?php

class ProductFeedProductFeedExtension extends DataExtension
{
    private static $db = [
        'RemoveFromProductFeed'   => 'Boolean',
        'GoogleCondition'         => 'Enum(array("new","refurbished","used"),"new")',
        'Brand'                   => 'Varchar',
        'EAN'                     => 'Varchar',
        'PricerunnerDeliveryTime' => 'Varchar'
    ];

    private static $has_one = [
        'GoogleProductCategory'      => 'ProductFeedCategory',
        'PricerunnerProductCategory' => 'ProductFeedCategory',

    ];

    public function updateCMSFields(FieldList $fields)
    {

        $removeField = new CheckboxField('RemoveFromProductFeed');
        $brandField = new TextField('Brand');
        $eanField = new TextField('EAN');

        $googleShopping = new ToggleCompositeField('GoogleShoppingSettings',
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
            ]);

        $priceRunner = new ToggleCompositeField('PriceRunnerSettings',
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
                ),
                TextField::create('PricerunnerDeliveryTime', 'Leveringstid')
            ]);

        if ($fields->fieldByName('Root')) {
            if (is_string($this->owner->has_many('Variations')) && $this->owner->Variations()->exists()) {
                $fields->addFieldToTab('Root.ProductFeeds', $removeField);
                $fields->addFieldToTab('Root.ProductFeeds', $brandField);
                $fields->addFieldToTab('Root.ProductFeeds', $googleShopping);
                $fields->addFieldToTab('Root.ProductFeeds', $priceRunner);
            }else {
                $fields->addFieldToTab('Root.ProductFeeds', $removeField);
                $fields->addFieldToTab('Root.ProductFeeds', $brandField);
                $fields->addFieldToTab('Root.ProductFeeds', $eanField);
                $fields->addFieldToTab('Root.ProductFeeds', $googleShopping);
                $fields->addFieldToTab('Root.ProductFeeds', $priceRunner);
            }
        }

        return $fields;
    }
}