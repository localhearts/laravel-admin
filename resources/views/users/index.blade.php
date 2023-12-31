@extends('layouts.master')

@section('title') @lang('translation.User_Management') @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Apps @endslot
        @slot('title') @lang('translation.User_Management') @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">{!! \Session::get('success') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
            <div class="card">
            <div class="card-header bg-transparent border-bottom text-uppercase">
                <div class="text-end">

                @if(Auth::user()->roles == '1')
                    <a class="btn btn-success waves-effect waves-light" href="{{route('user-management.create')}}">
                        <i class="bx bx-plus font-size-20 align-middle me-2"></i> ADD USER
                    </a>
                </div>
                @endif
            </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                            <th>EMPLOYEE ID</th>
                            <th>FULL NAME</th>
                            <th>POSITION</th>
                            <th>EMAIL</th>
                            <th>ROLES</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    

@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user-management.index') }}",
            columns: [{
                    data: 'employee_id',
                    name: 'employee_id'
                },
                {
                    data: 'employee.fullname',
                    name: 'employee.fullname'
                },
                {
                    data: 'employee.position',
                    name: 'employee.position'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'roles',
                    name: 'roles'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });
</script>
@endsection
