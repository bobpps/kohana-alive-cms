<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $title ?></title>

        <?php foreach ($styles as $style) : ?>
            <?= $style ?>
        <?php endforeach; ?>

        <script>
            var cmsUrlPrefix = '<?= $cms_url_prefix ?>';
        </script>

        <?php foreach ($scripts as $script) : ?>
            <?= $script ?>
        <?php endforeach; ?>    

    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">Kohana Alive CMS</a>
                </div>
                <!-- /.navbar-header -->

                <?= $topmenu ?>
                <!-- /.navbar-top-links -->

                <?= $leftmenu ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?= $caption ?></h1>
                        <div class="<?= $content_class ?>">
                            <?= $content ?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Core Scripts - Include with every page -->
    <!--    <script src="/cms/js/jquery-1.10.2.js"></script>
        <script src="/cms/js/bootstrap.min.js"></script>
        <script src="/cms/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    
        <script src="/cms/js/sb-admin.js"></script>-->

        <!-- Page-Level Demo Scripts - Blank - Use for reference -->

    </body>

</html>
