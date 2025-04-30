@extends('layouts.app')

@section('content')
<div class="text-left bg-white shadow-lg border border-gray-300 rounded-lg p-6">
  <h1 class="text-2xl font-bold text-black mb-4">
      Finalizar Pago - Datos de Tarjeta
  </h1>
  <p class="text-gray-600 text-lg">
      Victor Sinche, tu transacción está protegida. Completa los datos de tu tarjeta de crédito/débito para confirmar tu compra de manera segura.
  </p>
</div>

<div class="max-w-md mx-auto bg-white border-gray-300 shadow-md overflow-hidden md:max-w-2xl mt-5 text-lef border rounded-lg p-6">
  <div class="p-8">
      <div class="flex items-center justify-between">
          <h1 class="text-2xl font-bold text-gray-800">Pago del Servicio</h1>
          {{-- <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">Paso 3 de 3</span> --}}
      </div>
      
      <p class="mt-2 text-gray-600">Complete los detalles de su tarjeta para finalizar el pago</p>
      
      <div class="mt-6 border-t border-gray-200 pt-6">
          <h2 class="text-lg font-medium text-gray-900">Información de Pago</h2>
          
          <form class="mt-4 space-y-6">
              <div>
                  <label for="card-number" class="block text-sm font-medium text-gray-700">Número de Tarjeta</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                      <input type="text" id="card-number" name="card-number" 
                            class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-4 pr-12 py-3 border-gray-300 rounded-md" 
                            placeholder="1234 5678 9012 3456">
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                              <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                          </svg>
                      </div>
                  </div>
              </div>
              
              <div class="grid grid-cols-2 gap-4">
                  <div>
                      <label for="expiry" class="block text-sm font-medium text-gray-700">Fecha de Expiración</label>
                      <input type="text" id="expiry" name="expiry" 
                            class="focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 border-gray-300 rounded-md" 
                            placeholder="MM/AA">
                  </div>
                  <div>
                      <label for="cvc" class="block text-sm font-medium text-gray-700">Código CVC</label>
                      <input type="text" id="cvc" name="cvc" 
                            class="focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 border-gray-300 rounded-md" 
                            placeholder="123">
                  </div>
              </div>
              
              <div>
                  <label for="card-name" class="block text-sm font-medium text-gray-700">Nombre en la Tarjeta</label>
                  <input type="text" id="card-name" name="card-name" 
                        class="focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 border-gray-300 rounded-md mt-1" 
                        placeholder="Juan Pérez">
              </div>
              
              <div class="flex items-center">
                  <input id="save-card" name="save-card" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                  <label for="save-card" class="ml-2 block text-sm text-gray-700">Guardar esta tarjeta para futuros pagos</label>
              </div>
              
              <div class="pt-4">
                  <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                      Pagar $99.00
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection