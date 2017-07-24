<?php

namespace App\Repositories;


class Carts
{
    public function addItems($items) {
        foreach ($items as $item) {
            $itemName = $item->itemName;
            $numOfItems = $item->quantity;
            $this->addItem($itemName, $numOfItems);
        }
    }

    public function addItem($itemName, $num_of_items) {
        if ($num_of_items == 0) {
            Item::removeItem($itemName);
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