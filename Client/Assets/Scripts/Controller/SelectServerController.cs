using UnityEngine;
using System.Collections;

public class SelectServerController : MonoBehaviour {

	[HideInInspector]
	public ServerInfo serverInfo;
	public tk2dTextMesh textName;

	private GetDataServer dataServer;

	void Start () {
		// Set name
		textName.text = serverInfo.Server_name;
		// Set dataServer
		dataServer = FindObjectOfType<GetDataServer>();
	}

	public void OnclickSelectServer(){
		Setting.currentServer = serverInfo;
		gameObject.transform.parent.gameObject.SetActive (false);
		dataServer.GetUserInfo ();
	}
}
