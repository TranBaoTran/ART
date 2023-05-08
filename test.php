
<?php 
    include "head.php";
    include_once "database.php";
    $arr=[];
    $html="";
    $sql="select * from chungloai where tinhtrang=1";
    $result=Connection::executeQuery($sql);
    while($row=mysqli_fetch_array($result)){
        $arr[]=$row[1];
        $sign[]=$row[0];
    }
    for($i=0;$i<count($arr);$i+=1){
        $html.="<option value='".$sign[$i]."'>+".$arr[$i]."</option>";
        $smallSql="select * from theloai where macl='".$sign[$i]."' and theloai.tinhtrang=1";
        $result=Connection::executeQuery($smallSql);
        if($result!=null){
            $ar=[];
            $si=[];
            while($row=mysqli_fetch_array($result)){
                $ar[]=$row[1];
                $si[]=$row[0];
            }
            for($j=0;$j<count($ar);$j+=1){
                $html.="<option value='".$si[$j]."'>&nbsp&nbsp-".$ar[$j]."</option>";
            }
        }
    }
?>
<style>

</style>
<div class="form_background" id="LoginSpace">
            <div class="Login_Space">
                <div class="title">Tìm kiếm<div id="close" onclick="close_log()">X</div>
                </div>
            <?php include "lol.php"?>
    </div>
</div>


