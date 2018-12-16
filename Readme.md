# Hướng dẫn cài đặt và chạy thử Project 
## 1.Yêu cầu: 
- Máy cài PHP 7.
- Đã cài đặt Laravel 
## 2.Hướng dẫn 
- Clone Project từ Git: 
```
git clone https://bitbucket.org/votuan921/isd.vn.20181-06.git
```
- Vào thư mục project:
```
cd FinalProject/ecom 
```
- Khởi tạo key cho Laravel 
```
php artisan key:generate
```
- Khởi động MySQL và import database 
> Có thể sử dụng phpMyAdmin , tạo database shop_db và import shop_db.sql
> <br>Nếu tạo db riêng, cần sửa file .env
```
 nano .env 
```
> DB_DATABASE=database_name 
><br>DB_USERNAME=root
><br>DB_PASSWORD=
- Sau đó khởi chạy server:
```
php artisan serve 
```
-Đăng nhập vào trang admin theo đường dẫn
> localhost:8000/admin 
> <br> account: admin@gmail.com <br>password:123456
## 3.Video demo: