<!-- Estilo base reutilizable para cada input -->
@php
    $inputClass = "placeholder-gray-400 text-sm p-2 px-3 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-black transition duration-200";
@endphp

<!-- Tipo Documento y Nro Documento -->
<div class="flex flex-col md:flex-row gap-4">
  <div class="w-full mx-2 flex-1">
      <select class="{{ $inputClass }}">
          <option value="" disabled selected>Tipo Documento</option>
          <option value="DNI">DNI</option>
          <option value="CE">Carné de Extranjería</option>
          <option value="Pasaporte">Pasaporte</option>
          <option value="Otro">Otro</option>
      </select>
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="text" placeholder="Nro. Documento" class="{{ $inputClass }}">
  </div>
</div>

<!-- Nombres -->
<div class="mt-4 mx-2">
  <input type="text" placeholder="Nombres" class="{{ $inputClass }}">
</div>

<!-- Apellido Paterno y Apellido Materno -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="text" placeholder="Apellido Paterno" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="text" placeholder="Apellido Materno" class="{{ $inputClass }}">
  </div>
</div>

<!-- Correo -->
<div class="mt-4 mx-2">
  <input type="email" placeholder="Correo Electrónico" class="{{ $inputClass }}">
</div>

<!-- Dirección -->
<div class="mt-4 mx-2">
  <input type="text" placeholder="Dirección" class="{{ $inputClass }}">
</div>

<!-- Sexo y Fecha de Nacimiento -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <select class="{{ $inputClass }}">
          <option value="" disabled selected>Sexo</option>
          <option value="M">Masculino</option>
          <option value="F">Femenino</option>
          <option value="O">Otro</option>
      </select>
  </div>
  <div class="w-full mx-2 flex-1">
      <input type="date" placeholder="Fecha de Nacimiento" class="{{ $inputClass }}">
  </div>
</div>

<!-- Distrito -->
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

<!-- Celular -->
<div class="mt-4 mx-2 mb-4">
  <input type="text" placeholder="Celular" class="{{ $inputClass }}">
</div>
