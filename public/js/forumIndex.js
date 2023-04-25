// 定義 openCity 函式
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.addEventListener('DOMContentLoaded', function() {
  // 檢查localStorage中是否有保存的值
  const savedIndex = localStorage.getItem('selectedTabIndex');
  if (savedIndex) {
    // 將 defaultOpen id 移除
    document.getElementById('defaultOpen').id = '';
    // 設定對應的 tab 為 defaultOpen
    const tablinks = document.getElementsByClassName('tablinks');
    const savedTab = tablinks[savedIndex];
    if (savedTab) {
      savedTab.id = 'defaultOpen';
      savedTab.click();
    }
  }

  // 綁定 tablinks 的 click 事件
  const tablinks = document.getElementsByClassName("tablinks");
  for (let i = 0; i < tablinks.length; i++) {
    tablinks[i].addEventListener("click", function() {
      // 將按下去的 tab index 存入 localStorage
      localStorage.setItem('selectedTabIndex', i);
      document.getElementById("defaultOpen").id = "";
      this.id = "defaultOpen";
    });
  }
});

document.getElementById("defaultOpen").click();



