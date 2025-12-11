# 쇼핑몰 웹사이트 (Pure PHP)

> **기간:** 2024.03.04 ~ 2024.06.20  
> **개인 프로젝트**  
> 사용자가 상품을 손쉽게 검색하고 구매할 수 있으며, 관리자가 효율적으로 상품을 관리할 수 있는 **온라인 쇼핑몰 웹사이트**입니다.

---

## 화면 미리보기

### 메인 페이지
<table>
  <tr>
    <td><img src="https://github.com/user-attachments/assets/cda68a5b-a93e-4450-8094-b0be958e662a" width="500" /></td>
    <td><img src="https://github.com/user-attachments/assets/54f20050-a1f3-430e-91eb-b698324beafa" width="500" /></td>
  </tr>
</table>

### 관리자 화면
<table>
  <tr>
    <td>
      <img src="https://github.com/user-attachments/assets/c6e06d55-7247-44c8-90be-0501903695d6" width="500" /><br/>
      <img src="https://github.com/user-attachments/assets/1183963f-2e18-4360-8d6f-52c66d6a1421" width="500" />
    </td>
    <td>
      <img src="https://github.com/user-attachments/assets/797a971e-f6ed-4c33-8179-bdcbe4698129" width="500" />
    </td>
  </tr>
</table>

---

## 데모

[데모 바로가기](https://shop.kimdohyeon.dev/main.php)

---

## I 프로젝트 개요

이 프로젝트는 **Pure PHP와 MariaDB**를 기반으로 구축된 쇼핑몰 웹사이트로,  
프레임워크 없이 PHP의 기초 문법과 구조를 직접 설계하며 웹 애플리케이션의 전반적인 동작 원리를 이해하기 위해 개발하였습니다.

- **운영 체제:** Linux  
- **개발 도구:** PHP, phpMyAdmin, VSCode  
- **데이터베이스:** MariaDB  

---

## Ⅱ 개발 목적

- **사용자 관점:** 누구나 쉽게 회원가입 후 상품을 검색하고, 장바구니 및 결제를 통해 구매까지 가능한 서비스 제공  
- **관리자 관점:** 회원, 상품, 주문을 효율적으로 관리할 수 있는 백오피스 기능 구현  

---

## Ⅲ 주요 기능

###  사용자
- 회원가입, 로그인, 비밀번호 재설정  
- 프로필 및 주문 내역 조회  
- 카테고리별 상품 탐색 및 검색  
- 장바구니 추가 / 수정 / 삭제  
- 결제 및 주문 완료 페이지 제공  

###  상품
- 카테고리 및 필터 기반 검색  
- 상품 상세 정보 페이지  
- 이미지 미리보기, 재고 확인  

###  장바구니 및 결제
- 장바구니에 상품 추가 및 수량 변경  
- 결제 페이지에서 주문 내역 확인  
- 결제 완료 후 주문 상태 추적  

###  관리자(Admin)
- 회원 관리 (가입자 정보, 상태 관리)  
- 상품 등록 / 수정 / 삭제  
- 주문 내역 조회 및 상태 변경  

---

## Ⅳ 기술 스택

| 구분 | 사용 기술 |
|------|------------|
| **Frontend** | HTML, CSS, JavaScript (기본 DOM 조작) |
| **Backend** | Pure PHP 7.4 |
| **Database** | MariaDB |
| **Tool** | phpMyAdmin, VSCode |
| **OS** | Linux (Raspberry Pi 환경에서 구동) |

---

## Ⅴ 프로젝트 구조 (예시)
/shop  
├── index.php # 메인 페이지  
├── login.php # 로그인  
├── register.php # 회원가입  
├── product.php # 상품 상세 페이지  
├── cart.php # 장바구니  
├── order.php # 결제 및 주문  
├── admin/ # 관리자 페이지  
│ ├── admin_index.php  
│ ├── manage_users.php  
│ ├── manage_products.php  
│ └── manage_orders.php  
├── db/  
│ └── connect.php # DB 연결 설정  
├── assets/  
│ ├── css/  
│ ├── js/  
│ └── images/  
└── config.php  

---

## Ⅵ 실행 방법

```bash
# 1. PHP와 MariaDB 환경 설치
sudo apt install php php-mysql mariadb-server

# 2. 프로젝트 복제
git clone https://github.com/dodo5517/shoppingMall.git
cd shoppingMall

# 3. 데이터베이스 생성 및 초기화
# phpMyAdmin 또는 터미널을 이용해 shoppingMall_db 생성 후 SQL 스크립트 실행

# 4. 환경 설정 파일(.env) 수정
# 프로젝트 루트 디렉토리에 있는 .env 파일을 자신의 DB 환경에 맞게 변경하세요.
#예시:
#DB_HOST=localhost
#DB_PORT=3302
#DB_NAME=shoppingMall_db
#DB_USER=shoppingMall_user
#DB_PASS=비밀번호

# 5. 서버 실행
php -S localhost:8000
```
