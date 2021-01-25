$("#villageForm").validate({
    rules: {
        village_name: "required",
        state :"required",
        district :"required",
        block :"required"

    },
    messages: {
        village_name: "Please Enter District Name",
        state :"Please Select State",
        district :"Please Select District",
        block : "Please Select Block"

    }
});

$("#state").on('change', function () {
    
    var stateId = this.value;
    console.log(stateId)
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
                    var div_data2 = "<option value=" + data.block_id + ">" + data.block_name + "</option>";
                    $('#block').append(div_data2);
                });
            }

        }

    });
});
$('#phc').DataTable();