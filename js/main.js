// NuevaTel — main.js
// ⚠️ VULN #15: API key y datos sensibles en el JS del cliente (lado público)
const CONFIG = {
  api_key: "nt_live_sk_8f2a9c1d4e7b3f6a2c8d5e9f1a4b7c2d",  // ⚠️ clave API falsa expuesta
  api_url: "http://api.nuevatel.local:8080",
  db_prefix: "nt_",
  admin_secret: "NuevaTel@Admin2024",  // ⚠️ secreto hardcodeado
  version: "1.0.0"
};

// Hamburger menu
document.addEventListener("DOMContentLoaded", () => {
  const ham = document.getElementById("ham");
  const navLinks = document.querySelector(".nav-links");
  if (ham && navLinks) {
    ham.addEventListener("click", () => {
      navLinks.style.display = navLinks.style.display === "flex" ? "none" : "flex";
    });
  }

  // Highlight nav link activo
  const links = document.querySelectorAll(".nav-links a");
  links.forEach(link => {
    link.addEventListener("click", () => {
      links.forEach(l => l.classList.remove("active"));
      link.classList.add("active");
    });
  });

  // Scroll reveal suave para secciones
  const sections = document.querySelectorAll(".servicios, .planes, .cobertura, .contacto");
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1";
        entry.target.style.transform = "translateY(0)";
      }
    });
  }, { threshold: 0.1 });

  sections.forEach(sec => {
    sec.style.opacity = "0";
    sec.style.transform = "translateY(20px)";
    sec.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(sec);
  });
});

// ⚠️ VULN #15: Función de verificar cobertura llama a API con token expuesto
function verificarCobertura(zona) {
  // Esta función envía el token en la URL (query param)
  fetch(`${CONFIG.api_url}/cobertura?zona=${zona}&token=${CONFIG.api_key}`)
    .then(r => r.json())
    .then(data => console.log("Cobertura:", data))
    .catch(err => console.log("Sin conexión a API"));
}
