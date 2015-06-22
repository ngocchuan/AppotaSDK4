using UnityEngine;
using System.Collections;

public class MenuController : MonoBehaviour {

	public GameObject panelServer;
	public GameObject panelCreatUser;

	private GetDataServer dataServer;

	// Use this for initialization
	void Start () {
		if (!Setting.isPlaying) {
			// Init Appota
			InitAppota ();
			// Init
			Init ();
		} else {
			panelServer.SetActive (true);
		}
		// Set dataServer
		dataServer = FindObjectOfType<GetDataServer>();
	}

	void Init(){
		panelServer.SetActive (false);
		panelCreatUser.SetActive (false);
	}

	void InitAppota(){
		#if UNITY_IPHONE
		AppotaSDKHandler.Instance.Init();
		AppotaSDKHandler.Instance.SetAutoShowLoginDialog(false);
		#endif
		
		#if UNITY_ANDROID
		AppotaSDKHandler.Instance.Init();
		AppotaSDKHandler.Instance.SetAutoShowLoginDialog(false);
		#endif
	}
	
	void Update () {
		if (Input.GetKeyDown(KeyCode.Escape)) 
			Application.Quit(); 

		if (Setting.isLogin) {
			Setting.isLogin = false;
			dataServer.GetListServer ();
		}
	}
    void OnGUI()
    {

        GUIStyle customButton = new GUIStyle("button");
        customButton.fontSize = 30;

        if (GUI.Button(new Rect(Screen.width / 3, Screen.height - 100, Screen.width / 3, Screen.height / 10), "Login", customButton))
        {
            AppotaSDKHandler.Instance.ShowLoginView();
        }
    }

	void OnApplicationQuit(){
		#if UNITY_ANDROID
		AppotaSDKHandler.Instance.FinishSDK();
		#endif
	}

	void AppotaSwitchAccount(){
		AppotaSDKHandler.Instance.SwitchAccount ();
	}

	public void ShowListServer(){
		panelServer.SetActive (true);
	}

	public void ShowCreatUser(){
		panelCreatUser.SetActive (true);
	}

	public void OnclickBackLogin(){
		AppotaSwitchAccount ();
	}

	public void OnclickBackSelectServer(){
		panelCreatUser.SetActive (false);
		panelServer.SetActive (true);
	}
}
