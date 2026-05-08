# FitCloud | Gym Management System

[![Laravel](https://shields.io)](https://laravel.com)
[![PHP](https://shields.io)](https://php.net)
[![Bootstrap](https://shields.io)](https://getbootstrap.com)
[![MySQL](https://shields.io)](https://mysql.com)
[![License](https://shields.io)](LICENSE)

O **FitCloud** é uma plataforma robusta de gestão para academias, projetada para centralizar o controle operacional e financeiro. O sistema oferece uma interface responsiva para instrutores e alunos, otimizando o acompanhamento de treinos e a gestão de mensalidades.

---

## 🛠 Tecnologias e Dependências

### Core Stack
*   **Backend:** PHP 8.x + Laravel Framework
*   **Frontend:** Blade Templates, JavaScript, CSS3
*   **UI/UX:** Bootstrap 5 & Bootstrap Icons
*   **Database:** Suporte nativo para SQLite e MySQL

### Bibliotecas Adicionais
*   **DomPDF:** Geração de fichas de treino em PDF
*   **Middleware:** Controle de autenticação e níveis de acesso

---

## ⚙️ Funcionalidades Principais

### Gestão Administrativa e Instrutores
*   **Controle de Acesso:** Autenticação segura com perfis distintos (Instrutor/Aluno).
*   **Gestão de Alunos:** Ciclo completo de cadastro, edição e associação de matrículas.
*   **Banco de Exercícios:** Catálogo organizado por grupos musculares.
*   **Prescrição de Treinos:** Montagem de fichas personalizadas com séries, repetições e carga.
*   **Módulo Financeiro:** Gestão de planos e fluxos de pagamentos.

### Experiência do Aluno
*   **Dashboard do Aluno:** Visualização de treinos ativos e evolução física.
*   **Financeiro:** Consulta de histórico de pagamentos e status de mensalidade.
*   **Portabilidade:** Exportação de fichas de treino em PDF otimizadas para dispositivos móveis ou impressão.

---

## 📊 Estrutura de Planos


| Frequência Semanal | Valor Mensal |
| :--- | :--- |
| 2 dias | R$ 100,00 |
| 3 dias | R$ 110,00 |
| 5 dias | R$ 130,00 |
| 7 dias | R$ 150,00 |

---

## 🚀 Instalação e Configuração

### Requisitos Prévios
*   PHP >= 8.1
*   Composer
*   Servidor de Banco de Dados (MySQL ou SQLite)

### Passo a Passo

1. **Clonagem do repositório:**
   ```bash
   git clone https://github.com/claitomrodrigues/sistema-academia-laravel.git
   cd sistema-academia-laravel
   ```

2. **Gerenciamento de dependências:**
   ```bash
   composer install
   ```

3. **Configuração de ambiente:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Banco de Dados:**
   No arquivo `.env`, configure suas credenciais. Para SQLite:
   ```env
   DB_CONNECTION=sqlite
   # Crie o arquivo database/database.sqlite manualmente
   ```

5. **Migração e Inicialização:**
   ```bash
   php artisan migrate
   php artisan serve
   ```
   Acesse: `http://localhost:8000`

---

## 🏗 Roadmap de Desenvolvimento

*   [ ] Integração com Gateway de Pagamento (Asaas/PIX)
*   [ ] Dashboard analítico com gráficos de faturamento
*   [ ] Sistema de notificações push via WhatsApp/E-mail
*   [ ] IA para sugestão baseada em biotipo
*   [ ] Módulo de avaliação física (Antropometria)

---

## 👤 Desenvolvedor

**Claitom Rodrigues**
*Full Stack Developer em formação*
[LinkedIn](https://linkedin.com) | [Portfolio](https://seu-portfolio.com)

---

## 📄 Licença

Este projeto é distribuído sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.
