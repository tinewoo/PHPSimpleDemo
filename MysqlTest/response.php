<?php
// $arr = array('id' => 1,
// 'name' => 'siangwa',
// 'title' => '标题' );
// // phpinfo();

// $data = "phpstorm无法输入中文";
// $newdata = iconv('utf-8','gbk',$data);
// echo $newdata;
// echo json_encode($newdata);

/**
* 
*/
class Response
{
	const JSON = 'json';

	public static function show($code,$massage,$data,$type= self::JSON){
		if(!is_numeric($code)){  
			return '';  
		}  
		
		$type = isset($_GET['format']) ? $_GET['format'] : self::JSON;  
		$result = array(  
			'code' => $code,  
			'massage' =>$massage,  
			'data'=>$data,  
			);  
		
		if($type == 'json'){  
			self::json($code,$massage,$data);  
			exit;  
		}elseif($type == 'array'){  
			var_dump($result);  
		}elseif($type == 'xml'){  
			self::xmlEncode($code,$massage,$data);  
			exit;  
		}else{  
        // todo  
		}  
	}

	/**
	json封装
	*/
	public static function json($code,$massage,$data)
	{
		if(!is_numeric($code)){
			return 'error';
		}
		//json封装
		$result = array('code' => $code,
			'massage' => $massage,
			'data' =>$data);


		echo "result:<br/>";
		echo json_encode($result);
		echo "<br/>";
		
		exit;
	}

	public static function xml()
	{
		header("content-type:text/xml");
		$xml = "<?xml version = '1.0' encoding = 'utf-8' ?>";
		$xml .= "<root>";
		$xml .= "<code>200</code>";  
		$xml .= "<message>success</message>";  
		$xml .= "<data>";  
		$xml .= "<id></id>";  
		$xml .= "<name>singwa</name>";  
		$xml .= "</data>"; 
		$xml .= "</root>";

		echo $xml;
	}

/**
xml封装
*/
	/** 
 * @param $code 
 * @param $massage 
 * @param $data 
 */  
	public static function xmlEncode($code,$massage,$data){  
		if(!is_numeric($code)){  
			return '';  
		}  
		$result = array(  
			'code'=>$code,  
			'message'=>$massage,  
			'data'=>$data,  
			);  
		header('Content-Type:text/xml');  
		$xml = "<?xml version='1.0' encoding='utf-8' ?>";  
		$xml .= "<root>";  
		$xml .= self::xmlToEncode($result);  
		$xml .= "</root>";  
		echo $xml;  
	}  
	public static function xmlToEncode($data){  
		$xml = $attr = "";  
		foreach($data as $key=>$value){  
			if(is_numeric($key)){  
				$attr = " id='{$key}'";  
				$key = "item";  
			}  
			$xml .= "<{$key}{$attr}>";  
			$xml .= is_array($value) ? self::xmlToEncode($value) : $value;  
			$xml .= "</{$key}>";  
		}  
		return $xml;  
	}  


	/**
	我的ArrayJson测试，得出array既可以表示数组又可以表示字典。
	有key的时候表示字典显示为“{}”，没有的时候表示数组显示为"[]"
	*/
	public static function testArrayJson($code,$massage,$data){
	//数组和字典对比
		$result2 = array('code' => $code,
			'massage' => $massage,
			'data' =>$data,
			'other' => array('testarr' => array(array('detailid' => 'detailid1',
				'detailname' => 'detailname1'),
			array('detailid' => 'detailid2',
				'detailname' => 'detailname2')),
			'testid' => 'id1',
			'testname' => 'name1'
			));
		$result3 = array('a','b','c');
		$result4 = array('ssss',
			'oo' => array('testid' => 'id1',
				'testname' => 'name1'),
			'xx' => array('testid' => 'id2',
				'testname' => 'name2'));
		echo "result2:<br/>";
		echo json_encode($result2)."<br/>";
		echo "result3:<br/>";
		echo json_encode($result3)."<br/>";
		echo "result4:<br/>";
		echo json_encode($result4);
	}

}


