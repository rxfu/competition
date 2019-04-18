<?php

return [
    'log' => [
        'list' => true,
        [
            'field' => 'user_id',
            'list' => true,
            'responsive' => 'all',
        ],
        [
            'field' => 'ip',
            'list' => true,
        ],
        [
            'field' => 'level',
            'list' => true,
        ],
        [
            'field' => 'path',
            'list' => true,
        ],
        [
            'field' => 'method',
            'list' => true,
        ],
        [
            'field' => 'action',
            'list' => true,
        ],
        [
            'field' => 'entity',
            'list' => true,
        ],
        [
            'field' => 'entity_id',
            'list' => true,
        ],
        [
            'field' => 'content',
            'list' => true,
            'responsive' => 'none',
        ],
        [
            'field' => 'created_at',
            'list' => true,
        ],
    ],
    'user' => [
        'reset' => true,
        [
            'field' => 'username',
            'list' => true,
            'create' => true,
            'edit' => true,
            'responsive' => 'all',
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'password',
            'list' => false,
            'create' => true,
            'type' => 'password',
            'required' => true,
            'help' => '密码至少6位',
        ],
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'email',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
        ],
        [
            'field' => 'is_enable',
            'list' => true,
            'create' => true,
            'edit' => true,
            'presenter' => true,
            'responsive' => 'none',
            'type' => 'radio',
            'values' => '1:是|0:否',
            'default' => '1',
            'required' => true,
        ],
        [
            'field' => 'is_super',
            'list' => true,
            'create' => false,
            'edit' => false,
            'presenter' => true,
            'responsive' => 'none',
        ],
        [
            'field' => 'created_at',
            'list' => true,
            'create' => false,
            'edit' => false,
            'responsive' => 'none',
        ],
        [
            'field' => 'role_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'role',
            'collection' => 'roles',
            'required' => true,
        ],
        [
            'field' => 'department_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'department',
            'collection' => 'departments',
            'required' => true,
        ],
        [
            'field' => 'leader',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'responsive' => 'none',
        ],
        [
            'field' => 'leader_phone',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'responsive' => 'none',
        ],
    ],
    'role' => [
        'assign' => true,
        [
            'field' => 'slug',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'description',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'textarea',
        ],
        [
            'field' => 'permissions',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relations' => 'permissions',
        ],
    ],
    'permission' => [
        [
            'field' => 'slug',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'description',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'textarea',
        ],
        [
            'field' => 'roles',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relations' => 'roles',
        ],
    ],
    'department' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'description',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'textarea',
        ],
        [
            'field' => 'is_enable',
            'list' => true,
            'create' => true,
            'edit' => true,
            'presenter' => true,
            'type' => 'radio',
            'values' => '1:是|0:否',
            'default' => '1',
            'required' => true,
        ],
    ],
    'group' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'description',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'textarea',
        ],
    ],
    'gender' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
    ],
    'subject' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
    ],
    'education' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
    ],
    'degree' => [
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
    ],
    'setting' => [
        [
            'field' => 'year',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
            'readonly' => true,
            'default' => date('Y'),
        ],
        [
            'field' => 'slug',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'begin_at',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'datetime',
        ],
        [
            'field' => 'end_at',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'datetime',
        ],
        [
            'field' => 'is_enable',
            'list' => true,
            'create' => true,
            'edit' => true,
            'presenter' => true,
            'type' => 'radio',
            'values' => '1:是|0:否',
            'default' => '1',
            'required' => true,
        ],
    ],
    'document' => [
        [
            'field' => 'year',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
            'readonly' => true,
            'default' => date('Y'),
        ],
        [
            'field' => 'user_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'relation' => 'user',
            'type' => 'text',
            'readonly' => true,
        ],
        [
            'field' => 'syllabus',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'file',
        ],
        [
            'field' => 'design',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'file',
        ],
        [
            'field' => 'section',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'file',
        ],
        [
            'field' => 'catalog',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'file',
        ],
        [
            'field' => 'seq',
            'list' => true,
            'create' => false,
            'edit' => false,
        ],
    ],
    'review' => [
        'list' => true,
        [
            'field' => 'year',
            'list' => true,
        ],
        [
            'field' => 'marker_id',
            'list' => true,
        ],
        [
            'field' => 'player_id',
            'list' => true,
        ],
        [
            'field' => 'design_score',
            'list' => true,
        ],
        [
            'field' => 'live_score',
            'list' => true,
        ],
    ],
    'player' => [
        'reset' => true,
        'upload' => true,
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'gender_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'gender',
            'collection' => 'genders',
            'required' => true,
        ],
        [
            'field' => 'idnumber',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'birthday',
            'list' => true,
            'create' => false,
            'edit' => false,
            'type' => 'text',
            'required' => true,
            'readonly' => true,
        ],
        [
            'field' => 'position',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'education_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'education',
            'collection' => 'educations',
            'required' => true,
        ],
        [
            'field' => 'degree_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'degree',
            'collection' => 'degrees',
            'required' => true,
        ],
        [
            'field' => 'teaching_begin_time',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'subject_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'subject',
            'collection' => 'subjects',
            'required' => true,
        ],
        [
            'field' => 'group_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'group',
            'collection' => 'groups',
            'required' => true,
        ],
        [
            'field' => 'course',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'phone',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'syllabus',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relation' => 'document',
            'prop' => 'syllabus',
            'responsive' => 'none',
        ],
        [
            'field' => 'design',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relation' => 'document',
            'prop' => 'design',
            'responsive' => 'none',
        ],
        [
            'field' => 'section',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relation' => 'document',
            'prop' => 'section',
            'responsive' => 'none',
        ],
        [
            'field' => 'catalog',
            'list' => true,
            'create' => false,
            'edit' => false,
            'relation' => 'document',
            'prop' => 'catalog',
            'responsive' => 'none',
        ],
    ],
    'marker' => [
        'reset' => true,
        'audit' => true,
        [
            'field' => 'name',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'gender_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'gender',
            'collection' => 'genders',
            'required' => true,
        ],
        [
            'field' => 'idnumber',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'birthday',
            'list' => true,
            'create' => false,
            'edit' => false,
            'type' => 'text',
            'required' => true,
            'readonly' => true,
        ],
        [
            'field' => 'position',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'education_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'education',
            'collection' => 'educations',
            'required' => true,
        ],
        [
            'field' => 'degree_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'degree',
            'collection' => 'degrees',
            'required' => true,
        ],
        [
            'field' => 'subject_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'subject',
            'collection' => 'subjects',
            'required' => true,
        ],
        [
            'field' => 'major',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
        ],
        [
            'field' => 'direction',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
        ],
        [
            'field' => 'group_id',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'select',
            'relation' => 'group',
            'collection' => 'groups',
            'required' => true,
        ],
        [
            'field' => 'phone',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'email',
            'list' => true,
            'create' => true,
            'edit' => true,
            'type' => 'text',
            'required' => true,
        ],
        [
            'field' => 'is_passed',
            'list' => true,
            'create' => false,
            'edit' => false,
            'presenter' => true,
            'responsive' => 'none',
        ],
    ],
    'summary' => [
        'player'=>[
            'list' => true,
            [
                'field' => 'group_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'group',
                'collection' => 'groups',
            ],
            [
                'field' => 'name',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'gender_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'gender',
                'collection' => 'genders',
            ],
            [
                'field' => 'birthday',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'course',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'phone',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'idnumber',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
        ],
        'marker'=>[
            'list' => true,
            [
                'field' => 'department_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'department',
                'collection' => 'departments',
            ],
            [
                'field' => 'subject_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'subject',
                'collection' => 'subjects',
            ],
            [
                'field' => 'major',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'direction',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'group_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'group',
                'collection' => 'groups',
            ],
            [
                'field' => 'name',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'gender_id',
                'list' => true,
                'create' => false,
                'edit' => false,
                'relation' => 'gender',
                'collection' => 'genders',
            ],
            [
                'field' => 'position',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'phone',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
            [
                'field' => 'email',
                'list' => true,
                'create' => false,
                'edit' => false,
            ],
        ],
    ],
];
