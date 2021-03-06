<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = ['user_id', 'item_id', 'num_of_items'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function scopeAddItems($query, $decodedItems) {
        foreach ($decodedItems as $item) {
            $itemName = $item->itemName;
            $numOfItems = $item->quantity;
            $this->addItem($query, $itemName, $numOfItems);
        }
    }

    public function addItem($query, $itemName, $num_of_items) {
        if ($num_of_items == 0) {
            $this->removeItem($query, $itemName);
            return;
        }

        $user_id = auth()->user()->id;
        $item_id = Item::selectIdByName($itemName);

        $valuesToCheck = compact('user_id', 'item_id');
        $valuesToAdd = compact('num_of_items', 'user_id', 'item_id');

        Cart::updateOrCreate(
            $valuesToCheck,
            $valuesToAdd
        );
    }

    public function removeItem($query, $itemName) {
        $itemId = Item::selectIdByName($itemName);
        $userId = auth()->user()->id;

        $query->where('item_id', $itemId)
            ->where('user_id', $userId)
            ->delete();
    }
}
