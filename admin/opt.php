<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    include "../common.php";

	$sql="select * from opt order by id"; 
	$result=mysqli_query($db,$sql);                         // sql 실행
	$total_count=mysqli_num_rows($result);
    if (!$result) exit("에러: $sql");                       // 에러조사
?>
<!doctype html>
<html lang="kr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INDUK Mall</title>
	<link  href="../css/bootstrap.min.css" rel="stylesheet">
	<link  href="../css/my.css" rel="stylesheet">
	<script src="..js/jquery-3.7.1.min.js"></script>
	<script src="../js/bootstrap.bundle.min.js"></script>
	<script src="../js/my.js"></script>
</head>
<body>

<div class="container">
<!-------------------------------------------------------------------------------------------->	
<script> document.write(admin_menu());</script>
<!-------------------------------------------------------------------------------------------->	

<div class="row mx-1  justify-content-center">
	<div class="col-sm-10" align="center">

		<h4 class="m-0">옵션</h4>

		<div class="row myfs13">
			<div class="col" align="left" style="padding-top:8px"">
				&nbsp;옵션수 : <font color="red"><?=$total_count;?></font>
			</div>
			<div class="col" align="right">
				<a href="opt_new.php" class="btn btn-sm mycolor1 myfs12">옵션 추가</a>&nbsp;
			</div>
		</div>
		</form>

		<table class="table table-sm table-bordered table-hover my-1">
			<tr class="bg-light">
				<td width="10%">번호</td>
				<td>옵션명</td>
				<td width="25%">수정 / 삭제</td>
				<td width="25%">소옵션 편집</td>
			</tr>
			<?
	   			foreach ($result as $row){
				$id=$row["id"];
			?>
			<tr>
				<td><?=$id;?></td>
				<td><?=$row['name'];?></td>
				<td>
					<a href="opt_edit.php?id=<?=$id;?>" class="btn btn-sm mybutton-blue">수정</a>
					<a href="opt_delete.php?id=<?=$id;?>" class="btn btn-sm mybutton-red" 
						onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
				</td>
				<td>
					<a href="opts.php?id=<?=$id;?>" class="btn btn-sm mybutton-gray">소옵션 편집</a>
				</td>
			</tr>
			<?
				}
			?>	
			<!-- <tr>
				<td>2</td>
				<td>색상</td>
				<td>
					<a href="opt_edit.php?id=2" class="btn btn-sm mybutton-blue">수정</a>
					<a href="opt_delete.php?id=2" class="btn btn-sm mybutton-red" 
						onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
				</td>
				<td>
					<a href="opts.php?id=2" class="btn btn-sm mybutton-gray">소옵션 편집</a>
				</td>
			</tr>
			<tr>
				<td>3</td>
				<td>길이</td>
				<td>
					<a href="opt_edit.php?id=3" class="btn btn-sm mybutton-blue">수정</a>
					<a href="opt_delete.php?id=3" class="btn btn-sm mybutton-red" 
						onclick="javascript:return confirm('삭제할까요 ?');">삭제</a>				
				</td>
				<td>
					<a href="opts.php?id=3" class="btn btn-sm mybutton-gray">소옵션 편집</a>
				</td>
			</tr> -->
		</table>

	</div>
</div>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
