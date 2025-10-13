<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";
	$findtext=$_REQUEST["find_text"];
	$query = "select * from product where name like '%$findtext%'  order by name";
	$result=mysqli_query($db,$query); 
    if (!$result) exit("에러1:$query");
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
<div class="row m-1 mt-4 mb-0">
	<div class="col" align="center">

		<h4 class="m-3">상품검색</h4>

		<hr class="m-0">
		<table class="table table-sm mb-4">
			<tr height="40" class="bg-light">
				<td width="15%">이미지</td>
				<td width="45%">상품정보</td>
				<td width="20%">판매가</td>
				<td width="20%">금액</td>
			</tr>
			<?
					foreach ($result as $row){
					$id=$row["id"];
			?>
			<tr height="85" style="font-size:14px;">
				<td>
					<a href="product.php?id=<?=$row["id"];?>"><img src="product/<?=$row["iamge1"];?>" width="60" height="70"></a>
				</td>
				<td align="left" valign="middle">
					<a href="product.php?id=<?=$row["id"];?>" style="color:#0066CC"><?=$row["name"];?></a><br>
					<?
						if ($row["icon_hit"]==1) echo ("<img src='images/i_hit.gif'>&nbsp;");
						if ($row["icon_new"]==1) echo ("<img src='images/i_new.gif'>&nbsp;");
						if ($row["icon_sale"]==1) echo ("<img src='images/i_sale.gif'>&nbsp;<font color='red' size='3'>".$row['discount']."%</font>");//<font size="2" color="red">20%</font>
					?>
				</td>
				<? 
				if(!$row['discount']){ //값이 없다면
					echo "<td>".number_format($row["price"])."</strike></td>";
					echo "<td><b>".number_format($row["price"])."</b></td>";
				}
				else{ //값이 있다면
					echo "<td><strike>".number_format($row["price"])."</strike></td>";
					echo "<td><b>".number_format($row["price"])."</b></td>";
				}
				?>
			</tr>
			<?
				}
			?>
		</table>
	</div>
</div>

<!--  Pagination -->
<div class="row mb-4">
	<div class="col">
		<nav aria-label="Page navigation example">
			<ul class="pagination pagination-sm justify-content-center">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="First">
						<span aria-hidden="true">◀</span>
					</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">◁</span>
					</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item active" aria-current="page">
					<span class="page-link mycolor1">2</span>
				</li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item"><a class="page-link" href="#">5</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">▷</span>
					</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Last">
						<span aria-hidden="true">▶</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>

<br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
