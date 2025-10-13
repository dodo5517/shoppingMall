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
    <div class="container-fluid">
	
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
		  <div class="container-fluid">
			<a class="navbar-brand" href="#">Admin</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="#">회원</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">제품</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">주문</a>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					기타
				  </a>
				  <ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Q&A</a></li>
					<li><a class="dropdown-item" href="#">FAQ</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">옵션</a></li>
				  </ul>
				</li>
				<li class="nav-item">
				  <a class="nav-link disabled" aria-disabled="true"></a>
				</li>
			  </ul>
			  <form class="d-flex" role="search">
				<a href="#" class="btn btn-sm btn-outline-secondary btn-dark">Goto Shop</a>
			  </form>
			</div>
		  </div>
		</nav>
		
		<div class="alert  mycolor1" role="alert">사용자</div>
		
		<form name="form1" method="post" action="" >
			<div class="row my-2">
				<div class="col-3" align="left">            
					<div class="input-group  input-group-sm">
						<span class="input-group-text">이름</span>
						<input type="text" name="text1" class="form-control" placeholder="찾을 이름은?">
						<button class="btn mycolor1" type="button">검색</button>
					</div>
				</div>
				<div class="col-9" align="right">           
					 <a href="#" class="btn btn-sm mycolor1">추가</a>
				</div>
			</div>
		</form>
		<table class="table  table-bordered  table-sm  table-hover mymargin5">
			<tr class="mycolor2">
				<td width="10%">번호</td>
				<td width="20%">아이디</td>
				<td width="20%">암호</td>
				<td width="20%">이름</td>
				<td width="20%">전화</td>
				<td width="10%">등급</td>
			</tr>
			<tr>
				<td>1</td>
				<td>admin</td>
				<td>1234</td>
				<td>관리자</td>
				<td>010-1111-1111</td>
				<td>관리자</td>
			</tr>
			<tr>
				<td>2</td>
				<td>id2</td>
				<td>1234</td>
				<td>홍길동</td>
				<td>010-2222-2222</td>
				<td>직원</td>
			</tr>
		</table>
		
		<nav aria-label="Page navigation example" >
		  <ul class="pagination d-flex justify-content-center">
			<li class="page-item"><a class="page-link" href="#"><</a></li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">4</a></li>
			<li class="page-item"><a class="page-link" href="#">5</a></li>			
			<li class="page-item"><a class="page-link" href="#">></a></li>
		  </ul>
		</nav>
		
    </div>
</body>
</html>
