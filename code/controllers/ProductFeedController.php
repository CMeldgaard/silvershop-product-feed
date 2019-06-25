<?php

class ProductFeedController extends Controller
{

    private static $allowed_actions = [
        'google',
        'pricerunner'
    ];

    public function google()
    {
        Config::inst()->update('SSViewer', 'set_source_file_comments', false);

        $this->getResponse()->addHeader(
            'Content-Type',
            'application/xml; charset="utf-8"'
        );
        $this->getResponse()->addHeader(
            'X-Robots-Tag',
            'noindex'
        );
        $items = Product::get()->filter('RemoveFromProductFeed', false)->exclude('ClassName','GiftVoucherProduct');

        $this->extend('updateGoogleShoppingFeedItems', $items);

        return $this->customise(new ArrayData(array(
            "SiteConfig" => SiteConfig::current_site_config(),
            'Items'      => $items
        )))->renderWith("google");
    }

    public function pricerunner()
    {

        Config::inst()->update('SSViewer', 'set_source_file_comments', false);

        $this->getResponse()->addHeader(
            'Content-Type',
            'application/xml; charset="utf-8"'
        );
        $this->getResponse()->addHeader(
            'X-Robots-Tag',
            'noindex'
        );
        $items = Product::get()->exclude('ClassName','GiftVoucherProduct');

        $this->extend('updatePricerunnerFeedItems', $items);

        return $this->customise(new ArrayData(array(
            'SiteConfig'      => SiteConfig::current_site_config(),
            'Items'           => $items,
            'DefaultDelivery' => Config::inst()->get('ProductFeedController', 'DefaultDelivery')
        )))->renderWith("pricerunner");
    }

}