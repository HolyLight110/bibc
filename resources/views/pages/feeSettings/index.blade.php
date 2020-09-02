@extends('app',['active'=>'feeSettings'])

@section('content')
    <div class="card p-4">
        <div class="card-body rtl">

            <form action="{{url('feeSettings.update')}}" method="post">
                <div class="form-row">
                    <div class="col-12"><h3>تنظیمات نرخ</h3></div>
                    <div class="col-12 mb-2"><hr></div>
                    @foreach($items as $item)
                        <div class="col-12 col-md-6 col-xl-4 form-group">
                            <label for="setting_{{$item->id}}">{{$item->setting_name}}</label>
                            <input class="form-control" type="text" name="settings[{{$item->id}}]" value="{{$item->setting_value}}"
                                    id="setting_{{$item->id}}">
                        </div>
                    @endforeach

                    <div class="col-12 w-100 mb-3"></div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <button type="submit" class="btn btn-block btn-primary">ذخیره اطلاعات</button>
                    </div>
                </div>
                
            </form>


        </div>
    </div>

@endsection