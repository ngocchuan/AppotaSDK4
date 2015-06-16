#Tính hợp Appota SDK

##1. Ký kết hợp đồng phân phối

Sau khi Nhà phát triển và Appota hoàn thành việc ký kết Hợp đồng phân phối ứng dụng, Nhà phát triển truy cập vào địa chỉ web https://developer.appota.com/.

##2. Tạo ứng dụng

- **Tạo ứng dụng**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/1.jpg)

	Nhấp TẠO ỨNG DỤNG

- **Chọn loại ứng dụng**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/2.jpg)

	Tùy vào loại ứng dụng phát triển chọn loại tương ứng.
	- IOS
	- Android
	- Windown
	
- **Chọn gói tích hợp**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/3.jpg)


	- SDK Game : Game SDK cung cấp mọi chức năng cần thiết cho việc tích hợp game vào Appota: Đăng ký, đăng nhập, mạng xã hội, thanh toán... giúp bạn dễ dàng kết nối và đưa game vào phân phối.
	- SDK Payment : Payment SDK đóng gói toàn bộ giao diện thanh toán giúp bạn có thể tích hợp các kênh thanh toán của Appota nhanh chóng. 

	Nhấp SDK Game
	
- **Khai báo tên ứng dụng**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/4.jpg)

	Điền tên ứng dụng và nhấp bắt đầu tạo ứng dụng.

- **Thông tin ứng dụng**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/5.jpg)

	
	- IPN (Instant Payment Notification) là địa chỉ URL trên hệ thống của nhà phát triển dùng để nhận thông báo từ Appota ngay khi có giao dịch phát sinh trên ứng dụng của nhà phát triển. Appota chỉ chấp nhận các URL sử dụng giao thức HTTP hoặc HTTPS.

- **Cập nhập IPN**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/6.jpg)

	Điền địa chỉ URL và nhấp cập nhập

- **Thanh toán**

	![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/7.jpg)

	Nhấp chuyển sang mục THANH TOÁN

	- Các tùy chọn: 

		![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/8.jpg)

		- Login Options : Chọn các hình thức cho phép người dùng đăng nhập.
		- Payment Options :
			- Game currency : Tiền tệ trong game sẽ được hoán đổi sau giao dịch.
			- Payment methods: Các hình thức thanh toán giao dịch. Các hình thức thanh toán đó sẽ được cấu hình như phần dưới đây.
	- Điền thông tin thanh toán: 

		![](https://raw.githubusercontent.com/ngocchuan/AppotaSDK4/master/Image/9.jpg)

		- Enter package id : mã gói thoanh toán 
		- Enter package amount : giá trị tiền tệ trong game người dùng nhận được khi mua gói nạp.
		- SMS, Card, Bank, ... : giá trị tiền thực người dùng phải trả khi mua gói nạp.

Sau khi hoàn thành khai báo các gói thanh toán nhấp GENERATE & SAVE để kết thúc khai báo ứng dụng mới có tích hợp thanh toán.
 