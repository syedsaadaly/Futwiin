@if ($items->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page --}}
            @if ($items->onFirstPage())
                <li class="page-item disabled"><span class="page-link">«</span></li>
            @else
                <li class="page-item">
                    <a class="page-link pagination-link" href="{{ $items->previousPageUrl() }}"
                        data-page="{{ $items->currentPage() - 1 }}">«</a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($items->links()->elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $items->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link pagination-link" href="{{ $url }}"
                                    data-page="{{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($items->hasMorePages())
                <li class="page-item">
                    <a class="page-link pagination-link" href="{{ $items->nextPageUrl() }}"
                        data-page="{{ $items->currentPage() + 1 }}">»</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">»</span></li>
            @endif
        </ul>
    </nav>
@endif

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     let pagination_table = initializeDataTable();
        //     // let table1;

        //     function initializeDataTable() {
        //         let table1 = $('#allUsersTable').DataTable({
        //             "paging": false,
        //             "lengthChange": false,
        //             "searching": true,
        //             "ordering": true,
        //             "info": false,
        //             "autoWidth": false,
        //             // "responsive": true,
        //             // "columnDefs": [{
        //             //     "orderable": false,
        //             //     "targets": ".remove-shortable"
        //             // }],
        //             dom: 'Bfrtip',
        //             buttons: [{
        //                 extend: 'excel',
        //                 text: 'Export to Excel',
        //                 className: 'btn btn-primary',
        //                 exportOptions: {
        //                     columns: ':visible' 
        //                 }
        //             }],
        //             columnDefs: [
        //                 {
        //                     orderable: false,
        //                     targets: [0, -1]
        //                 }
        //             ],
        //             "initComplete": function() {
        //                 $('#allUsersTable_filter input').attr('placeholder', $('#allUsersTable').attr(
        //                     'data-placeholder'));
        //             }
        //         });
        //         table1.buttons().container().appendTo('#allUsersTable1_wrapper .col-md-6:eq(0)');


        //         table1.on('order.dt', function () {
        //         let order = table1.order();
                
        //         if (order.length === 0 || !order[0]) return;

        //         let columnIndex = order[0][0];
        //         if (columnIndex === 0) return;
        //         let direction = order[0][1];

        //         let columnName = $('#allUsersTable thead th').eq(columnIndex).text().trim();

        //         fetchSortedData(columnName, direction);
        //     });


        //         return table1;
        //     }

        //     // $('#exportExcel').on('click', function() {
        //     //     let table1 = $('#allUsersTable');
        //     //     table1.button('.buttons-excel').trigger();
        //     // });

        //     $('body').on('click', '.pagination-link', function(e) {
        //         e.preventDefault();
        //         let pageUrl = new URL($(this).attr('href'), window.location
        //         .origin);
        //         let perPage = $('#perPageSelect').val();
        //         pageUrl.searchParams.set('per_page', perPage);
        //         fetchProducts(pageUrl.toString());
        //     });

        //     $('#perPageSelect').on('change', function() {
        //         let perPage = $(this).val();
        //         let url = new URL(window.location.href);
        //         url.searchParams.set('per_page', perPage);
        //         fetchProducts(url.toString());
        //     });

        //     function fetchProducts(url) {
        //         $.ajax({
        //             url: url,
        //             type: "GET",
        //             dataType: "json",
        //             success: function(response) {
        //                 $('#table-data').html('');
        //                 pagination_table.destroy();
        //                 $('#table-data').html(response.tableData);
        //                 $('#pagination-links').html(response.pagination);
        //                 pagination_table = initializeDataTable();

        //                 let currentPerPage = new URL(url).searchParams.get('per_page');
        //                 $('#perPageSelect').val(currentPerPage);

        //                 if ($('#allUsersTable').data('default') != 1) {
        //                     pagination_table.columns().visible(true);
        //                 } else {
        //                     $('#allUsersTable').data('default', 0);
        //                 }
        //             },
        //             error: function() {
        //                 console.error("Error fetching products.");
        //             }
        //         });
        //     }


        //     const tableElement = $('#allUsersTable');
        //     const routeUrl = tableElement.data('route');
        //     const hasCategoryFilter = tableElement.data('category') === true;

        //     function fetchFilteredData(query) {
        //         let selectedCategories = hasCategoryFilter ? $('#categoryFilter').val() || [] : [];

        //         $.ajax({
        //             url: routeUrl,
        //             type: 'GET',
        //             data: {
        //                 search: query,
        //                 categories: selectedCategories
        //             },
        //             success: function(response) {
        //                 if ($.trim(response.tableData) === '') {
        //                     let columnCount = $(`#allUsersTable thead tr th`)
        //                         .length;
        //                     $('#table-data').html(`
        //                             <tr>
        //                                 <td class="text-center" colspan="${columnCount}">
        //                                     No matching records found
        //                                 </td>
        //                             </tr>
        //                         `);
        //                 } else {
        //                     let searchV = $("#allUsersTable_filter input").val();
        //                     $('#table-data').html('');
        //                     pagination_table.destroy();
        //                     $('#table-data').html(response.tableData);
        //                     $('#pagination-links').html(response.pagination);
        //                     pagination_table = initializeDataTable();
        //                     if ($('#allUsersTable').data('default') != 1) {
        //                         pagination_table.columns().visible(true);
        //                     } else {
        //                         $('#allUsersTable').data('default', 0);
        //                     }
        //                     $("#allUsersTable_filter input").val(searchV).focus();
        //                 }

        //                 $('#pagination-links nav').html(response.pagination);
        //             },
        //             error: function() {
        //                 console.error("Error fetching filtered data.");
        //             }
        //         });
        //     }

        //     function debounce(func, delay) {
        //         let timer;
        //         return function(...args) {
        //             clearTimeout(timer);
        //             timer = setTimeout(() => func.apply(this, args), delay);
        //         };
        //     }

        //     const fetchFilteredDataDebounced = debounce(fetchFilteredData, 1000);

        //     $(document).ready(function() {
        //         let table = $('#allUsersTable').DataTable();

        //         $('#allUsersTable_filter input').off('keyup');

        //         $(document).on('keyup', "#allUsersTable_filter input", function(event) {
        //             event.preventDefault();
        //             event.stopPropagation();

        //             let customSearchQuery = $(this).val();

        //             table.search('').draw(false);

        //             fetchFilteredDataDebounced(customSearchQuery);
        //         });
        //     });
        //     function fetchSortedData(column, direction) {
        //         $.ajax({
        //             url: $('#allUsersTable').data('route'),
        //             type: 'GET',
        //             data: {
        //                 sort_column: column,
        //                 sort_direction: direction
        //             },
        //             success: function (response) {
        //                 $('#table-data').html(response.tableData);
        //                 $('.pagination-wrapper').html(response.pagination);
        //             },
        //             error: function () {
        //                 alert("Error while sorting data.");
        //             }
        //         });
        //     }
        // });

        let currentSearch = '';
        let currentPerPage = 10;
        let currentSort = { column: null, direction: null };
        let pagination_table;

        function initializeDataTable() {
            let orderSetting = [];

            if (currentSort.column) {
                $('#allUsersTable thead th').each(function(index) {
                    if ($(this).text().trim() === currentSort.column) {
                        orderSetting = [[index, currentSort.direction]];
                    }
                });
            }
            let table1 = $('#allUsersTable').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "order": orderSetting,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible' 
                    }
                }],
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, -1]
                    }
                ],
                "initComplete": function() {
                    $('#allUsersTable_filter input').attr('placeholder', $('#allUsersTable').attr('data-placeholder'));
                    $('#allUsersTable_filter input').val(currentSearch);
                }
            });

            table1.buttons().container().appendTo('#allUsersTable1_wrapper .col-md-6:eq(0)');

            table1.on('order.dt', function() {
                let order = table1.order();
                if (order.length === 0 || !order[0]) return;

                let columnIndex = order[0][0];
                if (columnIndex === 0) return;
                
                let columnName = $('#allUsersTable thead th').eq(columnIndex).text().trim();
                let direction = order[0][1];
                
                currentSort = { column: columnName, direction: direction };
                fetchData();
            });

            return table1;
        }

        function fetchData(pageUrl = null) {
            let url = pageUrl || $('#allUsersTable').data('route');
            let urlObj = new URL(url, window.location.origin);
            
            urlObj.searchParams.set('per_page', currentPerPage);
            if (currentSearch) {
                urlObj.searchParams.set('search', currentSearch);
            }
            if (currentSort.column) {
                urlObj.searchParams.set('sort_column', currentSort.column);
                urlObj.searchParams.set('sort_direction', currentSort.direction);
            }
            
            if ($('#allUsersTable').data('category') === true) {
                let selectedCategories = $('#categoryFilter').val() || [];
                urlObj.searchParams.set('categories', selectedCategories.join(','));
            }

            $.ajax({
                url: urlObj.toString(),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $('#table-data').html('');
                    if (pagination_table) {
                        pagination_table.destroy();
                    }
                    $('#table-data').html(response.tableData);
                    $('#pagination-links').html(response.pagination);
                    pagination_table = initializeDataTable();

                    if ($('#allUsersTable').data('default') != 1) {
                        pagination_table.columns().visible(true);
                    } else {
                        $('#allUsersTable').data('default', 0);
                    }
                    
                    $('#allUsersTable_filter input').val(currentSearch);
                },
                error: function() {
                    console.error("Error fetching data.");
                }
            });
        }

        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function initFromUrl() {
            let urlParams = new URLSearchParams(window.location.search);
            currentSearch = urlParams.get('search') || '';
            currentPerPage = urlParams.get('per_page') || $('#perPageSelect').val() || 10;
            if (urlParams.has('sort_column') && urlParams.has('sort_direction')) {
                currentSort = {
                    column: urlParams.get('sort_column'),
                    direction: urlParams.get('sort_direction')
                };
            }
            $('#perPageSelect').val(currentPerPage);
        }

        $(document).ready(function() {
            initFromUrl();
            
            pagination_table = initializeDataTable();

            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                fetchData($(this).attr('href'));
            });

            $('#perPageSelect').on('change', function() {
                currentPerPage = $(this).val();
                fetchData();
            });

            const handleSearch = debounce(function(query) {
                currentSearch = query;
                fetchData();
            }, 1000);

            $(document).on('keyup', "#allUsersTable_filter input", function(event) {
                event.preventDefault();
                event.stopPropagation();
                handleSearch($(this).val());
            });
        });
    </script>
@endpush
