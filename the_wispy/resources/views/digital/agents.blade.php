@extends('layouts.digital')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px">
            <div class="panel panel-default">
                <div class="panel-heading">Agents</div>

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
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Affiliation Date</th>     
      <th scope="col">Agent status</th>
      <th scope="col">Account Status</th>     
      <th scope="col">Change Approvel</th>
      <th scope="col">View Customers</th>

    </tr>
  </thead>
  <tbody>
    @php

    $sno = 0;

    @endphp
    @foreach($agents as $agent)
    <tr>@php
        $sno++;
        @endphp
      <th scope="row">{{ $sno }}</th>
      <td>{{ ucwords($agent->name) }}</td>
      <td>{{ $agent->email }}</td>
      <td>{{ date('d M - Y', strtotime($agent->created_at)) }}</td>
      <td>{{ $agent->agent_details->status? 'Approved':'Pending' }}</td>
      <td>{{ $agent->status? 'Active':'Disabled' }}</td>
      <td>
          <!-- Approval Pending   -->

          @if($agent->agent_details->status)

               <form method="POST" action="{{ url('/market/agent-un-approve/'. $agent->agent_details->id) }}">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="un-approve" value="{{ $agent->agent_details->id }}">
              <input type="submit" value="Un-Approve" class="btn">
          </form>


          @else

          <form method="POST" action="{{ url('/market/agent-approve/'. $agent->agent_details->id) }}">
              @csrf
                <input type="hidden" name="_method" value="PATCH">
              
                <input type="hidden" name="approve" value="{{ $agent->agent_details->id }}">
              
                <input type="submit" value="Approve" class="btn">
          </form>        
          @endif
      </td>
      <td><a href="{{ route('market-agent-customers', $agent->agent_details->reference_code) }}" class="btn btn-info">View</a></td>

    </tr>
    @endforeach
  </tbody>
</table>
{{ $agents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection