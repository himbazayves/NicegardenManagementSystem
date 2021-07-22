<?php

namespace App\Http\Controllers;

use App\User;
use App\Waiter;
use App\RestoChef;
use App\HouseKeeper;
use App\StockManager;
use App\Accountant;
use App\Chef;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = User::paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(UserRequest $request)
    public function store(Request $request)
    {
        // $request->merge(['password' => Hash::make($request->get('password'))]);

        // User::create($request->all());

        $request->validate([
            'email'=>'required|unique:users',
            'userable_type'=>'required',
            'name'=>'required',
        ]);
        
        $password=123456789;
        $user= new User;

        // echo $request->name;
        // echo $request->email;

        if($request->userable_type=="chef"){
            $chef= new Chef;
            $chef->names=$request->name;
            $chef->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$chef->id;
            $user->userable_type="App\Chef";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="waiter"){
            $waiter= new Waiter;
            $waiter->names=$request->name;
            $waiter->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$waiter->id;
            $user->userable_type="App\Waiter";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="stockChef"){
            $StockChef= new StockChef;
            $StockChef->names=$request->name;
            $StockChef->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$StockChef->id;
            $user->userable_type="App\StockChef";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="restoChef"){
            $restoChef= new RestoChef;
            $restoChef->names=$request->name;
            $restoChef->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$restoChef->id;
            $user->userable_type="App\RestoChef";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="stockManager"){
            $stockManager= new StockManager;
            $stockManager->names=$request->name;
            $stockManager->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$stockManager->id;
            $user->userable_type="App\StockManager";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="accountant"){
            $accountant= new Accountant;
            $accountant->names=$request->name;
            $accountant->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$accountant->id;
            $user->userable_type="App\Accountant";
            $user->password=Hash::make($password);
            $user->save();
        }

        elseif($request->userable_type=="houseKeeper"){
            $houseKeeper= new HouseKeeper;
            $houseKeeper->names=$request->name;
            $houseKeeper->save();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->userable_id=$houseKeeper->id;
            $user->userable_type="App\HouseKeeper";
            $user->password=Hash::make($password);
            $user->save();
        }
        return redirect()->route('users.index')->withStatus('User successfully created.');
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $hasPassword = $request->get('password');

        $request->merge(['password' => Hash::make($request->get('password'))]);

        $request->except([$hasPassword ? '' : 'password']);

        $user->update($request->all());

        return redirect()->route('users.index')->withStatus('User successfully updated.');
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('users.index')->withStatus('User successfully deleted.');
    }
}
