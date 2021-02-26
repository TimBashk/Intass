<?
class Db{
	
	private $host;
	private $user;
	private $password;
	private $options;
	private $data_base;
	private $charset = "UTF8";
	public $PDO;
	
	public function __construct($host_var,$user_var,$password_var,$data_base_var){
		$this->host = $host_var;
		$this->user = $user_var;
		$this->password = $password_var;
		$this->data_base = $data_base_var;
		$this->options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];
	}
	
	public function getConnect(){
		
		$this->PDO = new PDO("mysql:dbname=$this->data_base;host=$this->host;
		charset=$this->charset",$this->user, $this->password,$this->options);
}

	public function closeConnect(){
		$this->PDO = null;
	}

	public function getInfoPDO(){
		return $this->PDO;
	}
}
?>