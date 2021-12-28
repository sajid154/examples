

                                    <div class="account-down">
<div class="dropdown">
  <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ ucfirst(Auth::user()->email) }}<i class="fa fa-chevron-down" aria-hidden="true"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{url('/account/'.Auth::user()->id.'/edit')}}">Change Password</a>
    <a class="dropdown-item" href="#">Contact Us</a>


                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                            {{ __('Sign Out') }}
                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    
  </div>
</div>
</div>
