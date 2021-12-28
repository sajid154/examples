@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
  <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add New Keyword</h4>
    </div>
  </div>
  <div class="row">
          @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                        @endforeach
                  </ul>
            </div>
            @endif
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="white-box">
        <form method="POST" action="{{url('keyword-alert-add')}}">
          @csrf
              <div class="form-group">
                  <input type="hidden" value="{{ $id }}" name="device_id"/>
                  <label for="title">Keyword</label>
                  <input type="text" class="form-control" name="keyword"/>
                 
          </div>
        <button type="submit" class="">Save</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

@endsection