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

    public function addItem($query, $itemName, $numOfItems) {
        var_dump($numOfItems);
        if ($numOfItems == 0) {
            $this->removeItem($query, $itemName);
            return;
        }

        $userId = auth()->user()->id;
        $itemId = Item::select('id')
            ->where('itemName', $itemName)->get();
        $itemId = $itemId[0]->id;

        $query->updateOrCreate(
            ['user_id' => $userId, 'item_id' => $itemId],
            ['num_of_items' => $numOfItems,
                'user_id' => $userId,
                'item_id' => $itemId]
        );
    }

    public function removeItem($query, $itemName) {
        $userId = auth()->user()->id;

        $itemId = Cart::select('id')
            ->where('itemName', $itemName)
            ->where('user_id', $userId)
            ->get();

        var_dump($itemId);
        $cart = $this->find($itemId);

    }
}
