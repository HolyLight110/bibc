@extends('app',['active'=>'vehicles'])

@section('content')

    <div class="card p-4">
        <div class="card-body">
            <form id="vehicle-form" method="post" action="{{url('vehicles.update',['id'=>$vehicle->iDriverVehicleId])}}">

                <input type="hidden" id="u_id" name="id" value="{{$vehicle->iDriverVehicleId}}"/>
                <input type="hidden" id="usertype" name="usertype" value="driver"/>

                <div class="form-row">

                    <div class="col-12">ویرایش وسیله نقلیه</div>
                    <div class="col-12 mb-2"><hr></div>

                    <div class="form-group col-12 col-md-2 mb-3">
                        <label for="iMakeId">خودرو<span class="text-danger"> *</span></label>
                        <select name="iMakeId" id="iMakeId" class="custom-select" required>
                            <option value="">انتخاب خودرو</option>
                            @foreach($makes as $make)
                                <option value="{{$make->iMakeId}}"
                                        {{($vehicle->iMakeId== $make->iMakeId) ? 'selected' : ''}}>{{$make->vMake}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-2 mb-3">
                        <label for="iModelId">مدل<span class="text-danger"> *</span></label>
                        <div>
                            <select name="iModelId" id="iModelId" class="custom-select" required>
                                <option value="">انتخاب مدل خودرو</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-2 mb-3">
                        <label for="iColor">رنگ<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="iColor" id="iColor"
                            value="{{$vehicle->iColor}}"/>
                    </div>

                    <div class="form-group col-12 col-md-2 mb-3">
                        <label for="iYear">سال<span class="text-danger"> *</span></label>
                        <select name="iYear" id="iYear" class="custom-select" required>
                            <option value="">انتخاب سال</option>
                            @for($j = jdate('Y')->format('Y'); $j >= 1370; $j--)
                                <option value="{{$j}}"
                                        {{($vehicle->iYear == $j) ? 'selected' : ''}}>{{$j}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-12 col-md-4 form-group">
                        <label class="w-100" for="">پلاک خودرو <span class="text-danger"></span>*</label>
                        <div class="input-group ltr">
                            <input type="text" class="form-control text-center" name="vLicencePlate_place1"
                                id="vLicencePlate_place1"
                                value="{{$vehicle->vLicencePlateDetail['vLicencePlate_place1']}}"
                                placeholder="00" required maxlength="2">
                            <input type="text" class="form-control text-center" name="vLicencePlate_alphabet"
                                id="vLicencePlate_alphabet"
                                value="{{$vehicle->vLicencePlateDetail['vLicencePlate_alphabet']}}"
                                placeholder="الف"
                                required>
                            <input type="text" class="form-control text-center" name="vLicencePlate_place2"
                                id="vLicencePlate_place2"
                                value="{{$vehicle->vLicencePlateDetail['vLicencePlate_place2']}}"
                                placeholder="000" required maxlength="3outline-">

                            <input type="text" class="form-control text-center" name="vLicencePlate_city"
                                id="vLicencePlate_city"
                                value="{{$vehicle->vLicencePlateDetail['vLicencePlate_city']}}"
                                placeholder="کد شهر" required>
                            <span class="text-danger" id="plate_warning"></span>
                            <input type="hidden" name="vLicencePlate" id="vLicencePlate" value="">
                            <input type="hidden" name="vLicencePlate_local" id="vLicencePlate_local" value="">
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-6 mb-3">
                        <label for="iCompanyId">شرکت<span class="text-danger"> *</span></label>
                        <select name="iCompanyId" id="iCompanyId"
                                class="custom-select" required>
                            <option value="">انتخاب شرکت</option>
                            @foreach($companies as $company)
                                <option value="{{$company->iCompanyId}}"
                                        {{($vehicle->iCompanyId== $company->iCompanyId) ? 'selected' : ''}}>{{$company->vCompany}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12 col-md-6 mb-3">
                        <label for="iDriverId">راننده<span
                                    class="text-danger"> *</span></label>
                        <select name="iDriverId" id="iDriverId" class="custom-select" required>
                            <option value="">راننده را انتخاب کنید</option>
                        </select>
                    </div>
                
                    <div class="col-12 mb-3 form-group">
                        <label class="w-100">نوع خودرو <span class="text-danger"> *</span></label>
                        <div class="alert alert-danger alert-dismissable" style="display:none;" id="car_error">
                            <button class="close" type="button" id="cartypeClosed">×</button>
                            شما باید حداقل یک نوع ماشین را انتخاب کنید
                        </div>
                        <div class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            @foreach ($vehicleTypes as $vehicleType)
                                <label class="btn btn-outline-primary">
                                    <input type="checkbox" name="vCarType[]"
                                        class="vehicle-type"
                                        {{(in_array($vehicleType->iVehicleTypeId, $vehicle->vCarTypeArray)) ? 'checked' : ''}}
                                        autocomplete="off"
                                        value="{{$vehicleType->iVehicleTypeId}}">{{$vehicleType->vVehicleType}}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-6 mb-3">
                        <label class="w-100">وضعیت</label>
                        <div class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label class="btn btn-outline-success {{($vehicle->eStatus=='Inactive') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus" id="option1"
                                    autocomplete="off"
                                    value="Active" {{($vehicle->eStatus=='Active') ? 'checked' : ''}}>
                                فعال
                            </label>
                            <label class="btn btn-outline-danger {{($vehicle->eStatus=='Inactive') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus" id="option2"
                                    autocomplete="off"
                                    value="Inactive" {{($vehicle->eStatus=='Inactive') ? 'checked' : ''}}>
                                غیرفعال
                            </label>
                        </div>
                    </div>

                    <div class="col-12 w-100"></div>

                    <div class="col-12 col-md-6 mb-2">
                        <a href="#!" class="btn btn-primary btn-block" id="submit-form">ثبت اطلاعات</a>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('vehicles')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#iMakeId").change(function () {
                let makeId = $(this).val();
                let request = $.ajax({
                    type: "GET",
                    url: '/bibc/api/makes/' + makeId + '/models',
                    success: function (data) {
                        console.log(data);
                        $("#iModelId").children().remove();
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $("#iModelId").append($('<option>', {value: value.iModelId})
                                    .text(value.vTitle));
                            });
                        }
                    }
                });
                request.fail(function (jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);
                });
            });
            $("#iCompanyId").change(function () {
                let companyId = $(this).val();
                console.log(companyId);
                let request = $.ajax({
                    type: "GET",
                    url: '/bibc/api/companies/' + companyId + '/drivers',
                    success: function (data) {
                        console.log(data);
                        $("#iDriverId").children().remove();
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $("#iDriverId").append($('<option>', {value: value.iDriverId})
                                    .text(value.vName + ' ' + value.vLastName));
                            });
                        }
                    }
                });
                request.fail(function (jqXHR, textStatus) {
                    console.log("Request failed: " + textStatus);
                });
            });

            $("#submit-form").click(function (e) {
                e.preventDefault();
                let number = 'IRAN'
                    + '|' + $("#vLicencePlate_place1").val()
                    + '|' + $("#vLicencePlate_alphabet").val()
                    + '|' + $("#vLicencePlate_place2").val()
                    + '|' + $("#vLicencePlate_city").val() + '';
                let request = $.ajax({
                    type: "POST",
                    data: {number},
                    url: '/bibc/api/vehicles/checkLicense',
                    success: function (data) {
                        $("#vLicencePlate").val(number);
                        $("#vLicencePlate_local").val(number);
                        $("#vehicle-form").submit();
                    }
                });
                request.fail(function (jqXHR, textStatus) {
                    console.log(jqXHR.responseJSON.message);
                    if (jqXHR.status === 422) {
                        $("#plate_warning").text(jqXHR.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush