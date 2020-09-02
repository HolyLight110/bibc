@extends('app',['active'=>'vehicleTypes'])

@section('content')
    <div class="card p-4">
        <div class="card-body">
            <div class="form-row">

            <div class="col-12">
                <h3>انواع خودرو</h3>
                <a class="btn btn-primary pull-left" href="{{url('vehicleTypes.create')}}">افزودن خودرو</a>
            </div>

            <div class="col-12 mb-2"><hr></div>

            <div class="col-12 mb-2">

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th class="align-middle" scope="col">نوع</th>
                            <th class="align-middle" scope="col">محدوده</th>
                            <th class="align-middle" scope="col">هزینه هر کیلومتر</th>
                            <th class="align-middle" scope="col">هزینه هر دقیقه</th>
                            <th class="align-middle" scope="col">کرایه پایه</th>
                            <th class="align-middle" scope="col">کمیسیون (%)</th>
                            <th class="align-middle" scope="col">ظرفیت</th>
                            <th class="align-middle" scope="col">نوع خودرو</th>
                            <th class="align-middle" scope="col">فعالیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vehicleTypes as $vehicleType)
                            <tr class="gradeA text-center">
                                <td class="align-middle">{{$vehicleType->vVehicleType}}</td>
                                <td class="align-middle">{{$vehicleType->area->sAreaName}}</td>
                                <td class="align-middle">{{$vehicleType->fPricePerKM}}</td>
                                <td class="align-middle">{{$vehicleType->fPricePerMin}}</td>
                                <td class="align-middle">{{$vehicleType->iBaseFare}}</td>
                                <td class="align-middle">{{$vehicleType->fCommision}}</td>
                                <td class="align-middle">{{$vehicleType->iPersonSize}}</td>
                                <td class="align-middle">{{$vehicleType->eType}}</td>
                                <td class="align-middle">
                                    <a class="text-info"
                                       href="{{url('vehicleTypes.edit',['id'=>$vehicleType->iVehicleTypeId])}}"
                                       data-toggle="tooltip" title="ویرایش نوع خودرو">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="text-danger delete-vehicle-type" title="حذف نوع خودرو"
                                       data-vehicle-type-id="{{$vehicleType['iVehicleTypeId']}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="post"
                                          action="{{url('vehicleTypes.delete',['id'=>$vehicleType->iVehicleTypeId])}}"
                                          class="margin0">
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            </div>

        </div>
    </div>


@endsection