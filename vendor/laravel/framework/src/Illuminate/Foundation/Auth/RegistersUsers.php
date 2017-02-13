<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Piyes\User\Role;
use App\Models\Piyes\User\Permission;
use App\Models\Piyes\User\Setting;
use App\Models\Piyes\User\PermissionRole;
use App\Models\Piyes\User\RoleUser;
use App\Models\Piyes\Loginlog;
use App\Models\Piyes\User\Invitee;
use App\User;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if(User::all()->count() == 0){
            return view('auth.register');
        }elseif(matchesWithInvitee($request->token)){
            $invitee = Invitee::where('token', $request->token)->first();
            $token = $request->token;
            return view('auth.register', compact('invitee', 'token'));
        }else{
            return redirect($this->redirectPath());
        }

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if(User::all()->count() == 1){
            $role = Role::create(['name' => 'Architect', 'created_by' => $user->id, 'updated_by' => $user->id]);
            $permission = Permission::create(['name' => 'do_all', 'created_by' => $user->id, 'updated_by' => $user->id]);
            PermissionRole::create(['role_id' => $role->id, 'permission_id' => $permission->id]);
            RoleUser::create(['role_id' => $role->id, 'user_id' => $user->id]);
        }else{
            $invitee = Invitee::where('token', $request->token)->first();
            RoleUser::create(['role_id' => $invitee->role_id, 'user_id' => $user->id]);
            $invitee->user_id = $user->id;
            $invitee->save();
        }
        $setting = Setting::create(['user_id' => $user->id, 'created_by' => $user->id, 'updated_by' => $user->id]);
        Loginlog::create(['user_id' => $user->id]);
        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
