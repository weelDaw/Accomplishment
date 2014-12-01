var design_dao = "";

$(function(){
    $('.date_ini').datepicker({
        format: "mm/dd/yyyy",
        autoclose: true,
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

    var data1 = "";
    var url1 = "../Process/get_contract.php";
    var show1 = "#tbody_views";
    var err_msg1 = "Error in Getting Contract info !";
    saver(url1, data1, show1, err_msg1);

    $('#home2').hide();

    $('#designation_validate').hide();
    design_dao = $('#designation_validate').val();
    if(design_dao != "Supervisor"  && design_dao != "Administrator"){
        $('#menu_registration').hide();
    }

    /*  $('body').css('background-image', 'url(../Images/plain.jpg)');
      $('#header a').hide();
      $('#container').show();
      $('#container').load("login_form.php");*/

//    $('#container').load("contract.php");
//    saver("../Process/get_Project.php", "", "#projects", "Error in Getting Projects !");
    $("#menu_con").click(function(){
        $('#container').load("contract.php");
        saver(url1, data1, show1, err_msg1);
    })
    $("#menu_registration").click(function(){
        $('#home2').show();
        $('#home').hide();
        $('#menu_registration').hide();
        $('body').css('background-image', 'url(../Images/plain.jpg)');
        $('#container').show();
        $('#container').load("registration.php");
    })
    $("#menu_piece").click(function(){
        $('#container').load("per_piece.php");
        var data = {billing:"Per Piece"};
        saver("../Process/get_Project.php", data, "#projects", "Error in Getting Projects !");
    })
    $('#home').click(function(){
        var data1 = "";
        var url1 = "../Process/get_contract.php";
        var show1 = "#tbody_views";
        var err_msg1 = "Error in Getting Contract info !";
        $('body').css('background-image', 'url(../Images/back_plain.jpg)');
        $('#container').show();
        $('#container').load("contract.php");
        saver(url1, data1, show1, err_msg1);
        $('#home2').show();
        $('#home').hide();
        $('#menu_registration').hide();
        $('#open_per_piece').hide();
    })
    $('#home2').click(function(){
        $('#open_per_piece').hide();
        if(design_dao != "Supervisor" && design_dao != "Administrator" ){
            $('#menu_registration').hide();
        }else{
            $('#menu_registration').show();
        }
        $('#container').hide();
        $('body').css('background-image', 'url(../Images/miescor2.jpg)');
        $('#home2').hide();
        $('#home').show();
        $('#logout').show();
    })
    $(".alerto").fadeOut(5000);
    $('#err_msg').hide();
    $('#pass_err').hide();
    $('#open_per_piece').hide();
   /* $('#header a').click(function(){
        toogle_class($(this));
    });*/
})

/*function toogle_class(a){
    $('#header a').removeClass('active');
    a.addClass('active');
}*/
function billing_action(id){
    var val_arr = id.split(',');
    $('#open_per_piece').show();
    $('#container').hide();
/*

    if(billing == "Per Piece"){
        $('#container').load("per_piece.php");
    }else if(billing == "Crew Type"){
        $('#container').load("");
    }else if(billing == "Lump Sum"){
        $('#container').load("");
    }else if(billing == "Progress"){
        $('#container').load("");
    }else if(billing == "Cost +"){
        $('#container').load("");
    }
*/
    $('#home').show();
    $('#home2').hide();
    $('#contract_val').val(val_arr[1]);
    $('#user_id_holder').val(val_arr[7]);
    $('#contract_id').val(val_arr[6]);
    $('#b_type').val(val_arr[5]);
    $('#projects').val(val_arr[2]);
    $('#description').val(val_arr[3]);
    $('#area').val(val_arr[4]);
    $('#bill_ca').val(val_arr[0]);
    $('#tbl_month').hide();
   /* var data = {billing:val_arr[5]};
    saver("../Process/get_Project.php", data, "#projects", "Error in Getting Projects !");
    saver("../Process/get_Area.php", "", "#area", "Error in Getting Area !");
    saver("../Process/get_Description.php", "", "#description", "Error in Getting Description!");*/
}

function add_area(){
    $("#registration #areas #td_add").append("<br/><input type='text'>");
}

function login_open(){
    $('#login_tbl_ini').show();
    $('#open_registration').hide();
}

function logout(){
    saver("../Process/login/logout.php", "", "", "Error in to Logged Out !");
    window.location.reload();
}

function sign_in(){
    var username = $('#log_uname').val();
    var password = $('#log_pass').val();
    if(username == "" || password == ""){
        $('#err_msg_log').show();
        $('#err_msg_log').html('Make sure username or password is not empty !');
        $('#err_msg_log').fadeOut(10000);
    }else{
        var data = {username:username, password:password};
        saver("../Process/ck_account.php", data, "#err_msg_log", "Error in Checking user account !");
    }
}

function clear_reg(id){
    if(id == "clear_registration"){
        $('#tbl_user_reg tr td input').val('');
    }
}

function save_registration(){
    var designation = $('#reg_des').val();
    var user = $('#reg_uname').val();
    var reg_pass = $('#reg_pass').val();
    var data = {designation:designation, user:user, password:reg_pass};
    saver("../Process/save_user.php", data, "#mess_success", "Error in saving new User !");
}
function open_user_data(){
    var user = $('#reg_uname').val();
    var data = {user:user};
    saver("../Process/ck_uname.php", data, "#validate_user", "Error in validating user !");
}

function admin_auth(){
    var username = $('#allow_user').val();
    var password = $('#allow_password').val();
    var data = {uname:username, upass:password};
    saver("../Process/admin_validate.php", data, "#validate_admin", "Error in Validating Administrator !");
}

function change_selected(id){
    var data = "";
    var url = "";
    var show = "";
    var error = "";
    if(id == "projects"){
        data = {desc:$("#projects").val()};
        url = "../Process/get_Description.php";
        show = "#description";
        error = "Error in Getting Description !";
        var show2 = "#area";
        var url2 = "../Process/get_Area.php";
        saver(url, data, show, error);
        saver(url2, "", show2, error);
    }else{
        data = {desc:$("#description").val(), project:$("#projects").val()};
        url = "../Process/get_Area.php";
        show = "#area";
        error = "Error in Getting Area !";
        saver(url, data, show, error);
    }
}

function sel_month(){
    var month = $('#sel_month').val();
    var year = $('#sel_year').val();
    var from = month+"/1/"+year;
    var to ="";
    if(month != "Monthly"){
        var x = new Date(year,month,1,-1).getDate();
        to = month+"/"+x+"/"+year;
        $('.hide2').show();
        $('.hide1').css("display","none");
        $('#date_from').val(from);
        $('#date_to').val(to);
        $('#date_from').datepicker('update', from);
        $('#date_to').datepicker('update', to);
    }else{
        $('.hide2').hide();
        $('.hide1').css("display","block");
        $('.date_ini').val('');
    }
}

function save_contract(){

    var area = "";
    var area_values = $('#registration #areas input').map(function(){
        return this.value;
    }).toArray();

    for(var x = 0; x < area_values.length; x++){
            area = area +area_values[x]+ ",";
    }
    var ca = $("#ca").val();
    var project = $("#project").val();
    var contract = $("#contract").val();
    var description = $("#description").val();
    var billing = $("#billing").val();
    var url = "../Process/contract.php";
    var data = {ca:ca, project:project, con:contract, desc:description, area:area, billing:billing};
    var show = "gett";
    var err_msg = "Error in saving project contract !";
    if(contract != "" && description != ""){
        saver(url, data, show, err_msg);
    }
}

function get_progress(){
    var plan_arr = "";
    var actual_arr = "";
    var contract_price = $('#contract_price').val();
    var contract_id = $("#contract_id").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var area = $("#area").val();
    var values = $('#tbl_month tbody #tr_percent_plan td input').map(function(){
        return this.id;
    }).toArray();

    var values2 = $('#tbl_month tbody #tr_prog_actual td input').map(function(){
        return this.id;
    }).toArray();

    for(var i = 0; i < values.length; i++){
        var data = $("#"+values[i]).val();
        if(data != ""){
            plan_arr = plan_arr +data+ "-" +values[i]+ ",";
        }
    }
    for(var x = 0; x < values2.length; x++){
        var data2 = $("#"+values2[x]).val();
        if(data2 != ""){
            actual_arr = actual_arr +data2+ "-" +values2[x]+ ",";
        }
    }
    var datas = {plan_arr:plan_arr, actual_arr:actual_arr, contract_price:contract_price, contract_id:contract_id, month:month, year:year, area:area};
    saver("../Process/save_progress.php", datas, "#save_days", "Error in saving!");
}



function get_lump(){
    var plan_arr = "";
    var sum_arr = "";
    var ofs_arr = "";
    var penalty= "";
    var contract_id = $("#contract_id").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var area = $("#area").val();
    var values = $('#tbl_month tbody #tr_lump_planned td input').map(function(){
        return this.id;
    }).toArray();

    var values2 = $('#tbl_month tbody #tr_lump_sum td input').map(function(){
        return this.id;
    }).toArray();

    var values3 = $('#tbl_month tbody #tr_lump_ofs td input').map(function(){
        return this.id;
    }).toArray();
    var values4 = $('#tbl_month tbody #tr_lump_penalty td input').map(function(){
        return this.id;
    }).toArray();

    for(var i = 0; i < values.length; i++){
        var data = $("#"+values[i]).val();
        if(data != ""){
            plan_arr = plan_arr +data+ "-" +values[i]+ ",";
        }
    }
    for(var x = 0; x < values2.length; x++){
        var data2 = $("#"+values2[x]).val();
        if(data2 != ""){
            sum_arr = sum_arr +data2+ "-" +values2[x]+ ",";
        }
    }
    for(var s = 0; s < values3.length; s++){
        var data3 = $("#"+values3[s]).val();
        if(data3 != ""){
            ofs_arr = ofs_arr +data3+ "-" +values3[s]+ ",";
        }
    }
    for(var p = 0; p < values4.length; p++){
        var data4 = $("#"+values4[p]).val();
        if(data4 != ""){
            penalty = penalty +data4+ "-" +values4[p]+ ",";
        }
    }
    var datas = {plan_arr:plan_arr, sum_arr:sum_arr, ofs_arr:ofs_arr, penalty:penalty, contract_id:contract_id, month:month, year:year, area:area};
    saver("../Process/save_lump_sum.php", datas, "#save_days", "Error in saving!");
}


function get_plan(){
    var plan_arr = "";
    var exec_arr = "";
    var assigned_arr = "";
    var guaranteed = "";
    var rates = "";
    var month = $("#month").val();
    var contract_id = $("#contract_id").val();
    var year = $("#year").val();
    var area = $("#area").val();
    var values = $('#tbl_month tbody #tr_planned td input').map(function(){
        return this.id;
    }).toArray();

    var values2 = $('#tbl_month tbody #tr_executed td input').map(function(){
        return this.id;
    }).toArray();

    var values3 = $('#tbl_month tbody #tr_assigned td input').map(function(){
            return this.id;
        }).toArray();
    var values4 = $('#tbl_month tbody #tr_guaranteed td input').map(function(){
            return this.id;
        }).toArray();
    var values5 = $('#tbl_month tbody #tr_rates td input').map(function(){
            return this.id;
        }).toArray();

    for(var i = 0; i < values.length; i++){
        var data = $("#"+values[i]).val();
        if(data != ""){
            plan_arr = plan_arr +data+ "-" +values[i]+ ",";
        }
    }
    for(var x = 0; x < values2.length; x++){
        var data2 = $("#"+values2[x]).val();
        if(data2 != ""){
            exec_arr = exec_arr +data2+ "-" +values2[x]+ ",";
        }
    }
    for(var s = 0; s < values3.length; s++){
        var data3 = $("#"+values3[s]).val();
        if(data3 != ""){
            assigned_arr = assigned_arr +data3+ "-" +values3[s]+ ",";
        }
    }
    for(var p = 0; p < values4.length; p++){
        var data4 = $("#"+values4[p]).val();
        if(data4 != ""){
            guaranteed = guaranteed +data4+ "-" +values4[p]+ ",";
        }
    }
    for(var m = 0; m < values5.length; m++){
        var data5 = $("#"+values5[m]).val();
        if(data5 != ""){
            rates = rates +data5+ "-" +values5[m]+ ",";
        }
    }
    var datas = {plan:plan_arr, exec:exec_arr, t_assigned:assigned_arr, guaranteed:guaranteed, rates:rates, contract_id:contract_id, month:month, year:year, area:area};
    saver("../Process/save_date.php", datas, "#save_days", "Error in saving!");
}

function execute(){
    $('#tbl_month').show();
    var con_id = $("#contract_id").val();
    var user_id_holder = $("#user_id_holder").val();
    var billing = $("#b_type").val();
    var area = $("#area").val();
    var month = $('#month').val();
    var year = $('#year').val();
    var data = "";
    data = {month:month, year:year, area:area, contract_id:con_id, user_id_holder:user_id_holder};
    if(billing == "Per Piece"){
        saver("../Process/weeks_tbl.php", data, "#week_view", "Error in Getting Weekly Per Piece !");
    }else if(billing == "Lump Sum"){
        saver("../Process/lump_tbl.php", data, "#week_view", "Error in Getting Weekly Lump Sum !");
    }else if(billing == "Progress"){
        saver("../Process/progress_tbl.php", data, "#week_view", "Error in Getting Weekly Progress !");
    }else{

    }
}

function graph(){
    var contract_id = $('#contract_id').val();
    var area = $("#area").val();
    var date_from = $("#date_from").val();
    var date_to = $("#date_to").val();
    var selected_month = $('#sel_month').val();
    var selected_year = $('#sel_year').val();
    var sel_month1 = $('#sel_month2').val();
    var sel_month2 = $('#sel_month1').val();
    var type = $('#b_type').val();
    var month = $('#month').val();
    var year = $('#year').val();

    if(selected_month != "Monthly"){
        var data = {contract_id:contract_id, from:date_from, to:date_to, area:area,  month_ini:month, year_ini:year};
        if(type == "Per Piece"){
            saver("../Process/graph.php", data, "#graph_ini", "Error in Getting Graph !");
        }else if(type == "Lump Sum"){
            saver("../Process/lump_graph.php", data, "#graph_ini", "Error in Getting Graph !");
        }else if(type == "Progress"){
            saver("../Process/progress_graph.php", data, "#graph_ini", "Error in Getting Graph !");
        }else{

        }
    }else{
        var data2 = {contract_id:contract_id, from:sel_month1, to:sel_month2, area:area, year:selected_year};
        if(type == "Per Piece"){
            saver("../Process/graph2.php", data2, "#graph_ini", "Error in Getting Graph !");
        }else if(type == "Lump Sum"){
            saver("../Process/lump_graph2.php", data2, "#graph_ini", "Error in Getting Graph !");
        }else if(type == "Progress"){
            saver("../Process/progress_graph2.php", data2, "#graph_ini", "Error in Getting Graph !");
        }else{

        }
    }
}

function create_date(){
    var date = $('#month').val()+"/01/"+$('#year').val();
    $('.date_ini').datepicker('update', date);
}

function saver(url, data, show, err_msg){
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        beforeSend: function(){
            $('.loading').show();
        },
        success: function(response){
            if(show == "#save_days"){
                console.log(response);
            }else if(show == "#graph_ini"){
                $(show).html(response);
                var from = $('#date_from').val();
                var to = $('#date_to').val();
                var monthly = $('#sel_month').val();
                if(monthly == "Monthly"){
                    var month_arr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    from = parseInt($('#sel_month2').val()) - 1;
                    to = parseInt($('#sel_month1').val()) - 1;
                    from = month_arr[from];
                    to = month_arr[to];
                }else{
                    from = date_format(from);
                    to = date_format(to);
                }

                $('#div_graph').highcharts({
                    data: {
                        table: document.getElementById('tbl-graph')
                    },
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Accomplishment From '+from+' - '+to
                    },
                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Units'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'/*+
                                this.y +' '*/+ '<b>' + this.x.toLocaleString()+ '</b>';
                        }
                    }
                });
            }else if(show == "#mess_success"){
                $('#reg_uname').val('');
                $('#reg_pass').val('');
                $('#reg_repass').val('');
                $(show).show();
                if(response == "yes"){
                    $(show).html("Successfully saved !");
                }else{
                    $(show).html("Registration failed !");
                }
                $(show).fadeOut(10000);
            }else if(show == "#validate_user"){
                var designation = $('#reg_des').val();
                var user = $('#reg_uname').val();
                var reg_pass = $('#reg_pass').val();
                var reg_repass = $('#reg_repass').val();
                var asterisk = "";
                if(reg_pass == reg_repass && response == "yes"){
                    $('#dis_design').html(designation);
                    $('#dis_uname').html(user);
                    for(var i = 0; i < reg_pass.length; i++){
                        asterisk = asterisk + '*';
                    }
                    $('#dis_pass').html(asterisk);
                    $('#reg_user_modal').modal('toggle');
                }else if(response !="yes" && reg_pass == reg_repass){
                    $('#reg_uname').val('');
                    $('#reg_pass').val('');
                    $('#reg_repass').val('');
                    $('#err_mss_val').html("Username is already taken !");
                    $('#pass_err_modal').modal('toggle');
                }else if(reg_pass != reg_repass && response == "yes"){
                    $('#reg_pass').val('');
                    $('#reg_repass').val('');
                    $('#err_mss_val').html("Password didn't match !");
                    $('#pass_err_modal').modal('toggle');
                }else{
                    $('#reg_uname').val('');
                    $('#reg_pass').val('');
                    $('#reg_repass').val('');
                    $('#err_mss_val').html("Username is already taken and password didn't match !");
                    $('#pass_err_modal').modal('toggle');
                }
            }else if(show == "#validate_admin"){
                if(response == "yes"){
                    /*$('body').css('background-image', 'url(../Images/plain.jpg)');
                    $('#login_icon').show();
                    $('#container').show();
                    $('#container').load("register_user.php");*/
                    $('#login_tbl_ini').hide();
                    $('#open_registration').show();
                    $('#open_registration').load("register_user.php");
                    $('#reg_admin').modal('toggle');
                    $('#allow_user').val('');
                    $('#allow_password').val('');
                }else{
                    $('#allow_password').val("");
                    $('#err_msg').show();
                    $('#err_msg').fadeOut(10000);
                }
            }else if(show == "#err_msg_log"){
                if(response == "no"){
                    $('#err_msg_log').show();
                    $('#err_msg_log').html('Username or Password is not correct !');
                    $('#err_msg_log').fadeOut(10000);
                }else{
                    $('#container').hide();
                    $('body').css('background-image', 'url(../Images/miescor2.jpg)');
                    $('#home2').hide();
                    $('#home').show();
                    $('#logout').show();
                    $('#registration_form').show();
                }
            }else{
                $(show).html(response);
//                console.log(response);
            }
        },
        error: function(err){
            alert(err_msg + err["statusText"]);
        },
        complete:function(){
            $('.loading').fadeOut(500);
        }
    });
}

function date_format(date){
    var date_arr = date.split("/");
    var date_month = month_format(date_arr[0]);
    var date_day = day_format(date_arr[1]);
    return date_month +" "+ date_day +"," +" "+ date_arr[2];
}

function month_format(month){
    month = day_format(month);
    var a = ["","January","February","March","April","May","June","July","August","September","October","November","December"];
    return a[month];
}

function day_format(day){
    var e_return = day;
    for(var i = 1; i <= 9; i++){
        var to_change = "0"+i;
        switch (day){
            case to_change:
                e_return = i;
                break;
            default :
        }
    }
    return e_return;
}

function sales_computation(id){
    id = id.match(/\d+$/)[0];

    var rates = $("#rates"+id).val();
    var executed = $("#exec"+id).val();
    var guaranteed = $("#guaranteed"+id).val();
    var assigned = $("#assigned"+id).val();
    var sales = 0;

    if(guaranteed < assigned){
        sales = executed * rates;
    }else{
        if(assigned == executed){
            sales = guaranteed * rates;
        }else{
            sales = executed * rates;
        }
    }
    if(sales != 0){
        $('#sales'+id).html(sales);
    }else{
        $('#sales'+id).html('');
    }
}

function sales_computation_lump(id){
    id = id.match(/\d+$/)[0];

    var lump_penalty = $("#lump_penalty"+id).val();
    var lump_ofs = $("#lump_ofs"+id).val();
    var lump_sum = $("#lump_sum"+id).val();
    var sales = 0;

    sales = (parseFloat(lump_sum) + parseFloat(lump_ofs)) - parseFloat(lump_penalty);

    if(sales != 0){
        $('#sales2'+id).html(sales);
    }else{
        $('#sales2'+id).html('');
    }
}

function change_project(){
    var b_type = $('#b_type').val();
    var data = {billing:b_type};
    saver("../Process/get_Project.php", data, "#projects", "Error in Getting Projects !");
    saver("../Process/get_Area.php", "", "#area", "Error in Getting Area !");
    saver("../Process/get_Description.php", "", "#description", "Error in Getting Description!");
}