@extends('app',['active'=>'vehicles'])

@section('content')

    <div class="card p-4">
        <div class="card-body rtl">
            <div class="form-row">

                <div class="col-12">
                    <h3>مدیریت وسایل نقلیه</h3>
                    <a class="btn btn-primary pull-left" href="{{url('vehicles.create')}}">افزودن سیله نقلیه</a>
                </div>

                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th scope="col" class="d-none"></th>
                                <th scope="col">وسیله نقلیه</th>
                                <th scope="col">شرکت</th>
                                <th scope="col">راننده</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr class="text-center">
                                    <td class="align-middle">{{$vehicle->make->vMake . ' ' . $vehicle->model->vTitle}}</td>
                                    <td class="align-middle">{{$vehicle->company->vCompany}}</td>
                                    <td class="align-middle">{{$vehicle->driver->vName . ' ' . $vehicle->driver->vLastName}}</td>
                                    <td class="align-middle">
                                        @if ($vehicle->eStatus == 'Active')
                                            <i class="fa fa-check text-success"></i>
                                        @elseif ($vehicle->eStatus == 'Inactive')
                                            <i class="fa fa-ban text-secondary"></i>
                                        @elseif ($vehicle->eStatus == 'Deleted')
                                            <i class="fa fa-trash text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                    
                                        <a class="text-primary" href="{{url('vehicles.edit',['id'=>$vehicle->iDriverVehicleId])}}"
                                           data-toggle="tooltip" title="ویرایش وسیله نقلیه">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @if($vehicle->eStatus!='Deleted')
                                            <a class="text-info" href="{{url('documents',['model'=>'vehicles','modelId'=>$vehicle->iDriverVehicleId])}}"
                                               data-toggle="tooltip" title="ویرایش اسناد">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            <a class="text-danger delete" href="#"
                                               data-vehicle-company-name="{{$vehicle->company->vCompany}}"
                                               data-vehicle-driver-name="{{$vehicle->driver->vName . ' ' . $vehicle->driver->vLastName}}"
                                               data-toggle="tooltip"
                                               title="حذف وسیله نقلیه">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form method="post"
                                                  action="{{url('vehicles.delete',['id'=>$vehicle->iDriverVehicleId])}}"
                                                  class="margin0">
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        @endif
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

@push('js')
    <script>
        $(document).ready(function () {
            $(".delete").click(function (e) {
                e.preventDefault();
                let form = $(this).next('form');
                let company = $(this).attr('data-vehicle-company-name');
                let driver = $(this).attr('data-vehicle-driver-name');
                if (confirm('آیا از حذف وسیله نقلیه شرکت ' + company + ' مطمئن هستید؟ به رانندگی ' + driver + '')) {
                    form.submit();
                } else {
                    return false;
                }
            });
        });
    </script>
@endpush