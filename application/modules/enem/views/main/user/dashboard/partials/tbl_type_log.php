<?php
    if(isset($dataTypeLogEnem)) {
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Status Log</th>
            <th>Date Created</th>
            <th>Date Update</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($dataTypeLogEnem as $key => $value) {
        ?>
                <tr>
                    <td>
                        <?php
                            if($pageNowTypeLog > 1) {
                                echo ($key + 1) + $startLimitTypeLog;
                            } else {
                                echo $key + 1;
                            }
                        ?>
                    </td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->status_log; ?></td>
                    <td>
                        <?php
                            if($value->date_created) {
                                echo date('d/m/Y | H:i:s', strtotime($value->date_created));
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($value->date_update) {
                                echo date('d/m/Y | H:i:s', strtotime($value->date_update));
                            } else {
                                echo 'Not update';
                            }
                        ?>
                    </td>
                    <td>
                        <ul class="list-data-action">
                            <li>
                                <a class="enem-waves btn btn-success btn-edit" href="javascript:;">
                                    <i class="icon-pencil"></i>
                                </a>
                            </li>
                            <li>
                                <a class="enem-waves btn btn-danger btn-delete" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<nav class="pagination-<?php echo $paginationTypeLog; ?>" aria-label="Page navigation" data-enem-pagination="pagination" pagination-target="<?php echo $paginationTypeLog; ?>">
    <ul class="pagination">
        <?php
            if($prevTypeLog) {
        ?>
                <li>
                    <a href="#" pagination-page="<?php echo $prevTypeLog;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
        <?php
            } else {
        ?>
                <li class="disabled">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
        <?php
            }
        ?>

        <?php
            for ($i=$startPaginationTypeLog; $i < $endPaginationTypeLog; $i++) {
                if($i == $pageNowTypeLog) {
                    echo '<li class="active"><a href="javascript:;">'.$i.'</a></li>';
                } elseif($i <= $totalPageTypeLog) {
                    echo '<li><a href="javascript:;" pagination-page="'.$i.'">'.$i.'</a></li>';
                }
            }
        ?>

        <?php
            if($nextTypeLog) {
        ?>
                <li>
                    <a href="javascript:;" pagination-page="<?php echo $nextTypeLog; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
        <?php
            } else {
        ?>
                <li class="disabled">
                    <a href="javascript:;" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
        <?php
            }
        ?>
    </ul>
</nav>

<script type="text/javascript">
    $(".pagination-<?php echo $paginationTypeLog; ?> a").on("click", function(){
        var enPagination = $(this),
            enParentPagination = enPagination.parent().parent().parent("[data-enem-pagination=\'pagination\']"),
            enTarget = enParentPagination.attr("pagination-target"),
            enPage = enPagination.attr("pagination-page"),
            enPanelEl = $('.panel.<?php echo $paginationTypeLog; ?>');

        var siteUrl = enem.powerGetUrl();

        var dataPaginationAjax = {
            enemElLoading: "[pagination-name="+enTarget+"] .enem.wrapper-loading-panel",
            enemElContainer: "[pagination-name="+enTarget+"] .enem.content-pagination",
            enemUrl: siteUrl + "enem/ajax/pagination",
            enemData: {
                pagination_key: "enem",
                pagination_name: "<?php echo $paginationTypeLog; ?>",
                page: enPage,
            },
        };

        console.info(enTarget);

        if(enPanelEl[0]) {
            // get offset element
            var pos = enPanelEl.offset().top - 63;

            // animated top scrolling
            $('body, html').animate({scrollTop: pos}, 1000);
        }

        $(dataPaginationAjax.enemElContainer).html('');
        enem.powerAjaxRender(dataPaginationAjax);

        console.info(dataPaginationAjax.enemElLoading);
    });

    $('.btn-edit').on('click', function(){
        alert('edit');
        refreshPanel();
    });

    $('.btn-delete').on('click', function(){
        alert('delete');
    });

    function refreshPanel() {
        // var siteUrl = enem.powerGetUrl(),
        //     enPanelEl = $('.panel.<?php echo $paginationTypeLog; ?>');

        // var dataPaginationRefreshAjax = {
        //     enemElLoading: "[pagination-name="<?php echo $paginationTypeLog; ?>"] .enem.wrapper-loading-panel",
        //     enemElContainer: "[pagination-name="<?php echo $paginationTypeLog; ?>"] .enem.content-pagination",
        //     enemUrl: siteUrl + "enem/ajax/pagination",
        //     enemData: {
        //         pagination_key: "enem",
        //         pagination_name: "<?php echo $paginationTypeLog; ?>",
        //         page: 1,
        //     },
        // };

        // if(enPanelEl[0]) {
        //     // get offset element
        //     var pos = enPanelEl.offset().top;

        //     // animated top scrolling
        //     $('body, html').animate({scrollTop: pos}, 1000);
        // }

        // enem.powerAjaxRender(dataPaginationRefreshAjax);
        console.info('refresh');
    }
</script>
<?php
    } else {
?>
<div class="col-lg-12 text-center">
    Tidak ditemukan Hasil
</div>
<?php
    }
?>