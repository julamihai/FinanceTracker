<x-app-layout>

    <div>
        <form action="{{route('expense.update',['expense'=>$expense])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$income->name}}">
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="{{$income->amount}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</x-app-layout>
