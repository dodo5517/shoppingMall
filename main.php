<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
    include "common.php";
	$query="select * from product where icon_new=1 and status=1 order by rand() limit 16";
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러: $sql");
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
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
	<? include "main_top.php"; ?>
<!--  제목  -->
<div class="row mt-5 mb-1">
	<div class="col" align="center">
		<h2>New Arriable</h2>
	</div>	
</div>	

<!--  상품 진열  -->
<div class="row">
<?
		foreach ($result as $row){
		$id=$row["id"];
?>
	<!--  상품   -->
	<div class="col-sm-3 mb-3">
		<div class="card h-100">
			<div class="zoom_image" align="center">
				<a href="product.php?id=<?=$row['id'];?>"><img src="product/<?=$row['image1'];?>" 
					height="360" class="card-img-top img-fluid"></a>
			</div>
			<div class="card-body " align="center" style="font-size:12px;">
				<div class="card-title">
					<a href="product.php?id=<?=$row['id'];?>" style="font-weight:bold; size:20px;"><?=$row['name'];?></a><br>
					<hr style="margin:10px;">
					<?
					if (!$row['discount'])
						echo ("<p class='card-text'><b>".number_format($row['price'])." won</b><br></p>");
					else 
						echo ("<p class='card-text'><del>".number_format($row['price'])." won</del>&nbsp;&nbsp;<b>"
						.number_format(round(($row['price'])*(100-$row['discount'])/100, -3))." won</b><br></p>");
					?>
				</div>
				<?
					if ($row["icon_hit"]==1) echo ("<img src='images/best.PNG'>&nbsp;");
					if ($row["icon_new"]==1) echo ("<img src='images/new.PNG'>&nbsp;");
					if ($row["icon_sale"] == 1) {echo "<a style='color:#C1554E; font-weight:bold;'> -" .$row['discount']. "%</a>";} //색 : #C1554E(벽돌) or #C3B8AA(로고)
					//if ($row["icon_sale"]==1) echo ("<img src='images/i_sale.gif'>");
				?>
			</div>
		</div>
	</div>
<?
		}
?>

</div>
<br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
