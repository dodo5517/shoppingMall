<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<? 
	include "common.php";

	$menu=$_REQUEST["menu"];
	$sort=$_REQUEST["sort"];
	
	if ($sort==1)	$sql="and icon_new=1";	// 신상품
	elseif ($sort==2)	$sql="and icon_hit=1"; 	// 인기상품
	elseif ($sort==3)	$sql="order by name";   // 이름순
	elseif ($sort==4)  $sql="order by price";    // 낮은 가격순
	else $sql="order by price desc";	    // 높은 가격순   

	$sql = "select * from product where menu=$menu and status=1 ".$sql;
	$result=mysqli_query($db,$sql);
	$total_count=mysqli_num_rows($result);
	
	if (!$result) exit("에러1:$sql");
	
	$page_line=16;           // 페이지당 제품 수
	$args="menu=$menu&sort=$sort";
	$result=mypagination($sql, $args, $count, $pagebar);
	if (!$result) exit("에러2:$sql");
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

<!--  Category 제목 -->
<div class="row mt-5">
	<div class="col" align="center">
		<h2><?=$a_menu[$menu];?></h2>
	</div>	
</div>	

<!--  상품개수 & 정렬 -->
<div class="row m-0">
	<div class="col-2" align="left" style="font-size:15px">
		Total <b><?=$total_count;?></b> items
	</div>	
	<div class="col" align="right" style="font-size:12px">
	<?
		for($i=1;$i<$n_sort;$i++)
		{
		if ($i==$sort)
			echo("<a href='menu.php?menu=$menu&sort=$i'><b><font color='steelblue'>$a_sort[$i]</font></b></a> &nbsp;|&nbsp;");
		else
			echo("<a href='menu.php?menu=$menu&sort=$i'>$a_sort[$i]</a> &nbsp;|&nbsp;");
		}
	?>
</div>	
<hr class="mt-0 mb-4">

<!--  상품 진열  -->
<div class="row">
<?
		foreach ($result as $row){
		$id=$row["id"];
?>
	<!--  상품1  -->
	<div class="col-sm-3 mb-3">
		<div class="card h-100">
			<div class="zoom_image" align="center">
				<a href="product.php?id=<?=$row['id'];?>"><img src="product/<?=$row['image1'];?>" 
					height="360" class="card-img-top img-fluid"></a>
			</div>
			<div class="card-body" align="center" style="font-size:12px;">
				<div class="card-title">
					<a href="product.php?id=<?=$row['id'];?>" style="font-weight:bold; size:20px;"><?=$row['name'];?></a><br>
					<hr style="margin:10px;">
					<?
					if (!$row['discount'])
						echo ("<p class='card-text'><b>".number_format($row['price'])." won</b><br></p>");
					else 
						echo ("<p class='card-text'><del>".number_format($row['price'])." won</del>&nbsp;&nbsp;<b>"
						.number_format(round($row['price'])*(100-$row['discount'])/100, -3)." won</b><br></p>");
					?>
				</div>
				<?
					if ($row["icon_hit"]==1) echo ("<img src='images/best.PNG'>&nbsp;");
					if ($row["icon_new"]==1) echo ("<img src='images/new.PNG'>&nbsp;");
					if ($row["icon_sale"] == 1) {echo "<a style='color:#C1554E; font-weight:bold;'> -" .$row['discount']. "%</a>";}
				?>
			</div>
		</div>
	</div>
<?
	}
?>
<?
    echo  $pagebar;            // pagination bar 표시
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->
</body>
</html>
