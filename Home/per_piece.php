<script type="text/javascript">
    $('.date_ini').datepicker({
        format: "mm/dd/yyyy",
        autoclose: true,
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
</script>

<?php
$month_arr = array();
$year_arr = array();
$year_arr = ["2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022", "2023", "2024", "2025"];
$month_arr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
?>
<br/>
<table id="actions_ini">
    <tr class="hide">
        <td>User ID holder :</td>
        <td><input type="text" id="user_id_holder" disabled/></td>
    </tr>
    <tr class="hide">
        <td>Contract ID :</td>
        <td><input type="text" id="contract_id" disabled/></td>
    </tr>
    <tr>
        <td>Charge Acct. :</td>
        <td><input type="text" id="bill_ca" disabled/></td>
    </tr>
    <tr>
        <td>Billing Type :</td>
        <td>
            <input type="text" id="b_type" disabled/>
          <!--  <select id="b_type" onchange="change_project()">
                <option>Per Piece</option>
                <option>Crew Type</option>
                <option>Lump Sum</option>
                <option>Progress</option>
                <option>Cost +</option>
            </select>-->
        </td>
    </tr>
    <tr>
        <td>Contract :</td>
        <td><input type="text" id="contract_val" disabled/></td>
<!--        <td><select id="projects" onchange="change_selected(this.id)"></select></td>-->
    </tr>
    <tr>
        <td>Project :</td>
        <td><input type="text" id="projects" disabled/></td>
<!--        <td><select id="projects" onchange="change_selected(this.id)"></select></td>-->
    </tr>
    <tr>
        <td>Description :</td>
        <td><input type="text" id="description" disabled/></td>
<!--        <td><select id="description" onchange="change_selected(this.id)"></select></td>-->
    </tr>
    <tr>
        <td>Area :</td>
<!--        <td><select id="area"></select></td>-->
        <td><input type="text" id="area" disabled/></td>
    </tr>
    <tr>
        <td>Month :</td>
        <td><select id="month" onchange="create_date()">
                <?php
                $cal = 1;
                for($i = 0; $i < sizeof($month_arr); $i++){
                    ?>
                    <option value="<?php echo $cal++;  ?>"><?php echo $month_arr[$i]; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Year :</td>
        <td><select id="year" onchange="create_date()">
                <option></option>
                <?php
                $cal = 1;
                for($i = 0; $i < sizeof($year_arr); $i++){
                    ?>
                    <option><?php echo $year_arr[$i]; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><a class="btn btn-primary" onclick="execute()">Execute</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" data-toggle="modal" href="#open_graph">Graph</a></td>
    </tr>
</table>

<!--<div id="contract_duration">
    <label>Contract Duration : <input type="text" class="date_ini" id="dur_from"/> - <input type="text" class="date_ini" id="dur_to"/></label>
</div>-->

<table class="table table-bordered" id="tbl-graph" style="display: none;">
    <tbody id="graph_ini"></tbody>
</table>
<br/>
<table id="tbl_month" class="table table-bordered">
    <tbody id="week_view"></tbody>
</table>
<div id='open_graph' class='modal hide fade' tabindex="-1" role='dialog' area-hidden="true" style="width:85%; margin-left:-550px;">
    <div class='modal-body' style="height:100%;padding:80px;">
        <table>
            <tr>
                <td>Select : </td>
                <td>
                    <select id="sel_month" onchange='sel_month()'>
                        <option></option>
                        <?php
                        $cal = 1;
                        for($i = 0; $i < sizeof($month_arr); $i++){
                            ?>
                            <option value="<?php echo $cal++;  ?>"><?php echo $month_arr[$i]; ?></option>
                        <?php } ?>
                        <option>Monthly</option>
                    </select>
                </td>
                <td>
                    <select id="sel_year" onchange='sel_month()'>
                        <?php
                        $cal = 1;
                        for($i = 0; $i < sizeof($year_arr); $i++){
                            ?>
                            <option><?php echo $year_arr[$i]; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr id="dates_range">
                <td>GRAPH : </td>
                <td class="hide1" style="display: none;">
                    <select id="sel_month2" class="sel_month_ini">
                        <option>FROM</option>
                        <?php
                        $cal = 1;
                        for($i = 0; $i < sizeof($month_arr); $i++){
                            ?>
                            <option value="<?php echo $cal++;  ?>"><?php echo $month_arr[$i]; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="hide2"><input type="text" class="date_ini" placeholder="FROM" id="date_from"/>&nbsp;&nbsp;-</td>
                <td class="hide2">&nbsp;&nbsp;<input type="text" class="date_ini" id="date_to" placeholder="TO"/></td>
                <td class="hide1" style="display: none;">
                    <select id="sel_month1" class="sel_month_ini">
                        <option>TO</option>
                        <?php
                        $cal = 1;
                        for($i = 0; $i < sizeof($month_arr); $i++){
                            ?>
                            <option value="<?php echo $cal++;  ?>"><?php echo $month_arr[$i]; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" data-toggle="modal"  href="#" onclick="graph()">GO</a></td>
            </tr>
        </table>
        <br/>
        <div id="div_graph"></div>
    </div>
    <div class='modal-footer'>
        <button class="btn btn-primary" data-dismiss='modal'>Close</button>
    </div>
</div>