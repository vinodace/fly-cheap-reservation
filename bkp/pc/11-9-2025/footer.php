 
<footer id="footer">
	<div class="container">
		<div class="row justify-content-between pb-5">
			<div class="col-sm-6 col-md-4">
				<div class="d-flex justify-content-md-end mt-4 mt-md-0 mt-sm-2">
					<div>
						
						<img src="<?= $baseURL ?>images/logo-white.png" alt="" class="footer-logo mb-3">
						<address class="footer-address">
							<div class="d-flex align-items-center gap-3 mb-3">
							 	<i class="fa-solid fa-house"></i> 3612 Windshire Dr Springfield, IL 62704, USA
							</div> 
							<div class="d-flex align-items-center gap-3 mb-3">
							 	<i class="fa-solid fa-envelope"></i> <?php echo $email_web; ?>
							</div> 	
						</address>
						
					</div>
				</div>		
			</div>
			<div class="col-12 col-md-4">
				<div class="d-flex justify-content-md-center">
					<div>
						<h2 class="footer-hding_web1">Connect With Us</h2>
						<ul class="footer_socialicon_web1">
							<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
						</ul>
						<p class="footer-text_web1 pt-2">Explore the world with ease  We're just a call away</p>
						<address class="footer-address mt-2">
							<div class="d-flex align-items-center gap-3">
							 	<i class="fa-solid fa-phone-volume"></i> <?php echo $phone_web; ?>
							</div> 
						</address>
					</div>
				</div>		
			</div>
			<div class="col-6 col-md-2">
				<h2 class="footer-hding_web1">Main Links</h2>
				<ul class="footer-list_web1">
					<li><a href="flights.php">Flights</a></li>
					<li><a href="destination.php">Destination</a></li>
					<li><a href="packages.php">Packages</a></li>
					<li><a href="about-us.php">About Us</a></li>
					<li><a href="contact-us.php">Contact Us</a></li>
					
				</ul>
			</div>
			<div class="col-6 col-md-2">
				<h2 class="footer-hding_web1">Other Links</h2>
				<ul class="footer-list_web1">
					<li><a href="privacy-policy.php">Privacy Policy</a></li>
					<li><a href="terms-and-conditions.php">Terms & Conditions</a></li>
					<li><a href="canellation-and-refund-policy.php">Cancellation & Refund Policy</a></li>
				</ul>
			</div>
			
			
		</div>
	</div>	
	<div class="copyright-bg_web1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="copyright_web1 text-center">Copyright © <script>document.write(new Date().getFullYear())</script> <?php echo $domainname_web_url_web ?>. All rights reserved</p>
				</div>
			</div>
		</div>
	</div>	
</footer>

<!-- Login/Signup Modal -->
<div class="modal fade modaldesign_web1" id="login_signup-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <div class="row">
          <div class="col-sm-12 col-md-12 pr-md-0">
          	<nav>
						  <div class="nav nav-tabs" id="nav-tab" role="tablist">
						    <button class="nav-link text-dark active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Login</button>
						    <button class="nav-link text-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Register</button>
						  </div>
						</nav>
						
						<?php if(isset($_SESSION['error'])): ?>
						  <div class="errmsg text-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
						<?php endif; ?>

						<?php if(isset($_SESSION['success'])): ?>
						  <div class="errmsg text-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
						<?php endif; ?>

						<div class="tab-content" id="nav-tabContent">
						  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						  	<div class="login_signup-modal-area">
		              <form id="loginForm">
		                <div class="row justify-content-center">
		                  <div class="col-sm-12">
		                  	<h3 class="login_signup-hding">Login to Your Account </h3>
		                  	<p class="login_signup-subhding">Access your bookings, saved trips, and exclusive offers.</p>
		                  </div>
		                  <div class="col-sm-8 col-md-6">
		                    <img src="images/login-img.png" alt="" class="img-fluid">
		                  </div>
		                  <div class="col-sm-12 mt-3">
		                    <div class="form-group posrel mb-3">
		                      <input type="email" name="login-email" class="login_signup-field" placeholder="Email Address">
		                    </div>
		                    <div class="form-group posrel">
		                      <input type="password" name="login-password" class="login_signup-field" placeholder="Password">
		                    </div>
		                  </div>
		                  
		                  <div class="pt-2" id="loginMessage"></div>

		                  <div class="col-sm-12">
		                  	<button type="submit" name="submit" class="login_signup-btn w-100 mt-4">Continue to Login</button>

		                  </div>
		                </div>
		              </form>
		            </div>
						  </div>
						  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						  	<div class="login_signup-modal-area">
		              <form id="registerForm">
		                <div class="row justify-content-center">
		                  <div class="col-sm-12 mb-3">
		                  	<h3 class="login_signup-hding">Create an Account </h3>
		                  	<p class="login_signup-subhding">Sign up to book flights faster, manage reservations, and enjoy member-only deals.</p>
		                  </div>
		                  <div class="col-sm-6">
		                  	<div class="form-group mb-3">
		                  		<input type="text" name="first-name" class="login_signup-field" placeholder="First Name">
		                  	</div>
		                  </div>
		                  <div class="col-sm-6">
		                  	<div class="form-group mb-3">
		                  		<input type="text" name="last-name" class="login_signup-field" placeholder="Last Name">
		                  	</div>
		                  </div>
		                  <div class="col-sm-6">
		                  	<div class="form-group mb-3">
		                  		<select name="gender" class="login_signup-field">
		                  			<option value="0">Select Gender</option>
		                  			<option value="Male">Male</option>
		                  			<option value="Female">Female</option>
		                  			<option value="Transgender">Transgender</option>
		                  		</select>
		                  	</div>
		                  </div>
		                  <div class="col-sm-6">
		                  	<div class="form-group">
		                      <input type="text" name="phone" class="login_signup-field" placeholder="Your Phone Number">
		                    </div>
		                  </div>
		                  <div class="col-sm-12">
		                    <div class="form-group mb-3">
		                      <input type="email" name="email" class="login_signup-field" placeholder="Email Address">
		                    </div>
		                    <div class="form-group mb-3">
		                      <input type="password" name="password" class="login_signup-field" placeholder="Create Password">
		                    </div>
		                    
		                  </div>

		                  <div class="pt-2"  id="registerMessage"></div> 

		                  <div class="col-sm-12">
		                  	<button type="submit" name="submit" class="login_signup-btn w-100 mt-4">Create an Account</button>
		                  	<p class="login-terms">By signing up, you confirm that you have read and agree to our <a href="terms-and-conditions.php" target="_blank">Terms & Conditions</a> and <a href="privacy-policy.php" target="_blank">Privacy Policy</a></p>
		                  </div>
		                </div>
		              </form>
		            </div>
						  </div>
						</div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script> -->
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= $baseURL ?>js/owl.carousel.min.js"></script>
<script type="text/javascript">

	$('#top-trending').owlCarousel({
		  //items: 1,
		  loop: true,
		  //center:true,
		  singleItem:true,
		  navigation : true, // Show next and prev buttons
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      dots: false,
	      nav: true, // Show next and prev buttons
	      navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
	      responsiveClass:true,
		  slideBy: 1,
		  margin: 25,
		  autoplay: true,
		  autoplayTimeout: 3000,
		  autoplayHoverPause: true,
		   responsive:{
			  0:{
			  items:1
			  },
			  768:{
			  items:3
			  },
			  992:{
			  items:4
			  }
			}
	});  

	$('#testimonial_carousel').owlCarousel({
		 loop: true,
	    items: 1,
	    dots: true,
	    dotsData: true, // Enables your custom image dots
	    nav: false,
	    margin: 25,
	    autoplay: false,
	    autoplayHoverPause: true,
	    responsive: {
	        0: { items: 1 },
	        768: { items: 1 },
	        992: { items: 1 }
	    }
	});     

	// click data image to change carousel 
	$(document).on('click', '.owl-dot', function() {
	    var index = $(this).index();
	    $('.owl-carousel').trigger('to.owl.carousel', [index, 300]);
	});

	// Top Destination
	$('#top-destination').owlCarousel({
        loop:true,
        margin:10,
        dots: false,
        nav: true, // Show next and prev buttons
    
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
        autoplay: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:true,
                loop:false
            }
        }
    })

    // Top Destination 2
	$('#top-destination2').owlCarousel({
        loop:true,
        margin:10,
        dots: false,
        nav: true, // Show next and prev buttons
    
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
        autoplay: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:3,
                nav:false
            },
            1000:{
                items:3,
                nav:true,
                loop:false
            }
        }
    })
</script>
<script>
	// Header Sticky on scrollbar
	$(document).ready(function () {
    function checkScroll() {
        if ($(window).scrollTop() > 0) {
            $("header").addClass("sticky-header");
        } else {
            $("header").removeClass("sticky-header");
        }
    }

    // Run on page load
    checkScroll();

    // Run on scroll
    $(window).scroll(function () {
        checkScroll();
    });
	});

	// Logo change on scroll only in index.php
	$(document).ready(function () {
    // Run script only if page is index.php
    if (window.location.pathname.endsWith("index.php") || window.location.pathname === "/") {
        
        function checkScroll() {
            if ($(window).scrollTop() > 0) {
                $(".logo").attr("src", "images/logo.png"); // Change logo on scroll
            } else {
                $(".logo").attr("src", "images/logo-white.png"); // Default logo
            }
        }

        // Run on page load
        checkScroll();

        // Run on scroll
        $(window).scroll(function () {
            checkScroll();
        });
    }
});
</script>

<!-- Add and Remove Traveller row field -->
<script>
$(document).ready(function(){
    $(".add-traveller-btn").click(function(){
        $("#traveller-table").append(
            `<tr>
              <td align="middle">Traveler</td>
              <td>
                <label class="traveller-form-lbl">First Name</label>
                <input type="text" name="first-name" class="traveller-form-field">
              </td>
              <td>
                <label class="traveller-form-lbl">Middle Name</label>
                <input type="text" name="middle-name" class="traveller-form-field">
              </td>
              <td>
                <label class="traveller-form-lbl">Last Name</label>
                <input type="text" name="last-name" class="traveller-form-field">
              </td>
              <td>
                <label class="traveller-form-lbl">Gender</label>
                <select name="gender" class="traveller-form-field">
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </td>
              <td>
                <label class="traveller-form-lbl">Date of Birth</label>
                <select name="gender" class="traveller-form-field">
                  <?php 
                    for($i =1; $i <=10; $i++) {
                      echo "<option value='$i'>$i</option>";    
                    }
                  ?>
                </select>
              </td>
              <td>
                <label class="traveller-form-lbl">Month</label>
                <select name="month" class="traveller-form-field">
                  <option>Jan</option>
                  <option>Feb</option>
                </select>
              </td>
              <td>
                <label class="traveller-form-lbl">Year</label>
                <select name="month" class="traveller-form-field">
                  <?php 
                    for($b=1980; $b <=2025; $b++) {
                      echo "<option value='$b'>$b</option>";
                    }
                  ?>
                </select>
              </td>
              <td width="30" valign="middle">
                  <button class="remove-traveller-tr"><i class="fa-solid fa-minus"></i></button>
              </td>
            </tr>`
        );
    });
});

$(document).on("click", ".remove-traveller-tr", function(){
    $(this).closest("tr").remove();
});

</script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
	$(function(){
	   // Numbers only
	   $(".number").keypress(function (e) {
	      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	         $(this).next(".errmsg")
	            .html("Numbers only")
	            .stop()
	            .show()
	            .fadeOut("slow");
	         return false;
	      }
	   });

	   // Alphabets only
	   $(".alphabet").keypress(function (e) {
	      // A-Z (65–90), a-z (97–122), backspace(8), space(32)
	      if (e.which != 8 && e.which != 32 && (e.which < 65 || (e.which > 90 && e.which < 97) || e.which > 122)) {
	         $(this).next(".errmsg")
	            .html("Alphabets only")
	            .stop()
	            .show()
	            .fadeOut("slow");
	         return false;
	      }
	   });
	});
</script>

<script>
 // Wait 3 seconds then hide
setTimeout(() => {
  const msgs = document.querySelectorAll('.login_singup_errmsg');

  msgs.forEach(msg => {
    msg.style.transition = "opacity 0.5s ease"; // smooth fade out
    msg.style.opacity = 0;

    // Remove after fade-out (500ms later)
    setTimeout(() => msg.remove(), 500);
  });
}, 3000); // 3000ms = wait 3 seconds before starting fade


</script>


<script>
	document.addEventListener("DOMContentLoaded", function () {
	  // LOGIN
		const loginForm = document.getElementById("loginForm");
		const loginMessage = document.getElementById("loginMessage");

		loginForm.addEventListener("submit", function(e) {
		  e.preventDefault(); // stop page refresh

		  const formData = new FormData(this);

		  fetch("login.php", {
		    method: "POST",
		    body: formData
		  })
		  .then(res => res.json()) // ✅ parse JSON
		  .then(data => {
		    if (data.status === "success" && data.redirect) {
		      // ✅ Redirect immediately if backend sent a redirect URL
		      window.location = data.redirect;
		    } else {
		      // Show error message
		      loginMessage.innerHTML = `
		        <div class="login_singup_errmsg">${data.message}</div>
		      `;

		      // 🔽 Fade-out only for messages
		      const msg = loginMessage.querySelector('.login_singup_errmsg');
		      if (msg) {
		        setTimeout(() => {
		          msg.style.transition = "opacity 0.5s ease";
		          msg.style.opacity = 0;

		          // Remove after fade-out
		          setTimeout(() => msg.remove(), 500);
		        }, 3000);
		      }
		    }
		  })
		  .catch(err => console.error("Login error:", err));
		});



	  // REGISTER
	  const registerForm = document.getElementById("registerForm");
	  const registerMessage = document.getElementById("registerMessage");

	  registerForm.addEventListener("submit", function(e) {
	    e.preventDefault(); // prevent page reload

	    const formData = new FormData(this);

	    fetch("register.php", {
	      method: "POST",
	      body: formData
	    })
	    .then(res => res.text())
	    .then(data => {
	      registerMessage.innerHTML = data;
	      registerMessage.style.opacity = 1;

	      // Clear form if registration successful
	      if (data.includes("Account created successfully")) {
	        registerForm.reset();
	      }

	      // Fade out after 3 seconds
	      setTimeout(() => {
	        registerMessage.style.transition = "opacity 0.5s ease";
	        registerMessage.style.opacity = 0;
	        setTimeout(() => registerMessage.innerHTML = '', 500);
	      }, 3000);
	    })
	    .catch(err => console.error(err));
	  });
	});
</script>

</body>
</html>