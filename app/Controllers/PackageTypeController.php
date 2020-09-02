<?php


namespace App\Controllers;


use App\Models\PackageType;

class PackageTypeController extends Controller
{
    public function index()
    {
        $packageTypes = PackageType::orderBy('iPackageTypeId', 'ASC')->get();
        return view('pages.packageTypes.index', compact('packageTypes'));
    }


    //route to create new package
    public function create() {

        return view('pages.packageTypes.create');
    }


    //route to store new package
    public function store() {


        return redirect(url('packageTypes'));
    }


    //route to edit a package
    public function edit(int $id) {

        return view('pages.packageTypes.edit');
    }

    //route to update a package
    public function update(int $id) {

        return redirect(url('packageTypes'));
    }

    //route to delete a package 
    public function delete(int $id) {

        return redirect(url('packageTypes'));
    }
}