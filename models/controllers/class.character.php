<?php
/**
 * Copyright (c) 2017.  All right reserved to ConquerHub
 */

/**
 * Created by PhpStorm.
 * User: Veigar
 * Date: 1/6/2017
 * Time: 5:13 PM
 */
class character extends accounts
{
    // File Used in the Characters Model
    private $file = 'Users';

    public static function MapID($id)
    {
        $regions = array("1002" => "TwinCity", "1011" => "PhoenixCastle", "1020" => "ApeCity", "1015" => "BirdIsland", "1000" => "DesertCity", "1002" => "SkyAltar", "1000" => "MoonSpring", "1011" => "WaterfallCave", "1000" => "AncientCity", "1010" => "ToweringPeak", "1011" => "MapleForest", "MapleForest", "1020" => "LoveCanyon", "LoveCanyon", "1015" => "ReedIsland", "ReedIsland", "1000" => "Desert", "Desert", "1012" => "Dreamland", "Dreamland", "1001" => "AncientMaze", "AncientMaze", "1013" => "WonderLand", "Wonderland", "1014" => "DragonPool", "DragonPool", "1016" => "KylinCave", "KylinCave", "1036" => "Market", "Market", "1002" => "TwinCity", "1036" => "Market", "1011" => "PhoenixCastle", "1020" => "ApeCity", "1000" => "DesertCity", "1015" => "BirdIsland", "1011" => "PhoenixCastle", "1011" => "PhoenixCastle", "1011" => "PhoenixCastle", "1011" => "PhoenixCastle", "1011" => "PhoenixCastle", "1020" => "ApeCity", "1020" => "ApeCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1000" => "DesertCity", "1015" => "BirdIsland", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1036" => "Market", "1002" => "TwinCity", "1002" => "TwinCity", "1002" => "TwinCity", "1950" => "RallyField", "2061" => "RallyField", "2062" => "RallyField", "2063" => "RallyField", "2064" => "RallyField", "2065" => "RallyField", "2066" => "RallyField", "2067" => "RallyField", "2057" => "CTF-Arena", "2057" => "CTF-Arena", "2057" => "CTF-Arena", "2057" => "CTF-Arena", "1002" => "TwinCity", "font-slc", "10612" => "WindPlain", "10613" => "WindPlain", "10613" => "PeachAltar", "10614" => "PeachAltar", "font-slc", "10614" => "PeachAltar", "10028" => "Racecourse", "10028" => "Racecourse", "10028" => "Racecourse", "10028" => "Racecourse", "10028" => "Racecourse", "10028" => "Racecourse", "10137" => "DragonIsland", "10137" => "DragonIsland", "10137" => "DragonIsland", "10137" => "DragonIsland", "10137" => "DragonIsland", "10137" => "DragonIsland", "10137" => "DragonIsland", "9929" => "CSRacecourse", "9929" => "CSRacecourse", "9929" => "CSRacecourse", "9929" => "CSRacecourse", "9929" => "CSRacecourse", "9929" => "CSRacecourse", "1077" => "NewDesert", "10224" => "DragonTown", "10224" => "DragonTown", "10224" => "DragonTown", "10224" => "DragonTown", "10250" => "Deityland", "10250" => "Deityland", "10250" => "Deityland", "10250" => "Deityland", "10250" => "Deityland", "10250" => "Deityland", "10250" => "Deityland",
            "1926" => "FrozenGrotto1", "1927" => "FrozenGrotto2", "1999" => "FrozenGrotto3", "2054" => "FrozenGrotto4", "2055" => "FrozenGrotto5", "2056" => "FrozenGrotto6"
        );
        return !empty($regions[$id]) ? $regions[$id] : $id;
    }

    public function Classes($class_id)
    {
        $class = 'Unknown';
        if ($class_id > 9 && $class_id < 16) $class = 'Trojan Master';
        if ($class_id > 19 && $class_id < 26) $class = 'Warrior Master';
        if ($class_id > 39 && $class_id < 46) $class = 'Archer Master';
        if ($class_id > 99 && $class_id < 102) $class = 'Taoist Master';
        if ($class_id > 131 && $class_id < 136) $class = 'Water Saint';
        if ($class_id > 141 && $class_id < 146) $class = 'Fire Saint';
        if ($class_id > 50 && $class_id < 56) $class = 'Ninja Master';
        if ($class_id > 59 && $class_id < 66) $class = 'Monk Saint';
        if ($class_id > 69 && $class_id < 76) $class = 'Pirate Lord';
        if ($class_id > 159 && $class_id < 166) $class = 'Wind Lord';
        if ($class_id > 79 && $class_id < 86) $class = 'LeeLong  Master';
        if ($class_id > 86 && $class_id < 8) $class = 'No Class Selected';
        if ($class_id == 0 || $class_id == null || empty($class_id)) $class = 'No Class Selected';
        return $class;
    }

    public function get_char_guild_name($guild_id)
    {
        if (file_exists($this->files_url . 'Guilds/' . $guild_id . '.txt')) {
            $arr = explode('
', file_get_contents($this->files_url . 'Guilds/' . $guild_id . '.txt'));
            $arr = explode('/', $arr[1]);
            return $arr[1];
        }
    }


    /*
     * Count All Characters Data
     */
    public function count_chars()
    {
        $folderPath = $this->files_url . $this->file;
        $file = glob($folderPath . '/' . '*.ini');
        $countFile = 0;
        if ($file != false) {
            $countFile = count($file);
        }
        return $countFile;
    }

    /*
    * Get Character By EntityID
    */
    public function get_chars_by_UID($uid)
    {
        if (file_exists($this->files_url . $this->file . '/' . $uid . '.ini')) {
            return parse_ini_file($this->files_url . $this->file . '/' . $uid . '.ini');
        }
    }

    /*
    * Get ONLINE Characters
    */
    public function get_online()
    {
        return 0;
    }


}
