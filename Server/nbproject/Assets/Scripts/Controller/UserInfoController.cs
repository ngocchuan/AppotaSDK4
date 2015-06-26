using UnityEngine;
using System.Collections;

public class UserInfoController : MonoBehaviour {

	public tk2dTextMesh name;
	public tk2dTextMesh level;
	public tk2dTextMesh gold;
	public tk2dTextMesh diamond;

	private GetDataServer dataServer;

	// Use this for initialization
	void Start () {
		// Set dataServer
		dataServer = FindObjectOfType<GetDataServer>();
	}

	void SetUserInfo(){
		name.text = Setting.gameUserInfo.Game_user_name;
		level.text = "Level: " + Setting.gameUserInfo.Level; 
		gold.text = "Gold: " + Setting.gameUserInfo.Gold;
		diamond.text = "Diamond: " + Setting.gameUserInfo.Diamond;
	}
	
	// Update is called once per frame
	void Update () {
		if (Setting.reloadUserInfo) {
			Setting.reloadUserInfo = false;
			dataServer.GetUserInfo ();
		}
		// Set User info
		SetUserInfo ();
	}
}
