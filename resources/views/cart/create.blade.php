@extends('layouts.master')

@section('content')

    <div class="col-sm-8 blog-main">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody data-bind="foreach: items">
                    <tr>
                        <td>
                            <select data-bind="options: $root.availableItems, value: item,
                                               optionsText: 'itemName'"></select>
                        </td>
                        <td><input data-bind="value: quantity" type="number" min="0"/></td>
                        <td data-bind="text: formattedCost"></td>
                        <td><button class="btn btn-primary" data-bind="click: $root.removeItem">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button class="btn btn-primary" data-bind="click: addItem">Add new row</button>
            </div>


        <div class="form-group">
            <h3 data-bind="visible: totalCost() > 0">
                Total surcharge: $<span data-bind="text: totalCost().toFixed(2)"></span>
            </h3>
        </div>

        <form method="POST" action="/buy">

            {{ csrf_field() }}

            <input type="hidden" data-bind="value: itemsToSend" name="itemsToSend"/>

            <!--
            <div data-bind="foreach: items">
                <input type="hidden" data-bind="value: item().itemName" name="itemName"/>
                <input type="hidden" data-bind="value: item().price" name="price"/>
                <input type="hidden" data-bind="value: quantity" name="quantity"/>
            </div>
            -->

            <input type="submit" name="accept" class="btn btn-primary" value="Buy">
        </form>

    </div>

    <script>

        function ItemToSend(cart) {
            var self = this;
            self.itemName = cart.item().itemName;
            self.quantity = String(cart.quantity());
            self.price = cart.item().price;
        }

        function Cart(item, quantity) {
            var self = this;
            self.item = ko.observable(item);
            self.quantity = ko.observable(Number(quantity));
            self.cost = ko.computed(function() {
                return self.item().price * self.quantity();
            }, self);

            self.formattedCost = ko.computed(function() {
                var cost = self.cost();
                return cost ? '$' + cost.toFixed(2) : "None";
            });
        }

        function CartViewModel() {
            var self = this;

            self.firstName = "First Name";
            self.lastName = "Last Name";

            self.availableItems = [
                { itemName: "Item 1", price: 10 },
                { itemName: "Item 2", price: 34.95 },
                { itemName: "Item 3", price: 290 }
            ];

            self.items = ko.observableArray([
                new Cart(self.availableItems[0], 1),
                new Cart(self.availableItems[0], 1)
            ]);

            self.itemsToSend = ko.computed(function() {
                var results = [];
                for (var i = 0; i < self.items().length; i++) {
                    var itemToSend = new ItemToSend(self.items()[i]);
                    results.push(itemToSend);
                }
                return JSON.stringify(results);
            });

            self.addItem = function() {
               self.items.push(new Cart(self.availableItems[0], 1));
            };

            self.removeItem = function(item) {
               self.items.remove(item);
            };

            self.totalCost = ko.computed(function() {
                var total = 0;
                for (var i = 0; i < self.items().length; i++) {
                    total += self.items()[i].cost();
                }
                return total;
            });
        }

        ko.applyBindings(new CartViewModel("test item", 10, 5));
    </script>

@endsection