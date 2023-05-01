<?php
    require_once "database.php";
    include_once "pagination.php";

    $db=new Database();

    $LFull='';
    $LFirst='';
    $total;

    $cate='';
    $gen='';
    $page='';

    if(isset($_GET['gen'])){
        if(isset($_GET['category'])){
            $LFull="index.php?id=product&gen=".$_GET['gen']."&category=".$_GET['category']."&page={page}";
            $LFirst="index.php?id=product&gen=".$_GET['gen']."&category=".$_GET['category'];
            $total=$db->Table('sanpham')->ID($_GET['category'])->CountCate('malsp');
            $gen.="&gen=".$_GET['gen'];
            $cate.="&category=".$_GET['category'];
        }
        else{
            $LFull="index.php?id=product&gen=".$_GET['gen']."&page={page}";
            $LFirst="index.php?id=product&gen=".$_GET['gen'];
            $total=$db->Table('sanpham')->ID($_GET['gen'])->CountGen('theloai','malsp','malsp','macl');
            $gen.="&gen=".$_GET['gen'];
        }
    }
    else{
        $LFull="index.php?id=product&page={page}";
        $LFirst="index.php?id=product";
        $total=$db->Table('sanpham')->CountAll();
    }

    if(isset($_GET['page'])){
        $page="&page=".$_GET['page'];
    }
    else{
        $page="&page=1";
    }

    $config = array(
        'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1,
        'total_record'  => $total, // tổng số thành viên
        'limit'         => 9,
        'link_full'     => $LFull,
        'link_first'    => $LFirst,
        'range'         => 5
    );

    $paging = new Pagination();
    $paging->init($config);
 
    $limit = $paging->get_config('limit');
    $start = $paging->get_config('start');
    
    if(isset($_GET['gen'])){
        if(isset($_GET['category'])){
            $member = $db->Table('sanpham')->Limit($limit)->Offset($start)->GetCate($_GET['category']);
        }
        else{
            $member = $db->Table('sanpham')->Limit($limit)->Offset($start)->GetGen($_GET['gen']);
        }
    }
    else{
        $member = $db->Table('sanpham')->Limit($limit)->Offset($start)->Get();
    } 

    $db->close();

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        die (json_encode(array(
            'member' => $member,
            'paging' => $paging->html()
        )));
    } 
?>

<div class="banner">
        <h3 class="banner_content">Sản phẩm</h3>
</div>
<div id="MENU_CONTAIN">
    <div class="MENU_SP" style="display: flex;" id="productWraper">
        <?php foreach ($member as $item){ 
            $URL="id=product".$gen.$cate.$page;
            echo "<div class='SP_CON shadow'>
            <div class='SP_CON1'>
                <img src='".$item->img."'>
            </div>
            <div class='SP_CON2'>
                <div>
                    <h3>".$item->tensp."</h3><br>
                    <a class='price'>".$item->gia." VNĐ</a><br>
                </div>
                <div style='padding-top: 20px;'>
                    <a href='index.php?".$URL."&pr=".$item->masp."&click=clicked' class='btn'>Thêm vào giỏ</a>
                </div>
            </div>
            </div>";
        }    
        ?>
    </div>

    <div style="width:100%;display: flex;justify-content: center;" id="pageWraper">
        <?php echo $paging->html(); ?>
    </div>
</div>

<?php 
    if (isset($_GET['click'])) {
        include "single.php";
    }
?>

<!-- <script>
    $('#MENU_CONTAIN').on('click','#pageWraper a', function ()
             {
                 var url = $(this).attr('href');
                 alert(url);
                 $.ajax({
                     url : url,
                     type : "GET",
                     dataType : 'json',
                     success : function (result)
                     {
                         var html;
                         if (result.hasOwnProperty('member') && result.hasOwnProperty('paging'))
                         {
                             $.each(result['member'], function (key, item){
                                html += "<div class='SP_CON shadow'><div class='SP_CON1'><img src='"+$item['img']+"></div>";
                                html += "<div class='SP_CON2'><div><h3>"+$item['tensp']+"</h3><br><a class='price'>"+$item['gia']+" VNĐ</a><br></div>";
                                html += "<div style='padding-top: 20px;'><a class='btn'>Thêm vào giỏ</a></div></div></div>";
                             });
                              
                             $('#productWraper').html(html);s
                              
                             $('#pageWraper').html(result['paging']);
                              
                             window.history.pushState({path:url},'',url);
                         }
                     },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố')
                    },
                 });
                 return false;
             });
</script> -->

