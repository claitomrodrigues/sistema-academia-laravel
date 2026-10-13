@extends('layouts.app')

@section('title', 'Painel SuperAdmin')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="h3 fw-bold">Gestão do SaaS</h1>
            <p class="text-muted mb-0">Visão geral das academias cadastradas na plataforma.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase fw-bold">Academias</div>
                        <div class="display-6 fw-bold">{{ $tenants->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase fw-bold">Usuários da plataforma</div>
                        <div class="display-6 fw-bold">{{ $totalUsers }}</div>
                    </div>
                </div>
            </div>
        </div>

        <section class="card border-0 shadow-sm">
            <div class="card-body">
                <h2 class="h5 fw-bold mb-3">Academias</h2>
                @forelse($tenants as $tenant)
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $tenant->name }}</div>
                            <small class="text-muted">{{ $tenant->slug }}</small>
                        </div>
                        <span class="badge text-bg-{{ $tenant->status === 'active' ? 'success' : 'secondary' }}">
                            {{ $tenant->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-muted mb-0">Nenhuma academia cadastrada.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
