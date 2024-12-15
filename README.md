# Aplicação Web CRUD - Windows

## Visão Geral
Este projeto é uma aplicação web desenvolvida apenas para estudos, com inspiração no site da empresa A Visual Supply Company (VSCO). A aplicação permite aos usuários realizar operações básicas de CRUD (Criar, Ler, Atualizar, Deletar) para:

1. **Postagens**: Usuários podem criar, visualizar, atualizar e deletar suas postagens.
2. **Perfis**: Usuários podem gerenciar as informações do próprio perfil.

O foco da aplicação é a simplicidade e eficiência, fornecendo uma interface intuitiva para a gestão de conteúdo.

---

## Funcionalidades

### Postagens
- **Criar**: Permite aos usuários adicionar novas postagens com descrições e anexos opcionais.
- **Ler**: Visualizar postagens com detalhes.
- **Atualizar**: Editar postagens existentes, incluindo somente a descrição.
- **Deletar**: Remover postagens permanentemente com confirmação.

### Perfis
- **Criar**: Registrar e criar um perfil pessoal.
- **Ler**: Visualizar o perfil.
- **Atualizar**: Editar informações do perfil, como nome e foto de perfil.
- **Deletar**: Remover o perfil permanentemente junto com todas as postagens associadas.

---

## Tecnologias Utilizadas

- **Frontend**:
  - HTML
  - CSS
  - JavaScript

- **Backend**:
  - PHP (Controllers, DAO)

- **Banco de Dados**:
  - MySQL (para armazenamento de postagens, dados de usuários e relacionamentos)

---

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/Joao-souto/projetoWeb.git
   ```

2. Acesse o diretório do projeto:
   ```bash
   cd projetoWeb
   ```

3. Configure o banco de dados:
   - Crie o banco de dados no seu servidor MySQL, script de criação está em model/db.sql.
   - Configure o arquivo `util/Connection.php` com as credenciais do banco de dados.

4. Inicie a aplicação usando O servidor local XAMPP:
   - Coloque o projeto no diretório raiz do servidor (`htdocs`).
   - Acesse a aplicação via `http://localhost/projetoWeb/`.

---

## Uso

- **Registrar**: Crie uma conta de usuário.
- **Entrar**: Acesse seu perfil e postagens.
- **CRUD**: Use a interface intuitiva para gerenciar postagens e informações do perfil.

---

## Contribuição
Pull requests são bem-vindos. Para mudanças maiores, abra uma issue primeiro para discutir o que você gostaria de modificar.

---

## Licença
Este projeto é open-source e está disponível sob a [Licença MIT](LICENSE).