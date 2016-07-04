<header class="new-header">
    <img src="{{asset('img/logo-depotdash.png')}}" alt="Depot Dash">
    <nav id="nav">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="warehouse-storage-and-logistics.php">Warehouse &amp; Logistics</a>
            </li>
            <li><a href="fulfillment-services-for-ecommerce.php">Fulfillment Services</a></li>
            <li><a href="import-export.php">Import Export</a></li>
            <li><a href="courier-services.php">Courier Services</a></li>
            <li><a href="contact.php">Contact</a></li>    
            @if(Auth::user())
            <li><a href="/home">My Account</a></li>  
            <li><a href="/logout">Logout</a></li>  
            @else
            <li><a href="/register">Sign Up</a></li>
            <li><a href="/login">Log In</a></li>
            @endif
        </ul>
    </nav>
    <div class="contact">
        <h3>0333 332 7058</h3>
        <h4><a href="mailto:info@depotdash.com">info@depotdash.com</a></h4>
    </div>
</header>