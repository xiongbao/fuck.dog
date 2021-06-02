<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//require_once('admin/core.php');
include_once 'admin/core.php';
function themeConfig($form)
{  $options = Helper::options();
    ?>
    <div class="j-setting-contain">
        <link href="<?php $options->themeUrl('/assets/admin/css/one.setting.min.css') ?>" rel="stylesheet" type="text/css" />
        <div>
            <div class="j-aside">
                <div class="logo">ONE <?php echo OnecircleVersion() ?><br><small style="font-size: 10px">设置模板来自Joe的typecho主题</small></div>
                <ul class="j-setting-tab">
                    <li data-current="j-setting-notice">最新公告</li>
                    <li data-current="j-setting-global">公共设置</li>
                    <li data-current="j-setting-image">图片设置</li>
                    <li data-current="j-setting-post">文章设置</li>
                    <li data-current="j-setting-jifen">积分设置</li>
                    <li data-current="j-setting-color">色彩背景</li>
                    <li data-current="j-setting-index">博客设置</li>
                    <li data-current="j-setting-ads">广告设置</li>
                    <li data-current="j-setting-other">其他设置</li>
                </ul>
                <?php require_once("admin/backup.php"); ?>
            </div>
        </div>
        <span id="j-version" style="display: none;"><?php echo OnecircleVersion() ?></span>
        <div class="j-setting-notice"><iframe src="https://www.yuque.com/docs/share/05f40cac-980f-4e53-8b92-ed9728b8dc50?# 《OneCircle 主题说明》" frameborder="no" scrolling="yes" height="100%" width="100%"></iframe></div>
        <script src="<?php $options->themeUrl('/assets/admin/js/one.setting.min.js')?>"></script>
    <?php
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon'), _t('favicon 图片'));
    $favicon->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($favicon);
    // 公共设置
    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号'));
    $recordNo->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($recordNo);

    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('圈子文章置顶'), _t('输入圈子文章的文章cid，按照排序输入, 请以空格分隔'));
    $sticky->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($sticky);

    $useInfiniteScroll = new Typecho_Widget_Helper_Form_Element_Radio('useInfiniteScroll',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('无限滚动'), _t('开启后将会隐藏分页器，显示无限滚动'));
    $useInfiniteScroll->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($useInfiniteScroll);
    // 图片设置
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, "https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2592033302,3451533765&fm=26&gp=0.jpg", _t('<h2>普通设置</h2>站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $logoUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($logoUrl);

    $defaultSlugUrl = new Typecho_Widget_Helper_Form_Element_Text('defaultSlugUrl', NULL, "https://img.icons8.com/dusk/2x/categorize.png", _t('默认的分类图片'), _t('在这里填入一个图片 URL， 地址为分类图片的默认图标'));
    $defaultSlugUrl->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($defaultSlugUrl);

    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('请前往阿里巴巴 iconfront，找到你最喜欢的图标跑，点击复制svg <br>每行粘贴一个，自定义内导航栏左侧的小图标，留空则展示默认的图标按钮<hr>'));
    $customNavIcon->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($customNavIcon);


    /**
     * 色彩背景设置
     */
    $bgColor = new Typecho_Widget_Helper_Form_Element_Text('bgColor', NULL, "#eff3f6", _t('背景色'),_t('默认背景色 #eff3f6'));
    $bgColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($bgColor);

    $bgImg = new Typecho_Widget_Helper_Form_Element_Text('bgImg', NULL, "https://pic.downk.cc/item/5fd996003ffa7d37b3f9a64c.jpg", _t('背景图'),_t('设置主页背景图:<br>https://ae01.alicdn.com/kf/HTB18ehESIfpK1RjSZFOq6y6nFXaf.jpg'));
    $bgImg->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($bgImg);

    $JMainColor = new Typecho_Widget_Helper_Form_Element_Text('JMainColor', NULL, "rgb(255,255,255)", _t('主色调(透明色)'),_t('设置主色调：<br>默认白色: rgb(255,255,255)'));
    $JMainColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JMainColor);

    $Jtransparent = new Typecho_Widget_Helper_Form_Element_Text('Jtransparent', NULL, "0.3", _t('透明度'),_t('<br>设置全局透明度，0是透明，1是不透明，默认 0.3 '));
    $Jtransparent->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($Jtransparent);

    // 文章设置
    $jsPushBaidu = new Typecho_Widget_Helper_Form_Element_Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', _t('自动推送'), _t('使用通用js自动推荐给百度引擎，增快收录'));
    $jsPushBaidu->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($jsPushBaidu);

    $LicenseInfo = new Typecho_Widget_Helper_Form_Element_Text('LicenseInfo', NULL, NULL, _t('文章许可信息'), _t('填入后将在文章底部显示你填入的许可信息（支持HTML标签）<br>eg: 本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。'));
    $LicenseInfo->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($LicenseInfo);
    //
    $JCursorType = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorType',
        array(
            'off' => '默认样式（默认）',
            'cursor1.cur' => '风格1',
            'cursor2.cur' => '风格2',
            'cursor3.cur' => '风格3',
            'cursor4.cur' => '风格4',
            'cursor5.cur' => '风格5',
            'cursor6.cur' => '风格6',
        ),
        'off',
        '是否开启自定义鼠标风格（仅限PC）',
        '介绍：选择一款您所喜欢的鼠标默认样式。'
    );
    $JCursorType->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorType->multiMode());

    $JCursorEffects = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorEffects',
        array(
            'off' => '关闭（默认）',
            'cursor1.min.js' => '烟花效果',
            'cursor2.min.js' => '气泡效果',
            'cursor3.min.js' => '富强、民主、和谐（消耗性能）',
            'cursor4.min.js' => '彩色爱心（消耗性能）'
        ),
        'off',
        '选择鼠标点击特效',
        '介绍：用于切换鼠标点击特效 '
    );
    $JCursorEffects->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorEffects->multiMode());

    // 博客设置
    //以下为博客设置
    $blogMid = new Typecho_Widget_Helper_Form_Element_Text('blogMid', NULL, NULL, _t('展示的博客分类mid'), _t('输入需要展示的博客分类的mid，中间用||分隔, 1 || 2'));
    $blogMid->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($blogMid);

    $JSummaryMeta = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'JSummaryMeta',
        array(
            'author' => '显示作者',
            'cate' => '显示分类',
            'time' => '显示时间',
            'read' => '显示阅读量',
            'comment' => '显示评论量',
        ),
        null,
        '选择博客显示的选项',
        '该处的设置是用于设置首页及搜索页列表里的文章信息，根据您的爱好自行选择'
    );
    $JSummaryMeta->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JSummaryMeta->multiMode());

    $JPageStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPageStatus',
        array('default' => '按钮切换形式（默认）', 'ajax' => '点击加载形式'),
        'default',
        '选择博客页的分页形式',
        '介绍：选择一款您所喜欢的分页形式'
    );
    $JPageStatus->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JPageStatus->multiMode());

    $JIndexSticky = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexSticky',
        NULL,
        NULL,
        '博客置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）<br />
         例如：1 || 2 || 3'
    );
    $JIndexSticky->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexSticky);

    $JIndexNotice = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexNotice',
        NULL,
        NULL,
        '博客通知文字（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）<br />
         例如：我是通知哈哈哈||http://baidu.com'
    );
    $JIndexNotice->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexNotice);

    $JIndexAD = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexAD',
        NULL,
        NULL,
        '博客大屏广告（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：广告图片 || 广告链接 （中间使用两个竖杠分隔，限制一个）<br />
         例如：https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0||http://baidu.com'
    );
    $JIndexAD->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexAD);

    $JIndexHotStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JIndexHotStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启热门文章',
        '介绍：开启后，网站博客页将会显示浏览量最多的4篇热门文章'
    );
    $JIndexHotStatus->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexHotStatus->multiMode());

    $JIndexCarousel = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexCarousel',
        NULL,
        NULL,
        '博客页轮播图（非必填）',
        '介绍：用于显示博客页轮播图，请务必填写正确的格式 <br />
         格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个轮播图 <br />
         例如：<br />
            https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || http://baidu.com || 百度一下 <br />
            https://puui.qpic.cn/tv/0/1223447268_1680580/0 || http://v.qq.com || 腾讯视频
         '
    );
    $JIndexCarousel->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexCarousel);

    $JIndexRecommend = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexRecommend',
        NULL,
        NULL,
        '博客页推荐文章（非必填，填写时请填写2个，否则不显示！）',
        '介绍：用于显示推荐文章，请务必填写正确的格式 <br/>
         格式：文章的id || 文章的id （中间使用两个竖杠分隔）<br />
         例如：1 || 2 <br />
         注意：如果填写的不是2个，将不会显示
         '
    );
    $JIndexRecommend->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexRecommend);

    //developer
    $headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $headerEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($headerEcho);

    $footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义脚部信息'), _t('填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码'));
    $footerEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($footerEcho);

    $cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $cssEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($cssEcho);

    $jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $jsEcho->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($jsEcho);

    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio('compressHtml',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('HTML压缩'), _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭'));
    $compressHtml->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($compressHtml);



    /**
     * 积分设置
     */
    //用户积分
    $credits_register = new Typecho_Widget_Helper_Form_Element_Text('creditsRegister', NULL, 2000, _t('注册积分'),_t('用户注册后默认的积分'));
    $credits_register->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_register);

    $credits_login = new Typecho_Widget_Helper_Form_Element_Text('creditsLogin', NULL, 20, _t('登录积分'),_t('每日登录获取的积分'));
    $credits_login->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_login);

    $credits_publish = new Typecho_Widget_Helper_Form_Element_Text('creditsPublish', NULL, -10, _t('发布主题'),_t('用户发布主题加上或减少的积分'));
    $credits_publish->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_publish);

    $credits_reply = new Typecho_Widget_Helper_Form_Element_Text('creditsReply', NULL, -5, _t('发表回复'),_t('用户发表回复加上或减少的积分'));
    $credits_reply->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_reply);

    $credits_invite = new Typecho_Widget_Helper_Form_Element_Text('creditsInvite', NULL, 200, _t('邀请注册'),_t('邀请者和被邀请者所奖励的积分'));
    $credits_invite->setAttribute('class', 'j-setting-content j-setting-jifen');
    $form->addInput($credits_invite);


    /**
     * 广告设置
     */
    $index_middle_ads = new Typecho_Widget_Helper_Form_Element_Text('index_middle_ads', NULL, '', _t('首页中部广告设置'),_t('默认长度 600x90'));
    $index_middle_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($index_middle_ads);

    $list_middle_ads = new Typecho_Widget_Helper_Form_Element_Text('list_middle_ads', NULL, '', _t('文章列表广告设置'),_t('每隔7篇输出一下，文章数不够的修改阅读设置文章数，默认长度 600x90'));
    $list_middle_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($list_middle_ads);

    $article_top_ads = new Typecho_Widget_Helper_Form_Element_Text('article_top_ads', NULL, '', _t('文章顶部广告设置'),_t('默认长度 600x90'));
    $article_top_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($article_top_ads);

    $article_bottom_ads = new Typecho_Widget_Helper_Form_Element_Text('article_bottom_ads', NULL, '', _t('文章底部广告设置'),_t('默认长度 600x90'));
    $article_bottom_ads->setAttribute('class', 'j-setting-content j-setting-ads');
    $form->addInput($article_bottom_ads);
}