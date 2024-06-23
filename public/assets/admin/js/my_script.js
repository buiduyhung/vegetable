$(document).ready(function() {
    $('#imageInput').change(function(e) {
        const imagePreview = $('#imagePreview');
        imagePreview.empty();

        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = $('<img>').addClass('m-3 rounded-1').attr('src', e.target.result).attr('width', 150);
                imagePreview.append(image);

            }

            reader.readAsDataURL(file);
        }
    });
    

    // hiden notification after 2s
    $(document).ready(function() {
        setTimeout(function() {
            $('#notification').fadeOut('fast');
        }, 2000); // 2 giây
    });

    // Slug
    const getSlug = (title) => {

        // Đổi chữ hoa thành chữ thường
        let str = title.toLowerCase();

        // Đổi ký tự có dấu thành không dấu
        const diacriticsMap = {
            'à': 'a', 'á': 'a', 'ạ': 'a', 'ả': 'a', 'ã': 'a', 'â': 'a', 'ầ': 'a', 'ấ': 'a', 'ậ': 'a', 'ẩ': 'a', 'ẫ': 'a', 'ă': 'a', 'ằ': 'a', 'ắ': 'a', 'ặ': 'a', 'ẳ': 'a', 'ẵ': 'a',
            'è': 'e', 'é': 'e', 'ẹ': 'e', 'ẻ': 'e', 'ẽ': 'e', 'ê': 'e', 'ề': 'e', 'ế': 'e', 'ệ': 'e', 'ể': 'e', 'ễ': 'e',
            'ì': 'i', 'í': 'i', 'ị': 'i', 'ỉ': 'i', 'ĩ': 'i',
            'ò': 'o', 'ó': 'o', 'ọ': 'o', 'ỏ': 'o', 'õ': 'o', 'ô': 'o', 'ồ': 'o', 'ố': 'o', 'ộ': 'o', 'ổ': 'o', 'ỗ': 'o', 'ơ': 'o', 'ờ': 'o', 'ớ': 'o', 'ợ': 'o', 'ở': 'o', 'ỡ': 'o',
            'ù': 'u', 'ú': 'u', 'ụ': 'u', 'ủ': 'u', 'ũ': 'u', 'ư': 'u', 'ừ': 'u', 'ứ': 'u', 'ự': 'u', 'ử': 'u', 'ữ': 'u',
            'ỳ': 'y', 'ý': 'y', 'ỵ': 'y', 'ỷ': 'y', 'ỹ': 'y',
            'đ': 'd',
        };

        str = str.replace(/[àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]/gi, match => diacriticsMap[match]);

        // Đổi khoảng trắng thành ký tự gạch ngang
        str = str.replace(/\s/gi, "-");

        // Đổi nhiều ký tự gạch ngang liên tiếp thành một ký tự gạch ngang
        str = str.replace(/\-+/gi, "-");

        // Bỏ dấu câu, kí tự đặc biệt
        str = str.replace(/[!@%^*()+=<>?\/,.:;'&#[\]~$_`{}|\\]/gi, " ");

        return str;
        }

        const title = document.querySelector('.title');
        const slug = document.querySelector('.slug');
        let isChangeSlug = false;

        if(slug.value === ''){
        title.addEventListener('keyup', (e) => {
            if(!isChangeSlug){
                const titleValue = e.target.value;
                slug.value = getSlug(titleValue);
            }
        });
        }


        slug.addEventListener('change', () => {
        if(slug.value === ''){
            const title = document.querySelector('.title');
            const titleValue = title.value;
            slug.value = getSlug(titleValue);
        }
        isChangeSlug = true;
        
    });

});


