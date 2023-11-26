<?php
namespace App\interfaces;
interface UserRepositoryInterface
{
    public function getDataUsers();
    public function insertDataUser($data);
    public function updateDataUser($data, $idUser);
    public function deleteUser($idUser);
}
