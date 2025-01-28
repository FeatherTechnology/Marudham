
// Document is ready
$(document).ready(function () {

    $('input[data-type="adhaar-number"]').keyup(function () {
        var value = $(this).val();
        value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
        $(this).val(value);
    });

    $('input[data-type="adhaar-number"]').on("change, blur", function () {
        var value = $(this).val();
        var maxLength = $(this).attr("maxLength");
        if (value.length != maxLength) {
            $(this).addClass("required");
        } else {
            $(this).removeClass("required");

            var cus_id = $(this).val();
            cus_id = cus_id.replace(/\s+/g, '');

            var idupd = $('#id').val();
            var cus_id_upd = $('#cus_id_upd').val();


            if (idupd == undefined) {
                // if page loaded for update, then no need to customer details
                getCustomerDetails(cus_id);
            } else if (cus_id_upd != undefined && cus_id_upd != cus_id) {
                // if user removed and entered the same customer id while update, then dont refresh contents, have same
                getCustomerDetails(cus_id);
            }

        }
    });

    $('#agent').change(function () {
        var agent_id = $('#agent').val();
        $('#loan_category, #sub_category').val('');
        getAgentBasedLoanCategory(agent_id);
    })

    $('#cus_status').click(function () {
        let cus_id = $('#cus_id').val();
        if (cus_id == '') {
            alert('Please Enter Customer ID!');
            $(this).removeAttr('data-toggle').removeAttr('data-target')
        } else {
            $(this).attr('data-toggle', 'modal').attr('data-target', '.customerstatus')
            callresetCustomerStatus(cus_id);//this function will give the customer's status like pending od current
            showOverlay();//loader start
            setTimeout(() => {
                //take all the values from the function then send to customer status file to fetch details
                var pending_sts = $('#pending_sts').val(); var od_sts = $('#od_sts').val(); var due_nil_sts = $('#due_nil_sts').val(); var closed_sts = $('#closed_sts').val(); var bal_amt = $('#bal_amt').val()
                $.ajax({
                    url: 'requestFile/getCustomerStatus.php',
                    data: { cus_id, pending_sts, od_sts, due_nil_sts, closed_sts, bal_amt },
                    // dataType: 'json',
                    type: 'post',
                    cache: false,
                    success: function (response) {
                        $('#cusHistoryTable').empty();
                        $('#cusHistoryTable').html(response);
                        $('#cusHistoryTable tbody tr').each(function () {
                            var val = $(this).find('td:nth-child(6)').html();
                            if (['Request', 'Verification', 'Approval', 'Acknowledgement', 'Issue'].includes(val)) {
                                $(this).find('td:nth-child(6)').css({ 'backgroundColor': 'rgba(240, 0, 0, 0.8)', 'color': 'white', 'fontWeight': 'Bolder' });
                            } else if (val == 'Present') {
                                $(this).find('td:nth-child(6)').css({ 'backgroundColor': 'rgba(0, 160, 0, 0.8)', 'color': 'white', 'fontWeight': 'Bolder' });
                            } else if (val == 'Closed') {
                                $(this).find('td:nth-child(6)').css({ 'backgroundColor': 'rgba(0, 0, 255, 0.8)', 'color': 'white', 'fontWeight': 'Bolder' });
                            }

                        });
                    }
                })
                hideOverlay();
            }, 1500)
        }
    })

    $('#dob').change(function () {//Age Calculation
        var myDate = new Date($("#dob").val()),
            milli = myDate.getTime(),
            newDate = new Date(),
            newMilli = newDate.getTime();

        $("#age").val(Math.floor((newMilli - milli) / 1000 / 60 / 60 / 24 / 30 / 12));
    })

    $('#pic').change(function () {//To show after choose image
        var pic = $('#pic')[0];
        var img = $('#imgshow');
        img.attr('src', URL.createObjectURL(pic.files[0]));
    })

    $("#state").change(function () {
        var StateSelected = $(this).val();
        getDistrictDropdown(StateSelected);
    });

    $('#district').change(function () {
        var DistSelected = $(this).val();
        $('#district1').val(DistSelected);
        getTalukDropdown(DistSelected);
    });

    $('#taluk').change(function () {
        var talukselected = $(this).val();
        $('#taluk1').val(talukselected);
        getTalukBasedArea(talukselected);
    })

    $('#area').change(function () {

        var areaselected = $('#area').val();
        getAreaBasedSubArea(areaselected);
    })

    $('#marital').change(function () {//To get spouse name or not
        var marital = $(this).val();
        if (marital == '1') {
            $('.spouse').show();
        } else {
            $('.spouse').hide();
        }
    })

    $('#loan_category').change(function () {
        var loanselected = $('#loan_category').val();
        $('.advance_yes').hide();
        $('.loan_amt').hide();
        $('#tot_value').val('');
        $('#ad_amt').val('');
        $('#ad_perc').val('');
        $('#loan_amt').val('');
        $('.category_info .card-body .row').empty();
        getSubCategory(loanselected);
    })

    $('#sub_category').change(function () {
        var subselected = $('#sub_category').val();
        $('#tot_value').val('');
        $('#ad_amt').val('');
        $('#ad_perc').val('');
        $('#loan_amt').val('');
        $('.category_info .card-body .row').empty();
        getLoaninfo(subselected);
        getCategoryInfo(subselected);
    })

    $('#tot_value').blur(function () {// to calculate loan amount ant advance percentage
        var amt = $('#tot_value').val();
        var advance = $('#ad_amt').val();
        var per = (advance / amt) * 100;
        $('#ad_perc').val(per.toFixed(1));

        var loan_amt = amt - advance;
        $('#loan_amt').val(loan_amt.toFixed(0));
    })

    $('#ad_amt').blur(function () {//To calculate loan amount and advance percentage
        var amt = $('#tot_value').val();
        var advance = $('#ad_amt').val();
        var per = (advance / amt) * 100;
        $('#ad_perc').val(per.toFixed(1));

        var loan_amt = amt - advance;
        $('#loan_amt').val(loan_amt.toFixed(0));
    })

    $('#poss_type').change(function () {//to get due amount or due period
        var poss_type = $(this).val();
        if (poss_type == '1') {
            $('.due_amt').show();
            $('.due_period').hide();
        } else if (poss_type == '2') {
            $('.due_period').show();
            $('.due_amt').hide();
        } else {
            $('.due_amt').hide();
            $('.due_period').hide();
        }
    })



    //EMI Calculator
    // $('.icon-chevron-down1').click(function(){
    //     $('.emi_calculator').slideToggle();
    // })

    $('#get_emi').click(function () {//To get Due amount
        var a = $('#calc_loan_amt').val();
        var b = $('#calc_due_period').val();
        var c = $('#calc_int_rate').val()
        $('#calcCheck').hide();

        if (a != '' && b != '' && c != '') {
            var int_amt = a * (c * 0.01) * b;
            $('#calc_int_amt').val(int_amt);

            var tot_amt = Number(a) + Number(int_amt);
            $('#calc_tot_amt').val(tot_amt);

            var due_amt = tot_amt / b;
            due_amt = (due_amt).toFixed(2);
            $('#calc_due_amt').val(due_amt);
        } else {
            $('#calcCheck').show();
            setTimeout(function () {
                $('#calcCheck').fadeOut('fast');
            }, 2000);
        }
    })

    $('#submit_request').click(function () {
        var submit_btn = $(this);
        submit_btn.attr('disabled', true);
        validation(submit_btn);
    })

});// Document ready end



$(function () {//For Update
    var idupd = $('#id').val();
    if (idupd > 0) {
        var role_upd = $('#role_upd').val();
        var ag_id_upd = $('#ag_id_upd').val();
        if (ag_id_upd != '') {
            getresponsiblecolumn(role_upd, ag_id_upd);
        }
        if (role_upd == '2') {
            getAgentBasedLoanCategory(ag_id_upd)
        } else if (role_upd == '3') {
            var userid_upd = $('#userid_upd').val();
            getStaffBasedAgent(userid_upd);//create agent dropdown based on staff name usign user id load
        } else if (role_upd == '1') {
            getAllAgentDropdown();//for directors
        }

        var cus_id = $('#cus_id_upd').val();
        value = cus_id.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
        $('#cus_id').val(value);

        var pic = $('#pic_upd').val();
        $('#imgshow').attr('src', "uploads/request/customer/" + pic + " ");
        $('#pic').hide();// hide pic input box on update, because user not gonna upload again

        var state_upd = $('#state_upd').val();
        getDistrictDropdown(state_upd);
        var district_upd = $('#district_upd').val();
        getTalukDropdown(district_upd);
        var taluk_upd = $('#taluk_upd').val();
        getTalukBasedArea(taluk_upd);
        var area_upd = $('#area_upd').val();
        getAreaBasedSubArea(area_upd);
        var marital_upd = $('#marital_upd').val();
        if (marital_upd == 1) {
            $('.spouse').show();
        } else {
            $('.spouse').hide();
        }
        var loan_category_upd = $('#loan_category_upd').val();
        getSubCategory(loan_category_upd);
        var sub_category_upd = $('#sub_category_upd').val();
        getLoaninfo(sub_category_upd).then(function(){
            var tot_value_upd = $('#tot_value_upd').val();
            var ad_amt_upd = $('#ad_amt_upd').val();
            var ad_perc_upd = $('#ad_perc_upd').val();
            var loan_amt_upd = $('#loan_amt_upd').val();
            $('#tot_value').val(tot_value_upd);
            $('#ad_amt').val(ad_amt_upd);
            $('#ad_perc').val(ad_perc_upd);
            $('#loan_amt').val(loan_amt_upd);
        });

        getCategoryInfo(sub_category_upd);

        var poss_type_upd = $('#poss_type_upd').val();
        if (poss_type_upd == '1') {
            $('.due_amt').show();
            $('.due_period').hide();
        } else if (poss_type_upd == '2') {
            $('.due_period').show();
            $('.due_amt').hide();
        }

    } else {
        autocallFunctions();
    }
})

function autocallFunctions() {//For On load
    var role_load = $('#role_load').val();
    var ag_id_load = $('#ag_id_load').val();
    if (ag_id_load != '') {
        getresponsiblecolumn(role_load, ag_id_load);
    }

    if (role_load == '2') {
        getAgentBasedLoanCategory(ag_id_load)
    } else if (role_load == '3') {
        var user_id_load = $('#user_id_load').val();
        getStaffBasedAgent(user_id_load);//create agent dropdown based on staff name usign user id load
    } else if (role_load == '1') {
        getAllAgentDropdown();//for directors
    }
    getRequestCode();//Autocall for request code

    {//To Order Alphabetically
        var firstOption = $("#loan_category option:first-child");
        $("#loan_category").html($("#loan_category option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#loan_category").prepend(firstOption);
    }
}

//To get Reponsible Dropdown
function getresponsiblecolumn(role, ag_id) {
    $.ajax({
        url: 'requestFile/getResponsiblecolumn.php',
        data: { 'ag_id': ag_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            if (role != '' && role == '2') {
                if (response == '0') {
                    $('.responsible').show();
                } else {
                    $('.responsible').hide();
                }
            }
        }
    });
}

//Get Customer Details
function getCustomerDetails(cus_id) {
    $.ajax({
        url: 'requestFile/getCustomerDetail.php',
        data: { 'cus_id': cus_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            if (response['message'] == 'Existing') {
                var message = response['message'];
                $('#cus_data').removeAttr('value');
                $('#cus_data').attr('value', message);
                $('#cus_data').val(message);
                $('#cus_name').val(response['cus_name']);
                $('#dob').val(response['dob']);
                $('#gender').val(response['gender']);
                $('#age').val(response['age']);
                $('#state').val(response['state']);
                var StateSelected = $('#state').val()
                getDistrictDropdown(StateSelected);
                $('#district1').val(response['district']);
                $('#district').val(response['district']);
                var DistSelected = $('#district1').val();
                getTalukDropdown(DistSelected);
                $('#taluk1').val(response['taluk']);
                $('#taluk').val(response['taluk']);
                var talukselected = $('#taluk').val();
                getTalukBasedArea(talukselected);
                setTimeout(function () {
                    $('#area').val(response['area']);
                    var areaselected = $('#area').val();
                    getAreaBasedSubArea(areaselected);
                    setTimeout(function () {
                        $('#sub_area').val(response['sub_area']);
                    }, 1000);
                }, 1000);
                $('#address').val(response['address']);
                $('#mobile1').val(response['mobile1']);
                $('#mobile2').val(response['mobile2']);
                $('#father_name').val(response['father_name']);
                $('#mother_name').val(response['mother_name']);
                $('#marital').val(response['marital']);
                if (response['marital'] == '1') { $('.spouse').show(); } else { $('.spouse').hide(); }
                $('#spouse_name').val(response['spouse']);
                $('#occupation_type').val(response['occupation_type']);
                $('#occupation').val(response['occupation']);
                $('#img_exist').val(response['pic']);
                $('#imgshow').attr('src', "uploads/request/customer/" + response['pic'] + " ");
                $('#pic').hide()// hide pic input box on exisiting cus, because user will not upload again
            } else if (response['message'] == 'New') {
                var message = response['message'];
                $('#cus_data').removeAttr('value');
                $('#cus_data').attr('value', message);
                $('#cus_data').val(message);
                $('#cus_name').val('');
                $('#dob').val('');
                $('#gender').val('');
                $('#age').val('');
                $('#state').val('SelectState');
                $('#district1').val('');
                $('#district').val('Select District');
                $('#taluk1').val('');
                $('#taluk').val('Select Taluk');
                $('#area').val('');
                $('#sub_area').val('');
                $('#address').val('');
                $('#mobile1').val('');
                $('#mobile2').val('');
                $('#father_name').val('');
                $('#mother_name').val('');
                $('#marital').val('');
                $('#spouse_name').val('');
                $('.spouse').hide();
                $('#occupation_type').val('');
                $('#occupation').val('');
                $('#imgshow').attr('src', "img/avatar.png");
                $('#pic').show()// show pic input box on edit again if new customer
            }
        }
    });
}
//Get Request Code 
function getRequestCode() {
    $.ajax({
        url: 'requestFile/getRequestCode.php',
        type: "post",
        dataType: "json",
        data: {},
        cache: false,
        success: function (response) {
            var req_code = response;
            $('#req_code').val(req_code);
        }
    })
}

//get district dropdown
function getDistrictDropdown(StateSelected) {

    var optionsList;
    var htmlString = "<option value='Select District'>Select District</option>";
    {
        var TamilNadu = ["Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kancheepuram", "Kanniyakumari", "Karur", "Madurai", "Nagapattinam",
            "Namakkal", "Nilgiris", "Perambalur", "Pudukottai", "Ramanathapuram", "Salem", "Sivagangai", "Thanjavur", "Theni", "Thiruvallur", "Tiruvannamalai", "Thiruvarur",
            "Thoothukudi", "Tiruchirappalli", "Thirunelveli", "Vellore", "Viluppuram", "Virudhunagar", "Ariyalur", "Krishnagiri", "Tiruppur", "Chengalpattu", "Kallakurichi",
            "Ranipet", "Tenkasi", "Tirupathur", "Mayiladuthurai"];
        var Puducherry = ["Puducherry"];
    }//District list
    switch (StateSelected) {
        case "TamilNadu":
            optionsList = TamilNadu;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "SelectState":
            optionsList = [];
            break;
    }

    var district_upd = $('#district_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (district_upd != undefined && district_upd != '' && district_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#district").html(htmlString);
    $("#district1").val(district_upd);

    {//To Order Alphabetically
        var firstOption = $("#district option:first-child");
        $("#district").html($("#district option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#district").prepend(firstOption);
    }
}

//get Taluk Dropdown
function getTalukDropdown(DistSelected) {

    var optionsList;
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
    {
        var Chennai = ["Alandur", "Ambattur", "Aminjikarai", "Ayanavaram", "Egmore", "Guindy", "Madhavaram", "Madhuravoyal", "Mambalam", "Mylapore", "Perambur", "Purasavakkam", "Sholinganallur", "Thiruvottriyur", "Tondiarpet", "Velacherry"];
        var Coimbatore = ["Aanaimalai", "Annur", "Coimbatore(North)", "Coimbatore(South)", "Kinathukadavu", "Madukarai", "Mettupalayam", "Perur", "Pollachi", "Sulur", "Valparai"];
        var Cuddalore = ["Cuddalore", "Bhuvanagiri", "Chidambaram", "Kattumannarkoil", "Kurinjipadi", "Panruti", "Srimushnam", "Thittakudi", "Veppur", "Virudhachalam"];
        var Dharmapuri = ["Dharmapuri", "Harur", "Karimangalam", "Nallampalli", "Palacode", "Pappireddipatti", "Pennagaram"];
        var Dindigul = ["Atthur", "Dindigul (East)", "Dindigul (West)", "Guziliyamparai", "Kodaikanal", "Natham", "Nilakottai", "Oddanchatram", "Palani", "Vedasandur"];
        var Erode = ["Erode", "Anthiyur", "Bhavani", "Gobichettipalayam", "Kodumudi", "Modakurichi", "Nambiyur", "Perundurai", "Sathiyamangalam", "Thalavadi"];
        var Kancheepuram = ["Kancheepuram", "Kundrathur", "Sriperumbudur", "Uthiramerur", "Walajabad"];
        var Kanniyakumari = ["Agasteeswaram", "Kalkulam", "Killiyur", "Thiruvatar", "Thovalai", "Vilavankodu"];
        var Karur = ["Karur", "Aravakurichi", "Kadavur", "Krishnarayapuram", "Kulithalai", "Manmangalam", "Pugalur"];
        var Madurai = ["Kallikudi", "Madurai (East)", "Madurai (North)", "Madurai (South)", "Madurai (West)", "Melur", "Peraiyur", "Thirumangalam", "Thiruparankundram", "Usilampatti", "Vadipatti"];
        var Nagapattinam = ["Nagapattinam", "Kilvelur", "Thirukkuvalai", "Vedaranyam"];
        var Namakkal = ["Namakkal", "Kholli Hills", "Kumarapalayam", "Mohanoor", "Paramathi Velur", "Rasipuram", "Senthamangalam", "Tiruchengode"];
        var Nilgiris = ["Udagamandalam", "Coonoor", "Gudalur", "Kothagiri", "Kundah", "Pandalur"];
        var Perambalur = ["Perambalur", "Alathur", "Kunnam", "Veppanthattai"];
        var Pudukottai = ["Pudukottai", "Alangudi", "Aranthangi", "Avudiyarkoil", "Gandarvakottai", "Iluppur", "Karambakudi", "Kulathur", "Manamelkudi", "Ponnamaravathi", "Thirumayam", "Viralimalai"];
        var Ramanathapuram = ["Ramanathapuram", "Kadaladi", "Kamuthi", "Kezhakarai", "Mudukulathur", "Paramakudi", "Rajasingamangalam", "Rameswaram", "Tiruvadanai"];
        var Salem = ["Salem", "Attur", "Edapadi", "Gangavalli", "Kadaiyampatti", "Mettur", "Omalur", "Pethanayakanpalayam", "Salem South", "Salem West", "Sankari", "Vazhapadi", "Yercaud"];
        var Sivagangai = ["Sivagangai", "Devakottai", "Ilayankudi", "Kalaiyarkovil", "Karaikudi", "Manamadurai", "Singampunari", "Thirupuvanam", "Tirupathur"];
        var Thanjavur = ["Thanjavur", "Boothalur", "Kumbakonam", "Orathanadu", "Papanasam", "Pattukottai", "Peravurani", "Thiruvaiyaru", "Thiruvidaimaruthur"];
        var Theni = ["Theni", "Aandipatti", "Bodinayakanur", "Periyakulam", "Uthamapalayam"];
        var Thiruvallur = ["Thiruvallur", "Avadi", "Gummidipoondi", "Pallipattu", "Ponneri", "Poonamallee", "R.K. Pet", "Tiruthani", "Uthukottai"];
        var Tiruvannamalai = ["Thiruvannamalai", "Arni", "Chengam", "Chetpet", "Cheyyar", "Jamunamarathur", "Kalasapakkam", "Kilpennathur", "Polur", "Thandramet", "Vandavasi", "Vembakkam"];
        var Thiruvarur = ["Thiruvarur", "Kodavasal", "Koothanallur", "Mannargudi", "Nannilam", "Needamangalam", "Thiruthuraipoondi", "Valangaiman"];
        var Thoothukudi = ["Thoothukudi", "Eral", "Ettayapuram", "Kayathar", "Kovilpatti", "Ottapidaram", "Sattankulam", "Srivaikundam", "Tiruchendur", "Vilathikulam"];
        var Tiruchirappalli = ["Lalgudi", "Manachanallur", "Manapparai", "Marungapuri", "Musiri", "Srirangam", "Thottiam", "Thuraiyur", "Tiruchirapalli (West)", "Tiruchirappalli (East)", "Tiruverumbur"];
        var Thirunelveli = ["Tirunelveli", "Ambasamudram", "Cheranmahadevi", "Manur", "Nanguneri", "Palayamkottai", "Radhapuram", "Thisayanvilai"];
        var Vellore = ["Vellore", "Aanikattu", "Gudiyatham", "K V Kuppam", "Katpadi", "Pernambut"];
        var Viluppuram = ["Villupuram", "Gingee", "Kandachipuram", "Marakanam", "Melmalaiyanur", "Thiruvennainallur", "Tindivanam", "Vanur", "Vikravandi"];
        var Virudhunagar = ["Virudhunagar", "Aruppukottai", "Kariyapatti", "Rajapalayam", "Sathur", "Sivakasi", "Srivilliputhur", "Tiruchuli", "Vembakottai", "Watrap"];
        var Ariyalur = ["Ariyalur", "Andimadam", "Sendurai", "Udaiyarpalayam"];
        var Krishnagiri = ["Krishnagiri", "Anjetty", "Bargur", "Hosur", "Pochampalli", "Sulagiri", "Thenkanikottai", "Uthangarai"];
        var Tiruppur = ["Avinashi", "Dharapuram", "Kangeyam", "Madathukkulam", "Oothukuli", "Palladam", "Tiruppur (North)", "Tiruppur (South)", "Udumalaipettai"];
        var Chengalpattu = ["Chengalpattu", "Cheyyur", "Maduranthakam", "Pallavaram", "Tambaram", "Thirukalukundram", "Tiruporur", "Vandalur"];
        var Kallakurichi = ["Kallakurichi", "Chinnaselam", "Kalvarayan Hills", "Sankarapuram", "Tirukoilur", "Ulundurpet"];
        var Ranipet = ["Arakkonam", "Arcot", "Kalavai", "Nemili", "Sholingur", "Walajah"];
        var Tenkasi = ["Tenkasi", "Alangulam", "Kadayanallur", "Sankarankovil", "Shenkottai", "Sivagiri", "Thiruvengadam", "Veerakeralampudur"];
        var Tirupathur = ["Tirupathur", "Ambur", "Natrampalli", "Vaniyambadi"];
        var Mayiladuthurai = ["Mayiladuthurai", "Kuthalam", "Sirkali", "Tharangambadi"];
        var Puducherry = ["Puducherry", "Oulgaret", "Villianur", "Bahour", "Karaikal", "Thirunallar", "Mahe", "Yanam"];

    }//taluk list
    switch (DistSelected) {
        case "Ariyalur":
            optionsList = Ariyalur;
            break;
        case "Chengalpattu":
            optionsList = Chengalpattu;
            break;
        case "Chennai":
            optionsList = Chennai;
            break;
        case "Coimbatore":
            optionsList = Coimbatore;
            break;
        case "Dharmapuri":
            optionsList = Dharmapuri;
            break;
        case "Erode":
            optionsList = Erode;
            break;
        case "Cuddalore":
            optionsList = Cuddalore;
            break;
        case "Dindigul":
            optionsList = Dindigul;
            break;
        case "Kallakurichi":
            optionsList = Kallakurichi;
            break;
        case "Kanniyakumari":
            optionsList = Kanniyakumari;
            break;
        case "Krishnagiri":
            optionsList = Krishnagiri;
            break;
        case "Nagapattinam":
            optionsList = Nagapattinam;
            break;
        case "Perambalur":
            optionsList = Perambalur;
            break;
        case "Ramanathapuram":
            optionsList = Ramanathapuram;
            break;
        case "Salem":
            optionsList = Salem;
            break;
        case "Tenkasi":
            optionsList = Tenkasi;
            break;
        case "Theni":
            optionsList = Theni;
            break;
        case "Thirunelveli":
            optionsList = Thirunelveli;
            break;
        case "Thiruvarur":
            optionsList = Thiruvarur;
            break;
        case "Tirupathur":
            optionsList = Tirupathur;
            break;
        case "Tiruvannamalai":
            optionsList = Tiruvannamalai;
            break;
        case "Vellore":
            optionsList = Vellore;
            break;
        case "Virudhunagar":
            optionsList = Virudhunagar;
            break;
        case "Kancheepuram":
            optionsList = Kancheepuram;
            break;
        case "Karur":
            optionsList = Karur;
            break;
        case "Madurai":
            optionsList = Madurai;
            break;
        case "Namakkal":
            optionsList = Namakkal;
            break;
        case "Pudukottai":
            optionsList = Pudukottai;
            break;
        case "Ranipet":
            optionsList = Ranipet;
            break;
        case "Sivagangai":
            optionsList = Sivagangai;
            break;
        case "Thanjavur":
            optionsList = Thanjavur;
            break;
        case "Nilgiris":
            optionsList = Nilgiris;
            break;
        case "Thiruvallur":
            optionsList = Thiruvallur;
            break;
        case "Thoothukudi":
            optionsList = Thoothukudi;
            break;
        case "Tiruppur":
            optionsList = Tiruppur;
            break;
        case "Tiruchirappalli":
            optionsList = Tiruchirappalli;
            break;
        case "Viluppuram":
            optionsList = Viluppuram;
            break;
        case "Mayiladuthurai":
            optionsList = Mayiladuthurai;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "Select District":
            optionsList = [];
            break;
    }
    var taluk_upd = $('#taluk_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (taluk_upd != undefined && taluk_upd != '' && taluk_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#taluk").html(htmlString);
    $("#taluk1").val(taluk_upd);

    {//To Order Alphabetically
        var firstOption = $("#taluk option:first-child");
        $("#taluk").html($("#taluk option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#taluk").prepend(firstOption);
    }
}

//Get Taluk Based Area
function getTalukBasedArea(talukselected) {
    var area_upd = $('#area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledAreaName.php',
        type: 'post',
        data: { 'talukselected': talukselected },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#area").empty();
            $("#area").append("<option value=''>" + 'Select Area' + "</option>");
            for (var i = 0; i < len; i++) {
                var area_id = response[i]['area_id'];
                var area_name = response[i]['area_name'];
                var selected = '';
                if (area_upd != undefined && area_upd != '' && area_upd == area_id) {
                    selected = 'selected';
                }
                $("#area").append("<option value='" + area_id + "' " + selected + ">" + area_name + "</option>");
            }

            $("#area_name").val('');
            $("#area_id").val('');

            {//To Order Alphabetically
                var firstOption = $("#area option:first-child");
                $("#area").html($("#area option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#area").prepend(firstOption);
            }
        }
    });
}

//Get Area Based Sub Area
function getAreaBasedSubArea(area) {
    var sub_area_upd = $('#sub_area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledSubArea.php',
        type: 'post',
        data: { 'area': area },
        dataType: 'json',
        success: function (response) {

            $('#sub_area').empty();
            $('#sub_area').append("<option value='' >Select Sub Area</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_area_upd != undefined && sub_area_upd != '' && sub_area_upd == response[i]['sub_area_id']) {
                    selected = 'selected';
                }
                $('#sub_area').append("<option value='" + response[i]['sub_area_id'] + "' " + selected + ">" + response[i]['sub_area_name'] + " </option>");
            }
        }
    });
}

//Fetch Sub Category Based on loan category
function getSubCategory(loan_cat) {
    var sub_category_upd = $('#sub_category_upd').val();
    $.ajax({
        url: 'requestFile/getSingleSubCategory.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: { 'loan_cat': loan_cat },
        success: function (response) {

            $('#sub_category').empty();
            $('#sub_category').append("<option value='' >Select Sub Category</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_category_upd != undefined && sub_category_upd != '' && sub_category_upd == response[i]['sub_category_name']) {
                    selected = 'selected';
                }
                $('#sub_category').append("<option value='" + response[i]['sub_category_name'] + "' " + selected + ">" + response[i]['sub_category_name'] + " </option>");
            }
            {//To Order Alphabetically
                var firstOption = $("#sub_category option:first-child");
                $("#sub_category").html($("#sub_category option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#sub_category").prepend(firstOption);
            }
        }
    })
}

//Fetch loan Details based on category select
function getLoaninfo(sub_cat_id) {
    let cus_id = $('#cus_id').val();
    return $.ajax({
        url: 'requestFile/getLoanInfo.php',
        data: { 'sub_cat_id': sub_cat_id, "cus_id": cus_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            if (response['advance'] == 'Yes') {
                $('.advance_yes').show();
                $('#tot_value').val('');
                $('#ad_amt').val('');
                $('#ad_perc').val('');
                $('.loan_amt').show();
                $('#loan_amt').val('');
                $('#loan_amt').attr('readonly', true);

                $('#tot_value').unbind('blur').blur(function () {// to calculate loan amount ant advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var per = (advance / amt) * 100;
                    $('#ad_perc').val(per.toFixed(1));

                    var loan_amt = amt - advance;
                    if (loan_amt <= response['loan_limit']) {
                        $('#loan_amt').val(loan_amt.toFixed(0));
                    } else {
                        alert('Please Enter Lesser amount!');
                        $('#tot_value').val('');
                        $('#loan_amt').val('');
                    }
                })

                $('#ad_amt').unbind('blur').blur(function () {//To calculate loan amount and advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var per = (advance / amt) * 100;
                    $('#ad_perc').val(per.toFixed(1));

                    var loan_amt = amt - advance;
                    $('#loan_amt').val(loan_amt.toFixed(0));
                })

            } else if (response['advance'] == 'No') {
                $('.advance_yes').hide();
                $('#tot_value').val('');
                $('#ad_amt').val('');
                $('#ad_perc').val('');
                $('.loan_amt').show();
                $('#loan_amt').val('');
                $('#loan_amt').removeAttr('readonly');

                $('#loan_amt').unbind('blur').blur(function () {// to check loan amount not exceed loan limit
                    let loan_amt = $(this).val();
                    if (parseInt(loan_amt) <= parseInt(response['loan_limit'])) {
                        $('#loan_amt').val(loan_amt.toFixed(0));
                    } else {
                        alert('Please Enter Lesser amount!');
                        $('#loan_amt').val('');
                    }
                })

            } else {
                $('.advance_yes').hide();
                $('#tot_value').val('');
                $('#ad_amt').val('');
                $('#ad_perc').val('');
                $('.loan_amt').hide();
                $('#loan_amt').val('');
                $('#loan_amt').attr('readonly', true);
            }
        }
    })
}

//Fetch Agent dropdown based on staffs from manage user
function getStaffBasedAgent(user_id_load) {
    var ag_id_upd = $('#ag_id_upd').val();
    $.ajax({
        url: 'requestFile/getStaffBasedAgent.php',
        data: { 'user_id': user_id_load },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#agent').empty();
            $('#agent').append("<option value='' >Select Agent Name</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (ag_id_upd != 'undefined' && ag_id_upd != '' && ag_id_upd == response[i]['ag_id']) {
                    selected = "selected";
                }
                $('#agent').append("<option value='" + response[i]['ag_id'] + "' " + selected + ">" + response[i]['ag_name'] + " </option>");
            }
            {//To Order Alphabetically
                var firstOption = $("#agent option:first-child");
                $("#agent").html($("#agent option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#agent").prepend(firstOption);
            }
        }
    })
}
//Fetch all agent list for director login
function getAllAgentDropdown() {
    var ag_id_upd = $('#ag_id_upd').val();
    $.ajax({
        url: 'requestFile/getAllAgentDropdown.php',
        data: {},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#agent').empty();
            $('#agent').append("<option value='' >Select Agent Name</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (ag_id_upd != 'undefined' && ag_id_upd != '' && ag_id_upd == response[i]['ag_id']) {
                    selected = 'selected';
                }
                $('#agent').append("<option value='" + response[i]['ag_id'] + "' " + selected + ">" + response[i]['ag_name'] + " </option>");
            }
            {//To Order Alphabetically
                var firstOption = $("#agent option:first-child");
                $("#agent").html($("#agent option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#agent").prepend(firstOption);
            }
        }
    })
}
//Fetch Loan category list Based on Agent
function getAgentBasedLoanCategory(ag_id) {
    var loan_category_upd = $('#loan_category_upd').val();
    $.ajax({
        url: 'requestFile/getAgentBasedLoancat.php',
        data: { 'ag_id': ag_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#loan_category').empty();
            $('#loan_category').append("<option value='' >Select Loan Category</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (loan_category_upd != undefined && loan_category_upd != '' && loan_category_upd == response[i]['loan_category_id']) {
                    selected = 'selected';
                }
                $('#loan_category').append("<option value='" + response[i]['loan_category_id'] + "' " + selected + " >" + response[i]['loan_category_name'] + " </option>");
            }
            {//To Order Alphabetically
                var firstOption = $("#loan_category option:first-child");
                $("#loan_category").html($("#loan_category option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#loan_category").prepend(firstOption);
            }
        }
    })
}

//Category info based on sub category
function getCategoryInfo(sub_cat) {
    var idupd = $('#id').val();
    let loan_category = $('#loan_category').val()
    if (idupd > 0) {
        var getCategoryInfo = $('#getCategoryInfo_upd').val().split(',');
    } else { var getCategoryInfo = undefined; }
    $.ajax({
        url: 'requestFile/getCategoryInfo.php',
        data: { 'sub_cat': sub_cat ,'loan_category':loan_category },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('.category_info .card-body .row').empty();
            $('.category_info .card-body .row').prepend('<table id="moduleTable" class="table custom-table"><tbody><tr>');
            if (response.length != 0) {
                for (var i = 0; i < response.length; i++) {
                    category_info = '';
                    // if(getCategoryInfo != undefined){
                    //     category_info = getCategoryInfo[i];
                    // }
                    $('.category_info .card-body .row table tbody tr').append("<td><label for='disabledInput'>" + response[i]['loan_category_ref_name'] + "</label><span class='required'>&nbsp;*</span><input type='text' class='form-control' id='category_info' name='category_info[]' pattern='[A-Za-z0-9\\s\\W]*' value='" + category_info + "' tabindex='37' required placeholder='Enter " + response[i]['loan_category_ref_name'] + "'></td>");
                    $('.category_info').show();

                }
                $('.category_info .card-body .row table tbody tr').append(`<td><button type="button" id="add_category_info[]" name="add_category_info" 
                class="btn btn-primary add_category_info" tabindex='37'>Add</button> </td><td><span class='icon-trash-2 deleterow' id='deleterow' tabindex='37'> </span></td>
                </tr></tbody></table>`);

                category_content = $('#moduleTable tbody').html(); //To get the appended category list

                // unbind the event handler
                $(document).off('click', '.add_category_info');
                $(document).on('click', '.add_category_info', function () {
                    console.log(category_content)
                    $('#moduleTable tbody').append(category_content);
                });

                // remove delete option for last child
                $('#deleterow:last').filter(':last').removeClass('deleterow');

                // unbind the event handler
                $(document).off('click', '.deleterow');
                $(document).on('click', '.deleterow', function () {
                    $(this).parent().parent().remove();
                });

                if (getCategoryInfo != undefined) {
                    for (var i = 0; i < getCategoryInfo.length - 1; i++) {
                        if (response.length < getCategoryInfo.length) {
                            $('#moduleTable tbody').append(category_content)
                        }
                    }
                    $('#moduleTable tbody input').each(function (index) {
                        $(this).val(getCategoryInfo[index]);
                    });
                }

            } else {
                $('.category_info').hide();
            }
        }
    })
}

function callresetCustomerStatus(cus_id) {
    //To get loan sub Status
    var pending_arr = [];
    var od_arr = [];
    var due_nil_arr = [];
    var closed_arr = [];
    var balAmnt = [];
    $.ajax({
        url: 'collectionFile/resetCustomerStatus.php',
        data: { 'cus_id': cus_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            if (response.length != 0) {

                for (var i = 0; i < response['pending_customer'].length; i++) {
                    pending_arr[i] = response['pending_customer'][i]
                    od_arr[i] = response['od_customer'][i]
                    due_nil_arr[i] = response['due_nil_customer'][i]
                    closed_arr[i] = response['closed_customer'][i]
                    balAmnt[i] = response['balAmnt'][i]
                }
                var pending_sts = pending_arr.join(',');
                $('#pending_sts').val(pending_sts);
                var od_sts = od_arr.join(',');
                $('#od_sts').val(od_sts);
                var due_nil_sts = due_nil_arr.join(',');
                $('#due_nil_sts').val(due_nil_sts);
                var closed_sts = closed_arr.join(',');
                $('#closed_sts').val(closed_sts);
                var bal_amt = balAmnt.join(',');
                $('#bal_amt').val(bal_amt);
            };
        }
    });
}

//Validations
function validation(submit_btn) {
    var idupd = $('#id').val();
    var role = $('#role_load').val();
    if (role == '1') {
        var responsible = $('#responsible').val();
        if (responsible == '') {
            $('#responsibleCheck').show();
            event.preventDefault();
        } else {
            $('#responsibleCheck').hide();
        }

        var declaration = $('#declaration').val();
        if (declaration == '') {
            $('#declarationCheck').show();
            event.preventDefault();
        } else {
            $('#declarationCheck').hide();
        }
    } else if (role == '2') {

        var responsible = $('#responsible').val();
        if (responsible == '' && $('.responsible').css('display') != 'none') {
            $('#responsibleCheck').show();
            event.preventDefault();
        } else {
            $('#responsibleCheck').hide();
        }

        var declaration = $('#declaration').val();
        if (declaration == '') {
            $('#declarationCheck').show();
            event.preventDefault();
        } else {
            $('#declarationCheck').hide();
        }

    } else if (role == '3') {
        var remark = $('#remark').val();
        if (remark == '') {
            $('#remarkCheck').show();
            event.preventDefault();
        } else {
            $('#remarkCheck').hide();
        }
    }

    var cus_id = $('#cus_id').val(); var cus_name = $('#cus_name').val(); var dob = $('#dob').val(); var gender = $('#gender').val(); var pic = $('#pic').val(); var state = $('#state').val();
    var district = $('#district1').val(); var taluk = $('#taluk1').val(); var area = $('#area').val(); var sub_area = $('#sub_area').val(); var address = $('#address').val(); var mobile1 = $('#mobile1').val();var mobile2 = $('#mobile2').val();
    var father_name = $('#father_name').val(); var mother_name = $('#mother_name').val(); var marital = $('#marital').val(); var spouse_name = $('#spouse_name').val(); var occupation_type = $('#occupation_type').val();
    var occupation = $('#occupation').val(); var loan_category = $('#loan_category').val(); var sub_category = $('#sub_category').val(); var tot_value = $('#tot_value').val();
    var ad_amt = $('#ad_amt').val(); var ad_perc = $('#ad_perc').val(); var loan_amt = $('#loan_amt').val(); var poss_type = $('#poss_type').val(); var due_amt = $('#due_amt').val();
    var due_period = $('#due_period').val();
    if (!cus_id) {
        event.preventDefault();
        $('#cusidCheck').show();
    } else {
        $('#cusidCheck').hide();
    }
    if (!cus_name) {
        event.preventDefault();
        $('#cusnameCheck').show();
    } else {
        $('#cusnameCheck').hide();
    }
    if (!dob) {
        event.preventDefault();
        $('#dobCheck').show();
    } else {
        $('#dobCheck').hide();
    }
    if (!gender) {
        event.preventDefault();
        $('#genderCheck').show();
    } else {
        $('#genderCheck').hide();
    }
    if (idupd == undefined) {

        if (pic == '' && $('#pic').attr('style') != 'display: none;') {
            event.preventDefault();
            $('#picCheck').show();
        } else {
            $('#picCheck').hide();
        }
    }
    if (state == 'SelectState') {
        event.preventDefault();
        $('#stateCheck').show();
    } else {
        $('#stateCheck').hide();
    }
    if (!district) {
        event.preventDefault();
        $('#districtCheck').show();
    } else {
        $('#districtCheck').hide();
    }
    if (!taluk ) {
        event.preventDefault();
        $('#talukCheck').show();
    } else {
        $('#talukCheck').hide();
    }
    if (!area)  {
        event.preventDefault();
        $('#areaCheck').show();
    } else {
        $('#areaCheck').hide();
    }
    if (!sub_area) {
        event.preventDefault();
        $('#subareaCheck').show();
    } else {
        $('#subareaCheck').hide();
    }
    if (!address) {
        event.preventDefault();
        $('#addressCheck').show();
    } else {
        $('#addressCheck').hide();
    }
    if (!mobile1  || mobile1.length < 10) {
        event.preventDefault();
        $('#mobile1Check').show();
    } else {
        $('#mobile1Check').hide();
    }
    if (mobile2 != '' && mobile2.length < 10) {
        event.preventDefault();
        $('#mobile2Check').show();
    } else {
        $('#mobile2Check').hide();
    }
    if (!father_name) {
        event.preventDefault();
        $('#fathernameCheck').show();
    } else {
        $('#fathernameCheck').hide();
    }
    if (!mother_name) {
        event.preventDefault();
        $('#mothernameCheck').show();
    } else {
        $('#mothernameCheck').hide();
    }
    if (!marital) {
        event.preventDefault();
        $('#maritalCheck').show();
    } else {
        $('#maritalCheck').hide();
        if (marital == '1' && spouse_name == '') {
            event.preventDefault();
            $('#spousenameCheck').show();
        } else {
            $('#spousenameCheck').hide();
        }
    }
    if (!occupation_type) {
        event.preventDefault();
        $('#occupationtypeCheck').show();
    } else {
        $('#occupationtypeCheck').hide();
    }
    if (!occupation) {
        event.preventDefault();
        $('#occupationCheck').show();
    } else {
        $('#occupationCheck').hide();
    }
    if (!loan_category) {
        event.preventDefault();
        $('#loancategoryCheck').show();
    } else {
        $('#loancategoryCheck').hide();
    }
    if (!sub_category) {
        event.preventDefault();
        $('#subcategoryCheck').show();
    } else {
        $('#subcategoryCheck').hide();
        if (tot_value == '' && $('.advance_yes').css('display') != "none") {
            event.preventDefault();
            $('#totvalueCheck').show();
        } else {
            $('#totvalueCheck').hide();
        }
        if (ad_amt == '' && $('.advance_yes').css('display') != "none") {
            event.preventDefault();
            $('#adamtCheck').show();
        } else {
            $('#adamtCheck').hide();
        }
        if (loan_amt == '') {
            event.preventDefault();
            $('#loanamtCheck').show();
        } else {
            $('#loanamtCheck').hide();
        }
    }
    if (!poss_type) {
        event.preventDefault();
        $('#posstypeCheck').show();
    } else {
        $('#posstypeCheck').hide();
        if (poss_type == '1') {
            if (due_amt == '') {
                event.preventDefault();
                $('#dueamtCheck').show();
            } else {
                $('#dueamtCheck').hide();
                $('#due_period').val('');
            }
        } else if (poss_type == '2') {
            if (due_period == '') {
                event.preventDefault();
                $('#dueperiodCheck').show();
            } else {
                $('#dueperiodCheck').hide();
                $('#due_amt').val('');
            }
        }
    }

    submit_btn.removeAttr('disabled');

}