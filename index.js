$(document).ready(function () {
  // register form password

  let $regform = $("#reg-form");
  if ($regform) {
    console.log("HOLA", $regform);
  }
  $("#reg-form").submit(function (event) {
    let $password = $("#password");
    let $confirm = $("#confirm_pwd");
    let $error = $("#confirm_error");
    if ($password.val() === $confirm.val()) {
      console.log("LAS CONTRASEÑAS COINCIDEN");
      return true;
    } else {
      console.log("LAS CONTRASEÑAS NO COINCIDEN");
      $error.text("Las contraseñas no coinciden");
      event.preventDefault();
    }
  });

  // banner owl carousel
  $("#banner-area .owl-carousel").owlCarousel({
    dots: true,
    items: 1,
  });

  // top sale owl carousel
  $("#top-sale .owl-carousel").owlCarousel({
    loop: true,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });

  // isotope filter
  var $grid = $(".grid").isotope({
    itemSelector: ".grid-item",
    layoutMode: "fitRows",
  });

  // filter items on button click
  $(".button-group").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");
    $grid.isotope({ filter: filterValue });
  });

  // new phones owl carousel
  $("#new-phones .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });

  // blogs owl carousel
  $("#blogs .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
    },
  });

  // product qty section
  let $qty_up = $(".qty .qty-up");
  let $qty_down = $(".qty .qty-down");
  let $deal_price = $("#deal-price");

  // click on qty up button
  $qty_up.click(function (e) {
    var qty_stock = $(`.qty_stock[data-id='${$(this).data("id")}']`).val();
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

    // change product price using ajax call
    $.ajax({
      url: "template/ajax.php",
      type: "post",
      data: { itemid: $(this).data("id") },
      success: function (result) {
        let obj = JSON.parse(result);
        let item_price = obj[0]["item_price"];

        if (
          parseInt($input.val()) >= 1 &&
          parseInt($input.val()) < parseInt(qty_stock)
        ) {
          $input.val(function (i, oldval) {
            return ++oldval;
          });
          console.log($input.val(), qty_stock);
          // increase price of the product
          $price.text(parseInt(item_price * $input.val()).toFixed(2));

          // set subtotal price
          let subtotal = parseInt($deal_price.text()) + parseInt(item_price);
          $deal_price.text(subtotal.toFixed(2));
        } else {
          console.log($input.val(), qty_stock);
          window.location.href = "cart.php?sin-stock=1";
        }
      },
    }); // closing ajax request
  }); // closing qty up button

  // click on qty down button
  $qty_down.click(function (e) {
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    let $price = $(`.product_price[data-id='${$(this).data("id")}']`);

    // change product price using ajax call
    $.ajax({
      url: "template/ajax.php",
      type: "post",
      data: { itemid: $(this).data("id") },
      success: function (result) {
        let obj = JSON.parse(result);
        let item_price = obj[0]["item_price"];

        if ($input.val() > 1) {
          $input.val(function (i, oldval) {
            return --oldval;
          });

          // increase price of the product
          $price.text(parseInt(item_price * $input.val()).toFixed(2));

          // set subtotal price
          let subtotal = parseInt($deal_price.text()) - parseInt(item_price);
          $deal_price.text(subtotal.toFixed(2));
        }
      },
    }); // closing ajax request
  }); // closing qty down button

  //increase cart item qty
  $(document).on("click", ".qty-up", function () {
    var qty_stock = $(`.qty_stock[data-id='${$(this).data("id")}']`).val();
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);

    let $qty = parseInt($input.val());
    let $qty_update = $qty + 1;
    let $itemid = $(this).data("id");

    if (
      parseInt($input.val()) >= 1 &&
      parseInt($input.val()) < parseInt(qty_stock)
    ) {
      let $qty = parseInt($input.val());
      let $qty_update = $qty + 1;
      let $itemid = $(this).data("id");
      var sendData = function () {
        $.post(
          "cart.php",
          {
            action: "update",
            itemid: $itemid,
            qty: $qty_update,
          },
          function (response) {
            console.log($itemid, qty_stock);
            console.log($qty_up_btn);
          }
        );
      };
      sendData();
    }
  });

  //decrease cart item qty

  $(document).on("click", ".qty-down", function () {
    var qty_stock = $(`.qty_stock[data-id='${$(this).data("id")}']`).val();
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);

    let $qty = parseInt($input.val());
    let $qty_update = $qty - 1;
    let $itemid = $(this).data("id");

    if ($input.val() > 1) {
      let $qty = parseInt($input.val());
      let $qty_update = $qty - 1;
      let $itemid = $(this).data("id");
      var sendData = function () {
        $.post(
          "cart.php",
          {
            action: "update",
            itemid: $itemid,
            qty: $qty_update,
          },
          function (response) {
            console.log(response);
          }
        );
      };
      sendData();
    }
  });

  // responsive nav menu function

  $(".navbar-collapse").collapse();
});
