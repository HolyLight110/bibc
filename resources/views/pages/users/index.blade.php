@extends('app', ['active' => 'users'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">

            <div class="form-row">

                <div class="col-12">
                    <h3 class="text-right">مدیریت ادمین ها</h3>
                </div>

                <div class="col-sm-12"><hr></div>

                <div class="col-sm-12 col-md-auto mb-2">
                    <a class="btn btn-primary btn-block px-4" href="{{url('users.create')}}">
                        افزودن ادمین
                    </a>
                </div>

                

                <div class="col-sm-12 col-md-auto mb-2">
                    <form action="" method="POST">
                    <button class="btn btn-danger btn-block px-4" href="#!" disabled>
                        حذف گروهی
                    </button>
                    </form>
                </div>
{{-- 
                <div class="col-12">
                    @include('includes.message')
                </div> --}}

                <div class="col-sm-12">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle" scope="col">#</th>
                                <th class="align-middle" scope="col">نام ادمین</th>
                                <th class="align-middle" scope="col">ایمیل</th>
                                <th class="align-middle" scope="col">نوع ادمین</th>
                                <th class="align-middle" scope="col">موبایل</th>
                                <th class="align-middle" scope="col">وضعیت</th>
                                <th class="align-middle" scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="gradeA text-center ">
                                    <td class="align-middle">
                                        <input type="checkbox" class="form-control-sm" value="{{$user['iAdminId']}}">
                                    </td>
                                    <td class="align-middle">{{$user['vFirstName'] . ' ' . $user['vLastName']}}</td>
                                    {{--                <td>{{$generalobjAdmin->clearEmail($user['vEmail'])}}</td>--}}
                                    <td class="align-middle">{{$user['vEmail']}}</td>
                                    <td class="align-middle">{{$user['adminGroups']['vGroup']}}</td>
                                    {{--                <td>{{$generalobjAdmin->clearPhone($user['vContactNo'])}}</td>--}}
                                    <td class="align-middle">{{$user['vContactNo']}}</td>
                                    <td class="align-middle">
                                        @if($user['eDefault'] != 'Yes')
                                            @if($user['eStatus'] == 'Active')
                                                <i class="fa fa-check text-success"></i>
                                            @elseif($user['eStatus'] == 'Inactive')
                                                <i class="fa fa-ban text-secondary"></i>
                                            @elseif($user['eStatus'] == 'Deleted')
                                                <i class="fa fa-trash text-danger"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-check text-success"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-primary"
                                           href="{{url('users.edit',['id'=>$user['iAdminId']])}}"
                                           data-toggle="tooltip" title="ویرایش">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @if ($user['eDefault'] != 'Yes')
                                            <a class="text-danger" href="#"
                                               onclick="$('#delete_form_{{$user['iAdminId']}}').submit()"
                                               data-toggle="tooltip" title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form name="delete_form" id="delete_form_{{$user['iAdminId']}}"
                                                  method="post"
                                                  action="{{url('users.delete',['id'=>$user['iAdminId']])}}"
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
            return confirm("آیا از حذف راننده مطمئن هستید؟");
        }
    </script>
@endpush