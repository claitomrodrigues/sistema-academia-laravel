<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Treino | FitCloud</title>

    <style>
        @page {
            margin: 28px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            background: #ffffff;
            font-size: 13px;
        }

        .header {
            background: #111827;
            color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .brand span {
            color: #ef4444;
        }

        .slogan {
            font-size: 12px;
            color: #d1d5db;
        }

        .title-box {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #374151;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .subtitle {
            color: #d1d5db;
            font-size: 12px;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 24px;
        }

        .info-card {
            background: #f3f4f6;
            border-left: 5px solid #ef4444;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .label {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .value {
            font-size: 14px;
            color: #111827;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 17px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 12px;
            border-bottom: 2px solid #ef4444;
            padding-bottom: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        thead {
            background: #111827;
            color: #ffffff;
        }

        th {
            padding: 12px 8px;
            font-size: 11px;
            text-transform: uppercase;
            text-align: center;
            border: 1px solid #111827;
        }

        td {
            padding: 11px 8px;
            border: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .exercise-name {
            text-align: left;
            font-weight: bold;
            color: #111827;
        }

        .group {
            color: #ef4444;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 8px;
            left: 28px;
            right: 28px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
        }

        .notes {
            margin-top: 24px;
            padding: 14px;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            font-size: 11px;
            color: #4b5563;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="brand">
            Fit<span>Cloud</span>
        </div>

        <div class="slogan">
            Transformando gestão em performance
        </div>

        <div class="title-box">
            <div class="title">
                Ficha de Treino
            </div>

            <div class="subtitle">
                Plano de exercícios personalizado para acompanhamento do aluno
            </div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <div class="label">Aluno</div>
            <div class="value">
                {{ $treino->aluno->user->name ?? $treino->aluno->nome }}
            </div>
        </div>

        <div class="info-card">
            <div class="label">Tipo do treino</div>
            <div class="value">
                Treino {{ $treino->tipo }}
            </div>
        </div>

        <div class="info-card">
            <div class="label">Status</div>
            <div class="value">
                <span class="status">
                    {{ $treino->status }}
                </span>
            </div>
        </div>

        <div class="info-card">
            <div class="label">Data de emissão</div>
            <div class="value">
                {{ now()->format('d/m/Y') }}
            </div>
        </div>
    </div>

    <div class="section-title">
        Exercícios do treino
    </div>

    <table>
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
            </tr>
        </thead>

        <tbody>
            @foreach($treino->itens as $item)
                <tr>
                    <td class="exercise-name">
                        {{ $item->exercicio->nome ?? '-' }}
                    </td>

                    <td class="group">
                        {{ $item->exercicio->grupo_muscular ?? '-' }}
                    </td>

                    <td>
                        {{ $item->series }}
                    </td>

                    <td>
                        {{ $item->reps }}
                    </td>

                    <td>
                        {{ $item->carga ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="notes">
        <strong>Observação:</strong>
        Execute os exercícios conforme orientação do instrutor. Ajustes de carga, séries ou repetições devem ser feitos de acordo com a evolução e segurança do aluno.
    </div>

    <div class="footer">
        FitCloud • Sistema de Gestão para Academias • {{ now()->format('Y') }}
    </div>

</body>
</html>