<div class="form_background" id="singlePage" style="display:none;">
        <form class="Login_Space"  style="width:50%" method="post" action="">
        <div class="title"><a id="close" onclick="closeSing()" style="text-decoration:none">X</a></div>
        <div class='singleSP'>
            <div class='SP_CON1'>
                <img id="spimg" src=''>
            </div>
            <div class='SP_CON2'>
                <div>
                    <h3 id="spten">temp</h3><br>
                    <a class='price' id="spprice">temp VNĐ</a><br>
                    <a class='price'>Số lượng: <a><input type='number' name='quantity' id="spmax" min='1' max='10' required value='1'>
                </div>
                <div style='padding-top: 20px;'>
                    <input type='hidden' name='pr' id="spid" value=''>
                    <input type='submit' class='btn' name='submit' value='Thêm vào giỏ'>
                </div>
            </div>
        </div>
        </form>
</div>
<script>
 function closeSing() {
        var M2 = document.getElementById("singlePage");
        if (M2.style.display === "none") {
            M2.style.display = 'block';
        } else {
            M2.style.display = 'none';
        }
    }
</script>    
