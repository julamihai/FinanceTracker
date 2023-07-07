<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex justify-around">
                    <div class="w-[100%]">
                        <div class="mt-8 text-2xl">
                            Expenses
                        </div>
                        <div class="mt-6 text-gray-500">
                            <i class="fa fa-info-circle text-2xl text-gray-600" aria-hidden="true" id="infoIcon" ></i>
                            <div id="infoText" class="hidden ">
                                <p class="text-xl">Here you can see your expenses.<br> You can edit each field by clicking on it and then saving the changes using the green button on the left of the table</p>
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
                                    <button id="sortBtnAmount">AMOUNT <i class="fa fa-arrow-down hidden stroke-1" aria-hidden="true" id="arrowDown"></i><i class="fa fa-arrow-up stroke-1 hidden" aria-hidden="true" id="arrowUp"></i> </button>
                                </th>
                                <th class="px-6 py-3 font-medium">
                                    Category
                                </th>
                                <th class="px-6 py-3 font-medium">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <!-- HEAD end -->
                            <!-- BODY start -->
                            <tbody class="bg-white text-center">
                            @foreach($expenses as $expense)
                                <form action="{{route('expense.update',['expense'=>$expense])}}" method="POST">
                                @csrf
                                    @method('PUT')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 " >
                                            <div class="text-sm leading-5 text-gray-900">
                                                <input class="border-none border-transparent text-center" type="text" name="name" value="{{$expense->name}}" placeholder="{{$expense->name}}">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                <input class="border-none border-transparent text-center" type="number" name="amount" value="{{$expense->amount}}" placeholder="{{$expense->amount}}">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">
                                                <select name="category_id" id="categories" class="border-none">
                                                    @foreach($categories as $category)
                                                        <option class="text-center rounded-lg shadow-xl border-white" value="{{$category->id}}" {{$expense->category->id == $category->id ? 'selected': ''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap  border-b border-gray-200 text-sm leading-5 font-medium">
                                            <button type="submit">
                                                <i class="fa fa-pencil-square text-3xl text-green-400" aria-hidden="true"></i>
                                            </button>

                                </form>
                                            <form action="{{route('expense.destroy',['expense'=>$expense])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$expense->id}}">
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
        @include('expense.create')


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
        @if(session()->has('error'))
            <script>
                document.addEventListener('DOMContentLoaded',function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{session()->get('error')}}'
                    })
                })
            </script>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded',function() {
                var infoText = document.getElementById('infoText');
                var infoIcon = document.getElementById('infoIcon');
                var btn = document.getElementById('sortBtnAmount');
                var arrD = document.getElementById('arrowDown');
                var arrU = document.getElementById('arrowUp');
                var n=0;

                infoIcon.addEventListener('mouseover',function (){
                    infoText.classList.remove('hidden');
                })
                infoIcon.addEventListener('mouseout',function (){
                    infoText.classList.add('hidden');
                })

                btn.addEventListener('click', function (){
                    if(n==0){
                        n=1;
                    }else{
                        n=0;
                    }
                    function changeArrow(n){
                        if(n!=0){
                            arrD.classList.add('hidden');
                            arrU.classList.remove('hidden');
                        }else{
                            arrD.classList.remove('hidden');
                            arrU.classList.add('hidden');
                        }
                    }
                    function sortTableAmount(n){

                        var table, rows, switching, i, x, y, shouldSwitch;
                        table = document.getElementById("myTable");
                        switching = true;
                        /* Make a loop that will continue until
                        no switching has been done: */
                        while (switching) {
                            // Start by saying: no switching is done:
                            switching = false;
                            rows = table.rows;
                            /* Loop through all table rows (except the
                            first, which contains table headers): */
                            for (i = 1; i < (rows.length - 1); i++) {
                                // Start by saying there should be no switching:
                                shouldSwitch = false;
                                /* Get the two elements you want to compare,
                                one from current row and one from the next: */
                                x = rows[i].getElementsByTagName("INPUT")[1];
                                y = rows[i + 1].getElementsByTagName("INPUT")[1];
                                // Check if the two rows should switch place:
                                if(n%2==0){
                                    if (Number(x.value) < Number(y.value)) {
                                        // If so, mark as a switch and break the loop:
                                        shouldSwitch = true;
                                        break;
                                    }
                                }else{
                                    if (Number(x.value) > Number(y.value)) {
                                        // If so, mark as a switch and break the loop:
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            }
                            if (shouldSwitch) {
                                /* If a switch has been marked, make the switch
                                and mark that a switch has been done: */
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                switching = true;
                            }
                        }
                    }
                    sortTableAmount(n);
                    changeArrow(n);
                })
            })


        </script>
    </div>
</x-app-layout>
