<?php include_once "head.php" ?>
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
?>
<div class="none5" style="text-align:center;display:flex;justify-content:center">
    <div class="container2">
    <br><br><br>
    <h3 style="font-size: 25px;">&nbspHãy chọn thông tin muốn thống kê</h3>
    <br><br>
    <span>Từ&nbsp&nbsp&nbsp</span>
    <input type="date" id="st" style="width:30%">
    <br><br>
    <span>Đến&nbsp&nbsp</span>
    <input type="date" id="ed" style="width:30%">
    <br><br>
    <span>Loại&nbsp&nbsp</span>
    <select id="type" style="width:30%">
        <option value="">--Loại--</option>
        <?php echo $html?>
    </select>
    <br><br>
    <span>Kiểu&nbsp&nbsp</span>
    <select id="otype" style="width:30%">
        <option value="1" selected>Doanh thu</option>
        <option value="2">Doanh số</option>
    </select>
    <br>
    <br>
    <span>Sắp xếp&nbsp&nbsp</span>
    <select id="sort" style="width:30%">
        <option value="1" selected>Giảm dần</option>
        <option value="2">Tăng dần</option>
    </select>
    <br>
    <br>
    <button class="abutton" style="margin-left: 210px;background-color: #ff80ab;" onclick="return show()">Thống kê tình hình kinh doanh sản phẩm</button>
    <button class="abutton" style="margin-left: 250px;margin-top:20px;background-color: #ff80ab;" onclick="sortTop()">Thống kê sản phẩm bán chạy</button>
    </div>
    <div class="container2" id="pChart">
        <br>
        <br>
        <h2>&nbspBảng thống kê sản phẩm từ&nbsp<span id="start"></span>&nbspđến&nbsp<span id="end"></span></h2>
        <br>
        <h2 id="donvi" style="font-size: 20px;"></h2>
        <br>
        <main id="mainChart" style="display: none;">
        <div id="pie-chart"></div>
        </main>
        <div id="myChart" style="width:100%; max-width:700px; height:500px;margin-left:20px;display:none"></div>
        <!-- <div id="data">
            <span>Cọ vẽ : 10</span>
        </div> -->
    </div>    
</div>
<script>
    var pieOptions = {
        backgroundColor: 'transparent',
        pieHole: 0.4,
        colors: [ "cornflowerblue", 
                "olivedrab", 
                "orange", 
                "tomato", 
                "crimson", 
                "purple", 
                "turquoise", 
                "forestgreen", 
                "navy", 
                "gray"],
        pieSliceText: 'value',
        tooltip: {
        text: 'percentage'
        },
        fontName: 'Open Sans',
        chartArea: {
        width: '100%',
        height: '94%'
        },
        legend: {
        textStyle: {
            fontSize: 13
        }
        }
    };

    function convertMoney(num){
        return num.toLocaleString('it-IT',{style: 'currency',currency: 'VND'})
    }

    function PieChartMoney(tenloai,tienloai,tienfull){
        monType=parseInt(tienloai);
        monFull=parseInt(tienfull);
        if(monType==0 && monFull==0){
            alert("Khoảng thời gian này không có đơn hàng nào");
            return false;
        }
        var pieData = google.visualization.arrayToDataTable([
            ['Loại', 'Doanh thu'],
            [ tenloai, monType ],
            ['Sản phẩm khác', monFull-monType],
        ]);
        var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        pieChart.draw(pieData, pieOptions);
    }

    function BarChart(member,otype){
        if(member.length==0){
            alert("Khoảng thời gian này không có đơn hàng nào");
            return false;
        }
        let data=[];
        let tmp='';
        let money=0;
        if(otype=="1"){
            tmp+="VNĐ";
        }
        else{
            tmp+="Sản phẩm";
        }
        data.push(['Sản phẩm',tmp]);
        for(let i=0;i<member.length;i++){
            data.push([member[i]['tensp'],parseInt(member[i]['total'])]);
        }
        var dat = google.visualization.arrayToDataTable(data);
        var opt = {
            title:'Thống kê doanh số bán chạy'
        };
        var chart = new google.visualization.BarChart(document.getElementById('myChart'));
        chart.draw(dat, opt);
    }

    function show(){
        var dstart=document.getElementById('st').value;
        var dend=document.getElementById('ed').value;
        var type=document.getElementById('type').value;
        var otype=document.getElementById('otype').value;
        if(dstart==""){
            alert("Vui lòng chọn ngày băt đầu");
            return false;
        }
        if(dend==""){
            alert("Vui lòng chọn ngày kết thúc");
            return false;
        }
        if(dend<dstart){
            alert("Ngày kết thúc không được lớn hơn ngày bắt đầu");
            return false;
        }
        if(type==""){
            alert("Vui lòng chọn loại sản phẩm để thống kê");
            return false;
        }
        document.getElementById('start').innerHTML=dstart;
        document.getElementById('end').innerHTML=dend;
        if(otype=='1'){
            document.getElementById('donvi').innerHTML='Đơn vị: VNĐ'
        }
        else{
            document.getElementById('donvi').innerHTML='Đơn vị: Sản phẩm'
        }
        var myChart=document.getElementById('myChart');
        $.ajax({
            url:'/ART/api/tk.php',
            type: "POST",
            data: {
                start:dstart,
                end:dend,
                type:type,
                otype:otype
            },
            dataType: "json",
            success : function (result){
                if(result['status']=="1"){
                    // alert(result['member']['ten']+" "+result['member']['total']+" "+result['full']);
                    const mainChart=document.getElementById('mainChart');
                    mainChart.style.display='flex';
                    if(myChart.style.display!="none"){
                        myChart.style.display="none";
                    }
                    PieChartMoney(result['member']['ten'],result['member']['total'],result['full']);
                }
                else{
                    alert("Đã có lỗi xảy ra");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
                alert('Lỗi sml r đừng cố');
            },
        });
    }

    function sortTop(){
        var dstart=document.getElementById('st').value;
        var dend=document.getElementById('ed').value;
        var sort=document.getElementById('sort').value;
        var otype=document.getElementById('otype').value;
        if(dstart==""){
            alert("Vui lòng chọn ngày băt đầu");
            return false;
        }
        if(dend==""){
            alert("Vui lòng chọn ngày kết thúc");
            return false;
        }
        if(dend<dstart){
            alert("Ngày kết thúc không được lớn hơn ngày bắt đầu");
            return false;
        }
        document.getElementById('start').innerHTML=dstart;
        document.getElementById('end').innerHTML=dend;
        if(otype=='1'){
            document.getElementById('donvi').innerHTML='Đơn vị: VNĐ'
        }
        else{
            document.getElementById('donvi').innerHTML='Đơn vị: Sản phẩm'
        }
        var mainChart=document.getElementById('mainChart');
        var myChart=document.getElementById('myChart');
        $.ajax({
            url:'/ART/api/top.php',
            type: "POST",
            data: {
                start:dstart,
                end:dend,
                sort:sort,
                otype:otype
            },
            dataType: "json",
            success : function (result){
                if(result['status']=="1"){
                    myChart.style.display="flex";
                    if(mainChart.style.display!="none"){
                        mainChart.style.display="none";
                    }
                    BarChart(result['member'],otype);
                }
                else{
                    alert("Đã có lỗi xảy ra");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
                alert('Lỗi sml r đừng cố');
            },
        });
    }
</script>