using UnityEngine;
using System.Collections;

public class PanelCreatUser : MonoBehaviour {

	public string stringToEdit = "name";

	private float indexCenterX;
	private float indexCenterY;

	private GetDataServer dataServer;

	// Use this for initialization
	void Start () {
		indexCenterX = Screen.width / 2;
		indexCenterY = Screen.height / 2;
		// Set dataServer
		dataServer = FindObjectOfType<GetDataServer>();
	}
	
	void OnGUI() {
		stringToEdit = GUI.TextField(new Rect(indexCenterX - 150, indexCenterY - 100, 300,50), stringToEdit, 50);
	}

	public void OnclickJoinGame(){
		gameObject.SetActive (false);
		dataServer.CreatGameUser (stringToEdit);
	}
}
