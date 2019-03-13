<?php

/**
 * Created by PhpStorm.
 * User: Legacy
 * Date: 11/21/2017
 * Time: 6:34 PM
 */
class ranks extends character
{
    private $columns = 'Name,Owner,Face,ConquerPoints,Money,Level,Class,GuildID';
    public function get_cps()
    {
        $query = $this->game->prepare("SELECT $this->columns FROM entities WHERE UID != 0 ORDER BY ConquerPoints DESC LIMIT 0,$this->rows");
        $query->execute();
        return $query->fetchAll();
    }
    public function get_money()
    {
        $query = $this->game->prepare("SELECT $this->columns FROM entities WHERE UID != 0 ORDER BY Money DESC LIMIT 0,$this->rows");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function get_level()
    {
        $query = $this->game->prepare("SELECT $this->columns FROM entities WHERE UID != 0 ORDER BY Level DESC LIMIT 0,$this->rows");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function get_nobility()
    {
        $query = $this->game->prepare("SELECT EntityName,Donation,EntityUID,Gender FROM nobility WHERE Donation != 0 ORDER BY Donation DESC LIMIT 0,$this->rows");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function get_votes($rows) {
        $query = $this->account->prepare("SELECT Username,points FROM $this->account_table ORDER BY points DESC LIMIT 0,$rows");
        $query->execute();
        return $query->fetchAll();
    }
    public function get_arena($rows)
    {
      $query = $this->game->prepare("SELECT EntityName,ArenaPoints,TodayWin,TodayBattles,EntityID FROM arena ORDER BY TodayWin DESC LIMIT 0,$rows");
      $query->execute();
      return $query->fetchAll();
    }
    public function noble_male($val)
    {
        if ($val < $this->kings+1) return 'king.png';
        if ($val < $this->prince+1) return 'prince.png';
        if ($val < 51) return 'duke.png';
        return 'Error';
    }

    public function noble_female($val)
    {
        if ($val < $this->kings +1) return 'queen.png';
        if ($val < $this->prince +1) return 'prince.png';
        if ($val < 51) return 'duke.png';
        return 'Error';
    }
}
