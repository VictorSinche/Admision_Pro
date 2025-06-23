@extends('layouts.app')

@section('content')
  <div class="grid grid-cols-3 gap-4 mb-4">
    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
  </div>
  <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
    <p class="text-2xl text-gray-400 dark:text-gray-500">
        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
    </p>
  </div>
  <div class="grid grid-cols-2 gap-4 mb-4">
    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
        <p class="text-2xl text-gray-400 dark:text-gray-500">
          <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
          </svg>
        </p>
    </div>
  </div>
  <a href="{{ url('/auth/microsoft') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
      Conectar con OneDrive
  </a>


@endsection
