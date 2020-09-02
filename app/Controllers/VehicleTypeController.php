<?php


namespace App\Controllers;

use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::with('area')->orderBy('iVehicleTypeId', 'ASC')->get();
        return view('pages.vehicleTypes.index', compact('vehicleTypes'));
    }


    //route to create new vehicle type
    public function create() {

        return view('pages.vehicleTypes.create');
    }


    //route to store new vehicle type
    public function store() {


        return redirect(url('vehicleTypes'));
    }


    //route to edit vehicle type
    public function edit(int $id) {
        return view('pages.vehicleTypes.edit');
    }

    //route to update a vehicle type
    public function update(int $id) {

        return redirect(url('vehicleTypes'));
    }


    //route to delete 
    public function delete(int $id) {

        return redirect(url('vehicleTypes'));
    }
}