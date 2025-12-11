/* ============================================================
   CREACIÓN DE TABLA PARA USUARIOS
   ============================================================ */

-- Crear tabla básica de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Borrar tabla (si necesitas empezar de cero)
DROP TABLE IF EXISTS usuarios;


/* ============================================================
   INSERCIONES
   ============================================================ */

-- Insertar un usuario normal (sin hash, solo para práctica SQL)
INSERT INTO usuarios (username, password_hash, email)
VALUES ('juan', '1234', 'juan@mail.com');

-- Insertar varios usuarios a la vez
INSERT INTO usuarios (username, password_hash, email)
VALUES 
('pepe', 'abcd', 'pepe@mail.com'),
('luis', 'pass', 'luis@mail.com');


/* ============================================================
   CONSULTAS BÁSICAS
   ============================================================ */

-- Ver todos los usuarios
SELECT * FROM usuarios;

-- Seleccionar solo nombres de usuario
SELECT username FROM usuarios;

-- Seleccionar un usuario concreto
SELECT * FROM usuarios WHERE username = 'pepe';

-- Contar registros
SELECT COUNT(*) AS total_usuarios FROM usuarios;


/* ============================================================
   CONSULTAS PARA LOGIN
   (consulta parametrizada típica)
   ============================================================ */

-- Buscar un usuario en login
SELECT id, username, password_hash FROM usuarios WHERE username = ?;

-- Forma no parametrizada (NO usar en la vida real, solo para el examen)
SELECT id, username, password_hash FROM usuarios WHERE username = 'juan';


/* ============================================================
   ACTUALIZACIONES
   ============================================================ */

-- Cambiar el email
UPDATE usuarios
SET email = 'nuevo@mail.com'
WHERE username = 'juan';

-- Cambiar contraseña (en examenes se espera usar password_hash desde PHP)
UPDATE usuarios
SET password_hash = 'nuevaclave'
WHERE id = 1;


/* ============================================================
   BORRADO DE REGISTROS
   ============================================================ */

-- Borrar usuario por ID
DELETE FROM usuarios WHERE id = 3;

-- Borrar todos (cuidado)
DELETE FROM usuarios;

-- Reiniciar IDs (auto_increment)
ALTER TABLE usuarios AUTO_INCREMENT = 1;


/* ============================================================
   CONSULTAS DE PRÁCTICA EXTRA (PUEDEN SALIR EN EXÁMENES)
   ============================================================ */

-- Buscar por coincidencia parcial (LIKE)
SELECT * FROM usuarios WHERE username LIKE 'j%';

-- Ordenar resultados
SELECT * FROM usuarios ORDER BY fecha_registro DESC;

-- Limitar resultados
SELECT * FROM usuarios LIMIT 5;

-- Seleccionar los más recientes
SELECT * FROM usuarios ORDER BY id DESC LIMIT 3;

-- Ver usuarios sin email
SELECT * FROM usuarios WHERE email IS NULL;

-- Cambiar varios campos a la vez
UPDATE usuarios
SET email = 'otro@mail.com', username = 'usuario_cambiado'
WHERE id = 2;
