<?php

use Illuminate\Database\Migrations\Migration;

class SeedNavsData extends Migration
{
    public function up()
    {
        app(config('dashing.Models.Permission'))->createGroup('Pages', ['migrate-pages'], 1);
        app(config('dashing.Models.Permission'))->createGroup('Navs', ['migrate-navs'], 1);
    }

    public function down()
    {
    }
}
