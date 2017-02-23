<?php
 header("Content-type: text/html; charset=utf8");
	function mydir( $dir ){
		if( is_dir($dir) ){
			$num = 0;
			$filename = '';
			$files = [];
			$namenum = [];
			//打开文件夹
			$hand = opendir($dir);
			if( $hand ){		
				while( $file = readdir( $hand ) ){

					if( $file == '.' || $file == '..'){

					}else{

						//如果不是文件夹，将文件名称放入($files)数组里
						if( !is_dir( $dir .'/'. $file) ){
							$files[] = $file;
							$num ++;
							$filename .= $file.',';
						}else{
							//如果 是文件夹，递归调用本身再次将文件夹里的文件名称放入($files)里
							$go = mydir( $dir .'/'. $file );
							$files[][$file] = $go['files'];
							$num += $go['num'];
							$filename .= $go['filename'];
						}					
					}	
				}

				//将所有文件名称切割成数组
				$namenum = explode(',', $filename);
			}
			
			//$files是以多维数组形式保存,$num是统计所有文件个数,$filename是以字符串形式保存,$namenum是以一维数组保存
			return ['files'=>$files,'num'=>$num,'filename'=>$filename,'namenum'=>$namenum];
		}	

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="GET"><input type="text" id="search" name="dir" placeholder="请输入要查询的路径"><button>查询</button></form>
	<div id="box">
			<br><?php if( !empty($_GET['dir']) ){
					$dir = mydir( $_GET['dir'] );
					var_dump($dir);			

			}?>
	</div>
</body>
</html>