$(function () {

    if ($('#wmd-button-row').length > 0) {
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容"><i class="far fa-eye-slash"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-bili-button" style="" title="插入B站视频"><i class="fab fa-bimobject"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-video-button" style="" title="插入其它视频"><i class="fas fa-video"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转"><i class="far fa-newspaper"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-gallery-button" style="" title="插入相册"><i class="fab fa-images aria-hidden="true"></i></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-plink-button" style="" title="插入外链"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" class="svg-inline--fa fa-link fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg></li>');
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><span class="OwO" data-owo="/usr/themes/onecircle/assets/owo/OwO_02.json"></span></li>');

        var owo_ = $(".OwO")
        var apiUrl = owo_.data("owo")
        new OwO({
            logo: '<i class="far fa-grin-alt"></i>',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: apiUrl,
            position: 'down',
            width: '400px',
            maxHeight: '250px'
        });
        $(document).on('click', '#wmd-hide-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[hide]\n\n[endhide]\n');
        });
        $(document).on('click', '#wmd-bili-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[bilibili bv="" p="1"]\n');
        });
        $(document).on('click', '#wmd-video-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[video src=""]\n');
        });
        $(document).on('click', '#wmd-cid-button', function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[cid=""]\n');
        });
        $(document).on('click','#wmd-plink-button',function () {
            myField = document.getElementById('text');
            insertAtCursor(myField, '\n[pureLink comment="" text="" link=""]\n');
        })
        $(document).on('click', '#wmd-gallery-button', function () {
            //显示弹窗的主界面
            $('.pop_main').show("fast")
            //设置animate动画初始值
            $('.pop_con').css({'top': 0, 'opacity': 0})
            $('.pop_con').animate({'top': '50%', 'opacity': 1})
        });
        //取消按钮和关闭按钮添加事件
        $('.cancel,.pop_title a').click(function () {
            $('.pop_con').animate({'top': 0, 'opacity': 0}, function () {
                //隐藏弹窗的主界面
                $('.pop_main').hide()
            })
        })
        $(".pop_footer .confirm").click(function () {
            $('.pop_con').animate({'top': 0, 'opacity': 0}, function () {
                //隐藏弹窗的主界面
                var imgarr = $("#input-num").val().split('\n')
                myField = document.getElementById('text');
                var text = '\n\n[gallery]';
                for (var i = 0; i < imgarr.length; i++) {
                    var j = i + 1
                    text = text + '!['+j+'](' + imgarr[i] + ')'
                }
                text = text + '[endgallery]\n\n'
                insertAtCursor(myField, text);
                $('.pop_main').hide("fast")
            })
        })
    }
});
