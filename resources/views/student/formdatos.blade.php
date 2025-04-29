<form action="" class="form bg-white p-6 rounded-md shadow-sm">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  
      <!-- Tipo de Documento -->
      <div>
        <select id="tipoDocumento" name="tipoDocumento" class="border p-2 w-full rounded-md">
          <option value="">Seleccione...</option>
          <option value="dni">DNI</option>
          <option value="ce">Carnet de Extranjería</option>
          <option value="pasaporte">Pasaporte</option>
        </select>
      </div>
  
      <!-- Número de Documento -->
      <div>
        <input type="text" id="nroDocumento" name="nroDocumento" placeholder="Ej: 12345678"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Nombres -->
      <div>
        <input type="text" id="nombres" name="nombres" placeholder="Tus nombres"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Apellido Paterno -->
      <div>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno" placeholder="Ej: Torres"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Apellido Materno -->
      <div>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno" placeholder="Ej: Vargas"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Correo -->
      <div>
        <input type="email" id="correo" name="correo" placeholder="tucorreo@email.com"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Dirección -->
      <div>
        <input type="text" id="direccion" name="direccion" placeholder="Tu dirección"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Sexo -->
      <div>
        <select id="sexo" name="sexo" class="border p-2 w-full rounded-md">
          <option value="">Seleccione...</option>
          <option value="M">Masculino</option>
          <option value="F">Femenino</option>
          <option value="O">Otro</option>
        </select>
      </div>
  
      <!-- Fecha de Nacimiento -->
      <div>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento"
          class="border p-2 w-full rounded-md">
      </div>
  
      <!-- Distrito -->
      <div>
        <select id="distrito" name="distrito" class="border p-2 w-full rounded-md">
          <option value="">Seleccione...</option>
          <option value="SJM">San Juan de Miraflores</option>
          <option value="SJL">San Juan de Lurigancho</option>
          <option value="SMP">San Martín de Porres</option>
        </select>
      </div>
  
      <!-- Celular -->
      <div>
        <input type="tel" id="celular" name="celular" placeholder="Ej: 987654321"
          class="border p-2 w-full rounded-md">
      </div>
  
    </div>
  </form>
  