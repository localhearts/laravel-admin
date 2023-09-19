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
@slot('title') @lang('translation.Daily_Report') @endslot
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

                <form class="outer-repeater" method="post" action="{{ route('daily.store')}} " enctype="multipart/form-data">
                    @csrf
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer">
                            <div class="form-group row mb-4">
                                <label for="taskname" class="col-form-label col-lg-2">Task Name</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" name="task_id" data-placeholder="Choose ..." disabled>                                        
                                        <option value="{{$task->id}}" selected>{{$task->task}}</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-lg-2">Report Description</label>
                                <div class="col-lg-10">
                                    <textarea name="description" class="form-control" rows="3" disabled>{{$daily->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="taskbudget" class="col-form-label col-lg-2">Screenshot</label>
                                <div class="col-lg-10">
                                    <img src="{{ URL::asset('images/'.$daily->capture)}}" width="600px" height="400px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <a href="{{ route('daily.index') }}" class="btn btn-primary">Back</a>
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
<!--tinymce js-->
<script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/task-create.init.js') }}"></script>
<script>
    $('.select2').select2();
</script>


@endsection