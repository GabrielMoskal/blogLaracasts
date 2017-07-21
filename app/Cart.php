<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Cart extends Model
{

    protected $fillable = ['user_id', 'item_id', 'num_of_items'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function scopeAddItem($query, $itemName, $numOfItems) {

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
}
