<x-app-layout>

    <div>
        <form action="{{route('categories.update',['category'=>$category])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$category->name}}">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mb-4 category-select">
                    <option value="{{\App\Models\Category::TYPE_INCOME}}">Income</option>
                    <option value="{{\App\Models\Category::TYPE_EXPENSE}}">Expense</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</x-app-layout>
