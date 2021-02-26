<?
include_once 'Classes/Db.php';
include_once 'Classes/Controller.php';



          
           
           if(isset($_GET["action"])){
   
				$action = $_GET["action"];
				switch ($action) {
				case 'loadData':
					loadData();
					break;
				case 'showByFilter':
					showByFilter($date);
					break;
			   }
		   }elseif(isset($_POST["action"])){
			    if(isset($_POST["region"]) && isset($_POST["courier"]) && isset($_POST["date"])){
					
					$region = $_POST["region"];
					$courier = $_POST["courier"];
					$date = $_POST["date"];
					$duration = $_POST["duration"];
					
					addNewRecord($region,$courier,$date,$duration);		
				}
			       
		   }
		


function showByFilter($date){
	if(isset($_GET["date"])){
		
	}
}
function showError($error){
	echo json_encode($error,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}
function addNewRecord($region,$courier,$date,$duration){
	
	$saveStatus = array("errors"=>"","results"=>"");
	
	$connect = new Db("localhost","root","root","delivery");
    $addData = new Controller();//вызываем загрузчика
    
	$tableData = array();
	$query = "";
	//сохранение данных
	$departure_date = $date;
	$date = date_create($date);
    date_modify($date, "+$duration day");
    $arrival_date = date_format($date, 'Y-m-d');
	
	$arrival_date_str = "'".$arrival_date."'";
	$departure_date_str = "'".$departure_date."'";
	//проверяем,не занят ли курьер
	$query = "SELECT COUNT(*) FROM travel_schedule_tab WHERE courier_id = $courier";
	$result = $addData->executeDataDB($connect,$query,"");
	
	if($result->fetchColumn()== 0){
		$query = "INSERT INTO `travel_schedule_tab`  (`id`,`region_id`, `courier_id`,`departure_date`,`arrival_date`)  VALUES(NULL,$region,$courier,$departure_date_str, $arrival_date_str)";
	
	    $addData->executeDataDB($connect,$query,"");
	    $tableData = ['region'=>$region,'courier'=>$courier,'departure_date'=>$departure_date,'arrival_date'=>$arrival_date];
		$saveStatus["results"] = $tableData;
		$saveStatus["errors"] = array("message"=>"OK");	
	}else{
		$saveStatus["errors"] = array("message"=>"Error");
	}	
	echo json_encode($saveStatus,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}

function loadData(){
	$connect = new Db("localhost","root","root","delivery");
	
	
	
    $loadData = new Controller();//вызываем загрузчика
	$data = array("table"=>"","couriers"=>"","regions"=>"");//многомерный массив из данных расписания, курьеров и регионов
	
	
	//загрузка из базы расписания поездок
	$query = "SELECT region_tab.region_name,courier_tab.courier_fio,departure_date,arrival_date
	FROM `travel_schedule_tab`,`region_tab`,`courier_tab` 
	WHERE (region_id=region_tab.id)and(courier_id=courier_tab.id)";
	
	
	$result = $loadData->executeDataDB($connect,$query,"");
	
	$tableData = array();
	
	while($row = $result->fetch()){
		   $tableData[] = array('region'=>$row['region_name'],'courier'=>$row['courier_fio'],'departure_date'=>$row['departure_date'],'arrival_date'=>$row['arrival_date']);
	    }
	$data["table"] = $tableData;//формируем массив из данных расписания
	$query = "";
	$result = null;
	
	//загрузка из базы курьеров
	$query = "SELECT * FROM `courier_tab`";
	$result = $loadData->executeDataDB($connect,$query,"");
	
	$couriersList=array();
	while($row = $result->fetch()){
		   $couriersList[] = array('id'=>$row['id'],'name'=>$row['courier_fio']);
	    }
	$data["couriers"] = $couriersList;//формируем массив из данных курьеров
	$query = "";
	$result = null;
	
	
	//загрузка из базы регионов
	$query = "SELECT * FROM `region_tab`";
	$result = $loadData->executeDataDB($connect,$query,"");
	
	$regionsList=array();
	while($row = $result->fetch()){
		   $regionsList[] = array('id'=>$row['id'],'region'=>$row['region_name'],'travel_duration'=>$row['travel_duration']);
	    }

	$data["regions"] = $regionsList;//формируем массив из данных регионов
	
    echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}
?>