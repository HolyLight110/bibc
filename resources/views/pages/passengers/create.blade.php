@extends('app', ['active' => 'passengers'])

@section('content')
    
    <div class="card p-4">
        <div class="card-body rtl">

            <form action="{{url('passengers.store')}}" method="post">
            
                <div class="form-row">

                    <div class="col-12"><h3>افزودن مسافر</h3></div>
                    <div class="col-12 mb-2"><hr></div>

                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="">نام <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="passengerName" class="form-control">
                    </div>
                    
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="">آدرس ایمیل <span class="text-danger">*</span></label>
                        <input type="text" name="email" id="" class="form-control">
                    </div>
                    
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label for="">تاریخ ثبت نام <span class="text-danger">*</span></label>
                        <input type="date" name="resgisterDate" id="" class="form-control">
                    </div>
                    
                    <div class="col-12 col-md-6 col-xl-4 mb-3 form-group">
                        <label class="w-100" for="">وضعیت <span class="text-danger">*</span></label>
                        <div class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label for="" class="btn btn-outline-success active">
                                <input type="radio" name="status" id="" value="Active" checked>
                                فعال
                            </label>
                            <label for="" class="btn btn-outline-danger">
                                <input type="radio" name="status" id="" value="Inactive">
                                غیرفعال
                            </label>
                        </div>
                    </div>  

                    <div class="col-12 w-100 mb-3"></div>

                    <div class="col-12 col-md-6 mb-2">
                        <button type="submit" class="btn btn-block btn-success">ثبت</button>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('passengers')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

@endsection