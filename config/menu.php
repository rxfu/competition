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
        ],
        'player' => [
            'title' => '选手管理',
            'icon' => 'user',
            'children' => [
                'document' => [
                    'title' => '比赛材料管理',
                    'route' => 'document.index',
                ],
            ],
        ],
        'marker' => [
            'title' => '评委管理',
            'icon' => 'marker',
            'children' => [
                'review' => [
                    'title' => '评审管理',
                    'icon' => 'users',
                    'route' => 'review.index',
                ],
            ],
        ],
        'system' => [
            'title' => '系统管理',
            'icon' => 'cog',
            'children' => [
                'user' => [
                    'title' => '用户管理',
                    'route' => 'user.index',
                ],
                'role' => [
                    'title' => '角色管理',
                    'route' => 'role.index',
                ],
                'permission' => [
                    'title' => '权限管理',
                    'route' => 'permission.index',
                ],
                'group' => [
                    'title' => '专家组管理',
                    'route' => 'group.index',
                ],
                'setting' => [
                    'title' => '系统设置',
                    'route' => 'setting.index',
                ],
                'log' => [
                    'title' => '日志管理',
                    'route' => 'log.index',
                ],
            ],
        ],
        'database' => [
            'title' => '数据字典',
            'icon' => 'database',
            'children' => [
                'gender' => [
                    'title' => '性别管理',
                    'route' => 'gender.index',
                ],
                'department' => [
                    'title' => '院校管理',
                    'route' => 'department.index',
                ],
                'subject' => [
                    'title' => '学科管理',
                    'route' => 'subject.index',
                ],
                'education' => [
                    'title' => '学历管理',
                    'route' => 'education.index',
                ],
                'degree' => [
                    'title' => '学位管理',
                    'route' => 'degree.index',
                ],
            ],
        ],
        'summary' => [
            'title' => '数据汇总',
            'icon' => 'table',
            'children' => [
                [
                    'title' => '选手汇总',
                    'route' => 'summary.player',
                ],
                [
                    'title' => '专家汇总',
                    'route' => 'summary.marker',
                ],
            ],
        ],
        '个人设置',
        'password' => [
            'title' => '修改密码',
            'icon' => 'shield-alt',
            'route' => 'password.edit',
        ],
    ],
];
