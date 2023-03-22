var products;
products ="products";
const activePage = window.location.href;
const navLinks = document.querySelectorAll('.nav a').forEach(link => {
  if(link.href.includes(`${activePage}`)){
    link.classList.add('active');
    console.log(link);
  }
})
console.log(activePage);