<style>
    .fit-page-header{margin-bottom:28px}.fit-page-title{color:#fff;font-size:34px;font-weight:900;margin-bottom:6px}.fit-page-subtitle{color:#9ca3af;margin:0}.fit-card{background:rgba(17,24,39,.92);border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:30px;box-shadow:0 20px 45px rgba(0,0,0,.28)}.presence-preview{background:linear-gradient(135deg,rgba(34,197,94,.14),rgba(59,130,246,.06));border:1px solid rgba(34,197,94,.14);border-radius:22px;padding:24px;margin-bottom:28px}.preview-label{color:#9ca3af;font-size:12px;text-transform:uppercase;font-weight:900;margin-bottom:8px;letter-spacing:.08em}.preview-title{color:#fff;font-size:28px;font-weight:900;margin-bottom:10px}.preview-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,.15);color:#86efac;padding:9px 14px;border-radius:999px;font-size:13px;font-weight:900}.section-title{color:#fff;font-size:20px;font-weight:900;margin-bottom:24px;display:flex;align-items:center;gap:10px}.section-title i{color:#4ade80}label{color:#d1d5db;font-weight:800;margin-bottom:8px}.form-control,.form-select{background:#020617;border:1px solid #1f2937;color:#fff;border-radius:14px;padding:13px 15px}.form-control:focus,.form-select:focus{background:#020617;color:#fff;border-color:#22c55e;box-shadow:0 0 0 .25rem rgba(34,197,94,.15)}.form-select option{background:#111827;color:#fff}.invalid-feedback{color:#86EFAC;font-weight:700}.is-invalid{border-color:#16A34A!important}.form-hint{color:#6b7280;font-size:13px;margin-top:6px}.divider{height:1px;background:rgba(255,255,255,.08);margin:28px 0}.actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:26px}.btn-fit-primary{background:linear-gradient(135deg,#22c55e,#15803d);border:none;color:#fff;border-radius:14px;padding:12px 22px;font-weight:900;transition:.2s;display:inline-flex;align-items:center;gap:8px}.btn-fit-primary:hover{transform:translateY(-1px);color:#fff;box-shadow:0 14px 30px rgba(34,197,94,.28)}.btn-fit-secondary{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.10);color:#e5e7eb;border-radius:14px;padding:12px 22px;font-weight:900;text-decoration:none;display:inline-flex;align-items:center;gap:8px}.btn-fit-secondary:hover{color:#fff;background:rgba(255,255,255,.13)}
</style>

<div class="fit-page-header">
    <h1 class="fit-page-title">{{ $titulo }}</h1>
    <p class="fit-page-subtitle">{{ $subtitulo }}</p>
</div>

<div class="fit-card">
    <div class="presence-preview">
        <div class="preview-label">Módulo de reengenharia</div>
        <div class="preview-title">Controle de frequência dos alunos</div>
        <span class="preview-badge"><i class="bi bi-calendar2-check-fill"></i> Nova funcionalidade</span>
    </div>

    <form method="POST" action="{{ $action }}">
        @csrf
        @if($method !== 'POST') @method($method) @endif

        <div class="section-title"><i class="bi bi-person-check-fill"></i> Dados da presença</div>

        <div class="row g-4">
            <div class="col-md-6">
                <label>Aluno</label>
                <select name="aluno_id" class="form-select @error('aluno_id') is-invalid @enderror" required>
                    <option value="">Selecione um aluno</option>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" @selected(old('aluno_id', optional($presenca)->aluno_id) == $aluno->id)>{{ $aluno->nome }}</option>
                    @endforeach
                </select>
                @error('aluno_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label>Data</label>
                <input type="date" name="data_presenca" value="{{ old('data_presenca', optional(optional($presenca)->data_presenca)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="form-control @error('data_presenca') is-invalid @enderror" required>
                @error('data_presenca')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label>Horário</label>
                <input type="time" name="horario" value="{{ old('horario', optional($presenca)->horario ? substr($presenca->horario, 0, 5) : now()->format('H:i')) }}" class="form-control @error('horario') is-invalid @enderror" required>
                @error('horario')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label>Observação</label>
                <input type="text" name="observacao" value="{{ old('observacao', optional($presenca)->observacao) }}" class="form-control @error('observacao') is-invalid @enderror" placeholder="Ex.: treino normal, avaliação física, reposição...">
                <div class="form-hint">Campo opcional para registrar alguma informação sobre a presença.</div>
                @error('observacao')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="divider"></div>

        <div class="actions">
            <button type="submit" class="btn-fit-primary"><i class="bi bi-check-circle-fill"></i> Salvar presença</button>
            <a href="{{ route('presencas.index') }}" class="btn-fit-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
        </div>
    </form>
</div>
