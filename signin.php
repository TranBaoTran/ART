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
                    <div class="Log_Space2" style="padding-left:4px"><input type="password" placeholder="Nhập mật khẩu" id="pass">
                        <div style="float:right; padding-top: 7px"><button class="" type="button" id="cmml">
                            <span class="fas fa-eye-slash"></span></button></div>
                    </div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1"></div>
                    <div class="Log_Space2" style="padding-left:4px"><input type="password" placeholder="Nhập lại mật khẩu" id="passag">
                        <div style="float:right; padding-top: 7px"><button class="" type="button" id="cmmn">
                            <span class="fas fa-eye-slash"></span></button></div>
                    </div>
                </div>
                <div class="Login_Block" style="padding-left: 30px; margin: 10px; color: #72828e;">Đã có tài khoản, chọn&nbsp<a style="color:#c94f7c;cursor: pointer;" href="index.php?form=log"> ĐĂNG NHẬP</a></div>
                <div class="summit_space">
                    <input type="submit" class="summit_button" value="ĐĂNG KÝ">
                </div>
            </div>
        </div>
    </div>

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

    seePass("pass","cmml");
    seePass("passag","cmmn");
    $('.Login_Space').children().unwrap().wrapAll("<form name='input' class='Login_Space' style='top:60px' id='' action='' method='post'></form>");
</script>