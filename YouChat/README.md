<img src="https://raw.githubusercontent.com/alejandroliu/bad-plugins/master/Media/Chat-icon.png" style="width:64px;height:64px" width="64" height="64"/>

# YouChat

* Summary: Chat Management: Nicknames, prefixes, muting
* Dependency Plugins: N/A
* PocketMine-MP version: 1.5 - API 1.12.0
* DependencyPlugins: -
* OptionalPlugins: [KillRate]
* Categories: Chat
* Plugin Access: Other Plugins, Commands, Data Saving
* WebSite: [github](https://github.com/alejandroliu/plugin-remakes/tree/master/YouChat)

## Overview

Complete set of commands to control your server chat.

### Features

* prefixes
* nicknames
* multiworlds
* scoring (with
  [KillRate](http://forums.pocketmine.net/plugins/killrate.1137/))
* muting
* chat disabling
* configurable

## Documentation

Basic Commands:

* /setprefix [player] &lt;prefix&gt; - sets prefix for player
* /defprefix [prefix] - sets default prefix for new players
* /delprefix [player] &lt;prefix&gt; - set player's prefix to default.
* /setnick [player] &lt;nick&gt; - sets player's nick
* /delnick [player] - returns players's real name
* /mute [player] - mute player from chat
* /unmute [player] - unmute player from chat
* /ycd - disable chat for all players
* /yce - enable chat for all players


### Configuration

These can be configured from `config.yml`:

```YAML
[CODE]
settings:
  chat-format: '{GREEN}{world}:[{prefix}]{BLUE}<{nick} ({kills})>{WHITE} {message}'
[/CODE]
```

### Permission Nodes:

```YAML
  youchat.cmd.prefix:
    default: true
    description: "allow players to change their prefix"
  youchat.cmd.op.prefix:
    default: op
    description: "allow players to change others prefix"
  youchat.cmd.nick:
    default: true
    description: "allow players to change their nickname"
  youchat.cmd.op.nick:
    default: true
    description: "allow players to change others nickname"
  youchat.cmd.op.defprefix:
    default: op
    description: "Define default prefix"
  youchat.cmd.op.mute:
    default: op
    description: Allow to mute/unmute players
  youchat.comd.op.ycx:
    default: op
    description: Allowed to enable/disable chat
```

# Changes

* 1.0.0 : First version

# Copyright

    YouChat
    Copyright (C) 2015 Alejandro Liu
    All Rights Reserved.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
