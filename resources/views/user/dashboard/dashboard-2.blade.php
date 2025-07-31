@extends('user.layouts.admin')


@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    /* Global Styles */

  .card-body::after,
  .card-footer::after,
  .card-header::after {
    display: none;
    clear: both;
    content: "";
  }

  .float-end {
    float: end !important;
  }

  /* Card Styles */

  .card {
    border-radius: 20px;
    transition: all 0.5s ease;
  }

  .card:hover {
    margin-top: -10px;
  }

  .card.text-bg-pink {
    background-color: #F13C6E;
    color: white;
  }

  .card.text-bg-purple {
    background-color: #716CB0;
    color: white;
  }

  .card.text-bg-info {
    background-color: #33B0E0;
    color: white;
  }

  .card.text-bg-primary {
    background-color: #3BC0C3;
    color: white;
  }
  .card-text h6{
    font-weight:500;
  }
  .card-text h2{
    font-weight:600;
  }

  /* Table Styles */

  .custom-table-container {
    background-color: #fff;
    border-radius: 20px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    height: 100%;
    transition: all 0.5s ease;

  }

  .custom-table-container:hover,
  .chart-card:hover {
    background-color: #edf2f4;
  }

  table {
    border-collapse: separate;
    border-spacing: 0 0.75rem;
  }

  th {
    font-weight: 600;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    padding: 12px 8px 16px 8px !important;
    vertical-align: middle !important;
    font-size: 16px;
  }

  td {
    font-weight: 600;
    border: none !important;
    border-bottom: 1px solid #ccc !important;
    padding: 12px 8px 16px 8px !important;
    vertical-align: middle !important;
    font-size: 14px;
  }

  th {
    background-color: transparent;
  }

  tr {
    background: transparent !important;
  }

  /* Badge Styles */

  .badge {
    padding: 6px 12px;
    border-radius: 6px;
  }

  .badge.bg-white.bg-opacity-10 {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.3) !important;
    padding: 4px 8px;
  }

  .badge-released {
    background-color: #d6eff9;
    color: rgb(51 176 224);
  }

  .badge-pending {
    background-color: #f8d7da;
    color: #dc3545;
  }

  .badge-progress {
    background-color: #e2e3f3;
    color: rgb(113 108 176);
  }

  .badge-coming {
    background-color: #fff3cd;
    color: rgb(237 199 85);
  }

  .badge-cool {
    background-color: #d8f2f3;
    color: rgb(59 192 195);
  }

  /* Chart Styles */

  .chart-card {
    background-color: white;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.5s ease;
  }

  .chart-card h5 {
    background-color: #061a40;
    padding: 12px 10px;
    border-radius: 14px;
    color: #ffffff;
    font-size: 1.2rem;
    font-weight: 600;
  }

  .chart-title {
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 1rem;
  }

  #myChart {
    width: 100% !important;
  }

  /* Title Styles */

  .main-title {
    font-size: 40px;
    font-weight: 600;
  }

  .table-heading {
    background-color: #061a40;
    padding: 12px 10px;
    border-radius: 14px;
    color: #ffffff;
    font-size: 1.2rem;
    font-weight: 600;
    display: inline-block;
  }

  /* Date Picker Styles */

  .date-selecter,
  .date-picker {
    border-radius: 18px;
    background-color: #ffffff;
    border: 0.5px solid #ccc;
    height: 48px;
  }

  .date-selecter:focus,
  .date-picker:focus {
    outline: none !important;
    box-shadow: none !important;
    border-color: #ccc !important;
  }

  /* Media Queries */

  @media screen and (max-width: 767px) {
    .date-selecter,
    .date-picker {
      height: 42px;
    }


  .custom-table-container {
    overflow-x:scroll;
  }
  }


  @media screen and (max-width: 991px){
  .chart-card {
    margin-bottom:20px
  }
  }
  .daterangepicker .calendar-table th, .daterangepicker .calendar-table td{
    line-height: 0px !important;
  }


</style>
<div class="wrapper px-xl-2">
  <div class="row">
    <div class="col-12 col-md-6">
        <h2 class="main-title text-md-start">Welcome to FutWin</h2>
    </div>
  </div>
</div>


@endsection

@section('common_script')




@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{{-- <script>

  document.addEventListener('DOMContentLoaded', function() {
    const fullData = {
      dates: [],
      sales: []
    };

    const startDate = new Date('2025-01-01');
    for (let i = 0; i < 365; i++) {
      const date = new Date(startDate);
      date.setDate(startDate.getDate() + i);
      fullData.dates.push(date.toISOString().split('T')[0]);
      fullData.sales.push(Math.floor(Math.random() * 100) + 10);
    }

    // Initialize Flatpickr
    const datePicker = document.getElementById('datePicker');
    if (!datePicker) {
      console.error('Date picker element (#datePicker) not found');
      return;
    }
    flatpickr(datePicker, {
      mode: "range",
      dateFormat: "m-d-Y",
      defaultDate: "{{ now()->format('m-d-Y') }}",
      allowInput: true,
      enableTime: false,
      appendTo: document.body,
      onChange: function(selectedDates, dateStr) {
        if (dateStr) {
          const filterType = filterTypeSelect.value;
          updateChartData(dateStr, filterType, true);
        }
      }
    });

    // Initialize Chart
    const canvas = document.getElementById('myChart');
    if (!canvas) {
      console.error('Canvas element (#myChart) not found');
      return;
    }
    const ctx = canvas.getContext('2d');
    if (!ctx) {
      console.error('Failed to get 2D context for canvas');
      return;
    }

    const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient1.addColorStop(0, 'rgb(59, 192, 195');
    gradient1.addColorStop(1, 'rgba(255, 255, 255, 0)');

    const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradient2.addColorStop(0, 'rgb(26, 41, 66)');
    gradient2.addColorStop(1, 'rgba(255, 255, 255, 0)');

    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Selected Dates',
          data: [],
          backgroundColor: gradient1,
          borderColor: 'rgb(59, 192, 195',
          borderWidth: 1,
          fill: true,
          tension: 0.4
        },
        {
          label: 'Previous Dates',
          data: [],
          backgroundColor: gradient2,
          borderColor: 'rgb(26, 41, 66)',
          borderWidth: 1,
          fill: true,
          tension: 0.4
        }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top'
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Date',
              font: {
                size: 14
              }
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Orders',
              font: {
                size: 14
              }
            }
          }
        }
      }
    });
    const salesAnalyticsUrl = "{{ route('sales.analytics') }}";

    function updateChartData(dateStr, filterType, isDateChange = false) {
      let [start, end] = dateStr.split(' to ');
      if (!end) end = start;

      fetch(`${salesAnalyticsUrl}?start_date=${start}&end_date=${end}&filter_type=${filterType}&is_date_change=${isDateChange}`)
        .then(response => response.json())
        .then(data => {
          const currentLabels = data.labels; // ['05-26', '05-27', ...]
          const previousLabels = data.prev_dates_labels || [];
          const currentSales = data.sales;
          const previousSales = data.previous_sales;

          chart.data.labels = currentLabels;

          chart.data.datasets[0].data = currentSales;
          chart.data.datasets[1].data = previousSales;

          chart.options.plugins.tooltip.callbacks = {
            title: function () {
              return '';
            },
            label: function (context) {
              const datasetIndex = context.datasetIndex;
              const label = datasetIndex === 0 ? 'Selected Dates' : 'Previous Dates';
              const dateLabel = datasetIndex === 1
                ? (previousLabels[context.dataIndex] || 'Previous Dates')
                : (currentLabels[context.dataIndex] || 'Date');
              return `${label} (${dateLabel}): $${context.parsed.y.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
            }
          };


          chart.options.scales.x.title.text = filterType === 'yearly' ? 'Month' : 'Date';
          chart.update();
        })
        .catch(error => {
          console.error('Error fetching sales data:', error);
        });
    }

    function updateChartData2(dateStr, filterType, isDateChange = false) {
      console.log('Fetching real sales data for:', dateStr, 'filter:', filterType, 'isDateChange:', isDateChange);

      let [start, end] = dateStr.split(' to ');
      if (!end) end = start;

      fetch(`${salesAnalyticsUrl}?start_date=${start}&end_date=${end}&filter_type=${filterType}&is_date_change=${isDateChange}`)
        .then(response => response.json())
        .then(data => {
            const labels = data.labels;
            const selectedSales = data.sales;
            const previousSales = data.previous_sales;

            // chart.data.labels = labels;
            // chart.data.datasets[0].data = selectedSales;
            // chart.data.datasets[1].data = previousSales;
            const prevLabels = labels.map(label => label + ' (Prev)');

            // Combine both sets of labels:
            const combinedLabels = labels.map((label, i) => `${label}`);

            // Assign data
            chart.data.labels = combinedLabels;
            chart.data.datasets[0].data = selectedSales;
            chart.data.datasets[1].data = previousSales;

            // Optionally you can tooltip-differentiate
            chart.options.plugins.tooltip = {
              callbacks: {
                label: function(context) {
                  const label = context.dataset.label || '';
                  return `${label}: ${context.parsed.y} on ${context.label}`;
                }
              }
            }


            chart.options.scales.x.title.text = filterType === 'yearly' ? 'Month' : 'Date';
            chart.update();
        })
        .catch(error => {
          console.error('Error fetching sales data:', error);
        });
    }

    // Initialize filter type listener
    const filterTypeSelect = document.getElementById('filterType');
    if (!filterTypeSelect) {
      console.error('Filter type element (#filterType) not found');
      return;
    }
    filterTypeSelect.addEventListener('change', function() {
      const dateStr = datePicker.value;
      if (dateStr) {
        updateChartData(dateStr, this.value, false);
      }
    });

  console.log('Initializing chart');
    updateChartData('{{ now()->format('m-d-Y') }}', 'weekly');
  });
  const filterTypeSelect = document.getElementById('filterType');
  filterTypeSelect.addEventListener('change', function () {
    const dateStr = datePicker.value;
    const selectedType = this.value;

    if (selectedType === 'custom') {
      datePicker.classList.remove('d-none');
    } else {
      datePicker.classList.add('d-none');
    }

    if (dateStr && selectedType !== 'custom') {
      updateChartData(dateStr, selectedType, false);
    }
  });

</script>
<script>
  $(document).ready(function () {
      const csrfToken = "{{ csrf_token() }}";

      const dateRangeInput = $('#dashboardDateRange');

      function fetchData(timePeriod, startDate = null, endDate = null) {
          const requestData = {
              time_period: timePeriod,
              _token: csrfToken
          };

          if (timePeriod === 'custom') {
              requestData.start_date = startDate;
              requestData.end_date = endDate;
          }

          $.ajax({
              url: "{{ route('get-metrics') }}",
              method: 'POST',
              data: requestData,
              success: function (response) {
                  $('#newOrders').text(response.new_orders);
                  $('#activeProducts').text(response.active_products);
                  $('#vipCustomers').text(response.vip_customers);
                  $('#orderSales').text('$' + response.order_sales);
              },
              error: function (xhr) {
                  console.error(xhr);
                  let message = 'An error occurred while loading the data.';
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                      message = xhr.responseJSON.message;
                  }
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: message
                  });
              }
          });
      }

      $('#timePeriod').change(function () {
          const selected = $(this).val();

          if (selected === 'custom') {
              dateRangeInput.show();
          } else {
              dateRangeInput.hide();
              fetchData(selected);
          }
      });

      dateRangeInput.daterangepicker({
          autoUpdateInput: false,
          locale: {
              format: 'MM-DD-YYYY',
              cancelLabel: 'Clear'
          }
      });

      dateRangeInput.on('apply.daterangepicker', function (ev, picker) {
          const startDate = picker.startDate.format('MM-DD-YYYY');
          const endDate = picker.endDate.format('MM-DD-YYYY');
          $(this).val(startDate + ' to ' + endDate);
          fetchData('custom', startDate, endDate);
      });

      dateRangeInput.on('cancel.daterangepicker', function () {
          $(this).val('');
      });

      fetchData('yearly');
  });
  document.querySelectorAll('.copy-btn').forEach(button => {
    button.addEventListener('click', function () {
      const targetId = this.getAttribute('data-target');
      const textElement = document.getElementById(targetId);
      const text = textElement.innerText.trim();

      const textarea = document.createElement("textarea");
      textarea.value = text;
      textarea.style.position = "fixed";
      textarea.style.opacity = 0;
      document.body.appendChild(textarea);
      textarea.focus();
      textarea.select();

      try {
        const successful = document.execCommand('copy');
        if (successful) {
          this.innerHTML = '<i class="fas fa-check text-success"></i>';
          setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy"></i>';
          }, 1500);
        } else {
          alert('Copy failed. Please copy manually.');
        }
      } catch (err) {
        alert('Copy command not supported');
      }

      document.body.removeChild(textarea);
    });
  });
   $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script> --}}

@endpush

@endsection
