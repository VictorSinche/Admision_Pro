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
  <input type="text" name="c_procedencia" placeholder="Colegio de Procedencia" value="{{ $data->c_procedencia ?? '' }}" class="{{ $inputClass }}">
</div>

<!-- Año de egreso y tipo de institución -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
      <input type="text" name="c_anoegreso" placeholder="Año de egreso" value="{{ $data->c_anoegreso ?? '' }}" class="{{ $inputClass }}">
  </div>
  <div class="w-full mx-2 flex-1">
    <select name="c_tippro" class="{{ $inputClass }}">
      <option value="" disabled {{ empty($data->c_tippro) ? 'selected' : '' }}>Tipo de institución</option>
      <option value="PAR" {{ ($data->c_tippro ?? '') == 'PAR' ? 'selected' : '' }}>Particular</option>
        <option value="EST" {{ ($data->c_tippro ?? '') == 'EST' ? 'selected' : '' }}>Estatal</option>
    </select>
  </div>
</div>

@php
  $procesoSeleccionado = null;
  foreach ($procesos as $proceso) {
      if (($data->id_proceso ?? request('id_proceso')) == $proceso->id_proceso) {
          $procesoSeleccionado = $proceso;
          break;
      }
  }
@endphp

<!-- Proceso de admisión -->
<div class="mt-4 mx-2">
  <!-- Campo visible con nombre -->
  <input type="text" class="{{ $inputClass }}"
         value="{{ $procesoSeleccionado->c_nompro ?? '' }}"
         placeholder="Nombre del proceso de admisión" readonly>

  <!-- Campo oculto con ID -->
  <input type="hidden" name="id_proceso"
         value="{{ $procesoSeleccionado->id_proceso ?? '' }}">
</div>


<!-- Modalidad y sede -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  @php
    $modalidadSeleccionada = null;
    foreach ($modalidades as $modalidad) {
        if (($data->id_mod_ing ?? request('id_mod_ing')) == $modalidad->id_mod_ing) {
            $modalidadSeleccionada = $modalidad;
            break;
        }
    }
  @endphp

  <div class="w-full mx-2 flex-1">
    <!-- Campo visible con nombre de la modalidad -->
    <input type="text" class="{{ $inputClass }}"
          value="{{ $modalidadSeleccionada->c_descri ?? '' }}"
          placeholder="Nombre de la modalidad" readonly>

    <!-- Campo oculto con el ID real -->
    <input type="hidden" name="id_mod_ing"
          value="{{ $modalidadSeleccionada->id_mod_ing ?? '' }}">
  </div>


  <div class="w-full mx-2 flex-1">
    <select name="c_sedcod" class="{{ $inputClass }}">
        <option value="" disabled selected>Sede</option>
        <option value="1" {{ ($data->c_sedcod ?? '') == '1' ? 'selected' : '' }}>Principal</option>
    </select>
  </div>
</div>

  @php
    $especialidadSeleccionada = null;
    foreach ($especialidades as $esp) {
        if (($data->c_codesp1 ?? request('c_codesp1')) == $esp->codesp) {
            $especialidadSeleccionada = $esp;
            break;
        }
    }
  @endphp

  <!-- Programa de interés -->
  <div class="mt-4 mx-2">
    <!-- Visible: nombre del programa -->
    <input type="text" class="{{ $inputClass }}"
          value="{{ $especialidadSeleccionada->nomesp ?? '' }}"
          placeholder="Nombre del programa de interés" readonly>

    <!-- Oculto: código de especialidad -->
    <input type="hidden" name="c_codesp1"
          value="{{ $especialidadSeleccionada->codesp ?? '' }}">
  </div>


<!-- Fuente de información -->
<div class="mt-4 mx-2">
  <select name="id_tab_alu_contact" class="{{ $inputClass }}">
      <option value="O" selected>¿Cómo se enteró del proceso de admisión?</option>
      <option value="TV" {{ ($data->id_tab_alu_contact ?? '') == 'TV' ? 'selected' : '' }} >TELEVISIÓN</option>
      <option value="PANE" {{ ($data->id_tab_alu_contact ?? '') == 'PANE' ? 'selected' : '' }} >PANELES</option>
      <option value="WEB" {{ ($data->id_tab_alu_contact ?? '') == 'WEB' ? 'selected' : '' }} >INTERNET</option>
      <option value="AMIGOS" {{ ($data->id_tab_alu_contact ?? '') == 'AMIGOS' ? 'selected' : '' }} >POR AMIGOS</option>
      <option value="OTRARAD" {{ ($data->id_tab_alu_contact ?? '') == 'OTRARAD' ? 'selected' : '' }} >OTRAS</option>
      <option value="VOL" {{ ($data->id_tab_alu_contact ?? '') == 'VOL' ? 'selected' : '' }} >VOLANTES</option>
      <option value="ASE" {{ ($data->id_tab_alu_contact ?? '') == 'ASE' ? 'selected' : '' }} >ASESOR</option>
      <option value="FACEBOOK" {{ ($data->id_tab_alu_contact ?? '') == 'FACEBOOK' ? 'selected' : '' }} >FACEBOOK</option>
      <option value="FERIAS_VOC" {{ ($data->id_tab_alu_contact ?? '') == 'FERIAS_VOC' ? 'selected' : '' }} >FERIAS VOCACIONALES</option>
      <option value="GOOGLE" {{ ($data->id_tab_alu_contact ?? '') == 'GOOGLE' ? 'selected' : '' }} >GOOGLE</option>
      <option value="INSTAGRAM" {{ ($data->id_tab_alu_contact ?? '') == 'INSTAGRAM' ? 'selected' : '' }} >INSTAGRAM</option>
      <option value="PAGINA_WEB" {{ ($data->id_tab_alu_contact ?? '') == 'PAGINA_WEB' ? 'selected' : '' }} >PÁGINA WEB</option>
      <option value="TIKTOK" {{ ($data->id_tab_alu_contact ?? '') == 'TIKTOK' ? 'selected' : '' }} >TIKTOK</option>
      <option value="TRAE_AMIGO" {{ ($data->id_tab_alu_contact ?? '') == 'TRAE_AMIGO' ? 'selected' : '' }} >TRAE UN AMIGO</option>
  </select>
</div>

<!-- Turno, discapacidad, identidad étnica -->
<div class="flex flex-col md:flex-row gap-4 mt-4">
  <div class="w-full mx-2 flex-1">
    <select name="id_tab_turno" class="{{ $inputClass }}">
        <option value="" disabled selected>Turno</option>
        <option value="M"  {{ ($data->id_tab_turno ?? '') == 'M' ? 'selected' : '' }}>Mañana</option>
        <option value="T" {{ ($data->id_tab_turno ?? '') == 'T' ? 'selected' : '' }}>Tarde</option>
        <option value="N" {{ ($data->id_tab_turno ?? '') == 'N' ? 'selected' : '' }}>Noche</option>
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
    <select name="etnia" class="{{ $inputClass }}">
      <option value="" disabled >Tipo Documento</option>
        <option value="" disabled {{ empty($data->c_ietnica) ? 'selected' : '' }}>Identidad Étnica</option>
        <option value="Q" {{ ($data->c_ietnica ?? '') == 'O' ? 'selected' : '' }}>Quechua</option>
        <option value="A" {{ ($data->c_ietnica ?? '') == 'A' ? 'selected' : '' }}>Aymara</option>
        <option value="N" {{ ($data->c_ietnica ?? '') == 'N' ? 'selected' : '' }}>Nativo o indígena de la Amazonía</option>
        <option value="P" {{ ($data->c_ietnica ?? '') == 'P' ? 'selected' : '' }}>Perteneciente a otro pueblo originario</option>
        <option value="AF"{{ ($data->c_ietnica ?? '') == 'AF' ? 'selected' : '' }}>Afroperuano o afrodescendiente</option>
        <option value="M" {{ ($data->c_ietnica ?? '') == 'M' ? 'selected' : '' }}>Mestizo</option>
        <option value="O" {{ ($data->c_ietnica ?? '') == 'O' ? 'selected' : '' }}>Otros</option>
    </select>
  </div>
</div>

{{-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const procesoSelect = document.getElementById('proceso_admision');
    const programaSelect = document.getElementById('programa_interes');
    const selectedPrograma = programaSelect.dataset.selected;

    const allProgramOptions = Array.from(programaSelect.querySelectorAll('option'))
        .filter(opt => opt.value !== "");

    function filtrarProgramasPorFacultad(codfacSeleccionado) {
        programaSelect.innerHTML = `
            <option value="" disabled ${!selectedPrograma ? 'selected' : ''}>
                Seleccione el Programa de Interés
            </option>
        `;

        let seleccionadoAgregado = false;

        allProgramOptions.forEach(opt => {
            const codfac = opt.dataset.codfac;
            const esSeleccionado = opt.value === selectedPrograma;

            if (codfac === codfacSeleccionado || esSeleccionado) {
                const clon = opt.cloneNode(true);
                if (esSeleccionado) {
                    clon.selected = true;
                    seleccionadoAgregado = true;
                }
                programaSelect.appendChild(clon);
            }
        });

        // Por si no se encontró en la lista (respaldo)
        if (!seleccionadoAgregado && selectedPrograma) {
            const original = allProgramOptions.find(opt => opt.value === selectedPrograma);
            if (original) {
                const clon = original.cloneNode(true);
                clon.selected = true;
                programaSelect.appendChild(clon);
            }
        }
    }

    procesoSelect.addEventListener('change', function () {
        const codfac = this.options[this.selectedIndex].dataset.codfac;
        if (codfac) filtrarProgramasPorFacultad(codfac);
    });

    const codfacInicial = procesoSelect.querySelector('option:checked')?.dataset.codfac;
    if (codfacInicial) {
        filtrarProgramasPorFacultad(codfacInicial);
    }
});

</script> --}}
