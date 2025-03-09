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


  // document.addEventListener('DOMContentLoaded', function () {
  // 削除ボタンのクリックイベント
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault(); // デフォルト動作を防ぐ

      // どの投稿の削除ボタンかを識別
      const postId = this.getAttribute('data-post-id');
      console.log('削除ボタンがクリックされました。postId:', postId); // デバッグ用ログ

      // 対応するモーダルを取得
      const modal = document.getElementById(`deleteModal-${postId}`);
      if (modal) {
        console.log('モーダルが見つかりました。'); // デバッグ用ログ
        modal.style.display = 'block';  // モーダルを表示
      } else {
        console.error(`deleteModal-${postId} が見つかりません`);
      }
    });
  });

  // 確認ボタンのクリックイベント
  document.querySelectorAll('.confirmDelete').forEach(button => {
    button.addEventListener('click', function () {
      const postId = this.getAttribute('data-post-id');
      console.log('OKボタンがクリックされました。postId:', postId); // デバッグ用ログ

      const form = document.getElementById(`deleteForm-${postId}`);
      if (form) {
        form.submit(); // フォーム送信
      } else {
        console.error(`deleteForm-${post} が見つかりません`);
      }
    });
  });

  // キャンセルボタンのクリックイベント
  document.querySelectorAll('.cancelDelete').forEach(button => {
    button.addEventListener('click', function () {
      const postId = this.getAttribute('data-post-id');
      const modal = document.getElementById(`deleteModal-${postId}`);
      if (modal) {
        modal.style.display = 'none'; // モーダルを閉じる
      }
    });
  });

  // モーダル外をクリックしたら閉じる
  window.addEventListener('click', function (e) {
    document.querySelectorAll('.modal').forEach(modal => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
  // });

});
