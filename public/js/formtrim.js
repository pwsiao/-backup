const form = document.getElementById('myForm');
const feelcomInput = document.getElementById('feelcom');
const submitBtn = document.getElementById('submitBtn');
form.addEventListener('submit', (event) => {
// 检查输入框是否为空
    if (feelcomInput.value.trim() === '') {
        alert('請輸入留言内容！');
        event.preventDefault(); 
    }
});