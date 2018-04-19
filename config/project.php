<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Default Protocol
   |--------------------------------------------------------------------------
   |
   | Forces all routes to be accessed via a specific protocol
   | @TODO routes based on a protocol
   |
   */
    'protocol' => "http",

    /*
    |--------------------------------------------------------------------------
    | Admin Url Prefix
    |--------------------------------------------------------------------------
    |
    | The url you access the admin panel with. ex. site.com/admin/
    |
    */
    'adminPrefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Default Post Type
    |--------------------------------------------------------------------------
    */
    "default_post_type" => 'post_articles',

    /*
    |--------------------------------------------------------------------------
    | Multilanguage Site
    |--------------------------------------------------------------------------
    |
    | If site is multilanguage, the "lang" parameter will be added in the beginning of each translatable route. ex: site.com/en/about/
    |
    */
    "multilanguage" => true,

    /*
    |--------------------------------------------------------------------------
    | Access Languages With Subdomain
    |--------------------------------------------------------------------------
    |
    | If this option is enabled, language slug will be added as subdomain in all translatable routes. ex: en.site.com/about/
    | @TODO multiLanguageWithSubdomain
    */
    "multiLanguageWithSubdomain" => false, //for cases when languges work with subdomains, eg. http://en.website.com

    /*
    |--------------------------------------------------------------------------
    | Remove Language Slug In Default Language Routes
    |--------------------------------------------------------------------------
    |
    | If this option is enabled, routes that belongs to default language will be access without language slug. ex. site.com/en/about will be accessed via site.com/about/
    |
    */
    'hideDefaultLanguageInURL' => true,

    /*
    |--------------------------------------------------------------------------
    | Set default theme
    |--------------------------------------------------------------------------
    |
    | This is functional only if there is no default theme set in database level
    |
    */
    'defaultTheme' => 'defaultTheme',

];

