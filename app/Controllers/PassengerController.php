<?php


namespace App\Controllers;


use App\Models\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::orderBy('iUserId', 'DESC')->get();
        return view('pages.passengers.index', compact('passengers'));
    }

    //route to create new passenger
    public function create()
    {
        return view('pages.passengers.create');
    }

    //route to store new passenger
    public function store(/*array $passenger*/) {

        // return Passenger::create($passenger);
        return redirect(url('passengers'));
    }

    //route to editing a passenger
    public function edit(int $id) {

        return view('pages.passengers.edit');
    }

    //route to update a passenger
    public function update(int $id) {

        return redirect(url('passengers'));
    }


    //route to delete passenger
    public function delete(int $id) {

        return redirect(url('passengers'));
    }



    /*--------------------------------------------------------------
    other functionality
    ------------------------------------------------------------*/

    public function getPassengerByPhone(string $phoneNumber)
    {
        $passenger = Passenger::where('vPhone', $phoneNumber)->get()->first();
        if (is_null($passenger)) return response()->httpCode(404)->json([]);
        return response()->json($passenger);
    }

    public function createPassengerByAjax()
    {
        $passenger = input()->all();
        $passenger = $this->create($passenger);
        return response()->json($passenger);
    }

    // public function create(array $passenger)
    // {
    //     return Passenger::create($passenger);
    // }
}