@extends('app',['active'=>'drivers'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">
            <div class="form-row">
                <div class="col-12">
                    <h3 class="text-right">مدیریت رانندگان</h3>
                    <a class="btn btn-primary pull-left" href="{{url('drivers.create')}}">افزودن راننده</a>
                </div>
                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle" scope="col">نام راننده</th>
                                <th class="align-middle" scope="col">نام شرکت</th>
                                <th class="align-middle" scope="col">ایمیل</th>
                                <th class="align-middle" scope="col">تاریخ ثبت نام</th>
                                <th class="align-middle" scope="col">موبایل</th>
                                <th class="align-middle" scope="col">شهر</th>
                                <th class="align-middle" scope="col">وضعیت</th>
                                <th class="align-middle" scope="col">فعالیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drivers as $driver)
                                <tr class="gradeA text-center">
                                    <td class="align-middle">{{$driver['vName'] . ' ' . $driver['vLastName']}}</td>
                                    <td class="align-middle">{{$driver['companyFirstName']}}</td>
                                    <td class="align-middle">{{$driver['vEmail']}}</td>
                                    <td class="align-middle" data-order="{{$driver['iDriverId']}}">{{jdate(strtotime($driver['tRegistrationDate']))->format('Y-m-d')}}</td>
                                    <td class="align-middle">{{$driver['vPhone']}}</td>
                                    <td class="align-middle">{{$driver['vCity']}}</td>
                                    <td class="align-middle">
                                        @if ($driver['eDefault'] != 'Yes')
                                            @if($driver['eStatus'] == 'active')
                                                <i class="fa fa-check text-success"></i>
                                            @elseif($driver['eStatus'] == 'inactive')
                                                <i class="fa fa-ban text-secondary"></i>
                                            @elseif ($driver['eStatus'] == 'Deleted')
                                                <i class="fa fa-trash text-danger"></i>
                                            @else
                                                <i class="fa fa-check text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{url('drivers.edit',['id'=>$driver['iDriverId']])}}"
                                           data-toggle="tooltip" title="ویرایش راننده">
                                            <i class="fa fa-pencil text-primary"></i>
                                        </a>
                                        @if ($driver['eStatus'] != "Deleted")
                                            <a href="{{url('documents',['model'=>'drivers','modelId'=>$driver['iDriverId']])}}"
                                               data-toggle="tooltip" title="مدارک راننده">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            <a href="#" class="delete" data-toggle="tooltip"
                                               title="حذف راننده">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                            <form method="post"
                                                  action="{{url('drivers.delete',['id'=>$driver['iDriverId']])}}"
                                                  onSubmit="return confirm('Are you sure you want to delete {{$driver['vName']}} {{$driver['vLastName']}} record?')"
                                                  class="margin0">
                                                <input type="hidden" name="_method" value="DELETE"/>
                                            </form>
                                            <a href="#" class="reset-driver" data-toggle="tooltip"
                                               title="بازنشانی راننده">
                                                <i class="fa fa-refresh text-warning"></i>
                                            </a>
                                            <form method="post" action="{{url('drivers.reset',['id'=>$driver['iDriverId']])}}"
                                                  onSubmit="return confirm('Are you sure ? You want to reset {{$driver['vName']}} {{$driver['vLastName']}} account?')"
                                                  class="margin0">
                                                <input type="hidden" name="action" id="action" value="reset">
                                                <input type="hidden" name="res_id" id="res_id"
                                                       value="{{$driver['iDriverId']}}">
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
            $(".delete").click(function () {
                let form = $(this).next('form');
                form.submit();
            });
            $(".reset-driver").click(function () {
                let form = $(this).next('form');
                form.submit();
            });
        });
    </script>
@endpush