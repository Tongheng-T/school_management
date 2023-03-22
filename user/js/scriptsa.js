$(document).ready(function(){

// $('#demo').hover(
//   function () {
//     $(this).toggle();

 
// });



$(".image_container").click(function(){

  var user_input;
  location.reload();
  return user_input = confirm("Are you sure you want to delete this file");

});




});

$(".nav.navbar-nav li").click(function () {
  $(this).addClass("active").siblings().removeClass("active");
});

$(document).ready(function(){
  $('.nav.navbar-nav.side-nav').find('[href="'+ window.location.pathname+'"]').parent().addClass('active')
})
// const activePage = window.location.pathname;
// const navLinks = document.querySelectorAll('.nav.navbar-nav.side-nav').forEach(link => {
//   if(link.href.includes(`${activePage}`)){
//     link.classList.add('active');
//     console.log(link);
//   }
// })

// $('.btn-danger').on('click', function(e) {
//   e.preventDefault();
//   const href = $(this).attr('href')
//   Swal.fire({
//       title:"លុបព័ត៌មានអំពីការលក់!",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: '#3085d6',
//       cancelButtonColor: '#d33',
//       confirmButtonText: 'Yes, delete it!'
//   }).then((result) => {
//       if (result.isConfirmed) {
//           document.location.href = href;
//       }
//   })
// })
