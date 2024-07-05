@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="page-dashboard">
            <div class="container-lg">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $transactionCountToday }}
                                    </div>
                                    <div>
                                        Transaction Count Today
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-info">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        Rp {{ number_format($incomeThisMonth, 0, ',', '.') }}
                                    </div>
                                    <div>
                                        Income This Month
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-warning">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $totalProductVariety }}
                                    </div>
                                    <div>
                                        Total Product Variety
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-danger">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $totalProductsSold }}
                                    </div>
                                    <div>
                                        Total Product Sold
                                    </div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
                <div class="date-container flex-container flex-wrap" style="justify-content: space-between">
                    <h3 class="w-100">
                        Chart Date Filter
                    </h3>
                    <div class="flex-item" style="width: 49%;">
                        <label for="startDate">Start Date:</label>
                        <input class="form-control mb-2" type="date" id="startDate" name="startDate" required="">
                    </div>
                    <div class="flex-item" style="width: 49%;">
                        <label for="endDate">End Date:</label>
                        <input class="form-control mb-3" type="date" id="endDate" name="endDate" required="">
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">
                                    Transaction
                                </h4>
                                <div class="small text-medium-emphasis">
                                    Today
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper" style="margin-top:40px;">
                            <canvas class="chart" id="main-chart" height="100"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-md-6 mb-sm-2 mb-0">
                                <div class="text-medium-emphasis">
                                    Total Transaction Count
                                </div>
                                <div class="fw-semibold" id="totalTransactionCount">
                                    Loading...
                                </div>
                            </div>
                            <div class="col-md-6 mb-sm-2 mb-0">
                                <div class="text-medium-emphasis">
                                    Total Transaction
                                </div>
                                <div class="fw-semibold" id="totalTransactionAmount">
                                    Loading...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Add a new section to display product data -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Products Sold <span id="datePeriodProductCount">Today</span>
                            </div>
                            <div class="card-body" >
                                <ul class="list-group" id="productDataSold">
                                    {{-- Product data will be dynamically loaded here --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Products Sold All
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($productsSold as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $product->product_name }}
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $product->quantity }}
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @section('js')
        <script>
            let myChart = null; // Variable to store the chart instance

            document.addEventListener('DOMContentLoaded', function () {
                // Set default start and end dates to today
                document.getElementById('startDate').valueAsDate = new Date();
                document.getElementById('endDate').valueAsDate = new Date();
                fetchChartData(); // Fetch chart data on initial load
                fetchProductData(); // Fetch chart data on initial load
            });

            function fetchChartData() {
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;

                fetch(`/dashboard/chart-data?startDate=${startDate}&endDate=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        renderChart(data.labels, data.transactionData); // Render the chart
                        updateTotalTransactionInfo(data.totalTransactionCount, data.totalTransactionAmount); // Update total transaction info
                    })
                    .catch(error => console.error('Error fetching chart data:', error));
            }

            function renderChart(labels, transactionData) {
                if (myChart) {
                    myChart.destroy(); // Destroy existing chart if it exists
                }

                // Calculate the maximum value plus 25% and round it to the nearest whole number
                let maxValue = Math.max(...transactionData);
                let adjustedMax = Math.ceil(maxValue * 1.25);

                const ctx = document.getElementById('main-chart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Transaction',
                            data: transactionData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: adjustedMax
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index];
                                    var value = data.datasets[0].data[tooltipItem.index];
                                    return `Date: ${label}, Transactions: ${value}`;
                                }
                            }
                        }
                    }
                });
            }

            function updateTotalTransactionInfo(count, amount) {
                const formattedAmount = new Intl.NumberFormat('de-DE', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount);

                // Replace 'IDR' with 'Rp' and remove any remaining spaces
                document.getElementById('totalTransactionCount').textContent = count;
                document.getElementById('totalTransactionAmount').textContent = `Rp ${formattedAmount.replace('IDR', '').trim()}`;
            }

            function fetchProductData() {
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;

                fetch(`/dashboard/product-data?startDate=${startDate}&endDate=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        renderProductData(data.productsSold); // Render product data
                        updateDatePeriodProductCount(startDate, endDate); // Update product count period
                    })
                    .catch(error => console.error('Error fetching product data:', error));
            }

            function renderProductData(productsSold) {
                const productDataSoldElement = document.getElementById('productDataSold');
                productDataSoldElement.innerHTML = ''; // Clear existing content

                if (productsSold.length === 0) {
                    // If no data, display a message
                    const noDataMessage = document.createElement('p');
                    noDataMessage.textContent = 'No transaction data';
                    productDataSoldElement.appendChild(noDataMessage);
                    return; // Exit the function early
                }

                productsSold.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    listItem.innerHTML = `
                        ${product.product_name}
                        <span class="badge bg-primary rounded-pill">${product.quantity}</span>
                    `;
                    productDataSoldElement.appendChild(listItem);
                });
            }

            document.getElementById('startDate').addEventListener('change', fetchChartData);
            document.getElementById('endDate').addEventListener('change', fetchChartData);
            document.getElementById('startDate').addEventListener('change', fetchProductData);
            document.getElementById('endDate').addEventListener('change', fetchProductData);
        </script>
    @endsection

@endsection