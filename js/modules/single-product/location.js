export function initLocation() {
    // Function to get the user's location based on IP
    function getLocation() {
        console.log("Chamando API de localização.");
        $.get("https://ipapi.co/json/", function(response) {
            console.log("Resposta da API:", response);
            var city = response.city;
            var region = response.region;
            if (city && region) {
                $('#location').text(city + ', ' + region);
            } else {
                $('#location').text('sua localização');
            }
        }, "json").fail(function() {
            $('#location').text('sua localização');
        });
    }

    // Call the location function on page load
    getLocation();
}
