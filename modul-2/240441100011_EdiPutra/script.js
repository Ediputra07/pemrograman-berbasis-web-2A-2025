const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnicon = document.querySelector("i");

menuBtn.addEventListener("click", (e) =>{
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnicon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
});

navLinks.addEventListener("click", (e) =>{
  navLinks.classList.remove("open");
  menuBtnicon.setAttribute("class", "ri-menu-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".header_image img",{
  ...scrollRevealOption,
  origin: "right",
});
ScrollReveal().reveal(".header_content h1",{
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".header_content .section_description",{
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".header_content .header_btn",{
  ...scrollRevealOption,
  delay:1500,
});

ScrollReveal().reveal(".explore_image img",{
  ...scrollRevealOption,
  origin: "left",
});
ScrollReveal().reveal(".explore_content .section_header",{
  ...scrollRevealOption,
  delay:500,
});
ScrollReveal().reveal(".explore_content .section_description",{
  ...scrollRevealOption,
  delay:1000,
});
ScrollReveal().reveal(".explore_content .explore_btn",{
  ...scrollRevealOption,
  delay:1500,
});

ScrollReveal().reveal(".banner_card",{
  ...scrollRevealOption,
  interval: 500,
});

ScrollReveal().reveal(".chef_image img",{
  ...scrollRevealOption,
  origin:"right",
});
ScrollReveal().reveal(".chef_content .section_header",{
  ...scrollRevealOption,
  delay:500,
});
ScrollReveal().reveal(".chef_content .section_description", {
  ...scrollRevealOption,
  delay:1000,
});
ScrollReveal().reveal(".chef_list li",{
  ...scrollRevealOption,
  delay:1500,
  interval:500,
});

const swiper = new Swiper(".swiper", {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});