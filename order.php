<!---------------------------------------------------------------------------------------------
	제목 : PHP 쇼핑몰 실무 (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2024.02)
---------------------------------------------------------------------------------------------->
<?
	include "./common.php";

	$cart = $_COOKIE["cart"];
	$n_cart = $_COOKIE["n_cart"];
	$kind =$_REQUEST["kind"];

	$o_name="";
	$o_tel="";
	$o_email="";
	$o_zip="";
	$o_juso="";

	$cookie_id=$_COOKIE["cookie_id"];
	if($cookie_id){ //로그인 했으면
		$sql="select * from member where id=$cookie_id";
		$result=mysqli_query($db,$sql);
		if (!$result) exit("에러:$sql");

		$row=mysqli_fetch_array($result); //1레코드 읽기

		$o_name=$row["name"];
		$o_tel=$row["tel"];
		$o_email=$row["email"];
		$o_zip=$row["zip"];
		$o_juso=$row["juso"];

		$o_tel1=trim(substr($o_tel,0,3));        // 0번 위치에서 3자리 문자열 추출
		$o_tel2=trim(substr($o_tel,3,4));        // 3번 위치에서 4자리
		$o_tel3=trim(substr($o_tel,7,4));        // 7번 위치에서 4자리

	}
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

<script>
			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("핸드폰이 잘못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("핸드폰이 잘못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=490,height=320");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_email.value = "";
				}
			}
</script>

<div class="row m-1 mb-0">
	<div class="col" align="center">

		<h4 class="m-3">주문(배송정보)</h4>
		<hr class="m-0">
		
		<table class="table table-sm mb-5">
			<tr height="40" class="bg-light">
				<td width="15%">이미지</td>
				<td width="35%">상품정보</td>
				<td width="15%">판매가</td>
				<td width="20%">수량</td>
				<td width="15%">금액</td>
			</tr>
			<?
				for ($i=1;  $i<=$n_cart;  $i++)
				{
					if ($cart[$i])
					{
						list($id, $num, $opts_id1, $opts_id2)=explode("^", $cart[$i]);

						//$opts_id1, $opts_id2에 대한 소옵션이름 알아내기 
						$sql="select * from opts where id=$opts_id1";
						$result=mysqli_query($db,$sql);
						if (!$result) exit("에러1:$sql");
						$opts1=mysqli_fetch_array($result);

						$sql="select * from opts where id=$opts_id2";
						$result=mysqli_query($db,$sql);
						if (!$result) exit("에러2:$sql");
						$opts2=mysqli_fetch_array($result);
			
						// $id 제품에 대한 정보 알아내기 
						$sql="select * from product where id=$id ";     // id번째 자료 읽기, 상품 불러오기.
						$result=mysqli_query($db,$sql); 
						if (!$result) exit("에러3:$sql");
						$row=mysqli_fetch_array($result);    // 1레코드 읽기

						//단가
						if(!$row['discount']) $price=($row["price"]);
						else $price=round(($row['price'])*(100-$row['discount'])/100);

						// 자료 표시
			?>
			<tr height="85" style="font-size:14px;">
				<td>
					<a href="product.php?id=<?=$row["id"];?>"><img src="product/<?=$row["image1"];?>" width="60" height="70"></a>
				</td>
				<td align="left" valign="middle">
					<a href="product.php?id=<?=$row["id"];?>" style="color:#0066CC"><?=$row["name"];?></a><br>
					<small><b>[옵션]</b>&nbsp;<?=$opts1["name"];?>&nbsp; <?=$opts2["name"];?></small>
				</td>
				<td><?=number_format($price);?></td>
				<td><?=$num;?></td>
				<td><?=number_format($price*$num);?></td>
			</tr>
			<?
						$total=$total+($price*$num);
					}
				}
			?>
			<tr height="40" align="right" class="bg-light" style="font-size:14px;">
				<td width="10%" align="center"><img src="images/cart_image1.gif" border="0"></td>
				<td width="90%" colspan="5" class="pe-4">
					<font color="#0066CC">총금액</font> : 상품( <?=number_format($total);?> ) + 배송비( <?=number_format($baesongbi);?> ) = <font style="font-size:16px"><b><?=number_format($total+$baesongbi);?></b></font>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- form2 시작 -->
<form name="form2" method="post" action="order_pay.php">

<div class="row mx-1 my-0">
	<div class="col" align="center">

		<font size="4" color="#B90319">주문정보</font>
		<hr class="m-0 my-2">
		
		<table  style="font-size:13px;">
			<tr height="40">
				<td align="left" width="100">이름 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_name" size="20" value="<?=$o_name;?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left" width="20%">휴대폰 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_tel1" size="3" maxlength="3" value="<?=$o_tel1;?>" 
							class="form-control form-control-sm">-
						<input type="text" name="o_tel2" size="4" maxlength="4" value="<?=$o_tel2;?>"		
							class="form-control form-control-sm">-
						<input type="text" name="o_tel3" size="4" maxlength="4" value="<?=$o_tel3;?>"		
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이메일 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="o_email" size="50" value="<?=$o_email;?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="80">
				<td align="left">주소 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex mb-1">
						<input type="text" name="o_zip" size="5" maxlength="5" value="<?=$o_zip;?>" 
							class="form-control form-control-sm">&nbsp;
					</div>
					<a href="javascript:FindZip(1)"  class="btn btn-sm btn-secondary text-white mb-1"  
						style="font-size:12px">우편번호 찾기</a><br>
					<div class="d-inline-flex">
						<input type="text" name="o_juso" size="50" value="<?=$o_juso;?>" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
		</table>
		
	</div>
</div>

<br>

<div class="row mx-1 my-3">
	<div class="col" align="center">
	
		<font size="4" color="#B90319">배송정보</font>
		<hr class="m-0 my-2">
	
		<table style="font-size:13px;">
			<tr height="40">
				<td align="left" width="20%">위 복사</td>
				<td align="left">
					<div class="d-inline-flex">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="same" 
								onclick="javascript:SameCopy('Y')">
							<label class="form-check-label me-2">예</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="same" 
								onclick="javascript:SameCopy('N')">
							<label class="form-check-label">아니오</label>
						</div>
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이름 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_name" size="20" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">휴대폰 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_tel1" size="3" maxlength="3" value="" 
							class="form-control form-control-sm">-
						<input type="text" name="r_tel2" size="4" maxlength="4" value=""
							class="form-control form-control-sm">-
						<input type="text" name="r_tel3" size="4" maxlength="4" value=""
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="left">이메일 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="r_email" size="50" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="80">
				<td align="left">주소 <font color="red">*</font></td>
				<td align="left">
					<div class="d-inline-flex mb-1">
						<input type="text" name="r_zip" size="5" maxlength="5" value="" 
							class="form-control form-control-sm">&nbsp;
					</div>
					<a href="javascript:FindZip(2)"  class="btn btn-sm btn-secondary text-white mb-1"  
						style="font-size:12px">우편번호 찾기</a><br>
					<div class="d-inline-flex">
						<input type="text" name="r_juso" size="50" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="90">
				<td align="left">요구사항</td>
				<td align="left">
					<div class="d-inline-flex">
						<textarea name="memo" cols="50" rows="3" 
							class="form-control form-control-sm"></textarea>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<div class="row mx-5">
	<div class="col" align="center">
		<a href="javascript:Check_Value()" class="btn btn-sm btn-dark text-white">
			&nbsp;다 &nbsp;&nbsp; 음&nbsp;</a>
	</div>
</div>

</form>

<br><br><br>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분 -->
<!-------------------------------------------------------------------------------------------->	
<? include "main_bottom.php"; ?>
<!-------------------------------------------------------------------------------------------->	
</div>

</body>
</html>
