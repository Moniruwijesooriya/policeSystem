<!DOCTYPE html>
<html>
<title>Crime Reporting System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    body, html {
        height: 100%;
        line-height: 1.8;
    }
    /* Full height image header */
    .bgimg-1 {
        background-position: center;
        background-size: cover;
        opacity:7.5;
        filter:brightness(40%);
        filter:contrast(100%);
        filter:saturate(1);
        animation: animate_bg 10s;
        animation-iteration-count: infinite;
        min-height: 100%;
    } 

    .wrap-login100 {
        width: auto;
        min-width: 20%;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        margin: 0px 35px 0px 35px;
        padding: 77px 55px 33px 55px;
        padding-left: 50px;
        opacity: 0.7;

        box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    }

    .btn-width{
        width:140px;
        opacity: 1;
    }

    @keyframes animate_bg {
        0%   {background-image: url("/img/police2.jpg");}
        50%  {background-image: url("/img/gallery2.jpg");}
        100% {background-image: url("/img/police4.jpg");}
    }

    .w3-bar .w3-button {
        padding: 16px;
    }
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide">SRI LANKAN POLICE</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
            <a href="#entries" class="w3-bar-item w3-button"><i class="fa fa-window-restore"></i>ENTRIES</a>
            <a href="#gallery" class="w3-bar-item w3-button"><i class="fa fa-th"></i>GALLERY</a>
            <a href="#ranking" class="w3-bar-item w3-button"><i class="fa fa-reorder"></i> RANKING</a>
            <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
    <a href="#entries" onclick="w3_close()" class="w3-bar-item w3-button">ENTRIES</a>
    <a href="#gallery" onclick="w3_close()" class="w3-bar-item w3-button">GALLERY</a>
    <a href="#ranking" onclick="w3_close()" class="w3-bar-item w3-button">RANKING</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container" id="home">
        <div class="container wrap-login100 w3-display-left w3-light-grey m3" style="padding:48px">
            <span class="w3-jumbo w3-hide-small" style="line-height: 60px">Crime Reporting System</span><br>
            <span class="w3-xxlarge w3-hide-large w3-hide-medium">Crime Reporting System</span><br>
            <span class="w3-large">24/7 POLICE SYSTEM</span>
            <p><a href="{{ route('register') }}" class="btn-width w3-button w3-grey w3-padding-large w3-large w3-margin-top">REGISTER</a></p>
            <p><a href="{{ route('login') }}" class="btn-width w3-button w3-grey w3-padding-large w3-large w3-margin-top">LOGIN</a></p>
        </div> 
    <div>
            <a href="#about" class="w3-button w3-light-grey w3-display-bottommiddle"><i class="fa fa-arrow-down w3-margin-right"></i>About</a>
    </div>
</header>

<!-- About Section -->
<div class="w3-display-container" style="padding:128px 16px" id="about">
    <h3 class="w3-center">ABOUT THE SYSTEM</h3>
    <p class="w3-center w3-large">Features of System</p>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-quarter">
            <i class="fa fa-user w3-margin-bottom w3-jumbo w3-center"></i>
            <p class="w3-large">LOGIN</p>
            <p>A registered user can login to the system.You can login as citizen or police officer.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-address-book-o w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">REGISTRATION</p>
            <p>If you want to register as a citizen please contact the nearest police station.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-book w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">ENTRY</p>
            <p>If you are a registered citizen you can submit your entry and evidences.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-tags w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">EVIDENCE</p>
            <p>If you have any evidences related to the entry you can submit that.</p>
        </div>
    </div>
</div>

<!-- Promo Section -  -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Crime Reporting System</h3>
            <p>This website has been created to help the citizens and people residing in Sri Lanka with regards to police related activity.This is a online crime reporting system by Sri Lankan police deparment.This is discrease the crime rate of the country.</p>

        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="/img/police1.jpg" alt="Buildings" width="700" height="394">
        </div>
    </div>
</div>

<!-- ENTRIES Section -->
<div class="w3-container" style="padding:128px 16px" id="entries">
    <h3 class="w3-center">ENTRIES</h3>
    <p class="w3-center w3-large">If you have any evidences about this crimes you can submit that.</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="/img/roberry.jpg" alt="John" style="width:100%;height:60%">
                <div class="w3-container">
                    <h3>Roberry in a Shop</h3>
                    <p class="w3-opacity">Colombo 6 , 3rd September 2018</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-tags"></i> Submit Evidences</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="/img/murder.jpg" alt="Jane" style="width:100%;height:40%">
                <div class="w3-container">
                    <h3>Murder in Road</h3>
                    <p class="w3-opacity">Galle , 21st June 2018</p>
                    <p class="w3-opacity"></p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-tags"></i> Submit Evidences</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="/img/missing.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Missing</h3>
                    <p class="w3-opacity">Jaffna , 21st July 2018</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-tags"></i> Submit Evidences</button></p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="/img/chainsnapping.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Chain Snapping</h3>
                    <p class="w3-opacity">Jaffna, 1st September 2018</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-tags"></i> Submit Evidences</button></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promo Section  -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">

</div>

<!-- GALLERY Section -->
<div class="w3-container" style="padding:128px 16px" id="gallery">
    <h3 class="w3-center">GALLERY</h3>
    <p class="w3-center w3-large">What we've done for people</p>

    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-col l3 m6">
            <img src="/img/gallery1.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" >
        </div>
        <div class="w3-col l3 m6">
            <img src="/img/gallery2.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" >
        </div>
        <div class="w3-col l3 m6">
            <img src="/img/gallery3.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" >
        </div>
        <div class="w3-col l3 m6">
            <img src="/img/gallery4.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" >
        </div>
    </div>


</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <img id="img01" class="w3-image">
        <p id="caption" class="w3-opacity w3-large"></p>
    </div>
</div>

<!-- CRIME RATE Section -->
<div class="w3-container w3-light-grey w3-padding-64">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Crime Rates</h3>
            <p>Now a days rate of crime is too high</p>
            <p>This  is the crime rate percentage<br>
                of some crime catogaries</p>
        </div>
        <div class="w3-col m6">
            <p class="w3-wide"><i class=" w3-margin-right"></i>Robbery</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:90%">90%</div>
            </div>
            <p class="w3-wide"><i class=" w3-margin-right"></i>Chain Snapping</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:85%">85%</div>
            </div>
            <p class="w3-wide"><i class="w3-margin-right"></i>Small Crimes</p>
            <div class="w3-grey">
                <div class="w3-container w3-dark-grey w3-center" style="width:75%">75%</div>
            </div>
        </div>
    </div>
</div>

<!-- RANKING Section -->
<div class="w3-container w3-center w3-dark-grey" style="padding:128px 16px" id="ranking">
    <h3>RANKING</h3>
    <p class="w3-large">Police Station Ranking</p>
    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-third w3-section">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-black w3-xlarge w3-padding-32">Jaffna</li>
                <li class="w3-padding-16"><b></b> Best Officers</li>
                <li class="w3-padding-16"><b></b> Low crime rate</li>
                <li class="w3-padding-16"><b></b> Good public response</li>
                <li class="w3-padding-16"><b></b> Quick actions</li>

                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large"> View</button>
                </li>
            </ul>
        </div>
        <div class="w3-third">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-red w3-xlarge w3-padding-48">Colombo</li>
                <li class="w3-padding-16"><b></b> Best Officers</li>
                <li class="w3-padding-16"><b></b> Low crime rate</li>
                <li class="w3-padding-16"><b></b> Quick actions</li>
                <li class="w3-padding-16"><b></b> Best traffic police </li>

                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large">View </button>
                </li>
            </ul>
        </div>
        <div class="w3-third w3-section">
            <ul class="w3-ul w3-white w3-hover-shadow">
                <li class="w3-black w3-xlarge w3-padding-32">Galle</li>
                <li class="w3-padding-16"><b></b> Best Officers </li>
                <li class="w3-padding-16"><b></b> Quick actions</li>
                <li class="w3-padding-16"><b></b> Good feedback </li>
                <li class="w3-padding-16"><b></b> Low crime rate</li>

                <li class="w3-light-grey w3-padding-24">
                    <button class="w3-button w3-black w3-padding-large">View </button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
    <h3 class="w3-center">CONTACT</h3>
    <p class="w3-center w3-large">Send your feedback as message</p>
    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-half">
            <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i>Colombo, Sri Lanka</p>
            <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: +011 1212302</p>
            <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: slpolice@gmil.com</p>
            <br>
            <form action="/action_page.php" target="_blank">
                <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="Subject"></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
                <p>
                    <button class="w3-button w3-black" type="submit">
                        <i class="fa fa-paper-plane"></i> SEND MESSAGE
                    </button>
                </p>
            </form>
        </div>
        <div class="w3-half">
            <!-- Add Google Maps -->
            <div id="googleMap" class="w3-greyscale-max" style="width:100%;height:510px;"></div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>

    <p>Powered by <a href="#home" title="W3.CSS"  class="w3-hover-text-green">SRILANKAN POLICE</a></p>
</footer>

<!-- Add Google Maps -->
<script>
    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }
    // Toggle between showing and hiding the sidebar when clicking the menu icon
    var mySidebar = document.getElementById("mySidebar");
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
        } else {
            mySidebar.style.display = 'block';
        }
    }
    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
