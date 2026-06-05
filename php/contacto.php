<?php
// NuevaTel — contacto.php
// ⚠️ VULN: Inserción SQL sin prepared statements + sin validación

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "nuevatel_db";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$nombre    = $_POST['nombre']    ?? '';
$email     = $_POST['email']     ?? '';
$telefono  = $_POST['telefono']  ?? '';
$direccion = $_POST['direccion'] ?? '';
$plan      = $_POST['plan']      ?? '';
$mensaje   = $_POST['mensaje']   ?? '';

$num_solicitud = 'NT-' . date('Ymd') . '-' . rand(1000, 9999);

// ⚠️ VULN: Query sin sanitizar — vulnerable a SQL Injection
$query = "INSERT INTO solicitudes (num_solicitud, nombre, email, telefono, direccion, plan, mensaje)
          VALUES ('$num_solicitud', '$nombre', '$email', '$telefono', '$direccion', '$plan', '$mensaje')";

$result = mysqli_query($conn, $query);

if (!$result) {
    // ⚠️ VULN: Error SQL expuesto
    die("Error: " . mysqli_error($conn));
}

mysqli_close($conn);

$planes = [
  'basico'     => 'Básico — 50 Mbps (Bs. 150/mes)',
  'hogar_plus' => 'Hogar Plus — 200 Mbps (Bs. 280/mes)',
  'fibra_max'  => 'Fibra Max — 500 Mbps (Bs. 420/mes)',
  'satelital'  => 'Satelital',
  'empresas'   => 'NuevaTel Empresas',
];
$plan_nombre = $planes[$plan] ?? $plan;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Solicitud recibida — NuevaTel</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    body { min-height: 100vh; display: flex; flex-direction: column; }
    .confirm-wrap {
      flex: 1; display: flex; align-items: center; justify-content: center;
      padding: 100px 24px 60px;
    }
    .confirm-card {
      background: var(--card); border: 1px solid rgba(76,175,80,0.25);
      border-radius: 20px; padding: 48px 42px; max-width: 580px; width: 100%;
      box-shadow: 0 0 60px rgba(76,175,80,0.06), 0 0 100px rgba(0,119,182,0.08);
    }
    .check-icon {
      width: 72px; height: 72px; border-radius: 50%;
      background: rgba(76,175,80,0.12); border: 2px solid rgba(76,175,80,0.4);
      display: flex; align-items: center; justify-content: center;
      font-size: 2em; margin: 0 auto 24px;
      animation: pop 0.4s ease;
    }
    @keyframes pop { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .confirm-title {
      font-family: 'Syne', sans-serif; font-size: 1.8em; font-weight: 800;
      color: #fff; text-align: center; margin-bottom: 8px;
    }
    .confirm-sub { text-align: center; color: var(--text-dim); font-size: 0.9em; margin-bottom: 32px; }
    .num-solicitud {
      text-align: center; background: rgba(0,180,216,0.08);
      border: 1px solid rgba(0,180,216,0.2); border-radius: 10px;
      padding: 12px; font-family: monospace; font-size: 1.1em;
      color: var(--accent); margin-bottom: 28px; letter-spacing: 1px;
    }
    .resumen {
      background: var(--bg3); border: 1px solid var(--border);
      border-radius: 12px; padding: 20px; margin-bottom: 28px;
    }
    .resumen h3 {
      font-family: 'Syne', sans-serif; font-size: 0.82em; font-weight: 700;
      text-transform: uppercase; letter-spacing: 2px; color: #6fcf72;
      margin-bottom: 16px;
    }
    .resumen-row {
      display: flex; justify-content: space-between; align-items: flex-start;
      padding: 8px 0; border-bottom: 1px solid var(--border); gap: 16px;
    }
    .resumen-row:last-child { border-bottom: none; }
    .resumen-label { font-size: 0.8em; color: var(--text-muted); flex-shrink: 0; }
    .resumen-val { font-size: 0.85em; color: var(--text); text-align: right; }
    .pasos { display: flex; flex-direction: column; gap: 12px; margin-bottom: 28px; }
    .paso {
      display: flex; align-items: flex-start; gap: 12px;
      background: rgba(76,175,80,0.05); border: 1px solid rgba(76,175,80,0.15);
      border-radius: 10px; padding: 12px 16px;
    }
    .paso-num {
      width: 24px; height: 24px; border-radius: 50%;
      background: rgba(76,175,80,0.2); color: #6fcf72;
      font-size: 0.75em; font-weight: 700; display: flex;
      align-items: center; justify-content: center; flex-shrink: 0;
    }
    .paso p { font-size: 0.84em; color: var(--text-dim); line-height: 1.5; }
    .paso strong { color: var(--text); }
    .btn-volver {
      display: block; text-align: center;
      background: linear-gradient(135deg, #0077b6, #00b4d8);
      color: #fff; font-weight: 700; padding: 14px; border-radius: 10px;
      font-size: 0.95em; transition: all 0.2s;
      box-shadow: 0 4px 20px rgba(0,180,216,0.25);
    }
    .btn-volver:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,180,216,0.4); }
  </style>
</head>
<body>
<nav class="navbar">
  <div class="nav-inner">
    <a href="../index.php" class="logo">
      <img src="../img/logo.png" alt="NuevaTel PCS" style="height: 48px; width: auto;" />
    </a>
    <ul class="nav-links">
      <li><a href="../index.php#servicios">Servicios</a></li>
      <li><a href="../index.php#planes">Planes</a></li>
      <li><a href="../index.php#cobertura">Cobertura</a></li>
      <li><a href="../contacto.html">Contacto</a></li>
      <li><a href="../login.html" class="btn-nav">Portal Cliente</a></li>
    </ul>
  </div>
</nav>

<div class="confirm-wrap">
  <div class="confirm-card">
    <div class="check-icon">✅</div>
    <h2 class="confirm-title">¡Solicitud recibida!</h2>
    <p class="confirm-sub">Gracias <?= htmlspecialchars($nombre) ?>, hemos recibido tu solicitud. Un asesor se pondrá en contacto contigo en las próximas 24 horas.</p>

    <div class="num-solicitud">N° de solicitud: <?= $num_solicitud ?></div>

    <div class="resumen">
      <h3>Resumen de tu solicitud</h3>
      <?php if($nombre): ?>
      <div class="resumen-row"><span class="resumen-label">Nombre</span><span class="resumen-val"><?= htmlspecialchars($nombre) ?></span></div>
      <?php endif; ?>
      <?php if($email): ?>
      <div class="resumen-row"><span class="resumen-label">Correo</span><span class="resumen-val"><?= htmlspecialchars($email) ?></span></div>
      <?php endif; ?>
      <?php if($telefono): ?>
      <div class="resumen-row"><span class="resumen-label">Teléfono</span><span class="resumen-val"><?= htmlspecialchars($telefono) ?></span></div>
      <?php endif; ?>
      <?php if($direccion): ?>
      <div class="resumen-row"><span class="resumen-label">Dirección</span><span class="resumen-val"><?= htmlspecialchars($direccion) ?></span></div>
      <?php endif; ?>
      <?php if($plan_nombre): ?>
      <div class="resumen-row"><span class="resumen-label">Plan</span><span class="resumen-val" style="color:var(--accent)"><?= htmlspecialchars($plan_nombre) ?></span></div>
      <?php endif; ?>
    </div>

    <div class="pasos">
      <div class="paso">
        <div class="paso-num">1</div>
        <p><strong>Verificación de cobertura</strong><br/>Nuestro equipo verificará disponibilidad en tu zona.</p>
      </div>
      <div class="paso">
        <div class="paso-num">2</div>
        <p><strong>Contacto de un asesor</strong><br/>Te llamaremos al <?= htmlspecialchars($telefono ?: 'número proporcionado') ?> para coordinar.</p>
      </div>
      <div class="paso">
        <div class="paso-num">3</div>
        <p><strong>Instalación técnica</strong><br/>Un técnico realizará la instalación sin costo adicional.</p>
      </div>
    </div>

    <a href="/nuevatel" class="btn-volver">Volver al inicio →</a>
  </div>
</div>

<footer class="footer" style="margin-top: auto;">
  <div class="container">
    <div class="footer-bottom">
      <p>© 2025 NuevaTel PCS S.R.L. — Bolivia · Todos los derechos reservados</p>
    </div>
  </div>
</footer>
<script src="../js/main.js"></script>
</body>
</html>
