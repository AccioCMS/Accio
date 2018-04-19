<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'laravelcollective/html' => 
  array (
    'providers' => 
    array (
      0 => 'Collective\\Html\\HtmlServiceProvider',
    ),
    'aliases' => 
    array (
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'riverskies/laravel-mobile-detect' => 
  array (
    'providers' => 
    array (
      0 => 'Riverskies\\Laravel\\MobileDetect\\MobileDetectServiceProvider',
    ),
    'aliases' => 
    array (
      'MobileDetect' => 'Riverskies\\Laravel\\MobileDetect\\Facades\\MobileDetect',
    ),
  ),
  'chumper/zipper' => 
  array (
    'providers' => 
    array (
      0 => 'Chumper\\Zipper\\ZipperServiceProvider',
    ),
    'aliases' => 
    array (
      'Zipper' => 'Chumper\\Zipper\\Zipper',
    ),
  ),
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
    ),
  ),
);