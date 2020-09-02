@extends('app', ['active' => 'companies'])

@section('content')
    <div class="card p-4">
        <div class="card-body">
            <div class="form-row">
                <div class="col-12">
                    <h3 class="text-right">مدیریت شرکت‌ها</h3>
                    <a class="btn btn-primary pull-left" href="{{url('companies.create')}}">افزودن شرکت</a>
                </div>
                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle" scope="col">نام شرکت</th>
                                <th class="align-middle" scope="col">راننده</th>
                                <th class="align-middle" scope="col">محدوده</th>
                                <th class="align-middle" scope="col">موبایل</th>
                                <th class="align-middle" scope="col">تاریخ ثبت نام</th>
                                <th class="align-middle" scope="col">وضعیت</th>
                                <th class="align-middle" scope="col">ویرایش اسناد</th>
                                <th class="align-middle" scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr class="gradeA text-center">
                                    <td class="align-middle">{{$company->vCompany}}</td>
                                    {{--                <td>{{$generalobjAdmin->clearEmail($user['vEmail'])}}</td>--}}
                                    <td class="align-middle">
                                        <a href="{{url('companies.drivers',['id'=>$company['iCompanyId']])}}">{{$company['drivers_count']}}</a>
                                    </td>
                                    <td class="align-middle">{{$company->area['sAreaNamePersian']}}</td>
                                    {{--                <td>{{$generalobjAdmin->clearPhone($user['vContactNo'])}}</td>--}}
                                    <td class="align-middle">{{$company['vPhone']}}</td>
                                    <td class="align-middle">{{$company->date}}</td>
                                    <td class="align-middle">
                                        @if($company['iCompanyId'] == 1)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            @if($company['eStatus'] == 'Active')
                                                <i class="fa fa-check text-success"></i>
                                            @elseif($company['eStatus'] == 'Inactive')
                                                <i class="fa fa-ban text-secondary"></i>
                                            @elseif($company['eStatus'] == 'Deleted')
                                                <i class="fa fa-trash text-danger"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{url('documents',['model'=>'companies','modelId'=>$company['iCompanyId']])}}">
                                            <i class="fa fa-file"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-primary"
                                           href="{{url('companies.edit',['id'=>$company['iCompanyId']])}}"
                                           data-toggle="tooltip" title="ویرایش">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @if ($company['iCompanyId'] != 1)
                                            <a class="text-danger" href="#"
                                               onclick="$('#delete_form_{{$company['iCompanyId']}}').submit()"
                                               data-toggle="tooltip" title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form name="delete_form" id="delete_form_{{$company['iCompanyId']}}"
                                                  method="post"
                                                  action="{{url('companies.delete',['id'=>$company['iCompanyId']])}}"
                                                  onsubmit="return confirm_delete()">
                                                <input type="hidden" name="_method" value="DELETE"/>
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
        function confirm_delete() {
            return confirm("Are You sure You want to Delete Driver?");
        }
    </script>
@endpush