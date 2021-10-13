<?php

namespace App\Main;

class SideMenuIrwil
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
            'data' =>[
                'icon' => 'box',
                'title' => 'Data',
                'sub_menu'=>[
                  
                    'ikk' => [
                        'icon' => 'list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-ikk',
                        'title' => 'IKK'
                    ],
                    'kegiatan' => [
                        'icon' => 'list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-kegiatan',
                        'title' => 'Kegiatan'
                    ],
                    'penyelesaian-lhp' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-penyelesaian-lhp',
                        'title' => 'Penyelesaian LHP'
                    ],
                    'pengelolaan-surat-masuk' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-surat-masuk',
                        'title' => 'Surat Masuk'
                    ],
                    'kinerja-lainnya' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name'=> 'list-kinerja-lainnya',
                        'title' => 'Kinerja Lainnya'
                    ],
                ]
            ],
        ];
    }
}
