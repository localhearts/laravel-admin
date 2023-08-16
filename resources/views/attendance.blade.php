@extends('layouts.master')

@section('title') @lang('translation.Attendance') @endsection

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Apps @endslot
@slot('title') @lang('translation.Attendance') @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent border-bottom text-uppercase">
                <div class="text-end">
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#importAttendance">
                        <i class="bx bx-archive-out font-size-20 align-middle me-2"></i> IMPORT
                    </button>

                    <button type="button" class="btn btn-success waves-effect waves-light">
                        <i class="bx bx-archive-in font-size-20 align-middle me-2"></i> EXPORT
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>EMPLOYEE ID</th>
                            <th>FULL NAME</th>
                            <th>POSITION</th>
                            <th>DATE</th>
                            <th>CHECK IN</th>
                            <th>CHECK OUT</th>
                            <th>HOURS</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- sample modal content -->
        <div id="importAttendance" class="modal fade" tabindex="-1" aria-labelledby="importAttendanceLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importAttendanceLabel">UPLOAD FILE EMPLOYEE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('import-attendance') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group mb-4">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('attendance.index') }}",
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
                    data: 'date',
                    name: 'date'
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
<script>
    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, 5000); // 5 secs

    });
</script>
<!-- Required datatable js -->
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection