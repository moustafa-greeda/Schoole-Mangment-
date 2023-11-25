@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Fee_trans.Edit_Study_Fee')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Fee_trans.Edit_Study_Fee')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('Fees.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Fee_trans.Name_ar')}}</label>
                                <input type="text" value="{{$fees->getTranslation('title','ar')}}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fees->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Fee_trans.Name_en')}}</label>
                                <input type="text" value="{{$fees->getTranslation('title','en')}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('Fee_trans.Amount')}}</label>
                                <input type="number" value="{{$fees->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans('Fee_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fees->Grade_id ? 'selected' : ""}}>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('Fee_trans.Classroom')}}</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$fees->classroom_id}}">{{$fees->classroom->Name_Class}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('Fee_trans.Acadimic_Year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fees->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            
                    </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('Fee_trans.Note')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                rows="4">{{$fees->description}}
                            </textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('Fee_trans.submit')}}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
   
@endsection