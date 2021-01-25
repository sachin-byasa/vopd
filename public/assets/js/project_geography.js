// $("#blockForm").validate({
//     rules: {
//         block_name: "required",
//         state :"required",
//         district :"required"
//     },
//     messages: {
//         block_name: "Please Enter District Name",
//         state :"Please Select State",
//         district :"Please Select District",

//     }
// });

$("#state").on('change', function () {

    var stateId = this.value;
    $.ajax({
        url: BASE_URL + "/admin/blocks/getDistrictFromState/" + stateId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if(response.status === "pass"){
                $('#district').empty(); 
                $('#district').append('<option value="">Please select District</option>');
                $.each(response.district, function (i, data) {
                    var div_data = "<option value=" + data.district_id + ">" + data.district_name + "</option>";
                    $('#district').append(div_data);
                });
            }

        }

    });
});

$("#district").on('change', function () {

    var districtId = this.value;
    $.ajax({
        url: BASE_URL + "/admin/blocks/getBlockFromDistrict/" + districtId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if(response.status === "pass"){
                $('#block').empty(); 
                $('#block').append('<option value="">Please select Block</option>');
                $.each(response.block, function (i, data) {
                    console.log(data[i]);
                    var div_data = "<option value=" + data.block_id + ">" + data.block_name + "</option>";
                    $('#block').append(div_data);
                });
            }

        }

    });
});

$("#block").on('change', function () {

    var blockId = this.value;
    $.ajax({
        url: BASE_URL + "/admin/villages/getVillageFromBlock/" + blockId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response.status);
            console.log(response.village)
            if(response.status === "pass"){
                $('#village').empty(); 
                $('#village').append('<option value="">Please select village</option>');
                $.each(response.village, function (i, data) {
                    var div_data = "<option value=" + data.village_id + ">" + data.village_name + "</option>";
                    $('#village').append(div_data);
                });
            }

        }

    });
});


$("#phc").on('change', function () {

    var phcId = this.value;
    $.ajax({
        url: BASE_URL + "/admin/phc/getSubCentresFromPHC/" + phcId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response.status);
            console.log(response.sub_centre)
            if(response.status === "pass"){
                $('#sub_centre').empty(); 
                $('#sub_centre').append('<option value="">Please select sub_centre</option>');
                $.each(response.sub_centre, function (i, data) {
                    console.log(data);
                    var div_data = "<option value=" + data.sub_centre_id + ">" + data.sub_centre_name + "</option>";
                    $('#sub_centre').append(div_data);
                });
            }

        }

    });
});

