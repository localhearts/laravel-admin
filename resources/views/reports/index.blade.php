@extends('layouts.master')

@section('title') @lang('translation.Daily_Report') @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Apps @endslot
        @slot('title') @lang('translation.Daily_Report') @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">{!! \Session::get('success') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
            <div class="card">
            <div class="card-header bg-transparent border-bottom text-uppercase">
                <div class="text-end">


                    <a class="btn btn-success waves-effect waves-light" href="{{route('daily.create')}}">
                        <i class="bx bx-plus font-size-20 align-middle me-2"></i> ADD REPORT
                    </a>
                </div>
            </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                            <th>EMPLOYEE ID</th>
                            <th>FULL NAME</th>
                            <th>TASK</th>
                            <th>DESCRIPTION</th>
                            <th>CREATED DATE</th>
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
<script type="text/javascript">
    $(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('daily.index') }}",
            columns: [{
                    data: 'employee_id',
                    name: 'employee_id'
                },
                {
                    data: 'employee.fullname',
                    name: 'employee.fullname'
                },
                {
                    data: 'task.task',
                    name: 'task.task'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
