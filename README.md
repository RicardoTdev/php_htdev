# 🏦 Banco PHP

Sistema bancário desenvolvido em PHP com foco no aprendizado de **Programação Orientada a Objetos (POO)**.

O projeto simula operações básicas de uma conta bancária, utilizando PHP, sessões e arquivos JSON para armazenamento dos dados.

---

## 📚 Sobre o projeto

Este projeto foi desenvolvido como parte dos estudos de **PHP e Programação Orientada a Objetos**.

A aplicação permite que um usuário faça login e realize operações básicas em sua conta bancária, como:

- consultar saldo;
- realizar depósitos;
- realizar saques;
- visualizar transações;
- encerrar a sessão.

O projeto também utiliza classes para representar a conta bancária e as transações realizadas.

---

## ⚙️ Funcionalidades

### 🔐 Autenticação

- Login de usuário;
- Controle de sessão com `$_SESSION`;
- Logout;
- Proteção da página da conta para usuários não autenticados.

### 💰 Conta bancária

- Visualização do número da conta;
- Visualização do tipo da conta;
- Visualização do saldo;
- Visualização do status da conta.

### 💵 Operações

- Depósito;
- Saque;
- Validação de valores;
- Verificação de saldo disponível;
- Atualização do saldo.

### 📄 Transações

Cada operação realizada pode ser registrada contendo informações como:

- usuário;
- tipo da operação;
- valor;
- saldo anterior;
- saldo atual;
- data;
- descrição.

---

## 🧱 Programação Orientada a Objetos

O projeto utiliza conceitos de **POO em PHP**.

### Classe `ContaBanco`

A classe `ContaBanco` representa uma conta bancária.

Ela possui atributos relacionados à conta, como:

- número da conta;
- tipo;
- dono;
- saldo;
- status.

Também possui métodos responsáveis pelas operações da conta:

```php
abrirConta()
fecharConta()
depositar()
sacar()
pagarMensal()
```

Além disso, utiliza getters e setters para acessar e modificar os atributos encapsulados.

---

### Classe `Transacao`

A classe `Transacao` representa uma operação realizada na conta.

Ela possui informações como:

```text
usuário
tipo
valor
saldo anterior
saldo atual
data
descrição
```

A classe também possui o método:

```php
paraArray()
```

Esse método transforma o objeto `Transacao` em um array para que ele possa ser armazenado no arquivo JSON.

---

## 🔄 Fluxo do sistema

O funcionamento básico da aplicação segue este fluxo:

```text
                    ┌─────────────┐
                    │  index.php  │
                    │    Login    │
                    └──────┬──────┘
                           │
                           ▼
                    ┌─────────────┐
                    │  login.php  │
                    │  Validação  │
                    └──────┬──────┘
                           │
                           ▼
                  ┌──────────────────┐
                  │ usuarios.json    │
                  │ Dados do usuário │
                  └────────┬─────────┘
                           │
                     Login válido
                           │
                           ▼
                    ┌─────────────┐
                    │  conta.php  │
                    │  Dashboard  │
                    └──────┬──────┘
                           │
                 ┌─────────┴─────────┐
                 │                   │
                 ▼                   ▼
          ┌─────────────┐     ┌─────────────┐
          │depositar.php│     │  sacar.php  │
          └──────┬──────┘     └──────┬──────┘
                 │                   │
                 └─────────┬─────────┘
                           │
                           ▼
                   ┌────────────────┐
                   │transacoes.json │
                   │    Extrato     │
                   └────────────────┘
```

---

## 🗂️ Estrutura do projeto

```text
PHP_HTDEV/
│
├── app/
│   └── classes/
│       ├── ContaBanco.php
│       └── Transacao.php
│
├── assets/
│   └── css/
│       └── style.css
│
├── data/
│   ├── transacoes.json
│   └── usuarios.json
│
├── conta.php
├── depositar.php
├── index.php
├── login.php
├── logout.php
├── sacar.php
├── .gitignore
└── README.md
```

---

## 📁 Organização das pastas

### `app/classes`

Contém as classes utilizadas pelo sistema.

```text
app/classes/
├── ContaBanco.php
└── Transacao.php
```

---

### `assets/css`

Contém os arquivos responsáveis pela aparência da aplicação.

```text
assets/css/
└── style.css
```

---

### `data`

Contém os arquivos JSON utilizados para armazenar os dados da aplicação.

```text
data/
├── usuarios.json
└── transacoes.json
```

---

## 🛠️ Tecnologias utilizadas

- **PHP 8.2+**
- **HTML5**
- **CSS3**
- **JSON**
- **Git**
- **GitHub**
- **XAMPP**
- **Visual Studio Code**

---

## ▶️ Como executar o projeto

### 1. Instalar o XAMPP

Instale o XAMPP para utilizar o Apache e executar o PHP localmente.

---

### 2. Colocar o projeto no `htdocs`

Coloque a pasta do projeto dentro de:

```text
C:\xampp\htdocs\
```

A estrutura deve ficar semelhante a:

```text
C:\xampp\htdocs\php_htdev\
```

---

### 3. Iniciar o Apache

Abra o XAMPP Control Panel e inicie:

```text
Apache
```

---

### 4. Abrir o projeto

No navegador, acesse:

```text
http://localhost/php_htdev/
```

---

## 👤 Usuários para teste

O projeto possui usuários de demonstração para testes locais.

### Usuário 1

```text
Usuário: joao
Senha: 1234
```

### Usuário 2

```text
Usuário: victoria
Senha: 1234
```

> Os usuários acima são utilizados apenas para testes e demonstração do projeto.

---

## 💡 Exemplo de utilização

Depois de realizar o login, o usuário acessa sua conta e pode realizar um depósito.

Exemplo:

```text
Saldo anterior: R$ 150,00

Depósito: R$ 80,00

Saldo atual: R$ 230,00
```

A operação é registrada no arquivo:

```text
data/transacoes.json
```

Da mesma forma, ao realizar um saque:

```text
Saldo anterior: R$ 230,00

Saque: R$ 50,00

Saldo atual: R$ 180,00
```

A transação também pode ser registrada no histórico.

---

## 🔐 Encapsulamento

A classe `ContaBanco` utiliza diferentes níveis de acesso para seus atributos:

```php
public
protected
private
```

Exemplo:

```php
private $saldo;
```

O saldo não é acessado diretamente de fora da classe.

Para acessar seu valor, são utilizados métodos:

```php
$getSaldo()
```

e:

```php
setSaldo()
```

Isso permite praticar o conceito de **encapsulamento** da Programação Orientada a Objetos.

---

## 📦 Armazenamento dos dados

Neste projeto, os dados são armazenados em arquivos JSON.

### Usuários

```text
data/usuarios.json
```

### Transações

```text
data/transacoes.json
```

O PHP utiliza funções como:

```php
file_get_contents()
```

para ler os arquivos e:

```php
file_put_contents()
```

para salvar os dados.

Também são utilizadas:

```php
json_decode()
```

para transformar JSON em array PHP e:

```php
json_encode()
```

para transformar arrays PHP em JSON.

---

## 🔄 Exemplo do processo de depósito

O fluxo de um depósito funciona da seguinte maneira:

```text
Formulário
    ↓
depositar.php
    ↓
usuarios.json
    ↓
ContaBanco
    ↓
depositar()
    ↓
Novo saldo
    ↓
Transacao
    ↓
transacoes.json
    ↓
conta.php
```

---

## 🔄 Exemplo do processo de saque

```text
Formulário
    ↓
sacar.php
    ↓
usuarios.json
    ↓
ContaBanco
    ↓
sacar()
    ↓
Novo saldo
    ↓
Transacao
    ↓
transacoes.json
    ↓
conta.php
```

---

## 📖 Objetivo educacional

O principal objetivo deste projeto é colocar em prática conhecimentos de:

- PHP;
- Programação Orientada a Objetos;
- Classes;
- Objetos;
- Atributos;
- Métodos;
- Encapsulamento;
- Getters e setters;
- Construtores;
- Sessões;
- Formulários;
- Requisições `POST`;
- Manipulação de arquivos;
- JSON;
- Organização de projetos;
- Git e GitHub.

---

## 🚧 Status do projeto

**Em desenvolvimento.**

O projeto continuará recebendo melhorias conforme novos conceitos de PHP e Programação Orientada a Objetos forem estudados.

Possíveis melhorias futuras:

- cadastro de novos usuários;
- senha utilizando `password_hash()`;
- validações mais completas;
- mensagens de sucesso e erro;
- histórico completo de transações;
- transferência entre contas;
- banco de dados MySQL;
- arquitetura MVC;
- Composer;
- autoload com PSR-4;
- melhorias na interface.

---

## 👨‍💻 Autor

Projeto desenvolvido para estudos de **PHP e Programação Orientada a Objetos**.

---

## 📌 Observação

Este projeto possui finalidade **educacional** e não deve ser utilizado como sistema bancário real.