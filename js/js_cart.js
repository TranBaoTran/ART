function logCart(){
    const userID = localStorage.getItem("userId");
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    let index=0;
    userCart.forEach(element =>{
        if(element.maKH==userID && element.statusKH=='0')
        {
            eraseNormal(index);
        }
        index++;
    });
    localStorage.removeItem("logvar");
    localStorage.removeItem("username");
    localStorage.removeItem("userId");
    window.location= "root.html";
}

window.onload=function(){
    render_Cart();
    rewriteUserLogin();
}

function convertMoney(num){
    return num.toLocaleString('it-IT',{style: 'currency',currency: 'VND'})
}

function render_Cart(){
    const keyCart=document.getElementById("keyCart");
    let contentString='';
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    let count=1;
    let str;
    let proPrice;
    let proSl;
    let quaID=100;
    let index=0;
    userCart.forEach(element => {
        if(element.maKH === userID && element.statusGH != "1"){
            str = element.gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(element.sl);
            contentString+=`<tr> 
            <td>${count}</td>
            <td><img src="${element.img}"style="witdh:100px;height:100px"></td>
            <td>${element.ten}</td>
            <td></td>
            <td>${element.gia} VND</td>
            <td><input type="number" id="${quaID.toString()}" name="quantity" min="1"  required value="${proSl}"></td>
            <td class="${element.statusKH=='0'? 'notCash':'Cash'}">${element.statusKH=='0'? 'Chưa thanh toán':(element.statusAD=='0'?'Chờ xác nhận':(element.statusGH==0 ?'Đang giao hàng':'Đã nhận hàng'))}</td>
            <td id="eraBut"> 
                 <input type="button" id="btxoa" value="Xóa" onclick="eraseUserCart(${index})">
            </td>
            <td id="comBut"> 
                 <input type="button" id="btxoa" style="width:100px" value="Xác nhận" onclick="comPro(${index})">
            </td>
            <td></td>
            </tr>`
            console.log(quaID.toString());
            count++;
            quaID++;
        }
        index++;
    });
    keyCart.innerHTML=contentString;
}

function goCash(){
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    let count=0;
    let num;
    let str;
    let proPrice;
    let proSl;
    let Total;
    let prTot=0;
    let quaID=100;
    userCart.forEach(element => {
        if(element.maKH===userID && element.statusGH=='0')
        {
            if(element.statusKH=='0'){
            str = element.gia;
            str = str.replaceAll('.', '');
            num=document.getElementById(quaID.toString()).value;
            element.sl=num;
            proPrice = Number(str);
            proSl = Number(element.sl);
            Total=proPrice*proSl;
            prTot=prTot+Total;
            count++;
            }
            quaID++;
        }
    });
    localStorage.setItem('userCart',JSON.stringify(userCart));
    printBillPlace();
    prTotal=document.getElementById("prTotal");
    prTotal.innerHTML=convertMoney(prTot);
    printBill();
}

function printBill(){
    const billCon=document.getElementById("billCon");
    let contentString='';
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    let str;
    let proPrice;
    let proSl;
    userCart.forEach(element => {
        if(element.maKH === userID && element.statusKH=='0'){
            str = element.gia;
            str = str.replaceAll('.', '');
            proPrice = Number(str);
            proSl = Number(element.sl);
            const Total=convertMoney(proPrice*proSl);
            contentString+=`<div class="prCart shadow">
            <div class="prCart_it1"><img src="${element.img}"></div>
            <div class="prCart_it2">
            <p>${element.ten}</p>
            <p>x${element.sl}</p>
            <p>${Total}</p>
            </div>
            </div>`
        }});
    billCon.innerHTML=contentString;    
}
//here i gonna make a change
function printEachBill(){
    const billCon=document.getElementById("billCon");
    let contentString='';
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
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

function printBillList(){
    printOldBillPlace();
    printEachBill();
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
    <div class="prCart_it2"  style='width:45%'>
    <p>Mã đơn hàng: ${ma}</p>
    <p>${tot}</p>
    <p id='statusDH' class='notCash'>Chưa xác nhận</p>
    </div>
    <div class="prCart_it3">
    <input type="button" id="btxoa" style="width:80px" value="Xác nhận" onclick="comPro(${ma})">
    </div>
    </div>`
    return contentString;
}

function comPro(maDon){
    var userCart=JSON.parse(localStorage.getItem("userCart"));
    for (var i =0; i< userCart.length; i++) {
        if (element[i].maDon==maDon){
            if(element[i].statusGH=='0'){
                element[i].statusGH=='1';                
            }
            else{
                alert('Đã xác nhận lấy được hàng !');
                return false;
            }
        }
    }
    userCart = JSON.stringify(userCart);
    localStorage.setItem("userCart", userCart);
    const statusDH=document.getElementById('statusDH');
    window.location.reload();   
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
            if(element.maDon==ma && element.statusGH=='0'){
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

function printOldBillPlace(){
    const billPlace=document.getElementById("billPlace");
    const contentString=`<div class="form_background" id="LoginSpace" style="display: block;">
    <div class="Login_Space" style="top:60px;">
        <div class="title" style="font-size:20px ;"><b>HOÁ ĐƠN</b><div id="close" onclick="close_log()">X</div></div>
        <div class="billContainer" id="billCon">
            </div>
        <div class="title" style="height:50px">
        <p>Tổng : <span id="prTotal"></span></p>
        </div>
    </div>`;
    billPlace.innerHTML=contentString;
}

function printBillPlace(){
    const billPlace=document.getElementById("billPlace");
    const contentString=`<div class="form_background" id="LoginSpace" style="display: block;">
    <div class="Login_Space" style="top:60px;">
        <div class="title" style="font-size:20px ;"><b>HOÁ ĐƠN</b><div id="close" onclick="close_log()">X</div></div>
        <div class="billContainer" id="billCon">
            </div>
        <div class="title" style="height:100px">
        <p>Tổng : <span id="prTotal"></span></p>
        <button type="button" class="btn btn-success" style="cursor:pointer;" onclick="cashCart()">Thanh toán</button></div>
        </div>
    </div>`;
    billPlace.innerHTML=contentString;
}

function cashCart(){
    const userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    var tod=new Date();
    const day=tod.getDate();
    const month=tod.getMonth();
    const year=tod.getFullYear();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
    var ma = "1" + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9) + 1);
    for (var i = 0; i < userCart.length; i++) {
        while (userCart[i].maDon == ma)
            ma = "1" + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9) + 1);
    }
    userCart.forEach(element =>{
        if(element.maKH==userID && element.maDon==undefined){
            element.statusKH='1';
            element.day=day;
            element.month=month+1;
            element.year=year;
            element.maDon=ma;
            element.daycr=today;
        }
    });
    localStorage.setItem('userCart',JSON.stringify(userCart));
    alert("Trả tiền thành công vui lòng chờ xác nhận !");
    window.location.reload();
}

function rewriteUserLogin() {
    const menuUsername = document.getElementById("menuUsername");
    const username = localStorage.getItem("username");
    menuUsername.innerHTML = ("&nbsp"+username) || "&nbspUser";
}

function eraseUserCart(index){
    var userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    for (var i =0; i< userCart.length; i++) {
        if (i==index && userCart[i].statusKH!='0')
        {
            alert("Tiền đã trả không lấy lại được đâu :[ ");
            return;
        }
        if (i==index) {
            console.log(userCart[i].maSP)
            userCart.splice(i, 1);
        }
    }
    userCart = JSON.stringify(userCart);
    localStorage.setItem("userCart", userCart);
    window.location.reload();
}

function eraseNormal(index){
    var userCart=JSON.parse(localStorage.getItem("userCart"));
    const userID = localStorage.getItem("userId");
    for (var i =0; i< userCart.length+1; i++) {
        if (i==index && userCart[i].statusKH=='0') {
            console.log(userCart[i].maSP)
            userCart.splice(i, 1);
        }
    }
    userCart = JSON.stringify(userCart);
    localStorage.setItem("userCart", userCart);
}