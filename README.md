# 💪 FitCloud

<div align="center">

### Plataforma moderna de gerenciamento para academias

Sistema web completo desenvolvido para otimizar a gestão de academias, oferecendo controle inteligente de alunos, treinos, planos e mensalidades em uma interface moderna, responsiva e intuitiva.

<br>

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

</div>

---

## 📌 Sobre o projeto

O **FitCloud** é uma plataforma web desenvolvida para auxiliar no gerenciamento de academias, centralizando em um único sistema o controle de alunos, planos, treinos, mensalidades e pagamentos.

O projeto foi construído com foco em organização, praticidade e boa experiência de uso, oferecendo uma interface moderna para instrutores e alunos.

---

## 🚀 Funcionalidades

### 🔐 Autenticação e permissões

- Login seguro com controle de sessão
- Controle de acesso por perfil
- Middleware de autorização
- Perfis de usuário:
  - Instrutor
  - Aluno

### 👥 Gestão de alunos

- Cadastro de alunos
- Edição de informações
- Remoção de registros
- Controle de objetivo físico
- Associação entre usuário, aluno e matrícula

### 📋 Gestão de planos

- Cadastro de planos personalizados
- Definição de valor
- Frequência semanal
- Período
- Descrição do plano

### 🏋️ Banco de exercícios

- Cadastro de exercícios
- Organização por grupo muscular
- Estrutura preparada para vídeos e descrições

### 🧠 Gestão de treinos

- Criação de fichas personalizadas
- Seleção múltipla de exercícios
- Filtro por grupo muscular
- Definição de séries, repetições e carga
- Organização por tipo de treino

### 💰 Cálculo automático de mensalidade

| Frequência | Valor |
|---|---|
| 2x por semana | R$ 100 |
| 3x por semana | R$ 110 |
| 4x por semana | R$ 120 |
| 5x por semana | R$ 130 |
| 6x por semana | R$ 140 |
| 7x por semana | R$ 150 |

### 📄 Área do aluno

- Visualização da ficha de treino
- Consulta de mensalidades
- Acompanhamento de pagamentos
- Visualização de treinos ativos

### 💳 Módulo financeiro

- Controle de mensalidades
- Listagem de pagamentos
- Filtros financeiros
- Estrutura preparada para integração com:
  - PIX
  - Boleto
  - Asaas

### 📑 Exportação em PDF

- Geração automática da ficha de treino
- Layout otimizado para impressão
- Exportação via DomPDF

---

## 🎨 Interface

O sistema possui uma interface moderna e responsiva, com foco em usabilidade.

### Destaques

- Tema dark premium
- Dashboard administrativo
- Login personalizado
- Sidebar moderna
- Layout responsivo
- Animações e efeitos visuais suaves

---

## 🛠 Tecnologias utilizadas

### Backend

- PHP 8
- Laravel

### Frontend

- Blade
- Bootstrap 5
- JavaScript
- CSS3

### Banco de dados

- SQLite
- MySQL

### Bibliotecas

- Bootstrap Icons
- DomPDF

🏠 Dashboard
![Dashboard](./docs/dashboard.png)
🏋️ Gestão de Treinos
![Gestão de Treinos](./docs/treinos.png)
💰 Financeiro
![Financeiro](./docs/financeiro.png)
⚙️ Como executar o projeto
1. Clone o repositório
git clone https://github.com/claitomrodrigues/sistema-academia-laravel.git
2. Acesse a pasta do projeto
cd sistema-academia-laravel
3. Instale as dependências
composer install
4. Crie o arquivo de ambiente
cp .env.example .env

No Windows, se o comando acima não funcionar, use:

copy .env.example .env
5. Gere a chave da aplicação
php artisan key:generate
6. Configure o banco de dados
SQLite

Crie o arquivo:

database/database.sqlite

E configure no .env:

DB_CONNECTION=sqlite
MySQL

Configure no .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitcloud
DB_USERNAME=root
DB_PASSWORD=
7. Execute as migrations
php artisan migrate
8. Inicie o servidor
php artisan serve

Acesse:

http://127.0.0.1:8000
📌 Roadmap
 Integração completa com Asaas
 Pagamento via PIX
 Pagamento via boleto
 Dashboard analítico
 Relatórios financeiros
 Sistema de notificações
 Aplicativo mobile
 Controle de acesso
 Inteligência artificial para sugestão de treinos
👨‍💻 Desenvolvedor

Claitom Rodrigues

Full Stack Developer em formação
Estudante de Análise e Desenvolvimento de Sistemas

📄 Licença

Este projeto está sob a licença MIT.
