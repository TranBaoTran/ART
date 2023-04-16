function menu2(){
    var M2= document.getElementById("top2");
    if (M2.style.display === "none") {
        M2.style.display = 'flex';

    } 
    else {
        M2.style.display = 'none';
    }
}
function show1() {
    document.getElementById("show1").addEventListener("click", function() {
        document.querySelector(".none1").style.display = "flex";
        document.querySelector(".none2").style.display = "none";
        document.querySelector(".none3").style.display = "none";
        document.querySelector(".none4").style.display = "flex";
        document.querySelector(".none5").style.display = "none";
        //document.getElementById("sh").className = "";
    })
}
function show2() {
    document.getElementById("show2").addEventListener("click", function() {
        document.querySelector(".none2").style.display = "flex";
        document.querySelector(".none1").style.display = "none";
        document.querySelector(".none3").style.display = "none";
        document.querySelector(".none4").style.display = "none";
        document.querySelector(".none5").style.display = "none";
    })
}

function show3() {
    document.getElementById("show3").addEventListener("click", function() {
        document.querySelector(".none3").style.display = "flex";
        document.querySelector(".none1").style.display = "none";
        document.querySelector(".none2").style.display = "none";
        document.querySelector(".none4").style.display = "none";
        document.querySelector(".none5").style.display = "none";
    })
}

function show4(){
    document.getElementById("show4").addEventListener("click", function() {
        document.querySelector(".none3").style.display = "none";
        document.querySelector(".none1").style.display = "none";
        document.querySelector(".none2").style.display = "none";
        document.querySelector(".none4").style.display = "none";
        document.querySelector(".none5").style.display = "flex";
    })
}

function reload() {
    document.getElementById("reload").addEventListener("click", function() {
        document.querySelector(".none3").style.display = "flex";
        document.querySelector(".none1").style.display = "none";
        document.querySelector(".none2").style.display = "none";
        document.querySelector(".none4").style.display = "none";
        document.querySelector(".none5").style.display = "none";
    })
}

function xoa() {
    document.getElementById("xacnhanxoa").style.display = "block";
  
}
function xacnhan(UID) {
    var productList = JSON.parse(localStorage.getItem('productList'));
	for (var i=0;i<productList.length;i++)
    {
        if (productList[i].id === String(UID))
        {
            if (confirm("Xóa sản phẩm này?"))
                productList.splice(i,1);
        }
    }
	localStorage.setItem('productList',JSON.stringify(productList));
    listPr();
}


function huy() {
    document.getElementById("xacnhanxoa").style.display = "none";
}
function them() {
        document.getElementById("addsp").setAttribute("style", "opacity:1");
}
function them1() {
    document.getElementById("editUser").setAttribute("style", "opacity:1", "padding: 50px");
}
function them2() {
    document.getElementById("searchfday").setAttribute("style", "opacity:1");
}
function sua() {
    document.getElementById("addsp").setAttribute("style", "opacity:1");

}
function thugon() {
    document.getElementById("addsp").style.display = "none";

}
function thugon2() {
    document.getElementById("editUser").style.display = "none";

}

function listPr()
{
    let productList = JSON.parse(localStorage.getItem('productList'));
    let product = '';
    let count = 1;
    productList.forEach(element => {
        product += `<tr>
        <td></td>
        <td>${count}</td>
        <td></td>
        <td>${element.id}</td>
        <td></td>
        <td style="width: 150px">${element.brand}</td>
        <td>${element.name}</td>
        <td></td>
        <td style="width:150px;">&emsp;&emsp;${element.price}</td>
        <td></td>
        <td>&emsp;<img src="${element.img}"style="witdh:100px;height:55px"></td>
        <td></td>
        <td></td>
        <td style="width:150px; padding-top: 53px">
            <input type="button" id="btsua" value="Sửa" onclick="sua();">
            <input type="button" id="btxoa" value="Xóa" onclick="xacnhan(${element.id});">
        </td>
        <td>
        </td>
    </tr>`
        count++;
    });
    document.getElementById("key").innerHTML = product;
}
function editSP()
{
    let productList = JSON.parse(localStorage.getItem('productList'));
    let ID = document.getElementById("idsp").value;
    let op = document.getElementById('theloai');
    let name = document.getElementById("namesp").value;
    let price = document.getElementById("giasp").value;
    for (let i=0;i<productList.length;i++)
    {
        if (productList[i].id == ID)
        {
            switch (op.value){
                case 'Innisfree':
                    productList[i].brand = "Innisfree";
                    break;
                case 'Maybelline':
                    productList[i].brand = "Maybelline";
                    break;
                case 'Hadalabo':
                    productList[i].brand = "HADALABO";
                    break;        
            }
            productList[i].name = name;
            productList[i].price = price;
        }
    }
    localStorage.setItem('productList',JSON.stringify(productList));
    listPr();
}
function addImg(){
    let img = document.querySelector("#addimg");
    img.addEventListener('change', function () {
        console.log(this);
    
        var reader = new FileReader();
        reader.onload = function (e) {
            console.log(reader.result + '->' + typeof reader.result)
            var thisImage = reader.result;
            localStorage.setItem("imgData", thisImage);
        };
        reader.readAsDataURL(this.files[0]);
    });
}
function addSP()
{
    let productList = JSON.parse(localStorage.getItem('productList'));
    let ID = document.getElementById("idsp").value;
    let op = document.getElementById('theloai');
    let brand;
    let name = document.getElementById("namesp").value;
    let price = document.getElementById("giasp").value;
    var dataImage = localStorage.getItem('imgData');
    for (let i=0;i<productList.length;i++)
    {
        if (productList[i].id == ID){
            alert("San pham hien da co trong kho.");
            dataImage = "";
            localStorage.setItem('imgData',JSON.stringify(dataImage));
            return false;
        }
    }
    switch (op.value){
        case 'Innisfree':
            brand = "Innisfree";
            break;
        case 'Maybelline':
            brand = "Maybelline";
            break;
        case 'Hadalabo':
            brand = "HADALABO";
            break;                       
    }
    console.log(dataImage);
    let product = {id: ID, brand: brand, img: dataImage, name: name, price: price};
    productList.push(product);
    localStorage.setItem('productList',JSON.stringify(productList));
    dataImage = "";
    localStorage.setItem('imgData',JSON.stringify(dataImage));
    location.reload();
}

function deleUser(uname)
{
    console.log("username: "+uname);
	var userArray = JSON.parse(localStorage.getItem('guest'));
	for (var i=0;i<userArray.length;i++)
	{
		if (userArray[i].maTK === String(uname))
		{
			if (confirm('Xóa tài khoản này?'))
				userArray.splice(i,1);
		}	
	}
	localStorage.setItem('guest',JSON.stringify(userArray));
    listUser();
}
function listUser()
{
    let userList = JSON.parse(localStorage.getItem('guest'));
    let user = '';
    let count = 1;
    for(let i=0;i<userList.length;i++){
        user += `<tr>
        <td>${count}</td>
        <td>${userList[i].maTK}</td>
        <td style="width:220px">${userList[i].fullname}</td>
        <td style="width:80px">${userList[i].loginname}</td>
        <td style="width:90px" class="${userList[i].status=='0'? 'active':'lock'}">${userList[i].status=='0' ? 'ACTIVE': 'LOCK'}</td>
        <td style="width:110px" class="${userList[i].accountType=='ad'? 'lock':'active'}">${userList[i].accountType=='ad' ? 'ADMIN': 'USER'}</td>
        <td>${userList[i].phone}</td>
        <td></td>
        <td style="width: 200px">${userList[i].mail}</td>
        <td>&emsp;</td>
        <td style="width:210px;">
            <input type="button" id="btsua" value="Sửa" onclick="adminPer(${userList[i].maTK});">
            <input type="button" id="btxoa" value="Xóa" onclick="deleUser(${userList[i].maTK});">
            <input type="button" id="btactive" value="Active" onclick="activeAcc(${userList[i].maTK});">`
        if(userList[i].accountType=='kh'){
            user+= `<input type="button" id="btxoa" value="Xem lại đơn hàng" style="width:150px;text-align:center;" onclick="printBillList(${userList[i].maTK})">`
        }
        user+=`</td>
        <td>
        </td>
        </tr>`
        count++;
    }
    document.getElementById("user").innerHTML = user;
}
function adminPer(UID)
{
    let userList = JSON.parse(localStorage.getItem('guest'));
    for (let i=0;i<userList.length;i++)
    {
        if (userList[i].maTK === String(UID))
        {
            if (confirm("Thay đổi quyền hạn của tài khoản này?"))
            {
                if (userList[i].accountType === "ad")
                    userList[i].accountType = 'kh';
                else if (userList[i].accountType === "kh")
                    userList[i].accountType = 'ad';
            }        
        }
    }
    localStorage.setItem('guest',JSON.stringify(userList));
    listUser();
}
function stats()
{
	var userArray = JSON.parse(localStorage.getItem('guest'));
	var d = new Date();
	var day = d.getDate();
	var month = d.getMonth();
	var year = d.getFullYear();
    console.log("day: "+day);
    console.log("month: "+month);
    console.log("year: "+year);
	for (var i=1;i<userArray.length;i++)
	{
		if (year-userArray[i].yearS >= 1)
			userArray[i].status = "1";
		if ((userArray[i].yearS == year) && (month-userArray[i].monthS > 1))
			userArray[i].status = "1";
	}
	localStorage.setItem('guest',JSON.stringify(userArray));
}
function editAcc(){
    let userList = JSON.parse(localStorage.getItem('guest'));
    let ID = document.getElementById("nid").value;
    let fname = document.getElementById("nfname").value;
    let lname = document.getElementById(("nlname")).value;
    let nphone = document.getElementById("nphone").value;
    let nmail = document.getElementById("nmail").value;
    let pass = document.getElementById("npass").value;
    let passa = document.getElementById("passa").value;
    if (pass != passa)
    {
        alert("Mật khẩu không chính xác!");
        return;
    }
    for (let i=0;i<userList.length;i++){
        if (userList[i].maTK === String(ID))
        {
            userList[i].fullname = fname;
            userList[i].loginname = lname;
            userList[i].pass = pass;
            userList[i].phone = nphone;
            userList[i].mail = nmail;
        }
    }
    localStorage.setItem('guest',JSON.stringify(userList));
    location.reload();
}
function activeAcc(UID){
    let userList = JSON.parse(localStorage.getItem('guest'));
    var d = new Date();
	var day = d.getDate();
	var month = d.getMonth();
	var year = d.getFullYear();
    for (let i=0;i<userList.length;i++){
        if (userList[i].maTK == String(UID))
        {
            if (userList[i].status == "1")
            {
                if (confirm("Kích hoạt tài khoản này?"))
                {    
                    userList[i].status = "0";
                    userList[i].dayS = day;
                    userList[i].monthS = month;
                    userList[i].yearS= year;
                }    
            }
            else
            {
                if (confirm("Khóa tài khoản này?"))
                    userList[i].status = "1";
            }
        }
    }
    localStorage.setItem('guest',JSON.stringify(userList));
    listUser();
}
function disPass(){
    const npassa = document.querySelector('#passa');
    const dis = document.querySelector('#cmm');
    dis.addEventListener('click', function() {
        const currentType = npassa.getAttribute('type');
        npassa.setAttribute('type', currentType === 'password' ? 'text' : 'password');
        //alert("FAK U");
    })
    const npass = document.querySelector('#npass');
    const disp = document.querySelector('#cmml');
    disp.addEventListener('click', function() {
        const currentType = npass.getAttribute('type');
        npass.setAttribute('type', currentType === 'password' ? 'text' : 'password');
        //alert("FAK U");
    })    
}

function printBillList(maKH){

    printOldBillPlace();
    printEachBill(maKH);
}

function printMaDon(ma){
    let contentString='';
    let str;
    let proPrice;
    let proSl;
    let Total=0;
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    userCart.forEach(element => {
        if(element.maDon==ma)
        {
            str = element.gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(element.sl);
            Total=Total + (proPrice*proSl);
        }
    });
    const tot=convertMoney(Total);
    contentString+=`<div onclick="printBillItem(${ma})" class="prCart shadow">
    <div class="prCart_it1"><img src="img/icon1.png"></div>
    <div class="prCart_it2">
    <p>Mã đơn hàng: ${ma}</p>
    <p>${tot}</p>
    </div>
    </div>`
    return contentString;
}

function printBillItem(ma){
    let contentString='';
    let str;
    let proPrice;
    let proSl;
    let tot=0;
    let Total;
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    userCart.forEach(element =>{
            if(element.maDon==ma){
            str = element.gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(element.sl);
            Total=proPrice*proSl;
            tot= tot+Total;
            contentString+=`<div class="prCart shadow">
            <div class="prCart_it1"><img src="${element.img}"></div>
            <div class="prCart_it2">
            <p>${element.ten}</p>
            <p>x${element.sl}</p>
            <p>${convertMoney(Total)}</p>
            </div>
            </div>`
    }});
    const prTot=convertMoney(tot);
    billCon.innerHTML=contentString;
    const prTotal=document.getElementById("prTotal");
    prTotal.innerHTML=convertMoney(prTot);
}

function printEachBill(userID){
    const billCon=document.getElementById("billCon");
    let contentString='';
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    let str;
    let proPrice;
    let proSl;
    let Total=0;
    for(let i=1;i<userCart.length-1;i++){
        if(userCart[i].maKH==userID && userCart[i].statusKH!='0'){
            str = userCart[i].gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(userCart[i].sl);
            Total=Total + (proPrice*proSl);
            if(userCart[i].maDon!=userCart[i+1].maDon)
            {
                contentString+=printMaDon(userCart[i].maDon);
            }
            else
            {
                continue;
            }
        }
    }
    if(userCart[userCart.length-1].maKH==userID && userCart[userCart.length-1].statusKH!='0'){
        contentString+=printMaDon(userCart[userCart.length-1].maDon);
            str = userCart[userCart.length-1].gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(userCart[userCart.length-1].sl);
            Total=Total + (proPrice*proSl);
    }
    const prTot=convertMoney(Total);
    billCon.innerHTML=contentString;
    const prTotal=document.getElementById("prTotal");
    prTotal.innerHTML=convertMoney(prTot);
}

function printOldBillPlace(){
    const billPlace=document.getElementById("billPlace");
    const contentString=`<div class="form_background" id="LoginSpace" style="display: block;">
    <div class="Login_Space" style="top:120px;">
        <div class="title" style="font-size:20px ;"><b>HOÁ ĐƠN</b><div id="close" onclick="close_log()">X</div></div>
        <div class="billContainer" id="billCon">
            </div>
        <div class="title" style="height:50px">
        <p>Tổng : <span id="prTotal"></span></p>
        </div>
    </div>`;
    billPlace.innerHTML=contentString;
}

function close_log() {
    var LIP = document.getElementById("LoginSpace");
    LIP.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == document.getElementById("LoginSpace")) {
        document.getElementById("LoginSpace").style.display = "none";
    }
}

//cart
function listCart(){
    let listCart = JSON.parse(localStorage.getItem('userCart'));
    let cart = '';
    let count=1;
    for (let i=1;i<listCart.length;i++)
    {
        if (listCart[i].statusKH === "1")
        {
            let sup = listCart[i].maKH*count;
            cart += `<tr>
            <td>`+i+`</td>
            <td style="width: 80px">&emsp;`+listCart[i].maKH+`</td>
            <td style="width: 70px">`+listCart[i].maSP+`</td>
            
            <td style="width: 260px">`+listCart[i].ten+`</td>
    
            <td><img src="`+listCart[i].img+`" style="witdh:100px;height:100px"></td>
            
            <td style="width:150px" class="${listCart[i].statusAD=='0'? 'lock':'active'}">${listCart[i].statusAD=='0' ? 'Chưa xác nhận': 'Đã xác nhận'}</td>
            <td td style="width: 70px">`+listCart[i].sl+`</td>
            <td>`+listCart[i].gia+`</td>
            <td>` + listCart[i].daycr + `</td>
            <td class="sub-menu-parent">
                <input type="button" id="btax" value="Xác nhận" onclick="axceptCart(`+sup+`);">
                <input type="button" id="btxoa" value="Xóa" onclick="deleCart(`+sup+`);">
            </td>
        </tr>`;
            count++;
        }
    }
    document.getElementById("cart").innerHTML = cart;
}
function axceptCart(UID){
    let cartList = JSON.parse(localStorage.getItem('userCart'));
    let count = 1;
    for (let i=1;i<cartList.length;i++){
        let sup = cartList[i].maKH*count;
        if (sup === UID)
        {
            if (cartList[i].statusAD === "1")
                alert("Đơn hàng đã được xác nhận");
            else if (cartList[i].statusAD === "0") {
                if (confirm("Xác nhận đã thanh toán cho sản phẩm này?"))
                {
                    cartList[i].statusAD = "1";
                    //listCart[i].statusKH = "0";
                }
            }    
        }
        count++;
    }
    localStorage.setItem('userCart',JSON.stringify(cartList));
    listCart();
}
function deleCart(UID){
    let cartList = JSON.parse(localStorage.getItem('userCart'));
    let count = 1;
    for (let i=1;i<cartList.length;i++){
        let sup = cartList[i].maKH*count;
        if (sup === UID)
        {
            if (cartList[i].statusAD === "0")
                alert("Đơn hàng vẫn chưa được xử lí, không thể xóa.");
            else if (cartList[i].statusAD === "1") {
                if (confirm("Xác nhận xóa đơn hàng này?"))
                {
                    cartList.splice(i,1);
                    break;
                    //listCart[i].statusKH = "0";
                }
            }    
        }
        count++;
    }
    localStorage.setItem('userCart',JSON.stringify(cartList));
    listCart();
}
function Logout() {
    localStorage.removeItem("logvar");
    localStorage.removeItem("username");
    localStorage.removeItem("userId");
    window.location = "root.html";
}

function tf_isthis(year, month, day) {
    if (month < 3) {
        year--;
        month += 12;
    }
    return 365 * year + year / 4 - year / 100 + year / 400 + (153 * month - 457) / 5 + day - 306;
}

function findday() {
    var date1 = document.getElementById("dateinput").value.split('-');
    var date2 = document.getElementById("dateinput2").value.split('-');
    var day1 = parseInt(date1[2]);
    var month1 = parseInt(date1[1]);
    var year1 = parseInt(date1[0]);
    var day2 = parseInt(date2[2]);
    var month2 = parseInt(date2[1]);
    var year2 = parseInt(date2[0]);

    // document.getElementById("demo").innerHTML = tf_isthis(year1, month1, day1) - tf_isthis(year2, month2, day2);
    let userCart = JSON.parse(localStorage.getItem('userCart'));
    let count = 1;
    let count2 =0;
    let kq = "";

    var cartList=[];

    userCart.forEach(element => {
        if(element.statusKH=='1'){
            cartList.push(element);
        }
    });

    for (let i = 0; i < cartList.length; i++) {
        var date3 = cartList[i].daycr.split('/');
        var year3 = parseInt(date3[2]);
        var month3 = parseInt(date3[1]);
        var day3 = parseInt(date3[0]);
        // document.getElementById("nope").innerHTML = day3;
       if ((tf_isthis(year1, month1, day1) - tf_isthis(year3,month3,day3)) <= 0 && (tf_isthis(year2, month2, day2) - tf_isthis(year3,month3,day3)) >= 0) {
            let sup = cartList[i].maKH * count;
            kq += `<tr>
            <td>` + (i+1) + `</td>
            <td>&emsp;` + cartList[i].maKH + `</td>
            <td>` + cartList[i].maSP + `</td>
         
            <td>` + cartList[i].ten + `</td>
          
            <td><img src="` + cartList[i].img + `" style="witdh:100px;height:100px"></td>
           
            <td>` + cartList[i].statusAD + `</td>
            <td>` + cartList[i].sl + `</td>
            <td>` + cartList[i].gia + `</td>
            <td>` + cartList[i].daycr + `</td>


            <td class="sub-menu-parent">
                <input type="button" id="btax" value="Xác nhận" onclick="axceptCart(` + sup + `);">
                <input type="button" id="btxoa" value="Xóa" onclick="deleCart(` + sup + `);">
            </td>
        </tr>`;
        count2++;
        }
        count++;
    }
    if (kq != "") 
    {
        let a = `<center><h2>Tìm thấy: `+ count2+ ` đơn hàng</2></center>`;
        let b =`<tr>
                            <th>STT</th>
                            <th style="width: 140px">&emsp;Người dùng</th>
                            <th>Mã</th>
                         
                            <th style="width: 260px">Tên sản phẩm</th>
                           
                            <th>Hình ảnh</th>
                         
                            <th>Trạng thái</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                             <th></th>
                        </tr>`
        document.querySelector(".nonex").style.visibility = "hidden";
        document.querySelector("#kqs").style.visibility = "visible";
        document.querySelector(".table").style.visibility = "visible";
        document.getElementById("hd").innerHTML = b;
        document.getElementById("kqs").innerHTML = kq;
        document.getElementById("nope").innerHTML = a;
    } else {
        let a = "<center><h2>Không tìm thấy</h2></center>"
        document.getElementById("nope").innerHTML = a;
        document.querySelector("#kqs").style.visibility = "hidden";
        document.querySelector(".table").style.visibility = "hidden";
        document.querySelector(".nonex").style.visibility = "hidden";   
    }
}
function plscomeback()
{
    let a=""
        document.getElementById("hd").innerHTML = a;
        document.getElementById("kqs").innerHTML = a;
        document.getElementById("nope").innerHTML = a;
        document.querySelector(".nonex").style.visibility = "visible";
        listCart();
}

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

function PieChart11(userCart){
    let countI=0;
    let countH=0;
    let countM=0;
    for(let i=0;i<userCart.length;i++){
        if(userCart[i].hang=='Innisfree')
        {
            countI++;
        }
        else if(userCart[i].hang=='HADALABO')
        {
            countH++;
        }
        else{
            countM++;
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Innisfree',      countI],
        ['HADALABO',   countH],
        ['Maybelline',   countM],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart21(userCart){
    let countI=0;
    let countH=0;
    let countM=0;
    let str='';
    for(let i=0;i<userCart.length;i++){
        str = userCart[i].gia;
        str = str.replaceAll('.', '');
        if(userCart[i].hang=='Innisfree')
        {
            countI+=Number(str);
        }
        else if(userCart[i].hang=='HADALABO')
        {
            countH+=Number(str);
        }
        else{
            countM+=Number(str);
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Innisfree',      countI],
        ['HADALABO',   countH],
        ['Maybelline',   countM],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart12(userCart){
    let countI=0;
    for(let i=0;i<userCart.length;i++){
        if(userCart[i].hang=='Innisfree')
        {
            countI++;
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Innisfree',      countI],
        ['Sản phẩm khác',  Number(userCart.length)-countI],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart22(userCart){
    let str='';
    let countI=0;
    let countA=0;
    for(let i=0;i<userCart.length;i++){
        str = userCart[i].gia;
            str = str.replaceAll('.', '');
        if(userCart[i].hang=='Innisfree')
        {
            countI+=Number(str);
        }
        else{   
            countA+=Number(str);
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Innisfree',      countI],
        ['Sản phẩm khác',  countA],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart13(userCart){
    let countH=0;
    for(let i=0;i<userCart.length;i++){
        if(userCart[i].hang=='HADALABO')
        {
            countH++;
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['HADALABO',      countH],
        ['Sản phẩm khác',  Number(userCart.length)-countH],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart23(userCart){
    let str='';
    let countH=0;
    let countA=0;
    for(let i=0;i<userCart.length;i++){
        str = userCart[i].gia;
        str = str.replaceAll('.', '');
        if(userCart[i].hang=='HADALABO')
        {
            countH+=Number(str);
        }
        else{   
            countA+=Number(str);
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['HADALABO',      countH],
        ['Sản phẩm khác',  countA],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart14(userCart){
    let countM=0;
    for(let i=0;i<userCart.length;i++){
        if(userCart[i].hang=='Maybelline')
        {
            countM++;
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Maybelline',      countM],
        ['Sản phẩm khác',  Number(userCart.length)-countM],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function PieChart24(userCart){
    let str='';
    let countM=0;
    let countA=0;
    for(let i=0;i<userCart.length;i++){
        str = userCart[i].gia;
        str = str.replaceAll('.', '');
        if(userCart[i].hang=='Maybelline')
        {
            countM+=Number(str);
        }
        else{   
            countA+=Number(str);
        }
    }
    var pieData = google.visualization.arrayToDataTable([
        ['Hãng', 'Doanh thu'],
        ['Maybelline',      countM],
        ['Sản phẩm khác',  countA],
      ]);
      var pieChart = new google.visualization.PieChart(document.getElementById('pie-chart'));
      pieChart.draw(pieData, pieOptions);
}

function showPIE(){
    const userCart=JSON.parse(localStorage.getItem('userCart'));
    const countType=document.getElementById('countType');
    const brandType=document.getElementById('brandType');
    const monthType=document.getElementById('monthType');
    const Mon=document.getElementById('Mon');
    if(countType.value=='0' || brandType.value=='0' || monthType.value=='0'){
        alert('Vui lòng chọn đủ thông tin');
        return false;
    }
    var tempArr=[];
    var date=new Date();
    userCart.forEach(element =>{
        if(element.year==date.getFullYear() && element.month.toString()==monthType.value && element.statusKH=='1'){
            tempArr.push(element);
        }
    });
    if(tempArr.length==0){
        alert('Tháng này không có dữ liệu !');
        return false;
    }
    Mon.innerHTML=monthType.value;
    const donvi=document.getElementById('donvi');
    if(countType.value=='1'){
        donvi.innerHTML='Đơn vị: sản phẩm'
    }
    else{
        donvi.innerHTML='Đơn vị: VNĐ'
    }
    const mainChart=document.getElementById('mainChart');
    mainChart.style.display='flex';
    if(countType.value=='1' && brandType.value=='1'){
        PieChart11(tempArr);
        return;
    }
    if(countType.value=='1' && brandType.value=='2'){
        PieChart12(tempArr);
        return;
    }
    if(countType.value=='1' && brandType.value=='3'){
        PieChart13(tempArr);
        return;
    }
    if(countType.value=='1' && brandType.value=='4'){
        PieChart14(tempArr);
        return;
    }
    if(countType.value=='2' && brandType.value=='1'){
        PieChart21(tempArr);
        return;
    }
    if(countType.value=='2' && brandType.value=='2'){
        PieChart22(tempArr);
        return;
    }
    if(countType.value=='2' && brandType.value=='3'){
        PieChart23(tempArr);
        return;
    }
    if(countType.value=='2' && brandType.value=='4'){
        PieChart24(tempArr);
        return;
    }
}

window.onload = function()
{
    listPr();
    listUser();
    listCart();
    disPass();
    addImg();
    stats();
}