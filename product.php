    <div class="banner">
    <h3 class="banner_content">Sản phẩm</h3>
    </div>
    <div id="MENU_CONTAIN">
    <div class="MENU_SP" style="display: flex;" id="productWraper">
        
    </div>

    <div style="width:100%;display: flex;justify-content: center;" id="pageWraper">
        <a href="#"><div class="page_num active">1</div></a> 
    </div>
    </div>
<script>
    function createParameter(value){
        if(value != null)  return `"${value}"`;
        return null;
    }

    function renderPagination(currentPage,allPage,limit,gen,cate){
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
            html+="<a href='#/'><div class='page_num' onclick='getPro(1,"+limit+","+createParameter(gen)+","+createParameter(cate)+")'><i class='fa-solid fa-angles-left'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='getPro("+(currentPage-1)+","+limit+","+createParameter(gen)+","+createParameter(cate)+")'><i class='fa-solid fa-angle-left'></i></div></a> ";
        }
        for(let i=start;i<=end;i++){
            html+="<a href='#/'><div class='page_num";
            if(i==currentPage){
                html+=" active'>"+i+"</div></a> ";
            }
            else{
                html+="' onclick='getPro("+i+","+limit+","+createParameter(gen)+","+createParameter(cate)+")'>"+i+"</div></a> ";
            }
        }
        if(currentPage<allPage){
            html+="<a href='#/'><div class='page_num' onclick='getPro("+(currentPage+1)+","+limit+","+createParameter(gen)+","+createParameter(cate)+")'><i class='fa-solid fa-angle-right'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='getPro("+allPage+","+limit+","+createParameter(gen)+","+createParameter(cate)+")'><i class='fa-solid fa-angles-right'></i></div></a> ";
        }
        $("#pageWraper").html(html); 
        let url=window.location.href.split('?')[0];
        url+="?id=product&page="+currentPage+"&limit="+limit;
        if(gen){
            url+="&gen="+gen;
            if(cate){
                url+="&category="+cate;
            }
        }
        window.history.pushState({},'',url);
    }

    function getPro(page=1,limit=9,gen,cate){
        let url="/ART/api/getAll.php?limit="+limit+"&page="+page;
        if(gen){
            url+="&gen="+gen;
            if(cate){
                url+="&category="+cate;
            }
        }
        const pr=$.ajax({
            url:url,
            type: "GET",
            dataType: 'json',
            success : function (result){
                var html="";
                $.each(result['member'], function (key, item){
                                html += "<div class='SP_CON shadow'><div class='SP_CON1'><img src='"+item['img']+"'></div>";
                                html += "<div class='SP_CON2'><div><h3>"+item['tensp']+"</h3><br><a class='price'>"+item['gia']+" VNĐ</a><br></div>";
                                html += "<div style='padding-top: 20px;'><a class='btn' >Thêm vào giỏ</a></div></div></div>";
                             });             
                $('#productWraper').html(html);
                renderPagination(result.current_page,result.allPage,result.limit,gen,cate);           
            },
            error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố');
            },
        });
    }

    const queryString = window.location.search;
    const urlParam = new URLSearchParams(queryString);
    getPro(urlParam.get('page') || 1,urlParam.get('limit')|| 9,urlParam.get('gen'),urlParam.get('category'));
</script>