// functia pentru notificare sweet alert in backend
$(function () {
  $(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: "Sigur doriti sa stergeti inregistrarea?",
      // text: "Stergerea este ireversibila",
      icon: "question",
      iconColor: "red",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Da sterge inregistrarea!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Stearsa",
          "Inregistrarea a fost stearsa cu success.",
          "success"
        );
      }
    });
  });
});

// functia pentru notificare sweet alert in backend
$(function () {
  $(document).on("click", "#confirm", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: "Sigur doriti sa confirmati comanda?",
      text: "O comanda confirmata nu mai poate fi intoarsa in asteptare!",
      icon: "success",
      iconColor: "green",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Confirma comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Confirmata",
          "Inregistrarea a fost confirmata cu success.",
          "success"
        );
      }
    });
  });
});
