<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";

    // Create connection
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    
    $aResult = array();
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql ="select * from `edx_table`  ORDER BY ID DESC";
    $result = mysqli_query($conn, $sql);
    // header row
    $return_html = "<th>Date</th>
    <th>Mask ID</th>
    <th>X8/KT Tool</th>
    <th>Scanner Tool</th>
    <th>Composition</th>
    <th>Particle X</th>
    <th>Particle Y</th>
    <th>Size<br>(nm)</th>
    <th>BX Clean</th>
    <th>X8 Request</th>
    <th>RR Request</th>
    <th>Engineer</th>
    <th>Remark</th> 
    <th></th>";

    // the input row
    $return_html .= '<tr>';
    $return_html .= '<td><div class="input_form"><input type="date", value ='.date("Y-m-d").' id = date></div></td>';
    $return_html .= '<td><input type="text", value ="" id = mask_ID></td>';
    $return_html .= '<td><select class="custom-select" id=X8_tool name="X8_tool">
                    <option value="X8">X8</option>
                    <option value="H11">H11</option>
                    <option value="G12">G12</option>
                    </select></td>';
    $return_html .= '<td><select class="custom-select" id=SCN_tool name="SCN_too">
    <option value="G301">G301</option>
    <option value="G306">G306</option>
    <option value="K302">K302</option>
    <option value="K303">K303</option>
    <option value="K304">K304</option>
    </select></td>';
    $return_html .= '<td><input type="text", value ="" id = COMP></td>';
    $return_html .= '<td><input type="text", value ="" id = POS_X></td>';
    $return_html .= '<td><input type="text", value ="" id = POS_Y></td>';
    $return_html .= '<td><input type="text", value ="" id = P_size></td>';

    $return_html .= '<td><select class="custom-select" id=BX_clean name="BX">
    <option value="Wait">Wait</option>
    <option value="OK">OK</option>
    </select></td>';
    $return_html .= '<td><select class="custom-select" id=X8_request name="X8">
    <option value="No">No</option>
    <option value="Yes">Yes</option>
    </select></td>';
    $return_html .= '<td><select class="custom-select" id=RR_check name="RR_request">
    <option value="No">No</option>
    <option value="Yes">Yes</option>
    </select></td>';
    $return_html .= '<td><input type="text", value ='.getenv('USERNAME').' id = EE_name></td>';
    $return_html .= '<td><input type="text", value ="" id = Note_in></td>';
    $return_html .= '<td> <input type="submit" onclick="insertData()" value=Insert></td>';
    $return_html .= '</tr>';
    $return_html .= '<tbody>';

    // adding data to table
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $return_html .= "<tr>";
        $return_html .= "<td >" . '<div class="input_form"><input type="date", value = '.$row['DATE_EDX'].' id = DATE_'.$row['ID'].'>'. "</div></td>";
        $return_html .= "<td width=12%>" . '<input type="text", value = '.$row['MASK_ID'].' id = MASK_'.$row['ID'].'>'. "</td>";


        $return_html .= '<td width=4%><select class="custom-select" id= X8_tool_'.$row['ID'].' value='.$row['X8_TOOl'].'>
        <option hidden value='.$row['X8_TOOl'].' >'.$row['X8_TOOl'].'</option>
        <option value="X8">X8</option>
        <option value="H11">H11</option>
        <option value="G12">G12</option>
        </select></td>';


        $return_html .= '<td width=4%><select class="custom-select" id= SCN_tool_'.$row['ID'].'>
        <option hidden value='.$row['SCN_TOOL'].' >'.$row['SCN_TOOL'].'</option>
        <option value="G301" >G301</option>
        <option value="G306">G306</option>
        <option value="K302">K302</option>
        <option value="K303">K303</option>
        <option value="K304">K304</option>
        </select></td>';


        $return_html .= '<td><input type="text", value ='.$row['COMPOSITION'].' id = COMP_'.$row['ID'].'></td>';
        $return_html .= '<td width=8%><input type="text", value ='.$row['PX'].' id = POS_X_'.$row['ID'].' ></td>';
        $return_html .= '<td width=8%><input type="text", value ='.$row['PY'].' id = POS_Y_'.$row['ID'].' ></td>';
        $return_html .= '<td width=5%><input type="text", value ='.$row['SEM_SIZE'].' id = P_size_'.$row['ID'].' ></td>';

        if($row['BX']=="Wait"){
            $return_html .= '<td width=4%><select class="custom-select" style="background-color:yellow"  id=BX_clean_'.$row['ID'].'>
            <option hidden  value='.$row['BX'].' >'.$row['BX'].'</option>
            <option value="Wait">Wait</option>
            <option value="OK">OK</option>
            </select></td>';
    
        }
        else{
            $return_html .= '<td width=4%><select class="custom-select" style="background-color:green"  id=BX_clean_'.$row['ID'].'>
            <option hidden  value='.$row['BX'].' >'.$row['BX'].'</option>
            <option value="Wait">Wait</option>
            <option value="OK">OK</option>
            </select></td>';
    
        }

        if ($row['X8']==1){
            $return_html .= '<td><select class="custom-select" style="background-color:green" id=X8_request_'.$row['ID'].' value="Yes">
            <option hidden selected="selected" value="Yes">Yes</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select></td>';
        }
        else{
            $return_html .= '<td><select class="custom-select"  style="background-color:yellow" id=X8_request_'.$row['ID'].' value="No" >
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option hidden selected="selected" value="No">No</option>
            </select></td>';
        }
        if ($row['RR']==1){
            $return_html .= '<td><select class="custom-select" style="background-color:yellow" id=RR_check_'.$row['ID'].' value="Yes">
            <option hidden selected="selected" value="Yes">Yes</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select></td>';
        }
        else{
            $return_html .= '<td><select class="custom-select" style="background-color:green" id=RR_check_'.$row['ID'].' value="No">
            <option value="Yes">Yes</option>
            <option hidden selected="selected" value="No">No</option>
            <option value="No">No</option>
            </select></td>';
        }
        $return_html .= '<td><input type="text", id = EE_name_'.$row['ID'].' value ='.$row['ENGINEER'].'></td>';
        $return_html .= '<td><input type="text" id = Note_in_'.$row['ID'].' , value ='.$row['NOTE'].'></td>';

        //adding two buttons for update and delete
        $return_html .= "<td>" . '<input type="submit" onclick="updateData('.$row['ID'].')" value=Update>';
        $return_html .= '<input type="submit" style="background-color:red" onclick="deleteData('.$row['ID'].')" value=Delete>' . "</td>";
        //echo "<td>" . '<button onclick="myFunction('.$row['id'].')">Click me</button>' . "</td>";
        $return_html .= "</tr>";
    }
    $return_html .= '</tbody>';
    $aResult['result']  = $return_html;

    echo json_encode($aResult);
}
?>