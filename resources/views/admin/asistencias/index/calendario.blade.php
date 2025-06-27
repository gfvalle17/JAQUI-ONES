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

{{-- En resources/views/admin/asistencias/index/calendario.blade.php --}}

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.global.min.js"></script>

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.global.min.js"></script>

{{-- En resources/views/admin/asistencias/index/calendario.blade.php --}}

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.global.min.js"></script>

{{-- En resources/views/admin/asistencias/index/calendario.blade.php --}}

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // --- Configuración básica que ya teníamos ---
            locale: 'es',
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            dayHeaderFormat: { weekday: 'long' },
            height: 'auto',

            // --- Carga de eventos (cursos) ---
            events: {!! $eventos !!},

            // ### LÓGICA DE CLIC SIMPLIFICADA ###
            // Ahora, el clic en un evento funciona igual para todos los roles (Admin y Docente)
            eventClick: function(info) {
                // Prevenimos que el navegador siga el enlace por sí solo (para evitar doble carga)
                info.jsEvent.preventDefault(); 
                
                // Si el evento tiene una URL (y todos la tienen), redirigimos a ella
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
            }
        });

        calendar.render();
    });
</script>
@stop