document.addEventListener("DOMContentLoaded", () => {
  // Enregistrer ScrollTrigger
  gsap.registerPlugin(ScrollTrigger);

  // Gérer le scroll vers les ancres après redirection depuis une autre page
  const hash = window.location.hash;
  if (hash) {
    // Attendre un peu que la page soit complètement chargée
    setTimeout(() => {
      const target = document.querySelector(hash);
      if (target) {
        // Scroll smooth vers l'élément
        target.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    }, 100);
  }

  // Animation Hero au chargement
  gsap.from("#hero h1", { duration: 1, y: -50, opacity: 0 });
  gsap.from("#hero p", { duration: 1, y: 50, opacity: 0, delay: 0.5 });

  // Animations GSAP avec ScrollTrigger pour les cards de compétences
  const skillCards = document.querySelectorAll(".skill-card");
  if (skillCards.length > 0) {
    // S'assurer que les cards sont visibles par défaut
    skillCards.forEach((card) => {
      gsap.set(card, { opacity: 1, y: 0 });
    });

    // Animation au scroll avec ScrollTrigger
    gsap.from(skillCards, {
      scrollTrigger: {
        trigger: "#skills",
        start: "top 80%",
        toggleActions: "play none none none",
      },
      y: 50,
      opacity: 0,
      duration: 0.8,
      stagger: 0.15,
      ease: "power2.out",
    });
  }

  // Animations GSAP avec ScrollTrigger pour les cards de projets
  const projectCards = document.querySelectorAll(".project-card");
  if (projectCards.length > 0) {
    // S'assurer que les cards sont visibles par défaut
    projectCards.forEach((card) => {
      gsap.set(card, { opacity: 1, y: 0 });
    });

    // Animation au scroll avec ScrollTrigger
    gsap.from(projectCards, {
      scrollTrigger: {
        trigger: "#projects",
        start: "top 80%",
        toggleActions: "play none none none",
      },
      y: 50,
      opacity: 0,
      duration: 0.8,
      stagger: 0.2,
      ease: "power2.out",
    });
  }

  // Animation Contact au scroll
  gsap.from("#contact h2", {
    scrollTrigger: {
      trigger: "#contact",
      start: "top 80%",
      toggleActions: "play none none none",
    },
    duration: 1,
    y: 50,
    opacity: 0,
    ease: "power2.out",
  });

  // Animation du bouton CTA Galerie
  const galleryCTA = document.querySelector(".gallery-cta-content");
  if (galleryCTA) {
    gsap.from(galleryCTA, {
      scrollTrigger: {
        trigger: galleryCTA,
        start: "top 80%",
        toggleActions: "play none none none",
      },
      duration: 0.8,
      y: 30,
      opacity: 0,
      ease: "power2.out",
    });
  }

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
    // Animation de la position du radial-gradient avec couleur d'accent
    let x = 20;
    let y = 30;
    setInterval(() => {
      x = 20 + Math.sin(Date.now() / 10000) * 30;
      y = 30 + Math.cos(Date.now() / 10000) * 20;
      skillsTexture.style.background = `radial-gradient(circle at ${x}% ${y}%, rgba(255, 140, 97, 0.25), transparent 70%)`;
    }, 100);
  }

  // Effet parallax subtil sur les cartes de compétences (optionnel, désactivé par défaut)
  // Décommentez pour activer l'effet parallax 3D sur les cartes
  /*
  document.addEventListener('mousemove', (e) => {
    document.querySelectorAll('.skill-card').forEach(card => {
      const rect = card.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;
      card.style.transform = `rotateY(${x * 3}deg) rotateX(${-y * 3}deg) translateZ(0)`;
    });
  });
  */

  // Gestion du modal d'images des projets
  const imageTriggers = document.querySelectorAll("[data-project-image]");
  const imageModal = document.getElementById("project-image-modal");
  const imageModalImg = document.getElementById("project-image-modal-image");
  const imageModalTitle = document.getElementById("project-image-modal-title");
  const imageModalClosers = document.querySelectorAll(
    "[data-project-image-close]"
  );

  if (
    imageTriggers.length > 0 &&
    imageModal &&
    imageModalImg &&
    imageModalTitle
  ) {
    const openModal = (imageUrl, title) => {
      imageModalImg.src = imageUrl;
      imageModalImg.alt = title || "Image du projet";
      imageModalTitle.textContent = title || "";
      imageModal.classList.remove("hidden");
      document.body.classList.add("overflow-hidden");
    };

    const closeModal = () => {
      imageModal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
      imageModalImg.src = "";
    };

    imageTriggers.forEach((trigger) => {
      trigger.addEventListener("click", () => {
        const imageUrl = trigger.getAttribute("data-project-image");
        const title = trigger.getAttribute("data-project-title");
        if (imageUrl) {
          openModal(imageUrl, title);
        }
      });
    });

    imageModalClosers.forEach((closer) => {
      closer.addEventListener("click", closeModal);
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !imageModal.classList.contains("hidden")) {
        closeModal();
      }
    });
  }

  // Gestion du modal de la galerie
  const galleryItems = document.querySelectorAll(".gallery-item img");
  const galleryModal = document.getElementById("gallery-modal");
  const galleryModalImg = document.getElementById("gallery-modal-image");
  const galleryModalTitle = document.getElementById("gallery-modal-title");
  const galleryModalClosers = document.querySelectorAll("[data-gallery-close]");

  if (
    galleryItems.length > 0 &&
    galleryModal &&
    galleryModalImg &&
    galleryModalTitle
  ) {
    const openGalleryModal = (imageUrl, title) => {
      galleryModalImg.src = imageUrl;
      galleryModalImg.alt = title || "Image de la galerie";
      galleryModalTitle.textContent = title || "";
      galleryModal.classList.remove("hidden");
      document.body.classList.add("overflow-hidden");
    };

    const closeGalleryModal = () => {
      galleryModal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
      galleryModalImg.src = "";
    };

    galleryItems.forEach((item) => {
      item.addEventListener("click", () => {
        const imageUrl = item.getAttribute("data-gallery-image");
        const title = item.getAttribute("data-gallery-title");
        if (imageUrl) {
          openGalleryModal(imageUrl, title);
        }
      });
    });

    galleryModalClosers.forEach((closer) => {
      closer.addEventListener("click", closeGalleryModal);
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !galleryModal.classList.contains("hidden")) {
        closeGalleryModal();
      }
    });
  }

  // Animation des items de la galerie au scroll
  const galleryItemsAnimated = document.querySelectorAll(".gallery-item");
  if (galleryItemsAnimated.length > 0) {
    gsap.from(galleryItemsAnimated, {
      scrollTrigger: {
        trigger: "#gallery",
        start: "top 80%",
        toggleActions: "play none none none",
      },
      duration: 0.6,
      y: 40,
      opacity: 0,
      stagger: 0.1,
      ease: "power2.out",
    });
  }
});
