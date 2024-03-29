@extends('layouts.master')
@section('css')
    @livewireStyles
    
    @section('title')
        {{trans('Students_trans.Taking_Exam')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('Students_trans.Taking_Exam')}} 
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@livewireScripts
@section('js')
