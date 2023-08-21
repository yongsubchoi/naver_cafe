document.addEventListener("DOMContentLoaded", function() {
  const kebabIcon = document.querySelectorAll(".comment_kebab");

  kebabIcon.forEach(function(icon) {
    icon.addEventListener("click", function(event) {
      event.stopPropagation();
      // 수정된 부분: 해당 아이콘에 .options 요소가 있는지 체크
      const options = this.querySelector(".options");
      if (options) {
        options.classList.toggle("show_options");
      } else {
        console.log("본인 댓글이 아닙니다.");
        return;
      }
    });
  });

  document.addEventListener("click", function() {
    const options = document.querySelectorAll(".options.show_options");
    options.forEach(function(option) {
      option.classList.remove("show_options");
    });
  });
});
