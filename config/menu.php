<?php

return [
    'navigation' => [
        [
            'title' => '首页',
            'url' => '/',
        ],
        [
            'title' => '联系我们',
            'url' => '/contact',
        ],
    ],
    'sidebar' => [
        'home' => [
            'title' => '使用说明',
            'icon' => 'tachometer-alt',
            'route' => 'home.dashboard',
            'can' => ['home.dashboard'],
        ],
        'player' => [
            'title' => '选手管理',
            'icon' => 'user',
            'can' => ['player.index'],
            'children' => [
                'player' => [
                    'title' => '选手列表',
                    'route' => 'player.index',
                    'can' => ['player.index'],
                ],
                'seq' => [
                    'title' => '录入抽签号',
                    'route' => 'player.seq',
                    'can' => ['player.seq'],
                ],
            ],
        ],
        'marker' => [
            'title' => '评委管理',
            'icon' => 'marker',
            'can' => ['marker.index', 'marker.design', 'marker.teaching'],
            'children' => [
                'marker' => [
                    'title' => '专家列表',
                    'route' => 'marker.index',
                    'can' => ['marker.index'],
                ],
                'design' => [
                    'title' => '教学设计评分',
                    'route' => 'marker.design',
                    'can' => ['marker.design'],
                ],
                'teaching' => [
                    'title' => '课堂教学评分',
                    'route' => 'marker.teaching',
                    'can' => ['marker.teaching'],
                ],
            ],
        ],
        'system' => [
            'title' => '系统管理',
            'icon' => 'cog',
            'can' => ['user.index', 'role.index', 'permission.index', 'group.index', 'setting.index', 'log.index'],
            'children' => [
                'user' => [
                    'title' => '用户管理',
                    'route' => 'user.index',
                    'can' => ['user.index'],
                ],
                'role' => [
                    'title' => '角色管理',
                    'route' => 'role.index',
                    'can' => ['role.index'],
                ],
                'permission' => [
                    'title' => '权限管理',
                    'route' => 'permission.index',
                    'can' => ['permission.index'],
                ],
                'group' => [
                    'title' => '专家组管理',
                    'route' => 'group.index',
                    'can' => ['group.index'],
                ],
                'setting' => [
                    'title' => '系统设置',
                    'route' => 'setting.index',
                    'can' => ['setting.index'],
                ],
                'log' => [
                    'title' => '日志管理',
                    'route' => 'log.index',
                    'can' => ['log.index'],
                ],
            ],
        ],
        'database' => [
            'title' => '数据字典',
            'icon' => 'database',
            'can' => ['gender.index', 'department.index', 'subject.index', 'education.index', 'degree.index'],
            'children' => [
                'gender' => [
                    'title' => '性别管理',
                    'route' => 'gender.index',
                    'can' => ['gender.index'],
                ],
                'department' => [
                    'title' => '院校管理',
                    'route' => 'department.index',
                    'can' => ['department.index'],
                ],
                'subject' => [
                    'title' => '学科管理',
                    'route' => 'subject.index',
                    'can' => ['subject.index'],
                ],
                'education' => [
                    'title' => '学历管理',
                    'route' => 'education.index',
                    'can' => ['education.index'],
                ],
                'degree' => [
                    'title' => '学位管理',
                    'route' => 'degree.index',
                    'can' => ['degree.index'],
                ],
            ],
        ],
        'summary' => [
            'title' => '数据汇总',
            'icon' => 'table',
            'can' => ['summary.player', 'summary.marker', 'summary.rank'],
            'children' => [
                [
                    'title' => '选手汇总',
                    'route' => 'summary.player',
                    'can' => ['summary.player'],
                ],
                [
                    'title' => '专家汇总',
                    'route' => 'summary.marker',
                    'can' => ['summary.marker'],
                ],
                [
                    'title' => '排行榜',
                    'route' => 'summary.rank',
                    'can' => ['summary.rank'],
                ],
            ],
        ],
        '个人设置',
        'password' => [
            'title' => '修改密码',
            'icon' => 'shield-alt',
            'route' => 'password.edit',
            'can' => ['password.edit'],
        ],
    ],
];
