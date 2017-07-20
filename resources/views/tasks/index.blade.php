<!DOCTYPE html>
<head >
    <title>KnockoutJS Computed Observables</title>
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-3.1.0.js"></script>
</head>
<body>

<p>Enter first number: <input data-bind="value: a" /></p>
<p>Enter second number: <input data-bind="value: b"/></p>
<p>Average := <span data-bind="text: totalAvg"></span></p>

<script>
    function MyViewModel() {
        this.a = ko.observable(10);
        this.b = ko.observable(40);

        this.totalAvg = ko.computed(function(){
            if(typeof(this.a()) !== "number" || typeof(this.b()) !== "number"){
                this.a(Number(this.a()));   //convert string to Number
                this.b(Number(this.b()));   //convert string to Number
            }
            total = (this.a() + this.b())/2 ;
            return total;
        },this);
    }
    ko.applyBindings(new MyViewModel());

</script>
</body>
</html>