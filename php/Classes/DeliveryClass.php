<?
class DeliveryClass{
	private $deliveryData = array("region"=>"","curier"=>"","departure_date"=>"","arrival_date"=>"");
	
	public function __construct($region,$curier,$departure_date,$arrival_date){
		$this->deliveryData["region"] = $region;
		$this->deliveryData["curier"] = $curier;
		$this->deliveryData["departure_date"] = $departure_date;
		$this->deliveryData["arrival_date"] = $arrival_date;
	}
	
	public function getDeliveryData(){
		return json_encode($this->deliveryData,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
	}
}
?>