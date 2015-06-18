using UnityEngine;
using System.Collections;
using SimpleJSON;

public class GetDataServer : MonoBehaviour {

	private MenuController menuController;

	void Start () {
		// Set dataServer
		menuController = FindObjectOfType<MenuController>();
	}

	public void GetListServer(){
		string url = "http://203.162.69.22/share/ServerGameSDK4/login_game.php?action=get_list_server";
		WWW www = new WWW(url);
		StartCoroutine(WaitForRequest(www, "GetListServer"));
	}

	public void GetUserInfo(){
		string url = string.Format("http://203.162.69.22/share/ServerGameSDK4/login_game.php?action=get_game_user&appota_access_token={0}&appota_user_id={1}&appota_user_name={2}&server_id={3}",
		                           Setting.appotaSessionObj.AccessToken, Setting.appotaSessionObj.UserID, Setting.appotaSessionObj.UserName, Setting.currentServer.Server_id);
		WWW www = new WWW(url);
		StartCoroutine(WaitForRequest(www, "GetUserInfo"));
	}

	public void CreatGameUser(string game_user_name){
		string url = string.Format("http://203.162.69.22/share/ServerGameSDK4/login_game.php?action=create_game_user&appota_access_token={0}&game_user_name={1}&appota_user_id={2}&appota_user_name={3}&server_id={4}",
		                           Setting.appotaSessionObj.AccessToken, game_user_name, Setting.appotaSessionObj.UserID, Setting.appotaSessionObj.UserName, Setting.currentServer.Server_id);
		WWW www = new WWW(url);
		StartCoroutine(WaitForRequest(www, "CreatGameUser"));
	}
	
	IEnumerator WaitForRequest(WWW www, string function)
	{
		yield return www;
		// check for errors
		if (www.error == null)
		{
			var json = JSON.Parse(www.data);
			switch (function) {
				case "GetListServer":
					Setting.listServer = new ServerInfo[json.Count];
					for(int i=0; i<json.Count; i++){
						Setting.listServer[i] = new ServerInfo(json[i]["server_id"],json[i]["server_name"]);
					}
					menuController.ShowListServer();
					break;
				case "GetUserInfo":
					switch (json["error_code"]){
						case "0":
							Setting.gameUserInfo = new GameUserInfo(json["game_user_id"],json["game_user_name"],json["server_id"],json["level"],json["gold"],json["diamond"],json["is_vip"]);
							Application.LoadLevel("Game Play");
							break;
						case "1":
							menuController.ShowCreatUser();
							break;
						case "2":
							break;
					}
					break;
				case "CreatGameUser":
					switch (json["error_code"]){
						case "0":
							Setting.gameUserInfo = new GameUserInfo(json["game_user_id"],json["game_user_name"],json["server_id"],json["level"],json["gold"],json["diamond"],json["is_vip"]);
							Application.LoadLevel("Game Play");
							break;
						case "1":
							break;
					}
					break;
			}
		} else {
			Debug.Log("WWW Error: "+ www.error);
		}    
	}
}
