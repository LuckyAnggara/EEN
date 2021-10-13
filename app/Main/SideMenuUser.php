<?php

namespace App\Main;

class SideMenuUser
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
            'data' =>[
                'icon' => 'box',
                'title' => 'Data',
                'sub_menu'=>[
                    'iku' => [
                        'icon' => 'list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-iku',
                        'title' => 'IKU'
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
                    'pengembangan-kompetensi' => [
                        'icon' => '',
                        'route_name'=> 'list-kompetensi',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Kompetensi'
                    ],
                    'pengelolaan-dumas' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'DUMAS'
                    ],
                    'pengelolaan-hukdis' => [
                        'icon' => '',
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
                    'realisasi-anggaran' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name'=> 'list-realisasi-anggaran',
                        'title' => 'Realisasi Anggaran'
                    ],
                    'pengelolaan-surat-masuk' => [
                        'icon' => '',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'route_name' => 'list-kinerja-lainnya',
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
