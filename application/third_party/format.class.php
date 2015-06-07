<?php
/*
	类：字符串格式化类
	作者：崔庆才
	日期：2015/4/28
*/

	class Format {


		/* 格式化字符串，转换空格和换行 */
		function htmtocode($content, $addP) { 

			$content = htmlspecialchars($content, ENT_QUOTES);
		    $content = str_replace(" ", "&nbsp;", $content); 
		    $content = str_replace("\n", "<br>",$content);
		    $contents = explode( "<br>", $content);
		    $result = "";
		    foreach ($contents as $key => $val) {
		    	if ($addP) {
		    		if ($val) {
		    			$result .= "<p>".$val."</p>";
		    		}
		    	} else {
		    		$result = $val;
		    	}
		    }
		    return $result; 

		}


		/* 计算天数差 */
		function desTwoDays ($day1, $day2) {  

			$second1 = strtotime($day1);  
			$second2 = strtotime($day2);        
		  	if ($second1 < $second2) {    
		   		$tmp = $second2;   
		     	$second2 = $second1;   
		       	$second1 = $tmp;   
		    }   
		    return ($second1 - $second2) / 86400;

		} 


		/* 空格转<br>*/
		function transSpaceToBR($content) {

			$content = str_replace(" ", "<br>", $content); 
			return $content;
			
		}

	}