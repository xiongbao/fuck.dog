<?php
function themeConfig($form)
{
    $str1 = explode('/themes/', Helper::options()->themeUrl);
    $str2 = explode('/', $str1[1]);
    $name = $str2[0];

    echo '<h2>超级功能</h2>';
    echo '<link rel="stylesheet" href="' . Helper::options()->themeUrl . '/assets/css/admin.css">';
    echo '<button type="button" class="btn btn-s" id="update-button">检查更新</button>';
    echo '<p id="check-update" class="notice" style="display:none;">检查中..</p>';
    echo '<script>let version=' . themeVersion() . '</script>';
    echo '<script src="' . Helper::options()->themeUrl . '/assets/js/update.js"></script>';
    echo '<form class="protected col-mb-12" action="?' . $name . 'bf" method="post">
    <input type="submit" name="type" class="btn btn-s" value="备份模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="还原模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" /></form>';
    $db = Typecho_Db::get();
    $sjdq = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name));
    $ysj = $sjdq['value'];
    if (isset($_POST['type'])) {
        if ($_POST["type"] == "备份模板设置数据") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $update = $db->update('table.options')->rows(array('value' => $ysj))->where('name = ?', 'theme:' . $name . 'bf');
                $updateRows = $db->query($update);
                echo '<p class="notice col-mb-12 home"> 备份已更新，请等待自动刷新！如果等不到请点击';
                ?>
                <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
                <script>window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
                <?php
            } else {
                if ($ysj) {
                    $insert = $db->insert('table.options')
                        ->rows(array('name' => 'theme:' . $name . 'bf', 'user' => '0', 'value' => $ysj));
                    $insertId = $db->query($insert);
                    echo '<p class="notice col-mb-12 home"> 备份完成，请等待自动刷新！如果等不到请点击';
                    ?>
                    <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
                    <script>window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
                    <?php
                }
            }
        }
        if ($_POST["type"] == "还原模板设置数据") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $sjdub = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'));
                $bsj = $sjdub['value'];
                $update = $db->update('table.options')->rows(array('value' => $bsj))->where('name = ?', 'theme:' . $name);
                $updateRows = $db->query($update);
                echo '<p class="notice col-mb-12 home"> 检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
                ?>
                <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
                <script>window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
                <?php
            } else {
                echo '<p class="notice col-mb-12 home"> 没有模板备份数据，恢复不了哦！</p>';
            }
        }
        if ($_POST["type"] == "删除备份数据") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $delete = $db->delete('table.options')->where('name = ?', 'theme:' . $name . 'bf');
                $deletedRows = $db->query($delete);
                echo '<p class="notice col-mb-12 home"> 删除成功，请等待自动刷新，如果等不到请点击';
                ?>
                <a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></p>
                <script>window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
                <?php
            } else {
                echo '<p class="notice col-mb-12 home"> 不用删了！备份不存在！！！</p>';
            }
        }
    }
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, "https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2592033302,3451533765&fm=26&gp=0.jpg", _t('<h2>普通设置</h2>站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    $defaultSlugUrl = new Typecho_Widget_Helper_Form_Element_Text('defaultSlugUrl', NULL, "https://img.icons8.com/dusk/2x/categorize.png", _t('默认的分类图片'), _t('在这里填入一个图片 URL， 地址为分类图片的默认图标'));
    $form->addInput($defaultSlugUrl);
    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL, NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
    $form->addInput($sticky);
    $useInfiniteScroll = new Typecho_Widget_Helper_Form_Element_Radio('useInfiniteScroll',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('无限滚动'), _t('开启后将会隐藏分页器，显示无限滚动'));
    $form->addInput($useInfiniteScroll);

    $recordNo = new Typecho_Widget_Helper_Form_Element_Text('recordNo', NULL, NULL, _t('网站备案号'), _t('根据要求，每个备案网站必须填写备案号，不然得罚款'));
    $form->addInput($recordNo);
    $customNavIcon = new Typecho_Widget_Helper_Form_Element_Textarea('customNavIcon', NULL, NULL, _t('自定义导航小图标'), _t('按照格式书写，自定义内导航栏右侧的小图标，留空则展示默认的图标按钮，书写的格式请查看 wiki<hr>'));
    $form->addInput($customNavIcon);
    $jsPushBaidu = new Typecho_Widget_Helper_Form_Element_Select('jsPushBaidu', array('0' => '关闭', '1' => '开启'), '0', _t('自动推送'), _t('使用通用js自动推荐给百度引擎，增快收录'));
    $form->addInput($jsPushBaidu);
//    $rightImg = new Typecho_Widget_Helper_Form_Element_Text('rightImg', NULL, NULL, _t('<h2>侧边栏设置</h2>侧边栏背景'), _t('一条外链'));
//    $form->addInput($rightImg);

    //developer
    $headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $form->addInput($headerEcho);
    $footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义脚部信息'), _t('填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码'));
    $form->addInput($footerEcho);
    $cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $form->addInput($cssEcho);
    $jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $form->addInput($jsEcho);
    $LicenseInfo = new Typecho_Widget_Helper_Form_Element_Text('LicenseInfo', NULL, NULL, _t('文章许可信息'), _t('填入后将在文章底部显示你填入的许可信息（支持HTML标签）<br>eg: 本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。'));
    $form->addInput($LicenseInfo);
    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio('compressHtml',
        array(1 => _t('启用'),
            0 => _t('关闭')),
        0, _t('HTML压缩'), _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭'));
    $form->addInput($compressHtml);
}