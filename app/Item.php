<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Selects item_id where itemName equals $itemName
     *
     * @param $query - required parameter by convention of scope methods
     * @param $itemName - name of an item to find
     */
    public function scopeSelectIdByName($query, $itemName) {
        $item = Item::select('id')
            ->where('itemName', $itemName)
            ->get();
        return $item[0]->id;
    }

    // public function scopeUpdateOrCreate($query, )
}
