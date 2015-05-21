<?php

/*

 __PocketMine Plugin__

 name=RecipePro

 description=Gives Crafting recipes

 version=1.1

 author=Glitchmaster_PE

 class=Recipe

 apiversion=10

 */

class Recipe implements Plugin
{

    private $api;

    public function __construct(ServerAPI $api, $server = false)
    {

        $this -> api = $api;

    }

    public function init()
    {

        $this -> api -> console -> register("recipe", "Tells what you need to craft something", array(
            $this,
            "Craft"
        ));

        $this -> api -> ban -> cmdWhitelist("recipe");

        $this -> items = array(

            array(
                "name" => "air",
                "id" => "0",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "stone",
                "id" => "1",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "grass_block",
                "id" => "2",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "dirt",
                "id" => "3",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "cobblestone",
                "id" => "4",
                "description" => "Mine stone"
            ),

            array(
                "name" => "wooden_planks",
                "id" => "5",
                "description" => "1 wood"
            ),

            array(
                "name" => "sapling",
                "id" => "6",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "bedrock",
                "id" => "7",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "water",
                "id" => "8",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "stationary_water",
                "id" => "9",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "lava",
                "id" => "10",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "stationary_lava",
                "id" => "11",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "sand",
                "id" => "12",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "gravel",
                "id" => "13",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "gold_ore",
                "id" => "14",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_ore",
                "id" => "15",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "coal_ore",
                "id" => "16",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "wood",
                "id" => "17",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "leaves",
                "id" => "18",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "glass",
                "id" => "20",
                "description" => "Smelt sand"
            ),

            array(
                "name" => "lapis_lazuli_ore",
                "id" => "21",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "lapis_lazuli_block",
                "id" => "22",
                "description" => "9 lapis lazuli"
            ),

            array(
                "name" => "sandstone",
                "id" => "24",
                "description" => "4 sand"
            ),

            array(
                "name" => "bed",
                "id" => "26",
                "description" => "3 wool, 3 wooden planks"
            ),

            array(
                "name" => "cobweb",
                "id" => "30",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "tall_grass",
                "id" => "31",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "dead_bush",
                "id" => "32",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "wool",
                "id" => "35",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "yellow_flower",
                "id" => "37",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "cyan_flower",
                "id" => "38",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "brown_mushroom",
                "id" => "39",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "red_mushroom",
                "id" => "40",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "gold_block",
                "id" => "41",
                "description" => "9 gold ingots"
            ),

            array(
                "name" => "iron_block",
                "id" => "42",
                "description" => "9 iron ingots"
            ),

            array(
                "name" => "double_stone_slab",
                "id" => "43",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "stone_slab",
                "id" => "44",
                "description" => "3 stone"
            ),

            array(
                "name" => "brick_block",
                "id" => "45",
                "description" => "4 bricks"
            ),

            array(
                "name" => "tnt",
                "id" => "46",
                "description" => "4 sand, 5 gunpowder"
            ),

            array(
                "name" => "bookshelf",
                "id" => "47",
                "description" => "6 wooden planks, 3 books"
            ),

            array(
                "name" => "moss_stone",
                "id" => "48",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "obsidian",
                "id" => "49",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "torch",
                "id" => "50",
                "description" => "1 coal, 1 stick"
            ),

            array(
                "name" => "fire",
                "id" => "51",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "wooden_stairs",
                "id" => "53",
                "description" => "6 wooden planks"
            ),

            array(
                "name" => "chest",
                "id" => "54",
                "description" => "8 wooden planks"
            ),

            array(
                "name" => "diamond_ore",
                "id" => "56",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "diamond_block",
                "id" => "57",
                "description" => "9 diamonds"
            ),

            array(
                "name" => "crafting_table",
                "id" => "58",
                "description" => "4 wooden planks"
            ),

            array(
                "name" => "seeds",
                "id" => "59",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "farmland",
                "id" => "60",
                "description" => "Use a hoe on dirt"
            ),

            array(
                "name" => "furnace",
                "id" => "61",
                "description" => "8 cobblestone"
            ),

            array(
                "name" => "burning_furnace",
                "id" => "62",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "sign_post",
                "id" => "63",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "wooden_door",
                "id" => "64",
                "description" => "6 wooden planks"
            ),

            array(
                "name" => "ladder",
                "id" => "65",
                "description" => "7 sticks"
            ),

            array(
                "name" => "cobblestone_stairs",
                "id" => "67",
                "description" => "6 cobblestone"
            ),

            array(
                "name" => "wall_sign",
                "id" => "68",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_door",
                "id" => "71",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "redstone_ore",
                "id" => "73",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "glowing_redstone_ore",
                "id" => "74",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "ice",
                "id" => "79",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "snow",
                "id" => "80",
                "description" => "4 snowballs"
            ),

            array(
                "name" => "cactus",
                "id" => "81",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "clay",
                "id" => "82",
                "description" => "Smelt clay"
            ),

            array(
                "name" => "sugar_cane",
                "id" => "83",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "fence",
                "id" => "85",
                "description" => "6 sticks"
            ),

            array(
                "name" => "netherrack",
                "id" => "87",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "glowstone",
                "id" => "89",
                "description" => "4 glowstone dust"
            ),

            array(
                "name" => "cake_block",
                "id" => "92",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "invisible_bedrock",
                "id" => "95",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "stone_brick",
                "id" => "98",
                "description" => "4 stone"
            ),

            array(
                "name" => "glass_pane",
                "id" => "102",
                "description" => "6 glass"
            ),

            array(
                "name" => "melon",
                "id" => "103",
                "description" => "9 melon slices"
            ),

            array(
                "name" => "melon_stem",
                "id" => "105",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "fence_gate",
                "id" => "107",
                "description" => "2 wooden planks, 4 sticks"
            ),

            array(
                "name" => "stone_brick_stairs",
                "id" => "109",
                "description" => "6 stone bricks"
            ),

            array(
                "name" => "brick_stairs",
                "id" => "108",
                "description" => "6 brick blocks"
            ),

            array(
                "name" => "nether_brick",
                "id" => "112",
                "description" => "4 nether bricks"
            ),

            array(
                "name" => "nether_brick_stairs",
                "id" => "114",
                "description" => "6 nether brick blocks"
            ),

            array(
                "name" => "sandstone_stairs",
                "id" => "128",
                "description" => "6 sandstone"
            ),

            array(
                "name" => "block_of_quartz",
                "id" => "155",
                "description" => "4 nether quartz"
            ),

            array(
                "name" => "quartz_stairs",
                "id" => "156",
                "description" => "6 quartz blocks"
            ),

            array(
                "name" => "stone_cutter",
                "id" => "245",
                "description" => "4 cobblestone"
            ),

            array(
                "name" => "glowing_obsidian",
                "id" => "246",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "nether_reactor_core",
                "id" => "247",
                "description" => "3 diamonds, 6 iron ingots"
            ),

            array(
                "name" => "update_game_block",
                "id" => "248",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "update_game_block_two",
                "id" => "249",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "grass_block_glitched",
                "id" => "253",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "leaves",
                "id" => "254",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => ".name",
                "id" => "255",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_shovel",
                "id" => "256",
                "description" => "1 iron ingot, 2 sticks"
            ),

            array(
                "name" => "iron_pickaxe",
                "id" => "257",
                "description" => "3 iron ingots, 2 sticks"
            ),

            array(
                "name" => "iron_axe",
                "id" => "258",
                "description" => "3 iron ingots, 2 sticks"
            ),

            array(
                "name" => "flint_and_steel",
                "id" => "259",
                "description" => "1 flint, 1 iron ingot"
            ),

            array(
                "name" => "apple",
                "id" => "260",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "bow",
                "id" => "261",
                "description" => "3 strings, 3 sticks"
            ),

            array(
                "name" => "arrow",
                "id" => "262",
                "description" => "1 stick, 1 feather, 1 flint"
            ),

            array(
                "name" => "coal",
                "id" => "263",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "diamond",
                "id" => "264",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_ingot",
                "id" => "265",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "gold_ingot",
                "id" => "266",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_sword",
                "id" => "267",
                "description" => "2 iron ingots, 1 stick"
            ),

            array(
                "name" => "wooden_sword",
                "id" => "268",
                "description" => "2 wooden planks, 1 stick"
            ),

            array(
                "name" => "wooden_shovel",
                "id" => "269",
                "description" => "1 wooden plank, 2 sticks"
            ),

            array(
                "name" => "wooden_pickaxe",
                "id" => "270",
                "description" => "3 wooden planks, 2 sticks"
            ),

            array(
                "name" => "wooden_axe",
                "id" => "271",
                "description" => "3 wooden planks, 2 sticks"
            ),

            array(
                "name" => "stone_sword",
                "id" => "272",
                "description" => "2 cobblestone, 1 stick"
            ),

            array(
                "name" => "stone_shovel",
                "id" => "273",
                "description" => "1 cobblestone, 2 sticks"
            ),

            array(
                "name" => "stone_pickaxe",
                "id" => "274",
                "description" => "3 cobblestone, 2 sticks"
            ),

            array(
                "name" => "stone_axe",
                "id" => "275",
                "description" => "3 cobblestone, 2 sticks"
            ),

            array(
                "name" => "diamond_sword",
                "id" => "276",
                "description" => "2 diamonds, 1 stick"
            ),

            array(
                "name" => "diamond_shovel",
                "id" => "277",
                "description" => "1 diamond, 2 sticks"
            ),

            array(
                "name" => "diamond_pickaxe",
                "id" => "278",
                "description" => "3 diamonds, 2 sticks"
            ),

            array(
                "name" => "diamond_axe",
                "id" => "279",
                "description" => "3 diamonds, 2 sticks"
            ),

            array(
                "name" => "stick",
                "id" => "280",
                "description" => "2 wooden planks"
            ),

            array(
                "name" => "bowl",
                "id" => "281",
                "description" => "3 wooden planks"
            ),

            array(
                "name" => "gold_sword",
                "id" => "283",
                "description" => "2 gold ingots, 1 stick"
            ),

            array(
                "name" => "gold_shovel",
                "id" => "284",
                "description" => "1 gold ingot, 2 sticks"
            ),

            array(
                "name" => "gold_pickaxe",
                "id" => "285",
                "description" => "3 gold ingots, 2 sticks"
            ),

            array(
                "name" => "gold_axe",
                "id" => "286",
                "description" => "3 gold ingots, 2 sticks"
            ),

            array(
                "name" => "string",
                "id" => "287",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "feather",
                "id" => "288",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "gunpowder",
                "id" => "289",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "leather_cap",
                "id" => "298",
                "description" => "5 leather"
            ),

            array(
                "name" => "leather_tunic",
                "id" => "299",
                "description" => "8 leather"
            ),

            array(
                "name" => "leather_pants",
                "id" => "300",
                "description" => "7 leather"
            ),

            array(
                "name" => "leather_boots",
                "id" => "301",
                "description" => "4 leather"
            ),

            array(
                "name" => "chain_helmet",
                "id" => "302",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "chain_chestplate",
                "id" => "303",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "chain_leggings",
                "id" => "304",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "chain_boots",
                "id" => "305",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_helmet",
                "id" => "306",
                "description" => "5 iron ingots"
            ),

            array(
                "name" => "iron_chestplate",
                "id" => "307",
                "description" => "8 iron ingots"
            ),

            array(
                "name" => "iron_leggings",
                "id" => "308",
                "description" => "7 iron ingots"
            ),

            array(
                "name" => "iron_boots",
                "id" => "309",
                "description" => "4 iron ingots"
            ),

            array(
                "name" => "diamond_helmet",
                "id" => "310",
                "description" => "5 diamonds"
            ),

            array(
                "name" => "diamond_chestplate",
                "id" => "311",
                "description" => "8 diamonds"
            ),

            array(
                "name" => "diamond_leggings",
                "id" => "312",
                "description" => "7 diamonds"
            ),

            array(
                "name" => "diamond_boots",
                "id" => "313",
                "description" => "4 diamonds"
            ),

            array(
                "name" => "golden_helmet",
                "id" => "314",
                "description" => "5 gold ingots"
            ),

            array(
                "name" => "golden_chestplate",
                "id" => "315",
                "description" => "8 gold ingots"
            ),

            array(
                "name" => "golden_leggings",
                "id" => "316",
                "description" => "7 gold ingots"
            ),

            array(
                "name" => "golden_boots",
                "id" => "317",
                "description" => "4 gold ingots"
            ),

            array(
                "name" => "flint",
                "id" => "292",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "wheat",
                "id" => "296",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "painting",
                "id" => "321",
                "description" => "1 wool, 8 sticks"
            ),

            array(
                "name" => "sign",
                "id" => "323",
                "description" => "6 wooden planks, 1 stick"
            ),

            array(
                "name" => "wooden_door",
                "id" => "324",
                "description" => "6 wooden planks"
            ),

            array(
                "name" => "bucket",
                "id" => "325",
                "description" => "3 iron ingots"
            ),

            array(
                "name" => "saddle",
                "id" => "329",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "iron_door",
                "id" => "330",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "snowball",
                "id" => "332",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "leather",
                "id" => "334",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "clay_brick",
                "id" => "336",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "clay",
                "id" => "337",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "sugar_cane",
                "id" => "338",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "paper",
                "id" => "339",
                "description" => "3 sugar cane"
            ),

            array(
                "name" => "book",
                "id" => "340",
                "description" => "3 paper"
            ),

            array(
                "name" => "slimeball",
                "id" => "341",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "egg",
                "id" => "344",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "compass",
                "id" => "345",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "clock",
                "id" => "347",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "glowstone_dust",
                "id" => "348",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "dye",
                "id" => "351",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "bone",
                "id" => "352",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "sugar",
                "id" => "353",
                "description" => "1 sugar cane"
            ),

            array(
                "name" => "shears",
                "id" => "359",
                "description" => "2 iron ingots"
            ),

            array(
                "name" => "spawn_egg",
                "id" => "383",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "nether_brick",
                "id" => "405",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "nether_quartz",
                "id" => "406",
                "description" => "Cannot be crafted"
            ),

            array(
                "name" => "camera",
                "id" => "456",
                "description" => "Cannot be crafted"
            )
        );

    }

    public function Craft($cmd, $args)
    {

        if (!isset($args[0]))
        {

            return '[CraftPro] Usage: /recipe <id|name>';

        }

        $name = $args[0];

        foreach ($this->items as $val)
        {

            if ($val['name'] == $name || $val['id'] == $name)
            {

                $output = '[CraftPro] ' . $val['name'] . ': <Item ID>: ' . $val['id'] . ' <Crafting>: ' . $val['description'];

                return $output;

            }

        }

        $output = '[CraftPro] Unable to find: ' . $name . ". Make sure to put _'s instead of spaces";

        return $output;

    }

    public function __destruct()
    {
    }

}
?>

