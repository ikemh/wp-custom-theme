    export function initLocation() {
        // Function to get the user's location based on IP
        function getLocation() {
            jQuery.get("https://ipapi.co/json/", function(response) {
                var city = response.city;
                var region_code = response.region_code;
                if (city && region_code) {
                    jQuery('#location').text(` para  ${city}, ${region_code} e região`);
                } else {
                    jQuery('#location').text(' para todo o Brasil');
                }
            }, "json").fail(function() {
                jQuery('#location').text(' para todo o Brasil');
            });
        }

        // Call the location function on page load
        getLocation();
    }
