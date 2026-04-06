@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-section">
        <h2><i class="fi fi-rr-search-alt"></i> Bitácora de Auditoría</h2>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>Fecha/Hora</th>
                <th>Usuario</th>
                <th>Evento</th>
                <th>Módulo/Modelo</th>
                <th>IP</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
            <tr>
                <td>{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                <td>
                    <span class="user-info">
                        <i class="fi fi-rr-user"></i> {{ $audit->user->name ?? 'Sistema/Invitado' }}
                    </span>
                </td>
                <td>
                    <span class="badge-event {{ $audit->event }}">
                        {{ strtoupper($audit->event) }}
                    </span>
                </td>
                <td>{{ class_basename($audit->auditable_type) ?: 'N/A' }}</td>
                <td><code>{{ $audit->ip_address }}</code></td>
                <td>
                    <button class="btn-icon info" onclick="viewAuditDetails({{ $audit->id }})">
                        <i class="fi fi-rr-eye"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $audits->links() }}
    </div>
</div>

<div id="modalAudit" class="modal-overlay" style="display:none;">
    <div class="modal-content wide">
        <h3>Detalles del Movimiento</h3>
        <div id="auditContent">
            <pre id="jsonViewer" class="json-block"></pre>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="closeModal('modalAudit')">Cerrar</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/modules/audit.js') }}"></script>
@endpush