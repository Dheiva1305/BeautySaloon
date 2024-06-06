<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- FullCalendar CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <!-- Toastr CSS & JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>
    <div class="card">
        <div class="card-head">
            <h5>Beautician Booking Calendar</h5>
        </div>
        <div class="card-body"> 
            <div id='calendar'></div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="slot" class="form-label">Time Slot</label>
                            <select class="form-control" id="slot" name="slot"></select>
                        </div>

                        <div class="mb-3">
                            <label for="beautician" class="form-label">Beautician</label>
                            <select class="form-control" id="beautician" name="beautician">
                                @foreach($beauticians as $beautician)
                                    <option value="{{ $beautician->id }}">{{ $beautician->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="selectedDate" name="date">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            businessHours: {
                dow: [ 1, 2, 3, 4, 6, 0 ], 

                start: '09:00', 
                end: '22:00', 
            },
            validRange: {
                start: moment().format('YYYY-MM-DD')
            },
            dayClick: function(date, jsEvent, view) {
                if (date.isSameOrAfter(moment(), 'day') && date.day() != 5) { 
                    $('#selectedDate').val(date.format());
                    $('#eventModal').modal('show');
                } else if (date.day() == 5) {
                    toastr.error('Friday is a holiday. No bookings allowed.');
                } else {
                    toastr.error('Cannot book past dates.');
                }
            },
            eventClick: function(event, jsEvent, view) {
                $('#eventModal').modal('show');
            }
        });

        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("store") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    toastr.success('Booking saved successfully.');
                    $('#eventModal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                },
                error: function(response) {
                    toastr.error('This beautician is already booked this slot.');
                }
            });
        });

        const selectElement = document.getElementById('slot');
        const startHour = 9;
        const endHour = 22;

        for (let hour = startHour; hour < endHour; hour++) {
            let nextHour = hour + 1;
            let optionText = `${formatHour(hour)} to ${formatHour(nextHour)}`;
            let optionElement = document.createElement('option');
            optionElement.value = optionText;
            optionElement.textContent = optionText;
            selectElement.appendChild(optionElement);
        }

        function formatHour(hour) {
            return hour.toString().padStart(2, '0') + ":00";
        }
    });
</script>

</body>
</html>
