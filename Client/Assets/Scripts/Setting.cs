using UnityEngine;
using System.Collections;

public class Setting : MonoBehaviour {

	public static bool reloadUserInfo = false;
	public static bool isLogin = false;
	public static bool isPlaying = false;

	public static ServerInfo currentServer;
	public static GameUserInfo gameUserInfo;
	public static AppotaSession appotaSessionObj;
	public static ServerInfo[] listServer;

	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
	
	}
}
