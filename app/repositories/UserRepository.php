<?php

namespace App\repositories;
use Illuminate\Support\Facades\DB;
use App\interfaces\UserRepositoryInterface;
use App\Models\User;

Class UserRepository implements UserRepositoryInterface
{
    public function getDataUsers()
    {
        return DB::table('users')->get();
    }

    public function insertDataUser($data)
    {
        // return DB::table('users')->insert($data);

        //cách 2
        $newUser = new User;
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->password = bcrypt($data['password']);
        $newUser->save();
        return $newUser;
    }

    public function updateDataUser($data, $idUser)
    {
        // return DB::table('users')->where('id', $idUser)->update($data);

        //cách 2

       return  User::where('id', $idUser)->update($data);
    }

    public function deleteUser($idUser)
    {
        // return DB::table('users')->where('id', $idUser)->delete();

        //cách 2

        return User::where('id', $idUser)->delete();

    }
}
