@extends('layouts.superadmin')

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
      <th scope="col">Payment History</th>
      <th scope="col">Action</th>
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
      <td>{{ $agent->name }}</td>
      <td>{{ $agent->email }}</td>
      <td>{{ date('d M - Y', strtotime($agent->created_at)) }}</td>
      <td>{{ $agent->agent_details->status? 'Approved':'Pending' }}</td>
      <td>{{ $agent->status? 'Active':'Disabled' }}</td>
      <td>
          <!-- Approval Pending   -->

          @if($agent->agent_details->status)

               <form method="POST" action="{{ url('/agent-un-approve/'. $agent->agent_details->id) }}">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="un-approve" value="{{ $agent->agent_details->id }}">
              <input type="submit" value="Un-Approve" class="btn">
          </form>


          @else

          <form method="POST" action="{{ url('/agent-approve/'. $agent->agent_details->id) }}">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="approve" value="{{ $agent->agent_details->id }}">
              <input type="submit" value="Approve" class="btn">
          </form>        
          @endif
      </td>
      <td>
        <a href="{{ route('commissions-history', $agent->id) }}" class="btn">View Payment</a>
      </td>
      <td>
        
        @if($agent->status)
        <form method="POST" action="{{ url('/agent-un-active/'. $agent->id) }}">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="un-active" value="{{ $agent->id }}">
              <input type="submit" value="Disable" class="btn">
          </form>

          @else

        <form method="POST" action="{{ url('/agent-active/'. $agent->id) }}">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="active" value="{{ $agent->id }}">
              <input type="submit" value="Active" class="btn">
          </form>

          @endif
      </td>

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