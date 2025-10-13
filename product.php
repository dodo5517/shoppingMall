<!---------------------------------------------------------------------------------------------
	제목 : 내 손으로 만드는 PHP 쇼핑몰무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";
	$id=$_REQUEST["id"];

	$sql="select * from product where id=$id ";     // id번째 자료 읽기
    $result=mysqli_query($db,$sql); 
    if (!$result) exit("에러1:$sql");

    $row=mysqli_fetch_array($result);    // 1레코드 읽기

	$sql = "select * from opts where opt_id=".$row['opt1'];
	$result_opt1=mysqli_query($db,$sql); 
    if (!$result) exit("에러2:$sql");

	$sql = "select * from opts where opt_id=".$row['opt2'];
	$result_opt2=mysqli_query($db,$sql); 
    if (!$result) exit("에러2:$sql");

	$row1 = mysqli_fetch_array($result);  // 1레코드 읽기

	if(!$row['discount']) $price=$row['price'];
	else $price=round(($row['price'])*(100-$row['discount'])/100, -3);
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

<!--  현재 페이지 Javascript  -------------------------------------------->
<script >
	function cal_price() 
	{
		form2.prices.value = (form2.num.value * form2.price.value).toLocaleString();
		form2.num.focus();
	}

	function check_form2(str) 
	{
		if (form2.opts1.value==0) {
			alert("옵션1을 선택하십시요.");
			form2.opts1.focus();
			return;
		}
		if(<?=$row["opt2"];?>){
			if (form2.opts2.value==0) {
				alert("옵션2를 선택하십시요.");
				form2.opts2.focus();
				return;
			}
		}
		if (!form2.num.value) {
			alert("수량을 입력하십시요.");
			form2.num.focus();
			return;
		}
		if (str == "D") {
			form2.action = "cart_edit.php";
			form2.kind.value = "order";
			form2.submit();
		}
		else {
			form2.action = "cart_edit.php";
			form2.submit();
		}
	}
</script>

<!-- form2 시작  -->
<form name="form2" method="post" action="">
<input type="hidden" name="kind" value="insert">
<input type="hidden" name="id" value="<?=$row["id"];?>">
<input type="hidden" name="price" value="<?=$price;?>">
<!--  상품 사진/정보(제품명,가격,옵션)  -->
<div class="row mx-1 my-4">
	<div class="col" align="center">

		<table class="table table-sm table-borderless">
			<tr>
				<td valign="top" align="left" width="50%">
					<img src="product/<?=$row["image1"];?>" width="80%" 
						class="img-thumbnail img-fluid mt-2"  style="cursor:zoom-in" 
						data-bs-toggle="modal" data-bs-target="#zoomModal">
				</td>
				<td  width="50%" align="center" valign="top" class="px-0">
					<hr size="5px" width="100%" class="my-2">
					<table width="100%" style="font-size:12px;" class="table table-sm table-borderless p-0 m-0">
						<tr height="50">
							<td colspan="2"  align="center" style="font-size:20px; color: #222222;">
								<?=$row["name"];?>
							</td>
						</tr>
						<tr height="35">
							<td colspan="2" align="center">
							<?
								if ($row["icon_hit"]==1) echo ("<img src='images/best.PNG'>&nbsp;");
								if ($row["icon_new"]==1) echo ("<img src='images/new.PNG'>&nbsp;");
								if ($row["icon_sale"] == 1) {echo "<a style='color:#C1554E; font-weight:bold;'> -" .$row['discount']. "%</a>";}
							?>
							</td>
						</tr>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<? if(!$row['discount'])
							echo "<tr height='35'>
							<td width='30%' align='center' style='font-size:15px;'>PRICE</td>
							<td width='70%' align='left' style='font-size:15px;'>".number_format($row["price"])."</td>
							</tr>";
						else echo "<tr height='35'>
							<td width='30%' align='center' style='font-size:15px;'>RETAIL PRICE</td>
							<td width='70%' align='left' style='font-size:15px;'><strike>".number_format($row["price"])."</strike></td>
							</tr>
							<tr height='35'>
								<td  align='center' style='font-size:15px;'>PRICE</td>
								<td style='font-size:15px;' align='left'>".number_format(round(($row['price'])*(100-$row['discount'])/100, -3))."</td>
							</tr>";
						?>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<tr>
							<td align="center" style='font-size:15px;'>OPTION1</td>
							<td  align="left">
								<select name="opts1" class="form-select form-select-sm mb-2" style="width:90%;font-size:12px;">
									<?
									echo ("<option value='0'>옵션을 선택하세요.</option>");
									foreach( $result_opt1 as $row1 )
									{
										echo ("<option value='{$row1["id"]}'>{$row1["name"]}</option>");
									}
									?>
								</select>
							</td>
						</tr>
						<?
							if($row["opt2"]){
						?>
						<tr>
							<td align="center"style='font-size:15px;'>OPTION2</td>
							<td  align="left">
								<select name="opts2" class="form-select form-select-sm" style="width:90%;font-size:12px;">
								<?
									echo ("<option value='0'>옵션을 선택하세요.</option>");
									foreach( $result_opt2 as $row1 )
									{
										echo ("<option value='{$row1["id"]}'>{$row1["name"]}</option>");
									}
								?>
								</select>
							</td>
						</tr>
						<?
							}else 
						?>
						<tr><td colspan="2"><hr class="my-2"></td></tr>
						<tr>
							<td align="center" style='font-size:15px;'>COUNT</td>
							<td  align="left">
								<div class="d-inline-flex">
									<input type="text" name="num" size="5" value="1" 
										class="form-control form-control-sm" style="text-align:center;"
										onChange="javascript:cal_price()">
								</div>
								개
							</td>
						</tr>
						<tr>
							<td align="center" style='font-size:15px;'>TOTAL PRICE</td>
							<td align="left">
								<div class="d-inline-flex">
									<input type="text" name="prices" value="<?=number_format($price);?>" size="10" 
										class="form-control form-control-sm"
										style="border:0;background-color:white;text-align:left;font-size:18px;font-weight:bold;" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" height="100" align="center">
								<a href="javascript:check_form2('D')" 
									class="btn btn-sm btn-secondary text-light">바로 구매</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:check_form2('C')" 
									class="btn btn-sm btn-outline-secondary">장바구니</a>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>

	</div>
</div>

</form>
<!-- form2 끝 -->

<hr class="my-0 mx-3">

<div align="center">
	<img src="product/<?=$row["image2"]?>" class="img-thumbnail" style="border:0">
	<img src="product/<?=$row["image3"]?>" class="img-thumbnail" style="border:0">
</div>	
<!-- Zoom Modal 이미지 -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="zoomModalLabel"><?=$row['name'];?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div align="center" class="modal-body">
        <img src="product/<?=$row['image1'];?>" class="img-thumbnail" style="cursor:pointer" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
      </div>
    </div>
  </div>
</div>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
