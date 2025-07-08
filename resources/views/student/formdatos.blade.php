<!-- Estilo base reutilizable para cada input -->
@php
    $inputClass = "placeholder-gray-400 text-sm p-2 px-3 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-black transition duration-200";
@endphp

<!-- Tipo Documento y Nro Documento -->
<div class="flex flex-col md:flex-row gap-4">
  <div class="w-full mx-2 flex-1">
    <select name="c_tipdoc" class="{{ $inputClass }}">
        <option value="" disabled {{ empty($data->c_tipdoc) ? 'selected' : '' }}>Tipo Documento</option>
        <option value="DNI" {{ ($data->c_tipdoc ?? '') == 'DNI' ? 'selected' : '' }}>DNI</option>
        <option value="CARNEEXT" {{ ($data->c_tipdoc ?? '') == 'CARNEEXT' ? 'selected' : '' }}>Carné de Extranjería</option>
        <option value="PARTNAC" {{ ($data->c_tipdoc ?? '') == 'PARTNAC' ? 'selected' : '' }}>Partida de Nacimiento</option>
        <option value="TITULO" {{ ($data->c_tipdoc ?? '') == 'TITULO' ? 'selected' : '' }}>Título profesional o grado de bachiller</option>
        <option value="PASPT" {{ ($data->c_tipdoc ?? '') == 'PASPT' ? 'selected' : '' }}>Pasaporte</option>
    </select>
</div>

  <div class="w-full mx-2 flex-1 ">
      <input type="text" name="c_numdoc" placeholder="Nro. Documento" value="{{ $data->c_numdoc ?? '' }}" class="{{ $inputClass }}" readonly>
  </div>
</div>

<!-- Nombres -->
<div class="mt-4 mx-2">
  <input type="text" name="c_nombres" placeholder="Nombres" value="{{ $data->c_nombres ?? '' }}" class="{{ $inputClass }}">
</div>

<!-- Apellido Paterno y Apellido Materno -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="text" name="c_apepat" placeholder="Apellido Paterno" value="{{ $data->c_apepat ?? '' }}" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="text" name="c_apemat" placeholder="Apellido Materno" value="{{ $data->c_apemat ?? '' }}" class="{{ $inputClass }}">
  </div>
</div>

<!-- Correo -->
<div class="mt-4 mx-2">
  <input type="email" name="c_email" placeholder="Correo Electrónico" value="{{ $data->c_email ?? '' }}" class="{{ $inputClass }}" readonly>
</div>

<!-- Dirección -->
<div class="mt-4 mx-2">
  <input type="text" name="c_dir" placeholder="Dirección" value="{{ $data->c_dir ?? '' }}" class="{{ $inputClass }}">
</div>

<!-- Sexo y Fecha de Nacimiento -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select name="c_sexo" class="{{ $inputClass }}">
      <option value="M" {{ ($data->c_sexo ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
      <option value="F" {{ ($data->c_sexo ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
  </select>
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="date" name="d_fecnac" placeholder="Fecha de Nacimiento" value="{{ $data->d_fecnac ?? '' }}" class="{{ $inputClass }}">
  </div>
</div>

<!-- Distrito -->
<div class="mt-4 mx-2">
  <select id="select-ubigeo" name="ubigeo" class="{{ $inputClass }}">
    <option value="" disabled selected>Seleccione Ubicación</option>
    @foreach($ubigeos as $ubigeo)
        <option value="{{ $ubigeo->codigo }}"
            {{ ($data->c_dptodom . $data->c_provdom . $data->c_distdom) == $ubigeo->codigo ? 'selected' : '' }}>
            {{ $ubigeo->nombre }}
        </option>
    @endforeach
  </select>
</div>

<!-- Celular -->
<div class="mt-4 mx-2 mb-4">
  <input type="text" name="c_celu" placeholder="Celular" value="{{ $data->c_celu ?? '' }}" class="{{ $inputClass }}">
</div>
