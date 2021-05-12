<?php

use Illuminate\Database\Migrations\Migration;

class Seed2Data extends Migration
{
    public function up()
    {
        $admin_id = 1;
        app(config('dashing.Models.Permission'))->createGroup('Wiki Docs', ['read-wiki-docs'], $admin_id);
        // app(config('dashing.Models.Permission'))->createGroup('SEO Manager', ['Manage SEO'], $admin_id);

        $role = app(config('dashing.Models.Role'))->create([
            'name' => 'Reader',
            'admin' => false,
            'created_by' => $admin_id,
            'updated_by' => $admin_id,
        ]);

        $permission = app(config('dashing.Models.Permission'))->whereIn('name', ['access-admin-panel', 'read-wiki-docs'])->get()->pluck('id');
        $role->permissions()->sync($permission);
    }

    public function down()
    {
        app(config('dashing.Models.Permission'))->whereIn('group', ['Wiki Docs'])->delete();
        // app(config('dashing.Models.Permission'))->whereIn('group', ['SEO Manager'])->delete();
    }
}
