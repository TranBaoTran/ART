<?php include_once "head.php"?>
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
        $html.="<option value='0".$sign[$i]."'>+".$arr[$i]."</option>";
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
                $html.="<option value='1".$si[$j]."'>&nbsp&nbsp-".$ar[$j]."</option>";
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
.top_container a{
    text-decoration:none;
    color:#fffeee;
}
.top_container a:hover{
    color:#ff80ab;
}
.boxrd{
    float: left;
    height:100px;
    padding-top:20px;
    padding-left:50px;
}
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
  margin: 20px 0 10px 0;
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
<div class="banner">
    <h3 class="banner_content">Tìm kiếm</h3>
    </div>
    <div>
        <div class="boxrd">
            <span>Tên sản phẩm</span>    
            <input type="text" style="width:80%;opacity:1;position:static;pointer-events:auto" placeholder="Nhập tên sản phẩm" id="name">
        </div>
        <div class="boxrd">
            <span>Thể loại</span>
            <select id="type" style="width:70%; height:35px; margin-left:5px"><option value="">--Loại--</option><?php echo $html?></select>
        </div>
        <div class="boxrd">
            <span>Giá tiền</span>
            <div slider id="slider-distance" style="margin-left:70px">
            <div>
                <div inverse-left style="width:70%;"></div>
                <div inverse-right style="width:70%;"></div>
                <div range style="left:0%;right:0%;"></div>
                <span thumb style="left:0%;"></span>
                <span thumb style="left:100%;"></span>
                <div sign style="left:0%;">
                <span id="value" class="s1"><?php echo $min?></span>
                </div>
                <div sign style="left:100%;">
                <span id="value" class="s2"><?php echo $max?></span>
                </div>
            </div>
                <input type="range" id="minRanger" value="<?php echo $min?>" max="<?php echo $max?>" min="<?php echo $min?>" step="1" oninput="
                // this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                // let value = (this.value/parseInt(this.max))*100
                // var children = this.parentNode.childNodes[1].childNodes;
                // children[1].style.width=value+'%';
                // children[5].style.left=value+'%';
                // children[7].style.left=value+'%';children[11].style.left=value+'%';
                // children[11].childNodes[1].innerHTML=this.value;
                handleMinRangerInput(this.value)" />

                <input type="range" id="maxRanger"  value="<?php echo $max?>" max="<?php echo $max?>" min="<?php echo $min?>" step="1" oninput="
                // this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                // let value = (this.value/parseInt(this.max))*100
                // var children = this.parentNode.childNodes[1].childNodes;
                // children[3].style.width=(100-value)+'%';
                // children[5].style.right=(100-value)+'%';
                // children[9].style.left=value+'%';children[13].style.left=value+'%';
                // children[13].childNodes[1].innerHTML=this.value;
                handleMaxRangerInput(this.value)" />
            </div>    
        </div>
        <div class="boxrd">
                <input type="button"  class="summit_button" style="margin-left:50px;border-radius:10px" value="TÌM" onclick="find()">
            </div>
    </div>
    <div id="MENU_CONTAIN">
    <div class="MENU_SP" style="display: flex;" id="productWraper">
        
    </div>

    <div style="width:100%;display: flex;justify-content: center;" id="pageWraper">

    </div>
    </div>
<script>
    function renderP(currentPage,allPage,limit,name,type,min,max){
        let html="";
        let start=1;
        let end=5;
        if(currentPage-2>0){
            start=currentPage-2;
            end=currentPage+2;
        }
        if(currentPage+2>allPage){
            start=allPage-4;
            end=allPage;
        }
        if(allPage<=5){
            start=1;
            end=allPage;
        }
        if(currentPage>1){
            html+="<a href='#/'><div class='page_num' onclick='find(1,"+limit+","+createParameter(name)+","+createParameter(type)+","+createParameter(min)+","+createParameter(max)+")'><i class='fa-solid fa-angles-left'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='find("+(currentPage-1)+","+limit+","+createParameter(name)+","+createParameter(type)+","+createParameter(min)+","+createParameter(max)+")'><i class='fa-solid fa-angle-left'></i></div></a> ";
        }
        for(let i=start;i<=end;i++){
            html+="<a href='#/'><div class='page_num";
            if(i==currentPage){
                html+=" active'>"+i+"</div></a> ";
            }
            else{
                html+="' onclick='find("+i+","+limit+","+createParameter(name)+","+createParameter(type)+","+createParameter(min)+","+createParameter(max)+")'>"+i+"</div></a> ";
            }
        }
        if(currentPage<allPage){
            html+="<a href='#/'><div class='page_num' onclick='find("+(currentPage+1)+","+limit+","+createParameter(name)+","+createParameter(type)+","+createParameter(min)+","+createParameter(max)+")'><i class='fa-solid fa-angle-right'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='find("+allPage+","+limit+","+createParameter(name)+","+createParameter(type)+","+createParameter(min)+","+createParameter(max)+")'><i class='fa-solid fa-angles-right'></i></div></a> ";
        }
        $("#pageWraper").html(html); 
        let url=window.location.href.split('?')[0];
        url+="?id=find&page="+currentPage+"&limit="+limit;
        if(name){
          url+="&name="+name;
        }
        if(type){
          url+="&type="+type;
        }
        if(min){
          url+="&min="+min;
        }
        if(max){
          url+="&max="+max;
        }
        window.history.pushState({},'',url);
    }

    function find(page=1,limit=9,paraName,paraType,paraMin,paraMax){
        var name=document.getElementById("name").value;
        var type=document.getElementById("type").value;
        var minRanger=document.getElementById("minRanger").value;
        var maxRanger=document.getElementById("maxRanger").value;
        if(name=="" && type=="" && minRanger==document.getElementById("minRanger").min && maxRanger==document.getElementById("maxRanger").max){
          if(paraName){
            name=paraName;
            document.getElementById("name").value=name;
          }
          if(paraType){
            type=paraType;
            var selectElement = document.getElementById("type");
            for (var i = 0; i < selectElement.options.length; i++) {
              var option = selectElement.options[i];
              if (option.value === type) {
                option.selected = true;
                break;
              }
            }
          }
          if(paraMin){
            minRanger=paraMin;
            document.getElementById("minRanger").value=paraMin;
            handleMinRangerInput(paraMin);
          }
          if(paraMax){
            maxRanger=paraMax;
            document.getElementById("maxRanger").value=paraMax;
            handleMaxRangerInput(paraMax);
          }
        }
        $.ajax({
          url:"/ART/api/getFind.php?name="+name+"&type="+type+"&min="+minRanger+"&max="+maxRanger+"&limit="+limit+"&page="+page,
          type: "GET",
          dataType: 'json',
            success : function (result){
                var html="";
                $.each(result['member'], function (key, item){
                                html += "<div class='SP_CON shadow'><div class='SP_CON1'><img src='"+item['img']+"'></div>";
                                html += "<div class='SP_CON2'><div><h3>"+item['tensp']+"</h3><br><a class='price'>"+item['gia']+" VNĐ</a><br></div>";
                                html += "<div style='padding-top: 20px;'><a class='btn' onclick='singlePage(\""+item['img']+"\",\""+item['tensp']+"\","+item['gia']+","+item['soluong']+","+item['masp']+")'>Thêm vào giỏ</a></div></div></div>";
                             });             
                $('#productWraper').html(html);
                renderP(result.current_page,result.allPage,result.limit,name,type,minRanger,maxRanger);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố');
            },
        });
    }

    const queryString = window.location.search;
    const urlParam = new URLSearchParams(queryString);
    find(urlParam.get('page') || 1,urlParam.get('limit')|| 9,urlParam.get('name'),urlParam.get('type'),urlParam.get('min'),urlParam.get('max'));
</script>
