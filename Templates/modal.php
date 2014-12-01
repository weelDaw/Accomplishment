<div id='reg_prompt' class='modal hide fade' tabindex="-1" role='dialog' area-hidden="true">
    <div class='modal-body'>
        <em>Do you really want to save this new Project Accomplishment ?</em>
    </div>
    <div class='modal-footer'>
        <a class="btn btn-primary" data-dismiss='modal' onclick="save_contract()">Yes</a>
        <button class="btn btn-danger" data-dismiss='modal'>No</button>
    </div>
</div>

<div id='reg_admin' class='modal hide fade' tabindex="-1" role='dialog' area-hidden="true">
    <div class='modal-body'>
        <table class="tbl-design">
            <tr>
                <th colspan="2">Administrator</th>
            </tr>
            <tr>
                <td>Username :</td>
                <td><input type="text" id="allow_user"/></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" id="allow_password"/></td>
            </tr>
            <tr>
                <td colspan="2" id="err_msg">Username or Password is not correct !</td>
            </tr>
        </table>
    </div>
    <div class='modal-footer'>
        <a class="btn btn-primary" onclick="admin_auth()">Allow</a>
        <button class="btn btn-danger" data-dismiss='modal'>Cancel</button>
    </div>
</div>

<div id='reg_user_modal' class='modal hide fade' tabindex="-1" role='dialog' area-hidden="true">
    <div class='modal-body'>
        <table>
            <tr>
                <td>Designation :</td>
                <td id="dis_design"></td>
            </tr>
            <tr>
                <td>Username :</td>
                <td id="dis_uname"></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td id="dis_pass"></td>
            </tr>
        </table>
    </div>
    <div class='modal-footer'>
        Are you sure you want to save this new User ?
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" onclick="save_registration()" data-dismiss='modal'>Yes</a>
        <button class="btn btn-danger" data-dismiss='modal'>Cancel</button>
    </div>
</div>

<div id='pass_err_modal' class='modal hide fade' tabindex="-1" role='dialog' area-hidden="true">
    <div class='modal-body'>
        <span id="err_mss_val"></span>
    </div>
    <div class='modal-footer'>
        <button class="btn btn-danger" data-dismiss='modal'>Close</button>
    </div>
</div>

