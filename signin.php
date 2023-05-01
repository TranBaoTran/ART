<link rel="stylesheet" href="css/cs_root.css">

<?php 
    $displayForm=TRUE;
    if(isset($_POST['submit'])){
        $displayForm=FALSE;
    }
    if($displayForm){
?>
<div class="form_background" style="padding-top: 130px;" id="SigninSpace">
            <div class="Login_Space" style="top:60px">
                <div class="title">ĐĂNG KÝ<div id="close" onclick="close_log()">X</div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Họ và tên</div>
                    <div class="Log_Space2" style="padding-right:12px"><input type="text" placeholder="Nhập họ và tên" id="fulln" name="fulln"></div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Số điện thoại</div>
                    <div class="Log_Space2" style="padding-right:12px"><input type="text" placeholder="Nhập số điện thoại" id="phone" name="phone"></div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Email</div>
                    <div class="Log_Space2" style="padding-right:12px"><input type="text" placeholder="Nhập địa chỉ email" id="mail" name="mail"></div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Tên tài khoản</div>
                    <div class="Log_Space2" style="padding-right:12px"><input type="text" placeholder="Nhập tên tài khoản" id="logn" name="logn"></div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Mật khẩu</div>
                    <div class="Log_Space2" style="padding-left:4px"><input type="password" placeholder="Nhập mật khẩu" id="pass" name="pass">
                        <div style="float:right; padding-top: 7px"><button class="" type="button" id="cmml">
                            <span class="fas fa-eye-slash"></span></button></div>
                    </div>
                </div>
                <div class="Login_Block" style="font-size:10px;color:red">
                   <p style="margin-left:90px">* Mật khẩu có ít nhất 8 kí tự, có chữ thường, chữ viết hoa và số</p>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1"></div>
                    <div class="Log_Space2" style="padding-left:4px"><input type="password" placeholder="Nhập lại mật khẩu" id="passag" name="passag">
                        <div style="float:right; padding-top: 7px"><button class="" type="button" id="cmmn">
                            <span class="fas fa-eye-slash"></span></button></div>
                    </div>
                </div>
                <div class="Login_Block" style="padding-left: 30px; margin: 10px; color: #72828e;">Đã có tài khoản, chọn&nbsp<a style="color:#c94f7c;cursor: pointer;" href="index.php?form=log"> ĐĂNG NHẬP</a></div>
                <div class="summit_space">
                    <input type="submit" class="summit_button" name="submit" value="ĐĂNG KÝ">
                </div>
            </div>
        </div>
    </div>
<?php }?>
<script>
    function close_log() {
        window.location.href="index.php";
    }

    function seePass(inpbox,but){
        var see=document.getElementById(but);
        var pass=document.getElementById(inpbox);
        see.addEventListener('click',function(){
            let current=pass.getAttribute('type');
            pass.setAttribute('type', current=== 'password' ? 'text' : 'password');
            if(current=='password'){
                see.innerHTML='<i class="fa-solid fa-eye">';
            }
            else{
                see.innerHTML='<i class="fa-solid fa-eye-slash">';
            }
        })
    }

    function check(){
        const fulln=document.getElementById('fulln');
        const phone=document.getElementById('phone');
        const mail=document.getElementById('mail');
        const logn=document.getElementById('logn');
        const pass=document.getElementById('pass');
        const passag=document.getElementById('passag');

        var regTel=new RegExp(/^[0-9\-\+]{9,15}$/,"ig");
        var regMail=new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/,"ig");
        var regUName= new RegExp(/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/,"gm");
        var regPass=new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/,"gm");
        var regName=new RegExp(/^[\w'\-,.][^0-9_!¡?÷?¿\\+=@#$%ˆ&*(){}|~<>;."^',`:[\]]{1,}$/,"gm");

        if(fulln.value==''){
            alert('Họ và tên không được trống');
            fulln.focus();
            return false;
        }
        if(phone.value==''){
            alert('Số điện thoại không được trống');
            phone.focus();
            return false;
        }
        if(logn.value==''){
            alert('Tên đăng nhập không được trống');
            fulln.focus();
            return false;
        }
        if(pass.value==''){
            alert('Mật khẩu không được trống');
            pass.focus();
            return false;
        }
        if(passag.value==''){
            alert('Vui lòng nhập lại mật khấu');
            passag.focus();
            return false;
        }
        if(!phone.value.trim().match(regTel)){
            alert("Nhập sai số điện thoại");
            phone.focus();
            return false;
        }
        if(!mail.value.trim().match(regMail)){
            alert("Nhập sai email");
            mail.focus();
            return false;
        }
        if(!logn.value.trim().match(regUName)){
            alert("Nhập sai tên tài khoản");
            logn.focus();
            return false;
        }
        if(!pass.value.trim().match(regPass)){
            alert("Nhập sai mật khẩu");
            pass.focus();
            return false;
        }
        if(pass.value.trim()!=passag.value.trim()){
            alert("Mật khẩu nhập lại không giống");
            passag.focus();
            return false;
        }
    }

    seePass("pass","cmml");
    seePass("passag","cmmn");
    $('.Login_Space').children().unwrap().wrapAll("<form name='input' class='Login_Space' style='top:60px' id='' action='checksig.php' method='post' onsubmit='return check()'></form>");
</script>