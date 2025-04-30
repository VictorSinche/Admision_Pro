<!-- Estilo base reutilizable para cada input -->
@php
    $inputClass = "placeholder-gray-400 text-sm p-2 px-3 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-black transition duration-200";
@endphp

<!-- Distrito del colegio-->
<div class="mt-4 mx-2">
  <select class="{{ $inputClass }}">
      <option value="" disabled selected>Seleccione Distrito</option>
      <option value="San Juan de Lurigancho">San Juan de Lurigancho</option>
      <option value="Ate">Ate</option>
      <option value="San Borja">San Borja</option>
      <option value="La Molina">La Molina</option>
      <option value="Otros">Otros</option>
  </select>
</div>

<!-- Colegio de procedencia-->
<div class="mt-4 mx-2">
  <input type="text" placeholder="Colegio de Procedencia" class="{{ $inputClass }}">
</div>

<!-- Tipo Documento y Nro Documento -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="text" placeholder="Año de egreso" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Tipo de institucion</option>
        <option value="0">Particular</option>
        <option value="1">Estatal</option>
    </select>
  </div>
</div>

<div class="mt-4 mx-2">
  <select class="{{ $inputClass }}">
      <option value="" disabled selected>Seleccione Proceso de admisión</option>
      <option value="1">ADMISIÓN 2025-I CIENCIAS DE LA SALUD</option>
      <option value="2">ADMISION 2025-I INGENIERÍA Y NEGOCIOS</option>
      <option value="3">ADMISIÓN 2025-I MAESTRÍA EN SALUD PÚBLICA</option>
      <option value="4">ADMISIÓN 2025-I MAESTRÍA EN ADMINISTRACIÓN DE EMPRESAS</option>
      <option value="5">VENTAS MATRICULAS SEGUNDAS ESPECIALIDADES FARMACIA 2025-1</option>
  </select>
</div>

<!-- Tipo Documento y Nro Documento -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Modalidad de ingreso</option>
        <option value="0">Primeros Puestos</option>
        <option value="1">Ordinario</option>
        <option value="2">Alto Rendimiento</option>
        <option value="3">Traslado Externo</option>
        <option value="4">Admisión Técnicos</option>
        <option value="5">Admisión Pre-UMA</option>
    </select>
  </div>
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Sede</option>
        <option value="0">Principal</option>
    </select>
  </div>
</div>

<div class="mt-4 mx-2">
  <select class="{{ $inputClass }}">
      <option value="" disabled selected>Seleccione el Programa de Interés</option>
      <option value="1">ENFERMERÍA</option>
      <option value="2">FARMACIA Y BIOQUÍMICA</option>
      <option value="3">NUTRICIÓN Y DIETÉTICA</option>
      <option value="4">PSICOLOGÍA</option>
      <option value="5">TECNOLOGÍA MÉDICA EN TERAPIA FÍSICA Y REHABILITACIÓN</option>
  </select>
</div>

<div class="mt-4 mx-2">
  <select class="{{ $inputClass }}">
      <option value="" disabled selected>¿Como se entero del proceso de admision?</option>
      <option value="1">TELEVISION</option>
      <option value="2">PANELES</option>
      <option value="3">INTERNET</option>
      <option value="4">POR AMIGOS</option>
      <option value="5">OTRAS</option>
      <option value="1">VOLANTES</option>
      <option value="2">ASESOR</option>
      <option value="3">FACEBOOK</option>
      <option value="4">FERIAS VOCACIONALES</option>
      <option value="5">GOOGLE</option>
      <option value="5">INSTAGRAM</option>
      <option value="5">PAGINA WEB</option>
      <option value="5">TIKTOK</option>
      <option value="5">GOOGLE</option>
      <option value="5">TRAE UN AMIGO</option>
  </select>
</div>

<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Turno</option>
        <option value="0">Mañana</option>
        <option value="1">Tarde</option>
        <option value="2">Noche</option>
    </select>
  </div>
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Condición Discapacidad</option>
        <option value="0">NO</option>
        <option value="1">SI</option>
    </select>
  </div>
  <div class="w-full mx-2 flex-1">
    <select class="{{ $inputClass }}">
        <option value="" disabled selected>Identidad Étnica</option>
        <option value="0">Quechua</option>
        <option value="1">Aymara</option>
        <option value="2">Nativo o indigena de la amazonia</option>
        <option value="3">Perteneciente a otro pueblo originario</option>
        <option value="4">Afroperuano o afrodescendiente</option>
        <option value="5">Blanco</option>
        <option value="6">Mestizo</option>
        <option value="7">Otros</option>
    </select>
  </div>
</div>