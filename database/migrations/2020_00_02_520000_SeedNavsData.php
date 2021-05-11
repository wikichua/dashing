<?php

use Illuminate\Database\Migrations\Migration;

class SeedNavsData extends Migration
{
    public function up()
    {
        app(config('dashing.Models.Permission'))->createGroup('Pages', ['Migrate Pages'], 1);
        app(config('dashing.Models.Permission'))->createGroup('Navs', ['Migrate-navs'], 1);
    }

    public function down()
    {
    }
}
