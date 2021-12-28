	<section class="price-box {{ucfirst($row->type)}}-plan-box col-sm-4 col-md-4 pricing">
										<!-- <img src="https://www.thewispy.com/wp-content/themes/twentysixteen/images//basic.png" /> -->

										@if($row->type == "one_dollar_Deal")				<div class="item-right" style="
				position: absolute;
			    width: 159px;
			    height: 34px;
			    background-color: #da2997;
			    box-shadow: 0 1px 7px #333;
			    top: 22px;
			    right: -42px;
			    line-height: 40px;
			    transform: rotate(45deg);
			    font-weight: 450;
			    font-size: 12px;
			    color: #fff;
				">Limited Time Offer</div>
				<h1 style="
				padding: 0 17px 0 1px;
				">{{ 'Starter' }} </h1>				@else				<h1 >{{($row->type == "one_dollar_Deal")?"$1 Deal":ucfirst($row->type).' ' }} </h1>
				@endif
										<!-- <h2 class="setval_{{ $row->type }}">${{ $row->cost_price }}</h2> -->
									@if($row->type == 'trial')
							<form id="checkout-form" action="{{ url('trial/version/user') }}" method="POST" >
								@else<form id="checkout-form" action="{{ url('checkout') }}" method="POST" >
									@endif
												
										<input type="hidden" name="client_id" id="" value="{{ isset($id)?$id:'' }}">
												{{ csrf_field() }}
												<br>
											@foreach($plans as $index=>$value)
												@if($row->type == $value->type)

											@if(isset($current_plan['plan_id']) && $current_plan['plan_id'] ==  $value['id'] && $row->count_plan == 1)
												<input type="hidden" class="plan_already_taken" name="plan_already_taken" value="plan_already_taken">
												@endif

											@if(isset($current_plan['plan_id']) && $current_plan['plan_id'] ==  $value['id'])
												<label for="signup" class="active_plan">
													{{ $value->title." $".$value->cost_price }}
													<span class="overline"style="font-size: 12px!important">{{'$'. ($value->sale_price)?$value->sale_price:'' }}</span>
												</label>
												@else
												
												<!-- check inactive plans starts -->

												@if($value->status == 0)

												<label for="signup" class="overlinecol">
													{{ $value->title." $".$value->cost_price }}
													<span class="overline"style="font-size: 12px!important"></span>
												</label>

												@else


												<label for="signup">
													<input type="radio" name="plan_id" value="<?php echo $value['id'];?>" cost_price = "{{ $value->monthly_price }}" class="check_monthly_val check_plan_type" plan_type = "{{ $value->type }}" {{($row->id==$value->id)?'checked':''}}  >
													{{ $value->title." $".$value->cost_price }}
													<span class="overline">
														{{'$'. ($value->sale_price)?$value->sale_price:'' }}
													</span>
												</label>
										

												@endif

														<!-- check inactive plans ends -->


												@endif
												<!-- <br> -->
												@endif
												@endforeach
												<h2 class="setval_{{ $row->type }}"><span>$</span>
													{{ $row->monthly_price }}<p 
													style="display: inline-block;color: #6D6E71;"> / {{($row->type == "one_dollar_Deal")?" 15-Days":' Month' }} </p></h2>
												<input type="submit" class="learn-more sub_btn"  value="Get Plan" id="">
												
												<p class="physical_para">Required * : Physical access to the target Android phone.</p>

											</form>
											<section class="price-offer-list">
												@foreach($assigned_features as $assigned_feature)
												@if($assigned_feature->type == $row->type )
												<li><img src="https://www.thewispy.com/wp-content/uploads/2020/04/pricing-offer-tick.png"> {{ $assigned_feature->features['feature_name'] }} </li>
												@endif
												@endforeach
											</section>
										</section>