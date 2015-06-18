using UnityEngine;
using System.Collections;

public class PanelServerController : MonoBehaviour {

	public GameObject prefabServer;
	
	// Use this for initialization
	void Start () {
		Init ();
	}
	
	void Init(){
		for (int i=0; i<Setting.listServer.Length; i++) {
			// Instantice server
			GameObject obj = (GameObject)Instantiate(prefabServer, prefabServer.transform.localPosition, prefabServer.transform.localRotation);
			obj.transform.parent = gameObject.transform;
			obj.transform.localPosition += new Vector3(i*2.5f, 0, 0);
			// Set name
			obj.GetComponent<SelectServerController>().serverInfo = Setting.listServer[i];
		}
	}
	
	// Update is called once per frame
	void Update () {
		
	}
}
