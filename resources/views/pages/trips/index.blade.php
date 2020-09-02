@extends('app',['active'=>'trips'])

@section('content')
    <div class="card p-4">
        <div class="card-body">

            <div class="col-12"><h3>لیست سفرها</h3></div>
            <div class="col-12 mb-2"><hr></div>

            <div class="col-12 mb-2">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th  class="align-middle" scope="col">نوع خودرو</th>
                            <th  class="align-middle" scope="col">شماره سفر</th>
                            <th  class="align-middle" scope="col">آدرس</th>
                            <th  class="align-middle" scope="col">تاریخ سفر</th>
                            <th  class="align-middle" scope="col">شرکت</th>
                            <th  class="align-middle" scope="col">راننده</th>
                            <th  class="align-middle" scope="col">مسافر</th>
                            <th  class="align-middle" scope="col">کرایه</th>
                            <th  class="align-middle" scope="col">خودرو</th>
                            <th  class="align-middle" scope="col">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trips as $trip)
                            <tr class="text-center">
                                <td class="align-middle">{{$trip->eType}}</td>
                                <td class="align-middle">{{$trip->vRideNo}}</td>
                                <td class="align-middle"><span class="d-block">از: {{$trip->tSaddress}}</span>
                                    <span class="d-block">به: {{$trip->tDaddress}}</span></td>
                                <td class="align-middle">{{jdate($trip->tTripRequestDate)->format('Y/m/d')}}</td>
                                <td class="align-middle">{{$trip->driver->company->vCompany}}</td>
                                <td class="align-middle">{{$trip->driver->fullName}}</td>
                                <td class="align-middle">{{$trip->passenger->fullName}}</td>
                                <td class="align-middle">{{tripCurrency($trip->iFare)}}</td>
                                <td class="align-middle">{{$trip->vehicleType->vVehicleType}}</td>
                                <td class="align-middle"><a href="#" class="btn btn-primary">صورتحساب</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>


@endsection