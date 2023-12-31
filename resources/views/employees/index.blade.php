@extends('layouts.master')

@section('title') @lang('translation.Employee') @endsection

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Apps @endslot
@slot('title') @lang('translation.Employee') @endslot
@endcomponent
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{$message}}
    
</div>
@endif
<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-header bg-transparent border-bottom text-uppercase">
                <div class="text-end">
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#importEmployee">
                        <i class="bx bx-archive-out font-size-20 align-middle me-2"></i> IMPORT
                    </button>

                    <a href="{{ asset('template/karyawan-template.xlsx') }}"  class="btn btn-success waves-effect waves-light" download>
                        <i class="bx bx-archive-in font-size-20 align-middle me-2"></i> DOWNLOAD TEMPLATE
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>EMPLOYEE ID</th>
                            <th>FULL NAME</th>
                            <th>COMPANY</th>
                            <th>POSITION</th>
                            <th>PHONE</th>
                            <th>BANK ACCOUNT</th>
                            <th>NPWP</th>
                            <th>BPJS KESEHATAN</th>
                            <th>BPJS KETENAGAKERJAAN</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
        <!-- sample modal content -->
        <div id="importEmployee" class="modal fade" tabindex="-1" aria-labelledby="importEmployeeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importEmployeeLabel">UPLOAD FILE EMPLOYEE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('import-employee') }}" method="POST" enctype="multipart/form-data">
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
            ajax: "{{ route('employee.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'bankaccount',
                    name: 'bankaccount'
                },
                {
                    data: 'npwp',
                    name: 'npwp'
                },
                {
                    data: 'bpjskesehatan',
                    name: 'bpjskesehatan'
                },
                {
                    data: 'bpjsketenagakerjaan',
                    name: 'bpjsketenagakerjaan'
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
<script>
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 ); // 5 secs

});
</script>

<!-- Required datatable js -->
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/toastr/build/toastr.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection