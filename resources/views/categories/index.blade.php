<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex justify-around">
                    <div class="w-[100%]">
                        <div class="mt-8 text-2xl">
                            Categories
                        </div>
                        <div class="mt-6 text-gray-500">
                            <i class="fa fa-info-circle text-2xl text-gray-600" aria-hidden="true" id="infoIcon" ></i>
                            <div id="infoText" class="hidden ">
                                <p class="text-xl">Here you can see your categories.<br> You can edit each field by clicking on it and then saving the changes using the green button on the left of the table</p>
                            </div>
                        </div>
                        <br>
                        <table class="w-[100%]" id="myTable">
                            <!-- HEAD start -->
                            <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs leading-4 text-gray-500 uppercase tracking-wider text-center">
                                <th class="px-6 py-3  font-medium">
                                    Name
                                </th>
                                <th class="px-6 py-3 font-medium">
                                    Type
                                </th>
                                <th class="px-6 py-3 font-medium">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <!-- HEAD end -->
                            <!-- BODY start -->
                            <tbody class="bg-white text-center">
                            @foreach($categories as $category)
                                <form action="{{route('categories.update',['category'=>$category])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 " >
                                            <div class="text-sm leading-5 text-gray-900">
                                                <input class="border-none border-transparent text-center" type="text" name="name" value="{{$category->name}}" placeholder="{{$category->name}}">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">
                                                <select name="type" id="type" class="border-none">
                                                    <option value="{{\App\Models\Category::TYPE_INCOME}}" {{$category->type == \App\Models\Category::TYPE_INCOME ? 'selected': ''}}>{{\App\Models\Category::TYPE_INCOME}}</option>
                                                    <option value="{{\App\Models\Category::TYPE_EXPENSE}}" {{$category->type == \App\Models\Category::TYPE_EXPENSE ? 'selected': ''}}>{{\App\Models\Category::TYPE_EXPENSE}}</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap  border-b border-gray-200 text-sm leading-5 font-medium">
                                            <button type="submit">
                                                <i class="fa fa-pencil-square text-3xl text-green-400" aria-hidden="true"></i>
                                            </button>

                                </form>
                                <form action="{{route('categories.destroy',['category'=>$category])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o text-3xl text-red-500" aria-hidden="true"></i></button>
                                </form>
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button id="btnModal">
                            <i class="fa fa-plus-square text-3xl text-blue-500" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('categories.create')


        @if(session()->has('success'))
            <script>
                document.addEventListener('DOMContentLoaded',function (){
                    Swal.fire({
                        icon: 'success',
                        title: `{{session()->get('success')}}`,
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
            </script>
        @endif
    </div>
</x-app-layout>
