<?php
parse_str($_SERVER["QUERY_STRING"]);
if(!$sub || !$sec) {
  header("Location:https://padhhigh.com/higher");
}
if(!($sub > 0 && $sub < 4) || !($sec > 0 && $sec < 4)){
   header("Location:https://padhhigh.com/higher");
}

$MESSAGE = NULL;
$STATUS = NULL;
$DISCOUNT = 0;
$coupon = NULL;

$M1_PRICE = NULL;
$M1_CURRENT_LINK = NULL;
$M3_PRICE = NULL;
$M3_CURRENT_LINK = NULL;
$M12_PRICE = NULL;
$M12_CURRENT_LINK = NULL;

function renderBox($prices, $links,  $discount, $month) {
  $price = "<span style='display:block;margin:12px 0; font-weight:bold'>&#8377;$prices[0]</span>";
  $link = $links[$discount];
  $discountPer = "";
  $percent = "";
  $deal = "";
  if($discount) {
    //set price element
    $price = "<span style='font-weight:bold'>&#8377;$prices[1]</span><br>
    <del>&#8377;$prices[0]</del>";
    //set percent element
    $percent = 100 - round(($prices[1]/$prices[0])*100);
    $discountPer = "<div class='box5'></div>
    <div class='box4'>$percent% OFF</div>";
	$deal = $percent >= 50 ? '<div class="deal">BEST DEAL</div>' : '';
  }
  return "<div class='box'>
  <div class='box1'>
    $deal
    <div id='price1'>$price</div>
  </div>
  <div class='box2'>
    <div class='box3'>$month month</div>
    $discountPer
  </div>
  <div id='$link' onclick='selectPlan(event)' class='select-plan'></div>
 </div>";
}

switch ($sub) {
    case 1:
	  $M1_PRICE = array(999, 699);
      $M1_CURRENT_LINK = array("https://rzp.io/l/jCXquRKac", "https://rzp.io/l/eejuLSd");
      $M3_PRICE = array(2999, 1499);
      $M3_CURRENT_LINK = array("https://rzp.io/l/pUN3XpBq3", "https://rzp.io/l/lr9tRcmKD");
      $M12_PRICE = array(11999, 3499);
      $M12_CURRENT_LINK = array("https://rzp.io/l/tgt5HMg", "https://rzp.io/l/5uUUcrHB");
      break;
    case 2:
      $M1_PRICE = array(1899, 1199);
      $M1_CURRENT_LINK = array("https://rzp.io/l/LrDE74l", "https://rzp.io/l/P6XUo6F");
      $M3_PRICE = array(4499, 2199);
      $M3_CURRENT_LINK = array("https://rzp.io/l/gLBl8YPG", "https://rzp.io/l/EFjBwlt9");  
      $M12_PRICE = array(18999, 5999);
      $M12_CURRENT_LINK = array("https://rzp.io/l/AwlDe2SRA", "https://rzp.io/l/imruVUGE");        
      break;
    case 3:
      $M1_PRICE = array(2799, 1599);
      $M1_CURRENT_LINK = array("https://rzp.io/l/8XdQHl1", "https://rzp.io/l/ZOfUiWK");
      $M3_PRICE = array(6999, 2499);
      $M3_CURRENT_LINK = array("https://rzp.io/l/qXEoyoTuR", "https://rzp.io/l/bU2jmO7");
      $M12_PRICE = array(23999, 5999);
      $M12_CURRENT_LINK = array("https://rzp.io/l/izsJWZxQ", "https://rzp.io/l/imruVUGE");
      break;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
   $coupon = $_POST["coupon"];
   //$conn = new mysqli('localhost','root','','test'); 
   $conn = new mysqli('localhost','padhhigh_padhhigh','padhhigh','padhhigh_padhhigh');

 if ($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error);
	$STATUS = "fail";
	$MESSAGE = "Something went wrong";
 }else{
	if($coupon) {
		$coupon_query = "SELECT * FROM coupons WHERE coupon = '$coupon' ";
		$get_coupon = $conn->query($coupon_query);
  
		if($get_coupon->num_rows == 0) {  
		  $STATUS = "fail";
		  $MESSAGE = "Invalid Coupon";
		}else{
		  $STATUS = "success";
		  $MESSAGE = $coupon." Coupon Applied Successfully";
		  $DISCOUNT = 1;
		}
		$_POST["coupon"] = NULL;
	 }
   }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<!-- Mirrored from themes.semicolonweb.com/html/canvas/demo-seo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 May 2021 09:22:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="test.css" type="text/css" />
	<!-- <link rel="stylesheet" href="css/dark.css" type="text/css" /> -->
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<!-- <link rel="stylesheet" href="css/animate.css" type="text/css" /> -->
	<!-- <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" /> -->

	<!-- Bootstrap Switch CSS -->
	<!-- <link rel="stylesheet" href="css/components/bs-switches.css" type="text/css" /> -->

	<!-- <link rel="stylesheet" href="css/custom.css" type="text/css" /> -->
	<meta name='viewport' content='initial-scale=1, viewport-fit=cover'>

	<!-- Seo Demo Specific Stylesheet -->
	<link rel="stylesheet" href="css/colors69bb.css?color=FE9603" type="text/css" /> <!-- Theme Color -->
	<link rel="stylesheet" href="demos/seo/css/fonts.css" type="text/css" />
	<link rel="stylesheet" href="demos/seo/seo.css" type="text/css" />
	<!-- / -->

	<!-- Document Title
	============================================= -->
	<title>Padhhigh</title>

</head>

<body class="stretched">
<style>
	.box {
		position: relative;
		border:2px solid transparent;
	}
	.select-plan {
		position: absolute;
		top:0;
		bottom:0;
		width:100%;
		height:100%;
	}
	.selected {
		border-color:green;
		border-radius:5px
	}
	</style>
	
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap pt-0">

				<!-- Features
				============================================= -->
<br>
<center><img src="logo.png"></center>
				<div class="section bg-transparent mt-4 mb-0 pb-0">
					<div class="container-fluid">

					<div class="section--title center margin--b50" style="background-color: #FFB100;border-radius: 20px;padding: 3px;" >
						<a href="#enroll-now-form"><h2 style="color: white;" > Register Now<br></h2>
						<h1 style="font-size: 80px;">
							 
						<h1 href="#enroll-now-form" id="plan"> <b style="color: #000;">Find a plan<span style="font-size: 40px;"><del></del> </span> <span style="color: white;"> that works for you</span></b></h1></h1>
							<h2 class="font--white"></h2>
							<a href="#enroll-now-form" >  <h3>Best Conceptual Learning <br>
							  For Your Child in 2021</h3></a>
					</div>
					
						  
						<center>  
						  <br>
						  <div class="divider-title">
							<span>ACCESSIBLE IN ANY DEVICE</span>
						  </div>
						</center>

						<div class="section m-0"
						style="background: linear-gradient(to top,#ffb5075e 0,#fff 100%); background-size: cover; padding: 0px 0 0;">
							<div class="container">
								<div class="row justify-content-between">
								<div class="col-lg-6 mt-4">
                                        <div class="heading-block border-bottom-0 bottommargin-sm">
                                            <div class="badge rounded-pill badge-default">Pricing Table</div>
                                            <h3 class="nott ls0">QUIQ UNDERSTANDING</h3>
                                        </div>
                                        <p>PADHHIGH designed this QUIQ program in the simplest way for every student to learn & understand the concepts quickly in a affordable manner. Enroll Now & witness the growth in your child education.</p>
										<form style="flex-wrap:wrap" class="form" method="POST" action=''>
											<input name='coupon' placeholder="Enter Coupon" /><br><br>
										<a href=""><button>Apply Coupon</button></a>	
										<p id="coupon-status" class="<?php echo $STATUS?>"><?php echo $MESSAGE ?></p>
										<style>
											#coupon-status {
												text-align:center;
												width:fit-content;
												padding:3px;
												margin:0 auto;
											}
											.success {
												color: yellowgreen;
											}
											.fail {
												color: orangered;
											}
										</style>
										</form>
                                    </div>
								

									<div class="col-lg-6">
										<div id="section-pricing" class="page-section p-0 m-0">

											<div id="pricing-switch" class="pricing row align-items-end g-0 col-mb-50 mb-4">

												<div class="col-md-8">

													<div class="pricing-box">
														<div class="subject">
															<?php echo $sub?> Subject
														</div>
														<br>
														<?php 
														//fix this working but not efficeint
                              $sec1 = "";
							  $sec2 = "";
                              switch($sec) {
                                case 1:
								  $sec1 = renderBox($M1_PRICE, $M1_CURRENT_LINK, $DISCOUNT, 1);
								  $sec2 = renderBox($M3_PRICE, $M3_CURRENT_LINK, $DISCOUNT, 3);
                                  break;
                                case 2:
								  $sec1 = renderBox($M3_PRICE, $M3_CURRENT_LINK, $DISCOUNT, 3);
                                  $sec2 = renderBox($M12_PRICE, $M12_CURRENT_LINK, $DISCOUNT, 12);
                                  break;
                                case 3:
								  $sec1 = renderBox($M12_PRICE, $M12_CURRENT_LINK, $DISCOUNT, 12);
                                  break;
                              }
                              echo $sec1;
							  echo "<br>";
							  echo $sec2;
                            ?>
														<br>
														<br>
														<div class="pricing-action">
															<div class="pts-switch-content-left"><a id="getting-started" href="#"
																	class="button button-large button-rounded w-100 text-capitalize m-0 ls0">Get
																	Started</a></div>
														</div>
													</div>

												</div>



											</div>

										</div>
									</div>

								</div>
							</div>
						</div>
						<br>
						<br>
						<br>

						<div class="row justify-content-center align-items-center">

						<div class="col-lg-6 col-sm-12">

<div class="feature-box flex-md-row-reverse text-md-end border-0">
	<div class="fbox-icon">
		<a href="#"><img src="demos/seo/images/icons/seo.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
	</div>
	<div class="fbox-content">
		<h3 class="nott ls0">Visualized Learning</h3>
	</div>
</div>

<div class="feature-box flex-md-row-reverse text-md-end border-0 ">
	<div class="fbox-icon">
		<a href="#"><img src="demos/seo/images/icons/adword.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
	</div>
	<div class="fbox-content">
		<h3 class="nott ls0">Build Curiosity</h3>
	</div>
</div>

<div class="feature-box flex-md-row-reverse text-md-end border-0">
	<div class="fbox-icon">
		<a href="#"><img src="demos/seo/images/icons/analysis.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
	</div>
	<div class="fbox-content">
		<h3 class="nott ls0">Concept Clarity</h3>
	</div>
</div>

</div>


							
							<div class="col-lg-6 col-sm-12">

								
								<div class="feature-box border-0 ">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/experience.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Full CBSE curriculum</h3>
									</div>
								</div>

								<div class="feature-box border-0 ">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/content_marketing.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Fun & Joyful learning</h3>
									</div>
								</div>
								<div class="feature-box border-0 ">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/social.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Time & Cost Effective</h3>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>

				<!-- Pricing
				============================================= -->

				<!-- Form Section
				============================================= -->

		</section><!-- #content end -->


	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>
	<script defer>
		const selectedPlan = document.querySelector('#getting-started');
		let prevPlan = null;
		function selectPlan(e){
			const currPlan = e.path[1];
			const id = e.target.id;
            if(prevPlan) {
				prevPlan.classList.remove('selected');
			}
			currPlan.classList.add('selected');
			prevPlan = currPlan;
			selectedPlan.href = id;
		}
	</script>
</body>

<!-- Mirrored from themes.semicolonweb.com/html/canvas/demo-seo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 May 2021 09:24:16 GMT -->

</html>