$(() => {
  $("#category-pjax").on("change", "#post-check", function () {
    $.pjax.reload({
      container: "#category-pjax",
      method: "POST",
      data: $("#form-pjax").serialize(),
      pushState: false,
      replaceState: false,
      timeout: 5000,
    });
  });
});
