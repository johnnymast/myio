<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Session\Flash;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::paginate(config('myio.admin.pagination.items_per_page'))]);
    }


    /**
     * Show the form for creating a new resource.
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
        // NOT NEEDED ??
        return view('admin.users.form', compact('user'));
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
        return view('admin.users.form', compact('user'));
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
        $user->fill(['name' => $request->name, 'email' => $request->email])->save();

        if (! empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Flash::success('User updated');

        return redirect()->route('admin.users.edit', $user['id']);
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
