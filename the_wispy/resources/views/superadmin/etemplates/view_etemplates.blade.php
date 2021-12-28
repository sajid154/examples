@extends('layouts.superadmin')
@section('content')

<div id="content">
  <div id="content-header">

      <a href="{{url('superadmin/add-email-template')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Add Email Template</a>
    <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">etemplatess</a> <a href="#" class="current">View etemplatess</a> </div> -->
    <h1>Email Templates</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Email Templates</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($etemplates as $etemplate)
                <tr class="gradeX">
                  <td class="center">{{ $etemplate->id }}</td>
                  <td class="center">{{ $etemplate->title }}</td>
                  <td class="center">{!! $etemplate->content !!}</td>
                  <td class="center"> 
                    <a href="{{ url('/superadmin/edit-email-template/'.$etemplate->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a id="deletemplate" rel="{{ $etemplate->id }}" rel1="delete-etemplates" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection