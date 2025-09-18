<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tour and Travel Website</title>

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
      <form id="flightForm" class="flight-searc-box" action="flight-search.php" method="POST">
          <div class="row">
            <div class="col-sm-12">
              <!-- Trip Type -->
              <div class="form-group mb-3">
                  <label><input type="radio" class="choose-trip-type" name="tripType" value="oneway" checked> One Way</label>
                  <label><input type="radio" class="choose-trip-type" name="tripType" value="roundtrip"> Round Trip</label>
                  <!-- <label><input type="radio" class="choose-trip-type" name="tripType" value="multicity"> Multi-City</label> -->
              </div>    
            </div>
            <div class="col-sm-12">
              <div class="flight-field-bg">
                <div class="row">
                  <div class="col-md">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 pe-md-0">
                        <div class="form-group" id="citySection">
                          <label class="filter-lbl">Origin</label>
                          <input type="text" class="filter-field from_oneway1 field-right-radius-0" id="fromAirport" name="origin" placeholder="From" required>
                            <!-- <input type="hidden" id="fromAirportCode" name="origin_code"> -->
                            <input type="hidden" id="fromAirportCode" name="origin_code">   <!-- IATA Code -->
                            <input type="hidden" id="fromAirportName" name="origin_name">   <!-- Full Name -->
                        </div> 
                      </div>
                      <div class="col-sm-6 col-md-6 px-md-0">
                        <div class="form-group" id="citySection">
                          <label class="filter-lbl">Departure</label>
                          <input type="text" class="filter-field to_oneway1 field-radius-0" id="toAirport" name="destination" placeholder="To" required>
                            <!-- <input type="hidden" id="toAirportCode" name="destination_code"> -->
                            <input type="hidden" id="toAirportCode" name="destination_code"> <!-- IATA Code -->
                            <input type="hidden" id="toAirportName" name="destination_name"> <!-- Full Name -->
                        </div>
                      </div>    
                    </div>
                  </div>
                  
                  <div class="col-sm-6 col-md-2 px-md-0">
                    <div class="form-group">
                       <label class="filter-lbl">Departure Date</label>
                       <input type="text" class="filter-field field-radius-0" id="departDate" name="departure_date" placeholder="Select Date" required>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-2 px-md-0">
                    <div class="form-group">   
                        <label class="filter-lbl">Return Date</label> 
                        <input type="text" class="filter-field field-radius-0" name="return_date" id="returnDate" placeholder="Select Date">
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-auto px-md-0">
                    <div class="form-group">
                      <label class="filter-lbl">Passenger & Class</label>
                      <div class="filter-field" id="passengerClassDisplay">1 Passenger - Economy</div>
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

<section class="bg-light py-5 mt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12 pb-5">
        <p class="wrap-title_web1 mx-auto d-table">Flight Offers</p>
        <h2 class="wrap-hding_web1 text-center">Exclusive Deals on Popular Routes</h2>
      </div>
      <div class="col-md-4">
        <div class="disc_card">
          <p class="disc_lbl">20% Discount</p>
          <div class="d-flex justify-content-between">
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
          <p class="disc_lbl">25% Discount</p>
          <div class="d-flex justify-content-between">
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
          <p class="disc_lbl">25% Discount</p>
          <div class="d-flex justify-content-between">
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
          <p class="disc_lbl">28% Discount</p>
          <div class="d-flex justify-content-between">
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
          <p class="disc_lbl">30% Discount</p>
          <div class="d-flex justify-content-between">
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
          <p class="disc_lbl">20% Discount</p>
          <div class="d-flex justify-content-between">
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

<!-- <section class="container py-5">
  <div class="row">
    <div class="col-md-4">
      <div class="flight-card">
        <h3>Delhi → London</h3>
        <p>Non-stop | 9h 30m</p>
        <span class="price">$550</span>
        <a href="#" class="book-now">Book Now</a>
      </div>
    </div>
  </div>
</section> -->
<div class="container" id="flight-container"></div>

  <script>
    fetch("getFlights.php?origin=DEL&destination=LHR&date=2025-09-10&adults=1")
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("flight-container");
        data.data.slice(0,6).forEach(flight => {
          let origin = flight.itineraries[0].segments[0].departure.iataCode;
          let destination = flight.itineraries[0].segments.slice(-1)[0].arrival.iataCode;
          let duration = flight.itineraries[0].duration.replace("PT","").toLowerCase();
          let price = flight.price.total;

          container.innerHTML += `
            <div class="flight-card">
              <h3>${origin} → ${destination}</h3>
              <p>Duration: ${duration}</p>
              <p class="price">$${price}</p>
              <a href="booking.php?offerId=${flight.id}" class="book-btn">Book Now</a>
            </div>
          `;
        });
      });
  </script>

<?php include("footer.php"); ?>


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
          <td><label>DOB</label><input type="date" name="dob[]" required></td>
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
      minLength: 3,
      source: function(request, response) {
        fetch(`https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=${request.term}`, {
          headers: { "Authorization": "Bearer " + token }
        })
        .then(res => res.json())
        .then(data => {
          response(data.data.map(airport => {
            const city = airport.address.cityName || airport.name;  // ✅ fallback
            return {
              label: `${airport.name} (${airport.iataCode}) - ${city}, ${airport.address.countryName}`,
              //value: `${city} (${airport.iataCode})`,  // 👈 Input shows city + code
              value: `${airport.iataCode}`,  // 👈 Input shows city + code
              code: airport.iataCode,                  // 👈 Hidden field keeps only code
              name: airport.name
            };
          }));
        });
      },
      select: function(event, ui) {
        $("#" + inputId).val(ui.item.value);      // Show city + code in input
        $("#" + hiddenCodeId).val(ui.item.code);  // Save IATA code
        $("#" + hiddenNameId).val(ui.item.name);  // Save airport name
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
<!-- Fligth Price Card --> 
<script>
   <?php
// Replace with your Amadeus credentials
$client_id = "IMewQoGGzsLuxu2vR2r9ImKFeRVNbf4m";
$client_secret = "bLW0u8zhqigZYcaC";

// 1. Get Access Token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://test.api.amadeus.com/v1/security/oauth2/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    "grant_type" => "client_credentials",
    "client_id" => $client_id,
    "client_secret" => $client_secret
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$auth = json_decode($response, true);
$access_token = $auth['access_token'];

// 2. Call Flight Offers Search API
$origin = $_GET['origin'] ?? "DEL";  // default Delhi
$destination = $_GET['destination'] ?? "LHR"; // default London
$date = $_GET['date'] ?? "2025-09-10"; // default date
$adults = $_GET['adults'] ?? 1;

$url = "https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=$origin&destinationLocationCode=$destination&departureDate=$date&adults=$adults&max=6";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Return JSON to frontend
header("Content-Type: application/json");
echo $response;
?>

</script>