window.onload = function() {
    const leftBarLi = document.querySelectorAll('#leftBar li');
    const mobileLeftBarLi = document.querySelectorAll('#mobileLeftBar li');
    const leftBarA = document.querySelectorAll('#leftBar a');
    for (var j = 0 ; j < leftBarA.length ; j ++) {
        if (leftBarA[j].href == location.href) {
            leftBarLi[j].setAttribute('class', 'current');
            mobileLeftBarLi[j].setAttribute('class', 'current');
        }
    }

    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
}