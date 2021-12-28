@extends('layouts.superadmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="panel panel-default">
                <div class="panel-heading">Commission Edit</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('update-commission', $commission->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $commission->title }}" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label>Percentage</label>
                            <input class="form-control" type="number" name="ratio" value="{{ $commission->ratio }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-primary text-light" type="submit" value="Update">
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection