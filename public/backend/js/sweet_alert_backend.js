// functia pentru notificare sweet alert in backend - buton stergere inregistrare
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

// functia pentru notificare sweet alert in backend - modificare status comanda in asteptare -> confirmata
$(function () {
  $(document).on("click", "#confirm", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: "Sigur doriti sa confirmati comanda?",
      text: "O comanda confirmata nu mai poate fi intoarsa In Asteptare!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Confirma comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Confirmata!",
          "Comanda a fost confirmata cu success.",
          "success"
        );
      }
    });
  });
});

// functia pentru notificare sweet alert in backend - modificare status comanda confirmata -> procesata
$(function () {
  $(document).on("click", "#processing", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Sigur doriti sa procesati comanda?",
      text: "O comanda procesata nu mai poate fi intoarsa in Confirmata!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Proceseaza comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Procesata!",
          "Comanda a fost procesata cu success.",
          "success"
        );
      }
    });
  });
});

// functia pentru notificare sweet alert in backend - modificare status comanda procesata -> predata la curier
$(function () {
  $(document).on("click", "#picked", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Sigur doriti sa predati comanda curierului?",
      text: "O comanda predata curierului nu mai poate fi intoarsa!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Preda comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Preluata de curier!",
          "Comanda a fost preluata de curier cu success.",
          "success"
        );
      }
    });
  });
});

// functia pentru notificare sweet alert in backend - modificare status comanda predata la curier -> expediata ( in tranzit)
$(function () {
  $(document).on("click", "#shipped", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Sigur doriti sa expediezi comanda?",
      text: "O comanda expediata nu mai poate fi intoarsa!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Expediaza comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire(
          "Expediata!",
          "Comanda a fost expediata cu success.",
          "success"
        );
      }
    });
  });
});

// functia pentru notificare sweet alert in backend - modificare status comanda expediata ( in tranzit) -> livrata
$(function () {
  $(document).on("click", "#delivered", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Sigur doriti sa schimbati statusul comenzii in livrata?",
      text: "O comanda livrata nu mai poate fi intoarsa!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Confirma livrarea!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire("Livrata!", "Comanda a fost livrata cu success.", "success");
      }
    });
  });
});

// functia pentru notificare sweet alert in backend - modificare status comanda livrata -> anulata
$(function () {
  $(document).on("click", "#cancel_order", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Sigur doriti sa anulati comanda?",
      text: "O comanda anulata nu mai poate fi intoarsa!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Anuleaza comanda!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire("Anulata!", "Comanda a fost anulata cu success.", "success");
      }
    });
  });
});
