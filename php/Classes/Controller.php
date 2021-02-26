<?
require_once 'Db.php';


class  Controller{
	private $action;
	private $data;
		
	
	
	public  function executeDataDB($connect,$query,$arr){
		$connect->getConnect();
		$query = $connect->PDO->prepare($query);
	    if(empty($arr)){
			$query->execute();
		}else $query->execute($arr);
		
		return  $query;
		$connect->closeConnect();
		unset($connect);
    }
	
}
?>