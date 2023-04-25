const photoUpload = document.getElementById('photo-upload');
const preview = document.getElementById('preview');

photoUpload.addEventListener('change', function() {
    // 选择的文件
    const file = this.files[0];
    // 判断文件大小是否超过限制
    const imageSize = file.size;
    const maxFileSize = 16 * 1024 * 1024; // 16MB
    if (imageSize > maxFileSize) {
        alert('图片大小不能超过 16MB');
        fileInput.value = '';
    }
    // 创建一个新的图像对象
    const img = new Image();
    // 创建文件读取器
    const reader = new FileReader();
    // 文件读取完成后触发
    reader.onload = function(e) {
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
    // 图像加载完成后进行处理
    img.onload = function() {
        // 创建一个canvas元素
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        // 设置canvas元素的尺寸
        const maxWidth = 300;
        const maxHeight = 200;
        let width = img.width;
        let height = img.height;
        if (width > maxWidth) {
            height *= maxWidth / width;
            width = maxWidth;
        }
        if (height > maxHeight) {
            width *= maxHeight / height;
            height = maxHeight;
        }
        canvas.width = width;
        canvas.height = height;
        // 将图像绘制到canvas上
        ctx.drawImage(img, 0, 0, width, height);
        // 将canvas转换为dataURL，并将其传递到后端
        const dataURL = canvas.toDataURL('image/jpeg', 0.8);
        // todo: 将dataURL传递到后端进行保存
        const previewImg = document.createElement('img');
        previewImg.src = dataURL;
        preview.innerHTML = '';
        preview.appendChild(previewImg);
    };                            
}); 
