<?php
    if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="insertper")
        include_once("insertper_mh.php");		
    else if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="deleteper")
        include_once("deleteper_mh.php");

    include_once("ed_permission.php");
?>
<div class="container" id="ad_body">
    <div id="bd_info"></div>
    <div style="padding-top:70px; padding-left:20px; padding-right:20px" id=bd_content>
    <h2 style="padding-top:40px" id="list">Phân Quyền</h2>
    <br>
    <br>
<div>
    <table style="margin-left:160px">
        <thead>
            <tr>
                <th>Mã quyền</th>
                <th style="width:400px">Quyền</th>
                <th style="width:100px">Quản lý</th>
                <th style="width:100px">Admin</th>
                <th style="width:100px">Nhân viên</th>
            </tr>
        </thead>
    <?php
        include_once("sqlconn.php");
        $sql = "select * from chucnang";
        $result = dataProvider::executeQuery($sql);
        while ($row=mysqli_fetch_array($result)){ ?>
            <tbody>
            <tr>
            <td><?php echo $row['maquyen']; ?></td>
            <td><?php echo $row['tenquyen']; ?></td>
            <td>
                <?php $sql1="select * from phanquyen where manq='QL'";
                $result1 = dataProvider::executeQuery($sql1);
                while ($row1 = mysqli_fetch_array($result1)){
                    if ($row1['maquyen'] == $row['maquyen']){
                        echo "<img src='img/icons/tick.png' style='width:20px; height:20px'>";
                    }
                }           
            ?>
            </td>
            <td><?php $sql1="select * from phanquyen where manq='AD'";
                $result1 = dataProvider::executeQuery($sql1);
                while ($row1 = mysqli_fetch_array($result1)){
                    if ($row1['maquyen'] == $row['maquyen']){
                        echo "<img src='img/icons/tick.png' style='width:20px; height:20px'>";
                    }
                }           
            ?>
            </td>
            <td>
            <?php $sql1="select * from phanquyen where manq='NV'";
                $result1 = dataProvider::executeQuery($sql1);
                while ($row1 = mysqli_fetch_array($result1)){
                    if ($row1['maquyen'] == $row['maquyen']){
                        echo "<img src='img/icons/tick.png' style='width:20px; height:20px'>";
                    }
                }           
            ?>
            </td>
            <td style="align:right">&nbsp;</td>
            <td style="align:right"></td>
            </tr>
            </tbody>
            <?php
            } ?>
    </table>
    <br>
    <br>
    <div style="float:right; margin-right:50px">
    <ul style="display:inline">
        <li><a href="?view=show5&manhinh=insertper" class="btn_ins" type="text">Thêm quyền</a></li>
        <li><a href="?view=show5&manhinh=deleteper" class="btn_ins" type="text">Xóa quyền</a></li>
    </ul></div>
</div>


        <style>
.container {
    width: auto;
    padding-right: 30px;
    padding-left: 30px;
    margin-right: auto;
    margin-left: auto;
}
* {
    margin: 0;
    padding: 0;
    max-width: 100%;
}

table {
    width: auto;
    border-collapse: collapse;
    overflow: hidden;
    padding-top: 10px;
}
a.edit_icon{
    background:url(img/icons/edit.gif) no-repeat left top;
    display:inline-block;
    width: 20px;
    height: 20px;
}
a.delete_icon{
    background:url(img/icons/action_delete.gif) no-repeat left top;
    display:inline-block;
    width: 20px;
    height: 20px;
}
a.edit_inline{
    background:url(img/icons/edit.gif) no-repeat left top;
    display:inline-block;
    line-height:16px;
    color: #069 !important;
    font-size:10px;
    padding-left:20px;
    margin-right:5px;
}
a.delete_inline{
    background:url(img/icons/action_delete.gif) no-repeat left top;
    display:inline-block;
    line-height:16px;
    color: #D23333 !important;
    font-size:10px;
    padding-left:20px;
    margin-right:5px;
}
.page_num{
    float: left;
    height: 33px;
    padding-top: 7px ;
    width: 40px;
    font-size: 20px;
    margin: 10px;
    display: flex;
    justify-content: center;
    text-align: center;
    background-color: #ff80ab;
    color: #fffeee;
    z-index: 10;
}
.page_num.active{
    background-color:#c94f7c;
}
.page_num:hover{
    background-color: #c94f7c;
    cursor: pointer;
}
.btn_ins{
    height: 33px;
    padding-top: 7px ;
    width: 130px;
    font-size: 18px;
    margin: 10px;
    display: flex;
    justify-content: center;
    text-align: center;
    background-color: #ff80ab;
    color: #fffeee;
    z-index: 10;
    border: 0.2px solid #df678f;
    border-radius: 10%;
}
.btn_ins.active{
    background-color:#c94f7c;
}
.btn_ins:hover{
    background-color: #c94f7c;
    cursor: pointer;
}
.btn_con{
    padding: 20px;
    justify-content: center;
}
</style>