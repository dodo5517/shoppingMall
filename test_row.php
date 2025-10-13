<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>판매관리</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/my.css" rel="stylesheet">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

	<div class="alert  mycolor1 my-2" role="alert">사용자</div>
	
    <div class="container-fluid">
		<form name="form1" method="post" action="">
			<table class="table table-bordered table-sm mymargin5">
				<tr>
					<td width="20%" class="mycolor2"> 번호</td>
					<td width="80%" align="left">1</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 이름</td>
					<td align="left">
						<div class="fd-inline-flex col-7">
							<input  type="text" name="필드이름" 
									 class="form-control form-control-sm" placeholder="관리자" … >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font>아이디</td>
					<td align="left">
						<div class="fd-inline-flex col-7">
							<input  type="컨트롤종류" name="필드이름" 
									 class="form-control form-control-sm" placeholder="admin"… >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font>암호</td>
					<td align="left">
						<div class="fd-inline-flex col-7">
							<input  type="컨트롤종류" name="필드이름" 
									 class="form-control form-control-sm" placeholder="1234"… >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2">전화</td>
					<td align="left">
						<div class="row">
							<div class="col-3">
								<input  type="text" name="tel1"  class="form-control form-control-sm" placeholder="010"… >
							</div>-
							<div class="col-3">
							<input  type="text" name="tel2" 
									 class="form-control form-control-sm" placeholder="1111"… >
							</div>-
							<div class="col-3">
							<input  type="text" name="tel3" 
									 class="form-control form-control-sm" placeholder="1111"… >
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2">등급</td>
					<td align="left">
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
						  <label class="form-check-label" for="inlineRadio1">직원</label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
						  <label class="form-check-label" for="inlineRadio2">관리자</label>
						</div>
					</td>
				</tr>
			</table>
			<div class="d-flex justify-content-center">
				<a href="#" class="btn btn-sm mycolor1">수정</a>
				<a href="#" class="btn btn-sm mycolor1 mx-1">삭제</a>
				<a href="#" class="btn btn-sm mycolor1">저장</a>
				<a href="#" class="btn btn-sm mycolor1 mx-1">이전화면</a>
			</div>
		</form>
    </div>
	
</body>
</html>