<?php


class UserTableSeeder extends Seeder
{
    public function run(){
        $faker = Faker\Factory::create();
        for($i=0;$i<20;$i++){
            $aUser = array(
                'username'=>$faker->userName,
                'password'=>Hash::make('123456'),
                'email'=>$faker->safeEmail,
                'type'=>$faker->numberBetween(0, 1),
                'created_at'=>$faker->dateTimeBetween('-3 years'),
            );
            User::create($aUser);
        }
    }
}