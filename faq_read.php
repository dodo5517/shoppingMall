<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";

	$id=$_REQUEST["id"];

	$sql="select * from faq where id=$id";
	$result=mysqli_query($db,$sql); 
	if (!$result) exit("에러:$sql");

	$row = mysqli_fetch_array($result);  // 1레코드 읽기
?>
<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="css/bootstrap.min.css" rel="stylesheet">
	<link  href="css/my.css" rel="stylesheet">
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	
<? include "main_top.php"; ?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	

<div class="row m-1  mb-0 justify-content-center">
	<div class="col" align="center">

		<h4 class="mt-5">Q & A</h4>

		<hr style="height:2px" class="mb-0">
		<table class="table table-sm m-0" style="text-align:left">
			<tr height="35" class="bg-light">
				<td class="ps-3"><?=$row["title"];?></td>
			</tr>
			<tr height="35">
				<td class="p-3">
					<?=$row["contents"];?>
				</td>
			</tr>
		</table>

		<br>
		<a href="javascript:history.back();" class="btn btn-sm btn-dark text-white">&nbsp;돌아가기&nbsp;</a>

	</div>
</div>

<br><br><br><br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
