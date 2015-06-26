using UnityEngine;
using System.Collections;
using SimpleJSON;

public class ServerInfo : MonoBehaviour {

	private string server_id;
	private string server_name;
	
	public ServerInfo (string server_id, string server_name)
	{
		this.server_id = server_id;
		this.server_name = server_name;
	}
	public string Server_id {
		get {
			return this.server_id;
		}
		set {
			server_id = value;
		}
	}

	public string Server_name {
		get {
			return this.server_name;
		}
		set {
			server_name = value;
		}
	}
}
