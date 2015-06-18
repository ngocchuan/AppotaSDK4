using UnityEngine;
using System.Collections;

public class GameController : MonoBehaviour {

	// Use this for initialization
	void Start () {
		Setting.isPlaying = true;
	}
	
	// Update is called once per frame
	void Update () {
	
	}

	public void OnclickPayment(){
		AppotaSDKHandler.Instance.ShowPaymentView ();
	}

	public void OnclickBackMenu(){
		Application.LoadLevel ("Game Menu");
	}
}
