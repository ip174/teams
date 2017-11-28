// 
$(document).ready(function(){ 
$("#phone").intlTelInput({
		//allowExtensions: true,
		//autoFormat: false,
		autoHideDialCode: true,
		autoPlaceholder: false,
		nationalMode: false,
		defaultCountry: "auto",
		geoIpLookup: function(callback) {
			$.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
				var countryCode = (resp && resp.country) ? resp.country : "";
				callback(countryCode);
			});
		},

		// nationalMode: false,
		numberType: "MOBILE",
		//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		//preferredCountries: ['cn', 'jp'],
		utilsScript: ROOT_JS+"assets/tel_num/utils.js"

	});

	function load_countryCode(){
		var countryData = $("#phone").intlTelInput("getSelectedCountryData");
		$("#phone").val("+"+countryData.dialCode);
	}

	setTimeout(function() {
		var phoneNo = $("#phone").val();
		if(phoneNo == '') {
			load_countryCode();
		}
	}, 3000);
// 
});	