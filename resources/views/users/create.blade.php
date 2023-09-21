@extends('layouts.master')

@section('title') @lang('translation.Tasks') @endsection

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Apps @endslot
@slot('title') @lang('translation.User_Management') @endslot
@slot('title_2') @lang('translation.Create') @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">{!! $error !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">{!! \Session::get('success') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card">

            <div class="card-body">
                <form class="outer-repeater" method="post" action="{{ route('user-management.store')}} ">
                    @csrf
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer">
                            <div class="form-group row mb-4">
                                <label for="taskname" class="col-form-label col-lg-2">EMAIL</label>
                                <div class="col-lg-10">
                                    <input id="email" name="email" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="ENTER EMAIL ADDRESS" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskname" class="col-form-label col-lg-2">PASSWORD</label>
                                <div class="col-lg-10">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="ENTER PASSWORD" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskbudget" class="col-form-label col-lg-2">EMPLOYEE</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" name="employee" data-placeholder="SELECT EMPLOYEE">
                                        <option value="">SELECT EMPLOYEE</option>
                                        @foreach($emp as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskbudget" class="col-form-label col-lg-2">ROLES</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" name="roles" data-placeholder="SELECT ROLES">
                                        <option value="">----SELECT ROLES----</option>
                                        <option value="1">SUPERADMIN</option>
                                        <option value="2">MEMBER</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">SUMBIT FORM</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<!-- end row -->



@endsection
@section('script')
<!-- Required datepicker js -->
<script src=" {{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('#start').datepicker({
        format: 'dd/mm/yyyy'
    });
    $('#end').datepicker({
        format: 'dd/mm/yyyy'
    });

    $('.select2').select2();
</script>


@endsection