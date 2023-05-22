//Multi select initialization
    const branchMultiselect = new Choices('#branch_id1', {
        removeItemButton: true,
        noChoicesText: 'Select Branch Name',
        });
    const agentMultiselect = new Choices('#agent1', {
        removeItemButton: true,
        noChoicesText: 'Select Agent Name',
        });
    const lineMultiselect = new Choices('#line1', {
        removeItemButton: true,
        noChoicesText: 'Select Line Name',
        });
    const groupMultiselect = new Choices('#group1', {
        removeItemButton: true,
        noChoicesText: 'Select Group Name',
        });
    
// Document is ready
$(document).ready(function () {

    {//To Order role Alphabetically
        var firstOption = $("#role option:first-child");
        $("#role").html($("#role option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#role").prepend(firstOption);
    }
    {//To Order ag_name Alphabetically
        var firstOption = $("#ag_name option:first-child");
        $("#ag_name").html($("#ag_name option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#ag_name").prepend(firstOption);
    }
    {//To Order role_type Alphabetically
        var firstOption = $("#role_type option:first-child");
        $("#role_type").html($("#role_type option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#role_type").prepend(firstOption);
    }

    $('#role').change(function(){
        
        $('.userInfoTable').hide();

        $('#company_id').val('');
        $('#company_name').val('');
        branchMultiselect.clearStore();
        lineMultiselect.clearStore();
        groupMultiselect.clearStore();

        var role = $('#role').val();
        getRoleBasedDetails(role);
    });

    $('#role_type').change(function(){
        
        $('.userInfoTable').hide();
        
        $('#company_id').val('');
        $('#company_name').val('');
        branchMultiselect.clearStore();
        lineMultiselect.clearStore();
        groupMultiselect.clearStore();

        var role = $('#role').val();
        var role_type = $('#role_type').val();
        getRoleTypeBasedDetails(role,role_type)
    });

    $('#dir_name').change(function(){
        var dir_id = $('#dir_name').val();
        geDirectorDetails(dir_id);
        
    });

    $('#ag_name').change(function(){
        var ag_id = $('#ag_name').val();
        getAgentDetails(ag_id);
    });

    $('#staff_name').change(function(){
        var staff_id = $('#staff_name').val();
        getStaffDetails(staff_id);
    });

    $('#cnf_password').keyup(function(){
        var pass = $('#password').val();
        var cnf_pass = $('#cnf_password').val();
        if(pass != cnf_pass){
            $('#passworkCheck').show();
            $('#cnf_password').css("border", "1px solid red");
        }else{
            $('#cnf_password').css("border", "");
            $('#passworkCheck').hide();
        }
    });

    $('#branch_id1').change(function(){
        var branch_id1 = branchMultiselect.getValue();
        var branch_id = '';
        for(var i = 0 ; i< branch_id1.length; i++){
            if (i > 0) {
                branch_id += ',';
            }
            branch_id += branch_id1[i].value;
        }
        // var arr = branch_id.split(",");
        // arr.sort(function(a,b){return a-b});
		// var sortedStr = arr.join(",");
        // $('#branch_id').val(sortedStr);

        getLineDropdown(branch_id);
        getGroupDropdown(branch_id);
        
    })

    $('#agent1').change(function(){
        var agent1 = agentMultiselect.getValue();
        var agentforstaff = '';
        for(var i = 0 ; i< agent1.length; i++){
            if (i > 0) {
                agentforstaff += ',';
            }
            agentforstaff += agent1[i].value;
        }
        var arr = agentforstaff.split(",");
        arr.sort(function(a,b){return a-b});
		var sortedStr = arr.join(",");

        $('#agentforstaff').val(sortedStr);
        
    })

    //modules checkbox events
    $("#adminmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.admin-checkbox");
        var adminmodule = document.querySelector('#adminmodule');
        checkbox(checkboxesToEnable,adminmodule);
    });

    $("#mastermodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.master-checkbox");
        var mastermodule = document.querySelector('#mastermodule');
        checkbox(checkboxesToEnable,mastermodule);
    });
    
    $("#requestmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.request-checkbox");
        var requestmodule = document.querySelector('#requestmodule');
        checkbox(checkboxesToEnable,requestmodule);
    });

    $("#verificationmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.verification-checkbox");
        var verificationmodule = document.querySelector('#verificationmodule');
        checkbox(checkboxesToEnable,verificationmodule);
    });

    $("#approvalmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.approval-checkbox");
        var approvalmodule = document.querySelector('#approvalmodule');
        checkbox(checkboxesToEnable,approvalmodule);
    });

    $("#acknowledgementmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.acknowledgement-checkbox");
        var acknowledgementmodule = document.querySelector('#acknowledgementmodule');
        checkbox(checkboxesToEnable,acknowledgementmodule);
    });
    
    $("#loanissuemodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.loan_issue-checkbox");
        var loanissuemodule = document.querySelector('#loanissuemodule');
        checkbox(checkboxesToEnable,loanissuemodule);
    });
    
    $("#collectionmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.collection-checkbox");
        var collectionmodule = document.querySelector('#collectionmodule');
        checkbox(checkboxesToEnable,collectionmodule);
    });
    
    $("#closedmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.closed-checkbox");
        var closedmodule = document.querySelector('#closedmodule');
        checkbox(checkboxesToEnable,closedmodule);
    });
    
    $("#nocmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.noc-checkbox");
        var nocmodule = document.querySelector('#nocmodule');
        checkbox(checkboxesToEnable,nocmodule);
    });

    $("#concernmodule").on("change", function() {
        const checkboxesToEnable = document.querySelectorAll("input.concern-checkbox");
        var concernmodule = document.querySelector('#concernmodule');
        checkbox(checkboxesToEnable,concernmodule);
    });

    $('#submit_manage_user').click(function(){
        
        
        var branch_id1 = branchMultiselect.getValue();
        var branch_id = '';
        for(var i = 0 ; i< branch_id1.length; i++){
            if (i > 0) {
                branch_id += ',';
            }
            branch_id += branch_id1[i].value;
        }
        var arr = branch_id.split(",");
        arr.sort(function(a,b){return a-b});
		var sortedStr = arr.join(",");
        $('#branch_id').val(sortedStr);

        var agent1 = agentMultiselect.getValue();
        var agentforstaff = '';
        for(var i = 0 ; i< agent1.length; i++){
            if (i > 0) {
                agentforstaff += ',';
            }
            agentforstaff += agent1[i].value;
        }
        var arr = agentforstaff.split(",");
        arr.sort(function(a,b){return a-b});
		var sortedStr = arr.join(",");

        $('#agentforstaff').val(sortedStr);
        
        var line1 = lineMultiselect.getValue();
        var line = '';
        for(var i = 0 ; i< line1.length; i++){
            if (i > 0) {
                line += ',';
            }
            line += line1[i].value;
        }
        var arr = line.split(",");
        arr.sort(function(a,b){return a-b});
		var sortedStr = arr.join(",");
        $('#line').val(sortedStr);
        var line = $('#line').val();
        var role = $('#role').val();
        if(line == '' && role != '2'){event.preventDefault();$('#lineCheck').show();}else{$('#lineCheck').hide();}
        
        var group1 = groupMultiselect.getValue();
        var group = '';
        for(var i = 0 ; i< group1.length; i++){
            if (i > 0) {
                group += ',';
            }
            group += group1[i].value;
        }
        var arr = group.split(",");
        arr.sort(function(a,b){return a-b});
		var sortedStr = arr.join(",");
        $('#group').val(sortedStr);
        var group = $('#group').val();
        if(group == ''){event.preventDefault();$('#groupCheck').show();}else{$('#groupCheck').hide();}

        validation();
    })
});


$(function(){
    
    var user_id_upd = $('#user_id_upd').val();
    if(user_id_upd > 0){
        var role_upd = $('#role_upd').val();
        var role_type_upd = $('#role_type_upd').val();
        var dir_id_upd = $('#dir_id_upd').val();
        var ag_id_upd = $('#ag_id_upd').val();
        var staff_id_upd = $('#staff_id_upd').val();
        var company_id_upd = $('#company_id_upd').val();
        var branch_id_upd = $('#branch_id_upd').val();
        $('#password').attr('type','text');
        $('#cnf_password').attr('type','text');
        
        getAgentDropdown(company_id_upd);
        getRoleBasedDetails(role_upd);
        if(role_upd == '1'){
            $('#role_type').val(role_type_upd);
            getRoleTypeBasedDetails(role_upd,role_type_upd)
            geDirectorDetails(dir_id_upd)
        }else if(role_upd == '2'){
            getAgentDetails(ag_id_upd);
        }else if(role_upd == '3'){
            getRoleTypeBasedDetails(role_upd,role_type_upd);
            getStaffDetails(staff_id_upd);
        }
        getLineDropdown(branch_id_upd);
        getGroupDropdown(branch_id_upd);

        var mastermodule = document.getElementById('mastermodule');
        var adminmodule = document.getElementById('adminmodule');
        var requestmodule = document.getElementById('requestmodule');
        var verificationmodule = document.getElementById('verificationmodule');
        var approvalmodule = document.getElementById('approvalmodule');
        var acknowledgementmodule = document.getElementById('acknowledgementmodule');
        var loanissuemodule = document.getElementById('loanissuemodule');
        var collectionmodule = document.getElementById('collectionmodule');
        var closedmodule = document.getElementById('closedmodule');
        var nocmodule = document.getElementById('nocmodule');
        var concernmodule = document.getElementById('concernmodule');
        if(mastermodule.checked){const checkboxesToEnable = document.querySelectorAll("input.master-checkbox");var mastermodule = document.querySelector('#mastermodule');checkbox(checkboxesToEnable,mastermodule);}
        if(adminmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.admin-checkbox");var adminmodule = document.querySelector('#adminmodule');checkbox(checkboxesToEnable,adminmodule);}
        if(requestmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.request-checkbox");var requestmodule = document.querySelector('#requestmodule');checkbox(checkboxesToEnable,requestmodule);}
        if(verificationmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.verification-checkbox");var verificationmodule = document.querySelector('#verificationmodule');checkbox(checkboxesToEnable,verificationmodule);}
        if(approvalmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.approval-checkbox");var approvalmodule = document.querySelector('#approvalmodule');checkbox(checkboxesToEnable,approvalmodule);}
        if(acknowledgementmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.acknowledgement-checkbox");var acknowledgementmodule = document.querySelector('#acknowledgementmodule');checkbox(checkboxesToEnable,acknowledgementmodule);}
        if(loanissuemodule.checked){const checkboxesToEnable = document.querySelectorAll("input.loan_issue-checkbox");var loanissuemodule = document.querySelector('#loanissuemodule');checkbox(checkboxesToEnable,loanissuemodule);}
        if(collectionmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.collection-checkbox");var collectionmodule = document.querySelector('#collectionmodule');checkbox(checkboxesToEnable,collectionmodule);}
        if(closedmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.closed-checkbox");var closedmodule = document.querySelector('#closedmodule');checkbox(checkboxesToEnable,closedmodule);}
        if(nocmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.noc-checkbox");var nocmodule = document.querySelector('#nocmodule');checkbox(checkboxesToEnable,nocmodule);}
        if(concernmodule.checked){const checkboxesToEnable = document.querySelectorAll("input.concern-checkbox");var concernmodule = document.querySelector('#concernmodule');checkbox(checkboxesToEnable,concernmodule);}
    }else{

    }
})

//Dropdowns
//get Staff  Type dropdown
function getStaffTypeDropdown(){
    var role_type_upd = $('#role_type_upd').val();
    $.ajax({
        url: 'staffCreation/ajaxGetStaffType.php',
        type: 'post',
        data: {},
        dataType: 'json',
        success:function(response){

            var len = response.length;
            $("#role_type").empty();
            $("#role_type").append("<option value=''>Select Role Type</option>");
            for(var i = 0; i<len; i++){
                var staff_type_id = response[i]['staff_type_id'];
                var staff_type_name = response[i]['staff_type_name'];
                var selected = '';
                if(role_type_upd != '' && role_type_upd == staff_type_id){
                    selected = 'selected';
                }
                $("#role_type").append("<option value='"+staff_type_id+"' "+selected+">"+staff_type_name+"</option>");
            }
            {//To Order role_type Alphabetically
                var firstOption = $("#role_type option:first-child");
                $("#role_type").html($("#role_type option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#role_type").prepend(firstOption);
            }
        }
    });
}

//get Director Name dropdown
function getDirectorName(dir_type){
    var dir_id_upd = $('#dir_id_upd').val();
    $.ajax({
        url: 'manageUser/ajaxGetDirectorName.php',
        type: 'post',
        data: {'dir_type':dir_type},
        dataType: 'json',
        success:function(response){
            var len = response.length;
            $("#dir_name").empty();
            $("#dir_name").append("<option value=''>Select Director Name</option>");
            for(var i = 0; i<len; i++){
                var dir_id = response[i]['dir_id'];
                var dir_name = response[i]['dir_name'];
                var selected = '';
                if(dir_id_upd != '' && dir_id_upd == dir_id){
                    selected = 'selected';
                }
                $("#dir_name").append("<option value='"+dir_id+"' "+selected+">"+dir_name+"</option>");
            }
            {//To Order dir_name Alphabetically
                var firstOption = $("#dir_name option:first-child");
                $("#dir_name").html($("#dir_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#dir_name").prepend(firstOption);
            }
        }
    });
}

//get Staff Name dropdown
function getStaffName(role_type){
    var staff_id_upd = $('#staff_id_upd').val();
    $.ajax({
        url: 'manageUser/ajaxGetStaffName.php',
        type: 'post',
        data: {'role_type':role_type},
        dataType: 'json',
        success:function(response){

            var len = response.length;
            $("#staff_name").empty();
            $("#staff_name").append("<option value=''>Select Staff Name</option>");
            for(var i = 0; i<len; i++){
                var staff_id = response[i]['staff_id'];
                var staff_name = response[i]['staff_name'];
                var selected = '';
                if(staff_id_upd != '' && staff_id_upd == staff_id){
                    selected = 'selected';
                }
                $("#staff_name").append("<option value='"+staff_id+"' "+selected+">"+staff_name+"</option>");
            }
            {//To Order staff_name Alphabetically
                var firstOption = $("#staff_name option:first-child");
                $("#staff_name").html($("#staff_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#staff_name").prepend(firstOption);
            }
        }
    });
}


//Table View

//get Director Details
function geDirectorDetails(dir_id){
    $('.userInfoTable').show();
    $('.conditionalInfo').hide();
    $('.occupationInfo').hide();
    $.ajax({
        url: 'manageUser/ajaxResetUserTable1.php',
        data:{'dir_id':dir_id},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#userInfoTable tbody').empty();
            $('#userInfoTable').append(`<tbody><tr><td>`+response[0]['dir_code']+`</td><td>`+response[0]['dir_name']+`</td><td>`+response[0]['mail_id']+`</td></tr></tbody>`);

            $('#company_id').val(response[0]['company_id']);
            $('#company_name').val(response[0]['company_name']);

            //setting full name and mail id for insert table
            $('#full_name').val(response[0]['dir_name']);
            $('#email').val(response[0]['mail_id']);

            getBranchDropdown(response[0]['company_id']);
        }
    })
}
//get Agent Details
function getAgentDetails(ag_id){
    $('.userInfoTable').show();
    $('.conditionalInfo').show();
    $('.occupationInfo').hide();
    $.ajax({
        url: 'manageUser/ajaxResetUserTable.php',
        data:{'ag_id':ag_id},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#userInfoTable tbody').empty();
            $('#userInfoTable').append(`<tbody><tr><td>`+response[0]['ag_code']+`</td><td>`+response[0]['ag_name']+`</td><td>`+response[0]['mail']+`</td></tr></tbody>`);
            
            $('#conditionalInfo tbody').empty();
            $('#conditionalInfo').append(`<tbody><tr><td>`+response[0]['loan_category']+`</td><td>`+response[0]['sub_category']+`</td>
            <td>`+response[0]['scheme']+`</td><td>`+response[0]['loan_payment']+`</td><td>`+response[0]['responsible']+`</td><td>`+response[0]['collection_point']+`</td></tr></tbody>`);

            $('#company_id').val(response[0]['company_id']);
            $('#company_name').val(response[0]['company_name']);
            
            //setting full name and mail id for insert table
            $('#full_name').val(response[0]['ag_name']);
            $('#email').val(response[0]['mail']);

            getBranchDropdown(response[0]['company_id']);
        }
    })
}

//get Staff Details
function getStaffDetails(staff_id){
    $('.userInfoTable').show();
    $('.occupationInfo').show();
    $('.conditionalInfo').hide();
    $.ajax({
        url: 'manageUser/ajaxResetDetailsTable.php',
        data:{'staff_id':staff_id},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#userInfoTable tbody').empty();
            $('#userInfoTable').append(`<tbody><tr><td>`+response[0]['staff_code']+`</td><td>`+response[0]['staff_name']+`</td><td>`+response[0]['mail']+`</td></tr></tbody>`);
            
            $('#occupationInfo tbody').empty();
            $('#occupationInfo').append(`<tbody><tr><td>`+response[0]['company_name']+`</td><td>`+response[0]['department']+`</td>
            <td>`+response[0]['team']+`</td><td>`+response[0]['designation']+`</td></tr></tbody>`);

            $('#company_id').val(response[0]['company_id']);
            $('#company_name').val(response[0]['company_name']);

            //setting full name and mail id for insert table
            $('#full_name').val(response[0]['staff_name']);
            $('#email').val(response[0]['mail']);

            getBranchDropdown(response[0]['company_id']);
            getAgentDropdown(response[0]['company_id']);
        }
    })
}

//Mapping info
//get Branch Dropdown
function getBranchDropdown(company_id){
    var branch_id_upd = $('#branch_id_upd').val().split(',');
    $.ajax({
        url:'manageUser/getBranchList.php',
        data: {'company_id':company_id},
        dataType:'json',
        type: 'post',
        cache:false,
        success: function(response){
            branchMultiselect.clearStore();
            for(var i=0;i<response.length;i++){
                var branch_id = response[i]['branch_id'];
                var branch_name = response[i]['branch_name'];
                var selected = '';
                if(branch_id_upd != ''){
                    for(var j=0;j<branch_id_upd.length;j++){
                        if(branch_id_upd[j] == branch_id){
                            selected = 'selected';
                        }
                    }
                }
                var items = [{
                    value : branch_id,
                    label : branch_name,
                    selected: selected
                }]
                branchMultiselect.setChoices(items);
                branchMultiselect.init();
            }
        }
    })
}

//get Line Dropdown
function getAgentDropdown(company_id){
    var agent_id_upd = $('#agentforstaff_upd').val().split(',');
    $.ajax({
        url: 'manageUser/getAgentDropdown.php',
        data: {'company_id':company_id},
        dataType: 'json',
        type:'post',
        cache: false,
        success: function(response){
            agentMultiselect.clearStore();
            for(var i=0;i<response.length;i++){
                var ag_id = response[i]['ag_id'];
                var ag_name = response[i]['ag_name'];
                var selected = '';
                if(agent_id_upd != ''){
                    for(var j=0;j<agent_id_upd.length;j++){
                        if(agent_id_upd[j] == ag_id){
                            selected = 'selected';
                        }
                    }
                }
                var items = [{
                    value : ag_id,
                    label : ag_name,
                    selected: selected
                }]
                agentMultiselect.setChoices(items);
                agentMultiselect.init();
            }
        }
    })
}
//get Line Dropdown
function getLineDropdown(branch_id){
    var line_id_upd = $('#line_id_upd').val().split(',');
    $.ajax({
        url: 'manageUser/getLineDropdown.php',
        data: {'branch_id':branch_id},
        dataType: 'json',
        type:'post',
        cache: false,
        success: function(response){
            lineMultiselect.clearStore();
            for(var i=0;i<response.length;i++){
                var map_id = response[i]['map_id'];
                var line_name = response[i]['line_name'];
                var selected = '';
                if(line_id_upd != ''){
                    for(var j=0;j<line_id_upd.length;j++){
                        if(line_id_upd[j] == map_id){
                            selected = 'selected';
                        }
                    }
                }
                var items = [{
                    value : map_id,
                    label : line_name,
                    selected: selected
                }]
                lineMultiselect.setChoices(items);
                lineMultiselect.init();
            }
        }
    })
}

//get Group Dropdown
function getGroupDropdown(branch_id){
    var group_id_upd = $('#group_id_upd').val().split(',');
    $.ajax({
        url: 'manageUser/getGroupDropdown.php',
        data: {'branch_id':branch_id},
        dataType: 'json',
        type:'post',
        cache: false,
        success: function(response){
            groupMultiselect.clearStore();
            for(var i=0;i<response.length;i++){
                var map_id = response[i]['map_id'];
                var group_name = response[i]['group_name'];
                var selected = '';
                if(group_id_upd != ''){
                    for(var j=0;j<group_id_upd.length;j++){
                        if(group_id_upd[j] == map_id){
                            selected = 'selected';
                        }
                    }
                }
                var items = [{
                    value : map_id,
                    label : group_name,
                    selected: selected
                }]
                groupMultiselect.setChoices(items);
                groupMultiselect.init();
            }
        }
    })
}

//Screen Mapping
//modules checkbox events
function checkbox(checkboxesToEnable,module){
    if (module.checked) {
        checkboxesToEnable.forEach(function(checkbox) {
            checkbox.disabled = false;
        });
    } else {
        checkboxesToEnable.forEach(function(checkbox) {
            checkbox.disabled = true;
            checkbox.checked = false;
        });
    }
}


function validation(){
    var role = $('#role').val();
    if(role == '1' ){
        $('#roleCheck').hide();
        var role_type = $('#role_type').val();
        if(role_type == '11' || role_type == '12'){
            $('#roleTypeCheck').hide();
            var dir_name = $('#dir_name').val(); 
            if(dir_name == ''){
                $('#dirnameCheck').show();
                event.preventDefault();
            }else{
                $('#dirnameCheck').hide();
            }
        }else{
            $('#roleTypeCheck').show();
        }
    }else if(role == '2' ){$('#roleCheck').hide();
        var ag_name = $('#ag_name').val();
        if(ag_name == ''){
            $('#agnameCheck').show();
            event.preventDefault();
        }else{
            $('#agnameCheck').hide();
        }
    }else if(role == '3'){
        $('#roleCheck').hide();
        var role_type = $('#role_type').val();
        if(role_type != '' ){
            $('#roleTypeCheck').hide();
            var staff_name = $('#staff_name').val(); 
            if(staff_name == ''){
                $('#staffnameCheck').show();
                event.preventDefault();
            }else{
                $('#staffnameCheck').hide();
            }
            // var agentforstaff = $('#agentforstaff').val();
            // if(agentforstaff == ''){
            //     $('#AgentCheck').show();
            //     event.preventDefault();
            // }else{
            //     $('#AgentCheck').hide();
            // }
        }else{
            $('#roleTypeCheck').show();
        }
    }else{
        $('#roleCheck').show();
    }
    var user_id = $('#user_id').val();
    if(user_id == ''){
        $('#usernameCheck').show();
        event.preventDefault();
    }else{
        $('#usernameCheck').hide();
    }
    var pass = $('#password').val();
    if(pass == ''){
        $('#passCheck').show();
        event.preventDefault();
    }else{
        $('#passCheck').hide();
    }
    var cnf_pass = $('#cnf_password').val();
    if(cnf_pass == ''){
        $('#cnfpassCheck').show();
        event.preventDefault();
    }else{
        $('#cnfpassCheck').hide();
    }
    if(pass != cnf_pass){
        $('#passworkCheck').show();
        event.preventDefault();
    }else{$('#passworkCheck').hide();}
    
    var branch_id = $('#branch_id').val();
    if(branch_id == ''){
        $('#BranchCheck').show();
        event.preventDefault();
    }else{
        $('#BranchCheck').hide();
    }
    
}



//Edit Screen Functionalities
function getRoleBasedDetails(role){
    if(role == '1'){
            
        $(".role_type").show();
        $('.agent').hide();
        $('.staff').hide();
        $('.director').hide();
        $('.line_div').show();
        $('.agent_div').hide();
        $("#role_type").empty();
        $('#role_type').append(`<option value="">Select Role Type</option><option value='11'>Director</option>
        <option value='12'>Executive Director</option>`);
    }else 
    if(role == '2'){
        $('.agent').show();
        $(".role_type").hide();
        $('.line_div').hide();
        $('.agent_div').hide();
        $('.staff').hide();
        $('.director').hide();
    }else 
    if(role == '3'){
        $(".role_type").show();
        $('.line_div').show();
        $('.agent_div').show();
        $('.agent').hide();
        $('.staff').hide();
        $('.director').hide();

        getStaffTypeDropdown();
    }
}

function getRoleTypeBasedDetails(role,role_type){
    if(role == '1'){
        $('.agent').hide();
        $('.staff').hide();
        $('.director').show();
        if(role_type == '11'){
            getDirectorName('1');
        }else if(role_type == '12'){
            getDirectorName('2');
        }
    }else if(role == '3'){
        $('.agent').hide();
        $('.director').hide();
        $('.staff').show();
        getStaffName(role_type);
    }
}