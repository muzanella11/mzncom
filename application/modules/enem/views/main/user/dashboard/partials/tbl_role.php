<?php
    if(isset($dataRoleEnem)) {
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Role</th>
            <th>Date Created</th>
            <th>Date Update</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($dataRoleEnem as $key => $value) {
        ?>
                <tr>
                    <td>
                        <?php
                            if($pageNowRole > 1) {
                                echo ($key + 1) + $startLimitRole;
                            } else {
                                echo $key + 1;
                            }
                        ?>
                    </td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->status_role; ?></td>
                    <td><?php echo date('d/m/Y | H:i:s', strtotime($value->date_created)); ?></td>
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
                                <a class="enem-waves btn btn-success" href="javascript:;">
                                    <i class="icon-pencil"></i>
                                </a>
                            </li>
                            <li>
                                <a class="enem-waves btn btn-danger" href="javascript:;">
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

<nav aria-label="Page navigation" data-enem-pagination="pagination" pagination-target="<?php echo $paginationRole; ?>">
    <ul class="pagination">
        <?php
            if($prevRole) {
        ?>
                <li>
                    <a href="#" pagination-page="<?php echo $prevRole;?>" aria-label="Previous">
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
            for ($i=$startPaginationRole; $i < $endPaginationRole; $i++) {
                if($i == $pageNowRole) {
                    echo '<li class="active"><a href="javascript:;">'.$i.'</a></li>';
                } elseif($i <= $totalPageRole) {
                    echo '<li><a href="javascript:;" pagination-page="'.$i.'">'.$i.'</a></li>';
                }
            }
        ?>

        <?php
            if($nextRole) {
        ?>
                <li>
                    <a href="javascript:;" pagination-page="<?php echo $nextRole; ?>" aria-label="Next">
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

<script>
    $("[data-enem-pagination=\'pagination\'] a").on("click", function(){
        var enPagination = $(this),
            enParentPagination = enPagination.parent().parent().parent("[data-enem-pagination=\'pagination\']"),
            enTarget = enParentPagination.attr("pagination-target"),
            enPage = enPagination.attr("pagination-page"),
            enPanelEl = $('.panel.<?php echo $paginationRole; ?>');

        var siteUrl = enem.powerGetUrl();

        var dataPaginationAjax = {
            enemElLoading: "[pagination-name="+enTarget+"] .enem.wrapper-loading-panel",
            enemElContainer: "[pagination-name="+enTarget+"] .enem.content-pagination",
            enemUrl: siteUrl + "enem/ajax/pagination",
            enemData: {
                pagination_key: "enem",
                pagination_name: enTarget,
                page: enPage,
            }
        }

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