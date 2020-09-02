@extends('app',['active'=>'dashboard'])

@section('content')

    <div class="form-row">

        <div class="col-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body" style="height: 200px">
                    <h5 class="font-weight-bold">آخرین رزورها</h5>
                    <hr>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body" >
                    <h5 class="font-weight-bold">آخرین سفرها</h5>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body" >
                    <h5 class="font-weight-bold">سایر موارد</h5>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 mb-2">
            <div class="card">
                <div class="card-body" style="height:450px">
                    <h5 class="font-weight-bold">آخرین تراکم درخواست</h5>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="font-weight-bold">سایر موارد</h5>
                    <hr>
                </div>
            </div>
        </div>

    </div>

    {{-- @include('layouts.dashboard.sidebar') --}}
    {{-- <div style="margin-right: 200px;"> --}}
        {{-- @include('layouts.dashboard.header') --}}
        
           {{-- @php --}}
                            {{-- $messages = getMessages(); --}}
                            {{-- if (count($messages) > 0)  --}}
                                {{-- foreach ($messages as $message)  --}}
                                    {{-- ?> --}}
                                    {{-- <div class="alert alert-<?php //echo $message['type']; ?> alert-dismissable text-right"> --}}
                                        {{-- <?php //echo $message['message']; ?> --}}
                                        {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                                    {{-- </div> --}}
                                    <?php ?>
                                {{-- } --}}
                            
            {{-- @endphp --}}

            
                                        
        
   
@endsection
