@extends('app',['active'=>'drivers'])

@section('content')

    <div class="card p-4">
        <div class="card-body">

            <form method="post" action="{{url('drivers.update',['id'=>$driver['iDriverId']])}}" enctype="multipart/form-data">
        
                <input type="hidden" id="u_id" name="id" value="{{$driver['iDriverId']}}"/>
                <input type="hidden" id="usertype" name="usertype" value="driver"/>
                
                <div class="form-row">
                    <div class="col-12"><h3>ویرایش مشخصات راننده</h3></div>
                    <div class="col-12"><hr></div>
 
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vName">نام<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[\D]+" title="Only Alpha characters allowed in name."
                                class="form-control" name="vName" id="vName"
                                value="{{$driver['vName']}}"
                                placeholder="First Name" required oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vLastName">نام خانوادگی<span class="text-danger"> *</span></label>
                        <input type="text" pattern="[\D]+" title="Only Alpha characters allowed in name."
                                class="form-control" name="vLastName" id="vLastName"
                                value="{{$driver['vLastName']}}" placeholder="Last Name" required
                                oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vPassword">رمز عبور <span class="text-danger"> *</span></label>
                        <input type="text" pattern=".{6,}" title="Six or more characters" class="form-control"
                                name="vPassword" id="vPassword" value="{{$driver['vPass']}}"
                                placeholder="Password Label" required>
                    </div>

                    <input type="hidden" class="form-select-2" id="code" name="vCode" value="{{$driver['vCode']}}" required readonly/>
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vPhone">شماره موبایل<span class="text-danger"> *</span></label>
                        <div class="input-group ltr">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{$driver['vCode']}}</span>
                            </div>
                            <input type="text" pattern="[0-9]{1,}" title="Please enter proper mobile number."
                                    class="form-control" name="vPhone"
                                    id="vPhone" value="{{$driver['vPhone']}}" placeholder="Phone"
                                    required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vEmail">ایمیل<span class="text-danger"> *</span></label>
                        <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"
                                class="form-control" name="vEmail" onchange="validate_email(this.value)"
                                id="vEmail" value="{{$driver['vEmail']}}" placeholder="Email"
                                required>
                        <div id="emailCheck"></div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="iCompanyId">شرکت<span class="text-danger"> *</span></label>
                        <select class="custom-select" name='iCompanyId' id='iCompanyId' required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($companies as $company) { ?>
                            <option value="{{$company['iCompanyId']}}" {{($company['iCompanyId'] == $driver['iCompanyId']) ? 'selected' : ''}}>
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
                                <option value="{{$country['vCountryCode']}}"
                                        {{($driver['vCountry'] == $country['vCountryCode']) ? 'selected' : ''}}>{{$country['vCountry']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCity">شهر<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="vCity" id="vCity"
                                value="{{$driver['vCity']}}" placeholder="شهر" required
                                oninvalid="window.scrollTo(0,0);">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vLang">زبان<span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vLang' id="vLang" required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($languages as $language)
                                <option value="{{$language['vCode']}}" {{($language['vCode'] == $driver['vLang']) ? 'selected' : ''}}>
                                    {{$language['vTitle']}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vCurrencyDriver">واحد پول <span class="text-danger"> *</span></label>
                        <select class="custom-select" name='vCurrencyDriver' id="vCurrencyDriver" required>
                            <option value="">انتخاب کنید:</option>
                            @foreach ($currencies as $currency)
                                <option value="{{$currency['vName']}}"
                                        @if($driver['vCurrencyDriver'] == $currency['vName'])
                                        selected
                                        @elseif($currency['eDefault'] == "Yes" && $driver['vCurrencyDriver'] == '')
                                        selected
                                        @endif
                                >{{$currency['vName']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vAccountNumber">شماره حساب</label>
                        <input type="text" class="form-control" name="vAccountNumber" id="vAccountNumber"
                                value="{{$driver['vAccountNumber']}}" placeholder="Account Number">
                    </div>

                    
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankAccountHolderName">نام دارنده حساب</label>
                        <input type="text" class="form-control" name="vBankAccountHolderName"
                                id="vBankAccountHolderName"
                                value="{{$driver['vBankAccountHolderName']}}"
                                placeholder="Account Holder Name">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankName">نام بانک</label>
                        <input type="text" class="form-control" name="vBankName" id="vBankName"
                                value="{{$driver['vBankName']}}" placeholder="Name of Bank">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBIC_SWIFT_Code">BIC/SWIFT Code</label>
                        <input type="text" class="form-control" name="vBIC_SWIFT_Code" id="vBIC_SWIFT_Code"
                                value="{{$driver['vBIC_SWIFT_Code']}}" placeholder="BIC/SWIFT Code">
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="vBankLocation">موقعیت بانک</label>
                        <input type="text" class="form-control" name="vBankLocation" id="vBankLocation"
                                value="{{$driver['vBankLocation']}}" placeholder="Bank Location">
                    </div>

                    <div class="col-12 col-md- col-xl-4 mb-3 form-group">
                        <label for="vPaymentEmail">ایمیل پرداخت</label>
                        <input type="email" class="form-control" name="vPaymentEmail" id="vPaymentEmail"
                                value="{{$driver['vPaymentEmail']}}" placeholder="Payment Email">
                    </div>

                    <div class="form-group col-12 col-md-6 col-xl-4 mb-3">
                        <label for="driverState" class="w-100">وضعیت راننده</label>
                        <div id="driverState" class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label class="btn btn-outline-success {{($driver['eStatus']=='active') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                       value="Active" {{($driver['eStatus']=='active') ? 'checked' : ''}}>فعال</label>
                            <label class="btn btn-outline-warning {{($driver['eStatus']=='inactive') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                       value="Inactive" {{($driver['eStatus']=='inactive') ? 'checked' : ''}}>غیرفعال</label>
                            <label class="btn btn-outline-danger {{($driver['eStatus']=='deleted') ? 'active' : ''}}" style="min-width: 75px">
                                <input type="radio" name="eStatus"
                                       value="Deleted" {{($driver['eStatus']=='Deleted') ? 'checked' : ''}}>حذف
                                شده</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3">
                        <div class="form-group">
                            <label for="vImage">تصویر پروفایل</label>
                            <div class="custom-file">
                                <label for="" class="custom-file-label"></label>
                                <input type="file" class="custom-file" name="vImage" id="vImage"
                                    placeholder="Name Label">
                            </div>
                            
                        </div>
                        @if($driver['vImage']=='NONE' || $driver['vImage'])
                            <img class="m-auto" src="../assets/img/profile-user-img.png" alt="">
                        @else
                            <img class="w-100 rounded border border-dark"
                                    src="storage/{{$driver['iDriverId']}}/3_{{$driver['vImage']}}"/>
                        @endif
                    </div>

                    <div class="col-12 w-100 mb-2"></div>

                    <div class="col-12 col-md-6 mb-2">
                        <input type="submit" class="btn btn-primary btn-block" name="submit" id="submit"
                        value="ویرایش اطلاعات">
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('drivers')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                
                        
            </form>

        </div>
    </div>

@endsection