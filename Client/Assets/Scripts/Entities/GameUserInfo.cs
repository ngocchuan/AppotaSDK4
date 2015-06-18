using UnityEngine;
using System.Collections;

public class GameUserInfo : MonoBehaviour {
	private string game_user_id;
	private string game_user_name;
	private string server_id;
	private string level;
	private string gold;
	private string diamond;
	private string isvip;

	public GameUserInfo (string game_user_id, string game_user_name, string server_id, string level, string gold, string diamond, string isvip)
	{
		this.game_user_id = game_user_id;
		this.game_user_name = game_user_name;
		this.server_id = server_id;
		this.level = level;
		this.gold = gold;
		this.diamond = diamond;
		this.isvip = isvip;
	}
	
	public string Game_user_id {
		get {
			return this.game_user_id;
		}
		set {
			game_user_id = value;
		}
	}

	public string Game_user_name {
		get {
			return this.game_user_name;
		}
		set {
			game_user_name = value;
		}
	}

	public string Level {
		get {
			return this.level;
		}
		set {
			level = value;
		}
	}

	public string Gold {
		get {
			return this.gold;
		}
		set {
			gold = value;
		}
	}

	public string Diamond {
		get {
			return this.diamond;
		}
		set {
			diamond = value;
		}
	}

	public string Isvip {
		get {
			return this.isvip;
		}
		set {
			isvip = value;
		}
	}
}
