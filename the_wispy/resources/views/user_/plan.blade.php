@extends('layouts.user')
@section('content')
<style>
.container {max-width:100%;}
.pricing-tab-section .nav {max-width:264px; margin:0px auto; display:block !important; overflow:hidden;}
.pricing-tab-section .nav li {float:left; text-align:center; }
.pricing-tab-section .nav li a img {margin-right:20px;}
.pricing-tab-section .nav li a {padding:10px 20px; border:1px solid #808285; display: inline-block;
line-height: 35px;}
.pricing-tab-section .navigation-link.active {background:yellow;}
.first-link {border-top-left-radius:10px; border-bottom-left-radius:10px;}
.second-link {border-top-right-radius:10px; border-bottom-right-radius:10px;}
.price-box {width:33.33333%; float:left; padding:0px 10px; box-sizing:border-box; text-align:center; box-shadow: 1px 0px 8px 0px
rgba(0,0,0,0.2);
margin: 20px 0px;
min-height: 565px;
padding-top: 30px;}
.price-box h1 {font-size:30px; color:#000000; padding:20px 0px;}
.price-box h2 {font-size:40px; color:#000000;}
.faq-section {width:auto; margin:0px auto; padding:90px 0px; padding-bottom:0px;}
.faq-section h1 {text-align:center; font-size:30px; font-weight:500; color:#000;}
.faq-section p {color:#000; font-size:12px; text-align:center;}
.faq-box {width:50%; float:left; padding:0px 15px; box-sizing:border-box;}
.price-box p {color:#; font-size:16px; font-weight:400; padding-bottom:15px;}
.price-box p img {margin-right:20px;}
.price-box p.disable {margin-left:40px; color:gray;}
.we-can-do-pricing {width:auto; margin:0px auto; padding:90px 0px; background:#F1F2F2; margin-top:90px;}
.we-can-do-pricing h1 {text-align:center; font-size:30px; color:#414042; padding-bottom:20px; font-weight:500;}
.we-can-do-pricing p {text-align:center; color:#6F6F6F; font-size:12px; margin-bottom:100px !important	; }
.cndo-pricing-box {width:30%; margin:0px 1.5%; float:left; padding:0px 10px; box-sizing:border-box; text-align:center; cursor:pointer; padding:60px 20px; box-sizing:border-box;}
.cndo-pricing-box:hover {background:yellow;}
.cndo-pricing-box:hover .forward-icon {display:block;}
.cndo-pricing-box:hover .forward-icon img {position: absolute; z-index: 9999; margin-left: -35px;
margin-top: 30px;}
.cndo-pricing-box .forward-icon {display:none;}
.cndo-pricing-box h2 {color:#414042; font-size:18px; font-weight:500; padding-bottom:15px; padding-top:15px;}
.cndo-pricing-box.last-box h2 {padding-bottom:35px;}
.cndo-pricing-box p {color:#6F6F6F; font-size:12px; margin:0px !important; line-height:25px; text-align:left;}
.cndo-img img {position: absolute; margin-top: -112px;margin-left: -60px}
.cndo-pricing-box:hover .cndo-img img {filter: brightness(0) invert(1);}
.faq-box {width:50%; float:left; padding:0px 10px; box-sizing:border-box;}
.accordian-section {background:#F1F2F2; padding:20px 20px; box-sizing:border-box; margin-bottom:20px; border-radius:20px;}
.accordian-section .fa {margin-right:30px; font-size:12px; color:#414042;}
.accordian-section button {font-weight:500; border:none; font-size:16px; color:#414042; cursor:pointer}
.accordian-section p {font-size:12px; color:#414042;}
.accordian-body {padding-top:30px; padding-left:45px;}
.accordian-body p {text-align:left;}
.faq-content {overflow:hidden; padding-top:60px;}
</style>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jawwadaf_cp_yspy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "SELECT * FROM `plans` WHERE title like '%Basic%'";
$result1 = $conn->query($sql1);
$sql2 = "SELECT * FROM `plans` WHERE title like '%Pro%'";
$result2 = $conn->query($sql2);
$sql3 = "SELECT * FROM `plans` WHERE title like '%Ultimate%'";
$result3 = $conn->query($sql3);
?>
<div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="white-box">
<article class="pricing-tab-section">
					<figure class="container">
						<section class="price-tab">
							<!-- Nav tabs -->
							  <ul class="nav">
								<li class="nav-item">
								  <a style="border-right:0px;" class="navigation-link first-link active" data-toggle="tab" href="#home"><img src="http://www.thewispy.com/wp-content/themes/twentysixteen/images/price-andriod.png"/>Android</a>
								</li>
								<li class="nav-item">
								  <a class="navigation-link second-link" data-toggle="tab" href="#menu1"><img src="http://www.thewispy.com/wp-content/themes/twentysixteen/images/price-andriod.png" />IOS</a>
								</li>
							  </ul>
							   <div class="tab-content">
									<div id="home" class="tab-pane active"><br>

										<section class="price-box">
											<img src="http://www.thewispy.com/wp-content/themes/twentysixteen/images//basic.png" />
											<h1>Basic Version</h1>

											<h2 class="setval"></h2>


											<?php 
											$count1=0;
											while($row1 = $result1->fetch_assoc())
											{
												$count1++;
											?>
											<p>
												<input type="radio" id="signup" class="signup1" name="basic" value="<?php echo $row1['id'];?>" <?php if($count1==1):echo "checked='checked'";else:echo "";endif;?> data-<?php echo $row1['id'];?>="<?php echo $row1['id'];?>" data-costprice-<?php echo $row1['id'];?>="<?php echo $row1['cost_price'];?>" data-default-first-<?php echo $count1;?>="<?php echo $row1['cost_price'];?>" data-month-val-<?php echo $row1['id'];?>="<?php echo preg_replace("/[^0-9]/", '',$row1['title']);?>">
											<label for="signup"><?php echo $row1['title']." "."$".$row1['cost_price'];?>    <span class="overline"><?php echo "$".$row1['sale_price'];?></span></label>
											</p>
										<?php } ?>
											<a class="learn-more getbasic" href="javascript:void(0)">Get Plan</a>
										</section>
										<section class="price-box">
											<img src="http://www.thewispy.com/wp-content/themes/twentysixteen/images//standard.png" />
											<h1>Pro Version</h1>

											<h2 class="setvalpro"></h2>

											<?php 
											$count2=0;
											while($row2 = $result2->fetch_assoc())
											{
												$count2++;
												
											?>
											<p>
												<input type="radio" id="signup" class="pro" name="pro" value="<?php echo $row2['id'];?>" <?php if($count2==1):echo "checked";else:echo "";endif;?> data-<?php echo $row2['id'];?>="<?php echo $row2['id'];?>" data-costprice-<?php echo $row2['id'];?>="<?php echo $row2['cost_price'];?>" data-default-pro-<?php echo $count2;?>="<?php echo $row2['cost_price'];?>" data-month-val-<?php echo $row2['id'];?>="<?php echo preg_replace("/[^0-9]/", '',$row2['title']);?>">
											<label for="signup"><?php echo $row2['title']." ". "$".$row2['cost_price'];?> <span class="overline"><?php echo "$".$row2['sale_price'];?></span></label>
											</p>
										<?php } ?>

									<a class="learn-more getpro" href="javascript:void(0)">Get Plan</a>
										</section>
										<section class="price-box">
											<img src="http://www.thewispy.com/wp-content/themes/twentysixteen/images//pro.png" />
											<h1>Ultimate Version</h1>

											<h2 class="setultimate"></h2>
								
											<?php 
											$count3=0;
											while($row3 = $result3->fetch_assoc())
											{
												$count3++;
												//print_r($row1);
											?>
											<p>
												<input type="radio" id="signup" class="ultimate" name="ultimate" value="<?php echo $row3['id'];?>" <?php if($count3==1):echo "checked";else:echo "";endif;?> data-<?php echo $row3['id'];?>="<?php echo $row3['id'];?>" data-costprice-<?php echo $row3['id'];?>="<?php echo $row3['cost_price'];?>" data-default-ultimate-<?php echo $count3;?>="<?php echo $row3['cost_price'];?>" data-month-val-<?php echo $row3['id'];?>="<?php echo preg_replace("/[^0-9]/", '',$row3['title']);?>">
											<label for="signup"><?php echo $row3['title']." ". "$".$row3['cost_price'];?> <span class="overline"><?php echo "$".$row3['sale_price'];?></span></label>
											</p>
										<?php } ?>

											<a   href="javascript:void(0)" class="learn-more getplanultimate">Get Plan</a>
										</section>
									</div>
									<div id="menu1" class="container tab-pane fade"><br>
									  <h1>Coming Soon</h1>
									</div>	
									</div>
						</section>
					</figure>
				</article>
</div>
</div>
</div>


				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
$( document ).ready(function() {

	$(".setval").html("$"+ $(".signup1").attr("data-default-first-1"));
	$(".setvalpro").html("$"+ $(".pro").attr("data-default-pro-1"));
	$(".setultimate").html("$"+ $(".ultimate").attr("data-default-ultimate-1"));
	

});


$('.signup1').on('input',function(e){
var pkgprice=$(this).attr("data-costprice-"+$(this).val());
var monthval=$(this).attr("data-"+$(this).val());
var actualmonthval=$(this).attr("data-month-val-"+$(this).val());
var calval=(pkgprice/actualmonthval).toFixed(2);
$(".setval").html("$"+calval);
});
////////////////////////

$('.pro').on('input',function(e){
var pkgprice=$(this).attr("data-costprice-"+$(this).val());
var monthval=$(this).attr("data-"+$(this).val());
var actualmonthval=$(this).attr("data-month-val-"+$(this).val());
var calval=(pkgprice/actualmonthval).toFixed(2);
$(".setvalpro").html("$"+calval);
});
/////////////////

$('.ultimate').on('input',function(e){
var pkgprice=$(this).attr("data-costprice-"+$(this).val());
var monthval=$(this).attr("data-"+$(this).val());
var actualmonthval=$(this).attr("data-month-val-"+$(this).val());
var calval=(pkgprice/actualmonthval).toFixed(2);
$(".setultimate").html("$"+calval);
});


	$('.getplanultimate').on('click',function(e){
	  var radioValue = $("input[name='ultimate']:checked").val();
	  document.location.href = "{{url('checkout')}}"+"/"+radioValue;
});
 

$('.getpro').on('click',function(e){
	  var radioValue = $("input[name='pro']:checked").val();
	  document.location.href = "{{url('checkout')}}"+"/"+radioValue;
});

$('.getbasic').on('click',function(e){
	  var radioValue = $("input[name='basic']:checked").val();
	  document.location.href = "{{url('checkout')}}"+"/"+radioValue;
});


</script>
								<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


								<style type="text/css">
								.overline 
								{ 
								text-decoration: line-through solid; 
								} 

								</style>
@endsection