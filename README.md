# Tech Project AMUZ Rental Web Service

> 아뮤즈 기술 과제 라라벨 ORM을 이용한 렌트카 예약 시스템 관련 프로젝트 저장소입니다.

-   개발 기간 : `2024.02.20 ~ 2024.02.27`
-   개발 목적 : `라라벨 프레임 워크 및 Tailwind Inertia Vue 이용하여 웹 페이지 구성`

-   개발 환경

    -   vscode
    -   laravel ^9.0
    -   php ^8.0
    -   inertiajs/vue3
    -   vue3
    -   tailwindcss
    -   flatpickr
    -   mysql

-   실행 방법

    1. vscode, mysql 설치
    2. 새폴더 생성 및 해당 위치에서 vscode 실행 후 TEMINAL 실행
    3. `git clone https://github.com/JisooOvO/TechProject-Vue-Laravel-rentalcars.git`
    4. `cd TechProject-Vue-Laravel-rentalcars` 또는 해당 파일에서 vscode 실행 후 TEMINAL 실행
    5. `npm install`
    6. `composer install`
    7. `php artisan storage:link`
    8. `.env.example` 파일 이름 `.env` 로 변경 후 mysql connection 관련 설정( password 등 )
    9. `php artisan migrate` -> `would you like to create it` 에서 `y` 입력
    10. `php artisan key:generate`
    11. `php artisan serve` 명령어 입력 후
    12. `http://127.0.0.1:8000/` 로 접속

-   예약 기능 설명

    -   현재 사용 중인 차량 수와 전체 차량 수가 일치하면 예약 마감으로 설정했습니다.
    -   사용자의 취소 등의 경우를 고려하여 사용 중이 아닌 예약 정보는 예약 가능한 차량 수에 영향을 미치지 않습니다.
        -   (미구현) 예약 확정 기능 추가를 고려할 수 있습니다.
    -   예약 당일에 예약 상태가 변경되며 예약 마감일을 지날 경우 연체 상태로 변경됩니다.
        -   (미구현) 취소 및 반납 기능 추가를 고려할 수 있습니다.

-   페이지 설명

    -   list page
        -   등록된 차량 및 예약 가능 여부 확인
    -   create page
        -   신규 차량 등록 기능 구현
        -   기존 차량 정보를 불러 올 수 있는 기능 구현
            -   모델 명을 기준으로 차량 구분
            -   모델 명이 같은 차량 등록시 업데이트 처리
            -   단, 이미 예약된 정보에 영향이 가지 않게 차량 대수는 기존 값에서 더해집니다.
    -   show page
        -   list page 에서 클릭한 차량의 예약 정보 확인
        -   해당 차량이 예약 마감 상태일 경우 접근 불가
    -   reservation page
        -   show page 에서 예약 버튼 클릭시 예약 서비스 기능 제공
        -   예약 시작일, 마감일 지정 가능
            -   예약 가능한 차량 수가 더 많을 경우에는 Dimmed 처리 X (모닝)
            -   예약 가능한 차량 수보다 해당 차량의 예약 정보 수가 같거나 많을 경우 중복 불가능한 날짜를 Dimmed 처리(아반떼)
        -   해당 차량이 예약 마감 상태일 경우 접근 불가 (BMW)

-   TODO
    -   [x] 예약 시간 추가
