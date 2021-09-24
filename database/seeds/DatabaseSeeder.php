<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        DB::table('admin_menu')->insert([
            ['id' => 1, 'parent_id' => 0, 'order' => 1, 'title' => '仪表盘', 'icon' => 'fa-bar-chart', 'uri' => '/'],
            ['id' => 2, 'parent_id' => 0, 'order' => 11, 'title' => '权限管理', 'icon' => 'fa-tasks', 'uri' => ''],
            ['id' => 3, 'parent_id' => 2, 'order' => 12, 'title' => '管理员', 'icon' => 'fa-users', 'uri' => 'auth/users'],
            ['id' => 4, 'parent_id' => 2, 'order' => 13, 'title' => '角色', 'icon' => 'fa-user', 'uri' => 'auth/roles'],
            ['id' => 5, 'parent_id' => 2, 'order' => 14, 'title' => '权限', 'icon' => 'fa-ban', 'uri' => 'auth/permissions'],
            ['id' => 6, 'parent_id' => 2, 'order' => 15, 'title' => '菜单', 'icon' => 'fa-bars', 'uri' => 'auth/menu'],
            ['id' => 7, 'parent_id' => 2, 'order' => 16, 'title' => '操作日志', 'icon' => 'fa-history', 'uri' => 'auth/logs'],
            ['id' => 8, 'parent_id' => 0, 'order' => 4, 'title' => '博客管理', 'icon' => 'fa-bars', 'uri' => 'blogs'],
            ['id' => 9, 'parent_id' => 0, 'order' => 3, 'title' => '文章管理', 'icon' => 'fa-file-text-o', 'uri' => 'articles'],
            ['id' => 10, 'parent_id' => 0, 'order' => 6, 'title' => '大事记管理', 'icon' => 'fa-list-alt', 'uri' => 'datelines'],
            ['id' => 11, 'parent_id' => 0, 'order' => 5, 'title' => '评论管理', 'icon' => 'fa-comments-o', 'uri' => 'comments'],
            ['id' => 12, 'parent_id' => 0, 'order' => 9, 'title' => '系统设置', 'icon' => 'fa-cog', 'uri' => 'settings'],
            ['id' => 13, 'parent_id' => 0, 'order' => 7, 'title' => '页面管理', 'icon' => 'fa-pagelines', 'uri' => 'pages'],
            ['id' => 14, 'parent_id' => 0, 'order' => 2, 'title' => '公告管理', 'icon' => 'fa-align-justify', 'uri' => 'notices'],
            ['id' => 15, 'parent_id' => 0, 'order' => 8, 'title' => '手动检测', 'icon' => 'fa-calendar-check-o', 'uri' => 'check'],
            ['id' => 16, 'parent_id' => 0, 'order' => 10, 'title' => '媒体管理', 'icon' => 'fa-file', 'uri' => 'media'],
        ]);

        DB::table('admin_permissions')->insert([
            ['id' => 1, 'name' => '所有权限', 'slug' => '*', 'http_method' => '', 'http_path' => '*'],
            ['id' => 2, 'name' => '仪表盘', 'slug' => 'dashboard', 'http_method' => 'GET', 'http_path' => '/'],
            ['id' => 3, 'name' => '登录', 'slug' => 'auth.login', 'http_method' => '', 'http_path' => '/auth/login
/auth/logout'],
            ['id' => 4, 'name' => '管理员设置', 'slug' => 'auth.setting', 'http_method' => 'GET,PUT', 'http_path' => '/auth/setting'],
            ['id' => 5, 'name' => '权限管理', 'slug' => 'auth.management', 'http_method' => '', 'http_path' => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs'],
        ]);

        DB::table('admin_role_menu')->insert([
            ['role_id' => 1, 'menu_id' => 2],
            ['role_id' => 1, 'menu_id' => 12],
        ]);

        DB::table('admin_roles')->insert([
            ['id' => 1, 'name' => 'Administrator', 'slug' => 'administrator', 'updated_at' => $date, 'created_at' => $date],
        ]);

        DB::table('admin_role_permissions')->insert([
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 3, 'permission_id' => 3],
            ['role_id' => 3, 'permission_id' => 2],
            ['role_id' => 3, 'permission_id' => 6],
            ['role_id' => 3, 'permission_id' => 4],
            ['role_id' => 3, 'permission_id' => 7],
            ['role_id' => 3, 'permission_id' => 8],
            ['role_id' => 3, 'permission_id' => 9],
            ['role_id' => 3, 'permission_id' => 10],
            ['role_id' => 3, 'permission_id' => 11],
        ]);

        DB::table('admin_role_users')->insert([
            ['role_id' => 1, 'user_id' => 1],
        ]);

        DB::table('admin_users')->insert([
            [
                'id' => 1,
                'email' => 'admin@admin.cn',
                'username' => 'admin',
                'password' => '$2y$10$cLxXb1NYGK2nY7PoyWnmyu0bBgnu8GDNbsfO1XxT6TnajKMRocr.O',
                'name' => '十年之约项目组',
                'avatar' => null,
                'remember_token' => null,
                'updated_at' => $date,
                'created_at' => $date
            ]
        ]);

        DB::table('article')->insert([
            [
                'id' => 1,
                'name' => 'System',
                'email' => 'admin@foreverblog.cn',
                'title' => '关于',
                'content' => '',
                'is_comment' => 1,
                'type' => 'page',
                'key' => 'about',
                'read_num' => 0,
                'updated_at' => $date,
                'created_at' => $date,
            ],
            [
                'id' => 2,
                'name' => 'System',
                'email' => 'admin@foreverblog.cn',
                'title' => '捐赠',
                'content' => '',
                'is_comment' => 1,
                'type' => 'page',
                'key' => 'donate',
                'read_num' => 0,
                'updated_at' => $date,
                'created_at' => $date,
            ],
            [
                'id' => 3,
                'name' => 'System',
                'email' => 'admin@foreverblog.cn',
                'title' => '留言',
                'content' => '',
                'is_comment' => 1,
                'type' => 'page',
                'key' => 'message',
                'read_num' => 0,
                'updated_at' => $date,
                'created_at' => $date,
            ],
            [
                'id' => 4,
                'name' => 'System',
                'email' => 'admin@foreverblog.cn',
                'title' => '条约',
                'content' => '',
                'is_comment' => 1,
                'type' => 'page',
                'key' => 'treaty',
                'read_num' => 0,
                'updated_at' => $date,
                'created_at' => $date,
            ],
        ]);
    }
}
