@extends('app',['active'=>'packageTypes'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">
            <div class="form-row">

                <div class="col-12">
                    <h3>مدیریت بسته‌ها</h3>
                    <a class="btn btn-primary pull-left" href="{{url('packageTypes.create')}}">افزودن نوع بسته</a>

                </div>
                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle" scope="col">نام بسته</th>
                                <th class="align-middle" scope="col">وضعیت</th>
                                <th class="align-middle" scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packageTypes as $packageType)
                                <tr class="text-center">
                                    <td class="align-middle">{{$packageType->vName_PS}}</td>
                                    <td class="align-middle">
                                        @if($packageType->eStatus=='Active')
                                            <i class="fa fa-check text-success" data-toggle="tooltip" title="فعال"></i>
                                        @else
                                            <i class="fa fa-ban text-secondary" data-toggle="tooltip" title="غیرفعال"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-primary" href="{{url('packageTypes.edit',['id'=>$packageType->iPackageTypeId])}}"
                                           data-toggle="tooltip" title="ویرایش نوع بسته">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="text-danger delete" href="#"
                                           data-toggle="tooltip"
                                           title="حذف نوع بسته">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form method="post" id="delete-package-type-{{$packageType->iPackageTypeId}}"
                                              action="{{url('packageTypes.delete',['id'=>$packageType->iPackageTypeId])}}">
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