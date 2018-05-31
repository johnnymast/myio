<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Notifications\EmailVerification;
use App\Role;
use App\Session\Flash;
use App\User;
use Illuminate\Http\Request;
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
        return view('admin.users.create', [
            'roles' => Role::all(),
        ]);
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
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->activated = $request->activated;
        $user->email_token = $user->createEmailToken();
        $user->save();

        $user->assignRole(Role::find($request->role));
        $user->save();

        if ($request->has('act_mail')) {
            $user->notify(new EmailVerification($user));
        }

        if ($user->save()) {
            Flash::success('User created');
        } else {
            Flash::error('Could not create new user.');
        }

        return redirect()->route('admin.users.edit', $user['id']);
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
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill(['name' => $request->name, 'email' => $request->email, 'activated' => $request->activated])->save();

        if (! empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->removeRole($user->roles->first()->id);
        $user->assignRole(Role::find($request->role));

        if ($user->save()) {
            Flash::success('User updated');
        } else {
            Flash::error('Could not update this user.');
        }

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
        if ($user->delete()) {
            Flash::success('User deleted.');
        } else {
            Flash::error('Could not delete this user.');
        }

        return redirect()->route('admin.users.index');
    }
}
