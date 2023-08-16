@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') App @endslot
@slot('title') Dashboard @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">@lang('translation.Greetings') !</h5>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Auth::user()->employee->fullname }}</h5>
                        <p class="mb-0 text-truncate">{{Auth::user()->employee->position}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@lang('translation.Personal_Information')</h4>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive  nowrap w-100"> 
                        <tbody>
                            <tr>
                                <th scope="row">Full Name :</th>
                                <td>{{Auth::user()->employee->fullname}}</td>
                            </tr>
                            <tr>
                                <th scope="row">NPWP :</th>
                                <td>{{Auth::user()->employee->npwp}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail :</th>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Company :</th>
                                <td>{{Auth::user()->employee->company}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">@lang('translation.Tasks')</h4>
                <div class="">
                    <ul class="verti-timeline list-unstyled">
                        <li class="event-list active">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle bx-fade-right"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="bx bx-server h4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">Back end Developer</a></h5>
                                        <span class="text-primary">2016 - 19</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="bx bx-code h4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">Front end Developer</a></h5>
                                        <span class="text-primary">2013 - 16</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="bx bx-edit h4 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">UI /UX Designer</a></h5>
                                        <span class="text-primary">2011 - 13</span>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- end card -->
    </div>

    <div class="col-xl-8">

        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="fw-medium mb-2">@lang('translation.Completed_Task')</p>
                                <h4 class="mb-0">125</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-check-circle font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="fw-medium mb-2">@lang('translation.On_Progress')</p>
                                <h4 class="mb-0">12</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-hourglass font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="fw-medium mb-2">@lang('translation.Pending')</p>
                                <h4 class="mb-0">0</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-package font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@lang('translation.Daily_Report')</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">TASK</th>
                                <th scope="col">DETAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($data->attendance as $atts)
                            <tr>
                                <th scope="row">{{$data->fullname}}</th>
                                <td>LAPORAN PAJAK TAHUNAN</td>
                                <td>SUDAH MELAPORKAN DATA PAJAK KE KEMENKEU</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">@lang('translation.My_Attendance')</h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">POSITION</th>
                                <th scope="col">CHECK IN</th>
                                <th scope="col">CHECK OUT</th>
                                <th scope="col">HOURS</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->



@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('attendance.dashboard') }}",
            columns: [{
                    data: 'employee.fullname',
                    name: 'employee.fullname'
                },
                {
                    data: 'employee.position',
                    name: 'employee.position'
                },
                {
                    data: 'in',
                    name: 'in'
                },
                {
                    data: 'out',
                    name: 'out'
                },
                {
                    data: 'hours',
                    name: 'hours'
                },

            ]
        });
    });
</script>
<!-- Required datatable js -->
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>



@endsection