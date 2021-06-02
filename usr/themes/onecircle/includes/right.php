<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
error_reporting(0);
$credits_arr = utils::creditsConvert($this->user->credits);

?>
<aside class="asideBar col w-md w-lg bg-white-only bg-auto no-border-xs" role="complementary">
    <div id="sidebar">
        <?php if ($this->is('index')): ?>
            <div class="card user-container">
                <?php if ($this->user->hasLogin()): ?>
                    <div class="card-header user-info" style="background-image: url(<?php echo getUserBackgroundImg($this->user->mail,$this->user->userBackImg) ?>);"></div>
                    <div class="user-detail">
                        <a href="<?php  $author_url = Typecho_Common::url('/author/'.$this->user->uid.'/',$this->options->index);echo $author_url?>">
                            <div class="info">
                                <img class="avatar" src="<?php echo getUserV2exAvatar($this->user->mail,$this->user->userAvatar)?>" alt="<?php echo $this->user->name ?>"/>
                            </div>
                        </a>
                        <div class="user-info-name">
                            <a href="<?php echo $author_url?>"><?php echo $this->user->name;?></a><span class="badge bg-info m-l-xs text-xs">LV<?php _e($this->user->level); ?></span>
                        </div>
                        <div class="user-info-fans">
                            <a href="<?php echo $author_url?>"><span style="color: rgb(64, 64, 64);"><?php _e(UserFollow::getFollowNum($this->user->uid));?></span>关注</a>
                            <a href="<?php echo $author_url?>"><span style="color: rgb(64, 64, 64);"><?php _e(UserFollow::getOtherFollowNum($this->user->uid));?></span>被关注</a>
                        </div>
                        <div class="user-info-introduction">
                            <span><?php
                                if($this->user->userSign){
                                    echo $this->user->userSign;
                                }else{
                                    echo "太懒了，还没有个人签名!";
                                }
                                ?></span>
                        </div>
                        <div class="value">
                            <a href="<?php _e($this->options->index . '/usercenter/credits'); ?>">
                                <span class="coin">
                                    <?php if ($this->user->credits == 0 ):?><span class="copper">0</span>
                                    <?php else:?>
                                        <?php if (!empty($credits_arr[0])):?><span class="gold"><?php _e($credits_arr[0]);?></span><?php endif;?>
                                        <?php if (!empty($credits_arr[1])):?><span class="silver"><?php _e($credits_arr[1]);?></span><?php endif;?>
                                        <?php if (!empty($credits_arr[2])):?><span class="copper"><?php _e($credits_arr[2]);?></span><?php endif;?>
                                    <?php endif;?>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                <?php $blogInfo = getBlogAdminInfo()?>
                    <div class="card-header user-info" style="background-image: url(<?php echo getUserBackgroundImg($blogInfo['mail'],$blogInfo['userBackImg']) ?>);"></div>
                    <div class="user-detail user-detail-padding">
                        <a>
                            <div class="info">
                                <img class="avatar" src="<?php echo getUserV2exAvatar($blogInfo['mail'],$blogInfo['userAvatar'])?>" alt="<?php echo $blogInfo['name'] ?>"/>
                            </div>
                        </a>
                        <div class="user-info-name">
                            <a href=""><?php echo $blogInfo['name'] ?></a>
                        </div>
                        <div class="user-info-fans">
                            <a href="<?php $author_url = Typecho_Common::url('/author/'.$blogInfo['uid'],$this->options->rootUrl);_e($author_url)?>"><span style="color: rgb(64, 64, 64);"><?php _e(UserFollow::getFollowNum(1));?></span>关注</a>
                            <a href="<?php echo $author_url?>"><span style="color: rgb(64, 64, 64);"><?php _e(UserFollow::getOtherFollowNum(1));?></span>被关注</a>
                        </div>
                        <div class="user-info-introduction">
                            <span><?php echo $blogInfo['userSign'] ?></span>

                        </div>
                    </div>

                    <div class="card-footer user-detail" >
                        <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                        <ul class="list-group list-group-horizontal">
                            <li>
                                <div class="detail-title" title="文章">📝</div>
                                <div class="detail-num">
                                    <?php $stat->publishedPostsNum() ?>
                                </div>
                            </li>
                            <li>
                                <div class="detail-title" title="评论">💬</div>
                                <div class="detail-num">
                                    <?php $stat->publishedCommentsNum() ?>
                                </div>
                            </li>
                            <li>
                                <div class="detail-title" title="分类">🏷</div>
                                <div class="detail-num">
                                    <?php $stat->categoriesNum() ?>
                                </div>
                            </li>
                        </ul>

                    </div>
                <?php endif ?>
            </div>
            <?php elseif($this->is('page')): ?>
            <?php elseif($this->is('search')): ?>
            <?php else:?>
            <div class="card user-container">

                <div class="mycicle-title"><h2><?php if (empty($this->categories[0]['name'])) _e("未选择圈子");else _e($this->categories[0]['name']) ?></h2></div>
                <div class="iwNods">
                    <div class="daMYau">
                    <span><?php _e(parseDesc2text($this->categories[0]['description']));?>
                    </span>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="card d-none d-md-block mycicle">
            <div class="mycicle-title">
                <h2>我的圈子</h2>
                <a href="<?php _e(Typecho_Common::url('/metas',$this->options->index));?>">
                    <svg t="1603601049059" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3178" width="24" height="24"><path d="M391.88 600.132c17.667 0 31.988 14.321 31.988 31.987v271.894c0 17.666-14.321 31.987-31.987 31.987H119.987C102.321 936 88 921.679 88 904.013V632.119c0-17.666 14.321-31.987 31.987-31.987h271.894z m463.818 0c17.667 0 31.988 14.321 31.988 31.987v271.894c0 17.666-14.321 31.987-31.988 31.987H583.805c-17.666 0-31.987-14.321-31.987-31.987V632.119c0-17.666 14.321-31.987 31.987-31.987h271.893zM734.374 97.369L926.63 289.626c12.492 12.492 12.492 32.746 0 45.238L734.374 527.12c-12.492 12.492-32.746 12.492-45.238 0L496.88 334.864c-12.492-12.492-12.492-32.746 0-45.238L689.136 97.37c12.492-12.492 32.746-12.492 45.238 0zM391.88 136.314c17.666 0 31.987 14.321 31.987 31.988v271.893c0 17.666-14.321 31.987-31.987 31.987H119.987c-17.666 0-31.987-14.321-31.987-31.987V168.302c0-17.667 14.321-31.988 31.987-31.988h271.894z m319.874 40.22L576.044 312.245l135.711 135.711 135.711-135.711-135.711-135.711z" p-id="3179" fill="#707070"></path></svg>
                </a>
            </div>
            <div class="mycicle-content">
                <?php
                $arr = CircleFollow::getFollowObj($this->user->uid,10,$this->options->defaultSlugUrl);
                $length = count($arr);
                if ($length > 0):
                ?>
                <?for ($i = 0; $i < $length; $i++): ?>
                    <div class="circle-item">
                        <a href="<?php echo $arr[$i][2] ?>" class="circle-item-link">
                            <img src="<?php echo $arr[$i][3] ?>">
                            <div class="circle-item-link-right">
                                <div class="circle-item-link-title"><?php echo $arr[$i][1] ?></div>
                                <div class="circle-item-link-info"><?php echo $arr[$i][4] ?></div>
                            </div>
                        </a>
                    </div>
                <?php endfor;?>
                <?php else:?>
                <div class="circle-item">
                    <?php if ($this->user->hasLogin()): ?>
                    <small>还没有关注圈子~</small>
                    <?php else:?>
                    <small>登录后可见</small>
                    <?php endif;?>
                </div>
                <?php endif;?>
            </div>
        </div>

        <div class="card recent-box d-none d-md-block">
            <h2 class="title">最近回复</h2>
            <ul class="list-unstyled">
                <?php $r_comments =null;
                @$this->widget('Widget_Comments_Recent@right', 'ignoreAuthor=true&pageSize=5')->to($r_comments); ?>
                <?php while ($r_comments->next()): ?>
                    <li class="media my-4">
                        <img class="recent-avatar mr-3"
                             src="<?php echo getUserV2exAvatar($r_comments->mail,UserFollow::getUserObjFromMail($r_comments->mail)['userAvatar'],40); ?>"/>
                        <div class="media-body">
                            <h6 class="mt-0 mb-1"><?php $r_comments->author(false); ?></h6>
                            <a class="content" href="<?php $r_comments->permalink(); ?>"
                               target="<?php $this->options->sidebarLinkOpen(); ?>">
                                <?php $comm=trim(utils::substr($r_comments->content,35));if ($comm)echo contents::parseHide($comm);else echo "非文字回复"?>
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="card random-post d-none d-md-block">
            <h4 class="title">可能感兴趣</h4>
            <?php theme_random_posts(); ?>
        </div>
    </div>
</aside>

