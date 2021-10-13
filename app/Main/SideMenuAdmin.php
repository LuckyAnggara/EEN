<?php

namespace App\Main;

class SideMenuAdmin
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'dashboard-admin',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Dashboard',
            ],
            'devider',
            'laporan'=>[
                'icon' => 'list',
                'title' => 'Laporan',
                'sub_menu' => [
                    'chart' => [
                        'icon' => '',
                        'route_name' => 'chart',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Unit'
                    ],
                    [
                        'icon' => '',
                        'route_name' => 'laporan-inspektorat-jenderal',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Inspektorat Jenderal'
                    ],
                ]
            ],
            'devider',
            'administrator'=>[
                'icon' => 'list',
                'title' => 'Administrator',
                'sub_menu' => [
                    'chart' => [
                        'icon' => '',
                        'route_name' => 'chart',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Data'
                    ],
                    [
                        'icon' => '',
                        'route_name' => 'chart',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'User'
                    ],
                ]
            ],
           
        ];
    }
}
