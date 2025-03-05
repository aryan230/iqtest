<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<?php
/*
 * Template Name: Result Page
 */

get_header();

if (isset($_GET['order-received'])) {
    $order_id = absint($_GET['order-received']); // Retrieve the order ID safely
    echo '<p>Your Order ID is: <strong>' . esc_html($order_id) . '</strong></p>';
}

$contact_data = "";
// if (isset($_SESSION['contact_form_data'])) {
//     $contact_data = $_SESSION['contact_form_data'];
// }
$has_result = false;
$total_time = 1800; // 30 minutes
$discount_time = 900;
$test_duration_seconds = 0;
$iq_countries = get_field('iq_countries');

//echo $formatted_time; // Output: 05m:31s

if( isset($_SESSION['quiz_curr_time']) && ( (time() - $_SESSION['quiz_curr_time']) <= ($total_time + 20) ) && isset($_SESSION['quiz_data']) && is_array($_SESSION['quiz_data']) ){
    $has_result = true;

    $raw_score = 0;
    $test_duration_seconds = $total_time - $_SESSION['quiz_time'];
    $ques_cat_slugs = [];


    foreach ($_SESSION['quiz_data'] as $key => $ques) {
        $acf_data = get_field('acf_data', $ques['id']);
        $terms = get_the_terms($ques['id'], 'question_cat' );
        $ques_type = $terms[0];
        $is_correct = false;

        foreach( $acf_data['answers'] as $key => $acf_answer ){
            if( $ques['answer'] == ($key + 1) && $acf_answer['correct'] ){
                $raw_score = $raw_score + 1;
                $is_correct = true;
                break;
            }
        }

        if( isset($ques_cat_slugs[$ques_type->slug]) ){
            if($is_correct){
                if( isset($ques_cat_slugs[$ques_type->slug]['total_correct_ans']) ){
                    $ques_cat_slugs[$ques_type->slug]['total_correct_ans'] += 1;
                } else {
                    $ques_cat_slugs[$ques_type->slug]['total_correct_ans'] = 1;
                }
            }
            if( isset($ques_cat_slugs[$ques_type->slug]['total_time']) ){
                $ques_cat_slugs[$ques_type->slug]['total_time'] += $ques['time'];
            } else {
                $ques_cat_slugs[$ques_type->slug]['total_time'] = $ques['time'];
            }
        } else {
            $ques_cat_slugs[$ques_type->slug] = [
                'name'=> $ques_type->name,
                'total_correct_ans'=> $is_correct ? 1 : 0,
                'total_time'=> $ques['time'],
                'score'=> 0,
            ];
        }
    }

    $mean_score_constant = 13;
    $standard_deviation_constant = 2;
    $time_score_constant = 0.025;

    $iq_score = 100 + ( 15 * ($raw_score - $mean_score_constant)/$standard_deviation_constant ) + ( (540 - $test_duration_seconds) * $time_score_constant );
    // Check if the IQ score needs to be adjusted based on the bounds
    if ($iq_score < 78) {
        $iq_score = 78;
    } elseif ($iq_score > 153) {
        $iq_score = 153;
    }
    $_SESSION['quiz_score'] = round($iq_score);

    foreach ($ques_cat_slugs as $key => $ques_cat_slug) {
        $time_score_constant = 0.025;
        // var_dump($ques_cat_slug['total_correct_ans']);
        // var_dump($ques_cat_slug['total_time']);
        // echo '<hr>';
        $section_score = ( ($ques_cat_slug['total_correct_ans'] / 4) * 40 ) + (108 - $ques_cat_slug['total_time']) * $time_score_constant;
        // Check if the section score needs to be adjusted based on the bounds
            if ($section_score < 0) {
                $section_score = 0;
            } elseif ($section_score > 40) {
                $section_score = 40;
            }
        $ques_cat_slugs[$key]['score'] = $section_score;
    }
$minutes = floor($test_duration_seconds / 60);
$seconds = $test_duration_seconds % 60;

// Format the output as "mm:ss"
$formatted_time = sprintf("%02dm:%02ds", $minutes, $seconds);
}

if ($test_duration_seconds) {
    $speed_percentage = round(100 - (($test_duration_seconds / $total_time) * 100));
} else {
    $speed_percentage = 0;
}

if ($speed_percentage < 95) {
    $speed_percentage = 95;
}
$product_ids = get_field('products');

$session = get_field('session');
$featured_title = get_field('featured_title');
$add_to_cart_title = get_field('add_to_cart_title');
$intro = get_field('intro');
$latest_results = get_field('latest_results');
$checkout_url = wc_get_checkout_url();
$tpl_dir_uri = get_stylesheet_directory_uri();
//echo $has_result;

 $cart = WC()->cart; // Get the cart object.
$cart_total = $cart->get_subtotal();
$regular_price_total = 0; // Initialize the total regular price.
$sale_price_total = 0; // Initialize the total sale price.

foreach ( $cart->get_cart() as $cart_item ) {
    $product = $cart_item['data']; // Get the product object.
    $quantity = $cart_item['quantity']; // Get the quantity of the product in the cart.

    // Get the regular price and sale price.
    $regular_price = $product->get_regular_price(); // Regular price.
    $sale_price = $product->get_sale_price(); // Sale price.

    // Calculate totals based on quantity.
    $regular_price_total += $regular_price * $quantity;
    if ( $sale_price ) {
        $sale_price_total += $sale_price * $quantity;
    } else {
        $sale_price_total += $regular_price * $quantity;
    }
}

// Output the totals.
// echo "Total Regular Price: " . wc_price( $regular_price_total );
// echo "<br>";
// echo "Total Sale Price (or Regular Price if no sale): " . wc_price( $sale_price_total );


?>

<style>
    #loader {
    position: fixed;
    top: 0;
    left: 0;
    right:0;
    bottom:0;
    background: #fff;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}
section.order-recived.order-done {
    display: none;
}
body.woocommerce-order-received section.order-recived.order-done {
    display: block;
}
body.woocommerce-order-received section.my-4.result-order {
    display: none;
}
.site-content .ast-container {
    display: block;
}
.time-box-sec .time-box {
    background-color: #E8FEEA;
    padding: 20px;
    text-align: center;
    margin-bottom: 100px;
    position: relative;
}

.time-box-sec .time-box h3 {
    font-size: 25px;
    font-weight: 500;
    line-height: 1.5;
}
.time-box-sec .time-box h3 span {
    display: inline-block;
    font-weight: 800;
    color: #2b79c3;
}
.time-box-sec .time-box:after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    height: 100px;
    bottom: -100px;
    background-image: url(https://www.iqtestglobal.org/wp-content/uploads/2025/01/celebration-svg.svg);
}

.cong-sec {
    text-align: center;
}

.cong-sec h1 {
    font-size: 44px;
    font-weight: 700;
    color: #2b79c2;
    margin-bottom: 15px;
}

.cong-sec h2 {
    font-size: 44px;
    margin-bottom: 25px;
}

.cong-sec h2 span {
    color: #2b79c2;
    font-weight: 800;
}

.dumy-certificate-box {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    border: #d7d7d7 1px solid;
}

.dumy-certificate-box img {
    width: 100%;
    height: auto;
}

.dumy-certificate-box .student-name {
    position: absolute;
    bottom: 45%;
    width: 100%;
    font-size: 28px;
    font-weight: 700;
}

.dumy-certificate-box .today-date {
    position: absolute;
    bottom: 14%;
    left: 3%;
    font-size: 10px;
    font-weight: 700;
}

.get-result-btn {
    padding: 40px 0;
}

.get-result-btn a {
    background-color: #004aad;
    padding: 15px 30px;
    display: inline-block;
    font-size: 16px;
    font-weight: 500;
    color: #FFF;
    border-radius: 4px;
}

.order-details-sec {
    padding: 60px 0 20px;
}

.order-details-sec h3 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 500;
    line-height: 40px;
    font-size: 26px;
}

.order-details-sec h3 span {
    font-weight: 800;
}

table, td, th {
    border: none;
}
span.tr-no {
    width: 25px;
    height: 25px;
    display: block;
    background-color: #d8e0f2;
    border-radius: 100px;
    text-align: center;
    line-height: 25px;
}
.order-details-sec table.table {
    background-color: #FFF;
    margin: 0;
}

.order-details-sec table.table thead {
    background-color: #0F3763;
}

.order-details-sec table.table thead th {
    color: #FFF;
    padding: 20px;
}

.order-details-sec table.table tbody td {
    padding: 20px;
vertical-align: middle;
}

.order-details-sec table.table tbody tr td:nth-child(3) {
    text-align: right;
    font-size: 20px;
}

.order-details-sec table.table tbody tr td:nth-child(3) span {
    font-weight: 700;
    display: block;
}

.order-details-sec table.table tbody tr:nth-child(even) {
    background-color: #EDF1FF;
}

table.het-border {
    border-top: 10px solid #13457A;
    margin-bottom: 5px;
}

.het-border tr th span {
    font-size: 26px;
    display: block;
    font-weight: 800;
    font-style: normal;
}

.het-border tr th {
    text-align: right;
    font-style: italic;
}

.het-border tr th span#countdown {
    color: #2b79c4;
}

.iq-button {
    border-top: 1px solid #000;
    padding: 20px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.iq-button img {
    width: 35%;
}
.asp_product_buy_btn_container {
    display: inline-block;
}

.asp_product_buy_btn_container a {
    background-color: #2b79c2;
    padding: 15px 30px;
    display: inline-block;
    font-size: 16px;
    font-weight: 500;
    color: #FFF;
    border-radius: 4px;
}

.uni-logos-sec {
    padding: 30px 0;
}

.uni-logos-sec h3 {
    text-align: center;
    color: #2b79c3;
    font-size: 23px;
    font-weight: 700;
    margin-bottom: 20px;
}

.uni-logos-sec .uni-logos .uni-logo {
    text-align: center;
}
.uni-logos-sec .uni-logos .uni-logo img {
    width: 100%;
    height: auto;
    max-width: 150px;
}

.alert-sec {
    padding: 20px 0;
}

.elementor-alert {
    background-color: #D0080829;
    padding: 15px;
    border-left: 5px solid #f9f0c3;
    position: relative;
}

.elementor-alert h5 {
    color: green;
    font-size: 16px;
}

.elementor-alert p {
    color: #000;
    font-size: 14px;
    line-height: 20px;
    padding: 3px 0 0;
}

.elementor-alert button.alert-dismiss {
    line-height: 1;
    padding: 3px;
    position: absolute;
    background: transparent;
    top: 5px;
    right: 8px;
    color: #6d6060;
    font-size: 20px;
    cursor: pointer;
}

.say-about-sec {
    padding: 30px 0;
}

.say-about-sec h3.line-title {
    position: relative;
    text-align: center;
    font-weight: 700;
    font-size: 24px;
}

.say-about-sec h3.line-title span {
    background-color: #FFF;
    display: inline-block;
    padding: 0 30px;
    position: relative;
    z-index: 1;
}

.say-about-sec h3.line-title:before {
    content: '';
    width: 100%;
    height: 1px;
    position: absolute;
    top: 50%;
    left: 0;
    background-color: #575757;
}

.say-about-sec .review-icon {
    padding: 20px 0;
    text-align: center;
}

.say-about-sec .review-icon img {
    width: 100%;
    max-width: 150px;
}

.say-about-sec .review-text {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #000;
}

.say-about-sec .review-text img {
    width: 100%;
    max-width: 67px;
    margin: 0 4px;
}

.say-about-sec .review-text strong {
    padding: 0 5px;
}

.time-box-sec {
    padding: 25px 0 0;
}  
.order-details-sec table.table tbody td img {
    width: 100%;
    max-width: 600px;
} 
.cong-sec h2.use-name {
    font-size: 40px;
    color: #3d9549;
    font-weight: 800;
}
div#customer_details {
    display: none;
}
span.sale-price {
    color: #159804;
}
h3#order_review_heading {
    display: none;
}
.het-border tr th span bdi {
    display: flex;
    justify-content: end;
    padding: 5px 0;
}
.het-border tr th span.total-price bdi {
    text-decoration: line-through;
    font-size: 18px;
}
table.het-border tr:nth-child(2) th {
    padding-top: 0;
}

table.shop_table.woocommerce-checkout-review-order-table {
    display: none;
}

h3.product-name {
    display: none;
}

.yith-wcmcs-shortcode {
    display: none;
}
ul.woocommerce-error {
    display: none;
}
form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review) {
    border: 0px;
    border-width: 0 0px 0px;
    padding: 0px;
    width: 220px;
}
.page-id-427 form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review) {
    border: 0px;
    border-width: 0 0px 0px;
    padding: 0px;
    width: 355px;
}
.page-id-433 form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review) {
    border: 0px;
    border-width: 0 0px 0px;
    padding: 0px;
    width: 395px;
}
.page-id-436 form #order_review:not(.elementor-widget-woocommerce-checkout-page #order_review) {
    border: 0px;
    border-width: 0 0px 0px;
    padding: 0px;
    width: 290px;
}
.iq-button button#place_order {
    margin: 0 !important;
    background-color: #004aad;
}
.iq-button .form-row.place-order {
    padding: 0 !important;
}
.het-border tr th span.total-price bdi span.woocommerce-Price-currencySymbol {
    font-size: 18px;
}


.uni-logos-sec .container {
    max-width: 1200px;
}
.swiper-button-next:after, .swiper-button-prev:after {
    font-size: 20px;
}
.swiper-button-next, .swiper-rtl .swiper-button-prev {
    right: 0;
}
.swiper-button-prev, .swiper-rtl .swiper-button-next {
    left: 0;
}
/*.blockUI.blockOverlay {
    position: fixed !important;
}*/
#ast-scroll-top span.ast-icon.icon-arrow {
    top: 10px;
    position: relative;
}
.swiper-wrapper {
  height: auto;
}


@media (max-width: 767px){
	.time-box-sec .time-box h3 {
	    font-size: 16px;
	}
	.time-box-sec .time-box {
	    padding: 10px;
	    margin-bottom: 20px;
	}
	.time-box-sec {
	    padding: 0;
	}
	.cong-sec h1 {
	    font-size: 28px;
	    margin-bottom: 5px;
	}
	.cong-sec h2 {
	    font-size: 20px;
	    margin-bottom: 20px;
	}
	.cong-sec h2.use-name {
	    font-size: 30px;
	    margin-bottom: 15px;
	}
	.order-details-sec {
	    padding: 20px 0;
	}
	.order-details-sec h3 {
	    margin-bottom: 20px;
	    line-height: 28px;
	    font-size: 18px;
	}
	.order-details-sec table.table thead th {
	    padding: 10px;
	}
	.order-details-sec table.table thead th img {
	    width: 20px;
	}
	.order-details-sec table.table tbody tr td:nth-child(3) {
	    font-size: 14px;
	}
	.het-border tr th span {
	    font-size: 20px;
	}
	.het-border tr th {
	    font-size: 12px;
	}
	.uni-logos-sec h3 {
	    font-size: 18px;
	    margin: 0;
	}
	.say-about-sec .review-text {
	    font-size: 12px;
	}
	.say-about-sec h3.line-title {
	    font-size: 18px;
	}
	.iq-button {
	    flex-flow: column-reverse;
	    gap: 26px;
	}
	.iq-button img {
	    width: 70%;
	}
	#payment .form-row.place-order button#place_order {
	    min-height: inherit;
	    padding: 16px 35px;
	    font-size: 16px;
	    width: 100% !important;
        min-width: 100%;
	}
	#sp-testimonial-free-wrapper-2526 .sp-testimonial-free-section {
		margin-bottom: 0;
	}
	.asp_product_buy_btn_container {
	    display: block;
	    width: 100%;
	}
	.get-result-btn {
	    padding: 20px 0 0;
	}
}

@media (max-width: 480px){
	.order-details-sec table.table tbody td {
	    padding: 10px;
	}
	.order-details-sec table.table thead th:first-child {
	    width: 40px;
	}
	#payment .form-row.place-order {
	    justify-content: flex-end;
	}
	.say-about-sec .review-text {
        font-size: 12px;
        display: inline-block;
        text-align: center;
    }
    .say-about-sec .review-text strong {
	    padding: 0;
	}
	.say-about-sec .review-text img {
	    margin: 0;
	}
	.dumy-certificate-box .student-name {
        font-size: 22px;
        height: 14px;
        margin: auto;
        bottom: 0;
        top: 0;
    }

    .dumy-certificate-box .today-date {
        opacity: 0;
    }
	.iq-button div#order_review {
	    width: auto !important;
	}
	.het-border tr th span {
        font-size: 18px;
    }
    .het-border tr th span.regular-price bdi {
	    font-size: 14px;
	}
	.uni-logos-sec {
	    padding: 0;
	}
	.dumy-certificate-box {
	    width: calc(100% - 50px);
	}
}

.woocommerce-js .woocommerce-customer-details .woocommerce-customer-details--email, .woocommerce-js .woocommerce-customer-details .woocommerce-customer-details--phone {
    margin-bottom: 0;
    padding-left: 1.5em;
    text-align: left;
}

.second-text-aryan{
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  font-size: 1rem;
  font-weight: 700;
  color: black
}

@media (max-width: 700px) {
    .second-text-aryan{
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  font-size: 0.5rem;
  color: black
}
}

@media (max-width: 400px) {
    .second-text-aryan{
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  font-size: 0.4rem;
  color: black
}
}

</style>
<div id="primary" <?php astra_primary_class(); ?>>
<div class="">
<section class="my-4 result-order">

<section class="time-box-sec">
    <div class="container">
        <div class="time-box">
            <h3>
                <?= (!empty(get_field('impressive'))) ? get_field('impressive') : '<strong>Impressive! </strong>you completed the test in :'; ?>
                <!-- Note the added ids for dynamic update -->
                <span id="formattedTime">loading</span>
                <?= (!empty(get_field('impressive_1'))) ? get_field('impressive_1') : 'Thats faster than'; ?>
                <span id="speedPercentage">95%</span> 
                <?= (!empty(get_field('impressive_2'))) ? get_field('impressive_2') : 'of people. Your strongest categories is <span>Abstract Reasoning.</span>'; ?>
            </h3>
        </div>
    </div>
</section>

<section class="cong-sec">
    <div class="container">
        <h1><?= (!empty(get_field('congratulations'))) ? get_field('congratulations') : 'Congratulations!'; ?></h1>
        <!-- Updated use-name element -->
        <h2 class="use-name">loading</h2>
        <h2><?= (!empty(get_field('welldone'))) ? get_field('welldone') : 'Well done! <br>Now lets get your results <br>and discover how high your IQ is! <br>As its quite <span>Rare!</span>'; ?></h2>
        <div class="dumy-certificate-box">
            <img src="<?= (!empty(get_field('Certificate_image'))) ? get_field('Certificate_image') : 'http://165.22.214.126/wp-content/uploads/2025/01/Certificate.png'; ?>">
            <!-- Here also update the student name from localStorage -->
            <div class="student-name"></div>
            <div class="today-date"></div>
        </div>
        <div class="get-result-btn">
            <a href="#order_details">GET MY IQ RESULTS</a>
        </div>
    </div>
</section>

<section class="order-details-sec">
    <div class="container">
    <h3><?= (!empty(get_field('certificate_title'))) ? get_field('certificate_title') : 'Please follow the step below to instantly get your <span>IQ Score, Personal IQ Certificate</span> and <span>IQG Certified Performance Report.</span>'; ?></h3>

        <table class="table table-responsive" id="order_details">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th><img src="https://www.iqtestglobal.org/wp-content/uploads/2025/01/cart.png" alt="demo"></th>
                    <th colspan="2"><?= (!empty(get_field('order_title'))) ? get_field('order_title') : 'ORDER DETAILS'; ?></th>
                </tr>
            </thead>
            <!-- Product List -->
            <tbody>
                <!-- Product 1: IQ Score -->
                <?php
                $prodt = get_field('product_item');
                $i = 0;
                if(!empty($prodt)){
                    foreach($prodt as $prodt_item){
                        $i++;
                ?>
                <tr>
                    <td><span class="tr-no"><?= $i; ?></span></td>
                    <td style="position: relative;">
            <img src="<?= (!empty($prodt_item['product_image'])) ? $prodt_item['product_image'] : 'http://165.22.214.126/wp-content/uploads/2025/01/Untitled-design-3.png'; ?>" alt="png">
            <?php if ($i === 3) : ?>
                <a class="second-text-aryan"></a>
            <?php endif; ?>
        </td>
                    <td><?= (!empty($prodt_item['product_title'])) ? $prodt_item['product_title'] : '<span>IQ Score Evaluation</span> Get your final, accurate IQ score'; ?></td>
                </tr>
                <?php } } ?>

            </tbody>
        </table>

        <table class="het-border">
            <tbody>
                <tr>
                    <th style="width:80%">
                        <span><?= (!empty(get_field('order_total'))) ? get_field('order_total') : 'Total:'; ?></span>
                    </th>
                    <th style="width:20%">
                    	<span class="total-price"><?= wc_price($regular_price_total); ?></span>
                    </th>
                </tr>
                <tr>
                	<th style="width:80%">
                		⌛<?= (!empty(get_field('discounted_price'))) ? get_field('discounted_price') : 'Discounted Price Valid only for next'; ?>  <span id="time-span" class="fw-semibold"></span>
                	</th>
                    <th style="width:20%">
                    	<span class="sale-price"><?= wc_price($sale_price_total); ?></span>
                    </th>
                </tr>
            <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/easytimer.min.js"></script>
            <script type="text/javascript">
            (function(){
                var timer = new easytimer.Timer();
                var time_span_el = document.getElementById('time-span');
                timer.start({countdown: true, startValues: {seconds:<?php echo ($discount_time + 0) - (time() - $_SESSION['quiz_curr_time']) ; ?>}});
                timer.addEventListener('secondsUpdated', function (e) {
                    var seconds = timer.getTimeValues().seconds;
                    seconds = seconds.toString().length < 2 ? ('0' + seconds) : seconds;
                    time_span_el.textContent = timer.getTimeValues().minutes + ':' + seconds;
                });
                timer.addEventListener('targetAchieved', function () {
                    window.location.href = window.location.href;
                });
            })();

             jQuery(document).ready(function ($) {
                // After 5 seconds, hide the first section and show the second section
                setTimeout(function () {
                  $('.first_sec').hide();
                  $('.second_sec').show();
                }, 7000); // 5000 milliseconds = 5 seconds
              });
            </script>
            </tbody>
        </table>

        <div class="iq-button">
            <img src="<?= (!empty(get_field('payment_image'))) ? get_field('payment_image') : 'https://www.iqtestglobal.org/wp-content/uploads/2025/01/Untitled-design-15.png'; ?>" alt="png">
            <div class="asp_product_buy_btn_container">
                <?php  echo do_shortcode( '[woocommerce_checkout]' ); ?>
            </div>
        </div>


    </div>
</section>

<section class="uni-logos-sec">
    <div class="container">
        <h3><?= (!empty(get_field('trusted_title'))) ? get_field('trusted_title') : 'Trusted by Over 1M+ people from leading Universities Globally'; ?></h3>
        <div class="uni-logos swiper mySwiper">
        	<div class="swiper-wrapper">
		        <?php
		        $trusted = get_field('trusted');
		        if(!empty($trusted)){
		            foreach($trusted as $trust_item){
		        ?>
		            <div class="swiper-slide uni-logo">
		                <img src="<?= (!empty($trust_item['trusted_image'])) ? $trust_item['trusted_image'] : 'https://www.iqtestglobal.org/wp-content/uploads/2025/01/HARVARD-UNIVERSITY.png'; ?>">
		            </div>
		        <?php } } ?>
		    </div>
		    <div class="swiper-button-next"></div>
    		<div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<section class="alert-sec">
    <div class="container">
        <div class="elementor-alert" role="alert">
            <h5><?= (!empty(get_field('important_title'))) ? get_field('important_title') : 'Important Heads Up !!!'; ?></h5>
            <p><?= (!empty(get_field('important_content'))) ? get_field('important_content') : 'With an IQG™ IQ Certificate, your test results are accepted at universities worldwide and can help you secure your dream job, which makes your resume stand out. It is a simple yet powerful step towards a brighter future!'; ?></p>
            <button type="button" class="alert-dismiss" aria-label="Dismiss this alert.">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
</section>

<section class="say-about-sec">
    <div class="container">
        <h3 class="line-title"><span><?= (!empty(get_field('what_they_say'))) ? get_field('what_they_say') : 'What They Say About Us'; ?></span></h3>
        <div class="review-icon">
            <img src="https://www.iqtestglobal.org/wp-content/uploads/2025/01/stars-5.svg">
        </div>
        <div class="review-text">
        <?= (!empty(get_field('what_they'))) ? get_field('what_they') : 'Our Customer say <strong>Excellent</strong> <img src="https://www.iqtestglobal.org/wp-content/uploads/2025/01/stars-5.svg"> 4.8 out of 5 based on <strong>reviews</strong>'; ?>

        </div>
    </div>
</section>
<section>
<div class="container">
<?php echo do_shortcode('[sp_testimonial id="2415"]'); ?>
</div>
</section>
</section>
<section class="order-recived order-done time-box-sec">
    <div class="container">
        <div class="time-box">
            <h3>Congratulations! Your report has been successfully sent to your email.</h3>
        </div>
        <?php  echo do_shortcode( '[woocommerce_checkout]' ); ?>
    </div>
</section>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script type="text/javascript">
	jQuery(".alert-dismiss").click(function(){
    	jQuery(".alert-sec").hide();
    });

    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 20,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        767: {
          slidesPerView: 4,
          spaceBetween: 30,
        }
      },
    });
    document.addEventListener("DOMContentLoaded", function(){
        // Retrieve values from localStorage
        var userInfo = localStorage.getItem('userInfo');
        if(userInfo){
            try {
                userInfo = JSON.parse(userInfo);
                const today = new Date();
                const day = String(today.getDate()).padStart(2, '0');
                const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = today.getFullYear();
                const formattedDate = `${day}-${month}-${year}`;
                // Update user name in multiple places
                if(userInfo.firstName && userInfo.lastName){
                    var fullName = userInfo.firstName + " " + userInfo.lastName;
                    var formattedTime = userInfo.formattedTime || "02m:03s";
                    var speedPercentage = userInfo.speedPercentage|| "95";
                    // Update elements with class "use-name"
                    document.querySelectorAll('.use-name').forEach(function(el){
                        el.textContent = fullName;
                    });
                    // Update certificate name and today-date if available
                    document.querySelectorAll('.student-name').forEach(function(el){
                        el.textContent = fullName;
                    });
                    document.querySelectorAll('.second-text-aryan').forEach(function(el){
                        el.textContent = fullName;
                    });
                    document.querySelectorAll('.today-date').forEach(function(el){
                        el.textContent = formattedDate;
                    });
            
                    document.getElementById('formattedTime').textContent = formattedTime;
                    document.getElementById('speedPercentage').textContent = speedPercentage + "%";
                }
            } catch(e){}
        }
        // Update formatted time & speed percentage in the header

        
        // Directly show the content immediately:
        document.getElementById('primary').style.display = 'block';
    });
</script>

<?php

get_footer();
?>
