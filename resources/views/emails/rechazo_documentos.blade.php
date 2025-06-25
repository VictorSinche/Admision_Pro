<h2>Estimado/a {{ $postulante->c_nombres }}</h2>

<p>Hemos revisado tus documentos enviados para el proceso de admisión. A continuación, te detallamos el estado de tus archivos:</p>

<table cellpadding="8" cellspacing="0" border="0" width="100%" style="border-collapse: collapse; margin-top: 16px;">
    <thead>
        <tr style="background-color: #f0f0f0; text-align: left;">
            <th style="border-bottom: 2px solid #ddd;">Documento</th>
            <th style="border-bottom: 2px solid #ddd;">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($todosLosCampos as $campo)
            <tr>
                <td style="border-bottom: 1px solid #eee;">{{ strtoupper($campo) }}</td>
                <td style="border-bottom: 1px solid #eee;">
                    @php
                        $estado = $estados[$campo] ?? 0;
                    @endphp

                    @if($estado == 1)
                        ❌ Observado
                    @elseif($estado == 2)
                        ✅ Válido
                    @else
                        ⏳ No enviado
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if(!empty($motivo))
    <p style="margin-top: 20px;"><strong>Observaciones adicionales:</strong></p>
    <p style="background:#f8f8f8; padding:10px; border-left:4px solid #e72352;">{{ $motivo }}</p>
@endif

<p style="margin-top: 20px;">Por favor, ingresa a la plataforma y vuelve a subir los documentos observados o pendientes.</p>

<p>Atentamente,<br>Comité de Admisión UMA</p>
