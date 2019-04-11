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
            [
                'title' => '使用说明',
                'icon' => 'tachometer-alt',
                'route' => 'home.dashboard',
            ],
        ],
        'document' => [
            'title' => '比赛材料管理',
            [
                'title' => '比赛材料管理',
                'icon' => 'users',
                'route' => 'document.index',
            ],
        ],
        'review' => [
            'title' => '评审管理',
            [
                'title' => '评审管理',
                'icon' => 'users',
                'route' => 'review.index',
            ],
        ],
        'user' => [
            'title' => '用户管理',
            [
                'title' => '用户管理',
                'icon' => 'users',
                'route' => 'user.index',
            ],
        ],
        'role' => [
            'title' => '角色管理',
            [
                'title' => '角色管理',
                'icon' => 'users',
                'route' => 'role.index',
            ],
        ],
        'permission' => [
            'title' => '权限管理',
            [
                'title' => '权限管理',
                'icon' => 'users',
                'route' => 'permission.index',
            ],
        ],
        'group' => [
            'title' => '专家组管理',
            [
                'title' => '专家组管理',
                'icon' => 'users',
                'route' => 'group.index',
            ],
        ],
        'gender' => [
            'title' => '性别管理',
            [
                'title' => '性别管理',
                'icon' => 'users',
                'route' => 'gender.index',
            ],
        ],
        'department' => [
            'title' => '院校管理',
            [
                'title' => '院校管理',
                'icon' => 'users',
                'route' => 'department.index',
            ],
        ],
        'subject' => [
            'title' => '学科管理',
            [
                'title' => '学科管理',
                'icon' => 'users',
                'route' => 'subject.index',
            ],
        ],
        'education' => [
            'title' => '学历管理',
            [
                'title' => '学历管理',
                'icon' => 'users',
                'route' => 'education.index',
            ],
        ],
        'degree' => [
            'title' => '学位管理',
            [
                'title' => '学位管理',
                'icon' => 'users',
                'route' => 'degree.index',
            ],
        ],
        'setting' => [
            'title' => '系统设置',
            [
                'title' => '系统设置',
                'icon' => 'users',
                'route' => 'setting.index',
            ],
        ],
        'log' => [
            'title' => '日志管理',
            [
                'title' => '日志管理',
                'icon' => 'book',
                'route' => 'log.index',
            ],
        ],
        '个人设置',
        'password' => [
            'title' => '修改密码',
            [
                'title' => '修改密码',
                'icon' => 'shield-alt',
                'route' => 'password.edit',
            ],
        ],
    ],
];
