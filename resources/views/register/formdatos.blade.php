<!-- Estilo base reutilizable para cada input -->
@php
    $inputClass = "placeholder-gray-400 text-sm p-2 px-3 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-black transition duration-200";
@endphp

<!-- Tipo Documento y Nro Documento -->
<div class="flex flex-col md:flex-row gap-4">
  <div class="w-full mx-2 flex-1">
    <select name="c_tipdoc" class="{{ $inputClass }}">
        <option value="" disabled >Tipo Documento</option>
        <option value="DNI">DNI</option>
        <option value="CARNEEXT">Carné de Extranjería</option>
        <option value="PARTNAC">Partida de Nacimiento</option>
        <option value="TITULO">Título profesional o grado de bachiller</option>
        <option value="PASPT">Pasaporte</option>
    </select>
</div>

  <div class="w-full mx-2 flex-1 ">
      <input type="text" name="c_numdoc" placeholder="Nro. Documento" value="" class="{{ $inputClass }}">
  </div>
</div>

<!-- Nombres -->
<div class="mt-4 mx-2">
  <input type="text" name="c_nombres" placeholder="Nombres" value="" class="{{ $inputClass }}">
</div>

<!-- Apellido Paterno y Apellido Materno -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="text" name="c_apepat" placeholder="Apellido Paterno" value="" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="text" name="c_apemat" placeholder="Apellido Materno" value="" class="{{ $inputClass }}">
  </div>
</div>

<!-- Correo -->
<div class="mt-4 mx-2">
  <input type="email" name="c_email" placeholder="Correo Electrónico" value="" class="{{ $inputClass }}">
</div>

<!-- Dirección -->
<div class="mt-4 mx-2">
  <input type="text" name="c_dir" placeholder="Dirección" value="" class="{{ $inputClass }}">
</div>

<!-- Sexo y Fecha de Nacimiento -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select name="c_sexo" class="{{ $inputClass }}">
      <option value="M">Masculino</option>
      <option value="F">Femenino</option>
  </select>
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="date" name="d_fecnac" placeholder="Fecha de Nacimiento" value="" class="{{ $inputClass }}">
  </div>
</div>

<!-- Distrito -->
<div class="mt-4 mx-2">
  <select id="select-ubigeo" name="c_ubigeo" class="tom-select {{ $inputClass }}">
    <option value="" disabled selected>Seleccione Ubicación</option>
    @foreach($ubigeos as $ubigeo)
        <option value="{{ $ubigeo->codigo }}"
            {{ isset($data) && $data->c_ubigeo == $ubigeo->codigo ? 'selected' : '' }}>
            {{ $ubigeo->nombre }}
        </option>
    @endforeach
  </select>
</div>

<!-- Celular -->
<div class="mt-4 mx-2 mb-4">
  <input type="text" name="c_celu" placeholder="Celular" value="" class="{{ $inputClass }}">
</div>
