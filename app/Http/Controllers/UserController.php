<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = $this->userService->getDataUsers();
        return response()->json(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->userService->insertDataUser($request);
        if($result) {
            return response()->json(['success' => 'Insert success.']);
        }else{
            return response()->json(['errors' => 'Insert errors.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idUser)
    {
        $result = $this->userService->updateDataUser($request, $idUser);
        if ($result == true) {
            return response()->json(['success' => 'Update success.']);
        } else {
            return response()->json(['errors' =>'update errors']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idUser)
    {
        $result = $this->userService->deleteUser($idUser);
        if ($result == true) {
            return response()->json(['success' => 'Delete success.']);
        } else {
            return response()->json(['errors' =>'Delete errors']);
        }
    }
}
