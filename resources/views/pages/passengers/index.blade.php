@extends('app',['active'=>'passengers'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">
            <div class="form-row">
            <div class="col-12">
                <h3>مسافران</h3>
                <a class="btn btn-primary pull-left" href="{{url('passengers.create')}}">افزودن مسافر</a>
            </div>

            <div class="col-12 mb-2"><hr></div>
            
            <div class="col-12 mb-2">

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th class="align-middle" scope="col">نام مسافر</th>
                            <th class="align-middle" scope="col">آدرس ایمیل</th>
                            <th class="align-middle" scope="col">تاریخ ثبت نام</th>
                            <th class="align-middle" scope="col">وضعیت</th>
                            <th class="align-middle" scope="col">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($passengers as $passenger)
                            <tr class="text-center">
                                <td class="align-middle">{{$passenger->fullName}}</td>
                                <td class="align-middle">{{$passenger->vEmail}}</td>
                                <td class="align-middle">{{jdate($passenger->tRegistrationDate)->format('Y/m/d')}}</td>
                                <td class="align-middle">
                                    @if($passenger->eStatus=='Active')
                                        <i class="fa fa-check text-success" data-toggle="tooltip" title="فعال"></i>
                                    @elseif($passenger->eStatus=='Inactive')
                                        <i class="fa fa-ban text-secondary" data-toggle="tooltip" title="غیرفعال"></i>
                                    @else
                                        <i class="fa fa-trash text-danger" data-toggle="tooltip" title="حذف شده"></i>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($passenger->eStatus!='Deleted')
                                        <a class="text-primary" href="{{url('passengers.edit',['id'=>$passenger->iUserId])}}"
                                           data-toggle="tooltip" title="ویرایش اطلاعات مسافر">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    @endif
                                    <a class="text-danger delete" href="#"
                                       data-toggle="tooltip"
                                       title="حذف مسافر">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="post" id="delete-passenger-{{$passenger->iUserId}}"
                                          action="{{url('passengers.delete',['id'=>$passenger->iUserId])}}">
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