/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */



$(document).ready(function () {
    $(document).on('change', '#province', function () {
        var provCode = $(this).val();
		console.log(provCode);
        $('#cityMun').html('<option value="">Loading...</option>');
        $('#barangay').html('<option value="">Select Barangay</option>');

        $.post('../ajax/addressHandler.php', {
            action: 'getCities',
            provCode: provCode
        }, function (data) {
            $('#cityMun').html('<option value="">Select City/Municipality</option>');
            $.each(data, function (index, city) {
                $('#cityMun').append('<option value="' + city.citymunCode + '">' + city.txtCityMunDesc + '</option>');
            });
        }, 'json');
    });

    $('#cityMun').on('change', function () {
        var cityMunCode = $(this).val();
        $('#barangay').html('<option value="">Loading...</option>');

        $.post('../ajax/addressHandler.php', {
            action: 'getBarangays',
            cityMunCode: cityMunCode
        }, function (data) {
            $('#barangay').html('<option value="">Select Barangay</option>');
            $.each(data, function (index, brgy) {
                $('#barangay').append('<option value="' + brgy.intBrgyID + '">' + brgy.txtBrgyDesc + '</option>');
            });
        }, 'json');
    });
});

