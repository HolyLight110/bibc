@extends('app', ['active'=>'vehicleTypes'])

@section('content')

    <div class="card card-p-4">

        <div class="card-body rtl">

            <form action="{{url('vehicleTypes.store')}}" method="post">
            
                <div class="form-row">

                    <div class="col-12"><h3>ویرایش نوع خودرو</h3></div>
                    <div class="col-12 mb-3"><hr></div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item1">نوع خودرو <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="form-item1">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item2">محدوده <span class="text-danger">*</span></label>
                        <select name="form-item2" id="form-item2" class="custom-select">
                            <option value="">انتخاب کنید</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item3">هزینه هر کیلومتر <span class="text-danger">*</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-center d-inline" style="min-width: 45px">ریال</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="form-item3">
                        </div>
                        
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item4">هزینه هر دقیقه <span class="text-danger">*</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-center d-inline" style="min-width: 45px">ریال</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="form-item4">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item5">کرایه پایه <span class="text-danger">*</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-center d-inline" style="min-width: 45px">ریال</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="form-item5">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item1">کمیسیون <span class="text-danger">*</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-center d-inline" style="min-width: 45px">%</span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="form-item4">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item1">ظرفیت <span class="text-danger">*</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-center d-inline" style="min-width: 45px"><i class="fa fa-users"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="form-item4">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="form-item1">نوع خودرو <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="" name="form-item1">
                    </div>

                    <div class="form-group col-12 col-md-6 col-xl-4 mb-3">
                        <label class="w-100">وضعیت</label>
                        <div class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label class="btn btn-outline-primary active" style="min-width: 75px">
                                <input type="radio" name="eStatus" id="option1"
                                    autocomplete="off"
                                    value="Active" checked>
                                فعال
                            </label>
                            <label class="btn btn-outline-danger" style="min-width: 75px">
                                <input type="radio" name="eStatus" id="option2"
                                    autocomplete="off"
                                    value="Inactive">
                                غیرفعال
                            </label>
                        </div>
                    </div>

                    <div class="col-12 w-100 mb-3"></div>

                    <div class="col-12 col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">ویرایش</button>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{url('vehicleTypes')}}" class="btn btn-secondary btn-block">لغو</a>
                    </div>

                </div>
            
            </form>

        </div>

    </div>

@endsection