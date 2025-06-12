window.addEventListener("load", () => {
    // ロゴが表示された後、2.5秒後にメイン表示へ切り替え
    setTimeout(() => {
      document.getElementById("splash").style.display = "none";
      document.getElementById("main").style.display = "block";
    }, 2500);
  });
  