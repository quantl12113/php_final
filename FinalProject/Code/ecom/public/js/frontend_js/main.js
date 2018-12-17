/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});



$(document).ready(function(){

	// Change Price with Size
	$("#selSize").change(function(){
		var idsize = $(this).val();
		if(idsize==""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idsize:idsize},
			success:function(resp){
				var arr = resp.split('#');
				$("#getPrice").html("$ "+arr[0]);
				$("#price").val(arr[0]);
				if(arr[1]==0){
					$("#cartButton").hide();
					$("#Availability").text("Out Of Stock");
				}else{
					$("#cartButton").show();
					$("#Availability").text("In Stock");
				}
				
				
			},error:function(){
				alert("Error");
			}
		});
	});

	// Change Image
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		$("#mainImg").attr("src", image);
		/*$("#mainImgLarge").attr("href", image);*/
	});

	// Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });

});

$().ready(function() {
	$("#current_pwd").keyup(function() {
		var current_pwd = $(this).val();
		$.ajax({
			headers: {
 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     		},
			type: 'post',
			url: '/check-user-pwd',
			data: {current_pwd:current_pwd},
			success:function(resp) {
				//alert(resp);
				if(resp == "false") {
					$("#chkPwd").html("<font color='red'>Current Password is Incorrect!</font>");
				} else if (resp == "true") {
					$("#chkPwd").html("<font color='green'>Current Password is Correct!</font>");
				}
			}, 
			error: function() {alert("Error")},
		});
	});

	$("#new_pwd").keyup(function() {
		var new_pwd = $(this).val();
		var confirm_pwd = $("#confirm_pwd").val();
		if (new_pwd != confirm_pwd) {
			$("#chk_confirm").html("<font color='red'>Confirm Password don't match New Password</font>")
		}
		else {
			$("#chk_confirm").html("");
		}
	});


	$("#confirm_pwd").keyup(function() {
		var confirm_pwd = $(this).val();
		var new_pwd = $("#new_pwd").val();
		if (new_pwd != confirm_pwd) {
			$("#chk_confirm").html("<font color='red'>Confirm Password don't match New Password</font>")
		} else {
			$("#chk_confirm").html("");
		}
	});


	$("#accountForm").validate({
		rules:{
			name:{
				required: true,
				minlength: 2,
				accept: '[a-zA-z]+',
			},
			address: {
				required: true,
			},
			city: {
				required: true,
			},
			state: {
				required: true,
			},
			country: {
				required: true,
			},
			mobile: {
				accept: '[0-9]+'
			}
		},
		message:{
			name: {
				required: "Please enter your Name",
				accept: "Your name must contain letters only"
			},
			address: {
				required: "Please enter your Address"
			},
			city: {
				required: "Please enter your City"
			},
			state: {
				required: "Please enter your State"
			},
			country: {
				required: "Please select your Country"
			},
			mobile: {
				accept: "Your mobile number must contain digits only"
			}
		}
	});

	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote: {
					url: "/check-email",
				}
			}
		},
		message:{
			name: {
				required: "Please enter your name",
				minlength: "Your name must be atleast 2 characters long",
				accept: "Your name must contain letters only"
			},
			password: {
				required: "Please provide your password",
				minlength: "Your password must be atleast 6 characters long"
			},
			email: {
				required: "Please enter your email",
				email: "Please enter valid Email",
				remote: "Email already exists!"
			}
		}
	});

	$("#passwordForm").validate({
		rules:{
			/*name:{
				required:true
			},*/
			/*email:{
				required:true,
				email: true
			},*/
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#loginForm").validate({
		rules:{
			password:{
				required:true,
			},
			email:{
				required:true,
				email:true,
			}
		},
		message:{
			password: {
				required: "Please provide your password",
			},
			email: {
				required: "Please enter your email",
			}
		}
	});

	$("#myPassword").passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg: "/images/frontend_images/eye.svg",
	});

	$("#confirm_pwd").passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg: "/images/frontend_images/eye.svg",
	});

	$("#new_pwd").passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg: "/images/frontend_images/eye.svg",
	});

	$('#copyAddress').on('click', function() {
		if(this.checked) {
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());
			$("#shipping_country").val($("#billing_country").val());
		}
		else {
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');
			$("#shipping_country").val('');
		}
	});

});

function selectPaymentMethod() {
	if($('#Paypal').is(':checked') || $('#COD').is(':checked')) {

	}
	else {
		alert("Please select Payment Method");
		return false;
	}
}

$(document).ready(function() {
	$("#pupload").click(function () {
		$('#files').trigger('click'); 
	});	
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<div class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/>  <div id=\"remove\"><i class=\"fa fa-times\"></i></div>" +
            "</div>").insertAfter("#files");
          $("#remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

$(document).ready(function() {
	var slider = document.getElementById("review_point");
	var output = document.getElementById("point");
	output.innerHTML = slider.value;

	slider.oninput = function() {
  		output.innerHTML = this.value;
	}

});