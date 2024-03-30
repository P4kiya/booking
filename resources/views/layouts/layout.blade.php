<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Booking</title>

    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/materialize.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/materialize-custom.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/plugins/fullcalendar/fullcalendar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/ckeditor.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/scrollbar/scroll.min.css') }}">

    <link rel="stylesheet" href=" {{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body class="nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">

    <div class="main-wrapper scrollbar-margins large-margin scroll-demo">

        @include('layouts.header')

        @include('layouts.sidebar')

        @yield('content')

    </div>

    <script src="{{ asset('/assets/js/jquery-3.6.1.min.js') }}"></script>

    <script src="{{ asset('/assets/js/materialize.min.js') }}"></script>

    <script src="{{ asset('/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>

    <script src="{{ asset('assets/plugins/scrollbar/scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollbar/custom-scroll.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#print').on('click', function() {
                $('#facture').css('margin-top', '-100px');
                $('#hidediv').hide();
                $('#sidebar').hide();
                $('#header').hide();
                $('body').css('background', '#fff');
                window.print();
                $('#hidediv').show();
                $('#sidebar').show();
                $('#header').show();
                $('#facture').css('margin-top', '0');
                $('body').css('background', '#f7f8f9');
            });
        });
    </script>

    <script>
        function downloadAsDoc() {
            var content = document.documentElement.outerHTML;
            var blob = new Blob(['\ufeff', content], {
                type: 'application/msword'
            });
            var downloadLink = URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.href = downloadLink;
            a.download = "page.doc";
            document.body.appendChild(a);
            a.click();
        }
    </script>
    
    <script src="{{ asset('/assets/js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.add-btn2').click(function() {
                var row = '<tr class="add-row">' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td class="add-remove right-align">' +
                    '<a href="#" class="add-btn2 me-2" style="color:black;"><i class="fas fa-plus-circle"></i></a>' +
                    '<a href="#" class="remove-btn2" style="color:#f00;" ><i class="fa fa-trash"></i></a>' +
                    '</td>' +
                    '</tr>';
                $('tbody').append(row);
            });

            $(document).on('click', '.remove-btn2', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function calculateTotal() {
                var start_date = new Date($('#start_date').val());
                var end_date = new Date($('#end_date').val());
                var price_per_night = parseFloat($('#price_per_night').val());
                var total_days = Math.abs((end_date - start_date) / (1000 * 60 * 60 * 24));
                var total_price = total_days * price_per_night;
                $('#total_price').text(' DH/ ' + total_price.toFixed(2));
                $('input[name="total"]').val(total_price.toFixed(2));
            }

            $('#start_date, #end_date, #price_per_night').change(calculateTotal);
        });
    </script>

    <script>
        function showPopup() {
            $('#exampleModal').modal('show');
        }
    </script>

    <script>
        $('#start_date, #end_date').on('change', function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            if (startDate && endDate) {
                var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname +
                    '?start_date=' + startDate + '&end_date=' + endDate;
                window.location.href = newurl;
            }
        });
    </script>

    <script>
        let currentWeek = 0;
        let currentDate = new Date();
        currentDate.setDate(currentDate.getDate() - currentDate.getDay() +
            1); // Set currentDate to the Monday of the current week
        function changeWeek(direction) {
            var currentUrl = new URL(window.location.href);
            var weekOffset = currentUrl.searchParams.get("weekOffset") || 0;
            let newDate = new Date(currentDate);
            if (direction === 'next') {
                weekOffset++;
                newDate.setDate(newDate.getDate() + (currentWeek * 7) + 7);
            } else if (direction === 'prev') {
                weekOffset--;
                newDate.setDate(newDate.getDate() + (currentWeek * 7) - 7);
            }
            currentUrl.searchParams.set("weekOffset", weekOffset);
            window.location.href = currentUrl.toString();
        }
    </script>
</body>

</html>
