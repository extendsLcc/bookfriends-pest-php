<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (config('app.env') === 'testing') {
            Schema::createMergeView(
                'friends_view',
                [(new User)->acceptedFriendsOf(), (new User)->acceptedFriendsOfMine()]
            );
        } else {
            /*
             * Workaround: Postgres do not accept implicit boolean without casting,
             */
            DB::statement("
            create view friends_view as
            (select users.id,
                    users.name,
                    users.email,
                    users.email_verified_at,
                    users.password,
                    users.remember_token,
                    users.created_at,
                    users.updated_at,
                    users.two_factor_secret,
                    users.two_factor_recovery_codes,
                    friends.friend_id as laravel_foreign_key,
                    'App\Models\User' as laravel_model,
                    ''                as laravel_placeholders,
                    ''                as laravel_with
             from users
                      inner join friends on users.id = friends.user_id
             where friends.accepted = true)
            union all
            (select users.id,
                    users.name,
                    users.email,
                    users.email_verified_at,
                    users.password,
                    users.remember_token,
                    users.created_at,
                    users.updated_at,
                    users.two_factor_secret,
                    users.two_factor_recovery_codes,
                    friends.user_id   as laravel_foreign_key,
                    'App\Models\User' as laravel_model,
                    ''                as laravel_placeholders,
                    ''                as laravel_with
             from users
                      inner join friends on users.id = friends.friend_id
             where friends.accepted = true)
        ");
        }
    }

    public function down()
    {
        Schema::dropView('friends_view');
    }
};
