 <div class="w-[100%] h-[100%] flex flex-row justify-center hidden" id="modal" >
        <div class=" bg-white absolute top-[30%] w-[35%] h-[30%] flex justify-center align-start shadow-[10px_35px_60px_15px_rgba(0,0,0,0.3)] rounded-xl flex flex-row justify-around">
            <div class="w-[80%] ml-12">
                <form action="{{route('categories.store')}}" method="POST">
                    @csrf
                    <div class="form-group"><br>
                        <label for="name">Name</label> <br>
                        <input type="text" class="form-control shadow-sm border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" id="name" name="name" placeholder="Enter name"> <br>
                    </div>
                    <div class="form-group mt-6 mb-6">
                        <label for="type">Type</label> <br>
                        <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mb-4 category-select">
                            <option value="{{\App\Models\Category::TYPE_INCOME}}">Income</option>
                            <option value="{{\App\Models\Category::TYPE_EXPENSE}}">Expense</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle text-4xl text-emerald-500" aria-hidden="true"></i></button>
                </form>
            </div>
            <button type="button" class="mt-6 mr-6 self-start" id="closeModal"><i class="fa fa-times-circle text-4xl text-red-500" aria-hidden="true"></i></button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('modal');
            var btnModal = document.getElementById('btnModal');
            var closeModal = document.getElementById('closeModal');
            btnModal.addEventListener('click', function (event) {
                modal.classList.toggle('hidden');
            });
            closeModal.addEventListener('click', function (event) {
                modal.classList.add('hidden');
            });
        });
    </script>
