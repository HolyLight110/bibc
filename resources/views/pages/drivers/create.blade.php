@extends('app',['active'=>'drivers'])

@section('content')

    <div class="card p-4">
        <div class="card-body">
            
            <form method="post" action="{{url('drivers.store')}}" enctype="multipart/form-data">
                <input type="hidden" id="usertype" name="usertype" value="driver"/>
        
                <div class="form-row">
                    <div class="col-12"><h3>افزودن راننده جدید</h3></div>
                    <div class="col-12 mb-2"><hr></div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vName">نام<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[\D]+" title="Only Alpha characters allowed in name."
                                class="form-control" name="vName" id="vName" 
                                placeholder="First Name" required oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vLastName">نام خانوادگی<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[\D]+" title="Only Alpha characters allowed in name."
                                class="form-control" name="vLastName" id="vLastName"
                                placeholder="Last Name" required
                                oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vPassword">رمز عبور <span class="text-danger"> *</span></label>
                        <input type="text" pattern=".{6,}" title="Six or more characters" class="form-control"
                                name="vPassword" id="vPassword"
                                placeholder="Password Label" required>
                    </div>

                                {{-- <input type="hidden" class="form-select-2" id="code" name="vCode"
                    value="{{!is_null($driver) ? $driver['vCode'] : ''}}" required readonly/> --}}
            
                    <div class="col-12 col-md-6 col-xl-4 mb-3">
                        <label for="vPhone">شماره موبایل<span class="text-danger"> *</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+98</span>
                            </div>
                            <input type="text" pattern="[0-9]{1,}" title="Please enter proper mobile number."
                                    class="form-control" name="vPhone"
                                    id="vPhone" placeholder="9XX-XXX-XXXX"
                                    required >
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vEmail">ایمیل<span class="text-danger"> *</span></label>
                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"
                                class="form-control" name="vEmail" onchange="validate_email(this.value)"
                                id="vEmail" placeholder="Email"
                                required>
                        <div id="emailCheck"></div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iCompanyId">شرکت<span class="text-danger"> *</span></label>
                        <select class="custom-select" name='iCompanyId' id='iCompanyId' required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($companies as $company) 
                            <option value="{{$company['iCompanyId']}}">
                                {{$company['vName'] . " " . $company['vLastName'] . " (" . $company['vCompany'] . ")"}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCountry">کشور<span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vCountry' id='vCountry'
                                onChange="changeCode(this.value);"
                                required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($countries as $country)
                                <option value="{{$country['vCountryCode']}}">{{$country['vCountry']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCity">شهر<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="vCity" id="vCity"
                                placeholder="شهر" required
                                oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vLang">زبان<span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vLang' id="vLang" required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($languages as $language)
                                <option value="{{$language['vCode']}}" >{{$language['vTitle']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCurrencyDriver">واحد پول <span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vCurrencyDriver' id="vCurrencyDriver" required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($currencies as $currency)
                                <option value="{{$currency['vName']}}">{{$currency['vName']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vAccountNumber">شماره حساب</label>
                        <input type="text" class="form-control" name="vAccountNumber" id="vAccountNumber"
                                placeholder="Account Number">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankAccountHolderName">نام دارنده حساب</label>
                        <input type="text" class="form-control" name="vBankAccountHolderName"
                                id="vBankAccountHolderName"
                                placeholder="Account Holder Name">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankName">نام بانک</label>
                        <input type="text" class="form-control" name="vBankName" id="vBankName"
                                placeholder="Name of Bank">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBIC_SWIFT_Code">BIC/SWIFT Code</label>
                        <input type="text" class="form-control" name="vBIC_SWIFT_Code" id="vBIC_SWIFT_Code"
                                placeholder="BIC/SWIFT Code">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankLocation">موقعیت بانک</label>
                        <input type="text" class="form-control" name="vBankLocation" id="vBankLocation"
                                placeholder="Bank Location">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vPaymentEmail">ایمیل پرداخت</label>
                        <input type="email" class="form-control" name="vPaymentEmail" id="vPaymentEmail"
                                placeholder="Payment Email">
                    </div>

                    <div class="form-group col-12 col-md- col-xl-4 mb-3">
                        <label for="driverState" class="w-100">وضعیت راننده</label>
                        <div id="driverState" class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label class="btn btn-outline-success" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                       value="Active">فعال</label>
                            <label class="btn btn-outline-warning active" style="min-width: 75px">
                                <input type="radio" name="eStatus" checked
                                       value="Inactive">غیرفعال</label>
                            <label class="btn btn-outline-danger" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                       value="Deleted">حذف
                                شده</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vImage">تصویر پروفایل</label>
                        <div class="custom-file rtl">
                            <label class="custom-file-label" for="customFile"></label>
                            <input type="file" class="custom-file-input" name="vImage" id="vImage"
                            placeholder="Name Label">
                        </div>

                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <input type="submit" class="btn btn-success btn-block" name="submit" id="submit"
                        value="ذخیره اطلاعات">
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('drivers')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection