#1. Lấy thông tin game server
Sau khi client đăng nhập thành công vào tài khoản Appota, trả về danh sách game server hiện tại.

	function get_list_server(){
	    $result = get_list_server_model();
	}
#2. Lấy thông tin tài khoản game
Khi user chọn một game server để đăng nhập. Với các thông tin của Appota user client gửi lên, trả về thông tin tài khoản game ở game server vừa chọn.

	function get_game_user($appota_access_token, $appota_user_id, $appota_user_name, $server_id) {...} 
Việc đầu tiên là xác thực thông tin appota user.

	$verify_result =  verify_appota_user($appota_access_token, $appota_user_id, $appota_user_name);
    $result = array();
    if (!$verify_result) {
        $result = array(
            "error_code" => "2",
            "message" => "Invalid Appota User"
        );
    }
Sau khi xác thực thành công lấy thông tin tài khoản game từ cơ sở dữ liệu. (Nếu chưa có chuyển sang tạo tài khoản game).
#3. Tạo tài khoản game user
Clien gửi lên các thông tin đăng kí tài khoản (vd: Tên, giới tính...). Server khởi tạo tài khoản mới và trả về thông tin tài khoản vừa khởi tạo.

	function create_game_user($appota_access_token, $game_user_name, $appota_user_id, $appota_user_name, $server_id) {...}
Cũng bắt đầu bằng việc xác thực thông tin user.

	$verify_result =  verify_appota_user($appota_access_token, $appota_user_id, $appota_user_name);
    $result = array();
    if (!$verify_result) {
        $result = array(
            "error_code" => "2",
            "message" => "Invalid Appota User"
        );
    }
Tiếp theo kiểm tra các thông tin đăng kí:

- Kiểm tra tài khoản đó đã tồn tại chưa. 
- Kiểm tra game server vừa chọn có tồn tại không.

Sau đó khởi tạo tài khoản mới bằng việc thêm vào cơ sở dữ liệu game server.

#4. Thanh toán

<b>Các thông tin cần chú ý</b>: sẽ được dùng trong phần xác thực tài khoản và giao dịch thanh toán.
	
	define('CLIENT_KEY', '668a3fa96a86942252b31221a93b6898055794d20');
	define('API_KEY', 'K-A174260-U00000-E1ZSTS-A95DE87202F4C94B');
	define('CLIENT_SECRET', '2dd6162d8e9ec966af62e66bb247302f055794d20');

Khi phát sinh 1 giao dịch từ user, Appota sẽ gọi thông báo tới địa chỉ URL đã đăng kí trên trang https://developer.appota.com. Mà cụ thể là Appota sẽ gọi tới phương thức sau.

	function appota_payment($fields) {...}

Với các thông tin $_POST Appota gửi tới việc đầu tiên là tiến hành kiểm tra key hash. Với mỗi hình thức thanh toán khác nhau sẽ có các cách kiểm tra mã key hash khác nhau.

	if ( $check_hash != $hash ){
            $result = array(
                "error_code" => "2",
                "message" => "Check hash fail"
            );
            return $result;
    }

Tiếp theo tiến hành xác thực giao dịch bằng cách gửi request ngược lại Appota.

	if (!verify_appota_transaction($trans_id, $amount, $state, $target)){
            $result = array(
                "error_code" => "3",
                "message" => "Verify transaction fail"
            );
            return $result;
    } 

Trước khi hoàn thành giao dịch kiểm tra lại thông tin giao dich và lấy các thông tin cần thiết:
 
- Kiểm tra giao dịch đã thưc hiện chưa.
- Lấy thông tin gói nạp.
- Lấy thông tin tài khoản game: Để lấy được thông tin cần có 2 thành phần quan trọng cần chú ý.

	- <b>$_POST['state']</b>: Được client định nghĩa để xác định gói các thông tin cần thiết như gói nạp, loại giá trị qui đổi, game server ... (Ví dụ: com.gold.package1:1000:gold:X:Y nghĩa là nạp gói com.gold.package1 giá trị 1000 gold cho tài khoản X ở server Y)
	- <b>$_POST['target']</b>: Là thông tin Appota user được Appota định nghĩa dưới dạng username:xxx|userid:yyy (trong đó xxx là tên Appota user, yyy là Appota id của tài khoản nạp)
		
			$tmp = explode('|', $target);
	    	$appota_uset_id = explode(':', $tmp[1])[1];
		    $appota_uset_name = explode(':', $tmp[0])[1];
		    $server_id = explode(":", $state)[4];
		    $user_info = get_game_user_model($appota_uset_id, $appota_uset_name, $server_id); 

Cuối cùng là cộng tài nguyên vừa nạp cho tài khoản và cập nhật lại thông tin tài khoản đó.