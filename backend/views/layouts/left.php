<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>"><i class="fa fa-sign-out"></i> 退出登录</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '菜单列表', 'options' => ['class' => 'header']],
                    ['label' => '基本统计', 'icon' => 'stack-exchange', 'url' => ['/gii']],
                    [
                        'label' => '内容管理',
                        'icon' => 'industry',
                        'url' => '#',
                        'items' => [
                            ['label' => '文章列表', 'icon' => 'book', 'url' => ['/article/list'],],
                            ['label' => '分类管理', 'icon' => 'cubes', 'url' => ['/category/list'],],
                        ],
                    ],
                    [
                        'label' => '权限管理',
                        'icon' => 'gear',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => '管理员管理',
                                'icon' => 'user',
                                'url' => '#',
                                'items' => [
                                    ['label' => '添加管理员', 'icon' => 'plus', 'url' => ['/administrators/create'],],
                                    ['label' => '管理员列表', 'icon' => 'list-ul', 'url' => ['/administrators/list'],],
                                ],
                            ],
                            [
                                'label' => '权限管理',
                                'icon' => 'hand-paper-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => '添加角色', 'icon' => 'plus', 'url' => ['/permission/create-role'],],
                                    ['label' => '角色列表', 'icon' => 'list-ul', 'url' => ['/permission/list-role'],],
                                    ['label' => '添加权限', 'icon' => 'plus', 'url' => ['/permission/create-permission'],],
                                    ['label' => '权限列表', 'icon' => 'list-ul', 'url' => ['/permission/list-permission'],],
                                ],
                            ],
                        ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
