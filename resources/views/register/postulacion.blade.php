<!-- Estilo base reutilizable para cada input -->
@php
    $inputClass = "placeholder-gray-400 text-sm p-2 px-3 w-full text-gray-800 border border-gray-200 rounded focus:outline-none focus:border-black transition duration-200";
@endphp

<!-- Colegio ubicación -->
<div class="mt-4 mx-2">
  <select id="select-ubigeo" name="c_colg_ubicacion" class="{{ $inputClass }}">
    <option value="" disabled selected>Seleccione Ubicación</option>
    @foreach($ubigeos as $ubigeo)
        <option value="{{ $ubigeo->nombre }}"
            {{ (isset($data) && $data->c_colg_ubicacion == $ubigeo->nombre) ? 'selected' : '' }}>
            {{ $ubigeo->nombre }}
        </option>
    @endforeach
  </select>
</div>


<!-- Colegio de procedencia -->
<div class="mt-4 mx-2">
  <input type="text" name="c_procedencia" placeholder="Colegio de Procedencia" value="" class="{{ $inputClass }}">
</div>

<!-- Año de egreso y tipo de institución -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="number" name="c_anoegreso" placeholder="Año de egreso" value="" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
    <select name="c_tippro" class="{{ $inputClass }}">
      <option value="" disabled selected>Tipo de institución</option>
      <option value="PAR">Particular</option>
        <option value="EST">Estatal</option>
    </select>
  </div>
</div>

<!-- Proceso de admisión -->
<div class="mt-4 mx-2">
  <select name="id_proceso" id="proceso_admision" class="{{ $inputClass }}">
    <option value="" disabled selected>Seleccione Proceso de admisión</option>
    @foreach($procesos as $proceso)
      <option value="{{ $proceso->id_proceso }}" data-codfac="{{ $proceso->c_codfac }}">
        {{ $proceso->c_nompro }}
      </option>
    @endforeach
  </select>
</div>

<!-- Modalidad y sede -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <!-- Modalidad de ingreso -->
    <select name="id_mod_ing" class="{{ $inputClass }}">
      <option value="" disabled selected>Modalidad de ingreso</option>
      @foreach ($modalidades as $modalidad)
        <option value="{{ $modalidad->id_mod_ing }}">
          {{ $modalidad->c_descri }}
        </option>
      @endforeach
    </select>  
  </div>
  <div class="w-full mx-2 flex-1">
    <select name="c_sedcod" class="{{ $inputClass }}">
        {{-- <option value="" disabled selected>Sede</option> --}}
        <option value="1" selected>Principal</option>
    </select>
  </div>
</div>

<!-- Programa de Interés -->
<div class="mt-4 mx-2">
  <select name="c_codesp1" id="programa_interes" class="{{ $inputClass }}">
    <option value="" disabled selected>Seleccione el Programa de Interés</option>
    @foreach ($especialidades as $esp)
      <option value="{{ $esp->codesp }}" data-codfac="{{ $esp->codfac }}">
        {{ $esp->nomesp }}
      </option>
    @endforeach
  </select>

  <!-- Campo oculto para guardar el codfac -->
  <input type="hidden" name="c_codfac1" id="input_codfac1">
</div>

<!-- Fuente de información -->
<div class="mt-4 mx-2">
  <select name="id_tab_alu_contact" class="{{ $inputClass }}">
      <option value="" disabled selected>¿Cómo se enteró del proceso de admisión?</option>
      <option value="TV">TELEVISIÓN</option>
      <option value="PANE">PANELES</option>
      <option value="WEB">INTERNET</option>
      <option value="AMIGOS">POR AMIGOS</option>
      <option value="OTRARAD"  >OTRAS</option>
      <option value="VOL">VOLANTES</option>
      <option value="ASE">ASESOR</option>
      <option value="FACEBOOK">FACEBOOK</option>
      <option value="FERIAS_VOC">FERIAS VOCACIONALES</option>
      <option value="GOOGLE">GOOGLE</option>
      <option value="INSTAGRAM">INSTAGRAM</option>
      <option value="PAGINA_WEB">PÁGINA WEB</option>
      <option value="TIKTOK">TIKTOK</option>
      <option value="TRAE_AMIGO">TRAE UN AMIGO</option>
  </select>
</div>

<!-- Turno, discapacidad, identidad étnica -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select name="id_tab_turno" class="{{ $inputClass }}">
        <option value="" disabled selected>Turno</option>
        <option value="M">Mañana</option>
        <option value="T">Tarde</option>
        <option value="N">Noche</option>
    </select>
  </div>
  {{-- <div class="w-full mx-2 flex-1">
    <select name="discapacidad" class="{{ $inputClass }}">
        <option value="" disabled selected>Condición Discapacidad</option>
        <option value="0">NO</option>
        <option value="1">SÍ</option>
    </select>
  </div> --}}
  <div class="w-full mx-2 flex-1">
    <select name="c_ietnica" class="{{ $inputClass }}">
        <option value="" disabled selected>Identidad Étnica</option>
        <option value="Q">Quechua</option>
        <option value="A">Aymara</option>
        <option value="N">Nativo o indígena de la Amazonía</option>
        <option value="P">Perteneciente a otro pueblo originario</option>
        <option value="AF">Afroperuano o afrodescendiente</option>
        <option value="M">Mestizo</option>
        <option value="O">Otros</option>
    </select>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const procesoSelect = document.getElementById('proceso_admision');
    const programaSelect = document.getElementById('programa_interes');
    const inputCodfac = document.getElementById('input_codfac1');

    // Guardamos todas las opciones originales
    const allProgramaOptions = Array.from(programaSelect.options).filter(opt => opt.value !== "");

    function filtrarProgramasPorFacultad(codfac) {
      programaSelect.innerHTML = '<option value="" disabled selected>Seleccione el Programa de Interés</option>';
      programaSelect.disabled = false;

      allProgramaOptions.forEach(opt => {
        if (opt.dataset.codfac === codfac) {
          programaSelect.appendChild(opt);
        }
      });
    }

    procesoSelect.addEventListener('change', function () {
      const selectedOption = this.options[this.selectedIndex];
      const codfac = selectedOption.dataset.codfac;

      if (codfac) {
        filtrarProgramasPorFacultad(codfac);
      } else {
        programaSelect.disabled = true;
        programaSelect.innerHTML = '<option value="" disabled selected>Seleccione primero un proceso</option>';
      }

      inputCodfac.value = codfac || '';
    });

    // Inicialmente deshabilitar y limpiar el select de programas
    programaSelect.disabled = true;
    programaSelect.innerHTML = '<option value="" disabled selected>Seleccione primero un proceso</option>';
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectPrograma = document.getElementById('programa_interes');
    const inputCodfac = document.getElementById('input_codfac1');

    if (selectPrograma && inputCodfac) {
      selectPrograma.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const codfac = selectedOption.dataset.codfac;
        inputCodfac.value = codfac;
      });
    }
  });
</script>
