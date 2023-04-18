 // 获取图标元素和链接元素
 const heartIcon = document.getElementById('heart');
 const heartHref = document.getElementById('heartHref');
 const uid = heartHref.dataset.uid;
 const ftid = heartHref.dataset.ftid;


 // 初始化图标状态
 let isRed = localStorage.getItem('isRed') === 'true';
 if (isRed) {
     heartIcon.classList.add('text-danger');
     heartHref.href = "/BigProject/public/feelSaved/{{$uid}}/{{$ftid}}";
 }

 // 监听点击事件
 heartIcon.addEventListener('click', () => {
     // 切换图标颜色
     if (isRed) {
         heartIcon.classList.remove('text-danger');
         isRed = false;
         localStorage.setItem('isRed', 'false');
         heartHref.href = "/BigProject/public/feelUnsaved/{{$uid}}/{{$ftid}}";
         heartHref.title = "收藏";
     
     } else {
         heartIcon.classList.add('text-danger');
         isRed = true;
         localStorage.setItem('isRed', 'true');
         heartHref.href = "/BigProject/public/feelSaved/{{$uid}}/{{$ftid}}";
         heartHref.title = "取消收藏";     
     }
 });