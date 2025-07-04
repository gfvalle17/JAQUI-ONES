@extends('adminlte::page')

@section('title', 'Calendario de Horarios')

{{-- Añadimos los estilos de FullCalendar en la sección de CSS --}}
@section('css')
<style>
    /* Estilos para que el calendario se vea bien */
    #calendario {
        max-width: 1100px;
        margin: 0 auto;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    }
    /* Personalizar el color de los eventos */
    .fc-event {
        background-color: #17a2b8 !important; /* Color info */
        border-color: #17a2b8 !important;
    }
</style>
@stop

@section('content_header')
    <h1><b>Calendario de Horarios Semanales</b></h1>
    <hr>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Aquí es donde se renderizará el calendario --}}
            <div id="calendario"></div>
        </div>
    </div>
@stop

{{-- Añadimos las librerías de FullCalendar en la sección de JS --}}
@section('js')
{{-- Librería principal de FullCalendar --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
{{-- Paquete de idioma español --}}
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // ----------- CONFIGURACIÓN BÁSICA -----------
            initialView: 'timeGridWeek',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            // ### LÍNEA AÑADIDA ###
            // Esto mostrará el nombre completo del día en los encabezados (ej: "miércoles")
            dayHeaderFormat: { weekday: 'long' },

            slotMinTime: '07:00:00',
            slotMaxTime: '20:00:00',

            // ----------- EVENTOS -----------
            events: {!! $eventos !!},

            // ----------- APARIENCIA -----------
            eventColor: '#378006',
            height: 'auto',

            // ----------- FUNCIONALIDAD EXTRA (OPCIONAL) -----------
            dateClick: function(info) {
                // console.log('Hiciste clic en: ' + info.dateStr);
            },
            eventClick: function(info) {
                // Prevenimos la alerta si el evento ya tiene una URL
                if (info.event.url) {
                    return;
                }
                alert('Curso: ' + info.event.title);
            }
        });

        calendar.render();
    });
</script>
@stop