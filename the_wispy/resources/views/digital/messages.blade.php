@extends('layouts.digital')

@section('content')
<style type="text/css">
    p.mb-0.conright {
    width: 50%;
    float: right;
}
p.mb-0.con {
    width: 50%;
}
small.pull-right.text-muted {
    width: 100%;
     text-align: right;
}

small.pull-left.clockstyyle {
        color: #121212;
}

small.pull-right.clockstyyle {
  text-align: right;
  color: white;
  margin-top: -10px;

}

.chat li{border-bottom: none;}
.chat-body.white.p-3.z-depth-1.customer {
    min-height: 70px;
        margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 50%;
    margin-left: 46%;
    background-color:#05728f;
    border-radius: 0px 40px 0px 40px;
    font-size: 14px;
}

.chat-body.white.p-3.z-depth-1.diffhuman{
  background: #ebebeb none repeat scroll 0 0;
    padding: 5px 10px 5px 12px;
    min-height: 70px;
    height: 30%;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    border-radius: 30px 0px 40px 0px;
    width: 50%;

}


.col-md-3.col-xl-3.px-0 {
    border-right: 1px solid rgba(0,0,0,.125);
}
.form-group.basic-textarea{margin-bottom: 0px;}
button.btn.btn-info.btn-rounded.btn-sm.waves-effect.waves-light {
    text-align: center;
    margin: 0px auto;
    display: block;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12" style="margin-top: 20px">
            <div class="panel panel-default">
                <div class="panel-heading">Agents</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


<div class="full-width">

    
<div class="card grey lighten-3 chat-room">
  <div class="card-body">

    <!-- Grid row -->
    <div class="row px-lg-2 px-2">

      <!-- Grid column -->
      <div class="col-md-3 col-xl-3 px-0">

        <h6 class="font-weight-bold mb-3 text-center text-lg-center">Agents</h6>
        <div class="white z-depth-1 px-3 pt-3 pb-0">
          <ul class="list-unstyled friend-list">
           <!--  <li class="active grey lighten-3 p-2">
              <a href="#" class="d-flex justify-content-between">
                <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                <div class="text-small">
                  <strong>John Doe</strong>
                  <p class="last-message text-muted">Hello, Are you there?</p>
                </div>
                <div class="chat-footer">
                  <p class="text-smaller text-muted mb-0">Just now</p>
                  <span class="badge badge-danger float-right">1</span>
                </div>
              </a>
            </li> -->


            @foreach($agents as $agent)
            <li class="p-2">
              <a href="{{ route('market-agent-messages', $agent->id) }}" class="d-flex justify">
                <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                <div class="text-small">
                  <strong>{{ ucwords($agent->name) }}</strong>
                  <p class="last-message text-muted">{{ $agent->email }}</p>
                </div>
              </a>
            </li>
            @endforeach
           
          </ul>
        </div>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-9 col-xl-9 pl-md-3 px-lg-auto px-0">

        <div class="chat-message">

          <ul class="list-unstyled chat">

            @if($messages != null)


            @foreach($messages as $msg)

            @if($msg->type == 'Sender')
            <li class="">
              <div class="chat-body white p-3 ml-2 z-depth-1 diffhuman">
                <div class="header">
                </div>
                <p class="mb-0 con">
                    {{ $msg->message }}
                </p>
                <small class="pull-left clockstyyle"><i class="far fa-clock clktxt"></i>{{ $msg->created_at->diffForHumans() }}</small>
              </div>
            </li>

            @else


            <li class="">
              <div class="chat-body white p-3 z-depth-1 customer">
                <div class="header">
                </div>
                <p class="">
                {{ $msg->message }}
                </p><br>
                <br>
                 <small class="pull-right clockstyyle"><i class="far fa-clock"></i>{{ $msg->created_at->diffForHumans() }}</small>
              </div>
            </li>
            @endif
            @endforeach


        
            <form method="POST" action="{{ route('market-save-messages', request()->agent_id) }}">
            @csrf
            <li class="white">
              <div class="form-group basic-textarea">
                <textarea class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="Type your message here..." required="required" name="message"></textarea>
              </div>
            </li>

            <button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light">Send</button>
            
            </form>
           
            @else
            <li>Please Select the agent to start messages operations</li>

             @endif
          
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
</div>

</div>








                </div>
            </div>
        </div>
    </div>
</div>
@endsection