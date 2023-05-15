<style>
* {
    margin: 0;
    padding: 0;
    max-width: none;
}
#menu {
  list-style: none;
  height: 48px;
}
#menu li {
  text-align: left;
  color: #fff;
}
#menu li a {
  text-decoration: none;
  font-size: 16px;
  display: block;
  padding: 15px;
  color: #fff;
  background-color:#ff80ab;
}
#menu > li {
  float: left;
  border-right: 1px solid #ff80ab;
  position: relative;
}
#menu > li > ul.dropdown_menu {
  position: absolute;
  list-style: none;
  display: none;
  top: 48px;
  left: 0;
  width: 200px;
}
#menu > li:hover > a {
  background-color: #fffeee !important;
  color: #ff80ab !important;
}
#menu > li:hover > ul.dropdown_menu {
  z-index: 100;
  display: block;
}
ul.dropdown_menu > li > ul.submenu {
  position: absolute;
  display: none;
  left: 200px;
  list-style: none;
  width: 200px;
}
ul.dropdown_menu > li:hover > a {
  background-color: #fffeee !important;
  color: #ff80ab !important;
}
ul.dropdown_menu > li:hover > ul.submenu {
  z-index: 100;
  display: block;
}
ul.submenu > li:hover > a {
  background-color: #fffeee !important;
  color: #ff80ab !important;
}
.arrow {
  width: 0;
  height: 0;
  display: inline-block;
  vertical-align: middle;
  margin-left: 5px;
}
.arrow-down {
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 7px solid #fff;
}
.arrow-down:hover{
  background-color: #fffeee !important;
  color: #ff80ab !important;
}
.arrow-right {
  border-top: 7px solid transparent;
  border-bottom: 7px solid transparent;
  border-left: 7px solid #fff;
}
.arrow-right:hover{
  background-color: #fffeee !important;
  color: #ff80ab !important;
}
</style>



<div style="display:none;width: 100%;background-color:#ff80ab;justify-content:center;" id="top2">
<div class="test">
      <ul id="menu">
          <li>
            <a href="index.php">
              <i class="fa-solid fa-house"></i>&nbspTrang chủ
            </a>
          </li>
          <li>
            <a href="index.php?id=about">
              <i class="fa-solid fa-palette"></i>&nbspTổng quan
            </a>
          </li>
          <li>
            <a href="index.php?id=product">
             <i class="fa-brands fa-product-hunt"></i>&nbspSản phẩm
              <span class="arrow arrow-down"></span>
            </a>
            <?php 
                    include_once "database.php";
                    $arr=[];
                    $sql="select * from chungloai where tinhtrang=1";
                    $result=Connection::executeQuery($sql);
                    while($row=mysqli_fetch_array($result)){
                        $arr[]=$row[1];
                        $sign[]=$row[0];
                    }
                    echo "<ul class='dropdown_menu'>";
                    for($i=0;$i<count($arr);$i+=1){
                        echo "<li>";
                        $smallSql="select * from theloai where macl='".$sign[$i]."' and theloai.tinhtrang=1";
                        $result=Connection::executeQuery($smallSql);
                        if($result!=null){
                            $ar=[];
                            $si=[];
                            while($row=mysqli_fetch_array($result)){
                              $ar[]=$row[1];
                              $si[]=$row[0];
                            }
                            echo "<ul class='submenu'>";
                            for($j=0;$j<count($ar);$j+=1){
                              echo "
                              <li>
                                <a href='index.php?id=product&gen=".$sign[$i]."&category=".$si[$j]."'>".$ar[$j]."</a>
                              </li>";
                            }
                            echo "</ul>";
                        }
                        echo "<a href='index.php?id=product&gen=".$sign[$i]."'>".$arr[$i]."<span class='arrow arrow-right'></span></a>
                      </li>";
                    }
                    echo "</ul>";
            ?>
          </li>
          <li>
            <a href="#footer">
            <i class="fa-solid fa-phone"></i>&nbspLiên hệ
            </a>
          </li>
      </ul>
</div>
</div>