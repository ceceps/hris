<script type="text/javascript" src="{{ asset('assets/pages/bootstrap-autocomplete.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bower_components/fullcalendar/js/fullcalendar.min.js') }}">
</script>

<script>
    "use strict";
    $(function() {

      //set tgl hari ini
      let today = new Date();
      let dd = today.getDate();
      let mm = today.getMonth()+1; //January is 0!
      let yyyy = today.getFullYear();

      $('#datetimepicker6').datetimepicker({
        format: 'DD-MM-YYYY HH:mm:ss',
        daysOfWeekDisabled: [0, 6],
        icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        $('#datetimepicker7').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            daysOfWeekDisabled: [0, 6],
        useCurrent: false, //Important! See issue #1075
        icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
        $("#datetimepicker6").on("dp.change", function (e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });


    $('.basicAutoComplete').autoComplete({
        resolver: 'custom',
        events: {
            search: function(qry, callback) {
                // let's do a custom ajax call
                $.ajax("/api/employees", {
                        data: {
                            'q': qry
                        }
                    }
                ).done(function(res) {
                    callback(res.results);
                });
            }
        },
        minLength: 1
    });

         $('.basicAutoComplete').on('autocomplete.select', function(evt, item) {
            $('#employee_id').val(item.id);
           });


        $('#external-events .fc-event').each(function() {
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });
        });

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            defaultView: 'month',
            defaultDate: yyyy+'-'+mm+'-'+dd,
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#checkbox2').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
                @foreach($workplans as $workplan)
                {
                    id: '{{ $workplan->id }}',
                    title: '{{ $workplan->plan_name.' '.$workplan->employee->name }}',
                    start: '{{ $workplan->from }}',
                    description: '{{ $workplan->worktodo }}',
                    plan_name: '{{ $workplan->plan_name }}',
                    name: '{{ $workplan->employee->name }}',
                    employee_id: '{{ $workplan->employee_id }}',
                    @if($workplan->to)
                    end: '{{ $workplan->to }}',
                    @endif
                    constraint: 'businessHours',
                    borderColor: '#4680ff',
                    backgroundColor: '#4680ff',
                    textColor: '#fffff',
                },
                @endforeach
            ],
            eventRender: function(event, element) {
                 element.find('.fc-title').append("<br/>" + event.description);
            },
            eventClick: function(calEvent, jsEvent, view) {
                $('#id').val(calEvent.id);
                $('#title').text('Edit ');
                $('#plan_name').val(calEvent.plan_name);
                $('#name').val(calEvent.name);
                $('#employee_id').val(calEvent.employee_id);
                $('#worktodo').val(calEvent.description);
                $('#from').val(moment(calEvent.start).format('DD-MM-YYYY HH:mm:ss'));
                $('#to').val(moment(calEvent.end).format('DD-MM-YYYY HH:mm:ss'));
                $('#editModal').modal();
                $('#workplan_add').attr('id','workplan_update').attr('value','Update');
            }
        });

  function clearForm(){
     $('.modal input:text').val();
     $('.modal input:hidden').val();
  }

  $('#add_workplan').on('click',function(){

    $('#editModal').modal({
        backdrop: false,
        keyboard: false
    });
    clearForm();
  });

//update modal
$('#workplan_update').on('click',function(e) {
            e.preventDefault();
            var data = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                id: $('#id').val(),
                plan_name: $('#plan_name').val(),
                employee_id: $('#employee_id').val(),
                from: $('#from').val(),
                to: $('#to').val(),
                worktodo: $('#worktodo').val(),
            };

            $.post('/workplans/'+$('#id').val(), data, function(result) {
                    $('#calendar').fullCalendar('removeEvents', $('#id').val());
                    $('#calendar').fullCalendar('renderEvent', {
                        title: result.results.plan_name+ ' '+result.results.employee.name,
                        plan_name: result.results.plan_name,
                        description: result.results.worktodo,
                        name: result.results.employee.name,
                        employee_id: result.results.employee_id,
                        start: result.results.from,
                        end: result.results.to
                    }, true);
                    $('#calendar').fullCalendar('refetchEvents');
                    $('#editModal').modal('hide');
            });

            //reload Workplan  Full Calendar
            $('#users_menu').change(function() {

                var events = {
                    url: "api/workplans",
                    type: 'POST',
                    data: {
                        user_id: $(this).val()
                    }
                }

                $('#calendar').fullCalendar('removeEventSource', events);
                $('#calendar').fullCalendar('addEventSource', events);
                $('#calendar').fullCalendar('refetchEvents');
            }).change();
        });

  //save in modal
  $('#workplan_add').on('click', function(event) {
        event.preventDefault();
        console.log('store');

        var datas = {
                _token: '{{ csrf_token() }}',
                plan_name: $('#plan_name').val(),
                id: $('#id').val(),
                employee_id: $('#employee_id').val(),
                from: $('#from').val(),
                to: $('#to').val(),
                worktodo: $('#worktodo').val(),
            };
        $.post('{{ route('workplans.store') }}', datas, function(data) {
            // just try to see the outputs
            console.log(data);
            if(data.status===true) {
                $('#editModal').modal('hide');

                swal("Success!", data.msg, {
					icon : "success",
					buttons: {
						confirm: {
							className : 'btn btn-success'
						}
					},
					timer: 2000
                });
                $.map
                $('#calendar').fullCalendar('removeEventSource', events);
                $('#calendar').fullCalendar('addEventSource', events);
                $('#calendar').fullCalendar('refetchEvents');

            } else {
                swal("Error!", data.msg, {
					icon : "error",
					buttons: {
						confirm: {
							className : 'btn btn-danger'
						}
					}
				});
            }
        }, 'json')
    });


    });
</script>
