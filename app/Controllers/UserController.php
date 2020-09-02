<?php

namespace App\Controllers;

use App\Controllers\Controller as BaseController;
use App\Models\AdminGroup;
use App\Models\Area;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::with('adminGroups')
            ->orderBy('iAdminId', 'ASC')
            ->get();
        return view('pages.users.index', compact('users'));
    }

    public function create() {
        //get areas
        $areas = Area::where('sActive', 'Yes')->orderBy('sAreaNamePersian', 'ASC')->get();

        //get groups 
        $groups = AdminGroup::orderBy('iGroupId', 'ASC')->get();

        //return view
        return view('pages.users.create', compact('areas', 'groups'));
    }

    public function store() {
        //TODO validation for create user
        User::create(input()->all());
        $_SESSION['success'] = 'SUCCESSFUL CREATED';
        return redirect(url('users'));
    }

    public function edit(int $id = null) {

        $areas = Area::where('sActive', 'Yes')->orderBy('sAreaNamePersian', 'ASC')->get();
        $groups = AdminGroup::orderBy('iGroupId', 'ASC')->get();

        $user = User::where('iAdminId', $id)->get()->first();

        return view('pages.users.edit', compact('areas', 'groups', 'user'));
    }

    public function update(int $id)
    {
        //TODO validation for edit user
        $user = User::find($id);
        $user->fill(input()->all());
        $user->save();
        $_SESSION['success'] = "Successfully UPDATED !!!";
        return redirect(url('users'));
    }

    public function delete(int $id)
    {
        if (!is_null($id)) {
//            User::destroy($id);
            User::find($id)->update(['eStatus' => 'Deleted']);
        }
        $_SESSION['success'] = "Successfully Deleted !!!";
        return redirect(url('users'));
    }
}