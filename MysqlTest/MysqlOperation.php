<?php

require 'Response.php';

class MysqlOperation{

	const DBNAME = 'testDB';

	public static $conf;
	public $dsn;
	public $db;
	// public static $dblink;
	static $host = '';
	static $result;
	static $mysqli;

	public static function getDBConnectInfo(){
		// if(empty($conf) || empty($host) || empty($dblink)){
			self::$conf = parse_ini_file(__DIR__ . '/conf/db.ini');
			// // $dsn = 'mysql:host=' . $conf['host'] . ';port=' . $conf['port'] . ';dbname=' . $conf['dbname'] . ';charset=' . $conf['charset'];
			// $dsn = 'mysql:host=' . $conf['host'] . ';port=' . $conf['port'] . ';dbname=' . $dbname . ';charset=' . $conf['charset'];
			// $db = new PDO($dsn, $conf['username'], $conf['password']);
			self::$host = self::$conf['host'] . ':' . self::$conf['port'];
			// self::$dblink=mysql_connect(self::$host,self::$conf['username'], self::$conf['password']);
			self::$mysqli = new mysqli(self::$host, self::$conf['username'], self::$conf['password'], self::DBNAME);
		// }
		
	}

	public static function selectOperation($selectSQL){
		// // $stmt = $db->query($selectSQL);
		// // $stmt->setFetchMode(PDO::FETCH_ASSOC);
		// // $articles = $stmt->fetchAll();
		// // $d = array();
		// // $d['articles'] = $articles;
		// // echo json_encode($stmt);
		// $conf = parse_ini_file(__DIR__ . '/conf/db.ini');
		// $host = $conf['host'] . ':' . $conf['port'];
		// $mysqli = new mysqli($host, $conf['username'], $conf['password'], "testDB");
		// $dblink=mysql_connect($host,$conf['username'], $conf['password']);
		// mysql_select_db('testDB',$dblink);
		// $result = mysql_query($selectSQL) or die("Query failed:" .MYSQL_error());
		self::$result = self::$mysqli->query($selectSQL);
		$jsons = array();
		if (!self::$result) {
    		// $message  = 'Invalid query: ' . mysql_error() . "\n";
    		// $message .= 'Whole query: ' . $query;
    		// die($message);
			Response::show(0,"获取数据失败",$jsons);
		}
		else{
			// while ($row = mysql_fetch_assoc($result)) {
			while($row = self::$result->fetch_object()){ 
    // echo $row['id'];
    // echo $row['name'];
    // echo $row['sex'];
    // echo $row['degree'];
				$jsons[] = $row;
			}
			Response::show(200,"success",$jsons);
		}
		
// echo json_encode($jsons) ;
		mysql_close(self::$mysqli);
	}

	public static function selectOperationNesting($selectSQL){
		self::$result = self::$mysqli->query($selectSQL);
		$result = self::$mysqli->query($selectSQL);
		$jsons = array();
		$jsonparam;
		if (!self::$result) {
			Response::show(0,"获取数据失败",$jsons);
		}
		else{
			while($row = self::$result->fetch_object()){ 
				$jsonparam = array();
				$result -> data_seek(0);
				while($rowparam = $result->fetch_object()){ 
					if($row -> degree === $rowparam -> degree){
						$jsonparam[] = $rowparam;
					}
				}
				// while ($rowparam = mysql_fetch_row($result)) {
    //             	if($row -> degree === $rowparam -> degree){
				// 		$jsonparam[] = $rowparam;
				// 	}
    //         	}
				$array2 = array('detail' => $jsonparam);
				$jsons[] = array_merge((array)$row, $array2);
					// $jsons[] = array($row, 'detail' => $jsonparam);
			}
			// mysql_free_result($result);
			Response::show(200,"success",$jsons);
		}
		echo '<br/>' . 'dadada' . '<br/>';
		// mysql_close(self::$mysqli);
		self::$mysqli -> close();
		// mysqli_close(self::$mysqli);
		echo '<br/>' . 'dadada' . '<br/>';
	}


}