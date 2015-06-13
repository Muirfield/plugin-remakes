<?php
namespace aliuly\youchat;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements CommandExecutor,Listener {
	protected $players;
	protected $cfg;

	private function load(Player $player) {
		$n = trim(strtolower($player->getName()));
		$d = substr($n,0,1);
		if (!is_dir($this->getDataFolder().$d)) mkdir($this->getDataFolder().$d);

		$path =$this->getDataFolder().$d."/".$n.".yml";
		$defaults = [
			"prefix" => null,
			"nick" => null,
			"mute" => false,
			"pause" => false,
		];
		$this->players[$n] = (new Config($path,Config::YAML,$defaults))->getAll();
	}

	private function save(Player $player) {
		$n = trim(strtolower($player->getName()));
		if (!isset($this->players[$n])) return;
		$d = substr($n,0,1);
		$path =$this->getDataFolder().$d."/".$n.".yml";
		if (!is_file($path)) return false;

		$cfg = new Config($path,Config::YAML);
		$cfg->setAll($this->players[$n]);
		$cfg->save();
	}
	private function setNick($player,$nick) {
		if ($nick === null) $nick = $player->getName();
		$player->setDisplayName($nick);
		$player->setNameTag($nick);
	}
	public function onEnable(){
		if (!is_dir($this->getDataFolder())) mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$defaults = [
			"version" => $this->getDescription()->getVersion(),
			"settings" => [
				"# chat-format" => "chat format",
				"chat-format" => "{GREEN}{world}:[{prefix}]{BLUE}<{nick} ({kills})>{WHITE} {message}",
				"# prefix" => "default prefix",
				"prefix" => "Player",
				"chat" => true,
			],
		];
		$this->cfg = (new Config($this->getDataFolder()."config.yml",
										 Config::YAML,$defaults))->getAll();
		$this->players = [];
		foreach ($this->getServer()->getOnlinePlayers() as $player) {
			$this->load($player);
		}
	}

	public function onJoin(PlayerJoinEvent $ev) {
		$player = $ev->getPlayer();
		$this->load($player);
		$n = trim(strtolower($player->getName()));
		$this->setNick($player,$this->players[$n]["nick"]);
	}
	public function onQuit(PlayerQuitEvent $ev) {
		$n = trim(strtolower($ev->getPlayer()->getName()));
		if (isset($this->players[$n])) unset($this->players[$n]);
	}
	public function onChat(PlayerChatEvent $ev) {
		if ($ev->isCancelled()) return;
		$player = $ev->getPlayer();
		if (!$this->cfg["settings"]["chat"]) {
			$ev->setCancelled();
			$player->sendMessage(TextFormat::RED."[YouChat] Chat has been disabled!");
			return;
		}
		$n = trim(strtolower($player->getName()));
		$prefix = $this->cfg["settings"]["prefix"];
		if (isset($this->players[$n])) {
			if ($this->players[$n]["prefix"])
				$prefix = $this->players[$n]["prefix"];
			if ($this->players[$n]["mute"]) {
				$ev->setCancelled();
				$player->sendMessage(TextFormat::RED."[YouChat] You have been muted from chat!");
				return;
			}
			if ($this->players[$n]["pause"]) {
				$ev->setCancelled();
				$player->sendMessage(TextFormat::RED."[YouChat] You have paused chat!");
				return;
			}
		}

		$recvr = [];
		foreach ($ev->getRecipients() as $to) {
			$m = strtolower($to->getName());
			if (isset($this->players[$m])) {
				if ($this->players[$m]["pause"]) continue;
			}
			$recvr[] = $to;
		}
		$ev->setRecipients($recvr);

		$vars = [
			"{YouChat}" => $this->getDescription()->getFullName(),
			"{player}" => $player->getName(),
			"{displayname}" => "{%0}",
			"{nick}" => $player->getDisplayName(),
			"{world}" => $player->getLevel()->getName(),
			"{message}" => "{%1}",
			"{prefix}" => $prefix,
			"{BLACK}" => TextFormat::BLACK,
			"{DARK_BLUE}" => TextFormat::DARK_BLUE,
			"{DARK_GREEN}" => TextFormat::DARK_GREEN,
			"{DARK_AQUA}" => TextFormat::DARK_AQUA,
			"{DARK_RED}" => TextFormat::DARK_RED,
			"{DARK_PURPLE}" => TextFormat::DARK_PURPLE,
			"{GOLD}" => TextFormat::GOLD,
			"{GRAY}" => TextFormat::GRAY,
			"{DARK_GRAY}" => TextFormat::DARK_GRAY,
			"{BLUE}" => TextFormat::BLUE,
			"{GREEN}" => TextFormat::GREEN,
			"{AQUA}" => TextFormat::AQUA,
			"{RED}" => TextFormat::RED,
			"{LIGHT_PURPLE}" => TextFormat::LIGHT_PURPLE,
			"{YELLOW}" => TextFormat::YELLOW,
			"{WHITE}" => TextFormat::WHITE,
			"{OBFUSCATED}" => TextFormat::OBFUSCATED,
			"{BOLD}" => TextFormat::BOLD,
			"{STRIKETHROUGH}" => TextFormat::STRIKETHROUGH,
			"{UNDERLINE}" => TextFormat::UNDERLINE,
			"{ITALIC}" => TextFormat::ITALIC,
			"{RESET}" => TextFormat::RESET,
		];
		if (($kr = $this->getServer()->getPluginManager()->getPlugin("KillRate")) !== null) {
			$vars["{kills}"] = $kr->getScore($player,"player");
			$vars["{points}"] = $kr->getScore($player,"points");

		}
		$ev->setFormat(strtr($this->cfg["settings"]["chat-format"],$vars));
	}
	public function mute($sender,$pn,$mode){
		$player = $this->findPlayer($pn);
		if ($player === null) {
			$sender->sendMessage(TextFormat::RED."[YouChat] $pn not found");
			return;
		}
		$n = trim(strtolower($player->getName()));
		$this->load($player);
		$this->players[$n]["mute"] = $mode;
		$this->save($player);
		if ($player instanceof Player) {
			$player->sendMessage($mode ? TextFormat::RED."[YouChat] You have been muted." : TextFormat::GREEN."[YouChat] You have been un-muted.");
		}
		$sender->sendMessage($mode ? TextFormat::RED."[YouChat] ".$player->getDisplayName()." has been muted." : TextFormat::GREEN."[YouChat] ".$player->getDisplayName()." has been un-muted.");
		return;
	}
	public function chgCfg($key,$val) {
		$this->cfg["settings"][$key] = $val;
		$cfg = new Config($this->getDataFolder()."config.yml",Config::YAML);
		$cfg->setAll($this->cfg);
		$cfg->save();
	}
	private function findPlayer($pn) {
		$target = $this->getServer()->getPlayer($pn);
		echo __METHOD__.",".__LINE__."\n";//##DEBUG
		if ($target !== null) return $target;
		echo __METHOD__.",".__LINE__."\n";//##DEBUG
		$target = $this->getServer()->getOfflinePlayer($pn);
		if ($target == null || !$target->hasPlayedBefore()) return null;
		echo __METHOD__.",".__LINE__."\n";//##DEBUG
		return $target;
	}
	private function chgUsrCfg($target,$setting,$value) {
		$this->load($target); // Make sure defautls are there
		$n = trim(strtolower($target->getName()));
		$this->players[$n][$setting] = $value;
		$this->save($target);
		return true;

	}
	private function checkOther($sender,$setting,$args,$perm,$null=false) {
		if (count($args) == 0
			 || ($target = $this->findPlayer($args[0])) === null) {
			if (!($sender instanceof Player)) {
				$sender->sendMessage(TextFormat::YELLOW.
											"[YouChat] In-game only command");
				return true;
			}
			echo __METHOD__.",".__LINE__."\n";//##DEBUG
			$target = $sender;
		} else {
			if (!$sender->hasPermission($perm)) {
				$sender->sendMessage(TextFormat::YELLOW.
											"[YouChat] That is not allowed");
				return true;
			}
			echo __METHOD__.",".__LINE__."\n";//##DEBUG
			array_shift($args);
		}

		if ($null) {
			if (count($args) != 0) return false;
			$value = null;
		} else {
			if (count($args) == 0) return false;
			$value = implode(" ",$args);
		}
		$this->chgUsrCfg($target,$setting,$value);
		if ($target->isOnline()) {
			if ($value === null) {
				$target->sendMessage(TextFormat::AQUA.
											"[YouChat] Your $setting has been set to the default value");
			} else {
				$target->sendMessage(TextFormat::AQUA.
											"[YouChat] Your $setting has been set to $value");
			}
			if ($setting == "nick") $this->setNick($target,$value);
		} else {
			unset($this->players[$n]);
		}
		if ($target !== $sender) {
			if ($value === null) {
				$sender->sendMessage(TextFormat::AQUA.
											"[YouChat] ".$target->getName().
											"'s $setting has been set to the default value");
			} else {
				$sender->sendMessage(TextFormat::AQUA.
											"[YouChat] ".$target->getName().
											" $setting has been set to $value");
			}
		}
		return true;
	}


	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch($cmd->getName()) {
			case "setprefix":	// change players's prefix
				return $this->checkOther($sender,"prefix",$args,
												 "youchat.cmd.op.prefix");
			case "defprefix":	// set default prefix
				$this->chgCfg("prefix",$prefix = implode(" ",$args));
				$sender->sendMessage(TextFormat::AQUA.
											"[YouChat] Default prefix is now $prefix");
				return true;
			case "delprefix":
				return $this->checkOther($sender,"prefix",$args,
												 "youchat.cmd.op.prefix",true);
			case "setnick":	// set player's nickname
				return $this->checkOther($sender,"nick",$args,
												 "youchat.cmd.op.nick");
			case "delnick":	// remove player's nickname
				return $this->checkOther($sender,"nick",$args,
												 "youchat.cmd.op.nick",true);
			case "mute":		// mute player
				if (count($args) != 1) return false;
				$this->mute($sender,implode(" ",$args),true);
				return true;
			case "unmute":	// unmute player
				if (count($args) != 1) return false;
				$this->mute($sender,implode(" ",$args),false);
				return true;
			case "ycstop":
				if (!($sender instanceof Player)) {
					$sender->sendMessage(TextFormat::YELLOW.
												"[YouChat] In-game only command");
					return true;
				}
				if (count($args) != 0) return false;
				$this->chgUsrCfg($sender,"pause",true);
				$sender->sendMessage(TextFormat::RED."[YouChat] Chat suspended");
				return true;
			case "ycstart":
				if (!($sender instanceof Player)) {
					$sender->sendMessage(TextFormat::YELLOW.
												"[YouChat] In-game only command");
					return true;
				}
				if (count($args) != 0) return false;
				$this->chgUsrCfg($sender,"pause",false);
				$sender->sendMessage(TextFormat::GREEN."[YouChat] Chat resumed");
				return true;
			case "yce":		// enable chat
				$this->chgCfg("chat",true);
				$this->getServer()->broadcastMessage(TextFormat::GREEN."[YouChat] Chat is now enabled");
				return true;
			case "ycd":		// disable chat
				$this->chgCfg("chat",false);
				$this->getServer()->broadcastMessage(TextFormat::RED."[YouChat] Chat is now disabled");
				return true;
			case "clearchat": // Clear chat window
				if (!($sender instanceof Player)) {
					$sender->sendMessage(TextFormat::YELLOW.
												"[YouChat] In-game only command");
					return true;
				}
				if (count($args) != 0) return false;
				for($i=0;$i<32;++$i) $sender->sendMessage(" ");
				return true;
		}
		return false;
	}
}
