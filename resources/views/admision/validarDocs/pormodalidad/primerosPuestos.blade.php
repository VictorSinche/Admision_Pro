<div class="modalidad-tab" data-mod="B">
    <div class="p-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nro
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        DNI
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nombre Completo
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Carrera
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Ver docs.
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Formulario
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Pago
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DNI
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Seguro
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Constancia
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Merito
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DJ
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Acciones
                        </p>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postulantesModalidad as $i => $postulante)
                        <tr data-dni="{{ $postulante->c_numdoc }}">
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $i + 1 }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $postulante->c_numdoc }}</td>
                                    </p>
                                </div>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ Str::title($postulante->c_nombres . ' ' . $postulante->c_apepat . ' ' . $postulante->c_apemat) }}</td>
                                    </p>
                                </div>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700" title="{{ $postulante->nomesp }}">
                                        {{ \Illuminate\Support\Str::limit($postulante->nomesp, 20, '...') }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center">
                                <a href="javascript:void(0);" onclick="abrirModalDocumentos('{{ $postulante->c_numdoc }}')" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-yellow-600 rounded hover:bg-yellow-700 transition">
                                    <i class="fa-solid fa-folder-open"></i>
                                </a>
                            </td>
                            @php $verif = $postulante->verificacion; @endphp

                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->formulario ?? 'null' }}" data-campo="formulario">
                                {!! mostrarIconoVerificacion($verif->formulario ?? null) !!}
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->pago ?? 'null' }}" data-campo="pago">
                                {!! mostrarIconoVerificacion($verif->pago ?? null) !!}
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->dni ?? 'null' }}" data-campo="dni">
                                {!! mostrarIconoVerificacion($verif->dni ?? null) !!}
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->seguro ?? 'null' }}" data-campo="seguro">
                                {!! mostrarIconoVerificacion($verif->seguro ?? null) !!}
                            </td>
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->constancia ?? 'null' }}" data-campo="constancia">
                                {!! mostrarIconoVerificacion($verif->constancia ?? null) !!}
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->merito ?? 'null' }}" data-campo="merito">
                                {!! mostrarIconoVerificacion($verif->merito ?? null) !!}
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center" data-estado="{{ $verif->dj ?? 'null' }}" data-campo="dj">
                                {!! mostrarIconoVerificacion($verif->dj ?? null) !!}
                            </td>
                                <td class="p-4 border-b border-slate-200 text-center">
                                    <div class="flex gap-2 justify-center">
                                        @if($postulante->verificacion && $postulante->verificacion->notificado)
                                            <a href="javascript:void(0);"
                                                title="Reenviar notificación"
                                                onclick="confirmarReenvio('{{ $postulante->c_numdoc }}')"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                                <i class="fa-solid fa-envelope-circle-check"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                                onclick="abrirModalNotificacion('{{ $postulante->c_numdoc }}')"
                                                data-accion="notificar"
                                                title="Notificar"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                                <i class="fa-solid fa-paper-plane" data-icono></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                        </tr>
                    {{-- </form> --}}
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
