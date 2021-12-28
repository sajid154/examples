@extends('layouts.superadmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="panel panel-default">
                <div class="panel-heading">Commission Setting</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">From</th>
      <th scope="col">Percentage</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php

    $sno = 1;

    @endphp
    @foreach($commissions as $com)
    <tr>
      <th scope="row">{{ $sno++ }}</th>
      <td>{{ $com->title }}</td>
      <td>{{ $com->ratio }}%</td>
      <td><a href="{{ route('edit-commission', $com->id) }}"><i class="fa fa-edit"></i></a></td>
 
    </tr>
    @endforeach
  </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection