# Tích hợp Appota SDK cho Unity #
Sau khi import asset Appota SDK như theo hướng dẫn tại https://github.com/appota/unity-game-sdk. Việc tích hợp Appota SDK có hai phần cần chú ý là đăng nhập và thanh toán.

**Những khái niệm sử dụng:**

*Appota user*: Tài khoản Appota của người dùng.  
*Game user*  : Tài khoản game của người dùng.  
*Game server*: Game được chia thành các server khác nhau.  
*Server*     : Server game hiện tại.  
*Client*     : Ứng dụng game hiện tại.

## 1. Đăng nhập ##

Việc đầu tiên là init Appota SDK.

	void InitAppota(){
		#if UNITY_IPHONE
		AppotaSDKHandler.Instance.Init();
		AppotaSDKHandler.Instance.SetAutoShowLoginDialog(false);
		#endif
		
		#if UNITY_ANDROID
		AppotaSDKHandler.Instance.Init();
		AppotaSDKHandler.Instance.SetAutoShowLoginDialog(true);
		#endif
	}

Init Appota sẽ tự động tiến hành login vào tài khoản Appota nếu đã đăng nhập từ trước. Khi chưa đăng nhập phương thức SetAutoShowLoginDialog(true) sẽ tự động hiển thị hộp thoại đăng nhập.

Sau khi đăng nhập thành công SDK sẽ gọi callback tới phương thức OnLoginSuccess() trong lớp AppotaSDKReceiver và trả về thông tin Appota user. Việc bắt sự kiện tại đây sẽ cho ta biết được việc đăng nhập đã hoàn thành và có được thông tin Appota user để có thể tiến hành các bước tiếp theo.

## 2. Thanh toán ##
Khi người dùng lựa chọn chức năng thanh toán.

    public void OnclickPayment(){
    	AppotaSDKHandler.Instance.ShowPaymentView ();
    }

Payment dialog của Appota sẽ hiện lên với các hình thức và gói thanh toán như đã được cấu hình tại https://developer.appota.com/  
Khi người dùng kích hoạt một giao dịch thanh toán thì SDK sẽ gọi callback lại vào phương thức GetPaymentState() trong lớp AppotaSDKReceiver.  
Tại đây với gói thanh toán người dùng vừa chọn Client cần phải định nghĩa paymentState cái mà sau đây Appota sẽ gửi lại cho server trong IPN để server có thể xác định được các thông tin về gói nạp ( như nạp gói nào ở server nào ...) và sau đó gửi lại cho SDK qua phương thức SendStateToWrapper(paymentState).

    public void GetPaymentState(string packageID)
    {
    	Debug.Log ("AppotaSDK: PackageID: " + packageID);
    	string paymentState = Setting.currentServer.Server_id+":"+packageID;
    
    	AppotaSDKHandler.Instance.SendStateToWrapper(paymentState);
    }
Khi giao dịch thành công SDK sẽ callback lại vào phương thức OnPaymentSuccess() trong lớp AppotaSDKReceiver, đồng thời gửi IPN tới server để server tiến hành nạp thẻ cho tài khoản đó.