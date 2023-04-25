function changeAction(){
    document.getElementById('myForm').action = "/BigProject/public/feelMesSaved/{{$uid}}";
}
document.getElementById('myForm').addEventListener('submit', function(event) {
event.preventDefault();
var formData = new FormData(event.target);
fetch(event.target.action, {
method: 'POST',
body: formData
})
.then(response => {
if (response.ok) {
    alert('儲存成功');
} else {
    throw new Error('表單提交失敗');
}
})
.catch(error => {
console.error('表單提交失敗:', error);
});
});
