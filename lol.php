<?php include "head.php"?>
<?php 
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

    $sqlmax="select max(gia) as total from sanpham where tinhtrang=1";
    $sqlmin="select min(gia) as total from sanpham where tinhtrang=1";

    $db=new Database();
    $max=intval($db->Take($sqlmax));
    $min=intval($db->Take($sqlmin));
    $db->Close();
?>
<style>
.outCon{
  top:0;
  left:0;
  bottom:0;
  right:0;
  background-color: rgba(0,0,0,0.4); 
  margin:0;
  padding:0;
  height:100%;
  position: fixed;
}
.outer{
    background-color: white;
    padding-top: 10px;
    margin-top: 10px;
    width: 30%;
    height:55%;
    margin-left:550px;
    margin-top:100px;
}
[slider] {
  width: 300px;
  position: relative;
  height: 5px;
  margin: 45px 0 10px 0;
}

[slider] > div {
  position: absolute;
  left: 13px;
  right: 15px;
  height: 5px;
}
[slider] > div > [inverse-left] {
  position: absolute;
  left: 0;
  height: 5px;
  border-radius: 10px;
  background-color: #CCC;
  margin: 0 7px;
}

[slider] > div > [inverse-right] {
  position: absolute;
  right: 0;
  height: 5px;
  border-radius: 10px;
  background-color: #CCC;
  margin: 0 7px;
}


[slider] > div > [range] {
  position: absolute;
  left: 0;
  height: 5px;
  border-radius: 14px;
  background-color: #d02128;
}

[slider] > div > [thumb] {
  position: absolute;
  top: -7px;
  z-index: 2;
  height: 20px;
  width: 20px;
  text-align: left;
  margin-left: -11px;
  cursor: pointer;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
  background-color: #FFF;
  border-radius: 50%;
  outline: none;
}

[slider] > input[type=range] {
  position: absolute;
  pointer-events: none;
  -webkit-appearance: none;
  z-index: 3;
  height: 14px;
  top: -2px;
  width: 100%;
  opacity: 0;
}

div[slider] > input[type=range]:focus::-webkit-slider-runnable-track {
  background: transparent;
  border: transparent;
}

div[slider] > input[type=range]:focus {
  outline: none;
}

div[slider] > input[type=range]::-webkit-slider-thumb {
  pointer-events: all;
  width: 28px;
  height: 28px;
  border-radius: 0px;
  border: 0 none;
  background: red;
  -webkit-appearance: none;
}

div[slider] > input[type=range]::-ms-fill-lower {
  background: transparent;
  border: 0 none;
}

div[slider] > input[type=range]::-ms-fill-upper {
  background: transparent;
  border: 0 none;
}

div[slider] > input[type=range]::-ms-tooltip {
  display: none;
}

[slider] > div > [sign] {
  opacity: 0;
  position: absolute;
  margin-left: -11px;
  top: -39px;
  z-index:3;
  background-color: #d02128;
  color: #fff;
  width: 100px;
  height: 28px;
  border-radius: 28px;
  -webkit-border-radius: 28px;
  align-items: center;
  -webkit-justify-content: center;
  justify-content: center;
  text-align: center;
}

[slider] > div > [sign]:after {
  position: absolute;
  content: '';
  left: 0;
  border-radius: 16px;
  top: 19px;
  border-left: 14px solid transparent;
  border-right: 14px solid transparent;
  border-top-width: 16px;
  border-top-style: solid;
  border-top-color: #d02128;
}

[slider] > div > [sign] > span {
  font-size: 12px;
  font-weight: 700;
  line-height: 28px;
}

[slider]:hover > div > [sign] {
  opacity: 1;
}
</style>
<div class="outCon">
<div class="outer">
<div class="title">TÌM KIẾM<div id="close" onclick="close_log()">X</div></div>
<div class="Login_Block">
    <div class="Log_Space1">Tên sản phẩm</div>
    <div class="Log_Space2" style="padding-right:12px"><input type="text" style="width:80%;opacity:1;position:static;pointer-events:auto" placeholder="Nhập tên sản phẩm" id="logna" name="logna"></div>
</div>
<div class="Login_Block">
    <div class="Log_Space1">Loại</div>
    <div class="Log_Space2" style="padding-right:12px"><select id="brandInput" style="width:70%; height:35px; margin-left:5px"><option value="">--Loại--</option><?php echo $html?></select></div>
</div>
<div class="Login_Block">
  <div class="Log_Space1">Giá tiền (VNĐ)</div>
</div>
<div slider id="slider-distance" style="margin-left:70px">
  <div>
    <div inverse-left style="width:70%;"></div>
    <div inverse-right style="width:70%;"></div>
    <div range style="left:0%;right:0%;"></div>
    <span thumb style="left:0%;"></span>
    <span thumb style="left:100%;"></span>
    <div sign style="left:0%;">
      <span id="value"><?php echo $min?></span>
    </div>
    <div sign style="left:100%;">
      <span id="value"><?php echo $max?></span>
    </div>
  </div>
    <input type="range" value="<?php echo $min?>" max="<?php echo $max?>" min="<?php echo $min?>" step="1" oninput="
    this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
    let value = (this.value/parseInt(this.max))*100
    var children = this.parentNode.childNodes[1].childNodes;
    children[1].style.width=value+'%';
    children[5].style.left=value+'%';
    children[7].style.left=value+'%';children[11].style.left=value+'%';
    children[11].childNodes[1].innerHTML=this.value;" />

    <input type="range" value="<?php echo $max?>" max="<?php echo $max?>" min="<?php echo $min?>" step="1" oninput="
    this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
    let value = (this.value/parseInt(this.max))*100
    var children = this.parentNode.childNodes[1].childNodes;
    children[3].style.width=(100-value)+'%';
    children[5].style.right=(100-value)+'%';
    children[9].style.left=value+'%';children[13].style.left=value+'%';
    children[13].childNodes[1].innerHTML=this.value;" />
</div>
<div class="summit_space">
      <input type="button" class="summit_button" value="TÌM">
</div>
</div>
</div>