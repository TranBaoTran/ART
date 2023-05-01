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
            $sql="select * from $this->table limit ? offset ?";
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

        public function GetGen($name){
            $sql="select * from sanpham join theloai on sanpham.malsp=theloai.malsp where macl='".$name."' limit ? offset ?";
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

        public function GetCate($name){
            $sql="select * from sanpham where malsp='".$name."' limit ? offset ?";
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

        public function CountAll(){
            $sql="select count(*) as total from $this->table";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function CountCate($col){
            $sql="select count(*) as total from $this->table where $col = '$this->ID'";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $row['total'];
            }
            return 0;
        }

        public function CountGen($tab,$col1,$col2,$col3){
            $sql="select count(*) as total from $this->table join $tab on $this->table.$col1=$tab.$col2 where $tab.$col3 = '$this->ID'";
            $query= mysqli_query($this->conn,$sql);
            $this->ResetQuery();
            if ($query){
                $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
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
            $sql="select * from taikhoan where tendn=?";
            $this->statement=$this->conn->prepare($sql);
            $this->statement->bind_param('s',$name);
            $this->statement->execute();
            $this->ResetQuery();
            $result=$this->statement->get_result();
            if($row=$result->fetch_object()){
                if($row->matkhau==$pass){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
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