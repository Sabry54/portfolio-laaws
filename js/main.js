document.addEventListener("DOMContentLoaded", () => {
  gsap.from("#hero h1", { duration: 1, y: -50, opacity: 0 });
  gsap.from("#hero p", { duration: 1, y: 50, opacity: 0, delay: 0.5 });
  // Animations GSAP pour les cards de compétences
  const skillCards = document.querySelectorAll(".skill-card");
  if (skillCards.length > 0) {
    // S'assurer que les cards sont visibles par défaut
    skillCards.forEach((card) => {
      gsap.set(card, { opacity: 1, y: 0 });
    });

    // Animation au chargement
    gsap.from(skillCards, {
      duration: 0.6,
      y: 30,
      opacity: 0,
      stagger: 0.08,
      delay: 1,
      ease: "power2.out",
    });
  }
  // Animations GSAP pour les cards de projets
  const projectCards = document.querySelectorAll(".project-card");
  if (projectCards.length > 0) {
    // S'assurer que les cards sont visibles par défaut
    projectCards.forEach((card) => {
      gsap.set(card, { opacity: 1, y: 0 });
    });

    // Animation au chargement
    gsap.from(projectCards, {
      duration: 0.8,
      y: 40,
      opacity: 0,
      stagger: 0.15,
      delay: 1.5,
      ease: "power2.out",
    });
  }
  gsap.from("#contact h2", { duration: 1, y: 50, opacity: 0, delay: 2 });

  // Effet 3D de carte qui suit la souris pour l'image Hero
  const heroImage = document.getElementById("hero-image-3d");
  const heroImageContainer = document.querySelector(".hero-image-container");

  if (heroImage && heroImageContainer) {
    heroImageContainer.addEventListener("mousemove", (e) => {
      const rect = heroImageContainer.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const rotateX = ((y - centerY) / centerY) * -3; // Inclinaison verticale très légère
      const rotateY = ((x - centerX) / centerX) * 3; // Inclinaison horizontale très légère

      heroImage.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.01, 1.01, 1.01)`;
      heroImage.style.transition = "transform 0.15s ease-out";
    });

    heroImageContainer.addEventListener("mouseleave", () => {
      heroImage.style.transform =
        "perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)";
      heroImage.style.transition = "transform 0.6s ease-out";
    });

    heroImageContainer.addEventListener("mouseenter", () => {
      heroImage.style.transition = "transform 0.15s ease-out";
    });
  }

  // Animation subtile de la texture lumineuse dans Skills
  const skillsTexture = document.getElementById("skills-texture");
  if (skillsTexture) {
    gsap.to(skillsTexture, {
      backgroundPosition: "80% 70%",
      duration: 20,
      repeat: -1,
      yoyo: true,
      ease: "sine.inOut",
    });

    // Animation de la position du radial-gradient avec couleur d'accent
    let x = 20;
    let y = 30;
    setInterval(() => {
      x = 20 + Math.sin(Date.now() / 10000) * 30;
      y = 30 + Math.cos(Date.now() / 10000) * 20;
      skillsTexture.style.background = `radial-gradient(circle at ${x}% ${y}%, rgba(255, 140, 97, 0.25), transparent 70%)`;
    }, 100);
  }
});
