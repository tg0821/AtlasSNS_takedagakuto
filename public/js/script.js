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
});
