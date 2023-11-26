<?php
namespace App\services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\repositories\UserRepository;

Class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getDataUsers()
    {
        return $this->userRepository->getDataUsers();
    }

    public function insertDataUser($request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];
            $result =  $this->userRepository->insertDataUser($data);
            if ($result) {
                DB::commit();
                return true;
            } else {
                DB::rollBack();
                return false;
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }

    public function updateDataUser($request, $idUser)
    {
        DB::beginTransaction();
        try {
            $dataUser = User::where('id',$idUser)->first();
            $data['name'] = $request->name ? $request->name : $dataUser->name;
            $data['email'] = $request->email ? $request->email : $dataUser->email;
            $data['password'] = $request->password ? $request->password : bcrypt($dataUser->password);
            $result = $this->userRepository->updateDataUser($data, $idUser);
            if ($result) {
                DB::commit();
                return true;
            }else {
                DB::rollBack();
                return false;
            }
        } catch (\throwable $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }

    public function deleteUser($idUser)
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->deleteUser($idUser);
            if($result) {
                DB::commit();
                return true;
            }else {
                DB::rollBack();
                return false;
            }
        }catch(\Throwable $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
}
