<div class="form_background" id="LoginSpace">
            <div class="Login_Space">
                <div class="title">ĐĂNG NHẬP<div id="close" onclick="close_log()">X</div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Tài khoản</div>
                    <div class="Log_Space2" style="padding-right:12px"><input type="text" placeholder="Nhập tài khoản" id="logna" name="logna"></div>
                </div>
                <div class="Login_Block">
                    <div class="Log_Space1">Mật khẩu</div>
                    <div class="Log_Space2" style="padding-left:4px"><input type="password" placeholder="Nhập mật khẩu" id="passw" name="passw">
                        <div style="float:right; padding-top: 7px;"><button class="" type="button" id="see">
                            <span class="fas fa-eye-slash"></span></button></div>
                    </div>
                </div>
                <div class="Login_Block" style="padding-left: 30px; margin: 10px; color: #72828e;">Chưa có tài khoản, chọn&nbsp<a style="color:#c94f7c;cursor: pointer;" href="index.php?form=sig">ĐĂNG KÝ</a></div>
                <div class="summit_space">
                    <input type="submit" class="summit_button" name="submit" value="ĐĂNG NHẬP">
                </div>
            </div>
        </div>

<script>
    function close_log() {
        window.location.href="index.php";
    }

    function seePass(){
        var see=document.getElementById("see");
        var pass=document.getElementById("passw");
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

    function login(event){
        event.preventDefault();
        var uname=document.getElementById('logna').value;
        var upass=document.getElementById('passw').value;
        $.ajax({
            url:'/ART/api/getLog.php',
            type: "POST",
            dataType: "text",
            data:{
                username: uname,
                password: upass
            },
            success : function (data){
                if(data=="-3"){
                    alert("Chưa nhập tên tài khoản");
                    document.getElementById('logna').focus();
                    return false;
                }
                else if (data=="-2"){
                    alert("Chưa nhập mật khẩu");
                    document.getElementById('passw').focus();
                    return false;
                }
                else if (data=="-1"){
                    alert("Tài khoản này không tồn tạo");
                    document.getElementById('logna').focus();
                    return false;
                }
                else if (data=="0"){
                    alert("Nhập sai mật khẩu");
                    document.getElementById('passw').focus();
                    return false;
                }
                else{
                    alert("Đăng nhập thành công");
                    if(data=="KH"){
                        window.location.href = 'index.php';
                    }
                    else{
                        window.location.href = 'admin.php';
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố');
            },
        });     
    }

    seePass();
    $('.Login_Space').children().unwrap().wrapAll("<form name='input' class='Login_Space' id='myForm' onsubmit='return login(event);' method='post'></form>");

</script>