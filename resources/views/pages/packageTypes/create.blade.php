@extends('app', ['active' => 'packageTypes'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">

            <form action="" method="post">
                <div class="form-row">

                    <div class="col-12"><h3>افزودن بسته جدید</h3></div>

                    <div class="col-12 mb-2"><hr></div>
                    
                    <div class="form-group col-12 col-md-6 mb-3">
                        <label for="">نام بسته <span class="text-danger">*</span></label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group col-12 col-md-6 mb-3">
                        <label for="" class="w-100">وضعیت <span class="text-danger">*</span></label>
                        <div class="btn-group btn-group-toggle ltr" data-toggle="buttons">
                            <label for="" class="btn btn-outline-success active" style="min-width: 75px">
                                <input type="radio" name="packageTypeStatus" id="" value="Active" checked>
                                فعال
                            </label>
                            <label for="" class="btn btn-outline-danger" style="min-width: 75px">
                                <input type="radio" name="packageTypeStatus" id="" value="Deleted">
                                غیرفعال
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <button type="submit" class="btn btn-block btn-success">ثبت</button>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <a href="{{url('packageTypes')}}" class="btn btn-block btn-secondary">لغو</a>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection