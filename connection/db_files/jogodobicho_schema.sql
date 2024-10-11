  CREATE DATABASE if not exists jogodobicho;
  USE jogodobicho
  CREATE TABLE if not exists  Apostas (
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    aposta varchar(255),
    aposta_tipo varchar(255),
    valor int,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
  );

  CREATE TABLE if not exists  Users (
    id int PRIMARY KEY AUTO_INCREMENT,
    fullname varchar(255),
    dob date,
    gender varchar(255),
    mothername varchar(255),
    cpf varchar(255),
    email varchar(255),
    celular varchar(255),
    fixo varchar(255),
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

  CREATE TABLE if not exists  Credentials (
    username varchar(255) PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    password varchar(255),
    rootuser boolean,
    login_attempts int DEFAULT 0,
    locked_account boolean DEFAULT false,
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );


  CREATE TABLE if not exists  Adress (
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    cep varchar(255),
    street varchar(255),
    number varchar(255),
    city varchar(255),
    state varchar(255),
    complement varchar(255),
    neighborhood varchar(255),
    country varchar(255),
    updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

  CREATE TABLE if not exists userLog  (
    id int PRIMARY KEY AUTO_INCREMENT,
    session_id varchar(255),
    username varchar(255),
    login_at timestamp DEFAULT CURRENT_TIMESTAMP,
    logout_at timestamp ,
    TwoFA_Answer varchar(255)
  );

  CREATE TABLE if not exists Resultados  (
    id int PRIMARY KEY AUTO_INCREMENT,
    primeiro int,
    segundo int,
    terceiro int,
    quarto int,
    quinto int,
    horario int,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
  );

  CREATE TABLE if not exists  Animais (
    id int AUTO_INCREMENT,
    animal varchar(255) NOT NULL,
    grupo_id int,
    PRIMARY KEY AUTO_INCREMENT (id, animal)
  );

  CREATE TABLE if not exists  Grupos (
    id int AUTO_INCREMENT,
    grupo varchar(255) NOT NULL,
    PRIMARY KEY AUTO_INCREMENT (id, grupo)
  );

  ALTER TABLE Credentials ADD FOREIGN KEY (user_id) REFERENCES Users (id);

  ALTER TABLE TwoFactorAuth ADD FOREIGN KEY (user_id) REFERENCES Credentials (user_id);

  ALTER TABLE Adress ADD FOREIGN KEY (user_id) REFERENCES Users (id);

  ALTER TABLE userLog ADD FOREIGN KEY (username) REFERENCES Credentials (username);

  ALTER TABLE userLog ADD FOREIGN KEY (TwoFA_id) REFERENCES TwoFactorAuth (id);

  ALTER TABLE Animais ADD FOREIGN KEY (grupo_id) REFERENCES Grupos (id);

  ALTER TABLE Apostas ADD FOREIGN KEY (user_id) REFERENCES Users (id);
