@extends('layouts.app')

@section('title', 'Financeiro')

@section('content')

<div class="container mt-4">
    <h2>Controle Financeiro</h2>

    <table class="table table-dark table-striped mt-3">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->matricula->aluno->user->name ?? 'Aluno não encontrado' }}</td>
                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}</td>
                    <td>
                        @if($pagamento->status == 'pago')
                            <span class="badge bg-success">Pago</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendente</span>
                        @endif
                    </td>

                    <td>
                        @if(auth()->user()->role === 'instrutor')
                            @if($pagamento->status != 'pago')
                                <form action="{{ route('financeiro.pagar', $pagamento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Marcar como pago</button>
                                </form>
                            @endif

                            <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                                <input type="hidden" name="metodo" value="pix">
                                <button class="btn btn-danger btn-sm">Gerar Pix</button>
                            </form>

                            <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                                <input type="hidden" name="metodo" value="boleto">
                                <button class="btn btn-warning btn-sm">Gerar Boleto</button>
                            </form>
                        @else
                            <span class="text-muted">Somente visualização</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Nenhum pagamento encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>

@endsection