<?php
    if(isset($dataUserEnem)) {
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Date Created</th>
            <th>Date Update</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($dataUserEnem as $key => $value) {
        ?>
                <tr>
                    <td>
                        <?php
                            if($pageNowUser > 1) {
                                echo ($key + 1) + $startLimitUser;
                            } else {
                                echo $key + 1;
                            }
                        ?>
                    </td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td><?php echo $value->username; ?></td>
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

<nav class="pagination-<?php echo $paginationUser; ?>" aria-label="Page navigation" data-enem-pagination="pagination" pagination-target="<?php echo $paginationUser; ?>">
    <ul class="pagination">
        <?php
            if($prevUser) {
        ?>
                <li>
                    <a href="#" pagination-page="<?php echo $prevUser;?>" aria-label="Previous">
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
            for ($i=$startPaginationUser; $i < $endPaginationUser; $i++) {
                if($i == $pageNowUser) {
                    echo '<li class="active"><a href="javascript:;">'.$i.'</a></li>';
                } elseif($i <= $totalPageUser) {
                    echo '<li><a href="javascript:;" pagination-page="'.$i.'">'.$i.'</a></li>';
                }
            }
        ?>

        <?php
            if($nextUser) {
        ?>
                <li>
                    <a href="javascript:;" pagination-page="<?php echo $nextUser; ?>" aria-label="Next">
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
    $(".pagination-<?php echo $paginationUser; ?> a").on("click", function(){
        var enPagination = $(this),
            enParentPagination = enPagination.parent().parent().parent("[data-enem-pagination=\'pagination\']"),
            enTarget = enParentPagination.attr("pagination-target"),
            enPage = enPagination.attr("pagination-page"),
            enPanelEl = $('.panel.<?php echo $paginationUser; ?>');

        var siteUrl = enem.powerGetUrl();

        var dataPaginationAjax = {
            enemElLoading: "[pagination-name="+enTarget+"] .enem.wrapper-loading-panel",
            enemElContainer: "[pagination-name="+enTarget+"] .enem.content-pagination",
            enemUrl: siteUrl + "enem/ajax/pagination",
            enemData: {
                pagination_key: "enem",
                pagination_name: "<?php echo $paginationUser; ?>",
                page: enPage,
            },
        };

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