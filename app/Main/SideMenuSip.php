<?php

namespace App\Main;

class SideMenuSip
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
                    'kegiatan' => [
                        'icon' => 'list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-kegiatan',
                        'title' => 'Kegiatan'
                    ],
                    'pengelolaan-dumas' => [
                        'icon' => '',
                        'route_name'=> 'list-dumas',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'DUMAS'
                    ],
                    'pengelolaan-hukdis' => [
                        'icon' => '',
                        'route_name'=> 'list-hukdis',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'HUKDIS'
                    ],
                    'temuan-internal' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name'=> 'list-temuan-internal',
                        'title' => 'Temuan Internal'
                    ],
                    'temuan-eksternal' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name'=> 'list-temuan-eksternal',
                        'title' => 'Temuan Eksternal'
                    ],
                    'surat-masuk' => [
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
