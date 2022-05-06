<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'HPL',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>HPL</b>',
    'logo_icon' => 'images/plus.jpeg',
    'logo_icon_class' => 'brand-image icon-circle elevation-3',
    'logo_icon_xl' => null,
    'logo_icon_xl_class' => 'brand-image-xs',
    'logo_icon_alt' => 'HPL',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'text' => 'search',
            'search' => false,
            'topnav' => true,
        ],
        [
            'text'        => ['Dashboard'],
            'url'         => '',
            // 'icon'        => 'fas fa-fw fa-tachometer-alt',
            'icon'       => 'dashboard.png',
            'can'         => 'AdminAccess',
        ],
        [
            'text'        => ['Admin'],
            'url'         => 'users',
            // 'icon'        => 'fas fa-fw fa-user-shield',
            'icon'       => 'admin.png',
            'can'         => 'AdminAccess'
        ],
        // [
        //     'text'        => ['Vendors'],
        //     'url'         => 'sellers',
        //     // 'icon'        => 'fas fa-fw fa-user',
        //     'icon'       => 'vendor.png',
        // ],
        [
            'text'        => ['Customers'],
            'url'         => 'customers',
            // 'icon'        => 'fas fa-fw fa-user',
            'icon'       => 'people.png',
            'can'         => 'AdminAccess'
            
        ],
        [
            'text'        => ['MOUs'],
            'url'         => 'mous',
            // 'icon'        => 'fas fa-fw fa-user',
            'icon'       => 'people.png',
            'can'         => 'AdminAccess'
            
        ],
        // [
        //     'text'        => ['Staffs'],
        //     // 'icon'        => 'fas fa-fw fa-user-tie',
        //     'icon'       => 'employees.png',
        //     'submenu' => [
        //         [
        //             'text'        => ['Add Staff'],
        //             'url'         => 'staffs/create',
                    
        //         ],
        //         [
        //             'text'        => ['Designers'],
        //             'url'         => 'designers',
                    
        //         ],
        //         [
        //             'text'        => ['Sales Rep'],
        //             'url'         => 'salesreps',
                   
        //         ],
        //         [
        //             'text'        => ['Printers'],
        //             'url'         => 'printers',
                    
        //         ],
        //         [
        //             'text'        => ['Finishers'],
        //             'url'         => 'finishers',
                    
        //         ],
        //         [
        //             // 'text'        => ['Loom Operators'],
        //             'text'        => ['Weaver'],
        //             'url'         => 'loomoperators',
                    
        //         ],
        //         [
        //             // 'text'        => ['Finishing Operators'],
        //             'text'        => ['General Staff'],
        //             'url'         => 'finishingoperators',
                   
        //         ],
        //         [
        //             'text'        => ['Quality Checkers'],
        //             'url'         => 'qualitycheckers',
                   
        //         ],

        //     ],       
        // ],
        // [
        //     'text'        => ['Woven Masters'],
        //     // 'icon'        => 'fas fa-fw fa-dice-d6',
        //     'icon'       => 'supplies.png',
        //     'submenu' => [
        //         [
        //             'text'        => ['Yarns'],
        //             'url'         => 'yarns',
                    
        //         ],
        //         [
        //             'text'        => ['Warps'],
        //             'url'         => 'warps',
                   
        //         ],
        //         [
        //             'text'        => ['Weaving Qualitys'],
        //             'url'         => 'wovenqualitys',
                   
        //         ],
        //         [
        //             'text'        => ['Looms'],
        //             'url'         => 'looms',
                    
        //         ],
        //         [
        //             'text'        => ['FinishingMachines'],
        //             'url'         => 'finishingmachines',
                    
        //         ],
                
        //         [
        //             'text'        => ['Folds'],
        //             'url'         => 'folds',
                    
        //         ],

        //     ],


        // ],
        // [
        //     'text'        => ['Woven Design Cards'],
        //     // 'icon'        => 'fas fa-fw fa-object-group',
        //     'icon'       => 'web-design.png',
        //     'url'         => 'woven-design-cards',

        // ],
        // [
        //     'text'        => ['Woven Purchase Order'],
        //     // 'icon'        => 'fas fa-fw fa-object-group',
        //     'icon'       => 'purchase.png',
        //     'url'         => 'purchase-order',

        // ],
        // [
        //     'text'        => ['Printed Masters'],
        //     // 'icon'        => 'fas fa-fw fa-dice-d6',
        //     'icon'       => '3d-printing.png',
        //     'submenu' => [
        //         [
        //             'text'        => ['Ink Master'],
        //             'url'         => 'ink',
                    
        //         ],
        //         [
        //             'text'        => ['Material  Master'],
        //             'url'         => 'material-master',
                   
        //         ],
        //         [
        //             'text'        => ['Size Master mm'],
        //             'url'         => 'size-master-mm',
                   
        //         ],
                
        //         [
        //             'text'        => ['Fold Master'],
        //             'url'         => 'printed-folds',
                    
        //         ],
        //          [
        //             'text'        => ['Machine master'],
        //             'url'         => 'machine-master',
                    
        //         ],
        //          [
        //             'text'        => ['Cut fold  Machine master'],
        //             'url'         => 'cut-fold-machine',
                    
        //         ],

        //     ],


        // ],
        // [
        //     'text'        => ['Printed Design Cards'],
        //     // 'icon'        => 'fas fa-fw fa-object-group',
        //     'icon'       => 'web-design.png',
        //     'url'         => 'printed-design-cards',

        // ],
        // [
        //     'text'        => ['Printed Purchase Order'],
        //     // 'icon'        => 'fas fa-fw fa-object-group',
        //     'icon'       => 'purchase.png',
        //     'url'         => 'printed-purchase-order',

        // ],
        [
            'text'        => ['Roles'],
            // 'icon'        => 'far fa-id-badge',
            'icon'       => 'settings.png',
            'url'         => 'roles',
            'can'         => 'AdminAccess'

        ],
        // [
        //     'text'        => ['Category'],
        //     // 'icon'        => 'fas fa-tags',
        //     'icon'       => 'category.png',
        //     'url'         => 'categories',

        // ],
        // [
        //     'text'        => ['Invoice'],
        //     // 'icon'        => 'fas fa-tags',
        //     'icon'       => 'invoice.png',
        //     'url'         => 'invoice',
        // ],
        // [
        //     'text'        => ['Company Profile'],
        //     // 'icon'        => 'fas fa-tags',
        //     'icon'       => 'profile.png',
        //     'url'         => 'company-profile',
        // ],
        
        ['header' => 'account_settings'],
        [
            'text' => ['Profile'],
            'url'  => 'viewprofile',
            'icon'       => 'admin.png',
            // 'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text' => ['Change Password'],
            'url'  => 'change-password',
            'icon'       => 'padlock.png',
            // 'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text' => ['Logout'],
            'url'  => 'logout',
            'icon'       => 'padlock.png',
//             'icon' => 'fas fa-fw fa-lock',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => false,
];
