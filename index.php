<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NuevaTel — Conectamos lo que más quieres</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="nav-inner">
    <a href="index.php" class="logo">
      <img src="img/logo.png" alt="NuevaTel PCS" style="height: 48px; width: auto;" />
    </a>
    <ul class="nav-links">
      <li><a href="#servicios">Servicios</a></li>
      <li><a href="#planes">Planes</a></li>
      <li><a href="#cobertura">Cobertura</a></li>
      <li><a href="#contacto">Contacto</a></li>
      <li><a href="login.html" class="btn-nav">Portal Cliente</a></li>
    </ul>
    <button class="hamburger" id="ham">☰</button>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg">
    <div class="grid-lines"></div>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="orb orb3"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge">🇧🇴 ISP líder en Bolivia</div>
    <h1 class="hero-title">
      Conectamos<br/>
      <span class="accent">lo que más</span><br/>
      quieres
    </h1>
    <p class="hero-sub">Internet residencial de fibra óptica y satelital con soporte técnico 24/7. Velocidad sin cortes, para el hogar digital boliviano.</p>
    <div class="hero-cta">
      <a href="#planes" class="btn-primary">Ver planes →</a>
      <a href="contacto.html" class="btn-ghost">Solicitar instalación</a>
    </div>
    <div class="hero-stats">
      <div class="stat"><span class="stat-n">98%</span><span class="stat-l">Uptime garantizado</span></div>
      <div class="stat-div"></div>
      <div class="stat"><span class="stat-n">24/7</span><span class="stat-l">Soporte técnico</span></div>
      <div class="stat-div"></div>
      <div class="stat"><span class="stat-n">+50K</span><span class="stat-l">Clientes activos</span></div>
    </div>
  </div>
  <div class="hero-visual">
    <div class="signal-ring r1"></div>
    <div class="signal-ring r2"></div>
    <div class="signal-ring r3"></div>
    <div class="tower-icon">📡</div>
  </div>
</section>

<!-- SERVICIOS -->
<section class="servicios" id="servicios">
  <div class="container">
    <div class="section-label">Nuestros servicios</div>
    <h2 class="section-title">Todo lo que necesitas<br/><span class="accent">en un solo proveedor</span></h2>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">⚡</div>
        <h3>Fibra Óptica</h3>
        <p>Velocidades simétricas de hasta 1 Gbps para tu hogar. Sin límite de datos, sin throttling.</p>
        <ul class="service-list">
          <li>Instalación sin costo</li>
          <li>Router WiFi 6 incluido</li>
          <li>Velocidad garantizada</li>
        </ul>
      </div>
      <div class="service-card featured">
        <div class="feat-badge">⭐ Más elegido</div>
        <div class="service-icon">🛰️</div>
        <h3>Internet Satelital</h3>
        <p>Cobertura en zonas rurales y remotas donde la fibra aún no llega. Latencia optimizada.</p>
        <ul class="service-list">
          <li>Cobertura nacional</li>
          <li>Instalación técnica incluida</li>
          <li>Antena de alta ganancia</li>
        </ul>
      </div>
      <div class="service-card">
        <div class="service-icon">🔧</div>
        <h3>Soporte Técnico</h3>
        <p>Equipo de técnicos certificados disponibles 24 horas, 7 días a la semana, 365 días al año.</p>
        <ul class="service-list">
          <li>Diagnóstico remoto</li>
          <li>Visita técnica en 24h</li>
          <li>Mantenimiento predictivo</li>
        </ul>
      </div>
      <div class="service-card">
        <div class="service-icon">🏢</div>
        <h3>NuevaTel Empresas</h3>
        <p>Soluciones dedicadas para PyMEs con SLA garantizado, IP fija y enlace redundante.</p>
        <ul class="service-list">
          <li>IP fija dedicada</li>
          <li>SLA 99.5% garantizado</li>
          <li>Soporte prioritario</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- PLANES -->
<section class="planes" id="planes">
  <div class="container">
    <div class="section-label">Planes residenciales</div>
    <h2 class="section-title">Elige tu velocidad,<br/><span class="accent">nosotros hacemos el resto</span></h2>
    <div class="planes-grid">
      <div class="plan-card">
        <div class="plan-name">Básico</div>
        <div class="plan-speed">50<span>Mbps</span></div>
        <div class="plan-price">Bs. 150<span>/mes</span></div>
        <ul class="plan-features">
          <li>✓ Datos ilimitados</li>
          <li>✓ Router WiFi incluido</li>
          <li>✓ Soporte 8–20h</li>
          <li>✗ IP fija</li>
        </ul>
        <a href="contacto.html" class="btn-plan">Contratar</a>
      </div>
      <div class="plan-card plan-popular">
        <div class="popular-label">🔥 Popular</div>
        <div class="plan-name">Hogar Plus</div>
        <div class="plan-speed">200<span>Mbps</span></div>
        <div class="plan-price">Bs. 280<span>/mes</span></div>
        <ul class="plan-features">
          <li>✓ Datos ilimitados</li>
          <li>✓ Router WiFi 6</li>
          <li>✓ Soporte 24/7</li>
          <li>✓ TV streaming incluido</li>
        </ul>
        <a href="contacto.html" class="btn-plan">Contratar</a>
      </div>
      <div class="plan-card">
        <div class="plan-name">Fibra Max</div>
        <div class="plan-speed">500<span>Mbps</span></div>
        <div class="plan-price">Bs. 420<span>/mes</span></div>
        <ul class="plan-features">
          <li>✓ Datos ilimitados</li>
          <li>✓ Router WiFi 6 Pro</li>
          <li>✓ Soporte 24/7 prioritario</li>
          <li>✓ IP fija incluida</li>
        </ul>
        <a href="contacto.html" class="btn-plan">Contratar</a>
      </div>
    </div>
  </div>
</section>

<!-- COBERTURA -->
<section class="cobertura" id="cobertura">
  <div class="container">
    <div class="cobertura-inner">
      <div class="cobertura-text">
        <div class="section-label">Cobertura</div>
        <h2 class="section-title">¿Llegamos a<br/><span class="accent">tu zona?</span></h2>
        <p>Ingresa tu dirección o número de CI para verificar disponibilidad en tu área. Nuestro sistema consulta la base de datos en tiempo real.</p>
      </div>
      <div class="cobertura-form">
        <form action="index.php" method="GET" class="search-form">
          <input type="text" name="zona" placeholder="Ej: Cochabamba, Av. América" class="search-input" />
          <button type="submit" class="btn-primary">Verificar →</button>
        </form>
        <?php if(isset($_GET['zona'])): ?>
          <div class="search-result">
            Resultados para: <strong><?= $_GET['zona'] ?></strong>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- CONTACTO -->
<section class="contacto" id="contacto">
  <div class="container">
    <div class="section-label">Contacto</div>
    <h2 class="section-title">¿Listo para conectarte?<br/><span class="accent">Escríbenos</span></h2>
    <div class="contacto-grid">
      <div class="contacto-info">
        <div class="info-item">📍 Av. América Nro. 123, Cochabamba, Bolivia</div>
        <div class="info-item">📞 +591 4 444-5678</div>
        <div class="info-item">✉️ info@nuevatel.com.bo</div>
        <div class="info-item">🕐 Lun–Vie 8:00–20:00 | Emergencias 24/7</div>
      </div>
      <form action="contacto.php" method="POST" class="contact-form">
        <input type="text" name="nombre" placeholder="Tu nombre completo" class="form-input" />
        <input type="email" name="email" placeholder="Tu correo electrónico" class="form-input" />
        <input type="tel" name="telefono" placeholder="Tu número de teléfono" class="form-input" />
        <textarea name="mensaje" placeholder="Tu mensaje..." class="form-textarea" rows="4"></textarea>
        <button type="submit" class="btn-primary">Enviar mensaje →</button>
      </form>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <img src="img/logo.png" alt="NuevaTel" style="height: 40px; width: auto; margin-bottom: 12px;" />
        <p>Conectamos lo que más quieres. ISP boliviana comprometida con la conectividad residencial de calidad.</p>
      </div>
      <div class="footer-links">
        <h4>Servicios</h4>
        <ul>
          <li><a href="#">Fibra Óptica</a></li>
          <li><a href="#">Satelital</a></li>
          <li><a href="#">NuevaTel Empresas</a></li>
          <li><a href="#">Soporte Técnico</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>Empresa</h4>
        <ul>
          <li><a href="#">Acerca de</a></li>
          <li><a href="#">Trabaja con nosotros</a></li>
          <li><a href="admin/">Administración</a></li>
          <li><a href="#">Términos de servicio</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>Portal</h4>
        <ul>
          <li><a href="login.html">Iniciar sesión</a></li>
          <li><a href="#">Ver mi factura</a></li>
          <li><a href="#">Estado del servicio</a></li>
          <li><a href="backup/">Backup archivos</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 NuevaTel PCS S.R.L. — Bolivia · RUC: 1234567890 · Todos los derechos reservados</p>
      <!-- Server: Apache/2.4.49 PHP/7.2.0 MySQL/5.7 -->
    </div>
  </div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
