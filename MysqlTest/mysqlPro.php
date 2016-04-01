<?php

/**
存储过程
*/
// require 'mysqlConnectHead.php';

// const dbname = 'testDB';
// $dblink=mysql_connect($host,$user,$password)
// or die("can't connect to mysql");
// mysql_select_db($db,$dblink) or die("can't select testDB");

// $result = mysql_query("call InsertTestData(".$_POST["name"].",".$_POST["degree"].")") or die("Query failed:" .MYSQL_error());

/**
获取数据库数据，把mysql数据转成json
*/
require_once('./MysqlOperation.php');
MysqlOperation::getDBConnectInfo();
$selectSQL = 'select * from testtable';
// MysqlOperation::selectOperation($selectSQL);
MysqlOperation::selectOperationNesting($selectSQL);

/**
final、static、const使用
*/
// class KeyWordsTest{

// 	private static $name="static class_a"; 
// 	const PI=3.14; 
// 	public $value; 
// 	static $num=0;

// 	static function getTestStatic(){
// 		return self::$name;
// 	}

// 	public function getTestConst(){ 
// 		return self::PI; 
// 	}

// 	static function setTestStatic($nameptem,$nameptem2){
// 		self::$name = $nameptem.$nameptem2;
// 	}

// 	public function setTestConst($pitem){ 
// 		// self::PI = $pitem; 
// 	}

// 	public static function showMe(){
// 		echo "您是滴".self::$num."位访客";
// 		self::$num++;
// 	}
// }

// KeyWordsTest::setTestStatic('testname','2');
// echo KeyWordsTest::getTestStatic()."<br/>";
// echo KeyWordsTest::getTestConst()."<br/>";

// $aa = new KeyWordsTest();
// $aa->showMe();
// $aa->showMe();

//无效代码
// $result = mysql_query("call InsertTestData('str13',80.5)") or die("Query failed:" .MYSQL_error());
// $result2 = mysql_query("call InsertTestData('str12',80.5)",$dblink) or die("Query failed:" .MYSQL_error());
// while($row = mysql_fetch_array($result, MYSQL_ASSOC))
//         {
//                 $temp=$row[title];
//         }
// drupal_set_message(t('标题:%temp , array('%temp' => $temp)));
// $name = 'test33';
// $dergee = 80;
// $res=mysql_query("set @name=$name",$dblink);
// $res=mysql_query("set @degree=$dergee",$dblink);

// $db->query("CALL InsertTestData(@name,@degree)");
// $res = $db->query("select @name,@degree");
// $row = $res->fetch_array();
// echo $row['@name']; 

?>