// alert('テスト');
document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const accordionMenu = document.getElementById("accordion-menu");

  // メニューの表示・非表示を切り替える
  menuToggle.addEventListener("click", () => {
    const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";

    // ボタンの状態を更新
    menuToggle.setAttribute("aria-expanded", !isExpanded);

    // メニュー表示の切り替え
    accordionMenu.classList.toggle("hidden");
    accordionMenu.classList.toggle("visible");
  });

  // ページの他の部分をクリックした場合、メニューを閉じる
  document.addEventListener("click", (event) => {
    if (!menuToggle.contains(event.target) && !accordionMenu.contains(event.target)) {
      menuToggle.setAttribute("aria-expanded", "false");
      accordionMenu.classList.add("hidden");
      accordionMenu.classList.remove("visible");
    }
  });

  $(document).ready(function () {
    $('.js-modal-button').on('click', function () {
      var postId = $(this).data('id');
      var postContent = $(this).data('text');

      $('#edit_post').val(postContent);
      $('#post_id').val(postId);
      $('#editForm').attr('action', '/posts/update/' + postId); // ここで正しいURLを設定
      $('#editModal').show();
    });

    $('#editForm').on('submit', function (event) {
      event.preventDefault();

      var form = $(this);
      var url = form.attr('action');

      $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        success: function () {
          alert('更新しました！');
          location.href = "/top"; // 更新後、topへ戻る
        },
        error: function () {
          alert('更新に失敗しました。');
        }
      });
    });

    $('.close').on('click', function () {
      $('#editModal').hide();
    });
  });

});
