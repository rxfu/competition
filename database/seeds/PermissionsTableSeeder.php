<?php

use App\Entities\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'slug' => 'home.dashboard',
            'name' => '查看使用说明',
        ]);
        Permission::create([
            'slug' => 'user.index',
            'name' => '查看用户列表',
        ]);
        Permission::create([
            'slug' => 'user.create',
            'name' => '创建用户',
        ]);
        Permission::create([
            'slug' => 'user.store',
            'name' => '保存用户',
        ]);
        Permission::create([
            'slug' => 'user.edit',
            'name' => '编辑用户',
        ]);
        Permission::create([
            'slug' => 'user.update',
            'name' => '更新用户',
        ]);
        Permission::create([
            'slug' => 'user.delete',
            'name' => '删除用户',
        ]);
        Permission::create([
            'slug' => 'user.upload',
            'name' => '上传用户文件',
        ]);
        Permission::create([
            'slug' => 'user.import',
            'name' => '导入用户',
        ]);

        Permission::create([
            'slug' => 'role.index',
            'name' => '查看角色列表',
        ]);
        Permission::create([
            'slug' => 'role.create',
            'name' => '创建角色',
        ]);
        Permission::create([
            'slug' => 'role.store',
            'name' => '保存角色',
        ]);
        Permission::create([
            'slug' => 'role.edit',
            'name' => '编辑角色',
        ]);
        Permission::create([
            'slug' => 'role.update',
            'name' => '更新角色',
        ]);
        Permission::create([
            'slug' => 'role.delete',
            'name' => '删除角色',
        ]);
        Permission::create([
            'slug' => 'role.permission',
            'name' => '查看角色权限列表',
        ]);
        Permission::create([
            'slug' => 'role.assign',
            'name' => '授予角色权限',
        ]);
        
        Permission::create([
            'slug' => 'permission.index',
            'name' => '查看权限列表',
        ]);
        Permission::create([
            'slug' => 'permission.create',
            'name' => '创建权限',
        ]);
        Permission::create([
            'slug' => 'permission.store',
            'name' => '保存权限',
        ]);
        Permission::create([
            'slug' => 'permission.edit',
            'name' => '编辑权限',
        ]);
        Permission::create([
            'slug' => 'permission.update',
            'name' => '更新权限',
        ]);
        Permission::create([
            'slug' => 'permission.delete',
            'name' => '删除权限',
        ]);
        
        Permission::create([
            'slug' => 'group.index',
            'name' => '查看组列表',
        ]);
        Permission::create([
            'slug' => 'group.create',
            'name' => '创建组',
        ]);
        Permission::create([
            'slug' => 'group.store',
            'name' => '保存组',
        ]);
        Permission::create([
            'slug' => 'group.edit',
            'name' => '编辑组',
        ]);
        Permission::create([
            'slug' => 'group.update',
            'name' => '更新组',
        ]);
        Permission::create([
            'slug' => 'group.delete',
            'name' => '删除组',
        ]);
        
        Permission::create([
            'slug' => 'gender.index',
            'name' => '查看性别列表',
        ]);
        Permission::create([
            'slug' => 'gender.create',
            'name' => '创建性别',
        ]);
        Permission::create([
            'slug' => 'gender.store',
            'name' => '保存性别',
        ]);
        Permission::create([
            'slug' => 'gender.edit',
            'name' => '编辑性别',
        ]);
        Permission::create([
            'slug' => 'gender.update',
            'name' => '更新性别',
        ]);
        Permission::create([
            'slug' => 'gender.delete',
            'name' => '删除性别',
        ]);
        
        Permission::create([
            'slug' => 'department.index',
            'name' => '查看院校列表',
        ]);
        Permission::create([
            'slug' => 'department.create',
            'name' => '创建院校',
        ]);
        Permission::create([
            'slug' => 'department.store',
            'name' => '保存院校',
        ]);
        Permission::create([
            'slug' => 'department.edit',
            'name' => '编辑院校',
        ]);
        Permission::create([
            'slug' => 'department.update',
            'name' => '更新院校',
        ]);
        Permission::create([
            'slug' => 'department.delete',
            'name' => '删除院校',
        ]);
        
        Permission::create([
            'slug' => 'subject.index',
            'name' => '查看学科列表',
        ]);
        Permission::create([
            'slug' => 'subject.create',
            'name' => '创建学科',
        ]);
        Permission::create([
            'slug' => 'subject.store',
            'name' => '保存学科',
        ]);
        Permission::create([
            'slug' => 'subject.edit',
            'name' => '编辑学科',
        ]);
        Permission::create([
            'slug' => 'subject.update',
            'name' => '更新学科',
        ]);
        Permission::create([
            'slug' => 'subject.delete',
            'name' => '删除学科',
        ]);

        Permission::create([
            'slug' => 'education.index',
            'name' => '查看学历列表',
        ]);
        Permission::create([
            'slug' => 'education.create',
            'name' => '创建学历',
        ]);
        Permission::create([
            'slug' => 'education.store',
            'name' => '保存学历',
        ]);
        Permission::create([
            'slug' => 'education.edit',
            'name' => '编辑学历',
        ]);
        Permission::create([
            'slug' => 'education.update',
            'name' => '更新学历',
        ]);
        Permission::create([
            'slug' => 'education.delete',
            'name' => '删除学历',
        ]);

        Permission::create([
            'slug' => 'degree.index',
            'name' => '查看学位列表',
        ]);
        Permission::create([
            'slug' => 'degree.create',
            'name' => '创建学位',
        ]);
        Permission::create([
            'slug' => 'degree.store',
            'name' => '保存学位',
        ]);
        Permission::create([
            'slug' => 'degree.edit',
            'name' => '编辑学位',
        ]);
        Permission::create([
            'slug' => 'degree.update',
            'name' => '更新学位',
        ]);
        Permission::create([
            'slug' => 'degree.delete',
            'name' => '删除学位',
        ]);

        Permission::create([
            'slug' => 'setting.index',
            'name' => '查看设置列表',
        ]);
        Permission::create([
            'slug' => 'setting.create',
            'name' => '创建设置',
        ]);
        Permission::create([
            'slug' => 'setting.store',
            'name' => '保存设置',
        ]);
        Permission::create([
            'slug' => 'setting.edit',
            'name' => '编辑设置',
        ]);
        Permission::create([
            'slug' => 'setting.update',
            'name' => '更新设置',
        ]);
        Permission::create([
            'slug' => 'setting.delete',
            'name' => '删除设置',
        ]);
        
        Permission::create([
            'slug' => 'player.index',
            'name' => '查看选手列表',
        ]);
        Permission::create([
            'slug' => 'player.create',
            'name' => '创建选手',
        ]);
        Permission::create([
            'slug' => 'player.store',
            'name' => '保存选手',
        ]);
        Permission::create([
            'slug' => 'player.edit',
            'name' => '编辑选手',
        ]);
        Permission::create([
            'slug' => 'player.update',
            'name' => '更新选手',
        ]);
        Permission::create([
            'slug' => 'player.delete',
            'name' => '删除选手',
        ]);
        Permission::create([
            'slug' => 'player.seq',
            'name' => '录入抽签号',
        ]);
        Permission::create([
            'slug' => 'document.seq',
            'name' => '保存抽签号',
        ]);
        Permission::create([
            'slug' => 'player.upload',
            'name' => '上传选手文件',
        ]);
        Permission::create([
            'slug' => 'player.import',
            'name' => '导入选手',
        ]);
        Permission::create([
            'slug' => 'player.document',
            'name' => '上传材料',
        ]);

        Permission::create([
            'slug' => 'document.store',
            'name' => '保存上传材料',
        ]);

        Permission::create([
            'slug' => 'marker.index',
            'name' => '查看评委列表',
        ]);
        Permission::create([
            'slug' => 'marker.create',
            'name' => '创建评委',
        ]);
        Permission::create([
            'slug' => 'marker.store',
            'name' => '保存评委',
        ]);
        Permission::create([
            'slug' => 'marker.edit',
            'name' => '编辑评委',
        ]);
        Permission::create([
            'slug' => 'marker.update',
            'name' => '更新评委',
        ]);
        Permission::create([
            'slug' => 'marker.delete',
            'name' => '删除评委',
        ]);
        Permission::create([
            'slug' => 'marker.upload',
            'name' => '上传评委文件',
        ]);
        Permission::create([
            'slug' => 'marker.import',
            'name' => '导入评委',
        ]);
        Permission::create([
            'slug' => 'marker.audit',
            'name' => '审核评委',
        ]);
        Permission::create([
            'slug' => 'marker.unaudit',
            'name' => '取消审核评委',
        ]);
        Permission::create([
            'slug' => 'marker.design',
            'name' => '浏览教学设计',
        ]);
        Permission::create([
            'slug' => 'marker.teaching',
            'name' => '浏览课堂教学',
        ]);

        Permission::create([
            'slug' => 'review.design',
            'name' => '教学设计评分',
        ]);
        Permission::create([
            'slug' => 'review.teaching',
            'name' => '课堂教学评分',
        ]);

        Permission::create([
            'slug' => 'log.index',
            'name' => '查看日志列表',
        ]);

        Permission::create([
            'slug' => 'password.edit',
            'name' => '显示修改密码页面',
        ]);
        Permission::create([
            'slug' => 'password.change',
            'name' => '修改密码',
        ]);
        Permission::create([
            'slug' => 'password.reset',
            'name' => '重置密码',
        ]);

        Permission::create([
            'slug' => 'summary.player',
            'name' => '汇总选手数据',
        ]);
        Permission::create([
            'slug' => 'summary.marker',
            'name' => '汇总评委数据',
        ]);
        Permission::create([
            'slug' => 'summary.rank',
            'name' => '显示选手排行',
        ]);
        Permission::create([
            'slug' => 'summary.export',
            'name' => '导出计分表',
        ]);
    }
}
