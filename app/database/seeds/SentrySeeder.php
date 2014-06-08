<?php

//use AppModelsUser;

class SentrySeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        User::create(array(
            'email'       => 'triagmas@gmail.com',
            'password'    => Hash::make("fcd56aea"),
            'first_name'  => 'ALexander',
            'last_name'   => 'Ovsyannikov',
            'activated'   => 1,
        ));

        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));

        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('triagmas@gmail.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }

}
