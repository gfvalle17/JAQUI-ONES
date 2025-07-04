<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Matrícula del Estudiante</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; }
        h2 { margin: 0; }
        .text-center { text-align: center; }
        .text-justify { text-align: justify; }
        .w-100 { width: 100%; }
        .w-200px { width: 200px; }
        .w-300px { width: 300px; }
    </style>
</head>
<body>

    @php
    // --- LÓGICA PARA INCRUSTAR IMÁGENES EN BASE64 ---

    // Función para generar la imagen en Base64 de forma segura
    function get_image_base64($path) {
        // Primero, verificamos si la ruta es válida y el archivo existe
        if ($path && file_exists(public_path($path))) {
            try {
                // Obtenemos la ruta completa al archivo en la carpeta public
                $full_path = public_path($path);
                // Leemos el contenido del archivo
                $file_content = file_get_contents($full_path);
                // Obtenemos el tipo de imagen (ej. 'image/png')
                $mime_type = mime_content_type($full_path);
                // Codificamos en Base64 y creamos el string para el src de la imagen
                return 'data:' . $mime_type . ';base64,' . base64_encode($file_content);
            } catch (\Exception $e) {
                // Si algo falla, retornamos un string vacío
                return '';
            }
        }
        // Si no existe el archivo, retornamos un string vacío
        return '';
    }

    // Generamos los datos para el logo y la foto
    $logo_base64 = get_image_base64($configuracion->logo);
    $foto_base64 = get_image_base64($matricula->estudiante->foto);
    @endphp

    <table border="0">
        <tr>
            <td class="text-center" style="font-size:8pt; width: 200px;">
                {{-- SOLUCIÓN: Usamos la variable con la imagen en Base64 --}}
                @if($logo_base64)
                    <img src="{{ $logo_base64 }}" alt="Insignia" width="70px">
                @else
                    <p>[Logo no encontrado]</p>
                @endif
                <br>
                <b>{{ $configuracion->nombre }}</b><br>
                {{ $configuracion->direccion }}<br>
                {{ $configuracion->telefono }}<br>
                {{ $configuracion->correo_electronico }}
            </td>
            <td style="width: 300px; text-align: center; vertical-align: bottom;">
                <h2><u>Matrícula del estudiante</u></h2>
            </td>
            <td class="text-center" style="width:200px;">
                <div style="border: 1px solid #333; width: 110px; height: 130px; margin: 0 auto; display:flex; align-items:center; justify-content:center;">
                    {{-- SOLUCIÓN: Usamos la variable con la foto en Base64 --}}
                    @if($foto_base64)
                        <img src="{{ $foto_base64 }}" alt="Foto" style="max-width: 100px; max-height: 125px;">
                    @else
                        <p style="font-size:9pt;">[Fotografía no encontrada]</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>
    <br>
    {{-- El resto del documento sigue igual --}}
    <table border="0" cellpadding="5" style="margin-left: 50px;">
        <tr>
            <td style="width: 100px;"><b>Gestión: </b></td>
            <td style="width: 170px;">{{ $matricula->gestion->nombre }}</td>
            <td style="width: 100px;"><b>Nombres:</b></td>
            <td style="width: 220px;">{{ $matricula->estudiante->nombres }}</td>
        </tr>
        <tr>
            <td><b>Turno: </b></td>
            <td>{{ $matricula->turno->nombre }}</td>
            <td><b>Apellidos:</b></td>
            <td>{{ $matricula->estudiante->apellidos }}</td>
        </tr>
        <tr>
            <td><b>Nivel: </b></td>
            <td>{{ $matricula->nivel->nombre }}</td>
            <td><b>DNI:</b></td>
            <td>{{ $matricula->estudiante->ci }}</td>
        </tr>
        <tr>
            <td><b>Grado: </b></td>
            <td>{{ $matricula->grado->nombre }}</td>
            <td><b>Género:</b></td>
            <td>{{ $matricula->estudiante->genero }}</td>
        </tr>
        <tr>
            <td><b>Sección: </b></td>
            <td>{{ $matricula->paralelo->nombre }}</td>
            <td><b>Teléfono:</b></td>
            <td>{{ $matricula->estudiante->telefono }}</td>
        </tr>
    </table>

    <hr>

    <p class="text-justify">
        <b>Partes contratantes</b><br><br>
        La Institución <b>{{ $configuracion->nombre }}</b>, en adelante denominado "La Institución Educativa", representado por el <b style="color: blue">Lic. Harolf Gonzalo Francia Valle</b>, con domicilio en av. del maestro s/n. Padres/Tutores legales del estudiante <b style="color: blue">{{ $matricula->estudiante->apellidos }} {{ $matricula->estudiante->nombres }}</b>, en adelante denominado "El Estudiante", representados por <b style="color: blue">{{ $matricula->estudiante->ppff->apellidos." ".$matricula->estudiante->ppff->nombres }}</b>, con domicilio en <b style="color: blue">{{ $matricula->estudiante->ppff->direccion }}</b>.
        <br><br>
        <b>Términos y condiciones:</b>
        Matrícula: Los padres/Tutores legales matriculan al Estudiante en la Institución Educativa para el año escolar <b style="color: blue">{{ $matricula->grado->nombre }}</b>.
        <br><br>
        <b>Compromisos del Estudiante: </b>El Estudiante se compromete a asistir puntualmente a clases, participar activamente en las actividades escolares y seguir las normas y reglamentos establecidos por la Institución Educativa.
        <br><br>
        <b>Compromisos de los Padres/Tutores: </b>Los Padres/Tutores se comprometen a apoyar activamente la educación del Estudiante, mantener una comunicación regular con los maestros y cumplir con las obligaciones financieras relacionadas con la matrícula y las tarifas escolares.
        <br><br>
        <b>Duración del Contrato: </b>Este contrato tiene una duración de un año escolar y se renovará automáticamente para cada año escolar subsiguiente, a menos que cualquiera de las partes notifique lo contrario con al menos 10 días de antelación al inicio del nuevo año escolar.
        <br><br>
        <b>Terminación del Contrato:</b> La Institución Educativa se reserva el derecho de rescindir este contrato si el Estudiante o los Padres/Tutores no cumplen con las normas y reglamentos internos. <br><br>
        Fecha: {{ now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
    </p>

    <br><br><br>

    <table border="0" class="w-100">
        <tr>
            <td class="text-center">
                _________________________________ <br>
                <b>Director</b> <br>
                Lic. Harolf Gonzalo Francia Valle
            </td>
            <td class="text-center">
                _________________________________ <br>
                <b>Padres/Tutores</b> <br>
                {{ $matricula->estudiante->ppff->apellidos." ".$matricula->estudiante->ppff->nombres }}
            </td>
        </tr>
    </table>
</body>
</html>
