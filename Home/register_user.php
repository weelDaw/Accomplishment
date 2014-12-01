

<table class="tbl-design" id="tbl_user_reg">
    <tr>
        <td></td>
        <td><span id="mess_success"></span></td>
    </tr>
    <tr>
        <td>Designation : </td>
        <td>
            <select id="reg_des">
                <option>BU Head</option>
                <option>Supervisor</option>
                <option>Project Head</option>
                <option>Project Control</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Username : </td>
        <td><input type="text" id="reg_uname"/></td>
    </tr>
    <tr>
        <td>Password : </td>
        <td><input type="password" id="reg_pass"/></td>
    </tr>
    <tr>
        <td>Re-Type Password : </td>
        <td><input type="password" id="reg_repass"/></td>
    </tr>
    <tr>
        <td></td>
        <td><a class="btn btn-primary" onclick="open_user_data()">Save</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" id="clear_registration" onclick="clear_reg(this.id)">Clear</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-warning" onclick="login_open()">Back</a></td>
    </tr>
</table>