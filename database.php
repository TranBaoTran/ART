<?php 
    class database{
        protected $conn=null;
        protected $table='';
        protected $statement=null;
        protected $limit;
        protected $offset;
        protected $IDSP;
        protected $ID;
        
        public function __construct(){
            $this->connect();
        }

        protected function connect(){
            include "linker.php";
            $this->conn=mysqli_connect($servername, $username, $password,"da");
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if(!mysqli_query($this->conn,"set names 'utf8'")){
                echo "Dont have utf8";
            }
        }

        public function Table($table){
            $this->table=$table;
            return $this;
        }

        public function Limit($limit){
            $this->limit=$limit;
            return $this;
        }

        public function Offset($offset){
            $this->offset=$offset;
            return $this;
        }

        public function IDSP($IDSP){
            $this->IDSP=$IDSP;
            return $this;
        }

        public function ID($ID){
            $this->ID=$ID;
            return $this;
        }

        public function ResetQuery(){
            $this->table='';
            $this->limit=9;
            $this->offset=0;
            $this->ID='';
            $this->IDSP='';
        }

        public function Get(){
            $sql="select * from $this->table where sanpham.tinhtrang=1 limit ? offset ? ";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('ii',$this->limit,$this->offset);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        }

        public function getGio($start,$end,$type,$otype){
            $top="select ";
            $middle="from donhang join ctdon on donhang.madon=ctdon.madon ";
            $bot="where ngaydat>=? AND ngaydat<=? AND donhang.tinhtrang=1 ";
            if($otype=="1"){
                $top.="sum(ctdon.soluong * sanpham.gia) as total , ";
            }
            else{
                $top.="sum(ctdon.soluong) as total , ";
            }
            if(substr($type, 0, 1)=="0"){
                $gen=substr($type, 1);
                $top.="chungloai.tencl as ten ";
                $middle.="join sanpham on ctdon.masp=sanpham.masp join theloai on sanpham.malsp=theloai.malsp join chungloai on theloai.macl=chungloai.macl ";
                $bot.="and chungloai.macl=?";
            }
            else{
                $gen=substr($type, 1);
                $top.="theloai.tenlsp as ten ";
                $middle.="join sanpham on ctdon.masp=sanpham.masp join theloai on sanpham.malsp=theloai.malsp ";
                $bot.="and theloai.malsp=?";
            }
            $sql=$top.$middle.$bot;
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('sss',$start,$end,$gen);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData=$row;
            }

            return $returnData;
        }

        public function getFull($start,$end,$otype){
            $top="select ";
            $middle="from donhang join ctdon on donhang.madon=ctdon.madon join sanpham on ctdon.masp=sanpham.masp ";
            $bot="where ngaydat>=? AND ngaydat<=? AND donhang.tinhtrang=1 ";
            if($otype=="1"){
                $top.="sum(ctdon.soluong * sanpham.gia) as total ";
            }
            else{
                $top.="sum(ctdon.soluong) as total ";
            }
            $sql=$top.$middle.$bot;
            // echo $sql;
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('ss',$start,$end);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();
            if ($result){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function getTop($start,$end,$otype,$sort){
            $top="select ";
            $middle="from donhang join ctdon on donhang.madon=ctdon.madon join sanpham on ctdon.masp=sanpham.masp ";
            $bot="where ngaydat>=? AND ngaydat<=? AND donhang.tinhtrang=1 group by ctdon.masp ";
            if($otype=="1"){
                $top.="sum(ctdon.soluong * sanpham.gia) as total , tensp ";
            }
            else{
                $top.="sum(ctdon.soluong) as total , tensp ";
            }
            if($sort=="1"){
                $bot.=" order by total desc";
            }
            else{
                $bot.=" order by total asc";
            }
            $sql=$top.$middle.$bot;
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('ss',$start,$end);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        }

        public function GetGen($name){
            $sql="select * from sanpham join theloai on sanpham.malsp=theloai.malsp where macl=? and sanpham.tinhtrang=1 limit ? offset ?";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('sii',$name,$this->limit,$this->offset);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        }

        public function GetCate($name){
            $sql="select * from sanpham where malsp=? and sanpham.tinhtrang=1 limit ? offset ?";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('sii',$name,$this->limit,$this->offset);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        }

        public function getFind($name,$type,$min,$max){
            $sql="select * from sanpham ";
            if($type==""){
                $sql.="where tensp like concat('%',?,'%') and malsp like concat('%',?,'%') and gia>=? and gia<=? ";
                $gen="";
            }
            else if(substr($type, 0, 1)=="0"){
                $gen=substr($type, 1);
                $sql.="join theloai on sanpham.malsp=theloai.malsp where tensp like concat('%',?,'%') and macl=? and gia>=? and gia<=? ";
            }
            else{
                $gen=substr($type, 1);
                $sql.="where tensp like concat('%',?,'%') and malsp=? and gia>=? and gia<=? ";
            }
            $sql.="and sanpham.tinhtrang=1 limit ? offset ?";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('ssddii',$name,$gen,$min,$max,$this->limit,$this->offset);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();

            $returnData=[];

            while ($row = $result->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        } 

        public function Insert($data=[]){
            $key= array_keys($data);
            $field=implode(',',$key);
            $questionMark=array_fill(0,count($data),'?');
            $valueMark=implode(',',$questionMark);

            $values=array_values($data);

            $sql = "insert into $this->table($fields) values($valueMark)";
            $this->statement= $this->conn->prepare($sql);

            $this->statement->bind_param(str_repeat('s',count($data)), ...$values);

            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;
        }

        public function InsertTK($data=[]){
            $sql = "insert into taikhoan (tendn,matkhau,ngaytao,nhomquyen,tinhtrang) values (?,?,NOW(),?,1)";
            $this->statement= $this->conn->prepare($sql);
            $values=array_values($data);
            $this->statement->bind_param('sss', ...$values);
            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;

        }

        public function InsertKH($data=[]){
            $sql = "insert into khachhang (matk,hoten,sdt,mail,tinhtrang) values (?,?,?,?,1)";
            $this->statement= $this->conn->prepare($sql);
            $values=array_values($data);
            $this->statement->bind_param('isss', ...$values);
            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;

        }

        public function UpdateRow($id,$data = []){
            $keyVal=[];
            foreach($data as $key => $value){
                $keyVal[]=$key . '=?';
            }
            $setField=implode(',',$keyVal);

            $values= array_values($data);
            $values[]= $id;

            $sql = "update $this->table set $setField where id=?";
            $this->statement = $this->conn->prepare($sql);
            $dateType=str_repeat('s',count($data)).'i';
            $this->statement->bind_param($dateType, ...$values);

            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;
        }

        public function updateTotal($total,$ma){
            $sql="update donhang set tongtien=? where madon=?";
            $this->statement = $this->conn->prepare($sql);
            $this->statement->bind_param('ii',$total,$ma);
            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;
        }

        public function updateQuantity($sl,$buy,$ma){
            $sql="update sanpham set soluong=? , slmua=? where masp=?";
            $this->statement = $this->conn->prepare($sql);
            $this->statement->bind_param('iis',$sl,$buy,$ma);
            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;
        }

        public function CountAll(){
            $sql="select count(*) as total from $this->table where sanpham.tinhtrang=1";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function CountCate($col){
            $sql="select count(*) as total from $this->table where $col = '$this->ID' and sanpham.tinhtrang=1";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function CountGen($tab,$col1,$col2,$col3){
            $sql="select count(*) as total from $this->table join $tab on $this->table.$col1=$tab.$col2 where $tab.$col3 = '$this->ID' and sanpham.tinhtrang=1";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function countFind($name,$type,$min,$max){
            $sql="select count(*) as total from sanpham ";
            if($type==""){
                $sql.="where tensp like concat('%',?,'%') and malsp like concat('%',?,'%') and gia>=? and gia<=? ";
                $gen="";
            }
            else if(substr($type, 0, 1)=="0"){
                $gen=substr($type, 1);
                $sql.="join theloai on sanpham.malsp=theloai.malsp where tensp like concat('%',?,'%') and macl=? and gia>=? and gia<=? ";
            }
            else{
                $gen=substr($type, 1);
                $sql.="where tensp like concat('%',?,'%') and malsp=? and gia>=? and gia<=? ";
            }
            $sql.="and sanpham.tinhtrang=1";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('ssdd',$name,$gen,$min,$max);
            $this->statement->execute();
            $this->ResetQuery();

            $result=$this->statement->get_result();
            if ($result){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function Take($sql){
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return "";
        }

        public function NotPrepare($sql){
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();

            $returnData=[];

            while ($row = $query->fetch_object()){
                $returnData[]=$row;
            }

            return $returnData;
        }

        public function getOne($sql){
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();

            while ($row = $query->fetch_object()){
                $returnData=$row;
            }

            return $returnData;
        }

        public function check($sql){
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if(mysqli_num_rows($query) > 0){
                return -1;
            }

            return 0;
        }

        public function DeleteID($ID){
            $sql="delete from $this->table where id=?";
            $this->statement=$this->conn->prepare($sql);
            $this->statement->bind_param('i',$ID);
            $this->statement->execute();
            $this->ResetQuery();
            return $this->statement->affected_rows;
        }

        public function getName($name,$pass){
            $sql="select * from taikhoan where tendn=? and tinhtrang=1";
            $this->statement=$this->conn->prepare($sql);
            $this->statement->bind_param('s',$name);
            $this->statement->execute();
            $this->ResetQuery();
            $result=$this->statement->get_result();
            $password = md5($pass);
            // echo "$password";
            if($row=$result->fetch_object()){
                $temp=$row->matkhau;
                if($temp==$password){
                    return intval($row->matk);
                }
                else{
                    return 0;
                }
            }
            else{
                return -1;
            }
        }

        public function InsertDH($ma){
            $sql = "insert into donhang (makh,ngaydat) values (?,NOW())";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('i', $ma);
            $this->statement->execute();
            $this->ResetQuery();

            if($this->statement->affected_rows>0){
                $ma = mysqli_insert_id($this->conn);
                return $ma;
            }
            else{
                return -1;
            }

        }   

        public function InsertCTD($madon,$masp,$soluong){
            $sql = "insert into ctdon (madon,masp,soluong) values (?,?,?)";
            $this->statement= $this->conn->prepare($sql);
            $this->statement->bind_param('iii',$madon,$masp,$soluong);
            $this->statement->execute();
            $this->ResetQuery();

            return $this->statement->affected_rows;
        }

        public function Close(){
            $this->conn->close();
        }
    }

    class Connection{
        public static function executeQuery($sql){
            include "linker.php";
            $conn = mysqli_connect($servername, $username, $password,"da");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if(!mysqli_query($conn,"set names 'utf8'")){
                echo "Dont have utf8";
            }

            if(!$result = mysqli_query($conn,$sql)){
                echo "Cant connect";
            }

            if(!mysqli_close($conn)){
                echo "Cant disconnect";
            }
            return $result;
        }
    }
?>