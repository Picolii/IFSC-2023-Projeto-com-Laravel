function activeSnackbar(alert, location) {
  var snackbar = document.getElementById("snackbar");
  snackbar.innerHTML = alert;
  snackbar.className = "show";
  setTimeout(() => {
    snackbar.className = snackbar.className.replace("show", "");
  }, 3000);
  if (location) {
    setTimeout(() => {
      window.location.href = location;
    }, 1500);
  }
}
