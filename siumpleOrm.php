<?php 

abstract class ActiveRecord{
	protected static $table;
	protected $fieldvalues;
	public $select;

	public static function findBindId($id){
		$query = "select * from".static::$table."where id = {$id}";
		return static::createDomain($query);

	}

	public function __get($fieldname){
		return $this->fieldvalues[$fieldname];
	}

	public __callStatic($method, $args){
		$field = preg_replace('/^findBy(\w*)$/', '${1}', $method);
		$query = "select * from ".static::$table."where {$field} = '{$args[0]}'";
		return self::createDomain($query);
	}

	static function createDomain($query){
		$klass = get_called_class();
		$domain = new $klass();
		$domain->fieldvalues = [];
		$domain->select = $query;
		foreach ($klass::$field as $field => $value) {
			$domain->fieldvalues[$field] = 'TODO:set from sql result';
		}

		return $domain
	}
}



class Customer extends ActiveRecord{
	protected static $table = 'custdb';
	protected static $fields = [
		'id' => 'int',
		'email' => 'varchar',
		'lastname' => 'varchar'
	];
}





class Sales extends ActiveRecord{
	protected static $table = 'custdb';
	protected static $fields = [
		'id' => 'int',
		'email' => 'varchar',
		'lastname' => 'varchar'
	];
}


 ?>