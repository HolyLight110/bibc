@extends('app',['active'=>'bookings'])

@section('content')

    <div class="card p-4">
        <div class="card-body">

            <div class="form-row">

                <div class="col-12">
                    <h3>رزروها</h3>
                    <a class="btn btn-primary pull-left" href="{{url('bookings.new')}}">رزرو سفر جدید</a>
                </div>
                <div class="col-12 mb-2"><hr></div>

                <div class="col-12 mb-2">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="align-middle" scope="col">مسافر</th>
                                <th class="align-middle" scope="col">تاریخ</th>
                                <th class="align-middle" scope="col">مبدا</th>
                                <th class="align-middle" scope="col">مقصد</th>
                                <th class="align-middle" scope="col">راننده</th>
                                <th class="align-middle" scope="col">اطلاعات سفر</th>
                                <th class="align-middle" scope="col">وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr class="text-center">
                                    <td class="align-middle">{{$booking->passenger->fullName}}</td>
                                    <td class="align-middle">{{jdate($booking->dBooking_date)->format('Y/m/d H:i:s')}}</td>
                                    <td class="align-middle">{{$booking->vSourceAddresss}}</td>
                                    <td class="align-middle">{{$booking->tDestAddress}}</td>
                                    <td class="align-middle">
                                        @if ($booking->eAutoAssign == "Yes")
                                            راننده خودکار اختصاص داشته شده است<a
                                                    class="btn btn-info"
                                                    href="add_booking.php?booking_id={{$booking->iCabBookingId}}"
                                                    data-tooltip="tooltip" title="Edit"><i
                                                        class="icon-edit icon-flip-horizontal icon-white"></i></a>
                                            <br>
                                            (نوع ماشین: {{!is_null($booking->VehicleType) ? $booking->VehicleType->vVehicleType : ''}})
                                        @elseif ($booking->eStatus == "Pending")
                                            <a class="btn btn-info"
                                               href="add_booking.php?booking_id={{$booking->iCabBookingId}}"><i
                                                        class="icon-shield icon-flip-horizontal icon-white"></i>
                                                راننده اختصاص داده شده</a>
                                            <br>
                                            (نوع ماشین: {{!is_null($booking->VehicleType) ? $booking->VehicleType->vVehicleType : ''}})
                                        @elseif ($booking->eCancelBy == "Driver" && $booking->eStatus == "Cancel")
                                            <a class="btn btn-info"
                                               href="add_booking.php?booking_id={{$booking->iCabBookingId}}"><i
                                                        class="icon-shield icon-flip-horizontal icon-white"></i>
                                                راننده اختصاص داده شده</a>
                                            <br>
                                            (نوع ماشین: {{!is_null($booking->VehicleType) ? $booking->VehicleType->vVehicleType : ''}})
                                        @elseif (!is_null($booking->driver))
                                            {{$booking->driver->fullName}}
                                            <br>
                                            (نوع ماشین: {{!is_null($booking->VehicleType) ? $booking->VehicleType->vVehicleType : ''}})
                                        @else
                                            ---
                                            <br>
                                            (نوع ماشین: {{!is_null($booking->VehicleType) ? $booking->VehicleType->vVehicleType : ''}})
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if(!is_null($booking->iTripId) && $booking->eStatus=='Completed')
                                            <a href="invoice.php?iTripId={{$booking->iTripId}}" class="btn btn-primary">مشاهده</a>
                                        @else
                                            ----
                                        @endif
                                    </td>
                                    <td class="align-middle"
                                            @if ($booking->eStatus == "Cancel")
                                            data-toggle="tooltip"
                                            data-html="true"
                                            title="<h5>دلیل لغو رزرو</h5>
                                                           <p>کنسل شده توسط: {{$booking->eCancelBy}}</p>
                                                            <p>دلیل لغو: {{$booking->vCancelReason}}</p>"
                                            @endif
                                    >
                                        @if ($booking->eStatus == "Assign")
                                            راننده اختصاص داده شده است
                                        @else
                                            @if(!is_null($booking->trip))
                                                @if($booking->trip->iActive=='Canceled')
                                                    کنسل شده توسط مسافر
                                                @else
                                                    {{$booking->trip->iActive}}
                                                @endif
                                            @else
                                                @if($booking->eStatus=='Cancel')
                                                    کنسل شده توسط راننده
                                                @else
                                                    {{$booking->eStatus}}
                                                @endif
                                            @endif
                                        @endif
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