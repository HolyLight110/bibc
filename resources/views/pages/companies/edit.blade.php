@extends('app', ['active' => 'companies'])

@section('content')
    <form method="post" action="{{url('companies.update',['id'=>$company['iCompanyId']])}}">
        
        <input type="hidden" name="id" value="{{$company['iCompanyId']}}"/>

        <div class="card p-4">
            <div class="card-body rtl">
                
                <div class="form-row">

                    <div class="col-12">
                        <h3>ویرایش مشخصات شرکت</h3>
                    </div>
                    <div class="col-12 mb-3"><hr></div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCompany">نام شرکت<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="vCompany" id="vCompany"
                               value="{{ $company['vCompany']}}" placeholder="Company Name"
                               required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iCompanyCode">کد شرکت<span class="red"> *</span></label>
                        <input type="text" class="form-control" name="iCompanyCode" id="iCompanyCode"
                               value="{{$company['iCompanyCode']}}" placeholder="Company Code"
                               required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iParentId">والدین <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="iParentId" id="iParentId" onChange="" required>
                            <option value="0">انتخاب کنید</option>
                            @foreach ($companies as $item)
                                <option value="{{$item->iCompanyId}}" {{ ($company->iParentId==$item->iCompanyId) ? 'selected' : ''}}>
                                    {{$item->vCompany}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iAreaId">محدوده <span class="text-danger"> *</span></label>
                        <select class="custom-select" name="iAreaId" id="iAreaId" onChange="" required>
                            <option value="0">محدوده مورد نظر را انتخاب کنید</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->aId}}"
                                        {{($company->iAreaId == $area->aId) ? 'selected' : '' }}>
                                    {{$area->sAreaName}}
                                    ({{$area->sAreaNamePersian}})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3  form-group">
                        <label for="vPassword">رمز عبور<span class="text-danger"> *</span></label>
                        <input type="password" pattern=".{6,}" title="Six or more characters" class="form-control"
                               name="vPassword" id="vPassword"
                               value="{{decrypt($company->vPassword)}}"
                               placeholder="Password"
                               required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3  form-group">
                        <label for="vManagerPassword">رمز عبور مدیر<span class="text-danger"> *</span></label>
                        <input type="password" pattern=".{6,}" title="Six or more characters" class="form-control"
                               name="vManagerPassword" id="vManagerPassword"
                               value="{{decrypt($company->vManagerPassword)}}"
                               placeholder="Manager Password" required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vEmail">ایمیل<span class="text-danger"> *</span></label>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control"
                               name="vEmail" id="vEmail" value="{{$company->vEmail}}"
                               placeholder="Email" required
                               onChange="validate_email(this.value,{{$company->iCompanyId}}"/>
                        <div id="emailCheck"></div>
                    </div>
    
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vPhone">موبایل<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[0-9]{1,}" class="form-control" name="vPhone" id="vPhone"
                               value="{{$company->vPhone}}" placeholder="Phone"
                               title="Please enter proper mobile number." required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iPercentageShare">سهم درصد<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[0-9]{1,}" class="form-control" name="iPercentageShare"
                               id="iPercentageShare"
                               value="{{$company->iPercentageShare}}"
                               placeholder="Percentage Share"
                               title="Please enter company Percentage Share." required>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vVatNum">شماره وات</label>
                        <input type="text" class="form-control" name="vVatNum" id="vVatNum"
                               value="{{$company->vVatNum}}" placeholder="VAT Number">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCountry">کشور <span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vCountry' id="vCountry"
                                onChange="changeCode(this.value);"
                                required>
                            <option value="">کشور را انتخاب کنید</option>
                            @foreach($countries as $country)
                                <option value="{{$country->vCountryCode}}"
                                        {{$company->vCountry==$country->vCountryCode ? 'selected' : ''}}>
                                    {{$country->vCountry}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCity">شهر<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="vCity" id="vCity"
                               value="{{$company->vCity}}"
                               placeholder="City" required>
                    </div>

                    <div class="col-12 col-xl-6 mb-6 form-group">
                        <label for="vCaddress">آدرس اول<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="vCaddress" id="vCaddress"
                               value="{{$company->vCaddress}}" placeholder="Address Line 1"
                               required>
                    </div>

                    <div class="col-12 col-xl-6 mb-3 form-group">
                        <label for="vCadress2">آدرس دوم</label>
                        <input type="text" class="form-control" name="vCadress2" id="vCadress2"
                               value="{{$company->vCadress2}}" placeholder="Address Line 2">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="companyState" class="w-100">وضعیت شرکت</label>
                        <div id="" class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label class="btn btn-outline-success {{($company['eStatus']=='Active') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                    value="Active" {{($company['eStatus']=='Active') ? 'checked' : ''}}>فعال</label>
                            <label class="btn btn-outline-warning {{($company['eStatus']=='Inactive') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                    value="Inactive" {{($company['eStatus']=='Inactive') ? 'checked' : ''}}>غیرفعال</label>
                            <label class="btn btn-outline-danger {{($company['eStatus']=='Deleted') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                    value="Deleted" {{($company['eStatus']=='Deleted') ? 'checked' : ''}}>حذف
                                شده</label>
                        </div>
                    </div>

                    <div class="col-12 w-100 my-3"></div>

                    <div class="col-12 col-md-6 mb-2">

                        <input type="submit" class="btn btn-primary col-12" name="submit" id="submit"
                        value="ویرایش اطلاعات">
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('companies')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                </div>
    
            </div>
        </div>


    </form>
@endsection