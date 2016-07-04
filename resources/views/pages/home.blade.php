@extends('layouts.app')

@section('content')  
<section class="banner">
    <h2>Your Business. Our Reach.</h2>
    <h3>Let us take the strain away by handling your logistics and warehousing<br> allowing you to focus on your business development.</h3>
    <ul class="actions">
        <li></li>
    </ul>
</section>
<!-- One -->
<section id="one" class="wrapper spotlight">
    <div class="content">
        <div class="inner">
            <h2>Because every business is different</h2>
            <p>At Depot Dash we understand every business is different, so if you are after a specific requirement then let us know and we'll provide a tailor-made solution just for you!</p>
            <ul class="actions">
                <li><a href="contact.php" class="button">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <ul class="grid-icons">
        <li>
            <div class="inner">
                <span class="icon fa-line-chart major"></span>
                <h3>Start-Ups to <br>Supply Chains</h3>
            </div>
        </li>
        <li>
            <div class="inner">
                <span class="icon fa-truck major"></span>
                <h3>Courier Pick Up <br> &amp; Drop Off</h3>
            </div>
        </li>
        <li>
            <div class="inner">
                <span class="icon fa-shopping-bag major"></span>
                <h3>e-Commerce storage<br> &amp; Fulfillment</h3>
            </div>
        </li>
        <li>
            <div class="inner">
                <span class="icon fa-check major"></span>
                <h3>Fully Secured &amp; <br> Automated Services</h3>
            </div>
        </li>
    </ul>
</section>
<!-- Two -->
<section id="two" class="wrapper style1 spotlight alt">
    <div class="content">
        <div class="inner">
            <h2>Logistics and Transport </h2>
            <p>Depot Dash has evolved over the last decade from a small transport company to an integrated supply chain solutions provider for a comprehensive range of companies. We offer tailored logistics solutions to suit your requirements.</p>
            <ul class="actions">
                <li><a href="warehouse-storage-and-logistics.php" class="button">Learn More</a></li>
            </ul>
        </div>
    </div>
    <div class="image">
        <img src="{{asset('img/depotdash_images/banner-bx-logistics.jpg')}}" data-position="30% 30%" alt="" />
    </div>
</section>
<!-- Three -->
<section id="three" class="wrapper style2 spotlight">
    <div class="content">
        <div class="inner">
            <h2>Warehousing and Storage</h2>
            <p>Our warehousing facility occupies over 40,000 sq ft and features full size floor to ceiling racking systems. Storage is available as a stand alone service, or can easily be combined with transport, distribution and order fulfilment. </p>
            <ul class="actions">
                <li><a href="warehouse-storage-and-logistics.php" class="button">Learn More</a></li>
            </ul>
        </div>
    </div>
    <div class="image" style="background-image: url(&quot;{{asset('img/depotdash_images/banner-bx-warehouse.jpg')}}&quot;); background-position: right center;">
        <img src="images/banner-bx-warehouse.jpg" data-position="center right" alt="" style="display: none;">
    </div>
</section>
<!-- Four -->
<section id="four" class="wrapper style3 spotlight alt">
    <div class="content">
        <div class="inner">
            <h2>Fulfillment & Courier Drop off</h2>
            <p>We make sending parcels quick & easy. It's an online shipping management solution with services to suit. Depot Dash offer multi user flexibility providing customers with efficient and cost effective services, From sending a couple of parcels, to streamlining your business shipping processes; we will give you the flexibility your business needs. </p>
            <ul class="actions">
                <li><a href="fulfillment-services-for-ecommerce.php" class="button">Learn More</a></li>
            </ul>
        </div>
    </div>
    <div class="image">
        <img src="{{asset('img/depotdash_images/banner-bx-fulfillment.jpg')}}" data-position="top right" alt="" />
    </div>
</section>
<!-- Five -->
<section id="five" class="wrapper special">
    <h2>Determining Factors When Choosing a New Warehouse</h2>
    <p>As the orders begin to increase, an e-commerce business will find that additional warehouse storage will be required to ensure that stock is readily available to contend with the ongoing orders.</p>
    <ul class="actions">
        <li><a href="blog-determining-factors-when-choosing-warehouse-storage.php" class="button">Blog Special - Read More!</a></li>
    </ul>
    <hr>
    <iframe src="https://player.vimeo.com/video/162889845?color=ffffff" width="100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <hr>
    <h2>Looking for a serviced requirement?</h2>
    <p>We can tailor our services to suit your business needs no matter the size of your business. <br>Just contact us below to arrange a hassle-free consultation.</p>
</section>
@endsection

@section('scripts')

@endsection