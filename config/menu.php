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
            'dashboard' => [
                'title' => '使用说明',
                'icon' => 'tachometer-alt',
                'route' => 'home.dashboard',
            ],
        ],
        'document' => [
            'index' => [
                'title' => '比赛材料管理',
                'icon' => 'users',
                'route' => 'document.index',
            ],
        ],
        'review' => [
            'index' => [
                'title' => '评审管理',
                'icon' => 'users',
                'route' => 'review.index',
            ],
        ],
        'user' => [
            'index' => [
                'title' => '用户管理',
                'icon' => 'users',
                'route' => 'user.index',
            ],
        ],
        'role' => [
            'index' => [
                'title' => '角色管理',
                'icon' => 'users',
                'route' => 'role.index',
            ],
        ],
        'permission' => [
            'index' => [
                'title' => '权限管理',
                'icon' => 'users',
                'route' => 'permission.index',
            ],
        ],
        'group' => [
            'index' => [
                'title' => '专家组管理',
                'icon' => 'users',
                'route' => 'group.index',
            ],
        ],
        'gender' => [
            'index' => [
                'title' => '性别管理',
                'icon' => 'users',
                'route' => 'gender.index',
            ],
        ],
        'department' => [
            'index' => [
                'title' => '院校管理',
                'icon' => 'users',
                'route' => 'department.index',
            ],
        ],
        'subject' => [
            'index' => [
                'title' => '学科管理',
                'icon' => 'users',
                'route' => 'subject.index',
            ],
        ],
        'education' => [
            'index' => [
                'title' => '学历管理',
                'icon' => 'users',
                'route' => 'education.index',
            ],
        ],
        'degree' => [
            'index' => [
                'title' => '学位管理',
                'icon' => 'users',
                'route' => 'degree.index',
            ],
        ],
        'setting' => [
            'index' => [
                'title' => '系统设置',
                'icon' => 'users',
                'route' => 'setting.index',
            ],
        ],
        'log' => [
            'index' => [
                'title' => '日志管理',
                'icon' => 'book',
                'route' => 'log.index',
            ],
        ],
        '个人设置',
        'password' => [
            'edit' => [
                'title' => '修改密码',
                'icon' => 'shield-alt',
                'route' => 'password.edit',
            ],
        ],
    ],
];
