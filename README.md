# CRM Minimalista

Este projeto implementa um CRM simples para pequenas equipes de vendas (2 a 10 usuários). O objetivo é fornecer uma ferramenta leve e fácil de usar baseada em HTML5, CSS com estilo **Glassmorphism**, JavaScript puro e PHP/MySQL para o backend.

## Funcionalidades principais
- **Dashboard**: visão geral de tarefas, oportunidades e atividades recentes.
- **Contatos**: cadastro e gerenciamento de leads/clientes.
- **Tarefas**: atribuição e acompanhamento de atividades.
- **Oportunidades**: visualização em estilo Kanban para acompanhar o funil de vendas.

## Estrutura de diretórios
```
.
├── index.html             # Tela de login/registro
├── dashboard.html         # Dashboard principal
├── contatos.html          # Lista e cadastro de contatos
├── tarefas.html           # Lista de tarefas
├── kanban.html            # Pipeline de oportunidades
├── css/
│   └── style.css          # Estilos (Glassmorphism e responsividade)
├── js/
│   ├── main.js            # Funções JS principais
│   └── kanban.js          # Drag & drop do kanban
├── php/
│   ├── db.php             # Conexão PDO com MySQL
│   ├── contatos.php       # CRUD de contatos
│   ├── tarefas.php        # CRUD de tarefas
│   ├── oportunidades.php  # CRUD de oportunidades
│   └── auth.php           # Login/registro
```

## Configuração do banco
Edite `php/db.php` com as credenciais do seu banco MySQL:

```php
<?php
$host = 'localhost';
$db   = 'nome_do_banco';
$user = 'usuario';
$pass = 'senha';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```

Crie as tabelas MySQL a partir do seguinte esquema simplificado:

```sql
CREATE TABLE User (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Contact (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(255),
  company VARCHAR(255),
  notes TEXT,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  userId INT,
  FOREIGN KEY (userId) REFERENCES User(id)
);

CREATE TABLE Task (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  dueDate DATETIME,
  completed BOOLEAN DEFAULT FALSE,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  userId INT,
  FOREIGN KEY (userId) REFERENCES User(id)
);

CREATE TABLE Opportunity (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  stage VARCHAR(255),
  value FLOAT,
  createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  contactId INT,
  userId INT,
  FOREIGN KEY (contactId) REFERENCES Contact(id),
  FOREIGN KEY (userId) REFERENCES User(id)
);
```

Após configurar o banco, abra `dashboard.html` no navegador para começar a usar o CRM (é recomendável servir os arquivos via servidor PHP).
