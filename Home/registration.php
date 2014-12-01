<table class="tbl-design" id="registration">
    <tr>
        <th colspan="3">NEW PROJECT ACCOMPLISHMENT</th>
    </tr>
    <tr>
        <td>CHARGE ACCT :</td>
        <td><input type="text" id="ca"/></td>
        <td></td>
    </tr>
    <tr>
        <td>PROJECT :</td>
        <td><input type="text" id="project"/></td>
        <td></td>
    </tr>
    <tr>
        <td>CONTRACT :</td>
        <td><input type="text" id="contract"/></td>
        <td></td>
    </tr>
    <tr>
        <td>DESCRIPTION :</td>
        <td><input type="text" id="description"/></td>
        <td></td>
    </tr>
    <tr id="areas">
        <td>AREA :</td>
        <td id="td_add"><input type="text"/></td>
        <td id="add_area" onclick="add_area()"><i class="icon-plus"></i></td>
    </tr>
    <tr>
        <td>BILLING TYPE :</td>
        <td>
            <select id="billing">
                <option>Per Piece</option>
                <option>Crew Type</option>
                <option>Lump Sum</option>
                <option>Progress</option>
                <option>Cost +</option>
            </select>
        </td>
        <td><a class="btn btn-primary" href="#reg_prompt" data-toggle="modal">SAVE</a></td>
    </tr>
</table>