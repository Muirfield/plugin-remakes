<?php
namespace StaffList;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;

class Main extends PluginBase implements CommandExecutor {
	protected $staff;
	protected function reload() {
		$default = [
			"owner" => [],
			"admins" => [],
			"mods" => [],
			"trusted" => [],
		];
		return (new Config($this->getDataFolder()."staff.yml",
								 Config::YAML,$default))->getAll();
	}
	public function onEnable(){
		if (!is_dir($this->getDataFolder())) mkdir($this->getDataFolder());
		$this->reload();
	}
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch($cmd->getName()) {
			case "stafflist":
				if (count($args) != 0) return false;
				$staff = $this->reload();
				foreach (["owner" => "Owners",
							 "admins" => "Admins",
							 "mods" => "Moderators",
							 "trusted" => "Trusted"] as $i=>$j) {
					$sender->sendMessage("[StaffList] $j: ".implode(", ",$staff[$i]));
				}
				return true;
			case "staffadd":
				if (count($args) != 2) return false;
				switch(strtolower($args[0])) {
					case "owner":
					case "o":
						$lst = "owner";
						break;
					case "admins":
					case "admin":
					case "a":
						$lst = "admin";
						break;
					case "moderators" :
					case "mod" :
					case "moderator" :
					case "mods" :
					case "m" :
						$lst = "mods";
						break;
					case "trusted" :
					case "t" :
						$lst = "trusted";
						break;
					default:
						return false;
				}
				$target = $args[1];
				$staff = $this->reload();
				$staff[$lst][] = $target;
				$yaml = new Config($this->getDataFolder()."staff.yml",Config::YAML,[]);
				$yaml->setAll($staff);
				$yaml->save();

				$sender->sendMessage("$target added to $lst list");
				return true;
		}
		return false;
	}
}
