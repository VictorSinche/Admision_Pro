@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 shadow rounded-lg">
  <h2 class="text-lg font-bold mb-4">Buscar postulante por DNI</h2>

  <form action="{{ route('encargado.revisar') }}" method="GET" class="flex gap-4">
    <input type="text" name="dni" class="form-input w-full border rounded px-4 py-2" placeholder="Ingrese DNI..." required>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
      Buscar
    </button>
  </form>
</div>
@endsection
