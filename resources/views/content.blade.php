@extends('app')
@section('content')
    <?php
        // menu links for the application part
        $applicationMenuLinks = json_encode(\App\Models\MenuLink::applicationMenuLinks());

        // menu links for the cms part
        $cmsMenus = json_encode(\App\Models\MenuLink::cmsMenus());

        // user data
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->avatar = $user->avatar(200,200,true);
        $auth = json_encode([ 'user' => $user ]);


        // Get Labels
        $labels = \App\Models\Language::getlabels();
        $pluginsConfigs = json_encode(\App\Models\Plugin::configs());

        if(\Request::is('*/plugins/*/*')){
            $isPluginApp = true;
        }else{
            $isPluginApp = false;
        }

        // logout link
        $logoutLink = route('backend.base.logoutUser');

        // Logo
        $projectLogo =  \App\Models\Settings::logo();
        if($projectLogo){
            $projectLogoURL = asset($projectLogo->thumb(200,200));
        }else{
            $projectLogoURL = asset('public/images/logo-mana.png');
        }

        $settings  =  \App\Models\Settings::getAllSettings();
        $settings['logo'] = $projectLogoURL;

        // User data object
        $postTypeSlugs = \App\Models\PostType::getFromCache()->keys();
        $permissions = \App\Models\User::getPermissions();
        $globalData = htmlentities(json_encode([
            'post_type_slugs' => $postTypeSlugs,
            'permissions' => $permissions,
            'user' => \Illuminate\Support\Facades\Auth::user()['original'],
            'settings' => $settings,
            'ini_upload_max_filesize' => ini_get('upload_max_filesize'),
            'ini_post_max_size' => ini_get('post_max_size')
        ]));
    ?>

    <app
        application_menu_links="{{$applicationMenuLinks}}"
        cms_menus="{{$cmsMenus}}"
        auth="{{$auth}}"
        global_data="{{ $globalData }}"
        labels="{{ json_encode($labels) }}"
        base_url="{{ Request::root()}}"
        base_path="{{projectDirectory()}}"
        plugins_configs="{{$pluginsConfigs}}"
        is_plugin_app="{{$isPluginApp}}"
        logout_link="{{$logoutLink}}"
    ></app>
@stop
