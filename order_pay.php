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
	
	$o_name=$_REQUEST["o_name"];
	$o_tel1=$_REQUEST["o_tel1"];
	$o_tel2=$_REQUEST["o_tel2"];
	$o_tel3=$_REQUEST["o_tel3"];
	$o_email=$_REQUEST["o_email"];
	$o_zip=$_REQUEST["o_zip"];
	$o_juso=$_REQUEST["o_juso"];
	$o_tel = $o_tel1.$o_tel2.$o_tel3;

	$r_name=$_REQUEST["r_name"];
	$r_tel1=$_REQUEST["r_tel1"];
	$r_tel2=$_REQUEST["r_tel2"];
	$r_tel3=$_REQUEST["r_tel3"];
	$r_email=$_REQUEST["r_email"];
	$r_zip=$_REQUEST["r_zip"];
	$r_juso=$_REQUEST["r_juso"];
	$memo=$_REQUEST["memo"];
	$r_tel = $r_tel1.$r_tel2.$r_tel3;
	
	echo $r_juso;
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
	function Check_Value() 
	{
		if (form2.pay_kind[0].checked)
		{
			if (form2.card_kind.value==0) {
				alert("카드종류를 선택하세요.");	form2.card_kind.focus();	return;
			}
			if (!form2.card_no1.value) {
				alert("카드번호를 입력하세요.");	form2.card_no1.focus();	return;
			}
			if (!form2.card_no2.value) {
				alert("카드번호를 입력하세요.");	form2.card_no2.focus();	return;
			}
			if (!form2.card_no3.value) {
				alert("카드번호를 입력하세요.");	form2.card_no3.focus();	return;
			}
			if (!form2.card_no4.value) {
				alert("카드번호를 입력하세요.");	form2.card_no4.focus();	return;
			}
			if (!form2.card_month.value) {
				alert("카드기간 월을 입력하세요.");	form2.card_month.focus();	return;
			}
			if (!form2.card_year.value) {
				alert("카드기간 년도를 입력하세요.");	form2.card_year.focus();	return;
			}
			if (!form2.card_pw.value) {
				alert("카드 비밀번호 뒷의 2자리를 입력하세요.");	form2.card_pw.focus();	return;
			}
		}
		else
		{
			if (form2.bank_kind.value==0) {
				alert("입금할 은행을 선택하세요.");	form2.bank_kind.focus();	return;
			}
			if (!form2.bank_sender.value) {
				alert("입금자 이름을 입력하세요.");	form2.bank_sender.focus();	return;
			}
		}
		form2.card_kind.disabled = false;
		form2.card_no1.disabled = false;
		form2.card_no2.disabled = false;
		form2.card_no3.disabled = false;
		form2.card_no4.disabled = false;
		form2.card_year.disabled = false;
		form2.card_month.disabled = false;
		form2.card_pw.disabled = false;
		form2.card_halbu.disabled = false;
		form2.bank_kind.disabled = false;
		form2.bank_sender.disabled = false;
		
		form2.submit();
	}

	function PaySel(n) 
	{
		if (n == 0) {
			form2.card_kind.disabled = false;
			form2.card_no1.disabled = false;
			form2.card_no2.disabled = false;
			form2.card_no3.disabled = false;
			form2.card_no4.disabled = false;
			form2.card_year.disabled = false;
			form2.card_month.disabled = false;
			form2.card_halbu.disabled = false;
			form2.card_pw.disabled = false;
			form2.bank_kind.disabled = true;
			form2.bank_sender.disabled = true;
		}
		else {
			form2.card_kind.disabled = true;
			form2.card_no1.disabled = true;
			form2.card_no2.disabled = true;
			form2.card_no3.disabled = true;
			form2.card_no4.disabled = true;
			form2.card_year.disabled = true;
			form2.card_month.disabled = true;
			form2.card_halbu.disabled = true;
			form2.card_pw.disabled = true;
			form2.bank_kind.disabled = false;
			form2.bank_sender.disabled = false;
		}
	}
</script>

<div class="row m-1 mb-0">
	<div class="col" align="center">

		<h4 class="m-3">주문(결제정보)</h4>
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
					<font color="#0066CC">총금액</font> : 상품( <?=number_format((int)$total);?> ) + 배송비( <?=number_format((int)$baesongbi);?> ) = <font style="font-size:16px"><b><?=number_format((int)($total+$baesongbi));?></b></font>
				</td>
			</tr>
		</table>
	</div>
</div>

<!-- form2 시작 -->
<form name="form2" method="post" action="order_insert.php">

<input type="hidden" name="o_name"	value="<?=$o_name;?>">
<input type="hidden" name="o_tel"		value="<?=$o_tel;?>">
<input type="hidden" name="o_email"	value="<?=$o_email;?>">
<input type="hidden" name="o_zip"		value="<?=$o_zip;?>">
<input type="hidden" name="o_juso"	value="<?=$o_juso;?>">

<input type="hidden" name="r_name"	value="<?=$r_name;?>">
<input type="hidden" name="r_tel"		value="<?=$r_tel;?>">
<input type="hidden" name="r_email"	value="<?=$r_email;?>">
<input type="hidden" name="r_zip"		value="<?=$r_zip;?>">
<input type="hidden" name="r_juso"		value="<?=$r_juso;?>">
<input type="hidden" name="memo"	value="<?=$memo;?>">

<div class="row mx-1 my-0">
	<div class="col" align="center">

		<font size="4" color="#B90319">결제방법</font>
		<hr class="m-0 my-2">
					
		<table width="90%" style="font-size:13px;">
			<tr height="40">
				<td width="40%" align="right" class="pe-4">결제선택</td>
				<td align="left">
					<div class="d-inline-flex mt-2">
						<div class="form-check me-2">
							<input class="form-check-input" type="radio" name="pay_kind" value="0" 
								onclick="javascript:PaySel(0);" checked>
							<label class="form-check-label me-2">카드</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="pay_kind" value="1" 
								onclick="javascript:PaySel(1);">
							<label class="form-check-label">무통장</label>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<br><br>
		
		<font size="4" color="#B90319">카드</font>
		<hr class="m-0 my-2">
		
		<table width="90%" style="font-size:13px;">
			<tr height="40">
				<td  width="40%" align="right" class="pe-4">카드종류</td>
				<td align="left">
					<div class="d-inline-flex">
						<select name="card_kind" class="form-select form-select-sm myfs13">
							<option value="0" selected>카드종류를 선택하세요.</option>
							<option value="1">국민카드</option>
							<option value="2">신한카드</option>
							<option value="3">우리카드</option>
							<option value="4">하나카드</option>
						</select>
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="right" align="right" class="pe-4">카드번호</td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="card_no1" size="4" maxlength="4" value="" 
							class="form-control form-control-sm">&nbsp;
						<input type="text" name="card_no2" size="4" maxlength="4" value="" 
							class="form-control form-control-sm">&nbsp;
						<input type="text" name="card_no3" size="4" maxlength="4" value="" 
							class="form-control form-control-sm">&nbsp;
						<input type="text" name="card_no4" size="4" maxlength="4" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="right" align="right" class="pe-4">카드기간</td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="card_month" size="2" maxlength="2" value="" 
							class="form-control form-control-sm">
						<div class="ms-1 mt-2">월</div>&nbsp;&nbsp;
						<input type="text" name="card_year" size="2" maxlength="2" value="" 
							class="form-control form-control-sm">
						<div class="ms-1 mt-2">년</div>
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="right" align="right" class="pe-4">카드비밀번호</td>
				<td align="left">
					<div class="d-inline-flex">
						<div class="mt-2 fs-6">**</div>&nbsp;
						<input type="password" name="card_pw" size="2" maxlength="2" value="" 
							class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="right" align="right" class="pe-4">할부</td>
				<td align="left">
					<div class="d-inline-flex">
						<select name="card_halbu" class="form-select form-select-sm myfs13">
							<option value="0" selected>일시불</option>
							<option value="3">3 개월</option>
							<option value="6">6 개월</option>
							<option value="9">9 개월</option>
							<option value="12">12 개월</option>
						</select>
					</div>
				</td>
			</tr>
		</table>
				
		<br><br>
		<font size="4" color="#B90319">무통장</font>
		<hr class="m-0 my-2">
		
		<table width="90%" style="font-size:13px;">
			<tr height="40">
				<td width="40%" align="right" class="pe-4">카드종류</td>
				<td align="left">
					<div class="d-inline-flex">
						<select name="bank_kind" class="form-select form-select-sm myfs13"  disabled>
							<option value="0" selected>입금할 은행을 선택하세요.</option>
							<option value="1">국민은행 111-00000-0000</option>
							<option value="2">신한은행 222-00000-0000</option>
						</select>
					</div>
				</td>
			</tr>
			<tr height="40">
				<td align="right" class="pe-4">입금자이름</td>
				<td align="left">
					<div class="d-inline-flex">
						<input type="text" name="bank_sender" size="20" value="" 
							class="form-control form-control-sm" disabled>
					</div>
				</td>
			</tr>
		</table>

	</div>
<div>
<br>

<div class="row">
	<div class="col" align="center">
		<a href="javascript:Check_Value()"  class="btn btn-sm btn-dark text-white">&nbsp;결제하기&nbsp;</a>
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
