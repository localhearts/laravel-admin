@extends('layouts.master')

@section('title') @lang('translation.Tasks') @endsection

@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@php
$status = ['Start', 'Pending', 'Finish'];
@endphp

@component('components.breadcrumb')
@slot('li_1') Apps @endslot
@slot('title') @lang('translation.Tasks') @endslot
@slot('title_2') @lang('translation.Create') @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">{!! \Session::get('success') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create New Task</h4>
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer">
                            <div class="form-group row mb-4">
                                <label for="taskname" class="col-form-label col-lg-2">Task Name</label>
                                <div class="col-lg-10">
                                    <input id="taskname" name="taskname" type="text" class="form-control" placeholder="Enter Task Name..." value="{{$task->task}}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-lg-2">Task Date</label>
                                <div class="col-lg-10">
                                    <div class="input-daterange input-group" data-provide="datepicker">
                                        <input type="text" class="form-control" placeholder="Start Date" name="start" id="start" value="{{ date('d/m/Y', strtotime($task->start_date)) }}" required />
                                        <input type="text" class="form-control" placeholder="End Date" name="end" id="end" value="{{ date('d/m/Y', strtotime($task->end_date)) }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskbudget" class="col-form-label col-lg-2">Employee</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" name="employee" data-placeholder="Choose ...">
                                        <option value="">Select Employee</option>

                                        @foreach($emp as $employee)
                                        <option value="{{$employee->id}}" {{ ($employee->id === $task->employee_id) ? 'selected' : '' }}>{{$employee->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskbudget" class="col-form-label col-lg-2">Status</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" name="status" data-placeholder="Choose ...">
                                        <option value="">Select Status</option>
                                        @foreach($status as $key => $value)
                                        <option value="{{$key}}" {{ ($key === $task->status) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Create Task</button>
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