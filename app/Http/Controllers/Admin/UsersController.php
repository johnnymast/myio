<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::All();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show the create user form
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Store the user
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        // Show the user
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        // Edit the user
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param User                $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserRequest $request, User $user)
    {
        // Update the user
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        // Destroy the user
    }
}
