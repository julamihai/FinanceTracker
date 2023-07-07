<x-app-layout>
    <div class="flex flex-row flex-wrap justify-around">
        <div class="w-2/5 h-2/5">
            <canvas id="Chart1"></canvas>
        </div>
        <div class="w-2/5 h-2/5">
            <canvas id="Chart2"></canvas>
        </div>
        <div class="w-2/6 h-2/6">
            <canvas id="Chart3"></canvas>
        </div>
        <div class="w-2/6 h-2/6">
            <canvas id="Chart4"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const chart1 = document.getElementById('Chart1');
        const chart2 = document.getElementById('Chart2');
        const chart3 = document.getElementById('Chart3');
        const chart4 = document.getElementById('Chart4');
        new Chart(chart1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Income for year {{ \Carbon\Carbon::now()->year }} ',
                    data: [@foreach($incomesByMonth as $income) {{$income}}, @endforeach],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(chart2, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Expenses for year {{ \Carbon\Carbon::now()->year }} ',
                    data: [@foreach($expensesByMonth as $expense) {{$expense}}, @endforeach],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(chart3, {
            type: 'pie',
            data: {
                labels: [@foreach($incomeCategories as $category) '{{$category->name}}', @endforeach],
                datasets: [{
                    label: 'Income by category for year {{ \Carbon\Carbon::now()->year }} ',
                    data: [@foreach($incomeByCategory as $income) {{$income}}, @endforeach],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(chart4, {
            type: 'pie',
            data: {
                labels: [@foreach($expenseCategories as $category) '{{$category->name}}', @endforeach],
                datasets: [{
                    label: 'Expenses by category for year {{ \Carbon\Carbon::now()->year }} ',
                    data: [@foreach($expenseByCategory as $expense) {{$expense}}, @endforeach],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>


</x-app-layout>
