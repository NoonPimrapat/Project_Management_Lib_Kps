<?php
        $strSQL = "SELECT * FROM project_info WHERE project_name = '".$_POST["sCusID"]."' ";
        $objQuery = mysql_query($strSQL) or die (mysql_error());
    $intNumField = mysql_num_fields($objQuery);
    $resultArray = array();
    while($obResult = mysql_fetch_array($objQuery))
    {
        $arrCol = array();
        for($i=0;$i<$intNumField;$i++)
        {
            $arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
        }
        array_push($resultArray,$arrCol);
    }
    
    echo json_encode($resultArray);
    
?>