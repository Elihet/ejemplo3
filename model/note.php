<?php 

class Note {

	private $table = 'note';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Get all notes */
	public function getNotes(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Get note by id */
	public function getNoteById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	/* Save note */
	public function save($param){
		$this->getConection();

		/* Set default values */
		$producto = $importe = "";

		/* Check if exists */
		$exists = false;
		if(isset($param["id"]) and $param["id"] !=''){
			$actualNote = $this->getNoteById($param["id"]);
			if(isset($actualNote["id"])){
				$exists = true;	
				/* Actual values */
				$id = $param["id"];
				$producto = $actualNote["producto"];
				$importe = $actualNote["importe"];
				$total = $actualNote["total"];
			}
		}

		/* Received values */
		if(isset($param["producto"])) $producto = $param["producto"];
		if(isset($param["importe"])) $importe = $param["importe"];
		if(isset($param["total"])) $total = $param["total"];

		/* Database operations */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET producto=?, importe=? ,total=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$producto, $importe,$total, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (producto, importe,total) values(?,?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$producto, $importe,$total]);
			$id = $this->conection->lastInsertId();
		}	

		return $id;	

	}

	/* Delete note by id */
	public function deleteNoteById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

}

?>