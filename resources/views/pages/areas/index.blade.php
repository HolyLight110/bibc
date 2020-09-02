@extends('app', ['active' => 'areas'])

@section('content')

    <div class="card p-4">
        <div class="card-body rtl">

            <div class="form-row">

                <div class="col-12">
                    <h3 class="text-right">مناطق</h3>
                    <a class="btn btn-primary pull-left" href="{{url('areas.create')}}">افزودن منطقه جدید</a>
                </div>
    
                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle">نام ناحیه</th>
                                <th class="align-middle">وضعیت</th>
                                <th class="align-middle">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($areas as $area)
                                <tr class="gradeA text-center">
                                    <td class="align-middle">{{$area['sAreaName']}} ({{$area['sAreaNamePersian']}})</td>
                                    <td class="align-middle">
                                        @if($area['sActive'] == 'Yes')
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-ban text-secondary"></i>
                                        @endif
                                    <td class="align-middle">
                                        <a class="text-primary"
                                           href="{{url('areas.edit',['id'=>$area['aId']])}}"
                                           data-toggle="tooltip" title="ویرایش">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="text-danger" href="#"
                                           onclick="$('#delete_form_{{$area['aId']}}').submit()"
                                           data-toggle="tooltip" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form name="delete_form" id="delete_form_{{$area['aId']}}"
                                              method="post"
                                              action="{{url('areas.delete',['id'=>$area['aId']])}}"
                                              onsubmit="return confirm_delete()">
                                            <input type="hidden" name="_method" value="DELETE"/>
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
@push('js')
    <script>
        function confirm_delete() {
            return confirm("Are You sure You want to Delete Driver?");
        }
    </script>
@endpush