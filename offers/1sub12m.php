<?php
$MESSAGE = NULL;
$STATUS = NULL;
$DISCOUNT = 0;
$coupon = NULL;

$M1_PRICE = array(2999, 1499);
$M1_CURRENT_LINK = array("https://rzp.io/l/me5raUjskr", "https://rzp.io/l/lr9tRcmKD");
$M3_PRICE = array(999, 699);
$M3_CURRENT_LINK = array("https://rzp.io/l/jCXquRKac", "https://rzp.io/l/eejuLSd");
$M12_PRICE = array(11999, 3499);
$M12_CURRENT_LINK = array("https://rzp.io/l/tgt5HMg", "https://rzp.io/l/5uUUcrHB");

if($_SERVER["REQUEST_METHOD"] == "POST") {
   $coupon = $_POST["coupon"]; 
   $conn = new mysqli('localhost','padhhigh_padhhigh','padhhigh','padhhigh_padhhigh');
   //$conn = new mysqli('localhost','root','','test');
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
	<title>SEO Demo | Canvas</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap pt-0">

				<!-- Features
				============================================= -->
				<div class="section bg-transparent mt-4 mb-0 pb-0">
					<div class="container-fluid">

						<div class="heading-block border-bottom-0 center mx-auto mb-0" style="max-width: 800px">
							<!-- <div class="badge rounded-pill badge-default">Services</div> -->
							<h2 class="nott ls0 mb-3">Find a plan that works for you</h2>
							<!-- <p>Dynamically provide access to resource-leveling mindshare vis-a-vis bricks-and-clicks ideas authoritatively.</p> -->
						</div>




                        <div class="section m-0" style="background: url('demos/seo/images/sections/4.png') no-repeat center top; background-size: cover; padding: 0px 0 0;">
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6 mt-4">
                                        <div class="heading-block border-bottom-0 bottommargin-sm">
                                            <div class="badge rounded-pill badge-default">Pricing Table</div>
                                            <h3 class="nott ls0">QUIQ UNDERSTANDING</h3>
                                        </div>
                                        <p>PADHHIGH designed this QUIQ program in the simplest way for every student to learn & understand the concepts quickly in a affordable manner. Enroll Now & witness the growth in your child education.</p>
										<form action="" method="POST">
											<input placeholder="Enter Coupon" name="coupon">
										    <a><button>Apply Coupon</button></a>	
										</form>
										<p id="coupon-status" class="<?php echo $STATUS?>"><?php echo $MESSAGE ?></p>
										<style>
											#coupon-status {
												width:fit-content;
												padding:3px;
												color:white;
												border-radius:5px
											}
											.success {
												background-color: rgba(153, 205, 50, 0.568);
												border:2px solid yellowgreen;
											}
											.fail {
												background-color: rgba(255, 68, 0, 0.637);
												border:2px solid orangered;
											}
										</style>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div id="section-pricing" class="page-section p-0 m-0">
        
                                            <div id="pricing-switch" class="pricing row align-items-end g-0 col-mb-50 mb-4">
        
                                                <div class="col-md-8">
													
                                                    <div class="pricing-box">
														<div class="subject">
															1 Subject
														</div>
														
														<br>
														<div class="box">
															
															<div class="box1">
																<div class="deal">BEST DEAL</div>
																<div id="price2" style="margin:1.1% auto"> 
																   <?php 
																    if($DISCOUNT) {
																	    echo "<span>&#8377;$M12_PRICE[1]</span><br><del>&#8377;$M12_PRICE[0]</del>";
																	}else{
																		echo "<span>&#8377;$M12_PRICE[0]</span>";
																	} 
																   ?>
															    </div>
															</div>
															<div class="box2">
																<div class="box3">12 month</div>
																<?php
																 if($DISCOUNT) {
																   echo "<div class='box5'></div>
																   <div class='box4'>70% OFF</div>";
																 }
																?>
															</div>
														</div>
													<br>
													<br>
                                                        <div class="pricing-action">
                                                            <div class="pts-switch-content-left"><a href="<?php echo $M12_CURRENT_LINK[$DISCOUNT] ?>" class="button button-large button-rounded w-100 text-capitalize m-0 ls0">Get Started</a></div>
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

							<div class="col-lg-4 col-sm-6">

								<div class="feature-box flex-md-row-reverse text-md-end border-0">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/seo.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Visualized Learning</h3>
									</div>
								</div>

								<div class="feature-box flex-md-row-reverse text-md-end border-0 mt-5">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/adword.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Build Curiosity</h3>
									</div>
								</div>

								<div class="feature-box flex-md-row-reverse text-md-end border-0 mt-5">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/analysis.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Concept Clarity</h3>
									</div>
								</div>

							</div>



							<div class="col-lg-4 col-sm-6">

								<div class="feature-box border-0">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/social.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Time & Cost Effective</h3>
									</div>
								</div>

								<div class="feature-box border-0 mt-5">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/experience.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Full CBSE curriculum</h3>
									</div>
								</div>

								<div class="feature-box border-0 mt-5">
									<div class="fbox-icon">
										<a href="#"><img src="demos/seo/images/icons/content_marketing.svg" alt="Feature Icon" class="bg-transparent rounded-0"></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott ls0">Fun & Joyful learning</h3>
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

</body>

<!-- Mirrored from themes.semicolonweb.com/html/canvas/demo-seo.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 May 2021 09:24:16 GMT -->
</html>
