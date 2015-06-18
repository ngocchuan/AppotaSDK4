# Server Game SDK4
Server Game SDK4 (backend)

## Host
http://203.162.69.22/share/ServerGameSDK4/

## Login API
1. Get List Server
	- Endpoint: `login_game.php`
	- Method: `GET`
	- Params:
		- `action` = `get_list_server`
	- Response:
		- `error_code`: 0 or 1
		- `message` : If `error_code` == 1
		- `list_server` : If `error_code` == 0, list available game server
2. Get Game User
	- Endpoint: `login_game.php`
	- Method: `GET`
	- Params:
		- `action` = `get_game_user`
		- `appota_access_token` : Appota access token
		- `appota_user_id`: Appota user id
		- `appota_user_name` : Appota user name
		- `server_id`: Server id after user choosing
	- Response:
		- `error_code` : INT (0:successful, 1: Not has user, 2: Invalid Appota User)
		- User info if `error_code` == 0:
			- `game_user_id`
			- `game_user_name`
			- `server_id`
			- `level`
			- `gold`
			- `diamond`
			- `is_vip`
		- `message` if `error_code` == 1 and require create new game user (call create game user function)

3. Create Game User
	- Endpoint: `login_game.php`
	- Method: `POST`
	- Params:
		- `action` = `create_game_user`
		- `appota_access_token` : Appota access token
		- `game_user_name`: Game user name
		- `appota_user_id`: Appota user id
		- `appota_user_name` : Appota user name
		- `server_id`: Server id after user choosing
	- Response:
		- `error_code` : INT(0: successful, 1: Parameter is null, 2: User exist, 3: Invalid Appota User, 4: Server is not exist)
		- User info if `error_code` == 0:
			- `game_user_id`
			- `game_user_name`
			- `server_id`
			- `level`
			- `gold`
			- `diamond`
			- `is_vip`
## Payment API

1. Payment Appota
	- Endpoint: `'ipn.php'`
	- Method: `'POST'`
	- Params:
		
	- Restponse:
		- `error_code` : INT(0: successful, 1:Transaction fail, 2: Check hash fail, 3: Verify transaction fail, 4: Exist transaction, 5: Not has package, 6: Not has user)
		- User info if `error_code` == 0:
			- `game_user_id`
			- `game_user_name`
			- `server_id`
			- `level`
			- `gold`
			- `diamond`
			- `is_vip`
	- Note:
		- `Test`: In browser use: http://203.162.69.22/share/ServerGameSDK4/ipn_test.php

					
		


