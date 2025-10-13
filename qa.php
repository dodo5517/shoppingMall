<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";
	
	$text1=$_REQUEST["text1"];
	$sel1=$_REQUEST["sel1"];
	$page=$_REQUEST["page"];
	$args="sel1=$sel1&text1=$text1&page=$page";

	if (!$text1){
		$sql="select * from qa order by pos1 desc, pos2";
	}
	else{
		$sql="select * from qa where title like '%$text1%' or contents like '%$text1%' 
			order by pos1 desc, pos2;";
	}
	$result=mysqli_query($db,$sql); 
	if (!$result) exit("에러:$sql");

	$result = mypagination($sql, $args, $count, $pagebar);                            // 함수 호출
    if (!$result) exit("에러: $sql")
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

<div class="row m-1 mb-0 justify-content-center">
	<div class="col" align="center">

		<h4 class="mt-5 mb-3">Q & A</h4>
	
		<hr class="my-0">
		<table class="table table-sm m-0">
			<tr height="35" class="bg-light">
				<td width="10%">번호</td>
				<td width="45%">제목</td>
				<td width="15%">작성자</td>
				<td width="20%">작성일</td>
				<td width="10%">조회</td>
			</tr>
			<?foreach( $result as $row) {?>
			<tr height="35">
				<td><?=$row["id"];?></td>
				<td align="left">
					<a href="qa_read.php?id=<?=$row["id"];?>&page=<?=$page;?>&&text1=<?=$text1;?>" style="color:#0066CC">
						<?$n=strlen($row["pos2"]);     // 문자열길이
							if ($n==1)   // 정상 글인 경우
								echo $row["title"];
							else             // 답변글인 경우
							{
								for($j=0;  $j<$n-2;  $j++) echo("&nbsp;&nbsp;&nbsp;&nbsp;");
								echo "<img src='images/i_re.gif' border='0'>&nbsp;".$row["title"];
							}
							?>
					</a><br>
				</td>
				<td><?=$row["name"];?></td>
				<td><?=$row["writeday"];?></td>
				<td><?=$row["count"];?></td>
			</tr>
			<?
			}
			?>
			<tr height="35">
				<td></td>
				<td align="left"></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>

		<table class="table table-sm table-borderless mt-1 m-0">
			<tr>
				<td align="left">
					<form name="form2" method="post" action="qa.php">
						<div class="d-inline-flex">
							<div class="input-group input-group-sm">
								<span class="input-group-text myfs13">제목+내용</span>
								<input type="text" name="text1" size="10" value="<?=$text1;?>"
									class="form-control bg-light myfs13">
								<button type="button" class="btn btn-sm btn-outline-secondary myfs13" 
									onClick="form2.submit();">검색</button>&nbsp;
							</div>
						</div>
					</form>
				</td>
				<td align="right">
					<a href="qa_new.php" class="btn btn-sm btn-dark text-white myfs13">새글</a>&nbsp;&nbsp;
				</td>
			</tr>
		</table>
	
	</div>
</div>

<?
    echo  $pagebar;            // pagination bar 표시
?>

<br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
