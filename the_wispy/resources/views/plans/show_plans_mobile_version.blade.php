						<div id="{{ucfirst($row1->type)}}" class="container tab-pane {{ ($index==0)?'active':'fade' }}"><!-- <br> -->
							<!-- <h3>{{ucfirst($row1->type)}}</h3> -->
<div class="price-box col-md-12 pricing"> 
							@if($row1->type == 'trial')
							<form id="checkout-form" action="{{ url('trial/version/user') }}" method="POST" >
								@else<form id="checkout-form" action="{{ url('checkout') }}" method="POST" >
									@endif
									<input type="hidden" name="client_id" id="" value="{{ isset($id)?$id:'' }}">
									{{ csrf_field() }}
									<br>
									@foreach($plans as $index=>$value)
									@if($row1->type == $value->type)

									@if(isset($current_plan['plan_id']) && $current_plan['plan_id'] ==  $value['id'] && $row1->count_plan == 1)
									<input type="hidden" class="plan_already_taken" name="plan_already_taken" value="plan_already_taken">
									@endif

									@if(isset($current_plan['plan_id']) && $current_plan['plan_id'] ==  $value['id'])
									<label for="signup" class="active_plan">
										{{ $value->title." $".$value->cost_price }}
										<span class="overline">{{'$'. ($value->sale_price)?$value->sale_price:'' }}</span>
									</label>
									@else
				
									<label for="signup">
										<input type="radio" name="plan_id" value="<?php echo $value['id'];?>" cost_price = "{{ $value->monthly_price }}" class="check_monthly_val_mob check_plan_type" plan_type_mob = "{{ $value->type }}" {{($row1->id==$value->id)?'checked':''}}  >
										{{ $value->title." $".$value->cost_price }}
										<span class="overline">
											{{'$'. ($value->sale_price)?$value->sale_price:'' }}
										</span>
									</label>
		
									@endif
									<br>
									@endif
									@endforeach
									<h2 class="setval_mob_{{ $row1->type }}"><span>$</span>
										{{ $row1->monthly_price }}<p 
													style="display: inline-block;color: #6D6E71;"> / {{($row1->type == "one_dollar_Deal")?" 15-Days":' Month' }}</p></h2>
									<!-- <br> -->
									<input type="submit" class="learn-more sub_btn"  value="Get Plan" id="">
								</form>
								<section class="price-offer-list">
									<ul>@foreach($assigned_features as $assigned_feature)
									@if($assigned_feature->type == $row1->type )
									<li><img src="https://www.thewispy.com/wp-content/uploads/2020/04/pricing-offer-tick.png"> {{ $assigned_feature->features['feature_name'] }} </li>
									@endif
									@endforeach</ul>
								</section>

							</div>
							</div>