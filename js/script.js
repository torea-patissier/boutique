document.addEventListener('DOMContentLoaded', function() {
  // // Sidenav
  var elems = document.querySelectorAll('.sidenav');
  M.Sidenav.init(elems);

  // Paralax
  var yyy = document.querySelectorAll('.parallax');
  M.Parallax.init(yyy);

  // Select
  var aaa = document.querySelectorAll('select');
  M.FormSelect.init(aaa);
});
