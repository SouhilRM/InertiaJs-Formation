<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
        pour ajouter des elements à table => php artisan make:migration add_fields_to_lenomdetatablesssssssavecssssaupluriel_table
    */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {

            //ensuite tu rajoutes tes éléments ici
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('baths');
            $table->unsignedSmallInteger('area');

            $table->tinyText('city');
            $table->tinyText('code');
            $table->tinyText('street');
            $table->tinyText('street_nr');

            $table->unsignedInteger('price');
        });
    }

    /*
        et n'oublie pas la function down avec la methode dropColumn()
    */
    public function down(): void
    {
        //tu mets à l'iterieure le nom de ta table au pluriel tjr avec un tableau de éléments que tu as rajouter au dessus tous n'oublie pas 
        Schema::dropColumns('listings', [
            'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'
        ]);
    }
};

//NOTE: si tu t'es trompé dans un truc puis tu le modifie et tu veux remigrer Tous à partir de la derniere version => php artisan migrate:refresh
