<!DOCTYPE html>
<html lang="en">

<head>
  <title>Packages</title>

<?php include("header.php"); ?>

<section class="container py-5">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="wrap-hding_web1 pb-4">Explore all tours</h1>
    </div>
    <div class="col-lg-4 d-none d-md-block">
      <div class="package-filter-box_web1">
        <div class="pfb_search_box_web1">
          <h3 class="wrap-subhding_web1 text-white pt-0">Search</h3>
          <form>
            <div class="form-group">
              <input type="search" name="" class="search-filter_web1" placeholder="Search here...">
            </div>
          </form>
        </div>
        <div class="pfb_padding_web1">
          <h3 class="wrap-subhding_web1 pt-0">Filter Price</h3>
          <hr>

          <h3 class="wrap-subhding_web1 pt-0">Tour Type</h3>
          <ul class="pfb_checklist_web1">
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="nature_tour">
              <label for="nature_tour">Nature Tour</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="adventure_tour">
              <label for="adventure_tour">Adventure Tour</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="cultural_tour">
              <label for="cultural_tour">Cultural Tour</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="food_tour">
              <label for="food_tour">Food Tour</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="city_tour">
              <label for="city_tour">City Tour</label>
            </li>
          </ul>
          <hr>
          

          <h3 class="wrap-subhding_web1 pt-0">Duration</h3>
          <ul class="pfb_checklist_web1">
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="1_day">
              <label for="1_day">1 day</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="2_3_days">
              <label for="2_3_days">2–3 days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="3_4_days">
              <label for="3_4_days">3–4 days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="4_5_days">
              <label for="4_5_days">4-5 days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="6_7_days">
              <label for="6_7_days">6-7 Days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="7_8_days">
              <label for="7_8_days">7-8 Days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="8_9_days">
              <label for="8_9_days">8-9 Days</label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="9_10_days">
              <label for="9_10_days">9-10 Days</label>
            </li>
          </ul>
          <hr>
          <h3 class="wrap-subhding_web1 pt-0">Top Reviews</h3>
          <ul class="pfb_checklist_web1">
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="5_star">
              <label for="5_star">
                 <ul class="package-star-review_web1">
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                </ul>
              </label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="4_star">
              <label for="4_star">
                <ul class="package-star-review_web1">
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                </ul>
              </label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="3_star">
              <label for="3_star">
                <ul class="package-star-review_web1">
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                </ul>
              </label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="2_star">
              <label for="2_star">
                <ul class="package-star-review_web1">
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                </ul>
              </label>
            </li>
            <li>
              <input type="checkbox" name="" class="pfb_checkbox" id="1_star">
              <label for="1_star">
                <ul class="package-star-review_web1">
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                </ul>
              </label>
            </li>
          </ul>
        </div>  
      </div>
    </div>
    <div class="col-lg-8">
      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/tour-2.jpg" alt="">
              <div class="package_discount_web1">20% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">France</p>

            <h2 class="package-hding_web1">Romantic Escape to Paris</h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Enjoy a dreamy getaway with visits to the Eiffel Tower, Louvre Museum, and charming Parisian cafés.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">4 Nights / 5 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$1550</strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $1,250 </p>
                <a href="package-view-details.php" class="package-price-btn_web1">View Details</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/tropical-bliss.jpg" alt="">
              <div class="package_discount_web1">18% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">Indonesia</p>

            <h2 class="package-hding_web1">Tropical Bliss in Bali</h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Relax on pristine beaches, explore ancient temples, and experience Bali’s vibrant culture.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">5 Nights / 6 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$1200</strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $980 </p>
                <a href="javascript:void(0)" class="package-price-btn_web1">View Details</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/tour-1.jpg" alt="">
              <div class="package_discount_web1">15% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">Switzerland</p>

            <h2 class="package-hding_web1">Adventure in the Swiss Alps</h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Discover breathtaking mountain landscapes, scenic train rides, and alpine adventures.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">6 Nights / 7 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$2050</strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $1750 </p>
                <a href="javascript:void(0)" class="package-price-btn_web1">View Details</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/tour-4.jpg" alt="">
              <div class="package_discount_web1">15% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">United Arab Emirates</p>

            <h2 class="package-hding_web1">Dubai Luxury Experience </h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Stay in world-class hotels, enjoy desert safaris, and shop at dazzling malls in Dubai.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">4 Nights / 5 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$1,650 </strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $1,400  </p>
                <a href="javascript:void(0)" class="package-price-btn_web1">View Details</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/new-york-city.jpg" alt="">
              <div class="package_discount_web1">15% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">USA</p>

            <h2 class="package-hding_web1">New York City Explorer</h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Visit Times Square, the Statue of Liberty, Central Park, and Broadway’s famous shows.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">3 Nights / 4 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$1,350  </strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $1,150  </p>
                <a href="javascript:void(0)" class="package-price-btn_web1">View Details</a>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div class="package_box_web1">
        <div class="row">
          <div class="col-md-4">
            <div class="package_destination_img_web1">
              <img src="images/safari.jpg" alt="">
              <div class="package_discount_web1">16% Off</div>
            </div>
          </div>
          <div class="col-md-5">
            <p class="package-title_web1">Kenya</p>

            <h2 class="package-hding_web1">Safari Adventure in Kenya</h2>
            <ul class="package-star-review_web1">
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-solid fa-star"></i></li>
              <li><i class="fa-regular fa-star"></i></li>
            </ul>
            <p class="wrap-prgh_web1 pt-2">Embark on thrilling game drives, witness the Big Five, and stay in luxury safari lodges.</p>
          </div>
          <div class="col-md-3 pe-md-0">
            <div class="package-price-area_web1">
              <p class="wrap-prgh_web1 text-center">5 Nights / 6 Days</p>
              <div class="package-price-pos_web1">
                <strike class="text-center d-block strike-color_web1">$2,600 </strike>
                <p class="wrap-prgh_web1 text-center fw-bold">From $2,200 </p>
                <a href="javascript:void(0)" class="package-price-btn_web1">View Details</a>
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
      <div class="d-flex align-items-center justify-content-between  pb-4">
        <h2 class="wrap-hding_web1 pt-0">Popular Trip</h2>
      </div>  
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="top-tour">
        <div class="top-tour-img">
          <img src="images/tour-1.jpg" alt="">
          <div class="tour-pkg-pos">
            <div class="d-flex justify-content-between align-items-center">
              <p class="tour-duration">6N/7D</p>
              <p class="tour-price">From <span>$1750</span></p>
            </div>
          </div>  
        </div>
        <div class="top-tour-textarea">
          <p class="wrap-prgh_web1 pb-1 text-white">Switzerland</p>
          <h4 class="wrap-title_web1"> Swiss Alps Adventure</h4>
        </div>  
      </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="top-tour">
        <div class="top-tour-img">
          <img src="images/tour-2.jpg" alt="">
          <div class="tour-pkg-pos">
            <div class="d-flex justify-content-between align-items-center">
              <p class="tour-duration">4N/5D</p>
              <p class="tour-price">From <span>$1250</span></p>
            </div>
          </div> 
        </div>
        <div class="top-tour-textarea">
          <p class="wrap-prgh_web1 pb-1 text-white">France </p>
          <h4 class="wrap-title_web1"> Paris Romantic Escape</h4>
        </div>  
      </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="top-tour">
        <div class="top-tour-img">
          <img src="images/tour-3.jpg" alt="">
          <div class="tour-pkg-pos">
            <div class="d-flex justify-content-between align-items-center">
              <p class="tour-duration">5N/6D</p>
              <p class="tour-price">From <span>$900</span></p>
            </div>
          </div>
        </div>
        <div class="top-tour-textarea">
          <p class="wrap-prgh_web1 pb-1 text-white">Indonesia </p>
          <h4 class="wrap-title_web1"> Bali Beach Bliss</h4>
        </div>  
      </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="top-tour">
        <div class="top-tour-img">
          <img src="images/tour-4.jpg" alt="">
          <div class="tour-pkg-pos">
            <div class="d-flex justify-content-between align-items-center">
              <p class="tour-duration">3N/4D</p>
              <p class="tour-price">From <span>$785</span></p>
            </div>
          </div> 
        </div>
        <div class="top-tour-textarea">
          <p class="wrap-prgh_web1 pb-1 text-white">United Arab Emirates</p>
          <h4 class="wrap-title_web1"> Dubai Luxury Getaway</h4>
        </div>  
      </div>
    </div>

  </div>
</section>


<?php include("footer.php"); ?>


 