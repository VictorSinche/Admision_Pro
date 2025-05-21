{{-- Cargar formulario según modalidad (sin subcarpeta) --}}
@includeIf('declaracionJurada.' . strtolower($modalidad))