function Login() {
    var LIP = document.getElementById("LoginSpace");
    LIP.style.display = "block";
}

function Signin() {
    var SIP = document.getElementById("SigninSpace");
    SIP.style.display = "block";
}

function changeLog() {
    const LIP = document.getElementById("LoginSpace");
    const SIP = document.getElementById("SigninSpace");
    LIP.style.display = "none";
    SIP.style.display = "block";
}

function changeSig() {
    const LIP = document.getElementById("LoginSpace");
    const SIP = document.getElementById("SigninSpace");
    SIP.style.display = "none";
    LIP.style.display = "block";
}
window.onclick = function (event) {
    if (event.target == document.getElementById("LoginSpace")) {
        document.getElementById("LoginSpace").style.display = "none";
    }
    if (event.target == document.getElementById("SigninSpace")) {
        document.getElementById("SigninSpace").style.display = "none";
    }
    if (event.target == document.getElementById("noAccount")) {
        document.getElementById("noAccount").style.display = "none";
    }
}

function noAcc() {
    const acc = document.getElementById("noAccount");
    acc.style.display = "block";
}

function closeAcc() {
    const acc = document.getElementById("noAccount");
    acc.style.display = "none";
}

function close_log() {
    var LIP = document.getElementById("LoginSpace");
    LIP.style.display = "none";
}

function close_sig() {
    var SIP = document.getElementById("SigninSpace");
    SIP.style.display = "none";
}

function menu2() {
    var M2 = document.getElementById("top2");
    if (M2.style.display === "none") {
        M2.style.display = 'flex';
    } else {
        M2.style.display = 'none';
    }
}

window.onload = function () {
    checkUserLogin();
    createAdmin();
    createProduct();
    createCart();
    Render_SP();
    Render_Page();
    disPass();
};



function checkUserLogin() {
    const loggedInElement = document.getElementById("Signin_Button");
    const loginButton = document.getElementById("Login_Button");
    const userMenu = document.getElementById("userMenu");
    const menuUsername = document.getElementById("menuUsername");
    const noneCart= document.getElementById("noneCart");
    const userCart=document.getElementById("userCart"); 
    var isLoggedIn = false;
    const loggedIn = localStorage.getItem("logvar");
    const username = localStorage.getItem("username");
    const userId = localStorage.getItem("userId");
    isLoggedIn = loggedIn && username && userId;
    if (!isLoggedIn) {
        return;
    }
    loggedInElement.className = "hidden";
    loginButton.className = "hidden";
    userMenu.className = "top_container_name sub-menu-parent";
    noneCart.className = "hidden";
    userCart.className = "top_container";
    menuUsername.innerHTML = ("&nbsp"+username) || "&nbspUser";
}

function Logout() {
    localStorage.removeItem("logvar");
    localStorage.removeItem("username");
    localStorage.removeItem("userId");
    window.location.reload();
}

function createCart(){
    if(localStorage.getItem('userCart') === null){
        var defaultCart=[{
            "maDon":"",
            "maKH": "",
            "statusKH": "",
            "statusAD":"",
            "statusGH":"",
            "ten":"",
            "img":"",
            "sl": "",
            "maSP": "",
            "gia": "",
            "hang":"",
            "month":"",
            "year":"",
            "daycr": ""
          }];
        localStorage.setItem('userCart',JSON.stringify(defaultCart));
    }
}

function createProduct() {
    if (localStorage.getItem('productList') === null) {
        var productArray = [
            { id: '10001', brand: 'Innisfree', img: 'img/SP/0001.jpg', name: 'Black Tea Youth Enhancing SET', price: '932.993' },
            { id: '10002', brand: 'Innisfree', img: 'img/SP/0002.jpg', name: 'Innisfree Green Tea Super Skincare SET', price: '3.110.000' },
            { id: '10003', brand: 'Innisfree', img: 'img/SP/0003.jpg', name: 'Apple Seed Cleansing Oil & Apple Seed Lip & Eye Makeup Remover', price: '510.000' },
            { id: '10004', brand: 'Innisfree', img: 'img/SP/0004.jpg', name: 'Green Tea Hydrating Amino Acid Cleansing Oil 150mL', price: '500.000' },
            { id: '10005', brand: 'Innisfree', img: 'img/SP/0005.jpg', name: 'Apple Seed Lip & Eye Makeup Remover Tissue 30shts', price: '100.000' },
            { id: '10006', brand: 'Innisfree', img: 'img/SP/0006.jpg', name: 'Green Tea Hydrating Amino Acid Cleansing Foam 150g', price: '260.000' },
            { id: '10007', brand: 'Innisfree', img: 'img/SP/0007.jpg', name: 'Green Tea Foam Cleanser 150mL', price: '260.000' },
            { id: '10008', brand: 'Innisfree', img: 'img/SP/0008.jpg', name: 'Green Tea Balancing Skin EX (Toner)', price: '345.000' },
            { id: '10009', brand: 'Innisfree', img: 'img/SP/0009.jpg', name: 'Green Tea Fresh Skin Innisfree (Toner)', price: '322.000' },
            { id: '10010', brand: 'Innisfree', img: 'img/SP/0010.jpg', name: 'Canola Honey Deep-Moisture', price: '130.000' },
            { id: '10011', brand: 'Innisfree', img: 'img/SP/0011.jpg', name: 'Green Tea Lip', price: '140.000' },
            { id: '10012', brand: 'Innisfree', img: 'img/SP/0012.jpg', name: 'Real Peppermint Mask (Mặt nạ Bạc hà Innisfree)', price: '240.000' },
            { id: '10013', brand: 'Innisfree', img: 'img/SP/0013.jpg', name: 'Real Rose Mask (Mặt nạ chiếc xuất Hoa hồng Innisfree)', price: '240.000' },
            { id: '10014', brand: 'Innisfree', img: 'img/SP/0014.jpg', name: 'Tone Up No Sebum Sunscreen EX SPF 50+ PA++++ 50mL', price: '330.000' },
            { id: '10015', brand: 'Innisfree', img: 'img/SP/0015.jpg', name: 'Intensive Triple-shield Sunscreen SPF50+ PA++++ 50mL', price: '360.000' },
            { id: '10016', brand: 'Innisfree', img: 'img/SP/0016.jpg', name: 'Son Kem Lì Innisfree Real Fit Matte Liquid', price: '190.000' },
            { id: '10017', brand: 'Innisfree', img: 'img/SP/0017.jpg', name: 'Son Lì Innisfree Real Fit Matte Lipstick 3.6gr', price: '230.000' },
            { id: '10018', brand: 'HADALABO', img: 'img/SP/0018.jpg', name: 'Hộp mặt nạ tinh chất dưỡng ẩm cao cấp (5 miếng)', price: '195.000' },
            { id: '10019', brand: 'HADALABO', img: 'img/SP/0019.jpg', name: 'Sữa rửa mặt dưỡng ẩm cao cấp', price: '125.000' },
            { id: '10020', brand: 'HADALABO', img: 'img/SP/0020.jpg', name: 'Dung dịch dưỡng ẩm (Da dầu)', price: '190.000' },
            { id: '10021', brand: 'HADALABO', img: 'img/SP/0021.jpg', name: 'Kem dưỡng ẩm', price: '200.000' },
            { id: '10022', brand: 'HADALABO', img: 'img/SP/0022.jpg', name: 'Dung dịch dưỡng ẩm (Da thường, Da khô)', price: '190.000' },
            { id: '10023', brand: 'HADALABO', img: 'img/SP/0023.jpg', name: 'Sữa dưỡng trắng', price: '200.000' },
            { id: '10024', brand: 'HADALABO', img: 'img/SP/0024.jpg', name: 'GEL chống nắng, dưỡng ẩm', price: '280.000' },
            { id: '10025', brand: 'HADALABO', img: 'img/SP/0025.jpg', name: 'Nước tẩy trang sạch sâu, dưỡng trắng', price: '280.000' },
            { id: '10026', brand: 'Maybelline', img: 'img/SP/0026.jpg', name: 'Fit Me Foundation', price: '450.000' },
            { id: '10027', brand: 'Maybelline', img: 'img/SP/0027.jpg', name: 'Super Stay Full Coverage Foudation', price: '273.000' },
            { id: '10028', brand: 'Maybelline', img: 'img/SP/0028.jpg', name: 'Phấn Phủ Nén Maybelline FIT ME Matte Poreless', price: '220.000' },
            { id: '10029', brand: 'Maybelline', img: 'img/SP/0029.jpg', name: 'Phấn Phủ Kiềm Dầu Maybelline Fit Me Loose', price: '200.000' },
            { id: '10030', brand: 'Maybelline', img: 'img/SP/0030.jpg', name: 'Phấn Nước Dream Fresh Face Liquid Foundation', price: '160.000' },
            { id: '10031', brand: 'Maybelline', img: 'img/SP/0031.jpg', name: 'Maybelline Super BB Cushion Fresh Matte', price: '300.000' },
            { id: '10032', brand: 'Maybelline', img: 'img/SP/0032.jpg', name: 'Phấn Má Hồng Maybelline Fit Me Blush 4.5gr', price: '150.000' },
            { id: '10033', brand: 'Maybelline', img: 'img/SP/0033.jpg', name: 'Che Khuyết Điểm Maybelline Face Studio Master', price: '150.000' },
            { id: '10034', brand: 'Maybelline', img: 'img/SP/0034.jpg', name: 'Bút Che Khuyết Điểm Maybelline Instant Age', price: '230.000' },
            { id: '10035', brand: 'Maybelline', img: 'img/SP/0035.jpg', name: 'Phấn Mắt Maybelline The Blushed Nudes Palette', price: '314.000' },
            { id: '10036', brand: 'Maybelline', img: 'img/SP/0036.jpg', name: 'Phấn Mắt The 24K Nude Eyeshadow Palette', price: '250.000' },
            { id: '10037', brand: 'Maybelline', img: 'img/SP/0037.jpg', name: 'Bút Kẻ Mắt Nước Maybelline Hyper Ink 1.5g', price: '170.000' },
            { id: '10038', brand: 'Maybelline', img: 'img/SP/0038.jpg', name: 'Mascara Maybelline Lash Sensational', price: '180.000' },
            { id: '10039', brand: 'Maybelline', img: 'img/SP/0039.jpg', name: 'Bảng Màu Kẻ Mày Và Tạo Sống Mũi Fashion Brow', price: '230.000' },
            { id: '10040', brand: 'Maybelline', img: 'img/SP/0040.jpg', name: 'Chì Kẻ Chân Mày 2 Đầu Maybelline Màu Xám 0.5g', price: '180.000' },
            { id: '10041', brand: 'Maybelline', img: 'img/SP/0041.jpg', name: 'Son Kem Lì Maybelline Super Stay Matte Ink', price: '210.000' },
            { id: '10042', brand: 'Maybelline', img: 'img/SP/0042.jpg', name: 'Son Tint Maybelline Color Sensational Lip Tint', price: '170.000' },
            { id: '10043', brand: 'Maybelline', img: 'img/SP/0043.jpg', name: 'Son Lì Maybelline Lips Vivid Matte 3.9gr', price: '190.000' },
            { id: '10044', brand: 'Maybelline', img: 'img/SP/0044.jpg', name: 'Son Lì Maybelline The Loaded Bolds Matte Lips', price: '190.000' },
            { id: '10045', brand: 'Maybelline', img: 'img/SP/0045.jpg', name: 'Nước Tẩy Trang Maybelline Micellar Water 400ml', price: '190.000' },
        ];
        localStorage.setItem('productList', JSON.stringify(productArray));
    }
}

function addCart(id){
    var userCart=JSON.parse(localStorage.getItem('userCart'));
    const userID=localStorage.getItem('userId');
    const sl=document.getElementById(id).value;
    const productList = JSON.parse(localStorage.getItem("productList"));
    let ten;
    let gia;
    let img;
    let hang;
    for (let i=0;i<userCart.length;i++)
    {
        if(userCart[i].maSP===id.toString() && userCart[i].statusKH=='0')
        {
            alert("Sản phẩm đã có trong giỏ !");
            return;
        }
    }
    for(const element of productList){
        if(element.id==id)
        {
            ten=element.name;
            gia=element.price;
            img=element.img;
            hang=element.brand;
            break;
        }
    };
    let temp={maSP:id.toString(),maKH:userID,statusAD:"0",statusKH:"0",statusGH:"0",hang:hang,sl:sl,gia:gia,ten:ten,img:img};
    userCart.push(temp);
    localStorage.setItem('userCart',JSON.stringify(userCart));
    alert('Thêm vào giỏ hàng thành công !')
}

function Render_SP() {
    const productWraper = document.getElementById("productWraper");
    const productList = JSON.parse(localStorage.getItem("productList"));
    const loggedIn = localStorage.getItem("logvar");
    const username = localStorage.getItem("username");
    const userId = localStorage.getItem("userId");
    isLoggedIn = loggedIn && username && userId;
    let contentString = '';
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let currentPage = urlParams.get('page');
    let brandPage = urlParams.get('brand');
    if (currentPage == undefined) {
        currentPage = 1;
    }
    if (brandPage === "innis") {
        var innisArr = [{ id: '0000', brand: '', img: '', name: '' }];
        productList.forEach(element => {
            if (element.brand.trim() === 'Innisfree') {
                innisArr.push(element);
            }
        });
        innisArr.shift();
        innisArr.slice((currentPage - 1) * 9, (currentPage - 1) * 9 + 9).forEach(element => {
            contentString += `<div class="SP_CON shadow">
            <div class="SP_CON1">
                <img src="${element.img}">
            </div>
            <div class="SP_CON2">
                <div>
                    <h3>${element.name}</h3><br>
                    <a class="price">${element.price} VNĐ</a><br>
                    <a class="price">Số lượng: <a><input type="number" id="${element.id}" name="quantity" min="1"  required value="1">
                </div>
                <div style="padding-top: 20px;">
                    <a onclick="${ isLoggedIn ? 'addCart('+element.id+')':'noAcc()'}" class="btn">Thêm vào giỏ</a>
                </div>
            </div>
        </div>`;
        });
        productWraper.innerHTML = contentString;
        return;
    }
    if (brandPage === "hada") {
        var hadaArr = [{ id: '0000', brand: '', img: '', name: '' }];
        productList.forEach(element => {
            if (element.brand.trim() === 'HADALABO') {
                hadaArr.push(element);
            }
        });
        hadaArr.shift();
        hadaArr.slice((currentPage - 1) * 9, (currentPage - 1) * 9 + 9).forEach(element => {
            contentString += `<div class="SP_CON shadow">
            <div class="SP_CON1">
                <img src="${element.img}">
            </div>
            <div class="SP_CON2">
                <div>
                    <h3>${element.name}</h3><br>
                    <a class="price">${element.price} VNĐ</a>
                    <a class="price">Số lượng: <a><input type="number" id="${element.id}" name="quantity" min="1"  required value="1">
                </div>
                <div style="padding-top: 20px;">
                    <a onclick="${ isLoggedIn ? 'addCart('+element.id+')':'noAcc()'}" class="btn">Thêm vào giỏ</a>
                </div>
            </div>
        </div>`;
        });
        productWraper.innerHTML = contentString;
        return;
    }
    if (brandPage === "maybe") {
        var maybeArr = [{ id: '0000', brand: '', img: '', name: '' }];
        productList.forEach(element => {
            if (element.brand.trim() === 'Maybelline') {
                maybeArr.push(element);
            }
        });
        maybeArr.shift();
        maybeArr.slice((currentPage - 1) * 9, (currentPage - 1) * 9 + 9).forEach(element => {
            contentString += `<div class="SP_CON shadow">
            <div class="SP_CON1">
                <img src="${element.img}">
            </div>
            <div class="SP_CON2">
                <div>
                    <h3>${element.name}</h3><br>
                    <a class="price">${element.price} VNĐ</a>
                    <a class="price">Số lượng: <a><input type="number" id="${element.id}" name="quantity" min="1"  required value="1">
                </div>
                <div style="padding-top: 20px;">
                    <a onclick="${ isLoggedIn ? 'addCart('+element.id+')':'noAcc()'}" class="btn">Thêm vào giỏ</a>
                </div>
            </div>
        </div>`;
        console.log('quantity'+`${element.id}`);
        });
        productWraper.innerHTML = contentString;
        return;
    }
    productList.slice((currentPage - 1) * 9, (currentPage - 1) * 9 + 9).forEach(element => {
        contentString += `<div class="SP_CON shadow">
        <div class="SP_CON1">
            <img src="${element.img}">
        </div>
        <div class="SP_CON2">
            <div>
                <h3>${element.name}</h3><br>
                <a class="price">${element.price} VNĐ</a><br>
                <a class="price">Số lượng: <a><input type="number" id="${element.id}" name="quantity" min="1"  required value="1">
            </div>
            <div style="padding-top: 20px;">
                <a onclick="${ isLoggedIn ? 'addCart('+element.id+')':'noAcc()'}" class="btn">Thêm vào giỏ</a>
            </div>
        </div>
    </div>`;
    });
    productWraper.innerHTML = contentString;
}

function Render_Page() {
    const pageWraper = document.getElementById("pageWraper");
    const productList = JSON.parse(localStorage.getItem("productList"));
    let contentString = '';
    let count = 0;
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let currentPage = urlParams.get('page');
    let brandPage = urlParams.get('brand')
    if (currentPage == undefined) {
        currentPage = 1;
    }
    if (brandPage === "innis") {
        productList.forEach(element => {
            if (element.brand.trim() === 'Innisfree') {
                count++;
            }
        })
    }
    if (brandPage === "maybe") {
        productList.forEach(element => {
            if (element.brand.trim() === 'Maybelline') {
                count++;
            }
        })
    }
    if (brandPage === "hada") {
        productList.forEach(element => {
            if (element.brand.trim() === 'HADALABO') {
                count++;
            }
        })
    }
    const pageCountSP = Math.ceil(count / 9);
    if (brandPage === "innis" || brandPage === "hada" || brandPage === "maybe") {
        for (let i = 0; i < pageCountSP; i++) {
            contentString += `<a href="root.html?brand=${brandPage}&page=${i + 1}"><div class="page_num ${(i + 1) == currentPage ? 'active' : ''}">${i + 1}</div></a>`
        }
        pageWraper.innerHTML = contentString;
        return;
    }
    const pageCount = Math.ceil(productList.length / 9);
    for (let i = 0; i < pageCount; i++) {
        contentString += `<a href="root.html?page=${i + 1}"><div class="page_num ${(i + 1) == currentPage ? 'active' : ''}">${i + 1}</div></a>`
    }
    pageWraper.innerHTML = contentString;
}

function noneProduct() {
    const pageWraper = document.getElementById("pageWraper");
    const productWraper = document.getElementById("productWraper");
    const contentString = `<h3 style="padding-top:100px;padding-bottom:100px;">Không tìm thấy sản phẩm<\h3>`;
    productWraper.innerHTML = contentString;
    pageWraper.innerHTML = "";
}

function renderNBP(currentPage){
    const productWraper = document.getElementById("productWraper");
    const pageWraper = document.getElementById("pageWraper");
    const txtInput = document.getElementById('txtInput');
    const brandInput = document.getElementById('brandInput');
    const priceInput = document.getElementById('priceInput');
    let brandName;
    let pricePro;
    let check;
    switch (brandInput.value) {
        case '0':
            brandName = '';
            break;
        case '1':
            brandName = 'Innisfree';
            break;
        case '2':
            brandName = 'Maybelline';
            break;
        case '3':
            brandName = 'HADALABO';
            break;
    }
    switch (priceInput.value) {
        case '0':
            pricePro = Number('0');
            check = 1;
            break;
        case '1':
            pricePro = Number('100000');
            check = 0;
            break;
        case '2':
            pricePro = Number('500000');
            check = 0;
            break;
        case '3':
            pricePro = Number('1000000');
            check = 0;
            break;
        case '4':
            pricePro = Number('1000000');
            check = 1;
            break;
    }
    const productList = JSON.parse(localStorage.getItem("productList"));
    let count = 0;
    let proPrice;
    let str;
    var Arr = [{ id: '0000', brand: '', img: '', name: '' }];
    productList.forEach(element => {
        str = element.price;
        str = str.replaceAll('.', '');
        proPrice = Number(str);
        if ((element.name.toUpperCase().indexOf(txtInput.value.toUpperCase()) > -1) && (element.brand.toUpperCase().indexOf(brandName.toUpperCase()) > -1) && ((check == 0 && proPrice <= pricePro) || (check == 1 && proPrice >= pricePro))) {
            Arr.push(element);
            count++;
        }
    }
    );
    Arr.shift();
    if (count == 0) {
        noneProduct();
        return;
    }
    let contentString1 = '';
    let contentString2 = '';
    Arr.slice((currentPage - 1) * 9, (currentPage - 1) * 9 + 9).forEach(element => {
        contentString1 += `<div class="SP_CON shadow">
        <div class="SP_CON1">
            <img src="${element.img}">
        </div>
        <div class="SP_CON2">
            <div>
                <h3>${element.name}</h3><br>
                <a class="price">${element.price} VNĐ</a><br>
                <a class="price">Số lượng: <a><input type="number" id="${element.id}" name="quantity" min="1"  required value="1">
            </div>
            <div style="padding-top: 20px;">
                <a onclick="${ isLoggedIn ? 'addCart('+element.id+')':'noAcc()'}" class="btn">Thêm vào giỏ</a>
            </div>
        </div>
    </div>`;
    });
    productWraper.innerHTML = contentString1;
    const pageCountSP = Math.ceil(count / 9);
    for (let i = 0; i < pageCountSP; i++) {
        contentString2 += `<a onclick="renderNBP(${i + 1});"><div class="page_num ${(i + 1) == currentPage ? 'active' : ''}">${i + 1}</div></a>`
    }
    pageWraper.innerHTML = contentString2;
}

function makeFocus() {
    document.getElementById("txtInput").focus();
}

function findRE(){
    const FP = document.getElementById("Find_Space");
    FP.innerHTML = '<input id="txtInput" type="text" style="width:40%" placeholder="Nhập sản phẩm muốn tìm" onload="makeFocus();">' +
        '<select id="brandInput" style="width:20%; height:35px; margin-left:5px"><option value=0>--Hãng--</option><option value=1>Innisfree</option><option value=2>Maybelline</option><option value=3>Hadalabo</option></select>' +
        '<select id="priceInput" style="width:30%; height:35px; margin-left:5px"><option value=0>--Giá tiền--</option><option value=1>Dưới 100.000 VNĐ</option><option value=2>Dưới 500.000 VNĐ</option><option value=3>Dưới 1.000.000 VNĐ</option><option value=4>Trên 1.000.000 VNĐ</option></select>' +
        '<a class="findBtn" onclick="renderNBP(1);" ><i class="fa-solid fa-magnifying-glass"></i></a>';
}
//Accounts
function createAdmin() {
    var userArray = [
        {
            "fullname": "Turmeric",
            "loginname": "Turmer",
            "password": "FullOfTurmeric",
            "phone": "0336514655",
            "mail": "sakai.yoshi84@gmail.com",
            "maTK": "1000",
            "dayS": "05",
            "monthS": "11",
            "yearS": "2022",
            "status": "0",
            "accountType": "ad"
        },
        {
            "fullname": "User0",
            "loginname": "user0",
            "password": "1111",
            "phone": "0336514655",
            "mail": "sakai.yoshi84@gmail.com",
            "maTK": "1001",
            "dayS": "05",
            "monthS": "11",
            "yearS": "2022",
            "status": "0",
            "accountType": "kh"
        },
    ];
    if (localStorage.getItem('guest') === null) {
        localStorage.setItem('guest', JSON.stringify(userArray));
    }
    if (localStorage.getItem('logvar') === null) {
        var logv = 'false';
        console.log(logv);
        localStorage.setItem('logvar', JSON.stringify(logv));
    }
}
var user;
function newUser() {
    userArray = JSON.parse(localStorage.getItem('guest'));
    var ma = "1" + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9) + 1);
    for (var i = 0; i < userArray.length; i++) {
        while (userArray[i].maTK == ma)
            ma = "1" + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9)) + String(Math.floor(Math.random() * 9) + 1);
    }
    var d = new Date();
    var day = d.getDate();
    var month = d.getMonth();
    var year = d.getFullYear();
    var pass = document.getElementById("pass").value;
    var passa = document.getElementById("passag").value;
    user = { fullname: document.getElementById("fulln").value, loginname: document.getElementById("logn").value, password: pass, phone: document.getElementById("phone").value, mail: document.getElementById("mail").value, maTK: ma, dateS: day, monthS: month, yearS: year, status: '0', accountType: 'kh' };
    if (pass != passa)
    {
        alert("Mật khẩu không chính xác!");
        return;
    }
    KTlogn();
}
function KTlogn() {
    userArray = JSON.parse(localStorage.getItem('guest'));
    if (user.fullname === "") {
        alert("Moi nhap ho ten!");
        //location.reload();
        return;
    }
    if (user.loginname === "") {
        alert("Moi nhap ten dang ki!");
        //location.reload();
        return;
    }
    if (user.password === "") {
        alert("Nhap mat khau!");
        //location.reload();
        return;
    }
    if (user.phone === "") {
        alert("Nhap so dien thoai!");
        //location.reload();
        return;
    }
    for (var i = 0; i < userArray.length; i++) {
        if (user.loginname === userArray[i].loginname) {
            alert("Ten dang nhap da co nguoi su dung!");
            //location.reload();
            return;
        }
    }
    console.log(user.loginname);
    console.log("User Type: ");
    console.log(typeof (user));
    userArray.push(user);
    localStorage.setItem('guest', JSON.stringify(userArray));
    location.reload();
}
var userLog;
function login() {
    var d = new Date();
	var day = d.getDate();
	var month = d.getMonth();
	var year = d.getFullYear();
    var logname = document.getElementById("logna").value;
    var password = document.getElementById("passw").value;
    var userArray = JSON.parse(localStorage.getItem('guest'));
    var log = JSON.parse(localStorage.getItem('logvar'));
    for (var i = 0; i < userArray.length; i++) {
        if (userArray[i].loginname === logname && userArray[i].password === password && userArray[i].accountType === "ad") {
            //alert("LOGIN SUCCESSFULL, YOU'RE ADMIN");
            userArray[i].dateS = day;
            userArray[i].monthS = month;
            userArray[i].yearS = year;
            //userlog = userArray[i];
            window.location = "ADMIN.html";
            return;
        }
        else if (userArray[i].loginname === logname && userArray[i].password === password && userArray[i].accountType === "kh" && userArray[i].status === "0") {
            //alert("LOGIN SUCCESSFULL, YOU'RE GUEST");
            log = 'true';
            localStorage.setItem('logvar', JSON.stringify(log));
            userArray[i].dateS = day;
            userArray[i].monthS = month;
            userArray[i].yearS = year;
            localStorage.setItem("username", userArray[i].fullname);
            localStorage.setItem("userId", userArray[i].maTK);
            window.location.reload();
            return;
            //window.location = "ADMIN.html";
        }
        else if (userArray[i].loginname === logname && userArray[i].password === password && userArray[i].accountType === "kh" && userArray[i].status === "1"){
            alert("Tài khoản của bạn hiện đang bị khóa!");
            location.reload();
            return;
        }
        //alert("Sai thong tin dang nhap!");	
    }
    alert("Sai thong tin dang nhap!");
    //location.reload();
}
function logout() {
    var logvar = JSON.parse(localStorage.getItem('logvar'));
    logvar = 'false';
    localStorage.setItem('logvar', JSON.stringify(logvar));
    window.location = "root.html";
}
function disPass(){
    const pass = document.querySelector('#passw');
    const dis = document.querySelector('#cmm');
    dis.addEventListener('click', function() {
        const currentType = pass.getAttribute('type');
        pass.setAttribute('type', currentType === 'password' ? 'text' : 'password');
        //alert("FAK U");
    })
    const passw = document.querySelector('#pass');
    const disp = document.querySelector('#cmml');
    disp.addEventListener('click', function() {
        const currentType = passw.getAttribute('type');
        passw.setAttribute('type', currentType === 'password' ? 'text' : 'password');
        //alert("FAK U");
    })
    const passa = document.querySelector('#passag');
    const dispa = document.querySelector('#cmmn');
    dispa.addEventListener('click', function() {
        const currentType = passa.getAttribute('type');
        passa.setAttribute('type', currentType === 'password' ? 'text' : 'password');
        //alert("FAK U");
    })     
}
function goCart(){
    window.location="cart.html";
}
function beBack(){
    window.location="root.html";
}

