<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tour and Travel </title>

<?php include("header.php"); ?>


<div id="carouselExampleCaptions" class="carousel slide home-slider" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/banner-img.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-md-block">
        <h1 class="banner-hding text-white">Your Journey, Your Way</h1>
        <p class="banner-prgh text-white">Flexible flight options for every traveler—whether it’s a quick getaway or a long adventure.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/banner-img2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-md-block">
        <h1 class="banner-hding text-white">Fly More, Pay Less</h1>
        <p class="banner-prgh text-white">Discover unbeatable airfares to top destinations. Book your next trip at the best price today!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/about-us.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="banner-hding text-white">Seamless Flight Booking</h1>
        <p class="banner-prgh text-white">Fast, secure, and hassle-free bookings with instant confirmation at your fingertips.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Start Flight Search Form -->
<section class="container">
  <div class="row">
    <div class="col-md-12">
        <form id="flightForm" class="flight-searc-box transparent-bg" action="flight-search.php"  method="GET">
          <div class="row">
            <div class="col-sm-12 mb-3">
              <!-- Trip Type -->
              <div class="form-group">
                  <label><input type="radio" class="choose-trip-type" name="tripType" value="oneway" checked> One Way</label>
                  <label><input type="radio" class="choose-trip-type" name="tripType" value="roundtrip"> Round Trip</label>
              </div>    
            </div>
            <div class="col-sm-12">
              <div class="flight-field-bg">
                <div class="row">
                  <div class="col-md">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 pe-md-0">
                        <div class="form-group" id="citySection">
                          <label class="filter-lbl">Leaving From</label>
                          <input type="text" class="filter-field from_oneway1 field-right-radius-0" id="fromAirport" placeholder="From" required>
                          <!-- <input type="hidden" id="fromAirportCode" name="origin_code"> -->
                          <input type="hidden" id="fromAirportCode" name="origin" value="">    <!-- IATA Code -->
                           <input type="hidden" id="fromAirportName" name="origin_name" value="">   <!-- Full Name -->
                        </div> 
                      </div>
                      <div class="col-sm-6 col-md-6 px-md-0">
                        <div class="form-group" id="citySection">
                          <label class="filter-lbl">Going To</label>
                          <input type="text" class="filter-field to_oneway1 field-radius-0" id="toAirport" placeholder="To" required>
                          <!-- <input type="hidden" id="toAirportCode" name="destination_code"> -->
                          <input type="hidden" id="toAirportCode" name="destination" value=""> <!-- IATA Code -->
                          <input type="hidden" id="toAirportName" name="destination_name" value> <!-- Full Name -->
                        </div>
                      </div>    
                    </div>
                  </div>
                  
                  <div class="col-sm-6 col-md-2 px-md-0">
                    <div class="form-group">
                       <label class="filter-lbl">Departure Date</label>
                        <input type="text" class="filter-field field-radius-0" id="departDate" name="departure_date" placeholder="Select date" required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-2 px-md-0">
                    <div class="form-group">   
                        <label class="filter-lbl">Return Date</label> 
                        <input type="text" class="filter-field field-radius-0" name="return_date" id="returnDate" placeholder="Select date">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-auto px-md-0">
                    <div class="form-group">
                      <label class="filter-lbl">Passenger & Class</label>
                      <div class="filter-field field-left-radius-0" id="passengerClassDisplay">1 Adult - Economy</div>
                      <input type="hidden" name="passenger" id="passenger" value="1 Adult - Economy"> 

                      <div class="dropdown-panel" id="passengerDropdown">
                        <!-- Passenger Counters -->
                        <div class="traveller-row">
                            <input type="hidden" name="adults" id="adults" value="1">
                            <span>Adults <span>(12y +)</span></span>
                            <div>
                                <button type="button" class="count-btn" onclick="changeCount('adult', -1)">-</button>
                                <span class="passenger-count-output" id="adultCount">1</span>
                                <button type="button" class="count-btn" onclick="changeCount('adult', 1)">+</button>
                            </div>
                        </div>
                        <div class="traveller-row">
                            <input type="hidden" name="children" id="children" value="0">
                            <span>Children <span>(2y - 12y)</span></span>
                            <div>
                                <button type="button" class="count-btn" onclick="changeCount('child', -1)">-</button>
                                <span class="passenger-count-output" id="childCount">0</span>
                                <button type="button" class="count-btn" onclick="changeCount('child', 1)">+</button>
                            </div>
                        </div>
                        <div class="traveller-row">
                            <input type="hidden" name="infants" id="infants" value="0">
                            <span>Infants <span>(Below 2y)</span></span>
                            <div>
                                <button type="button" class="count-btn" onclick="changeCount('infant', -1)">-</button>
                                <span class="passenger-count-output" id="infantCount">0</span>
                                <button type="button" class="count-btn" onclick="changeCount('infant', 1)">+</button>
                            </div>
                        </div>

                        <!-- Class Selection -->
                        <div class="form-group mt-3">
                            <label class="travel-class-lbl">Choose Travel Class</label>
                            <select class="form-control" id="travelClass">
                                <option value="Economy">Economy</option>
                                <option value="Business">Business</option>
                                <option value="First">First Class</option>
                            </select>
                            <input type="hidden" name="travel_class" id="cabin_class" value="ECONOMY">
                        </div>

                        <!-- Confirm Button -->
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-primary btn-sm" onclick="confirmPassengers()">Confirm</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-auto">
                    <div class="d-flex justify-content-md-center pe-md-3">
                      <button type="submit" name="submit" class="wrap-btn_web1 mx-auto mx-md-0 d-table"><i class="fa-solid fa-magnifying-glass"></i> Search Flights</button>
                    </div>  
                  </div>
                </div>
              </div>
            </div>  
          </div>
          

          
        </form>

        <script>
            tripTypeRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'roundtrip') {
                        returnDateInput.readOnly = false; 
                    } else {
                        returnDateInput.readOnly = true;  
                        returnDateInput.value = '';       
                    }
                });
            });

            // Initial state
            if (document.querySelector('input[name="tripType"]:checked').value !== 'roundtrip') {
                returnDateInput.readOnly = true;
            }
            
        </script>
    </div>
  </div>
</section>
<!-- End Flight Search Form -->

<section class="bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5">
        <p class="wrap-title_web1">Best Place Near at you</p>
        <h2 class="wrap-hding_web1">Explore Top Destinations</h2>
      </div>
      <div class="owl-carousel owl-theme" id="top-destination">
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/new-york-city.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">New York City</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/australia.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Australia</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/spain.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Spain City</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/london.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">London</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/dubai.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Dubai</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/malaysia.webp" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Malaysia</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/bangkok.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Bangkok</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/china.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">China</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/phuket.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Phuket</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/paris.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Paris</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/roma.jpg" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">Roma</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="destination-bg_web1">
            <div class="destination-img_web1">
              <img src="images/singapore.webp" alt="">
              <div class="destination-textarea_web1">
                <div>
                  <h3 class="destination-hding_web1">singapore</h3>
                </div>  
              </div>
            </div>
          </div> 
        </div>
      </div>  
    </div>
  </div>  
</section>

<section class="container pb-5">
  <div class="row">
    <div class="col-md-6">
      <img src="images/flight-travel.jpg" alt="" class="img-fluid img-radius mb-4">
    </div>
    <div class="col-md-6">
      <div class="position-relative pb-5">
        <p class="wrap-title_web1">Adventure Destination</p>
        <h2 class="wrap-hding_web1 pb-2">A Great Opportunity Awaits for Adventure & Travel</h2>
        <p class="wrap-prgh_web1">Turn your travel dreams into reality with exclusive deals designed for every explorer. Whether you’re seeking breathtaking landscapes, vibrant city life, or relaxing getaways, this is the perfect time to plan your journey. With limited-time offers and unbeatable discounts, your next adventure is just a booking away. Pack your bags and get ready to create memories that last a lifetime!  </p>
        <a href="tel:<?php echo $phone_web; ?>" class="wrap-btn_web1 mt-4 mb-5">Book Now</a>
        <img src="images/shape.png" alt="" class="w-50 shape-1">
      </div>  
    </div>
  </div>
</section>

<section class="pb-5 py-md-5">
  <div class="container ">
    <div class="row">
      <div class="col-sm-12 position-relative">
        <img src="images/right-shape.png" alt="" class="offer-shape img-fluid">
        <div class="offer-bg">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="offer-textarea">
                <h1 class="wrap-hding_web1">
                  Grab Up to <span>45% off</span>  Flights & Holidays
                </h1>
                <p class="wrap-prgh_web1 text-white pt-3">Don’t wait—book now and get exclusive offers on top travel spots worldwide. Turn your travel dreams into reality with limited-time discounts when you book today.</p>
                <a href="tel:<?php echo $phone_web; ?>" class="wrap-btn_web1 mt-4">Book Now</a>
              </div>  
            </div>
            <div class="col-md-6">
              <div class="position-relative">
                <img src="images/offer-img.jpg" alt="" class="offer-img">
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container py-5">
  <div class="row">
    <div class="col-sm-12">
      <p class="wrap-title_web1 mx-auto d-table">Our Process</p>
      <h2 class="wrap-hding_web1 text-center">See how we work step by step</h2>
    </div>
  </div>
  <div class="row justify-content-center pt-5">
      
      <div class="col-md-4">
        <div class="hiw-box-area_web1">
          <div class="hiw-first_arrow_web1">
            <img src="images/arrow-down.png">
          </div>
          <div class="hiw-circle_web1 aos-init aos-animate" data-aos="flip-left">
            <img src="images/search-airplane.png">
            <!-- <span class="hiw-circle_web1-step">01</span> -->
          </div>
          <h3 class="wrap-subhding_web1 text-center pb-2">Search Flight</h3>
          <p class="wrap-prgh_web1 text-center">Our engine checks airlines and travel partners instantly to find live seats, fares, and the best options.</p>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="hiw-box-area_web1 px-md-5">
          <div class="hiw-sec_arrow_web1">
            <img src="images/arrow-up.png">
          </div>
          <div class="hiw-circle_web1 aos-init aos-animate" data-aos="flip-left">
            <img src="images/booking.png">
            <!-- <span class="hiw-circle_web1-step">02</span> -->
          </div>
          <h3 class="wrap-subhding_web1 text-center pb-2">Add Traveller Details</h3>
          <p class="wrap-prgh_web1 text-center">Review flight details, connections, aircraft info, and fare conditions before you choose. Fill in passenger info exactly as on the ID/passport.</p>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="hiw-box-area_web1">
          <div class="hiw-circle_web1">
            <img src="images/ticket-flight.png">
            <!-- <span class="hiw-circle_web1-step">03</span> -->
          </div>
          <h3 class="wrap-subhding_web1 text-center pb-2">Make Payment Instant E-Ticket</h3>
          <p class="wrap-prgh_web1 text-center">Pay safely with your preferred method. Receive your PNR and e-ticket via email/SMS.</p>
        </div>  
      </div>
    </div>
</section>

<!-- static Flight Offers -->

<section class="bg-light py-5 mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12 pb-5">
        <p class="wrap-title_web1 mx-auto d-table">Flight Discount Offers</p>
        <h2 class="wrap-hding_web1 text-center">✈️ Exclusive Deals on Popular Routes ✈️</h2>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">20% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">DEL</h4>
              <p class="disc_flight_route_name">New Delhi</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">DXB</h4>
              <p class="disc_flight_route_name">Dubai</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Oct 20, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Nov 30, 2025</p>
          </div>
          <img src="images/airline-logo/flt-2.webp" alt="" class="disc_flight_logo">
        </div>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">25% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">NYC</h4>
              <p class="disc_flight_route_name">New York</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">SYD</h4>
              <p class="disc_flight_route_name">Sydney</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Nov 1, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Nov 30, 2025</p>
          </div>
          <img src="images/airline-logo/flt-3.png" alt="" class="disc_flight_logo">
        </div>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">25% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">LAX</h4>
              <p class="disc_flight_route_name">Los Angeles</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">KCH</h4>
              <p class="disc_flight_route_name">Kuching</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Oct 11, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Dec 15, 2025</p>
          </div>
          <img src="images/airline-logo/flt-1.webp" alt="" class="disc_flight_logo">
        </div>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">28% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">DXB</h4>
              <p class="disc_flight_route_name">Dubai</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">NYC</h4>
              <p class="disc_flight_route_name">New York</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Nov 1, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Dec 31, 2025</p>
          </div>
          <img src="images/airline-logo/flt-4.webp" alt="" class="disc_flight_logo">
        </div>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">30% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">MOW</h4>
              <p class="disc_flight_route_name">Moscow</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">NYC</h4>
              <p class="disc_flight_route_name">New York</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Oct 15, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Dec 14, 2025</p>
          </div>
          <img src="images/airline-logo/flt-5.png" alt="" class="disc_flight_logo">
        </div>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl bg-info">20% Discount</p>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="disc_flight_route">LON</h4>
              <p class="disc_flight_route_name">London</p>
            </div>
            <img src="images/airplane.png" class="disc_route_img">
            <div>
              <h4 class="disc_flight_route">PAR</h4>
              <p class="disc_flight_route_name">Paris</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <p class="wrap-prgh_web1 mb-0 pb-0">Oct 15, 2025</p>
            <p class="wrap-prgh_web1 mb-0 pb-0 ps-3"><i class="fa-solid fa-arrow-right-long"></i></p>
            <p class="wrap-prgh_web1 mb-0 pb-0">Dec 14, 2025</p>
          </div>
          <img src="images/airline-logo/flt-6.png" alt="" class="disc_flight_logo">
        </div>
      </div>
    </div>
  </div>
</section> 


<!-- <section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 pb-5">
        <p class="wrap-title_web1 mx-auto d-table">Flight Price</p>
        <h2 class="wrap-hding_web1 text-center">✈️ Unbeatable Prices on Favorite Routes ✈️</h2>
      </div>
    </div>
    <div class="row" id="flight-offer-cards-container">  
     
    </div>
  </div>
</section> -->

<section class="testimonial-bg_web1 py-5 mb-md-4">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="">
          <h2 class="wrap-hding_web1 text-center pb-4">Customer Reviews</h2>
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="owl-carousel" id="testimonial_carousel">
                <div class="item" data-dot="<img src='images/testimonial-img-1.jpg'>">
                  <div class="testimonial-textarea_web1">
                    <div class="d-flex gap-3">
                      <img src="images/quote.png" alt="" class="quote-img_web1">
                      <p class="wrap-prgh_web1 text-center">
                        I had an amazing experience with this company. The service was top-notch, and the staff was incredibly friendly. I highly recommend them!
                      </p>
                      <img src="images/quote2.png" alt="" class="quote-img_web1">
                    </div>  
                    <h5 class="wrap-subhding_web1 text-center pb-1 pt-4">Emily Johnson</h5>
                    <p class="wrap-prgh_web1 text-center">New York, NY</p>
                  </div>
                </div>
                <div class="item" data-dot="<img src='images/testimonial-img-2.jpg'>">
                  <div class="testimonial-textarea_web1">
                    <div class="d-flex gap-3">
                      <img src="images/quote.png" alt="" class="quote-img_web1">
                      <p class="wrap-prgh_web1 text-center">
                        From flights to hotels to local tours — everything was seamless. Their customer support was quick and helpful throughout my Hawaii vacation. Will definitely book again!
                      </p>
                      <img src="images/quote2.png" alt="" class="quote-img_web1">
                    </div>  
                    <h5 class="wrap-subhding_web1 text-center pb-1 pt-4">Michael Andersonn</h5>
                    <p class="wrap-prgh_web1 text-center">Austin, TX</p>
                  </div>
                </div>
                <div class="item" data-dot="<img src='images/testimonial-img-3.jpg'>">
                  <div class="testimonial-textarea_web1">
                    <div class="d-flex gap-3">
                      <img src="images/quote.png" alt="" class="quote-img_web1">
                      <p class="wrap-prgh_web1 text-center">
                        I booked a surprise getaway for my anniversary, and it turned out better than I imagined. The suggestions and packages were spot on. Thank you for making it so easy!
                      </p>
                      <img src="images/quote2.png" alt="" class="quote-img_web1">
                    </div>  
                    <h5 class="wrap-subhding_web1 text-center pb-1 pt-4">Jessica Lee</h5>
                    <p class="wrap-prgh_web1 text-center">San Francisco, CA</p>
                  </div>
                </div>
                <div class="item" data-dot="<img src='images/testimonial-img-4.jpg'>">
                  <div class="testimonial-textarea_web1">
                    <div class="d-flex gap-3">
                      <img src="images/quote.png" alt="" class="quote-img_web1">
                      <p class="wrap-prgh_web1 text-center">
                        I travel often for both work and leisure, and this site has become my go-to. The interface is simple, and the prices are always competitive. A+ service!
                      </p>
                      <img src="images/quote2.png" alt="" class="quote-img_web1">
                    </div>  
                    <h5 class="wrap-subhding_web1 text-center pb-1 pt-4">David Martinez</h5>
                    <p class="wrap-prgh_web1 text-center">Chicago, IL</p>
                  </div>
                </div>
              </div>  
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="wrap-hding_web1 text-center pb-5">Frequently Asked Questions (FAQs)</h2>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                How can I book a flight ticket online?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">You can search for flights by entering your departure city, destination, travel dates, and passenger details. Once you select a suitable flight, proceed to payment to confirm your booking.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Can I book one-way, round-trip, and multi-city flights?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Yes, our system allows booking for one-way, round-trip, and multi-city itineraries depending on your travel needs.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                How do I know my flight booking is confirmed?
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">After successful payment, you will receive a confirmation email and e-ticket with your booking reference number (PNR).</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                What payment methods are accepted?
              </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">We accept major credit/debit cards, net banking, UPI, and popular digital wallets.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                Can I make changes to my booking after purchase?
              </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Yes, changes such as date, time, or passenger details may be possible depending on airline policies. Modification fees may apply.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                What is the cancellation and refund policy?
              </button>
            </h2>
            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Each airline has its own cancellation policy. Refunds depend on the fare rules and cancellation timeline. Check your booking details for exact terms.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSeven">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                How do I add extra baggage, meals, or seat selection?
              </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">After booking, you can log in with your PNR and last name to add extras directly from the airline’s “Manage Booking” section.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingEight">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                What documents are required at the airport?
              </button>
            </h2>
            <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">You must carry a valid government-issued photo ID (passport for international travel) and your e-ticket/boarding pass.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  
<?php include("footer.php"); ?>


<!-- Flight offer card api -->
<script>
const container = document.getElementById("flight-offer-cards-container");

// Show loader before fetch
container.innerHTML = `
  <div id="loader" style="text-align:center; padding:20px;" class="d-flex justify-content-center gap-3 align-items-center">
    <i class="fa fa-spinner fa-spin fa-2x"></i> Loading flights...
  </div>`;

// ✅ Use absolute path if needed on live server
const apiUrl = "/get-flight-offers.php?origin=DEL&destination=LHR&date=2025-09-10&adults=1";

fetch(apiUrl)
  .then(res => {
    if (!res.ok) {
      throw new Error("HTTP status " + res.status);
    }
    return res.json();
  })
  .then(data => {
    console.log("✅ API Response:", data);

    // Clear loader
    container.innerHTML = "";

    if (!data.data || data.data.length === 0) {
      container.innerHTML = `<p style="text-align:center; padding:20px;">❌ No flights found for your search.</p>`;
      return;
    }

    let cardLimit = 9;
    data.data.slice(0, cardLimit).forEach(flight => {
      try {
        let segment = flight.itineraries[0].segments[0];
        let lastSegment = flight.itineraries[0].segments.slice(-1)[0];

        let originCode = segment.departure.iataCode;
        let destinationCode = lastSegment.arrival.iataCode;

        let departureDate = new Date(segment.departure.at).toLocaleDateString();
        let departureTime = new Date(segment.departure.at).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });

        let arrivalDate = new Date(lastSegment.arrival.at).toLocaleDateString();
        let arrivalTime = new Date(lastSegment.arrival.at).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });

        let departureTerminal = segment.departure.terminal || "—";
        let arrivalTerminal = lastSegment.arrival.terminal || "—";

        let carrier = segment.carrierCode;
        let flightNumber = segment.number;

        // Airline name not always available
        let airlineName = segment.airlineName || carrier;

        let duration = flight.itineraries[0].duration
          .replace("PT", "")
          .replace("H", "h ")
          .replace("M", "m")
          .toLowerCase()
          .trim();

        let price = flight.price.total;

        let logoUrl = `https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/${carrier.toLowerCase()}.webp`;

        container.innerHTML += `
          <div class="col-md-4">
            <div class="disc_card">
              <div class="d-flex justify-content-between mb-2">
                <h2 class="wrap-subhding_web1 pt-0 text-primary">$${price}</h2>
                <a href="booking.php?offerId=${flight.id}&adults=2&children=1&infants=0" class="disc_btn">Book Now</a>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="disc_flight_route">${originCode}</h4>
                  <ul class="disc_flight_details">
                    <li><i class="fa-solid fa-calendar-days"></i> ${departureDate}</li>
                    <li><i class="fa-solid fa-clock"></i> ${departureTime}</li>
                    <li><i class="fa-solid fa-archway"></i> Terminal: ${departureTerminal}</li>
                  </ul>
                </div>
                <div>
                  <img src="images/airplane.png" class="disc_route_img">
                  <p class="disc_flight_num pt-1">${duration}</p>
                </div>  
                <div>
                  <h4 class="disc_flight_route">${destinationCode}</h4>
                  <ul class="disc_flight_details">
                    <li><i class="fa-solid fa-calendar-days"></i> ${arrivalDate}</li>
                    <li><i class="fa-solid fa-clock"></i> ${arrivalTime}</li>
                    <li><i class="fa-solid fa-archway"></i> Terminal: ${arrivalTerminal}</li>
                  </ul>
                </div>
              </div>
              <img src="${logoUrl}" alt="${airlineName}" class="disc_flight_logo">
              <p class="disc_flight_num">${airlineName} (${carrier}${flightNumber})</p>
            </div>
          </div>
        `;
      } catch (err) {
        console.error("⚠️ Error rendering flight:", err, flight);
      }
    });
  })
  .catch(err => {
    console.error("❌ Fetch error:", err);
    container.innerHTML = `<p style="text-align:center; padding:20px; color:red;">⚠️ Failed to load flights. Please try again later.</p>`;
  });

</script>


<!-- show total passenger value and fetch value in another page  -->
<script>
  const displayBox = document.getElementById('passengerClassDisplay');
  const dropdownPanel = document.getElementById('passengerDropdown');
  const counts = { adult: 1, child: 0, infant: 0 };

  // Toggle dropdown
  displayBox.addEventListener('click', () => {
      dropdownPanel.style.display = dropdownPanel.style.display === 'block' ? 'none' : 'block';
  });

  // Update count
  function changeCount(type, delta) {
      if (counts[type] + delta >= 0) {
          counts[type] += delta;
          document.getElementById(type + 'Count').textContent = counts[type];
      }
  }

  // Build summary + update hidden fields
  function updateDisplay() {
      const travelClass = document.getElementById('travelClass').value;
      const totalPassengers = counts.adult + counts.child + counts.infant;
      const passengerLabel = totalPassengers === 1 ? 'Passenger' : 'Passengers';

      // Display box
      displayBox.textContent = `${totalPassengers} ${passengerLabel} - ${travelClass}`;

      // Hidden inputs
      document.getElementById('adults').value      = counts.adult;
      document.getElementById('children').value    = counts.child;
      document.getElementById('infants').value     = counts.infant;
      document.getElementById('cabin_class').value = travelClass;
      document.getElementById('passenger').value = 
          `${counts.adult} Adult${counts.adult > 1 ? 's' : ''}`
          + (counts.child > 0 ? `, ${counts.child} Child${counts.child > 1 ? 'ren' : ''}` : '')
          + (counts.infant > 0 ? `, ${counts.infant} Infant${counts.infant > 1 ? 's' : ''}` : '')
          + ` - ${travelClass}`;
  }

  // Confirm button action
  function confirmPassengers() {
      updateDisplay();
      dropdownPanel.style.display = 'none';
      buildTravellerRows();
  }

  // Build traveller rows dynamically
  function buildTravellerRows() {
      const tbody = document.querySelector("#traveller-table tbody");
      if (!tbody) return;

      tbody.innerHTML = "";
      for (let i = 1; i <= counts.adult; i++) tbody.appendChild(createTravellerRow(`Adult ${i}`));
      for (let i = 1; i <= counts.child; i++) tbody.appendChild(createTravellerRow(`Child ${i}`));
      for (let i = 1; i <= counts.infant; i++) tbody.appendChild(createTravellerRow(`Infant ${i}`));
  }

  // Create single traveller row
  function createTravellerRow(label) {
      const tr = document.createElement("tr");
      tr.innerHTML = `
          <td>${label}</td>
          <td><label>First Name</label><input type="text" name="first-name[]" required></td>
          <td><label>Middle Name</label><input type="text" name="middle-name[]"></td>
          <td><label>Last Name</label><input type="text" name="last-name[]" required></td>
          <td><label>Gender</label>
              <select name="gender[]"><option>Male</option><option>Female</option></select>
          </td>
          <td><label>DOB</label><input type="text" name="dob[]" class="dob_datepicker" required></td>
      `;
      return tr;
  }

  // Close dropdown if clicking outside
  document.addEventListener('click', function(e) {
      if (!e.target.closest('#passengerDropdown') && !e.target.closest('#passengerClassDisplay')) {
          dropdownPanel.style.display = 'none';
      }
  });

  // --- KEY FIX ---
  // Update hidden fields before any form submission
  document.querySelector("form").addEventListener("submit", function() {
      updateDisplay();
  });

document.addEventListener('DOMContentLoaded', () => {
    // Preserve initial values from hidden inputs (useful when coming back from flight-result.php)
    counts.adult = parseInt(document.getElementById('adults').value) || 1;
    counts.child = parseInt(document.getElementById('children').value) || 0;
    counts.infant = parseInt(document.getElementById('infants').value) || 0;

    // Initialize display
    updateDisplay();

    // Attach confirm button
    document.getElementById('confirmPassengerBtn').addEventListener('click', confirmPassengers);

    // Ensure form submission updates hidden fields
    document.querySelector("form").addEventListener("submit", function() {
        updateDisplay();
    });
});


</script>

<!-- Flight airport list autocomplete -->
<script>
  // 🔑 Amadeus API credentials
  const client_id = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
  const client_secret = "bLW0u8zhqigZYcaC";

  // Get Amadeus access token
  async function getAccessToken() {
   const res = await fetch("https://test.api.amadeus.com/v1/security/oauth2/token", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({
        grant_type: "client_credentials",
        client_id: client_id,
        client_secret: client_secret
      })
    });
    const data = await res.json();
    return data.access_token;
  }

  // Setup autocomplete
  function setupAutocomplete(inputId, hiddenCodeId, hiddenNameId) {
    getAccessToken().then(token => {
      $("#" + inputId).autocomplete({
        minLength: 2, // user can start typing earlier
        source: function(request, response) {
          //fetch(`https://test.api.amadeus.com/v1/reference-data/airlines?subType=AIRPORT,CITY&keyword=${request.term}&page[limit]=20`, {
          fetch(`https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=${request.term}&page[limit]=20`, {
            headers: { "Authorization": "Bearer " + token }
          })
          .then(res => res.json())
          .then(data => {
            if (!data.data) return response([]);
            response(data.data.map(airport => {
              const city = airport.address?.cityName || airport.name;
              return {
                label: `${airport.name} (${airport.iataCode}) - ${city}, ${airport.address?.countryName || ""}`,
                //label: `${airport.name} (${airport.iataCode}) - ${airport.address?.cityName || ""}`,
                value: `${airport.name} (${airport.iataCode})`, // show nice text in input
                code: airport.iataCode,   // store IATA in hidden field
                name: airport.name        // store airport name in hidden field
              };
            }));
          })
          .catch(() => response([]));
        },
        select: function(event, ui) {
          $("#" + inputId).val(ui.item.value);      // show full name in input
          $("#" + hiddenCodeId).val(ui.item.code);  // save IATA code
          $("#" + hiddenNameId).val(ui.item.name);  // save airport name
          return false;
        }
      });
    });
  }

  // Apply autocomplete
  $(document).ready(function() {
    setupAutocomplete("fromAirport", "fromAirportCode", "fromAirportName");
    setupAutocomplete("toAirport", "toAirportCode", "toAirportName");
  });
</script>


<script>
  $(function() {
      // Departure date picker
      $("#departDate").datepicker({
          dateFormat: "yy-mm-dd",
          minDate: 0,
          numberOfMonths: 2,
          onSelect: function(selectedDate) {
              // Set minimum return date
              $("#returnDate").datepicker("option", "minDate", selectedDate);

              // If round trip, open the return date calendar automatically
              if ($('input[name="tripType"]:checked').val() === 'roundtrip') {
                  setTimeout(function() {
                      $("#returnDate").datepicker("show");
                  }, 200); // small delay so it feels smooth
              }
          }
      });

      // Return date picker
      $("#returnDate").datepicker({
          dateFormat: "yy-mm-dd",
          minDate: 0,
          numberOfMonths: 2
      });

      // Trip type change handling
      $('input[name="tripType"]').on('change', function() {
          if ($(this).val() === 'roundtrip') {
              $("#returnDate").prop('disabled', false);
          } else {
              $("#returnDate").prop('disabled', true).val('');
          }
      });

      // Initial disable if not round trip
      if ($('input[name="tripType"]:checked').val() !== 'roundtrip') {
          $("#returnDate").prop('disabled', true);
      }
  });

</script>
 
 

