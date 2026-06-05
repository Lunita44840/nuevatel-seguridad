<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Portal — NuevaTel</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .portal-wrap { max-width: 900px; margin: 0 auto; padding: 100px 24px 60px; }
    .welcome-card {
      background: var(--card); border: 1px solid rgba(76,175,80,0.2);
      border-radius: 18px; padding: 32px; margin-bottom: 24px;
      display: flex; align-items: center; gap: 20px;
    }
    .avatar {
      width: 64px; height: 64px; border-radius: 50%;
      background: linear-gradient(135deg, #0077b6, #00b4d8);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.8em; flex-shrink: 0;
    }
    .welcome-text h2 { font-family: 'Syne', sans-serif; font-size: 1.3em; font-weight: 800; color: #fff; margin-bottom: 4px; }
    .welcome-text p { font-size: 0.85em; color: var(--text-muted); }
    .rol-badge {
      margin-left: auto; background: rgba(76,175,80,0.1);
      border: 1px solid rgba(76,175,80,0.3); color: #6fcf72;
      padding: 5px 14px; border-radius: 20px; font-size: 0.78em; font-weight: 700;
      text-transform: uppercase; letter-spacing: 1px;
    }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; margin-bottom: 24px; }
    .info-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 14px; padding: 24px; transition: all 0.2s;
    }
    .info-card:hover { border-color: rgba(0,180,216,0.3); transform: translateY(-3px); }
    .info-card h3 { font-family: 'Syne', sans-serif; font-size: 0.82em; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #6fcf72; margin-bottom: 16px; }
    .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 0.85em; }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--text-muted); }
    .info-val { color: var(--text); font-weight: 500; }
    .info-val.green { color: #6fcf72; }
    .info-val.accent { color: var(--accent); }
    .speed-bar { margin-top: 12px; }
    .speed-label { display: flex; justify-content: space-between; font-size: 0.78em; color: var(--text-muted); margin-bottom: 6px; }
    .bar-bg { background: var(--border); border-radius: 20px; height: 8px; overflow: hidden; }
    .bar-fill { height: 100%; border-radius: 20px; background: linear-gradient(90deg, #0077b6, #00b4d8); }
    .tickets-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 14px; overflow: hidden; margin-bottom: 24px;
    }
    .tickets-header { padding: 16px 20px; border-bottom: 1px solid var(--border); }
    .tickets-header h3 { font-family: 'Syne', sans-serif; font-size: 0.9em; font-weight: 700; color: #fff; }
    .ticket-row { display: flex; align-items: center; gap: 14px; padding: 14px 20px; border-bottom: 1px solid rgba(14,32,64,0.6); font-size: 0.84em; }
    .ticket-row:last-child { border-bottom: none; }
    .ticket-id { color: var(--text-muted); font-family: monospace; width: 80px; }
    .ticket-desc { flex: 1; color: var(--text-dim); }
    .ticket-status { padding: 3px 10px; border-radius: 20px; font-size: 0.75em; font-weight: 600; }
    .status-open { background: rgba(245,158,11,0.12); color: #f59e0b; }
    .status-closed { background: rgba(16,185,129,0.12); color: #10b981; }
    .btn-logout {
      display: inline-block; background: rgba(239,68,68,0.1);
      border: 1px solid rgba(239,68,68,0.2); color: #f87171;
      padding: 10px 24px; border-radius: 8px; font-size: 0.88em;
      font-weight: 600; cursor: pointer; transition: all 0.2s;
      text-decoration: none;
    }
    .btn-logout:hover { background: rgba(239,68,68,0.2); }
  </style>
</head>
<body>
<nav class="navbar">
  <div class="nav-inner">
    <a href="/nuevatel/" class="logo">
      <img src="img/logo.png" alt="NuevaTel PCS" style="height: 48px; width: auto;" />
    </a>
    <ul class="nav-links">
      <li><a href="/nuevatel/#servicios">Servicios</a></li>
      <li><a href="/nuevatel/#planes">Planes</a></li>
      <li><a href="/nuevatel/#cobertura">Cobertura</a></li>
      <li><a href="contacto.html">Contacto</a></li>
      <li><a href="logout.php" class="btn-nav">Cerrar sesión</a></li>
    </ul>
    <button class="hamburger" id="ham">☰</button>
  </div>
</nav>

<div class="portal-wrap">
  <div class="welcome-card">
    <div class="avatar">👤</div>
    <div class="welcome-text">
      <h2>Bienvenido, <?= htmlspecialchars($usuario) ?></h2>
      <p>Portal de clientes NuevaTel PCS · Cochabamba, Bolivia</p>
    </div>
    <span class="rol-badge"><?= htmlspecialchars($rol) ?></span>
  </div>

  <div class="grid">
    <div class="info-card">
      <h3>📋 Mi servicio</h3>
      <div class="info-row"><span class="info-label">Plan contratado</span><span class="info-val accent">Hogar Plus</span></div>
      <div class="info-row"><span class="info-label">Velocidad</span><span class="info-val">200 Mbps</span></div>
      <div class="info-row"><span class="info-label">Estado</span><span class="info-val green">● Activo</span></div>
      <div class="info-row"><span class="info-label">Vencimiento</span><span class="info-val">30/06/2025</span></div>
      <div class="speed-bar">
        <div class="speed-label"><span>Uso del mes</span><span>45 GB / ilimitado</span></div>
        <div class="bar-bg"><div class="bar-fill" style="width: 30%"></div></div>
      </div>
    </div>

    <div class="info-card">
      <h3>💳 Mi factura</h3>
      <div class="info-row"><span class="info-label">Mes actual</span><span class="info-val">Junio 2025</span></div>
      <div class="info-row"><span class="info-label">Monto</span><span class="info-val accent">Bs. 280.00</span></div>
      <div class="info-row"><span class="info-label">Estado</span><span class="info-val green">✓ Pagado</span></div>
      <div class="info-row"><span class="info-label">Próximo cobro</span><span class="info-val">01/07/2025</span></div>
    </div>

    <div class="info-card">
      <h3>📡 Estado de red</h3>
      <div class="info-row"><span class="info-label">Señal</span><span class="info-val green">Excelente</span></div>
      <div class="info-row"><span class="info-label">Latencia</span><span class="info-val">12 ms</span></div>
      <div class="info-row"><span class="info-label">Uptime</span><span class="info-val green">99.8%</span></div>
      <div class="info-row"><span class="info-label">Último corte</span><span class="info-val">Ninguno</span></div>
    </div>
  </div>

  <div class="tickets-card">
    <div class="tickets-header">
      <h3>🎫 Mis tickets de soporte</h3>
    </div>
    <div class="ticket-row">
      <span class="ticket-id">#TK-2401</span>
      <span class="ticket-desc">Lentitud en horario nocturno</span>
      <span class="ticket-status status-closed">Resuelto</span>
    </div>
    <div class="ticket-row">
      <span class="ticket-id">#TK-2389</span>
      <span class="ticket-desc">Solicitud de cambio de router</span>
      <span class="ticket-status status-open">En proceso</span>
    </div>
    <div class="ticket-row">
      <span class="ticket-id">#TK-2201</span>
      <span class="ticket-desc">Instalación inicial del servicio</span>
      <span class="ticket-status status-closed">Resuelto</span>
    </div>
  </div>

  <a href="logout.php" class="btn-logout">🚪 Cerrar sesión</a>
</div>

<script src="js/main.js"></script>
</body>
</html>
